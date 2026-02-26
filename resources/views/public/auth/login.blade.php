<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customer Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f6f1eb;
            --panel: #fffaf5;
            --text: #2b2520;
            --muted: #7b7168;
            --accent: #8b3a3a;
            --accent-hover: #6f2d2d;
            --line: #e7ddd2;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Manrope", sans-serif;
            color: var(--text);
            background:
                radial-gradient(900px 400px at 90% -10%, #eedac5, transparent 60%),
                radial-gradient(700px 300px at -10% 100%, #e6c7ba, transparent 60%),
                var(--bg);
            display: grid;
            place-items: center;
            padding: 24px;
        }
        .auth-wrap {
            width: min(940px, 100%);
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 20px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            box-shadow: 0 20px 45px rgba(30, 20, 10, 0.12);
        }
        .side {
            padding: 44px;
            background: linear-gradient(170deg, #2f241f 0%, #4d3228 100%);
            color: #f8eee5;
        }
        .side h1 {
            margin: 0 0 12px;
            font-family: "Playfair Display", serif;
            font-size: 2rem;
            letter-spacing: 0.02em;
        }
        .side p {
            margin: 0;
            color: #e6d6c7;
            line-height: 1.65;
        }
        .panel {
            padding: 36px 34px;
        }
        .brand {
            margin: 0 0 18px;
            font-family: "Playfair Display", serif;
            font-size: 1.7rem;
        }
        .field { margin-bottom: 14px; }
        label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.92rem;
            font-weight: 600;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            height: 44px;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 0 12px;
            font-size: 0.95rem;
            outline: none;
            background: #fff;
        }
        input:focus {
            border-color: #c6a68a;
            box-shadow: 0 0 0 3px rgba(198, 166, 138, 0.2);
        }
        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin: 8px 0 16px;
        }
        .btn {
            width: 100%;
            height: 46px;
            border: 0;
            border-radius: 12px;
            background: var(--accent);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .btn:hover { background: var(--accent-hover); }
        .muted {
            color: var(--muted);
            font-size: 0.9rem;
        }
        .muted a { color: var(--accent); text-decoration: none; font-weight: 600; }
        .error {
            color: #b42318;
            font-size: 0.82rem;
            margin-top: 5px;
        }
        @media (max-width: 860px) {
            .auth-wrap { grid-template-columns: 1fr; }
            .side { padding: 28px; }
            .panel { padding: 28px 22px; }
        }
    </style>
</head>
<body>
    <div class="auth-wrap">
        <section class="side">
            <h1>Afifa's Nadias</h1>
            <p>Luxury pret and unstitched edits, crafted for modern wardrobes. Sign in to continue your shopping journey.</p>
        </section>

        <section class="panel">
            <h2 class="brand">Customer Login</h2>
            <form method="POST" action="{{ route('frontend.login.store') }}">
                @csrf
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                    @error('password') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="row">
                    <label class="muted"><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <button class="btn" type="submit">Sign In</button>
            </form>
            <p class="muted" style="margin-top: 14px;">
                New customer? <a href="{{ route('frontend.register') }}">Create account</a>
            </p>
            <p class="muted" style="margin-top: 8px;">
                Admin login? <a href="{{ route('login') }}">Go to admin login</a>
            </p>
        </section>
    </div>
</body>
</html>
