
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humana — Modern Apartment Living</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --blue: #3B82F6;
            --blue-dark: #2563EB;
            --blue-light: #60A5FA;
            --blue-50: #EFF6FF;
            --gray-50: #FAFAFA;
            --gray-100: #F5F5F5;
            --gray-200: #E5E5E5;
            --gray-300: #D4D4D4;
            --gray-400: #A3A3A3;
            --gray-500: #737373;
            --gray-600: #525252;
            --gray-700: #404040;
            --gray-800: #262626;
            --gray-900: #171717;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--gray-100);
        }

        nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 72px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--gray-900);
        }

        .logo-mark {
            width: 36px;
            height: 36px;
            background: var(--blue);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        .nav-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--blue);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-cta:hover {
            background: var(--blue-dark);
        }

        /* Hero */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 0 80px;
        }

        .hero-content {
            max-width: 720px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--blue-50);
            color: var(--blue);
            border-radius: 100px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 24px;
        }

        .hero h1 {
            font-size: clamp(40px, 6vw, 64px);
            font-weight: 600;
            line-height: 1.1;
            letter-spacing: -0.03em;
            margin-bottom: 24px;
        }

        .hero h1 .blue {
            color: var(--blue);
        }

        .hero p {
            font-size: 18px;
            color: var(--gray-500);
            max-width: 540px;
            margin-bottom: 40px;
            line-height: 1.7;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--blue);
            color: white;
        }

        .btn-primary:hover {
            background: var(--blue-dark);
        }

        .btn-secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
        }

        .btn-secondary:hover {
            border-color: var(--gray-300);
        }

        /* Stats */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--gray-200);
            border-radius: 16px;
            overflow: hidden;
            margin-top: 80px;
        }

        .stat {
            background: white;
            padding: 32px;
            text-align: center;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--gray-500);
        }

        /* Features */
        .features {
            padding: 120px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 64px;
        }

        .section-label {
            display: inline-block;
            padding: 8px 16px;
            background: var(--blue-50);
            color: var(--blue);
            border-radius: 100px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: clamp(32px, 4vw, 48px);
            font-weight: 600;
            letter-spacing: -0.02em;
            margin-bottom: 16px;
        }

        .section-desc {
            font-size: 17px;
            color: var(--gray-500);
            max-width: 520px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: white;
            border: 1px solid var(--gray-100);
            border-radius: 16px;
            padding: 32px;
            transition: all 0.2s;
        }

        .feature-card:hover {
            border-color: var(--blue);
            transform: translateY(-4px);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: var(--blue-50);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: var(--blue);
        }

        .feature-card h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .feature-card p {
            font-size: 15px;
            color: var(--gray-500);
            line-height: 1.6;
        }

        /* CTA */
        .cta {
            padding: 120px 0;
            background: var(--gray-900);
            color: white;
            text-align: center;
        }

        .cta h2 {
            font-size: clamp(32px, 4vw, 48px);
            font-weight: 600;
            letter-spacing: -0.02em;
            margin-bottom: 16px;
        }

        .cta p {
            font-size: 18px;
            color: var(--gray-400);
            max-width: 520px;
            margin: 0 auto 40px;
        }

        .cta .btn {
            background: var(--blue);
            color: white;
        }

        .cta .btn:hover {
            background: var(--blue-dark);
        }

        /* Footer */
        footer {
            padding: 48px 0;
            border-top: 1px solid var(--gray-200);
        }

        footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-brand .logo-mark {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }

        .footer-text {
            font-size: 14px;
            color: var(--gray-500);
        }

        .footer-links {
            display: flex;
            gap: 32px;
        }

        .footer-links a {
            font-size: 14px;
            color: var(--gray-500);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--gray-900);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .btn {
                justify-content: center;
            }

            footer .container {
                flex-direction: column;
                gap: 24px;
                text-align: center;
            }

            .footer-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <a href="/" class="logo">
                <div class="logo-mark">🏠</div>
                <span class="logo-text">Humana</span>
            </a>
            <a href="/payment" class="nav-cta">
                Bayar Sekarang
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                    Modern Apartment Living
                </div>
                <h1>Hunian Modern untuk <span class="blue">Gaya Hidup</span> Terbaik</h1>
                <p>Temukan apartemen impian dengan fasilitas lengkap, lokasi strategis, dan proses pembayaran yang mudah.</p>
                <div class="hero-buttons">
                    <a href="/payment" class="btn btn-primary">
                        💳 Bayar Sewa
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="#features" class="btn btn-secondary">Pelajari Lebih</a>
                </div>

                <!-- Stats -->
                <div class="stats">
                    <div class="stat">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Apartemen Tersedia</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Lokasi Strategis</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Customer Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Mengapa Humana</span>
                <h2 class="section-title">Semua yang Anda Butuhkan</h2>
                <p class="section-desc">Solusi hunian modern dengan standar kualitas tertinggi untuk kenyamanan Anda.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>
                    <h3>Apartemen Premium</h3>
                    <p>Pilihan apartemen dengan desain modern dan interior berkualitas tinggi.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s-8-4.5-8-11.8A8 8 0 0112 2a8 8 0 018 8.2c0 7.3-8 11.8-8 11.8z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <h3>Lokasi Strategis</h3>
                    <p>Dekat dengan pusat bisnis, transportasi, dan fasilitas umum.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0110 0v4"/>
                        </svg>
                    </div>
                    <h3>Keamanan Tinggi</h3>
                    <p>Sistem keamanan 24 jam dengan akses kontrol terkini.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                            <line x1="1" y1="10" x2="23" y2="10"/>
                        </svg>
                    </div>
                    <h3>Pembayaran Mudah</h3>
                    <p>Berbagai metode pembayaran yang aman dan praktis.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <h3>Fasilitas Lengkap</h3>
                    <p>Kolam renang, gym, taman, dan berbagai fasilitas pendukung.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                    </div>
                    <h3>Support 24/7</h3>
                    <p>Tim customer service siap membantu Anda kapan saja.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="container">
            <h2>Siap Memulai?</h2>
            <p>Hubungi kami sekarang untuk konsultasi gratis dan temukan apartemen yang cocok untuk Anda.</p>
            <a href="/payment" class="btn btn-primary">
                💳 Bayar Sewa Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-brand">
                <div class="logo-mark">🏠</div>
                <span class="logo-text">Humana</span>
            </div>
            <p class="footer-text">&copy; 2026 Humana. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Tentang</a>
                <a href="#">Layanan</a>
                <a href="#">Kontak</a>
                <a href="#">Privasi</a>
            </div>
        </div>
    </footer>
</body>
</html><?php /**PATH /Users/azis/midtrans-humana/resources/views/welcome.blade.php ENDPATH**/ ?>