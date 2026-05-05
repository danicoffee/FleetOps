<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleetOps Console | Login</title>
    <style>
        :root {
            color-scheme: dark;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: #030712; color: #e2e8f0; }
        a { color: inherit; text-decoration: none; }
        .page { display: grid; min-height: 100vh; grid-template-columns: minmax(0, 1.45fr) minmax(0, 1fr); }
        .panel { position: relative; overflow: hidden; display: none; }
        .panel::before { content: ""; position: absolute; inset: 0; background: radial-gradient(circle at top left, rgba(56,189,248,0.4), transparent 26%), radial-gradient(circle at bottom right, rgba(14,165,233,0.2), transparent 30%); z-index: 1; }
        .panel::after { content: ""; position: absolute; inset: 0; background-image: url('https://images.unsplash.com/photo-1542362567-b07e54358753?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; opacity: 0.58; z-index: 0; }
        .panel-content { position: relative; z-index: 2; display: flex; flex-direction: column; justify-content: space-between; height: 100%; padding: 40px; }
        .brand { display: inline-flex; align-items: center; gap: 0.75rem; font-size: 0.85rem; font-weight: 700; letter-spacing: 0.24em; text-transform: uppercase; color: #67e8f9; }
        .hero-title { margin: 1.5rem 0 1.25rem; font-size: clamp(2rem, 4vw, 3.25rem); line-height: 1.05; font-weight: 800; color: #fff; }
        .hero-copy { max-width: 35rem; line-height: 1.8; color: rgba(226,232,240,0.88); }
        .card { border: 1px solid rgba(255,255,255,0.12); background: rgba(15,23,42,0.88); backdrop-filter: blur(18px); border-radius: 1.75rem; padding: 1.5rem; }
        .card strong { display: block; color: #f8fafc; margin-bottom: 0.5rem; }
        .card p { margin: 0.35rem 0; color: rgba(226,232,240,0.78); font-size: 0.95rem; }
        .container { display: flex; align-items: center; justify-content: center; padding: 40px 36px; background: #020617; }
        .form-card { width: 100%; max-width: 540px; background: rgba(15,23,42,0.96); border: 1px solid rgba(148,163,184,0.08); border-radius: 2rem; padding: 40px; box-shadow: 0 35px 90px rgba(15,23,42,0.35); }
        .eyebrow { font-size: 0.8rem; font-weight: 700; letter-spacing: 0.24em; text-transform: uppercase; color: #7dd3fc; }
        .headline { margin: 1rem 0 0.65rem; font-size: clamp(2.25rem, 3.1vw, 3.5rem); line-height: 1.05; font-weight: 800; letter-spacing: -0.03em; color: #f8fafc; }
        .subtext { margin: 0; color: rgba(203,213,225,0.82); max-width: 34rem; }
        .field { margin-top: 1.4rem; }
        .field label { display: block; margin-bottom: 0.65rem; font-size: 0.95rem; color: #cbd5e1; }
        .field input { width: 100%; border-radius: 1rem; border: 1px solid rgba(148,163,184,0.18); background: rgba(15,23,42,0.85); color: #f8fafc; padding: 1rem 1.15rem; font-size: 1rem; outline: none; transition: border-color 0.2s ease, box-shadow 0.2s ease; }
        .field input:focus { border-color: #38bdf8; box-shadow: 0 0 0 4px rgba(56,189,248,0.12); }
        .controls { margin-top: 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; font-size: 0.94rem; color: rgba(203,213,225,0.8); }
        .controls a { color: #7dd3fc; font-weight: 600; }
        .checkbox label { display: inline-flex; align-items: center; gap: 0.6rem; cursor: pointer; }
        .checkbox input { width: 1rem; height: 1rem; accent-color: #38bdf8; }
        .button { width: 100%; margin-top: 1.75rem; border: none; border-radius: 1.1rem; padding: 1rem 1.2rem; background: linear-gradient(135deg,#0ea5e9,#22d3ee); color: #020617; font-size: 1rem; font-weight: 700; cursor: pointer; transition: transform 0.15s ease, filter 0.15s ease; }
        .button:hover { transform: translateY(-1px); filter: brightness(1.05); }
        .footer { margin-top: 2rem; text-align: center; font-size: 0.95rem; color: rgba(203,213,225,0.75); }
        .footer a { color: #f8fafc; font-weight: 600; }
        .error-box { margin-top: 1.25rem; border-radius: 1.25rem; border: 1px solid rgba(248,113,113,0.35); background: rgba(254,202,202,0.12); padding: 1rem; color: #fee2e2; }
        .error-box ul { margin: 0.5rem 0 0; padding-left: 1.2rem; }
        .error-box li { margin: 0.35rem 0; }
        @media (min-width: 1024px) { .panel { display: block; } }
        @media (max-width: 1023px) { .page { grid-template-columns: 1fr; } .container { min-height: 100vh; } }
    </style>
</head>
<body>
    <div class="page">
        <aside class="panel">
            <div class="panel-content">
                <div>
                    <a href="{{ route('login.show') }}" class="brand">FleetOps Console</a>
                </div>
                <div>
                    <p class="eyebrow">Fleet management</p>
                    <h1 class="hero-title">Track every vehicle, driver, trip and service — in one console.</h1>
                    <p class="hero-copy">Operations-grade visibility for your fleet. Real-time status, license alerts, maintenance reminders and exportable reports.</p>
                </div>
                <div class="card">
                    <p class="eyebrow">Demo accounts</p>
                    <strong>Fleet Manager</strong>
                    <p>manager@fleet.com / manager123</p>
                    <strong>Driver</strong>
                    <p>driver@fleet.com / driver123</p>
                </div>
            </div>
        </aside>6

        <main class="container">
            <div class="form-card">
                <p class="eyebrow">Sign in</p>
                <h1 class="headline">Welcome back</h1>
                <p class="subtext">Use your credentials to access the console.</p>

                @if ($errors->any())
                    <div class="error-box">
                        <strong>Review the following:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.perform') }}">
                    @csrf
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus />
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" required />
                    </div>
                    <div class="controls">
                        <label class="checkbox"><input type="checkbox" name="remember" /> Remember me</label>
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    </div>
                    <button type="submit" class="button">Sign in</button>
                </form>
                <p class="footer">New here? <a href="{{ route('register.show') }}">Create an account</a></p>
            </div>
        </main>
    </div>
</body>
</html>
