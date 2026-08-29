@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="hero">

    <div class="container hero-grid">

        <div>

            <div class="lang-en">
                <div class="hero-label">
                    International Human Resources & Student Support
                </div>

                <h1>
                    Connecting Japan<br>
                    with <span>Global Talent</span>
                </h1>

                <p>
                    We at MIRANSH LLC aim to be a bridge between Japan and
                    the international community, contributing to the creation
                    of a beautiful society where all people can help one
                    another and live happily.
                </p>

                <div class="hero-buttons">
                    <a href="#services" class="btn btn-primary">Our Services</a>
                    <a href="tel:042-409-8256" class="btn btn-secondary">Contact Us</a>
                </div>
            </div>

            <div class="lang-ja">
                <div class="hero-label">
                    国際人材紹介・留学生紹介
                </div>

                <h1>
                    日本と世界を<br>
                    <span>つなぐ会社</span>
                </h1>

                <p>
                    ミランス合同会社は、日本と国際社会をつなぐ架け橋となり、
                    すべての人々がお互いに助け合い、幸せに暮らせる美しい社会の
                    実現に貢献することを目指しています。
                </p>

                <div class="hero-buttons">
                    <a href="#services" class="btn btn-primary">サービス</a>
                    <a href="tel:042-409-8256" class="btn btn-secondary">お問い合わせ</a>
                </div>
            </div>

        </div>

        <div class="hero-image">
            <img src="{{ asset('images/abc.jpeg') }}" alt="MIRANSH LLC">
        </div>

    </div>

</section>


{{-- ABOUT --}}
<section id="about">

    <div class="container">

        <div class="section-heading">

            <div class="lang-en">
                <div class="small">About MIRANSH</div>
                <h2>Building Bridges Between Japan and the World</h2>
                <p>Supporting people who want to work, study and build their future in Japan.</p>
            </div>

            <div class="lang-ja">
                <div class="small">MIRANSHについて</div>
                <h2>日本と世界をつなぐ架け橋</h2>
                <p>日本で働きたい、学びたい、将来を築きたい外国人の皆様をサポートします。</p>
            </div>

        </div>

        <div class="about-grid">

            <div class="about-content">

                <div class="lang-en">
                    <h3>MIRANSH LLC</h3>

                    <p>
                        We partner with educational institutions abroad to
                        support foreigners, primarily from Nepal, who have
                        passed the Japanese Language Proficiency Test and/or
                        specific skills tests, or hold a university degree,
                        in their search for employment or study in Japan.
                    </p>

                    <p>
                        We provide support with visa applications,
                        preparations for coming to Japan, and daily life
                        and living support after arriving in Japan.
                    </p>
                </div>

                <div class="lang-ja">
                    <h3>ミランス合同会社</h3>

                    <p>
                        海外の教育機関と連携し、主にネパールをはじめとする
                        外国人の方々を対象に、日本語能力試験（JLPT）や
                        特定技能試験に合格された方、または大学を卒業された方の
                        日本での就職・就学をサポートしています。
                    </p>

                    <p>
                        ビザ申請、日本へ来日するための準備、そして日本での
                        生活・暮らしに関するライフサポートも行っています。
                    </p>
                </div>

            </div>

            <div class="quote-box">

                <div class="lang-en">
                    "We aim to contribute to a beautiful society where
                    all people can help one another and live happily."
                </div>

                <div class="lang-ja">
                    「すべての人々がお互いに助け合い、幸せに暮らせる
                    美しい社会の実現に貢献することを目指しています。」
                </div>

            </div>

        </div>

    </div>

</section>


{{-- SERVICES --}}
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

            <div class="service-card">

                <div class="service-number">01</div>

                <div class="lang-en">
                    <h3>Foreign Worker Recruitment</h3>

                    <p>
                        We help Nepali and other foreign nationals find
                        employment with Japanese companies.
                    </p>

                    <ul>
                        <li>JLPT-qualified candidates</li>
                        <li>Specified Skilled Worker (Tokutei Ginou) candidates</li>
                        <li>University graduates</li>
                        <li>Employment opportunities with Japanese companies</li>
                        <li>Visa application support</li>
                        <li>Preparation for coming to Japan</li>
                        <li>Life and daily living support in Japan</li>
                    </ul>
                </div>

                <div class="lang-ja">
                    <h3>国際人材紹介</h3>

                    <p>
                        日本語能力試験（JLPT）合格者、特定技能
                        （Tokutei Ginou）合格者、または大学卒業者など、
                        ネパールをはじめとする外国人の方々の
                        日本企業への就職をサポートします。
                    </p>

                    <ul>
                        <li>JLPT合格者</li>
                        <li>特定技能（Tokutei Ginou）合格者</li>
                        <li>大学卒業者</li>
                        <li>日本企業への就職支援</li>
                        <li>ビザ申請サポート</li>
                        <li>来日前の準備サポート</li>
                        <li>日本での生活・ライフサポート</li>
                    </ul>
                </div>

            </div>

            <div class="service-card">

                <div class="service-number">02</div>

                <div class="lang-en">
                    <h3>International Student Support</h3>

                    <p>
                        We support foreign students who wish to come to
                        Japan for education by helping them with admission
                        to Japanese educational institutions.
                    </p>

                    <ul>
                        <li>Partnerships with educational institutions in Nepal and other countries</li>
                        <li>Japanese Language School admission support</li>
                        <li>College admission support</li>
                        <li>Study-in-Japan consultation</li>
                        <li>Admission preparation support</li>
                    </ul>
                </div>

                <div class="lang-ja">
                    <h3>留学生紹介</h3>

                    <p>
                        ネパールおよびその他の国の教育機関と連携し、
                        日本で学びたい外国人留学生の皆様の
                        進学・入学をサポートします。
                    </p>

                    <ul>
                        <li>ネパール・海外の教育機関との提携</li>
                        <li>日本語学校への入学支援</li>
                        <li>専門学校・大学等への進学支援</li>
                        <li>日本留学に関する相談</li>
                        <li>入学準備サポート</li>
                    </ul>
                </div>

            </div>

        </div>

    </div>

</section>


{{-- LICENSE --}}
<section class="license">

    <div class="container">

        <div class="section-heading">

            <div class="lang-en">
                <div class="small">Official License</div>
                <h2>Paid Employment Placement Business</h2>
                <p>MIRANSH LLC operates as a licensed paid employment placement business.</p>
            </div>

            <div class="lang-ja">
                <div class="small">許可情報</div>
                <h2>有料職業紹介事業許可</h2>
                <p>ミランス合同会社は、有料職業紹介事業の許可を取得しています。</p>
            </div>

        </div>

        <div class="license-box">

            <div class="lang-en">
                <div class="license-title">Paid Employment Placement Business License</div>
                <div class="license-number">{{ $license ?? '13-ユ-319558' }}</div>
                <div class="license-note">License Number</div>
            </div>

            <div class="lang-ja">
                <div class="license-title">有料職業紹介事業許可</div>
                <div class="license-number">{{ $license ?? '13-ユ-319558' }}</div>
                <div class="license-note">許可番号</div>
            </div>

        </div>

    </div>

</section>


{{-- COMPANY PROFILE --}}
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
                            <span class="lang-en">MIRANSH LLC</span>
                            <span class="lang-ja">ミランス合同会社</span>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            <span class="lang-en">Location</span>
                            <span class="lang-ja">所在地</span>
                        </th>
                        <td>
                            <span class="lang-en">Koganei-shi, Tokyo, Japan</span>
                            <span class="lang-ja">東京都小金井市</span>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            <span class="lang-en">Contact Number</span>
                            <span class="lang-ja">電話番号</span>
                        </th>
                        <td>
                            <a href="tel:042-409-8256">042-409-8256</a>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            <span class="lang-en">Business</span>
                            <span class="lang-ja">事業内容</span>
                        </th>
                        <td>
                            <span class="lang-en">
                                Foreign Worker Recruitment, Visa Support,
                                Life Support, International Student Support
                            </span>
                            <span class="lang-ja">
                                外国人材紹介、ビザサポート、
                                ライフサポート、留学生紹介
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            <span class="lang-en">License</span>
                            <span class="lang-ja">許可番号</span>
                        </th>
                        <td>{{ $license ?? '13-ユ-319558' }}</td>
                    </tr>

                </table>

            </div>

            <div class="ceo-box">

                <div class="ceo-label">
                    <span class="lang-en">Representative / CEO</span>
                    <span class="lang-ja">代表者</span>
                </div>

                <div class="ceo-name">RK Giri</div>

                <div class="ceo-role">
                    <span class="lang-en">CEO / Representative of MIRANSH LLC</span>
                    <span class="lang-ja">ミランス合同会社 代表者</span>
                </div>

            </div>

        </div>

    </div>

</section>


{{-- CONTACT --}}
<section id="contact" class="cta">

    <div class="container">

        <div class="lang-en">
            <h2>Let's Build Your Future in Japan</h2>

            <p>
                Whether you are looking for employment, planning to study
                in Japan, or need visa and life support, MIRANSH LLC is
                here to help.
            </p>

            <a href="tel:042-409-8256" class="btn btn-primary">📞 Contact MIRANSH LLC</a>
        </div>

        <div class="lang-ja">
            <h2>日本での未来を一緒につくりましょう</h2>

            <p>
                日本での就職、留学、ビザ申請、来日前の準備、
                日本での生活サポートなど、お気軽にご相談ください。
            </p>

            <a href="tel:042-409-8256" class="btn btn-primary">📞 ミランス合同会社へお問い合わせ</a>
        </div>

    </div>

</section>

@endsection
