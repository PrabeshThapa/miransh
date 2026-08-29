<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;
use App\Models\About;
use App\Models\Service;
use App\Models\Story;
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
                'ceo_role_en' => 'Representative Member',
                'ceo_role_ja' => '代表社員',
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

        // 5. Seed Default Admin User
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
