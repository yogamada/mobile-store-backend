<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — MoboAdmin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ── Variables ──────────────────────────────────────────────── */
        :root {
            --cream:        #F5F0EB;
            --cream-mid:    #EDE7DF;
            --cream-dark:   #E4DDD4;
            --white:        #FFFFFF;
            --terra:        #D97757;
            --terra-dark:   #C4603A;
            --terra-light:  #EF9B75;
            --terra-dim:    rgba(217, 119, 87, 0.12);
            --navy:         #1A1A2E;
            --navy-mid:     #2D2D44;
            --gray:         #6B7280;
            --gray-light:   #9CA3AF;
            --border:       #E5E7EB;
            --border-dark:  #D1D5DB;
            --sage:         #A8C5A0;
            --sage-dim:     rgba(168, 197, 160, 0.18);
            --mauve:        #D4A8C7;
            --sand:         #E8C99A;

            --danger:       #EF4444;
            --danger-dim:   rgba(239, 68, 68, 0.10);
            --success:      #22C55E;
            --success-dim:  rgba(34, 197, 94, 0.10);
            --warning:      #F59E0B;
            --warning-dim:  rgba(245, 158, 11, 0.10);
            --info:         #06B6D4;
            --info-dim:     rgba(6, 182, 212, 0.10);

            --sidebar-w:    240px;
            --sidebar-w-sm: 64px;
            --header-h:     60px;
            --radius:       10px;
            --radius-lg:    14px;
            --radius-xl:    18px;
            --shadow:       0 1px 3px rgba(26,26,46,0.06), 0 4px 16px rgba(26,26,46,0.08);
            --shadow-lg:    0 8px 32px rgba(26,26,46,0.12);
            --transition:   all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: var(--cream);
            color: var(--navy);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ── SIDEBAR ─────────────────────────────────────────────────── */
        aside {
            width: var(--sidebar-w);
            background: var(--white);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            z-index: 200;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        /* ── Logo ── */
        .logo-area {
            padding: 0 18px;
            height: var(--header-h);
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }

        .logo-icon {
            width: 34px; height: 34px;
            border-radius: 10px;
            background: var(--terra);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(217,119,87,0.3);
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
            white-space: nowrap;
            transition: opacity 0.2s ease;
        }

        .logo-brand {
            font-size: 15px;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: -0.3px;
        }

        .logo-tagline {
            font-size: 10px;
            font-weight: 500;
            color: var(--gray-light);
            letter-spacing: 0.3px;
            margin-top: 2px;
        }

        /* ── Sidebar Toggle (CSS-only) ── */
        #sidebar-toggle { display: none; }

        .sidebar-toggle-btn {
            position: fixed;
            top: 18px;
            left: calc(var(--sidebar-w) - 14px);
            z-index: 210;
            width: 24px; height: 24px;
            border-radius: 50%;
            background: var(--white);
            border: 1.5px solid var(--border);
            color: var(--gray-light);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 9px;
            transition: var(--transition), left 0.3s cubic-bezier(0.4,0,0.2,1);
            box-shadow: 0 2px 8px rgba(26,26,46,0.08);
        }

        .sidebar-toggle-btn:hover {
            background: var(--terra);
            border-color: var(--terra);
            color: #fff;
        }

        #sidebar-toggle:checked ~ aside { width: var(--sidebar-w-sm); }
        #sidebar-toggle:checked ~ aside .logo-text,
        #sidebar-toggle:checked ~ aside .menu-label,
        #sidebar-toggle:checked ~ aside .logout-label,
        #sidebar-toggle:checked ~ aside .menu-section-title {
            opacity: 0; width: 0; overflow: hidden; pointer-events: none;
        }
        #sidebar-toggle:checked ~ aside .menu-item a,
        #sidebar-toggle:checked ~ aside .logout-btn {
            justify-content: center; padding: 10px 0;
        }
        #sidebar-toggle:checked ~ main { margin-left: var(--sidebar-w-sm); }
        #sidebar-toggle:checked ~ .sidebar-toggle-btn { left: calc(var(--sidebar-w-sm) - 12px); }
        #sidebar-toggle:checked ~ .sidebar-toggle-btn .toggle-icon { transform: rotate(180deg); }
        .toggle-icon { transition: transform 0.3s ease; }

        /* ── Menu ── */
        .menu-section-title {
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--gray-light);
            padding: 20px 18px 8px;
            white-space: nowrap;
        }

        .menu-list {
            list-style: none;
            padding: 6px 10px;
            display: flex;
            flex-direction: column;
            gap: 2px;
            flex-grow: 1;
            overflow-y: auto;
        }
        .menu-list::-webkit-scrollbar { width: 0; }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 12px;
            color: var(--gray);
            text-decoration: none;
            border-radius: var(--radius);
            font-size: 13.5px;
            font-weight: 500;
            transition: var(--transition);
            white-space: nowrap;
        }

        .menu-item a .menu-icon {
            font-size: 15px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
            transition: color 0.2s;
        }

        .menu-item a:hover {
            color: var(--navy);
            background: var(--cream);
        }

        .menu-item.active a {
            color: var(--terra);
            background: var(--terra-dim);
            font-weight: 600;
            box-shadow: inset 3px 0 0 var(--terra);
        }

        .menu-item.active a .menu-icon { color: var(--terra); }

        /* ── Logout ── */
        .logout-area {
            padding: 10px;
            border-top: 1px solid var(--border);
            flex-shrink: 0;
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 12px;
            background: transparent;
            color: var(--gray);
            border: none;
            border-radius: var(--radius);
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .logout-btn:hover {
            background: var(--danger-dim);
            color: var(--danger);
        }

        .logout-btn i { font-size: 14px; width: 20px; text-align: center; flex-shrink: 0; }

        /* ── MAIN ────────────────────────────────────────────────────── */
        main {
            margin-left: var(--sidebar-w);
            flex-grow: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ── TOP HEADER ── */
        .top-header {
            position: sticky;
            top: 0;
            z-index: 100;
            height: var(--header-h);
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: rgba(245, 240, 235, 0.88);
            backdrop-filter: blur(16px) saturate(150%);
            -webkit-backdrop-filter: blur(16px) saturate(150%);
            border-bottom: 1px solid var(--border);
        }

        .header-title-block { display: flex; flex-direction: column; line-height: 1; }

        .header-title-block h2 {
            font-size: 17px;
            font-weight: 700;
            color: var(--navy);
            letter-spacing: -0.3px;
        }

        .header-title-block p {
            font-size: 12px;
            color: var(--gray-light);
            margin-top: 3px;
        }

        .header-right { display: flex; align-items: center; gap: 10px; }

        /* Search */
        .header-search { position: relative; display: flex; align-items: center; }

        .header-search i {
            position: absolute;
            left: 11px;
            color: var(--gray-light);
            font-size: 13px;
            pointer-events: none;
        }

        .header-search input {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 9px;
            padding: 8px 14px 8px 32px;
            font-size: 13px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--navy);
            width: 200px;
            outline: none;
            transition: var(--transition);
        }

        .header-search input::placeholder { color: var(--gray-light); }

        .header-search input:focus {
            border-color: var(--terra);
            box-shadow: 0 0 0 3px rgba(217,119,87,0.12);
            width: 230px;
        }

        /* Notif button */
        .notif-btn {
            width: 36px; height: 36px;
            border-radius: 9px;
            background: var(--white);
            border: 1.5px solid var(--border);
            color: var(--gray);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            font-size: 14px;
            transition: var(--transition);
            position: relative;
        }

        .notif-btn:hover { border-color: var(--terra); color: var(--terra); }

        .notif-dot {
            position: absolute;
            top: 7px; right: 7px;
            width: 7px; height: 7px;
            background: var(--danger);
            border-radius: 50%;
            border: 1.5px solid var(--cream);
        }

        /* Admin chip */
        .admin-chip {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 5px 12px 5px 5px;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .admin-chip:hover { border-color: var(--terra); }

        .admin-avatar {
            width: 28px; height: 28px;
            border-radius: 7px;
            object-fit: cover;
        }

        .admin-chip-info { display: flex; flex-direction: column; line-height: 1; }
        .admin-chip-name { font-size: 12.5px; font-weight: 700; color: var(--navy); white-space: nowrap; }
        .admin-chip-role { font-size: 10.5px; color: var(--gray-light); margin-top: 2px; }

        /* ── PAGE BODY ────────────────────────────────────────────────── */
        .page-body {
            padding: 24px 24px 40px;
            flex-grow: 1;
            max-width: 1440px;
            width: 100%;
        }

        /* ── ALERTS ── */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 13px 16px;
            border-radius: var(--radius-lg);
            margin-bottom: 20px;
            font-size: 13.5px;
            font-weight: 500;
            line-height: 1.5;
        }

        .alert i { margin-top: 1px; flex-shrink: 0; }
        .alert ul { padding-left: 16px; }
        .alert li { list-style: disc; }

        .alert-success {
            background: var(--success-dim);
            color: #16A34A;
            border: 1px solid rgba(34,197,94,0.25);
        }

        .alert-danger {
            background: var(--danger-dim);
            color: var(--danger);
            border: 1px solid rgba(239,68,68,0.25);
        }

        /* ── STATS CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px 20px 16px;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
            background: var(--terra);
        }

        .stat-card.sales::before     { background: var(--success); }
        .stat-card.customers::before { background: var(--info); }
        .stat-card.products::before  { background: var(--terra); }

        .stat-card:hover {
            border-color: var(--border-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-top-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: var(--gray-light);
        }

        .stat-icon-badge {
            width: 34px; height: 34px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
        }

        .stat-card.sales .stat-icon-badge      { background: var(--success-dim); color: var(--success); }
        .stat-card.customers .stat-icon-badge  { background: var(--info-dim);    color: var(--info); }
        .stat-card.products .stat-icon-badge   { background: var(--terra-dim);   color: var(--terra); }

        .stat-value {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.8px;
            color: var(--navy);
            line-height: 1;
        }

        .stat-trend {
            font-size: 11.5px;
            font-weight: 500;
            color: var(--gray-light);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-trend .trend-up   { color: var(--success); }
        .stat-trend .trend-down { color: var(--danger); }
        .stat-trend i { font-size: 10px; }

        /* ── CONTENT CARD ── */
        .content-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .card-title-block {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title-accent {
            width: 3px; height: 18px;
            border-radius: 2px;
            background: var(--terra);
            flex-shrink: 0;
        }

        .card-header h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--navy);
            letter-spacing: -0.2px;
        }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: var(--radius);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            letter-spacing: 0.1px;
        }

        .btn:active { transform: translateY(1px) !important; }

        .btn-primary {
            background: var(--terra);
            color: #fff;
            box-shadow: 0 4px 12px rgba(217,119,87,0.28);
        }
        .btn-primary:hover {
            background: var(--terra-dark);
            box-shadow: 0 6px 18px rgba(217,119,87,0.38);
            transform: translateY(-1px);
            color: #fff;
        }

        .btn-secondary {
            background: var(--cream);
            color: var(--gray);
            border: 1.5px solid var(--border);
        }
        .btn-secondary:hover {
            background: var(--cream-mid);
            color: var(--navy);
            border-color: var(--border-dark);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: var(--danger-dim);
            color: var(--danger);
            border: 1px solid rgba(239,68,68,0.2);
        }
        .btn-danger:hover {
            background: var(--danger);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-success {
            background: var(--success-dim);
            color: var(--success);
            border: 1px solid rgba(34,197,94,0.2);
        }
        .btn-success:hover {
            background: var(--success);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 8px; }

        /* ── TABLE ── */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: var(--radius);
            border: 1.5px solid var(--border);
        }

        table { width: 100%; border-collapse: collapse; text-align: left; }

        thead { background: var(--cream); }

        th {
            padding: 11px 16px;
            color: var(--gray);
            font-weight: 700;
            font-size: 11.5px;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            border-bottom: 1.5px solid var(--border);
            white-space: nowrap;
        }

        td {
            padding: 13px 16px;
            font-size: 13.5px;
            color: var(--navy);
            vertical-align: middle;
            border-bottom: 1px solid var(--border);
        }

        tbody tr { transition: background 0.12s ease; }
        tbody tr:hover td { background: var(--cream) !important; }
        tbody tr:last-child td { border-bottom: none; }

        /* ── BADGES ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .badge::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .badge-success { background: var(--success-dim); color: #16A34A; }
        .badge-success::before { background: var(--success); }
        .badge-danger  { background: var(--danger-dim);  color: var(--danger); }
        .badge-danger::before  { background: var(--danger); }
        .badge-warning { background: var(--warning-dim); color: #D97706; }
        .badge-warning::before { background: var(--warning); }
        .badge-info    { background: var(--info-dim);    color: #0891B2; }
        .badge-info::before    { background: var(--info); }
        .badge-primary { background: var(--terra-dim);   color: var(--terra-dark); }
        .badge-primary::before { background: var(--terra); }

        /* ── FORM GROUPS ── */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group > label {
            display: block;
            margin-bottom: 7px;
            font-size: 12.5px;
            font-weight: 700;
            color: #374151;
            letter-spacing: 0.1px;
        }

        .form-control {
            width: 100%;
            padding: 11px 14px;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            color: var(--navy);
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 500;
            transition: var(--transition);
            outline: none;
        }

        .form-control::placeholder { color: #BDBDBD; font-weight: 400; }

        .form-control:focus {
            border-color: var(--terra);
            box-shadow: 0 0 0 3px rgba(217,119,87,0.12);
        }

        select.form-control { appearance: none; -webkit-appearance: none; cursor: pointer; }

        textarea.form-control {
            resize: vertical;
            min-height: 110px;
            line-height: 1.6;
        }

        /* Input with icon */
        .input-icon-wrap { position: relative; }
        .input-icon-wrap i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-light);
            font-size: 14px;
            pointer-events: none;
        }
        .input-icon-wrap .form-control { padding-left: 38px; }

        /* ── SECTION HEADER ── */
        .two-col-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .section-accent-bar {
            width: 3px; height: 20px;
            border-radius: 2px;
            background: var(--terra);
        }

        .section-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--navy);
            letter-spacing: -0.2px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1280px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .two-col-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 900px) {
            aside { width: var(--sidebar-w-sm); }
            aside .logo-text,
            aside .menu-label,
            aside .logout-label,
            aside .menu-section-title { display: none; }
            aside .menu-item a { justify-content: center; padding: 10px 0; }
            aside .logout-btn { justify-content: center; padding: 10px 0; }
            main { margin-left: var(--sidebar-w-sm); }
            .sidebar-toggle-btn { display: none; }
            .page-body { padding: 16px; }
        }

        @media (max-width: 600px) {
            .stats-grid { grid-template-columns: 1fr; }
            .header-search { display: none; }
        }

        /* ── UTILITY ── */
        .text-muted   { color: var(--gray-light); }
        .text-success { color: var(--success); }
        .text-danger  { color: var(--danger); }
        .text-warning { color: var(--warning); }
        .text-info    { color: var(--info); }
        .text-terra   { color: var(--terra); }
        .fw-600       { font-weight: 600; }
        .fw-700       { font-weight: 700; }
        .fs-13        { font-size: 13px; }
        .d-flex       { display: flex; }
        .align-center { align-items: center; }
        .gap-8        { gap: 8px; }
        .mt-4         { margin-top: 4px; }
        .mt-8         { margin-top: 8px; }
        .mb-0         { margin-bottom: 0 !important; }

        @yield('extra_styles')
    </style>
</head>
<body>

    <!-- ── Sidebar Toggle ───────────────────────────────────────── -->
    <input type="checkbox" id="sidebar-toggle">
    <label for="sidebar-toggle" class="sidebar-toggle-btn" title="Toggle sidebar">
        <i class="fa-solid fa-chevron-left toggle-icon"></i>
    </label>

    <!-- ── Sidebar ─────────────────────────────────────────────── -->
    <aside>

        <div class="logo-area">
            <div class="logo-icon">
                <i class="fa-solid fa-mobile-screen-button"></i>
            </div>
            <div class="logo-text">
                <span class="logo-brand">MoboAdmin</span>
                <span class="logo-tagline">Control Center</span>
            </div>
        </div>

        <span class="menu-section-title">Menu</span>

        <ul class="menu-list">
            <li class="menu-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-chart-pie menu-icon"></i>
                    <span class="menu-label">Ringkasan</span>
                </a>
            </li>
            <li class="menu-item {{ Request::routeIs('admin.products*') ? 'active' : '' }}">
                <a href="{{ route('admin.products') }}">
                    <i class="fa-solid fa-boxes-stacked menu-icon"></i>
                    <span class="menu-label">Produk HP</span>
                </a>
            </li>
            <li class="menu-item {{ Request::routeIs('admin.orders*') ? 'active' : '' }}">
                <a href="{{ route('admin.orders') }}">
                    <i class="fa-solid fa-receipt menu-icon"></i>
                    <span class="menu-label">Penjualan</span>
                </a>
            </li>
        </ul>

        <div class="logout-area">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="logout-label">Keluar</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- ── Main Content ─────────────────────────────────────────── -->
    <main>

        <div class="top-header">
            <div class="header-title-block">
                <h2>@yield('header_title', 'Dashboard')</h2>
                <p>@yield('header_subtitle', 'Selamat datang kembali, Administrator!')</p>
            </div>

            <div class="header-right">
                <div class="header-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari sesuatu…">
                </div>

                <div class="notif-btn" title="Notifikasi">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-dot"></span>
                </div>

                <div class="admin-chip">
                    <img
                        class="admin-avatar"
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=D97757&color=fff&bold=true&format=svg"
                        alt="Avatar">
                    <div class="admin-chip-info">
                        <span class="admin-chip-name">{{ Auth::user()->name ?? 'Administrator' }}</span>
                        <span class="admin-chip-role">Administrator</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </div>
    </main>

</body>
</html>
