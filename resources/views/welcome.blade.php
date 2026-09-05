<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabungan Lebaranku - Sambut Hari Raya Tanpa Beban</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --bg-dark: #000000;
            --card-bg: #09090b;
            --card-border: #18181b;
            --gold-primary: #f59e0b;
            --gold-hover: #d97706;
            --text-main: #f4f4f5;
            --text-muted: #71717a;
            --nav-bg: rgba(0, 0, 0, 0.9);
        }

        /* Light Mode Theme Styles */
        body.light-mode {
            --bg-dark: #f8fafc;
            --card-bg: #ffffff;
            --card-border: #e2e8f0;
            --gold-primary: #d97706;
            --gold-hover: #b45309;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --nav-bg: rgba(255, 255, 255, 0.9);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        html,
        body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
            background-color: var(--bg-dark);
            color: var(--text-main);
        }

        body {
            line-height: 1.6;
            position: relative;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Ornamen Geometric Matrix Background */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(rgba(245, 158, 11, 0.12) 1px, transparent 0);
            background-size: 32px 32px;
            pointer-events: none;
            z-index: 0;
        }

        /* Ambient Glow Effect */
        .glow-top {
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 600px;
            height: 400px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, rgba(5, 150, 105, 0.05) 45%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--nav-bg);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--card-border);
            z-index: 1000;
            padding: 12px 0;
            width: 100%;
        }

        .container {
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 20px;
            padding-right: 20px;
            position: relative;
            z-index: 1;
            width: 100%;
        }

        nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .logo {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-main);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .logo span {
            color: var(--gold-primary);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--gold-primary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-main);
            font-size: 20px;
            padding: 4px;
        }

        .theme-toggle {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            color: var(--text-main);
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
        }

        .theme-toggle:hover {
            border-color: var(--gold-primary);
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-hover));
            color: #000;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
            font-size: 13px;
            display: inline-block;
            text-align: center;
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.35);
        }

        /* Hero Section */
        .hero {
            padding: 130px 0 50px;
            text-align: center;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.25);
            color: var(--gold-primary);
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 16px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero h1 {
            font-size: 26px;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 14px;
            letter-spacing: -0.5px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .hero h1 .highlight {
            background: linear-gradient(135deg, #f59e0b, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 14px;
            color: var(--text-muted);
            text-align: center;
            max-width: 100%;
            margin: 0 auto 24px;
        }

        /* Features Section */
        .features {
            padding: 40px 0;
            text-align: center;
        }

        .section-title {
            text-align: center;
            margin: 0 auto 30px;
            width: 100%;
        }

        .section-title h2 {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 8px;
            text-align: center;
        }

        .section-title p {
            color: var(--text-muted);
            font-size: 13px;
            text-align: center;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            width: 100%;
            justify-items: center;
        }

        .feature-card {
            background-color: var(--card-bg);
            border: 1px solid var(--card-border);
            padding: 24px 20px;
            border-radius: 14px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .icon-box {
            width: 45px;
            height: 45px;
            background: rgba(245, 158, 11, 0.08);
            border: 1px solid rgba(245, 158, 11, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            font-size: 20px;
        }

        .feature-card h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 6px;
            text-align: center;
        }

        .feature-card p {
            color: var(--text-muted);
            font-size: 13px;
            text-align: center;
        }

        /* CTA / Kontak Section */
        .cta-wrapper {
            padding: 20px 0 40px;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .cta-box {
            background: var(--card-bg);
            border: 1px solid var(--gold-primary);
            border-radius: 16px;
            padding: 30px 20px;
            text-align: center;
            width: 100%;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .cta-box h2 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 10px;
            text-align: center;
        }

        .cta-box p {
            color: var(--text-muted);
            font-size: 13px;
            margin: 0 auto 20px;
            text-align: center;
        }

        /* Footer */
        footer {
            border-top: 1px solid var(--card-border);
            padding: 20px 0;
            text-align: center;
            color: var(--text-muted);
            font-size: 12px;
            width: 100%;
        }

        /* Responsive Breakpoints untuk Desktop/Tablet */
        @media (min-width: 769px) {
            .menu-toggle {
                display: none !important;
            }

            .grid-3 {
                grid-template-columns: repeat(3, 1fr);
            }

            .hero h1 {
                font-size: 46px;
                max-width: 800px;
            }

            .hero p {
                font-size: 16px;
            }

            .logo {
                font-size: 18px;
            }

            .btn-gold {
                padding: 10px 22px;
                font-size: 14px;
            }

            .section-title h2 {
                font-size: 28px;
            }

            .cta-box {
                max-width: 800px;
                padding: 45px 30px;
            }

            .cta-box h2 {
                font-size: 26px;
            }

            .feature-card {
                text-align: left;
                align-items: flex-start;
            }

            .feature-card h3,
            .feature-card p {
                text-align: left;
            }
        }

        /* Responsive Khusus HP */
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .nav-links {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--nav-bg);
                flex-direction: column;
                align-items: flex-start;
                padding: 16px 20px;
                gap: 12px;
                border-bottom: 1px solid var(--card-border);
                backdrop-filter: blur(16px);
                display: none;
            }

            .nav-links.active {
                display: flex;
            }

            .nav-links a {
                font-size: 15px;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="glow-top"></div>

    <!-- Navigation Bar -->
    <nav>
        <div class="container">
            <div class="nav-wrapper">
                <a href="/" class="logo">
                    🌙 Tabungan<span>Lebaranku</span>
                </a>

                <!-- List Navigasi -->
                <ul class="nav-links" id="navLinks">
                    <li><a href="#beranda" onclick="closeMenu()">Beranda</a></li>
                    <li><a href="#tentang" onclick="closeMenu()">Mengapa Kami</a></li>
                    <li><a href="#kontak" onclick="closeMenu()">Hubungi Kami</a></li>
                </ul>

                <div class="nav-actions">
                    <!-- Tombol Theme Toggle -->
                    <button class="theme-toggle" onclick="toggleTheme()">
                        <span id="theme-icon">🌙</span>
                    </button>
                    <a href="/login" class="btn-gold">Masuk</a>

                    <!-- Tombol Hamburger Mobile -->
                    <button class="menu-toggle" id="menuToggle" onclick="toggleMenu()">
                        ☰
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero">
        <div class="container">
            <div class="badge">
                ✨ Program Tabungan Hari Raya Idul Fitri
            </div>
            <h1>Sambut Hari Raya Tenang & Bahagia Tanpa Beban Finansial <span class="highlight">🕌</span></h1>
            <p>Rencanakan dan kumpulkan tabungan kebutuhan Lebaran Anda secara terstruktur, teraman, dan terpercaya
                bersama kami.</p>
            <div>
                <a href="/login" class="btn-gold" style="padding: 12px 24px; font-size: 14px;">Mulai Menabung
                    Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="tentang" class="features">
        <div class="container">
            <div class="section-title">
                <h2>Keunggulan Program Kami 🌟</h2>
                <p>Kenapa puluhan member mempercayakan tabungan Hari Raya mereka bersama kami.</p>
            </div>
            <div class="grid-3">
                <div class="feature-card">
                    <div class="icon-box">🛡️</div>
                    <h3>Aman & Transparan</h3>
                    <p>Setiap mutasi transaksi dan akumulasi dana Anda dapat dipantau secara real-time melalui dashboard
                        interaktif.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-box">🎁</div>
                    <h3>Paket Kebutuhan Lengkap</h3>
                    <p>Pilihan paket fleksibel disesuaikan untuk kebutuhan Daging, Sembako, Kue Kering, hingga THR
                        Lebaran.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-box">📈</div>
                    <h3>Terencana & Disiplin</h3>
                    <p>Bantu konsistensi finansial mingguan atau bulanan Anda tanpa khawatir pengeluaran membengkak saat
                        mendekati Hari Raya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Hubungi Kami / CTA Section -->
    <div class="cta-wrapper">
        <div class="container">
            <div id="kontak" class="cta-box">
                <h2>Punya Pertanyaan Seputar Tabungan Lebaranku? 🌙</h2>
                <p>Hubungi tim kami langsung via WhatsApp untuk berkonsultasi atau bertanya seputar program.</p>

                <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20mau%20tanya-tanya%20seputar%20paket%20Tabungan%20Lebaranku"
                    target="_blank" class="btn-gold"
                    style="padding: 12px 24px; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
                    💬 Hubungi Kami via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2026 Tabungan Lebaranku. Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>

    <!-- Script JavaScript -->
    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        function closeMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.remove('active');
        }

        function toggleTheme() {
            const body = document.body;
            const themeIcon = document.getElementById('theme-icon');

            body.classList.toggle('light-mode');

            if (body.classList.contains('light-mode')) {
                themeIcon.textContent = '☀️';
                localStorage.setItem('theme', 'light');
            } else {
                themeIcon.textContent = '🌙';
                localStorage.setItem('theme', 'dark');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'light') {
                document.body.classList.add('light-mode');
                document.getElementById('theme-icon').textContent = '☀️';
            }
        });
    </script>
</body>

</html>
