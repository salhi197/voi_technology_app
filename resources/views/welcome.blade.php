<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Green Hunters</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Instrument Sans', sans-serif;
            background: #04342C;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: #085041;
            border-radius: 16px;
            padding: 3rem 2rem;
            text-align: center;
            max-width: 420px;
            width: 90%;
        }
        .logo {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: #04342C;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        .logo i { font-size: 28px; color: #5DCAA5; }
        h1 { color: #E1F5EE; margin: 0 0 8px; font-weight: 600; font-size: 24px; }
        p.tagline { color: #9FE1CB; font-size: 14px; margin: 0 0 2rem; }
        .btn {
            display: block;
            width: 100%;
            background: #1D9E75;
            color: #04342C;
            border: none;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            box-sizing: border-box;
        }
        .btn:hover { background: #5DCAA5; }
        .features {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(225,245,238,0.15);
        }
        .feature { text-align: center; }
        .feature i { font-size: 20px; color: #5DCAA5; }
        .feature span {
            display: block;
            font-size: 12px;
            color: #9FE1CB;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo"><i class="ti ti-bolt"></i></div>
        <h1>Green Hunters</h1>
        <p class="tagline">Fleet operations for Voi scooters</p>

        <a href="{{ route('login') }}" class="btn">Log in</a>

        <div class="features">
            <div class="feature"><i class="ti ti-battery-charging"></i><span>Swap</span></div>
            <div class="feature"><i class="ti ti-truck-delivery"></i><span>Deploy</span></div>
            <div class="feature"><i class="ti ti-map-pin"></i><span>Rebalance</span></div>
            <div class="feature"><i class="ti ti-checklist"></i><span>QC</span></div>
        </div>
    </div>
</body>
</html>