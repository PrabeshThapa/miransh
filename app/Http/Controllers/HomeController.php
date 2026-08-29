<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyInfo;
use App\Models\About;
use App\Models\Service;
use App\Models\Story;
use App\Models\Inquiry;

class HomeController extends Controller
{
    /**
     * Display the home page with comprehensive database content.
     */
    public function index()
    {
        $company = CompanyInfo::first() ?? new CompanyInfo([
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
        ]);

        $about = About::first() ?? new About([
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
        ]);

        $services = Service::orderBy('sort_order', 'asc')->get();
        $stories = Story::orderBy('sort_order', 'asc')->get();

        return view('home', compact('company', 'about', 'services', 'stories'));
    }

    /**
     * Display dedicated service detail page.
     */
    public function serviceDetail($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return redirect()->route('home');
        }
        $company = CompanyInfo::first() ?? new CompanyInfo();
        $allServices = Service::orderBy('sort_order', 'asc')->get();

        return view('service-detail', compact('service', 'company', 'allServices'));
    }

    /**
     * Display dedicated story detail page.
     */
    public function storyDetail($id)
    {
        $story = Story::find($id);
        if (!$story) {
            return redirect()->route('home');
        }
        $company = CompanyInfo::first() ?? new CompanyInfo();
        $allStories = Story::orderBy('sort_order', 'asc')->get();

        return view('story-detail', compact('story', 'company', 'allStories'));
    }

    /**
     * Submit contact form inquiry.
     */
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Inquiry::create([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'service_interest' => $request->service_interest,
            'message' => $request->message,
            'status' => 'unread',
        ]);

        return redirect('/?submitted=true#contact')->with('success', 'お問い合わせありがとうございます。担当者より近日中にご連絡申し上げます。');
    }
}
