<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;
use App\Models\About;
use App\Models\Service;
use App\Models\Story;
use App\Models\Faq;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Company Info
        CompanyInfo::updateOrCreate(
            ['id' => 1],
            [
                'name_en' => 'MIRANSH LLC (MIRANSH Godo Kaisha)',
                'name_ja' => 'MIRANSH合同会社（ミランス合同会社）',
                'corporate_number' => '5012403006691',
                'license' => '有料職業紹介事業許可：13-ユ-319558',
                'corporate_form_en' => 'Limited Liability Company (LLC)',
                'corporate_form_ja' => '合同会社',
                'established_en' => 'August 1, 2024 (Corporate ID Assigned Date)',
                'established_ja' => '2024年8月1日（法人番号指定日）',
                'tagline_en' => 'Bridging Japanese Enterprises and Global Talent with Trust',
                'tagline_ja' => '日本企業と海外人材をつなぐ、信頼の架け橋',
                'location_en' => 'Koganei-shi, Tokyo, Japan',
                'location_ja' => '東京都小金井市',
                'address_en' => 'Room 201, Act Residence Shin-Koganei, 4-8-14 Higashicho, Koganei-shi, Tokyo 184-0011, Japan',
                'address_ja' => '〒184-0011 東京都小金井市東町4丁目8番14号 アクトレジデンス新小金井201号室',
                'phone' => '042-409-8256',
                'email' => 'info@miransh.jp',
                'business_en' => 'Overseas Recruitment & Placement / Specified Skilled Worker (SSW) Support / Onboarding & Immigration Assistance / Living & Workplace Integration Support',
                'business_ja' => '外国人材採用・採用支援 / 特定技能人材支援 / 入国・入社サポート / 外国人材の生活・就労サポート',
                'ceo_name' => 'ギリ ラム クリシュナ (Giri Ram Krishna)',
                'ceo_name_ja' => 'ギリ ラム クリシュナ',
                'ceo_name_en' => 'Giri Ram Krishna',
                'ceo_role_en' => 'Representative Member / CEO',
                'ceo_role_ja' => '代表社員 (CEO)',
                'ceo_image' => '/images/ceo_portrait.jpg',
                'ceo_message_en' => "MIRANSH LLC aspires to be the premier bridge connecting ambitious global talent with trusted Japanese enterprises.\n\nWe deliver talent solutions that ensure candidates work with safety and security, while employers experience tangible value and satisfaction from their hiring decisions.\n\nMoving forward, we will continue expanding our recruitment network in Nepal and beyond, actively addressing labor shortages in Japan while supporting the meaningful career development of international professionals.",
                'ceo_message_ja' => "MIRANSH合同会社は、「日本で働きたい外国人」と「信頼できる人材を必要とする日本企業」をつなぐ架け橋となることを目指しています。\n\n外国人材が日本で安心して働き、企業様にとっても「採用してよかった」と思っていただけるような、高品質な人材サービスを提供してまいります。\n\n今後はネパールを中心とした海外人材ネットワークをさらに強化し、日本企業の人材不足解消と外国人材のキャリア形成に貢献していきます。",
                'hero_title_en' => 'Bridging Japanese Enterprises and',
                'hero_title_accent_en' => 'Global Talent with Trust.',
                'hero_desc_en' => 'Comprehensive recruitment solutions—from overseas hiring, visa procedures, and orientation to long-term post-employment support.',
                'hero_title_ja' => '日本企業と海外人材をつなぐ、',
                'hero_title_accent_ja' => '信頼の架け橋。',
                'hero_desc_ja' => '外国人材の採用から入国・就労、入社後の生活サポートまで、双方に寄り添うトータル人材ソリューション。',
                'hero_image' => '/images/hero_banner.jpg',
                'strengths_tagline_en' => 'Beyond Recruitment — Continuous, High-Touch Support',
                'strengths_tagline_ja' => '人材紹介だけで終わらない、手厚い継続サポート',
                'strengths_desc_en' => 'Hiring foreign talent involves more than just matching resumes; it presents real-world challenges in language barriers, lifestyle adjustments, cultural nuances, workplace communication, and complex immigration procedures. At MIRANSH, we prioritize continuous communication and ongoing follow-up from pre-hiring through long-term employment, ensuring mutual confidence and peace of mind for both employers and candidates.',
                'strengths_desc_ja' => '外国人材の採用では、採用そのものだけでなく、「日本語」「生活習慣」「文化の違い」「職場でのコミュニケーション」「入国・入社に関する手続き」など、さまざまな課題があります。MIRANSH合同会社では、企業様と外国人材の双方が安心して関係を築けるよう、採用前から入社後まで継続的なコミュニケーションとフォローを大切にしています。',
                'footer_text_en' => 'Room 201, Act Residence Shin-Koganei, 4-8-14 Higashicho, Koganei-shi, Tokyo 184-0011, Japan | License No.: 13-ユ-319558',
                'footer_text_ja' => '〒184-0011 東京都小金井市東町4丁目8番14号 アクトレジデンス新小金井201号室 | 許可番号：13-ユ-319558',
            ]
        );

        // 2. Seed About Section
        About::updateOrCreate(
            ['id' => 1],
            [
                'badge_en' => 'About MIRANSH LLC',
                'badge_ja' => 'MIRANSH合同会社について',
                'heading_en' => 'Bridging Japanese Enterprises & International Talent with Complete Lifecycle Support',
                'heading_ja' => '日本企業と海外人材をつなぎ、採用から定着までを伴走支援',
                'subheading_en' => 'Supporting people who want to work, grow, and build their future in Japan.',
                'subheading_ja' => '日本で働きたい外国人材と、信頼できる人材を求める日本企業双方に寄り添うトータルサポート。',
                'title_en' => 'MIRANSH LLC',
                'title_ja' => 'MIRANSH合同会社',
                'desc1_en' => 'MIRANSH LLC provides comprehensive recruitment and lifecycle support services that seamlessly connect Japanese companies with skilled international talent. We assist both employers and candidates at every stage—from recruitment and entry into Japan to workplace integration and daily life support. Specializing particularly in recruiting talent from Nepal, we match qualified personnel to meet diverse enterprise needs, with a strong focus on the caregiving (nursing care) sector.',
                'desc1_ja' => 'MIRANSH合同会社は、日本企業と海外人材をつなぐ人材サポートを中心に、外国人材の採用から入国、入社後の生活・就労まで、企業様と外国人材双方をサポートする会社です。特に、ネパール人材を中心とした外国人材の採用支援に力を入れており、介護分野をはじめ、企業様の人材ニーズに合わせた人材のご紹介・採用支援を行っています。',
                'desc2_en' => 'We believe that true support goes beyond placement. We manage the entire transition: Pre-recruitment → Interviews → Job Offers → Status of Residence (Visa) Processing → Pre-entry Preparation → Onboarding → Continuous Post-employment Follow-up.',
                'desc2_ja' => '単に人材をご紹介するだけではなく、「採用前 → 面接 → 内定 → 在留資格手続き → 入国準備 → 入社 → 入社後のフォロー」まで、企業様と候補者の間に立ち、円滑な受け入れをサポートすることを大切にしています。',
                'quote_en' => '"We aim to contribute to a society where diverse talents thrive together with mutual trust, safety, and long-term fulfillment."',
                'quote_ja' => '「企業様と外国人材が互いに信頼し合い、安心して長く活躍できる社会の実現に貢献します。」',
            ]
        );

        // 3. Seed 4 Core Services
        Service::updateOrCreate(
            ['id' => 1],
            [
                'number_label' => '01',
                'title_en' => 'Global Recruitment Support',
                'title_ja' => '外国人材の採用支援',
                'subtitle_en' => 'Overseas Talent Sourcing & Matching',
                'subtitle_ja' => '企業ニーズに合わせた海外人材の募集・選考・採用',
                'icon' => 'users',
                'image' => '/images/caregiving.jpg',
                'desc_en' => 'Customized recruitment solutions aligning with Japanese corporate needs, from candidate sourcing in Nepal to job interviews and contract finalization.',
                'desc_ja' => '日本企業様の人材ニーズに合わせ、海外人材の募集・選考・面接調整・採用までをトータルでサポートします。',
                'full_content_en' => "We provide thorough recruitment sourcing across accredited educational and vocational training institutes in Nepal and Asia. We assess language proficiency (JLPT N4-N2 / JFT-Basic), vocational suitability, attitude, and eagerness to build a meaningful career in Japan. Our team coordinates online interviews, prepares candidate profiles, and handles candidate engagement up to official job offers.",
                'full_content_ja' => "ネパールをはじめとする海外の優良教育機関・訓練校と連携し、JLPT（N4〜N2）やJFT-Basic合格者、特定技能試験合格者を厳選。企業の業務内容や社風に合わせた候補者の母集団形成から、履歴書精査、オンライン面接の設定、内定後のフォローまでワンストップで伴走します。",
                'items_en' => [
                    'Recruitment support for Specified Skilled Workers (SSW)',
                    'Sourcing and screening candidates in Nepal',
                    'Candidate profile and resume management',
                    'Online interview coordination & translation support',
                    'Candidate engagement and follow-up after job offers'
                ],
                'items_ja' => [
                    '特定技能外国人材の採用支援',
                    'ネパール人材の募集・選考',
                    '履歴書・候補者情報の整理',
                    'オンライン面接の調整・同席サポート',
                    '内定後の候補者フォロー'
                ],
                'workflow_steps_en' => [
                    '1. Enterprise Needs Consultation & Job Requirement Definition',
                    '2. Candidate Sourcing & Pre-screening in Nepal',
                    '3. Resume Verification & Japanese Language Level Check',
                    '4. Web-based Job Interviews with Employer',
                    '5. Official Job Offer & Acceptance Follow-up'
                ],
                'workflow_steps_ja' => [
                    '1. 企業様へのヒアリング・求人要件の明確化',
                    '2. ネパール現地での候補者募集・一次選考',
                    '3. 履歴書の精査・日本語レベルチェック',
                    '4. オンライン面接の実施・通訳サポート',
                    '5. 内定通知および候補者への内定フォロー'
                ],
                'sort_order' => 1,
            ]
        );

        Service::updateOrCreate(
            ['id' => 2],
            [
                'number_label' => '02',
                'title_en' => 'Specified Skilled Worker Onboarding Support',
                'title_ja' => '特定技能人材の受け入れサポート',
                'subtitle_en' => 'Immigration, Visa & Pre-entry Preparation',
                'subtitle_ja' => '在留資格申請・入国スケジュール・事前研修',
                'icon' => 'award',
                'image' => '/images/training_nepal.jpg',
                'desc_en' => 'End-to-end coordination between companies, candidates, and administrative bodies for seamless visa processing and pre-entry orientation.',
                'desc_ja' => '特定技能外国人材の受け入れに必要な各種準備について、企業様・候補者・関係機関との連携を円滑に行います。',
                'full_content_en' => "Navigating immigration standards for Specified Skilled Workers (Tokutei Ginou) requires meticulous documentation. We assist in assembling Status of Residence (COE/Visa) documents, schedule management, pre-departure Japanese cultural & workplace manner orientation, and pre-entry briefings to ensure smooth airport arrival.",
                'full_content_ja' => "特定技能（介護、建設、ビルクリーニング等）の受け入れに必要な在留資格認定証明書（COE）交付申請や各種提出書類の準備を支援。日本入国までのスケジュール管理、現地での事前オリエンテーション、日本の生活・就労ルール教育を徹底し、入国前の不安を解消します。",
                'items_en' => [
                    'Support with visa / Status of Residence application documents',
                    'Entry schedule and immigration milestone management',
                    'Pre-departure cultural & lifestyle orientation',
                    'Pre-entry Japanese language and terminology study support',
                    'Comprehensive briefings for candidates prior to onboarding'
                ],
                'items_ja' => [
                    '在留資格申請に必要な書類準備のサポート',
                    '入国までのスケジュール管理',
                    '入国前オリエンテーション（日本の生活マナー・習慣）',
                    '入国前の日本語学習・専門用語サポート',
                    '入国・入社に向けた候補者への事前説明'
                ],
                'workflow_steps_en' => [
                    '1. Documentation Preparation for Immigration Bureau',
                    '2. Visa / Status of Residence (COE) Application Support',
                    '3. Pre-departure Orientation & Japanese Training in Nepal',
                    '4. Flight & Arrival Logistics Scheduling',
                    '5. Entry into Japan & Reception at Airport'
                ],
                'workflow_steps_ja' => [
                    '1. 出入国在留管理局への申請書類作成・確認支援',
                    '2. 在留資格認定証明書（COE）および査証取得支援',
                    '3. ネパール現地での事前オリエンテーション・研修',
                    '4. 渡航チケット手配・入国スケジュール確定',
                    '5. 日本到着時の空港出迎え・送迎手配'
                ],
                'sort_order' => 2,
            ]
        );

        Service::updateOrCreate(
            ['id' => 3],
            [
                'number_label' => '03',
                'title_en' => 'Post-employment & Living Support',
                'title_ja' => '入社後の外国人材サポート',
                'subtitle_en' => 'Workplace Integration & Life Counseling',
                'subtitle_ja' => '安心の生活相談・職場定着・通訳サポート',
                'icon' => 'heart-handshake',
                'image' => '/images/abc.jpeg',
                'desc_en' => 'Creating an environment where international employees can work comfortably and thrive long-term with daily counseling and employer liaison.',
                'desc_ja' => '外国人材が日本で安心して働き、長く勤務できる環境づくりをサポートします。職場での定着を強力に伴走します。',
                'full_content_en' => "Retention is the true key to successful global recruitment. We assist with city hall registration, bank account setup, housing setup, daily life counseling, workplace communication mediation, and cultural manner orientation, providing multilingual interpretation and translation support whenever required.",
                'full_content_ja' => "入社後の定着こそが人材採用の成否を分ける最重要ポイントです。役所手続き（転入届・マイナンバー）、銀行口座開設、住居契約サポートから、日常の生活相談、職場内コミュニケーションの円滑化、定期的な面談、必要に応じた通訳・翻訳まで手厚く支援します。",
                'items_en' => [
                    'Daily life counseling, administrative & health consultation',
                    'Workplace communication assistance between staff & management',
                    'Ongoing liaison and regular check-ins with employer',
                    'Orientation on Japanese work culture, manners, and workplace rules',
                    'Multilingual interpretation and translation support as needed'
                ],
                'items_ja' => [
                    '生活面の相談・行政手続き・健康管理のサポート',
                    '職場でのコミュニケーションサポート',
                    '企業様との定期的な連絡・状況ヒアリング',
                    '外国人材へのルール・マナー・日本の商習慣説明',
                    '必要に応じた通訳・翻訳サポート（ネパール語・英語・日本語）'
                ],
                'workflow_steps_en' => [
                    '1. Resident Registration & Bank Account Opening',
                    '2. Company Onboarding & Workplace Introduction',
                    '3. Regular Monthly Check-ins & Life Counseling',
                    '4. Workplace Trouble Mediation & Communication Support',
                    '5. Long-term Career Development & Retention Support'
                ],
                'workflow_steps_ja' => [
                    '1. 住民登録・銀行口座開設・生活インフラ立ち上げ',
                    '2. 入社初日オリエンテーション・職場紹介',
                    '3. 定期面談による生活状況・業務習熟度の確認',
                    '4. トラブル防止・職場コミュニケーションの調整',
                    '5. 長期勤続に向けたキャリア相談・定着支援'
                ],
                'sort_order' => 3,
            ]
        );

        Service::updateOrCreate(
            ['id' => 4],
            [
                'number_label' => '04',
                'title_en' => 'Nepali Talent Network',
                'title_ja' => 'ネパール人材ネットワーク',
                'subtitle_en' => 'Direct Academic & Vocational Partnerships',
                'subtitle_ja' => '現地教育機関との強固な連携による優秀層の確保',
                'icon' => 'globe',
                'image' => '/images/construction.jpg',
                'desc_en' => 'Leveraging direct partnerships with educational and vocational institutions in Nepal to source, evaluate, and train dedicated candidates for Japan.',
                'desc_ja' => 'ネパール国内の教育機関・人材関係者等とのネットワークを活用し、日本で働くことを希望する人材の確保・育成に取り組みます。',
                'full_content_en' => "We maintain close direct ties with top universities, Japanese language centers, and specialized vocational training centers across Nepal. We identify candidates who demonstrate earnest dedication, high Japanese language proficiency, strong work ethic, and long-term commitment to contributing to Japanese enterprises.",
                'full_content_ja' => "ネパール現地の大学、日本語学校、特定技能専門訓練機関との直接ネットワークを構築。日本で長く働くことを希望する人材を中心に、日本語運用力・仕事への真面目さ・人物面を厳格にスクリーニングし、日本企業の求める要件に合致する人材を安定的かつ迅速にご案内します。",
                'items_en' => [
                    'Direct alliances with leading colleges and training academies in Nepal',
                    'Evaluation of candidate Japanese proficiency and vocational readiness',
                    'Screening for genuine motivation, work ethic, and character',
                    'Fast-track matching for urgent and specialized staffing demands',
                    'Long-term talent pipeline for Japanese corporations'
                ],
                'items_ja' => [
                    'ネパール国内の優良教育機関・訓練校とのダイレクト連携',
                    '日本語能力（会話力・読解力）および業務適性の事前評価',
                    '就労意欲・勤勉さ・人柄を重視した厳格なスクリーニング',
                    '企業の急募ニーズに応じたスピーディーな人材紹介',
                    '継続的な人材プールによる安定した採用基盤の構築'
                ],
                'workflow_steps_en' => [
                    '1. Needs Assessment with Japanese Employers',
                    '2. Targeted Sourcing across Nepali Academic Institutes',
                    '3. Japanese Language & Skill Level Verification',
                    '4. Pre-interview Briefing & Mock Interviews',
                    '5. Direct Introduction & Employer Matching'
                ],
                'workflow_steps_ja' => [
                    '1. 日本企業様からの採用計画・要件のヒアリング',
                    '2. ネパール現地提携校への募集要項展開・候補者募集',
                    '3. 語学力・人物評価・職歴チェック',
                    '4. 事前面談・模擬面接によるマッチング精度向上',
                    '5. 企業様への候補者推薦・面接セッティング'
                ],
                'sort_order' => 4,
            ]
        );

        // 4. Seed Stories / Case Studies
        Story::updateOrCreate(
            ['id' => 1],
            [
                'title_en' => 'Successful Caregiving Placement in Tokyo Medical Care Facility',
                'title_ja' => '東京都内介護施設様への特定技能（介護）人材採用・定着事例',
                'category_en' => 'Caregiving / SSW',
                'category_ja' => '介護分野・特定技能',
                'summary_en' => 'Two Nepali caregiving professionals joined a Tokyo elderly welfare facility, quickly building warm relationships with residents through intensive Japanese training and continuous life support.',
                'summary_ja' => 'ネパール出身の特定技能（介護）人材2名を採用いただき、事前の介護専門日本語研修と入社後の手厚い生活サポートにより、入居者様からも笑顔で愛されるスタッフとして活躍しています。',
                'content_en' => "Facing persistent staffing challenges, a major care provider in Tokyo turned to MIRANSH for Specified Skilled Worker recruitment. Through our Kathmandu partner academy, candidates completed 6 months of specialized healthcare terminology and cultural training. After arriving in Tokyo, MIRANSH handled ward office registration, furnished accommodation setup, and ongoing monthly visits. The facility administrator reported remarkable satisfaction with the staff's gentle bedside manner, diligence, and punctuality.",
                'content_ja' => "深刻な人材不足を抱えていた東京都内の特別養護老人ホーム様において、特定技能外国人の受け入れを決定。現地での介護専門用語研修とN3相当の日本語教育を修了した優秀な人材2名を採用いただきました。入国時は小金井エリアでの住居手配から各種手続きまでMIRANSHがフルサポート。施設管理者様からは「礼儀正しく、お年寄りに対してとても親身に接してくれる」と高い評価をいただいております。",
                'image' => '/images/caregiving.jpg',
                'published_date' => '2024.11.20',
                'author' => 'MIRANSH Editorial Team',
                'featured' => true,
                'sort_order' => 1,
            ]
        );

        Story::updateOrCreate(
            ['id' => 2],
            [
                'title_en' => 'Pre-departure Japanese Training & Business Manners in Nepal',
                'title_ja' => 'ネパール現地教育機関との連携による日本語・ビジネスマナー研修',
                'category_en' => 'Talent Network',
                'category_ja' => '人材育成・現地連携',
                'summary_en' => 'Strengthening our academic network in Kathmandu to provide tailored business etiquette, 5S principles, and practical conversational fluency before departure.',
                'summary_ja' => 'カトマンズの提携教育機関にて、日本のビジネスマナー、5S（整理・整頓・清掃・清潔・躾）、実践的な職場会話に特化した渡航前集中プログラムを展開しています。',
                'content_en' => "To ensure foreign professionals adapt quickly to Japanese corporate culture, MIRANSH collaborates directly with vocational academies in Nepal. Our curriculum emphasizes Japanese workplace communication, greeting standards (Aisatsu), time management (Hou-Ren-So), and sector-specific terminology.",
                'content_ja' => "MIRANSHでは、単なる試験対策にとどまらず、日本の職場ですぐに役立つ実践的な教育プログラムを提供しています。報連相（報告・連絡・相談）の徹底や時間厳守、挨拶のマナーなど、日本の労働環境で不可欠な価値観を渡航前からしっかりと身につけていただきます。",
                'image' => '/images/training_nepal.jpg',
                'published_date' => '2024.12.05',
                'author' => 'MIRANSH Editorial Team',
                'featured' => true,
                'sort_order' => 2,
            ]
        );

        Story::updateOrCreate(
            ['id' => 3],
            [
                'title_en' => 'End-to-End Specified Skilled Worker Visa Processing & Life Setup',
                'title_ja' => '在留資格申請から生活立ち上げまで安心のワンストップサポート',
                'category_en' => 'Onboarding & Life Support',
                'category_ja' => '生活支援・定着サポート',
                'summary_en' => 'Eliminating administrative complexity for Japanese employers with full visa documentation, residential setup, and 24/7 multilingual consultation.',
                'summary_ja' => '企業様が抱える複雑な在留資格申請書類の準備負担を軽減し、住居契約、銀行口座開設、生活オリエンテーションまでトータルで支援します。',
                'content_en' => "Administrative procedures can be daunting for small and medium-sized enterprises. MIRANSH coordinates all immigration paperwork with precision, arranges airport pickups, assists with mobile phone and municipal registrations, and maintains an emergency hotline for candidates.",
                'content_ja' => "中小企業様にとって負担となりがちな出入国在留管理局への各種申請書類の準備をきめ細かくバックアップ。入国後は小金井市周辺をはじめとする首都圏エリアでの生活基盤立ち上げをスムーズに行い、外国人材が初日から安心して業務に専念できる体制を整えています。",
                'image' => '/images/story1.jpg',
                'published_date' => '2025.01.10',
                'author' => 'MIRANSH Editorial Team',
                'featured' => true,
                'sort_order' => 3,
            ]
        );

        // 5. Seed FAQs
        $faqs = [
            [
                'id' => 1,
                'category_ja' => '特定技能・在留資格',
                'category_en' => 'Specified Skilled Worker (SSW)',
                'question_ja' => '特定技能外国人を受け入れるための基本的な要件や試験は何ですか？',
                'question_en' => 'What are the fundamental requirements and exams for hiring Specified Skilled Workers (SSW)?',
                'answer_ja' => '特定技能1号の在留資格を取得するには、①各特定産業分野の「技能測定試験」および②「日本語能力試験（JLPT N4以上または国際交流基金日本語基礎テスト JFT-Basic）」の両方に合格している必要があります。MIRANSHでは、試験合格済みの即戦力候補者をネパール現地提携校等から厳選してご紹介いたします。',
                'answer_en' => 'To obtain a Status of Residence for Specified Skilled Worker (i), candidates must pass: 1) The relevant sector skill assessment exam, and 2) A Japanese proficiency test (JLPT N4 or higher, or JFT-Basic). MIRANSH sources pre-qualified candidates who have already passed both exams through our accredited educational partners in Nepal.',
                'sort_order' => 1,
            ],
            [
                'id' => 2,
                'category_ja' => 'ネパール人材・語学力',
                'category_en' => 'Nepali Talent & Language',
                'question_ja' => 'ネパール人スタッフの特徴や職場での適性、日本語力はどうですか？',
                'question_en' => 'What are the characteristics, workplace suitability, and Japanese language proficiency of Nepali talent?',
                'answer_ja' => 'ネパール人材は親日家が多く、真面目で温厚、敬語や礼儀作法を重んじる文化背景を持っています。文法構造が日本語と類似しているため日本語の習得が非常に早く、特に介護現場ではお年寄りに対して優しく気配りのできるコミュニケーションが高く評価されています。N3〜N2レベルの即戦力層も多数在籍しています。',
                'answer_en' => 'Nepali professionals are known for their warm disposition, strong work ethic, politeness, and high respect for Japanese cultural values. Because Nepali and Japanese share similar SOV grammatical structures, candidates acquire spoken and written Japanese rapidly. They are especially praised in elderly care and hospitality for their kindness and patience.',
                'sort_order' => 2,
            ],
            [
                'id' => 3,
                'category_ja' => '介護分野の採用',
                'category_en' => 'Caregiving Sector',
                'question_ja' => '介護分野での特定技能人材の採用において、どのような業務を担当できますか？',
                'question_en' => 'What tasks can Specified Skilled Workers in the Caregiving (Nursing Care) sector perform?',
                'answer_ja' => '食事介助、入浴介助、排泄介助、移動・移乗介助などの身体介護に加え、レクリエーションの企画・運営、配膳・清掃などの付随業務を担当できます。入社後実務経験3年を経て日本の「介護福祉士（国家資格）」の取得を目指すキャリアパスも整備されており、長期就労と人材定着が期待できます。',
                'answer_en' => 'SSW caregiving staff perform physical care (assistance with meals, bathing, excretion, and mobility) as well as accompanying recreational activities, functional training assistance, and facility operations. They can also work towards passing the national certified care worker (Kaigofukushishi) exam after 3 years for indefinite long-term career progression.',
                'sort_order' => 3,
            ],
            [
                'id' => 4,
                'category_ja' => '費用・契約・スケジュール',
                'category_en' => 'Recruitment Timeline & Process',
                'question_ja' => '求人依頼から内定、日本入国・就労開始までどのくらいの期間がかかりますか？',
                'question_en' => 'How long does the process take from initial job order to arrival in Japan and starting work?',
                'answer_ja' => '求人要件のヒアリングから候補者選定・面接・内定まで約2〜4週間、その後出入国在留管理局への在留資格認定証明書（COE）交付申請から査証発給・渡航準備まで約3〜4ヶ月、合計でおよそ3〜5ヶ月が標準的なスケジュールとなります。急募のご相談や国内転職者のご紹介も柔軟に対応いたします。',
                'answer_en' => 'The standard timeline is typically 3 to 5 months total: 2-4 weeks for requirements briefing, candidate screening, interviews, and official job offer; followed by 3-4 months for immigration Certificate of Eligibility (COE) processing, visa issuance, and arrival coordination. Accelerated placement for candidates currently in Japan is also available.',
                'sort_order' => 4,
            ],
            [
                'id' => 5,
                'category_ja' => '入国・生活支援・定着',
                'category_en' => 'Onboarding & Living Support',
                'question_ja' => '入国後の住居手配や市区町村での住民登録、銀行口座開設などもサポートしてもらえますか？',
                'question_en' => 'Do you provide support for airport pickup, apartment leasing, city hall registration, and bank setup?',
                'answer_ja' => 'はい、MIRANSHが空港でのお出迎えから社宅・アパートの賃貸契約サポート、市区町村窓口での転入届・マイナンバー手続き、銀行口座の開設、携帯電話の契約、生活ルール・ゴミ出しマナーの指導まで、専任スタッフがすべてワンストップで伴走いたします。企業様の手間を最小限に抑えます。',
                'answer_en' => 'Yes. MIRANSH provides full turnkey support, including airport reception, furnished apartment assistance, resident registration at city hall, Individual Number (My Number) procedures, bank account opening, SIM card/phone setup, and neighborhood orientation to ensure a smooth, worry-free start.',
                'sort_order' => 5,
            ],
            [
                'id' => 6,
                'category_ja' => '入国・生活支援・定着',
                'category_en' => 'Onboarding & Living Support',
                'question_ja' => '入社後に職場で言葉の壁や生活トラブルが発生した場合のフォロー体制はありますか？',
                'question_en' => 'What follow-up and emergency consultation systems are in place after the candidate starts working?',
                'answer_ja' => 'MIRANSHでは入社後も定期的な面談（月次チェックイン）を実施し、業務上の課題や生活面の不安をヒアリングします。ネパール語・英語・日本語のバイリンガルスタッフが常駐しており、緊急時の連絡体制や職場コミュニケーションの仲介通訳も万全の体制でサポートいたします。',
                'answer_en' => 'We conduct regular monthly check-ins and structured one-on-one counseling. Our bilingual team (Japanese, Nepali, English) maintains an active hotline to assist with any workplace communication mediation, medical consultations, or lifestyle adjustments, preventing misunderstandings before they occur.',
                'sort_order' => 6,
            ],
            [
                'id' => 7,
                'category_ja' => '費用・契約・スケジュール',
                'category_en' => 'Fees & Commercial Terms',
                'question_ja' => '人材紹介の料金体系や初期費用について教えてください。',
                'question_en' => 'What is the fee structure and commercial terms for recruitment services?',
                'answer_ja' => 'MIRANSHの人材紹介は「完全成功報酬型」となっており、候補者の内定・日本入国・初日出社が確定するまで紹介手数料は発生いたしません。ご相談やお見積り、候補者のプロフィール閲覧やオンライン面接のセッティングはすべて無料です。早期退職時の返金規定（リファンドポリシー）も完備しています。',
                'answer_en' => 'Our overseas recruitment operates on a contingency-success basis—no placement fees are charged until the candidate successfully receives their visa and commences employment. Consultations, candidate profile evaluations, and web interviews are entirely free. We also include clear prorated refund guarantees for early departures.',
                'sort_order' => 7,
            ],
            [
                'id' => 8,
                'category_ja' => '特定技能・在留資格',
                'category_en' => 'Consultation & First-time Hiring',
                'question_ja' => '初めて外国人材を採用する企業ですが、制度の説明や社内受け入れ体制の相談は可能ですか？',
                'question_en' => 'We are considering hiring foreign staff for the first time. Can you provide guidance on institutional compliance?',
                'answer_ja' => '大歓迎です。初めて外国人材を受け入れる企業様向けに、特定技能制度の全体像、労働基準法や雇用保険の適用ルール、社内マニュアルの作成ポイント、受入れ事例を分かりやすくご案内する個別オンライン相談会（全国対応）を無料で開催しております。お気軽にお問い合わせください。',
                'answer_en' => 'Absolutely. We specialize in assisting first-time employers with comprehensive orientations on immigration legal frameworks, labor compliance, workplace manual preparation, and best practices from our proven placement track record. Free online video consultations are available nationwide across Japan.',
                'sort_order' => 8,
            ],
        ];

        foreach ($faqs as $faqData) {
            Faq::updateOrCreate(['id' => $faqData['id']], $faqData);
        }

        // 6. Seed Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@miransh.jp'],
            [
                'name' => 'admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
    }
}
