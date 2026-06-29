<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — MoboAdmin</title>
    <meta name="description" content="Pendaftaran panel administrator MobileStore">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ── Reset ─────────────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --cream:      #F5F0EB;
            --cream-dark: #EDE7DF;
            --terra:      #D97757;
            --terra-dark: #C4603A;
            --terra-light:#EF9B75;
            --navy:       #1A1A2E;
            --gray:       #6B7280;
            --gray-light: #9CA3AF;
            --border:     #E5E7EB;
            --white:      #FFFFFF;
            --sage:       #A8C5A0;
            --mauve:      #D4A8C7;
            --sand:       #E8C99A;
        }

        html, body {
            height: 100%;
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        body {
            background: var(--cream);
            display: flex;
            min-height: 100vh;
        }

        /* ── LEFT PANEL ─────────────────────────────────────────────── */
        .left-panel {
            flex: 1;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 52px 60px;
        }

        /* Organic blob background */
        .left-panel-bg {
            position: absolute;
            inset: 0;
            background: linear-gradient(145deg, #C4603A 0%, #D97757 45%, #E8855A 100%);
            z-index: 0;
        }

        /* SVG wave divider bottom-right */
        .left-panel-wave {
            position: absolute;
            bottom: 0;
            right: -1px;
            width: 120px;
            height: 100%;
            z-index: 1;
        }

        /* Decorative circles */
        .deco-circle {
            position: absolute;
            border-radius: 50%;
            z-index: 1;
        }
        .deco-1 {
            width: 340px; height: 340px;
            top: -80px; left: -80px;
            background: rgba(255,255,255,0.07);
        }
        .deco-2 {
            width: 220px; height: 220px;
            top: 60px; right: 40px;
            background: rgba(255,255,255,0.05);
        }
        .deco-3 {
            width: 160px; height: 160px;
            bottom: 100px; right: -40px;
            background: rgba(255,255,255,0.06);
        }
        .deco-4 {
            width: 80px; height: 80px;
            bottom: 200px; left: 60px;
            background: rgba(255,255,255,0.08);
        }

        /* Dot grid pattern */
        .dot-grid {
            position: absolute;
            inset: 0;
            z-index: 1;
            background-image: radial-gradient(circle, rgba(255,255,255,0.18) 1px, transparent 1px);
            background-size: 28px 28px;
            mask-image: linear-gradient(to bottom, transparent 0%, black 30%, black 70%, transparent 100%);
            -webkit-mask-image: linear-gradient(to bottom, transparent 0%, black 30%, black 70%, transparent 100%);
        }

        /* Left panel content */
        .left-content {
            position: relative;
            z-index: 2;
        }

        .left-brand {
            position: absolute;
            top: 48px;
            left: 60px;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-icon {
            width: 38px; height: 38px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            color: #fff;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.25);
        }

        .brand-name {
            font-size: 18px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.3px;
        }

        .left-headline {
            font-size: 42px;
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            letter-spacing: -1px;
            margin-bottom: 18px;
        }

        .left-headline em {
            font-style: normal;
            color: rgba(255,255,255,0.65);
        }

        .left-desc {
            font-size: 14.5px;
            color: rgba(255,255,255,0.72);
            line-height: 1.7;
            max-width: 340px;
            margin-bottom: 40px;
        }

        /* Feature pills */
        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 48px;
        }

        .feature-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.13);
            border: 1px solid rgba(255,255,255,0.22);
            border-radius: 50px;
            padding: 8px 16px 8px 10px;
            width: fit-content;
            backdrop-filter: blur(6px);
        }

        .feature-pill-icon {
            width: 28px; height: 28px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #fff;
        }

        .feature-pill span {
            font-size: 13px;
            font-weight: 600;
            color: rgba(255,255,255,0.9);
        }

        /* Stats */
        .stat-row {
            display: flex;
            gap: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.18);
        }

        .stat-item { display: flex; flex-direction: column; gap: 2px; }

        .stat-num {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 500;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .stat-sep {
            width: 1px;
            height: 36px;
            background: rgba(255,255,255,0.2);
            margin-top: 4px;
        }

        /* ── RIGHT PANEL ────────────────────────────────────────────── */
        .right-panel {
            width: 500px;
            flex-shrink: 0;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 44px;
            position: relative;
        }

        /* Subtle top decoration dots */
        .right-panel::before {
            content: '';
            position: absolute;
            top: 32px; right: 32px;
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--sand);
        }
        .right-panel::after {
            content: '';
            position: absolute;
            top: 52px; right: 52px;
            width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--sage);
        }

        .form-box {
            width: 100%;
            max-width: 380px;
        }

        /* Eyebrow tag */
        .form-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(217, 119, 87, 0.12);
            border: 1px solid rgba(217, 119, 87, 0.28);
            border-radius: 50px;
            padding: 5px 14px 5px 10px;
            margin-bottom: 22px;
        }

        .eyebrow-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--terra);
        }

        .form-eyebrow span {
            font-size: 12px;
            font-weight: 700;
            color: var(--terra);
            letter-spacing: 0.2px;
        }

        .form-title {
            font-size: 34px;
            font-weight: 800;
            color: var(--navy);
            line-height: 1.15;
            letter-spacing: -0.8px;
            margin-bottom: 10px;
        }

        .form-sub {
            font-size: 14px;
            color: var(--gray);
            line-height: 1.6;
            margin-bottom: 24px;
        }

        /* ── Error alert ──────────────────────────────────────── */
        .alert-error {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #FEF2F2;
            border: 1px solid #FECACA;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 13px;
            color: #DC2626;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .alert-error i { margin-top: 1px; flex-shrink: 0; }

        /* ── Field ────────────────────────────────────────────── */
        .field-group { margin-bottom: 16px; }

        .field-label {
            display: block;
            font-size: 12.5px;
            font-weight: 700;
            color: #374151;
            letter-spacing: 0.1px;
            margin-bottom: 8px;
        }

        .field-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .field-prefix {
            position: absolute;
            left: 10px;
            width: 36px; height: 36px;
            background: var(--cream);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: var(--terra);
            pointer-events: none;
            transition: background 0.2s;
            z-index: 1;
        }

        .field-input {
            width: 100%;
            padding: 13px 16px 13px 56px;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            color: var(--navy);
            font-size: 14.5px;
            font-weight: 500;
            font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .field-input::placeholder {
            color: #BDBDBD;
            font-weight: 400;
        }

        .field-input:focus {
            border-color: var(--terra);
            box-shadow: 0 0 0 3px rgba(217, 119, 87, 0.14);
        }

        .field-input:focus ~ .field-prefix,
        .field-wrap:focus-within .field-prefix {
            background: rgba(217, 119, 87, 0.12);
        }

        /* Password toggle */
        .pass-toggle {
            position: absolute;
            right: 10px;
            width: 36px; height: 36px;
            background: var(--cream);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--gray-light);
            font-size: 14px;
            transition: color 0.2s, background 0.2s;
            border: none;
        }

        .pass-toggle:hover { color: var(--terra); background: rgba(217,119,87,0.08); }

        /* ── Submit button ────────────────────────────────────── */
        .btn-submit {
            width: 100%;
            margin-top: 24px;
            padding: 15px 24px;
            background: var(--terra);
            color: #fff;
            border: none;
            border-radius: 16px;
            font-size: 15.5px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 8px 24px rgba(217, 119, 87, 0.35);
            transition: background 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
            letter-spacing: 0.1px;
        }

        .btn-submit:hover {
            background: var(--terra-dark);
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(217, 119, 87, 0.42);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(217, 119, 87, 0.3);
        }

        .btn-submit i { font-size: 15px; }

        /* ── Divider ──────────────────────────────────────────── */
        .divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 24px 0 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider span {
            font-size: 12px;
            color: var(--gray-light);
            font-weight: 500;
        }

        /* ── Footer note ──────────────────────────────────────── */
        .form-note {
            margin-top: 24px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            background: rgba(168, 197, 160, 0.15);
            border: 1px solid rgba(168, 197, 160, 0.4);
            border-radius: 12px;
        }

        .form-note i {
            color: #6B9E63;
            font-size: 14px;
            margin-top: 1px;
            flex-shrink: 0;
        }

        .form-note p {
            font-size: 12px;
            color: #4B6E46;
            line-height: 1.6;
            font-weight: 500;
        }

        /* ── Responsive ───────────────────────────────────────── */
        @media (max-width: 960px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 40px 24px; }
        }

        /* ── Animated entrance ────────────────────────────────── */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .form-box {
            animation: slideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        /* Wave animation on left panel shapes */
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-18px); }
        }

        .deco-1 { animation: floatSlow 9s ease-in-out infinite; }
        .deco-2 { animation: floatSlow 7s ease-in-out infinite 1.5s; }
        .deco-3 { animation: floatSlow 11s ease-in-out infinite 0.8s; }
    </style>
</head>
<body>

    <!-- ── LEFT: Brand Panel ───────────────────────────────────── -->
    <div class="left-panel">
        <div class="left-panel-bg"></div>
        <div class="dot-grid"></div>
        <div class="deco-circle deco-1"></div>
        <div class="deco-circle deco-2"></div>
        <div class="deco-circle deco-3"></div>
        <div class="deco-circle deco-4"></div>

        <!-- SVG wave shape kanan -->
        <svg class="left-panel-wave" viewBox="0 0 120 800" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M120,0 C80,200 40,400 120,800 L120,0 Z" fill="#F5F0EB"/>
        </svg>

        <!-- Brand -->
        <div class="left-brand">
            <div class="brand-icon">
                <i class="fa-solid fa-mobile-screen-button"></i>
            </div>
            <span class="brand-name">MoboAdmin</span>
        </div>

        <!-- Content -->
        <div class="left-content">
            <h1 class="left-headline">
                Kelola Toko
                <em>&amp; Layani</em><br>
                Konsumen.
            </h1>

            <p class="left-desc">
                Panel administrasi untuk manajemen produk HP,
                memantau pesanan konsumen, dan laporan penjualan harian.
            </p>

            <div class="feature-list">
                <div class="feature-pill">
                    <div class="feature-pill-icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <span>Laporan penjualan real-time</span>
                </div>
                <div class="feature-pill">
                    <div class="feature-pill-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span>Manajemen akun konsumen</span>
                </div>
                <div class="feature-pill">
                    <div class="feature-pill-icon">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <span>Manajemen inventori produk HP</span>
                </div>
            </div>

            <div class="stat-row">
                <div class="stat-item">
                    <span class="stat-num">500+</span>
                    <span class="stat-label">Produk</span>
                </div>
                <div class="stat-sep"></div>
                <div class="stat-item">
                    <span class="stat-num">99.9%</span>
                    <span class="stat-label">Uptime</span>
                </div>
                <div class="stat-sep"></div>
                <div class="stat-item">
                    <span class="stat-num">24/7</span>
                    <span class="stat-label">Akses</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ── RIGHT: Register Form ────────────────────────────────── -->
    <div class="right-panel">
        <div class="form-box">

            <!-- Eyebrow -->
            <div class="form-eyebrow">
                <div class="eyebrow-dot"></div>
                <span>Admin Portal</span>
            </div>

            <h2 class="form-title">Daftar Admin Baru</h2>
            <p class="form-sub">Buat akun untuk mengelola toko dan konsumen.</p>

            <!-- Error Alert -->
            @if($errors->any())
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Nama Lengkap -->
                <div class="field-group">
                    <label class="field-label" for="name">Nama Lengkap</label>
                    <div class="field-wrap">
                        <div class="field-prefix">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="field-input"
                            placeholder="Nama lengkap Anda"
                            value="{{ old('name') }}"
                            autocomplete="name"
                            required>
                    </div>
                </div>

                <!-- Email -->
                <div class="field-group">
                    <label class="field-label" for="email">Email</label>
                    <div class="field-wrap">
                        <div class="field-prefix">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="field-input"
                            placeholder="admin@toko.com"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required>
                    </div>
                </div>

                <!-- Password -->
                <div class="field-group">
                    <label class="field-label" for="password">Kata Sandi</label>
                    <div class="field-wrap">
                        <div class="field-prefix">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="field-input"
                            placeholder="Minimal 6 karakter"
                            autocomplete="new-password"
                            required>
                        <button type="button" class="pass-toggle" id="passToggle" aria-label="Toggle password">
                            <i class="fa-regular fa-eye" id="passIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Password Confirmation -->
                <div class="field-group">
                    <label class="field-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="field-wrap">
                        <div class="field-prefix">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="field-input"
                            placeholder="Ulangi kata sandi"
                            autocomplete="new-password"
                            required>
                        <button type="button" class="pass-toggle" id="confirmPassToggle" aria-label="Toggle confirm password">
                            <i class="fa-regular fa-eye" id="confirmPassIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">
                    Daftar Sekarang
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>

            <div style="text-align: center; margin-top: 20px;">
                <p style="font-size: 13.5px; color: var(--gray); font-weight: 500;">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" style="color: var(--terra); font-weight: 700; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--terra-dark)'" onmouseout="this.style.color='var(--terra)'">Masuk sekarang</a>
                </p>
            </div>

            <!-- Note -->
            <div class="divider">
                <div class="divider-line"></div>
                <span>info</span>
                <div class="divider-line"></div>
            </div>

            <div class="form-note">
                <i class="fa-solid fa-shield-halved"></i>
                <p>Pendaftaran ini ditujukan khusus untuk penambahan administrator baru yang memiliki kewenangan penuh.</p>
            </div>

        </div>
    </div>

    <script>
        // Password toggle
        const passToggle = document.getElementById('passToggle');
        const passInput  = document.getElementById('password');
        const passIcon   = document.getElementById('passIcon');

        passToggle.addEventListener('click', () => {
            const isHidden = passInput.type === 'password';
            passInput.type = isHidden ? 'text' : 'password';
            passIcon.className = isHidden ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });

        // Password confirmation toggle
        const confirmPassToggle = document.getElementById('confirmPassToggle');
        const confirmPassInput  = document.getElementById('password_confirmation');
        const confirmPassIcon   = document.getElementById('confirmPassIcon');

        confirmPassToggle.addEventListener('click', () => {
            const isHidden = confirmPassInput.type === 'password';
            confirmPassInput.type = isHidden ? 'text' : 'password';
            confirmPassIcon.className = isHidden ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });
    </script>

</body>
</html>
