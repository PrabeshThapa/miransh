<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;
use App\Models\About;
use App\Models\Service;

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
                'name_en' => 'MIRANSH LLC',
                'name_ja' => 'ミランス合同会社',
                'tagline_en' => 'International Human Resources & Student Support',
                'tagline_ja' => '国際人材紹介・留学生紹介',
                'location_en' => 'Koganei-shi, Tokyo, Japan',
                'location_ja' => '東京都小金井市',
                'phone' => '042-409-8256',
                'business_en' => 'Foreign Worker Recruitment, Visa Support, Life Support, International Student Support',
                'business_ja' => '外国人材紹介、ビザサポート、ライフサポート、留学生紹介',
                'license' => '13-ユ-319558',
                'ceo_name' => 'RK Giri',
                'ceo_role_en' => 'CEO / Representative of MIRANSH LLC',
                'ceo_role_ja' => 'ミランス合同会社 代表者',
                'hero_title_en' => 'Connecting Japan',
                'hero_title_accent_en' => 'Global Talent',
                'hero_desc_en' => 'We at MIRANSH LLC aim to be a bridge between Japan and the international community, contributing to the creation of a beautiful society where all people can help one another and live happily.',
                'hero_title_ja' => '日本と世界を',
                'hero_title_accent_ja' => 'つなぐ会社',
                'hero_desc_ja' => 'ミランス合同会社は、日本と国際社会をつなぐ架け橋となり、すべての人々がお互いに助け合い、幸せに暮らせる美しい社会の実現に貢献することを目指しています。',
                'hero_image' => '/images/abc.jpeg',
                'footer_text_en' => 'International Human Resources & Student Support. Connecting Japan with international talent and students.',
                'footer_text_ja' => '国際人材紹介・留学生紹介。日本と世界の人材・留学生をつなぎます。',
            ]
        );

        // 2. Seed About Section
        About::updateOrCreate(
            ['id' => 1],
            [
                'badge_en' => 'About MIRANSH',
                'badge_ja' => 'MIRANSHについて',
                'heading_en' => 'Building Bridges Between Japan and the World',
                'heading_ja' => '日本と世界をつなぐ架け橋',
                'subheading_en' => 'Supporting people who want to work, study and build their future in Japan.',
                'subheading_ja' => '日本で働きたい、学びたい、将来を築きたい外国人の皆様をサポートします。',
                'title_en' => 'MIRANSH LLC',
                'title_ja' => 'ミランス合同会社',
                'desc1_en' => 'We partner with educational institutions abroad to support foreigners, primarily from Nepal, who have passed the Japanese Language Proficiency Test and/or specific skills tests, or hold a university degree, in their search for employment or study in Japan.',
                'desc1_ja' => '海外の教育機関と連携し、主にネパールをはじめとする外国人の方々を対象に、日本語能力試験（JLPT）や特定技能試験に合格された方、または大学を卒業された方の日本での就職・就学をサポートしています。',
                'desc2_en' => 'We provide support with visa applications, preparations for coming to Japan, and daily life and living support after arriving in Japan.',
                'desc2_ja' => 'ビザ申請、日本へ来日するための準備、そして日本での生活・暮らしに関するライフサポートも行っています。',
                'quote_en' => '"We aim to contribute to a beautiful society where all people can help one another and live happily."',
                'quote_ja' => '「すべての人々がお互いに助け合い、幸せに暮らせる美しい社会の実現に貢献することを目指しています。」',
            ]
        );

        // 3. Seed Services
        Service::updateOrCreate(
            ['id' => 1],
            [
                'number_label' => '01',
                'title_en' => 'Foreign Worker Recruitment',
                'title_ja' => '国際人材紹介',
                'desc_en' => 'We help Nepali and other foreign nationals find employment with Japanese companies.',
                'desc_ja' => '日本語能力試験（JLPT）合格者、特定技能（Tokutei Ginou）合格者、または大学卒業者など、ネパールをはじめとする外国人の方々の日本企業への就職をサポートします。',
                'items_en' => [
                    'JLPT-qualified candidates',
                    'Specified Skilled Worker (Tokutei Ginou) candidates',
                    'University graduates',
                    'Employment opportunities with Japanese companies',
                    'Visa application support',
                    'Preparation for coming to Japan',
                    'Life and daily living support in Japan'
                ],
                'items_ja' => [
                    'JLPT合格者',
                    '特定技能（Tokutei Ginou）合格者',
                    '大学卒業者',
                    '日本企業への就職支援',
                    'ビザ申請サポート',
                    '来日前の準備サポート',
                    '日本での生活・ライフサポート'
                ],
                'sort_order' => 1,
            ]
        );

        Service::updateOrCreate(
            ['id' => 2],
            [
                'number_label' => '02',
                'title_en' => 'International Student Support',
                'title_ja' => '留学生紹介',
                'desc_en' => 'We support foreign students who wish to come to Japan for education by helping them with admission to Japanese educational institutions.',
                'desc_ja' => 'ネパールおよびその他の国の教育機関と連携し、日本で学びたい外国人留学生の皆様の進学・入学をサポートします。',
                'items_en' => [
                    'Partnerships with educational institutions in Nepal and other countries',
                    'Japanese Language School admission support',
                    'College admission support',
                    'Study-in-Japan consultation',
                    'Admission preparation support'
                ],
                'items_ja' => [
                    'ネパール・海外の教育機関との提携',
                    '日本語学校への入学支援',
                    '専門学校・大学等への進学支援',
                    '日本留学に関する相談',
                    '入学準備サポート'
                ],
                'sort_order' => 2,
            ]
        );

        // 4. Seed Default Admin User
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@miransh.jp'],
            [
                'name' => 'admin',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
    }
}
