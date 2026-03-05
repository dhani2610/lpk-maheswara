<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->site_name ?? 'LPK Maheswara' }} | Lembaga Pelatihan Kerja Terpercaya</title>
    @if (isset($setting) && $setting->logo)
        <link rel="icon" href="{{ asset('storage/' . $setting->logo) }}" type="image/png">
    @else
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" type="image/png">
    @endif

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        /* --- ROOT VARS & CUSTOM CSS --- */
        :root {
            --primary-red: #c62828;
            --dark-red: #8e0000;
            --light-red-bg: #fff5f5;
            --white: #ffffff;
            --text-dark: #2d3436;
            --text-muted: #636e72;
        }

       /* --- HIDE GOOGLE TRANSLATE WIDGET COMPLETELY --- */

        /* 1. Sembunyikan elemen utama & iframe banner atas */
        #google_translate_element,
        .goog-te-banner-frame.skiptranslate,
        .goog-te-banner-frame {
            display: none !important;
        }

        /* 2. Class acak terbaru dari Google (Popup atas) */
        .VIpgJd-ZVi9od-ORHb-OEVmcd,
        .VIpgJd-ZVi9od-ORHb {
            display: none !important;
            visibility: hidden !important;
        }

        /* 3. Cegah body dan html bergeser turun (Gap kosong di atas header) */
        body {
            top: 0px !important;
            position: static !important;
        }
        html {
            margin-top: 0px !important;
            height: 100% !important;
        }

        /* 4. Sembunyikan Tooltip / Hover box kuning khas Google */
        #goog-gt-tt,
        .goog-tooltip,
        .goog-tooltip:hover {
            display: none !important;
        }
        .goog-text-highlight {
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        body {
            top: 0px !important;
        }

        .goog-tooltip {
            display: none !important;
        }

        .goog-tooltip:hover {
            display: none !important;
        }

        .goog-text-highlight {
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Utilities */
        .text-primary-red {
            color: var(--primary-red) !important;
        }

        .bg-primary-red {
            background-color: var(--primary-red) !important;
        }

        .bg-light-red {
            background-color: var(--light-red-bg) !important;
        }

        /* Typography Elegance */
        .section-subtitle {
            color: var(--primary-red);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 10px;
        }

        .section-title {
            font-weight: 800;
            color: var(--text-dark);
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 4px;
            background-color: var(--primary-red);
            border-radius: 2px;
        }

        .text-center .section-title::after {
            left: 50%;
            transform: translateX(-50%);
        }

        /* Buttons */
        .btn-primary-red {
            background-color: var(--primary-red);
            color: var(--white);
            border: 2px solid var(--primary-red);
            padding: 10px 28px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(198, 40, 40, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-red:hover {
            background-color: transparent;
            color: var(--primary-red);
            box-shadow: none;
        }

        .btn-outline-red {
            background-color: transparent;
            color: var(--primary-red);
            border: 2px solid var(--primary-red);
            padding: 10px 28px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-outline-red:hover {
            background-color: var(--primary-red);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(198, 40, 40, 0.3);
        }

        /* Navbar */
        .navbar {
            transition: all 0.3s ease;
            padding: 20px 0;
        }

        .navbar.scrolled {
            padding: 10px 0;
            background-color: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand span {
            font-weight: 800;
            color: var(--primary-red);
            letter-spacing: 1px;
        }

        .nav-link {
            font-weight: 600;
            color: var(--text-dark);
            padding: 10px 15px !important;
            transition: 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-red) !important;
        }

        /* Hero Slider */
        .carousel-item {
            height: 100vh;
            min-height: 600px;
            background: no-repeat center center scroll;
            background-size: cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(142, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.8) 100%);
        }

        .carousel-caption {
            bottom: 0;
            top: 0;
            display: flex !important;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 10;
        }

        .carousel-caption h1 {
            font-weight: 800;
            font-size: 3.5rem;
            letter-spacing: -1px;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.4);
            line-height: 1.2;
        }

        .carousel-caption p {
            font-size: 1.2rem;
            max-width: 700px;
            font-weight: 300;
            text-shadow: 1px 2px 4px rgba(0, 0, 0, 0.4);
            margin-top: 20px;
        }

        /* Tentang Kami */
        .about-img-wrapper {
            position: relative;
            z-index: 1;
        }

        .about-img-wrapper::before {
            content: '';
            position: absolute;
            top: 30px;
            left: -30px;
            width: 100%;
            height: 100%;
            background-color: var(--primary-red);
            border-radius: 12px;
            z-index: -1;
            opacity: 0.8;
        }

        .about-img-wrapper img {
            border-radius: 12px;
        }

        /* Card Program */
        .card-program {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
            overflow: hidden;
            background: var(--white);
            cursor: pointer;
        }

        .card-program:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(198, 40, 40, 0.15);
        }

        .card-img-wrapper {
            position: relative;
            overflow: hidden;
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card-program:hover .card-img-top {
            transform: scale(1.1);
        }

        .card-body {
            padding: 2rem;
        }

        .program-link {
            color: var(--primary-red);
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: 0.3s;
            background: none;
            border: none;
            padding: 0;
        }

        .program-link i {
            margin-left: 8px;
            transition: 0.3s;
        }

        .program-link:hover i {
            transform: translateX(5px);
        }

        /* Modal Program Content Image Fix */
        .content-html img {
            max-width: 100%;
            height: auto !important;
            border-radius: 8px;
        }

        /* Gallery */
        .gallery-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
        }

        .gallery-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(198, 40, 40, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .gallery-overlay i {
            color: var(--white);
            font-size: 2rem;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .gallery-item:hover .gallery-img {
            transform: scale(1.1);
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-item:hover .gallery-overlay i {
            transform: translateY(0);
        }

        .gallery-extra {
            display: none;
        }

        /* Contact Section */
        .contact-icon-box {
            width: 50px;
            height: 50px;
            background-color: var(--white);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-right: 20px;
            flex-shrink: 0;
        }

        .contact-icon-box i {
            color: var(--primary-red);
            font-size: 1.2rem;
        }

        .map-container {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        footer {
            background-color: var(--dark-red);
            border-top: 5px solid var(--primary-red);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .carousel-caption h1 {
                font-size: 2.2rem;
            }

            .carousel-item {
                height: 80vh;
                min-height: 500px;
            }

            .about-img-wrapper::before {
                display: none;
            }

            .navbar-collapse {
                background: var(--white);
                padding: 1rem;
                border-radius: 8px;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                margin-top: 10px;
            }
        }
    </style>
    <style>
        :root { --primary-red: #c62828; --dark-red: #8e0000; }
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; color: #333; }
        .navbar-brand span { font-weight: 800; color: var(--primary-red); }

        /* News Style Header */
        .article-header { background: white; padding: 40px 0; border-bottom: 1px solid #eee; margin-bottom: 30px; }
        .breadcrumb-item a { color: var(--primary-red); text-decoration: none; font-size: 0.9rem; }
        .article-title { font-weight: 800; font-size: 2.8rem; line-height: 1.2; color: #1a1a1a; margin: 20px 0; }

        .featured-image-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }
        .featured-image { width: 100%; max-height: 500px; object-fit: cover; }

        /* Content Area */
        .article-content { font-size: 1.15rem; line-height: 1.9; color: #444; }
        .article-content img { max-width: 100%; height: auto; border-radius: 15px; margin: 20px 0; }

        /* Sidebar */
        .sidebar-card { background: white; border-radius: 15px; padding: 25px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .sidebar-title { font-weight: 700; border-left: 4px solid var(--primary-red); padding-left: 15px; margin-bottom: 20px; }
        .related-item { display: flex; gap: 15px; margin-bottom: 20px; text-decoration: none; color: inherit; }
        .related-img { width: 80px; height: 80px; border-radius: 10px; object-fit: cover; }
        .related-title { font-weight: 600; font-size: 0.95rem; line-height: 1.4; transition: 0.3s; }
        .related-item:hover .related-title { color: var(--primary-red); }

        .btn-cta {
            background: var(--primary-red); color: white; border-radius: 50px;
            padding: 15px 30px; font-weight: 700; width: 100%; transition: 0.3s;
        }
        .btn-cta:hover { background: var(--dark-red); color: white; transform: translateY(-3px); }

        @media (max-width: 768px) {
            .article-title { font-size: 1.8rem; }
            .article-content { font-size: 1.05rem; }
        }
    </style>
</head>

<body>

    <div id="google_translate_element"></div>

    <nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm w-100">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                @if (isset($setting) && $setting->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" height="40" class="me-2">
                @else
                    <i class="fa-solid fa-graduation-cap text-primary-red fs-2 me-2"></i>
                @endif
                <span class="notranslate">{{ strtoupper($setting->site_name ?? 'LPK MAHESWARA') }}</span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars-staggered text-primary-red fs-2"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-lg-center gap-2 gap-lg-3">
                    <li class="nav-item"><a class="nav-link " href="{{ url('/') }}#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}#program">Program</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#gallery">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#contact">Kontak</a></li>

                    <li class="nav-item dropdown ms-lg-2 border-start ps-lg-3 border-secondary-subtle notranslate">
                        <a class="nav-link dropdown-toggle d-flex align-items-center fw-bold" href="#"
                            id="langDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="fs-5 me-1" id="selectedLangFlag">🇯🇵</span> <span
                                id="selectedLangText">JP</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                            <li><a class="dropdown-item fw-bold text-primary-red bg-light lang-select" href="#"
                                    data-lang="ja" data-flag="🇯🇵" data-text="JP"><span class="me-2">🇯🇵</span> 日本語
                                    (Japanese)</a></li>
                            <li><a class="dropdown-item lang-select" href="#" data-lang="id" data-flag="🇮🇩"
                                    data-text="ID"><span class="me-2">🇮🇩</span> Indonesia</a></li>
                            <li><a class="dropdown-item lang-select" href="#" data-lang="en" data-flag="🇬🇧"
                                    data-text="EN"><span class="me-2">🇬🇧</span> English</a></li>
                        </ul>
                    </li>


                </ul>
            </div>
        </div>
    </nav>

    <div class="article-header">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/#program') }}">Program</a></li>
                    <li class="breadcrumb-item active">{{ $program->title }}</li>
                </ol>
            </nav>
            <h1 class="article-title">{{ $program->title }}</h1>
            <div class="d-flex align-items-center text-muted">
                <div class="me-3"><i class="fa-regular fa-calendar-check me-1"></i> Terdaftar: {{ $program->created_at ? $program->created_at->format('d M Y') : date('d M Y') }}</div>
                <div><i class="fa-regular fa-eye me-1"></i> Program Unggulan</div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="featured-image-container">
                    <img src="{{ asset('storage/' . $program->cover) }}" class="featured-image" alt="{{ $program->title }}">
                </div>

                <div class="article-content bg-white p-4 p-md-5 rounded-4 shadow-sm">
                    {!! $program->content !!}
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="sticky-top" style="top: 100px;">
                    <div class="sidebar-card mb-4">
                        <h5 class="sidebar-title">Daftar Sekarang</h5>
                        <p class="text-muted small">Tertarik dengan program ini? Hubungi admin kami untuk informasi pendaftaran.</p>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone ?? '') }}" target="_blank" class="btn btn-cta">
                            <i class="fa-brands fa-whatsapp me-2"></i> Tanya via WhatsApp
                        </a>
                    </div>

                    <div class="sidebar-card">
                        <h5 class="sidebar-title">Program Lainnya</h5>
                        @foreach($otherPrograms as $other)
                        <a href="{{ route('program.detail', $other->id) }}" class="related-item">
                            <img src="{{ asset('storage/' . $other->cover) }}" class="related-img">
                            <div class="related-title">{{ Str::limit($other->title, 50) }}</div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white pt-5 pb-3">
        <div class="container text-center">
            <h4 class="fw-bold mb-3 notranslate">{{ strtoupper($setting->site_name ?? 'LPK MAHESWARA') }}</h4>
            <p class="text-light mb-4 opacity-75">Mencetak Generasi Terampil, Mandiri, dan Siap Kerja.</p>
            <div class="d-flex justify-content-center gap-3 mb-4">
                @if (isset($setting->facebook_url) && $setting->facebook_url != '')
                    <a href="{{ $setting->facebook_url }}" target="_blank" class="text-white opacity-75 fs-4"><i
                            class="fa-brands fa-facebook"></i></a>
                @endif
                @if (isset($setting->instagram_url) && $setting->instagram_url != '')
                    <a href="{{ $setting->instagram_url }}" target="_blank" class="text-white opacity-75 fs-4"><i
                            class="fa-brands fa-instagram"></i></a>
                @endif
                @if (isset($setting->youtube_url) && $setting->youtube_url != '')
                    <a href="{{ $setting->youtube_url }}" target="_blank" class="text-white opacity-75 fs-4"><i
                            class="fa-brands fa-youtube"></i></a>
                @endif
            </div>
            <hr class="border-white opacity-25">
            <p class="mb-0 mt-3 small opacity-75">© {{ date('Y') }} <span
                    class="notranslate"> {{ $setting->site_name ?? 'LPK Maheswara' }}</span>. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id', // Bahasa dasar halaman adalah Indonesia
                includedLanguages: 'id,en,ja', // Hanya munculkan Indo, English, Japanese
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Efek Navbar transparan ke putih saat di-scroll
            window.addEventListener('scroll', function() {
                const nav = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            });

            // --- LOGIKA LOAD MORE PROGRAM (NAMPIL 6 PER 6) ---
            const btnLoadProgram = document.getElementById('btnLoadMoreProgram');
            if (btnLoadProgram) {
                const programItems = document.querySelectorAll('.program-item');
                btnLoadProgram.addEventListener('click', function() {
                    let addedCount = 0;
                    let hiddenRemaining = 0;

                    programItems.forEach(item => {
                        if (item.classList.contains('d-none')) {
                            if (addedCount < 6) {
                                item.classList.remove('d-none');
                                item.style.opacity = 0;
                                setTimeout(() => {
                                    item.style.transition = "opacity 0.5s ease";
                                    item.style.opacity = 1;
                                }, 50);
                                addedCount++;
                            } else {
                                hiddenRemaining++;
                            }
                        }
                    });

                    if (hiddenRemaining === 0) {
                        btnLoadProgram.style.display = 'none';
                    }
                });
            }

            // --- LOGIKA SHOW MORE / LESS GALLERY ---
            const btnToggleGallery = document.getElementById('btnToggleGallery');
            if (btnToggleGallery) {
                const extraItems = document.querySelectorAll('.gallery-extra');
                let isExpandedGallery = false;

                btnToggleGallery.addEventListener('click', function() {
                    isExpandedGallery = !isExpandedGallery;

                    extraItems.forEach(item => {
                        if (isExpandedGallery) {
                            item.style.display = 'block';
                            setTimeout(() => item.classList.add('fade', 'show'), 10);
                        } else {
                            item.classList.remove('fade', 'show');
                            setTimeout(() => item.style.display = 'none', 300);
                        }
                    });

                    if (isExpandedGallery) {
                        btnToggleGallery.innerHTML =
                            'Tutup Sebagian <i class="fa-solid fa-angle-up ms-2"></i>';
                    } else {
                        btnToggleGallery.innerHTML =
                            'Lihat Semua Foto <i class="fa-solid fa-angle-down ms-2"></i>';
                        document.getElementById('gallery').scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            }

            // ==========================================
            // LOGIKA GOOGLE TRANSLATE CUSTOM DROPDOWN
            // ==========================================
            const langSelectors = document.querySelectorAll('.lang-select');

            // Fungsi eksekutor translasi
            function triggerGoogleTranslate(langCode) {
                const selectField = document.querySelector(".goog-te-combo");
                if (selectField) {
                    selectField.value = langCode;
                    selectField.dispatchEvent(new Event('change'));
                } else {
                    // Jika script google lambat, coba lagi setelah 500ms
                    setTimeout(() => triggerGoogleTranslate(langCode), 500);
                }
            }

            // Saat item dropdown bahasa di-klik
            langSelectors.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const lang = this.getAttribute('data-lang');
                    const flag = this.getAttribute('data-flag');
                    const text = this.getAttribute('data-text');

                    // Update UI Navbar (Ikon & Text)
                    document.getElementById('selectedLangFlag').textContent = flag;
                    document.getElementById('selectedLangText').textContent = text;

                    // Update warna aktif di dropdown menu
                    langSelectors.forEach(el => el.classList.remove('fw-bold', 'text-primary-red',
                        'bg-light'));
                    this.classList.add('fw-bold', 'text-primary-red', 'bg-light');

                    // Jalankan fungsi translate
                    triggerGoogleTranslate(lang);
                });
            });

            // LOGIKA DEFAULT BAHASA JEPANG
            setTimeout(() => {
                let hasCookie = document.cookie.match(new RegExp('(^| )googtrans=([^;]+)'));

                if (hasCookie) {
                    // Jika sudah ada cookie (user pernah memilih bahasa), samakan tampilan UI-nya
                    let currentLang = hasCookie[2].split('/')[2];
                    if (currentLang === 'ja' || currentLang === 'en' || currentLang === 'id') {
                        let activeItem = document.querySelector(`.lang-select[data-lang="${currentLang}"]`);
                        if (activeItem) {
                            // Update UI Navbar tanpa mere-trigger translasi (karena GTranslate sudah otomatis jalan)
                            document.getElementById('selectedLangFlag').textContent = activeItem
                                .getAttribute('data-flag');
                            document.getElementById('selectedLangText').textContent = activeItem
                                .getAttribute('data-text');
                            langSelectors.forEach(el => el.classList.remove('fw-bold', 'text-primary-red',
                                'bg-light'));
                            activeItem.classList.add('fw-bold', 'text-primary-red', 'bg-light');
                        }
                    }
                } else {
                    // JIKA TIDAK ADA COOKIE (PENGUNJUNG BARU), OTOMATIS TRANSLATE KE JEPANG (JA)
                    let defaultJaItem = document.querySelector('.lang-select[data-lang="ja"]');
                    if (defaultJaItem) {
                        defaultJaItem.click(); // Memicu klik otomatis ke Bahasa Jepang
                    }
                }
            }, 1000); // Menunggu 1 detik agar script Google Translate selesai diinisiasi
        });

        // Fungsi Helper untuk menutup Modal Program
        function closeModalAndScroll(modalId) {
            var myModalEl = document.getElementById(modalId);
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
        }
    </script>
    @include('whatssapp');

</body>

</html>
