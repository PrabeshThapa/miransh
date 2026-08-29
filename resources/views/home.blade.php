@extends('layouts.app')

@section('content')

    <!-- HERO -->
    <section class="hero" id="top">

        <div class="container hero-grid">

            <div>

                <div class="lang-en">
                    <div class="hero-label">
                        {{ $company->tagline_en ?? 'International Human Resources & Student Support' }}
                    </div>

                    <h1>
                        {{ $company->hero_title_en ?? 'Connecting Japan' }}<br>
                        with <span>{{ $company->hero_title_accent_en ?? 'Global Talent' }}</span>
                    </h1>

                    <p>
                        {{ $company->hero_desc_en ?? 'We at MIRANSH LLC aim to be a bridge between Japan and the international community, contributing to the creation of a beautiful society where all people can help one another and live happily.' }}
                    </p>

                    <div class="hero-buttons">
                        <a href="#services" class="btn btn-primary" id="btn-services-en">Our Services</a>
                        <a href="tel:{{ $company->phone ?? '042-409-8256' }}" class="btn btn-secondary" id="btn-contact-en">Contact Us</a>
                    </div>
                </div>

                <div class="lang-ja">
                    <div class="hero-label">
                        {{ $company->tagline_ja ?? '国際人材紹介・留学生紹介' }}
                    </div>

                    <h1>
                        {{ $company->hero_title_ja ?? '日本と世界を' }}<br>
                        <span>{{ $company->hero_title_accent_ja ?? 'つなぐ会社' }}</span>
                    </h1>

                    <p>
                        {{ $company->hero_desc_ja ?? 'ミランス合同会社は、日本と国際社会をつなぐ架け橋となり、すべての人々がお互いに助け合い、幸せに暮らせる美しい社会の実現に貢献することを目指しています。' }}
                    </p>

                    <div class="hero-buttons">
                        <a href="#services" class="btn btn-primary" id="btn-services-ja">サービス</a>
                        <a href="tel:{{ $company->phone ?? '042-409-8256' }}" class="btn btn-secondary" id="btn-contact-ja">お問い合わせ</a>
                    </div>
                </div>

            </div>

            <div class="hero-image">
                <img src="{{ asset($company->hero_image ?? 'images/abc.jpeg') }}" alt="{{ $company->name_en ?? 'MIRANSH LLC' }}">
            </div>

        </div>

    </section>


    <!-- ABOUT -->
    <section id="about">

        <div class="container">

            <div class="section-heading">

                <div class="lang-en">
                    <div class="small">{{ $about->badge_en ?? 'About MIRANSH' }}</div>
                    <h2>{{ $about->heading_en ?? 'Building Bridges Between Japan and the World' }}</h2>
                    <p>{{ $about->subheading_en ?? 'Supporting people who want to work, study and build their future in Japan.' }}</p>
                </div>

                <div class="lang-ja">
                    <div class="small">{{ $about->badge_ja ?? 'MIRANSHについて' }}</div>
                    <h2>{{ $about->heading_ja ?? '日本と世界をつなぐ架け橋' }}</h2>
                    <p>{{ $about->subheading_ja ?? '日本で働きたい、学びたい、将来を築きたい外国人の皆様をサポートします。' }}</p>
                </div>

            </div>

            <div class="about-grid">

                <div class="about-content">

                    <div class="lang-en">
                        <h3>{{ $about->title_en ?? 'MIRANSH LLC' }}</h3>

                        <p>
                            {{ $about->desc1_en ?? 'We partner with educational institutions abroad to support foreigners, primarily from Nepal, who have passed the Japanese Language Proficiency Test and/or specific skills tests, or hold a university degree, in their search for employment or study in Japan.' }}
                        </p>

                        <p>
                            {{ $about->desc2_en ?? 'We provide support with visa applications, preparations for coming to Japan, and daily life and living support after arriving in Japan.' }}
                        </p>
                    </div>

                    <div class="lang-ja">
                        <h3>{{ $about->title_ja ?? 'ミランス合同会社' }}</h3>

                        <p>
                            {{ $about->desc1_ja ?? '海外の教育機関と連携し、主にネパールをはじめとする外国人の方々を対象に、日本語能力試験（JLPT）や特定技能試験に合格された方、または大学を卒業された方の日本での就職・就学をサポートしています。' }}
                        </p>

                        <p>
                            {{ $about->desc2_ja ?? 'ビザ申請、日本へ来日するための準備、そして日本での生活・暮らしに関するライフサポートも行っています。' }}
                        </p>
                    </div>

                </div>

                <div class="quote-box">

                    <div class="lang-en">
                        {{ $about->quote_en ?? '"We aim to contribute to a beautiful society where all people can help one another and live happily."' }}
                    </div>

                    <div class="lang-ja">
                        {{ $about->quote_ja ?? '「すべての人々がお互いに助け合い、幸せに暮らせる美しい社会の実現に貢献することを目指しています。」' }}
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- SERVICES -->
    <section id="services" class="services">

        <div class="container">

            <div class="section-heading">

                <div class="lang-en">
                    <div class="small">What We Do</div>
                    <h2>Our Services</h2>
                    <p>Comprehensive support for foreign workers and international students.</p>
                </div>

                <div class="lang-ja">
                    <div class="small">事業内容</div>
                    <h2>サービス</h2>
                    <p>外国人材と留学生の皆様を総合的にサポートします。</p>
                </div>

            </div>

            <div class="service-grid">

                @foreach($services as $index => $service)
                    <div class="service-card" id="service-card-{{ $service->id }}">

                        <div class="service-number">{{ $service->number_label ?? sprintf('%02d', $index + 1) }}</div>

                        <div class="lang-en">
                            <h3>{{ $service->title_en }}</h3>

                            <p>{{ $service->desc_en }}</p>

                            @if(!empty($service->items_en) && is_array($service->items_en))
                                <ul>
                                    @foreach($service->items_en as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="lang-ja">
                            <h3>{{ $service->title_ja }}</h3>

                            <p>{{ $service->desc_ja }}</p>

                            @if(!empty($service->items_ja) && is_array($service->items_ja))
                                <ul>
                                    @foreach($service->items_ja as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>


    <!-- LICENSE -->
    <section class="license">

        <div class="container">

            <div class="section-heading">

                <div class="lang-en">
                    <div class="small">Official License</div>
                    <h2>Paid Employment Placement Business</h2>
                    <p>{{ $company->name_en ?? 'MIRANSH LLC' }} operates as a licensed paid employment placement business.</p>
                </div>

                <div class="lang-ja">
                    <div class="small">許可情報</div>
                    <h2>有料職業紹介事業許可</h2>
                    <p>{{ $company->name_ja ?? 'ミランス合同会社' }}は、有料職業紹介事業の許可を取得しています。</p>
                </div>

            </div>

            <div class="license-box">

                <div class="lang-en">
                    <div class="license-title">Paid Employment Placement Business License</div>
                    <div class="license-number">{{ $company->license ?? '13-ユ-319558' }}</div>
                    <div class="license-note">License Number</div>
                </div>

                <div class="lang-ja">
                    <div class="license-title">有料職業紹介事業許可</div>
                    <div class="license-number">{{ $company->license ?? '13-ユ-319558' }}</div>
                    <div class="license-note">許可番号</div>
                </div>

            </div>

        </div>

    </section>


    <!-- COMPANY PROFILE -->
    <section id="company">

        <div class="container">

            <div class="section-heading">

                <div class="lang-en">
                    <div class="small">Company Profile</div>
                    <h2>Company Details</h2>
                </div>

                <div class="lang-ja">
                    <div class="small">会社概要</div>
                    <h2>会社情報</h2>
                </div>

            </div>

            <div class="company-grid">

                <div>

                    <table class="company-table">

                        <tr>
                            <th>
                                <span class="lang-en">Company Name</span>
                                <span class="lang-ja">会社名</span>
                            </th>
                            <td>
                                <span class="lang-en">{{ $company->name_en ?? 'MIRANSH LLC' }}</span>
                                <span class="lang-ja">{{ $company->name_ja ?? 'ミランス合同会社' }}</span>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <span class="lang-en">Location</span>
                                <span class="lang-ja">所在地</span>
                            </th>
                            <td>
                                <span class="lang-en">{{ $company->location_en ?? 'Koganei-shi, Tokyo, Japan' }}</span>
                                <span class="lang-ja">{{ $company->location_ja ?? '東京都小金井市' }}</span>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <span class="lang-en">Contact Number</span>
                                <span class="lang-ja">電話番号</span>
                            </th>
                            <td>
                                <a href="tel:{{ $company->phone ?? '042-409-8256' }}">{{ $company->phone ?? '042-409-8256' }}</a>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <span class="lang-en">Business</span>
                                <span class="lang-ja">事業内容</span>
                            </th>
                            <td>
                                <span class="lang-en">
                                    {{ $company->business_en ?? 'Foreign Worker Recruitment, Visa Support, Life Support, International Student Support' }}
                                </span>
                                <span class="lang-ja">
                                    {{ $company->business_ja ?? '外国人材紹介、ビザサポート、ライフサポート、留学生紹介' }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <span class="lang-en">License</span>
                                <span class="lang-ja">許可番号</span>
                            </th>
                            <td>{{ $company->license ?? '13-ユ-319558' }}</td>
                        </tr>

                    </table>

                </div>

                <div class="ceo-box">

                    <div class="ceo-label">
                        <span class="lang-en">Representative / CEO</span>
                        <span class="lang-ja">代表者</span>
                    </div>

                    <div class="ceo-name">{{ $company->ceo_name ?? 'RK Giri' }}</div>

                    <div class="ceo-role">
                        <span class="lang-en">{{ $company->ceo_role_en ?? 'CEO / Representative of MIRANSH LLC' }}</span>
                        <span class="lang-ja">{{ $company->ceo_role_ja ?? 'ミランス合同会社 代表者' }}</span>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- CONTACT -->
    <section id="contact" class="cta">

        <div class="container">

            <div class="lang-en">
                <h2>Let's Build Your Future in Japan</h2>

                <p>
                    Whether you are looking for employment, planning to study
                    in Japan, or need visa and life support, {{ $company->name_en ?? 'MIRANSH LLC' }} is
                    here to help.
                </p>

                <a href="tel:{{ $company->phone ?? '042-409-8256' }}" class="btn btn-primary">📞 Contact {{ $company->name_en ?? 'MIRANSH LLC' }}</a>
            </div>

            <div class="lang-ja">
                <h2>日本での未来を一緒につくりましょう</h2>

                <p>
                    日本での就職、留学、ビザ申請、来日前の準備、
                    日本での生活サポートなど、お気軽にご相談ください。
                </p>

                <a href="tel:{{ $company->phone ?? '042-409-8256' }}" class="btn btn-primary">📞 {{ $company->name_ja ?? 'ミランス合同会社' }}へお問い合わせ</a>
            </div>

        </div>

    </section>

@endsection
