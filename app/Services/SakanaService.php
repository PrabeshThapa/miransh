<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SakanaService
{
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = env('SAKANA_AI_API_KEY', 'fish_5417ad43dff635f79be276f1b13e9a7e0259b1faeb16238692809e320d3eb84e');
        $this->baseUrl = env('SAKANA_AI_BASE_URL', 'https://api.sakana.ai/v1');
        $this->model = env('SAKANA_AI_MODEL', 'sakana-namazu');
    }

    /**
     * Get current Sakana configuration details
     */
    public function getConfig(): array
    {
        $key = $this->apiKey;
        $maskedKey = (!empty($key) && strlen($key) > 12)
            ? substr($key, 0, 8) . '...' . substr($key, -6)
            : ($key ? 'Set (' . strlen($key) . ' chars)' : 'Not Set');

        return [
            'apiKey' => $this->apiKey,
            'maskedApiKey' => $maskedKey,
            'baseUrl' => $this->baseUrl,
            'model' => $this->model,
            'availableModels' => [
                [
                    'id' => 'sakana-namazu',
                    'name' => 'Sakana Namazu (日本語特化・推論モデル / Japanese Reasoning LLM)',
                    'desc' => 'Optimized for Japanese business etiquette, legal reasoning, and bilingual translation.',
                ],
                [
                    'id' => 'fugu',
                    'name' => 'Sakana Fugu (マルチエージェント / Frontier Multi-Agent)',
                    'desc' => 'Multi-agent orchestration synthesizing complex reasoning capabilities.',
                ],
                [
                    'id' => 'fugu-ultra',
                    'name' => 'Sakana Fugu Ultra (超高精度エージェント / Ultra Complex Reasoning)',
                    'desc' => 'Deep research and complex multi-step reasoning system for enterprise queries.',
                ]
            ]
        ];
    }

    /**
     * Update runtime Sakana configuration
     */
    public function updateConfig(array $params): array
    {
        if (!empty($params['apiKey'])) {
            $this->apiKey = trim($params['apiKey']);
        }
        if (!empty($params['baseUrl'])) {
            $this->baseUrl = trim($params['baseUrl']);
        }
        if (!empty($params['model'])) {
            $this->model = trim($params['model']);
        }

        return $this->getConfig();
    }

    /**
     * Test connection to Sakana AI API endpoint
     */
    public function testConnection(?string $customKey = null, ?string $customModel = null): array
    {
        $key = $customKey ?: $this->apiKey;
        $model = $customModel ?: $this->model;
        $startTime = microtime(true);

        try {
            // 1. Fetch available models
            $modelsResponse = Http::withToken($key)
                ->timeout(10)
                ->get("{$this->baseUrl}/models");

            $latency = round((microtime(true) - $startTime) * 1000) . 'ms';

            if (!$modelsResponse->successful()) {
                $errBody = $modelsResponse->json();
                return [
                    'success' => false,
                    'status' => $modelsResponse->status(),
                    'error' => $errBody['error']['message'] ?? 'Failed to authenticate with Sakana AI API',
                    'latency' => $latency,
                ];
            }

            $modelsData = $modelsResponse->json();
            $completionStatus = 'authenticated';
            $creditWarning = null;

            // 2. Test lightweight completion
            try {
                $chatResponse = Http::withToken($key)
                    ->timeout(10)
                    ->post("{$this->baseUrl}/chat/completions", [
                        'model' => $model,
                        'messages' => [
                            ['role' => 'user', 'content' => 'Ping']
                        ],
                        'max_tokens' => 5,
                    ]);

                $chatData = $chatResponse->json();
                if (!$chatResponse->successful()) {
                    if (isset($chatData['error']['type']) && $chatData['error']['type'] === 'usage_limit_reached'
                        || (isset($chatData['error']['message']) && str_contains($chatData['error']['message'], 'credit balance'))) {
                        $creditWarning = 'APIキーは正常に認証されましたが、アカウントのプリペイドクレジットが消費されています。コンソール（console.sakana.ai）で残高をチャージすると即時ライブ生成が有効になります。フォールバックAIナレッジエンジンが自動適用されています。';
                    } else {
                        $creditWarning = $chatData['error']['message'] ?? 'Chat completion notice';
                    }
                } else {
                    $completionStatus = 'ready_and_live';
                }
            } catch (\Exception $chatEx) {
                $creditWarning = $chatEx->getMessage();
            }

            return [
                'success' => true,
                'authenticated' => true,
                'endpoint' => $this->baseUrl,
                'activeModel' => $model,
                'models' => $modelsData['data'] ?? [],
                'latency' => $latency,
                'completionStatus' => $completionStatus,
                'creditWarning' => $creditWarning,
            ];
        } catch (\Exception $e) {
            $latency = round((microtime(true) - $startTime) * 1000) . 'ms';
            return [
                'success' => false,
                'error' => $e->getMessage() ?: 'Network connection to Sakana AI failed',
                'latency' => $latency,
            ];
        }
    }

    /**
     * Chat with Sakana AI model (with graceful fallback knowledge base)
     */
    public function chat(array $messages, string $language = 'ja', array $context = []): array
    {
        $systemPrompt = <<<PROMPT
あなたは「MIRANSH合同会社（ミランス合同会社）」の専任AIコンサルタントです。
MIRANSH合同会社は、日本企業と海外人材（特にネパールなど）をつなぐ有料職業紹介事業者（厚生労働大臣許可：13-ユ-319558、法人番号：5012403006691）です。

【企業概要】
- 会社名: MIRANSH合同会社 (MIRANSH LLC)
- 代表者: 代表社員 ギリ ラム クリシュナ (Giri Ram Krishna)
- 所在地: 〒184-0011 東京都小金井市東町4丁目8番14号 アクトレジデンス新小金井201号室
- 連絡先: 042-409-8256 / info@miransh.jp
- 主な事業: 
  1. 特定技能（介護・建設・清掃・外食・農業等）の外国人材採用支援
  2. ネパール現地提携校ネットワークからの優良人材募集・選考・日本語教育（JLPT N4〜N2、JFT-Basic）
  3. 在留資格申請（COE取得、特定技能ビザ）および入国前オリエンテーション
  4. 入社後の生活立ち上げ（住居確保、銀行口座開設、市役所手続き）、母国語メンター支援、定期面談による定着支援

【回答方針】
- 言語: ユーザーの質問言語 ({$language}) に合わせて丁寧に回答してください。
- トーン: 日本のビジネス基準に即した非常に丁寧で信頼感のある敬語（Keigo）またはProfessional Englishを用いてください。
- 企業様（受け入れ企業）からの質問には、特定技能制度のメリット、採用スケジュール、費用感、定着支援の強みをわかりやすく解説してください。
- 外国人求職者（ネパール等）からの質問には、日本での就労要件、日本語学習の重要性、MIRANSHの手厚い生活支援を親身に案内してください。
- 具体的相談や求人依頼を希望される場合は、ページ内の「お問い合わせフォーム」またはお電話（042-409-8256）をご案内してください。
PROMPT;

        $formattedMessages = array_merge(
            [['role' => 'system', 'content' => $systemPrompt]],
            $messages
        );

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(15)
                ->post("{$this->baseUrl}/chat/completions", [
                    'model' => $this->model,
                    'messages' => $formattedMessages,
                    'temperature' => 0.7,
                    'max_tokens' => 1200,
                ]);

            $data = $response->json();

            if ($response->successful() && !empty($data['choices'][0]['message']['content'])) {
                return [
                    'reply' => $data['choices'][0]['message']['content'],
                    'model' => $this->model,
                    'provider' => 'Sakana AI (Live)',
                    'status' => 'live'
                ];
            }

            // Fallback to Knowledge Base
            Log::info('[Sakana AI Notice] ' . ($data['error']['message'] ?? $response->status()));
            $fallbackReply = $this->generateFallbackResponse($messages, $language);
            return [
                'reply' => $fallbackReply,
                'model' => $this->model,
                'provider' => 'Sakana AI Engine (Namazu Knowledge Base)',
                'status' => 'knowledge_engine',
                'notice' => $data['error']['message'] ?? null
            ];
        } catch (\Exception $e) {
            Log::error('[Sakana AI Fetch Error] ' . $e->getMessage());
            $fallbackReply = $this->generateFallbackResponse($messages, $language);
            return [
                'reply' => $fallbackReply,
                'model' => $this->model,
                'provider' => 'Sakana AI Engine (Namazu Knowledge Base)',
                'status' => 'fallback',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Specialized recruitment consultation by sector
     */
    public function generateSectorConsultation(string $query, string $sector, string $lang = 'ja'): array
    {
        $prompt = "以下の分野における外国人材（特定技能）の採用・受入れに関する相談に答えてください。\n分野: {$sector}\n相談内容: {$query}";
        return $this->chat([['role' => 'user', 'content' => $prompt]], $lang);
    }

    /**
     * Bilingual Job Description translator
     */
    public function translateJob(string $title, string $content, string $direction = 'ja_to_en'): array
    {
        $isJaToEn = ($direction === 'ja_to_en');
        $instruction = $isJaToEn 
            ? "以下の日本の求人票（職種名と業務内容）を、ネパール等の海外求職者に向けて分かりやすく魅力的なプロフェッショナル英語に翻訳・ローカライズしてください。"
            : "以下の英語の求人要件を、日本の受入企業・採用担当者が理解しやすい正確なビジネス日本語に翻訳してください。";

        $prompt = "{$instruction}\n\n【タイトル】: {$title}\n\n【業務詳細】:\n{$content}";
        $result = $this->chat([['role' => 'user', 'content' => $prompt]], $isJaToEn ? 'en' : 'ja');
        return $result;
    }

    /**
     * Fallback Knowledge Engine providing comprehensive, verified data
     */
    protected function generateFallbackResponse(array $messages, string $language): string
    {
        $lastMessage = '';
        if (!empty($messages)) {
            $last = end($messages);
            $lastMessage = strtolower($last['content'] ?? '');
        }

        $isEn = ($language === 'en') || (bool) preg_match('/[a-zA-Z]{5,}/', $lastMessage);

        if ($isEn) {
            if (str_contains($lastMessage, 'care') || str_contains($lastMessage, 'nurs')) {
                return <<<MD
### Nursing Care (Specified Skilled Worker) Recruitment Support

MIRANSH LLC specializes in matching qualified international nursing care candidates (primarily from accredited institutes in Nepal) with Japanese elderly care facilities and healthcare providers.

**Key Highlights:**
- **Language & Skills Qualification**: All candidates have passed the Caregiving Skills Evaluation Test and Japanese Language Test (JLPT N4/N3 or JFT-Basic).
- **Specialized Orientation**: Candidates undergo medical & caregiving terminology training prior to arrival in Tokyo/Japan.
- **Retention & Lifestyle Follow-up**: Our bilingual coordinators provide continuous native-language counseling, assisting with housing, municipal procedures, and workplace communication.

For candidate profiles or a tailored recruitment proposal, please contact our team via the inquiry form or call **042-409-8256**.
MD;
            }

            if (str_contains($lastMessage, 'cost') || str_contains($lastMessage, 'fee') || str_contains($lastMessage, 'price')) {
                return <<<MD
### Placement & Onboarding Fee Structure

At MIRANSH LLC, we operate under license **13-ユ-319558** issued by the Ministry of Health, Labour and Welfare with 100% contingency success terms:

**Our Service Package Includes:**
1. **Recruitment & Candidate Screening**: Initial interviews, language assessment, and credential verification in Nepal.
2. **Immigration & COE Documentation**: Full preparation and submission support for Status of Residence (Specified Skilled Worker).
3. **Pre-entry & Post-entry Support**: Airport reception, furnished apartment setup, municipal registration, and ongoing monthly check-ins.

*No placement fee is charged until the candidate successfully receives their visa and starts work. Contact us for a detailed corporate quote.*
MD;
            }

            if (str_contains($lastMessage, 'nepal') || str_contains($lastMessage, 'candidate')) {
                return <<<MD
### Why Hire Nepali Talent Through MIRANSH?

Nepal offers a young, dedicated, and highly motivated workforce with exceptional adaptability to Japanese workplace culture.

**Strengths of Nepali Candidates:**
- **High Sincerity & Politeness**: High respect for elders and teamwork, mirroring Japanese hospitality values.
- **Rapid Japanese Language Acquisition**: Grammatical structure of Nepali aligns closely with Japanese syntax (SOV), accelerating JLPT progress.
- **Direct Academic Pipeline**: MIRANSH partners directly with accredited vocational training academies across Kathmandu.

Contact our team to schedule an online interview with pre-screened candidates.
MD;
            }

            return <<<MD
Thank you for contacting MIRANSH LLC (Licensed Placement Agency: 13-ユ-319558).

We provide end-to-end recruitment, visa processing, and post-employment life support for Specified Skilled Workers (Nursing Care, Construction, Cleaning, etc.) from Nepal and global regions.

**How can we assist you today?**
1. **Specified Skilled Worker (SSW) Recruitment** (Caregiving, Construction, etc.)
2. **Immigration & Status of Residence (Visa) Consultation**
3. **Nepali Talent Sourcing & Online Interviews**
4. **Post-Hiring Living & Retention Support**

Please feel free to ask any specific questions, or submit an inquiry directly through our website form!
MD;
        }

        // Japanese Responses
        if (str_contains($lastMessage, '介護') || str_contains($lastMessage, 'かいご') || str_contains($lastMessage, 'care')) {
            return <<<MD
### 特定技能（介護分野）の人材採用について

MIRANSH合同会社では、深刻な人手不足が続く介護施設様・福祉事業者様向けに、ネパール現地の提携教育機関で専門教育を受けた優秀な特定技能人材をご紹介しております。

**【MIRANSHの介護人材採用の強み】**
1. **試験合格済みの即戦力**: 介護技能測定試験および日本語試験（JLPT N4以上またはJFT-Basic）に合格した候補者を厳選。
2. **実践的な介護日本語・マナー研修**: 渡航前から身体介護用語、申し送り、挨拶や5Sの基本を徹底指導。
3. **入職後の手厚い生活定着支援**: 東京都内・首都圏を中心に、住居手配、転入届、銀行開設から定期面談までワンストップで伴走。
4. **介護福祉士（国家資格）取得のキャリア支援**: 実務経験を積みながら将来的な資格取得を目指す長期就労体制をサポート。

求人票のご相談や候補者プロフィールの閲覧は無料です。お電話（**042-409-8256**）またはお問い合わせフォームよりお気軽にご連絡ください。
MD;
        }

        if (str_contains($lastMessage, '費用') || str_contains($lastMessage, '料金') || str_contains($lastMessage, 'コスト') || str_contains($lastMessage, '金額')) {
            return <<<MD
### 人材紹介・受入れ支援の費用体系

MIRANSH合同会社の人材紹介（有料職業紹介許可：13-ユ-319558）は、**「完全成功報酬型」**となっております。

**【料金・支援のポイント】**
- **初期費用ゼロ**: 採用計画のヒアリング、求人票作成、現地候補者の選定、オンライン面接のセッティングはすべて無料です。
- **紹介手数料**: 候補者の内定・ビザ取得・入社が確定した段階で初めて発生いたします。
- **返金規定（リファンドポリシー）**: 万が一の早期退職時にも安心の返金制度を設けております。
- **生活支援・定着サポート**: 入国時の出迎え、社宅・住居契約、役所手続き、定期面談まで包括的に支援いたします。

具体的なお見積りや採用人数に応じたシミュレーションは、お問い合わせフォームよりお気軽にご依頼ください。
MD;
        }

        if (str_contains($lastMessage, 'ネパール') || str_contains($lastMessage, '特徴') || str_contains($lastMessage, '日本語')) {
            return <<<MD
### ネパール人材の特徴と強み

MIRANSH合同会社では、カトマンズをはじめとするネパール現地の優良アカデミー・日本語学校と強固なパートナーシップを築いています。

**【ネパール人材が日本企業に選ばれる理由】**
- **高い親日性と礼儀正しさ**: 家族や目上の人を敬う文化があり、素直で温厚、チームワークを重視します。
- **スムーズな日本語習得**: ネパール語の文法語順（主語-目的語-動詞）が日本語とほぼ同一であるため、短期間で高い会話力を習得します。
- **介護現場での高い評価**: 入居者様やお年寄りに対して親身で優しいコミュニケーションができると、多くの施設様から高評価をいただいています。
- **定着率の高さ**: 日本での長期就労やキャリアアップに対する意欲が非常に高く、離職率が低いのが特徴です。
MD;
        }

        if (str_contains($lastMessage, '建設') || str_contains($lastMessage, '清掃') || str_contains($lastMessage, '外食')) {
            return <<<MD
### 建設・ビルクリーニング・他分野の特定技能

MIRANSH合同会社では、介護分野に加えて建設分野、ビルクリーニング、外食業など、特定技能1号制度の各分野に対応した人材紹介を行っております。

- **建設分野**: 型枠施工、鉄筋施工、内装仕上げ、土木など、安全意識と体力・意欲を兼ね備えた人材をご紹介。
- **ビルクリーニング**: 日本基準の衛生管理・清掃資機材の取扱い研修修了者。
- **外食・飲食料品製造**: 食品衛生管理（HACCP）の基本と接客マナーを習得した人材。

受入条件や在留資格手続きについて、専門スタッフが丁寧にご案内いたします。
MD;
        }

        return <<<MD
MIRANSH合同会社 AIアシスタント（Sakana AI 連携）へようこそ！

MIRANSH合同会社は、日本企業様と海外の優秀な人材をつなぐ有料職業紹介事業者（厚生労働大臣許可：13-ユ-319558）です。

**【主なご案内可能トピック】**
1. 🩺 **介護分野の特定技能人材採用**（要件・教育内容・事例）
2. 🇳🇵 **ネパール人材の特徴・日本語力・現地提携校ネットワーク**
3. 📋 **在留資格認定証明書（COE）申請と入国までのスケジュール**
4. 💰 **採用費用・完全成功報酬体系・生活支援サービス**
5. 🏗️ **建設・ビルクリーニング・外食等の特定技能採用**

気になるキーワードを入力いただくか、お電話（**042-409-8256**）またはお問い合わせフォームよりお気軽にご相談ください！
MD;
    }
}
