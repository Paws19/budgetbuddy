<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Login — BudgetBuddy</title>
    <meta name="description" content="Sign in to BudgetBuddy — track income, expenses, and budgets with ease.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg: #F4F7F6;
            --surface: #FFFFFF;
            --text: #0B1220;
            --text-2: #4B5565;
            --text-3: #8B95A5;
            --border: #E0E8E5;
            --teal: #00BFA5;
            --teal-dark: #00A08A;
            --teal-soft: #E6F9F5;
            --navy: #152238;
            --red: #E14B5A;
            --font-d: 'Plus Jakarta Sans', system-ui, sans-serif;
            --font-b: 'Inter', system-ui, sans-serif;
            --radius: 16px;
            --shadow: 0 24px 64px rgba(11, 18, 32, 0.1);
            --ease: cubic-bezier(0.16, 1, 0.3, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
            -webkit-text-size-adjust: 100%;
        }

        body {
            min-height: 100%;
            font-family: var(--font-b);
            color: var(--text);
            background: var(--bg);
            -webkit-font-smoothing: antialiased;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            line-height: 1.5;
        }

        a {
            color: var(--teal-dark);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.15s;
        }

        a:hover {
            color: var(--teal);
        }

        button {
            font-family: inherit;
            cursor: pointer;
        }

        :focus-visible {
            outline: 2px solid var(--teal);
            outline-offset: 2px;
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: var(--surface);
            border-radius: 24px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            padding: 2.25rem 2rem;
            animation: cardIn 0.6s var(--ease) both;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(16px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 1rem;
                align-items: flex-start;
                padding-top: 1.5rem;
            }

            .card {
                padding: 1.75rem 1.25rem;
                border-radius: 20px;
                max-width: 100%;
            }
        }

        .logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 1.85rem;
        }

        .logo img {
            height: 72px;
            width: auto;
            margin-bottom: 0.85rem;
        }

        .logo-name {
            font-family: var(--font-d);
            font-weight: 800;
            font-size: 1.45rem;
            letter-spacing: -0.03em;
            color: var(--navy);
            line-height: 1.2;
        }

        .logo-tag {
            font-size: 0.85rem;
            color: var(--text-3);
            margin-top: 0.25rem;
            font-weight: 500;
        }

        .header {
            text-align: center;
            margin-bottom: 1.65rem;
        }

        .header h1 {
            font-family: var(--font-d);
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.03em;
            color: var(--navy);
            margin-bottom: 0.35rem;
        }

        .header p {
            font-size: 0.925rem;
            color: var(--text-2);
        }

        .error {
            background: #FDE8EA;
            color: var(--red);
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.75rem 0.95rem;
            border-radius: 12px;
            margin-bottom: 1.15rem;
            border: 1px solid #F5C2C7;
            text-align: center;
        }

        .field {
            margin-bottom: 1.1rem;
        }

        .field label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.4rem;
        }

        .field-wrap {
            position: relative;
        }

        .field input {
            width: 100%;
            padding: 0.85rem 1rem;
            font-family: var(--font-b);
            font-size: 0.95rem;
            color: var(--text);
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            transition: border-color 0.2s, box-shadow 0.2s;
            -webkit-appearance: none;
        }

        .field input::placeholder {
            color: var(--text-3);
        }

        .field input:hover {
            border-color: #C5D4CF;
        }

        .field input:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 4px rgba(0, 191, 165, 0.14);
        }

        .field input.is-invalid {
            border-color: var(--red);
        }

        .field input.has-toggle {
            padding-right: 3.25rem;
        }

        .field-error {
            color: var(--red);
            font-size: 0.8rem;
            margin-top: 0.35rem;
            font-weight: 500;
        }

        .toggle-pw {
            position: absolute;
            right: 0.55rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 0.4rem 0.5rem;
            color: var(--text-3);
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 8px;
            transition: color 0.15s, background 0.15s;
        }

        .toggle-pw:hover {
            color: var(--text);
            background: var(--bg);
        }

        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 1.4rem;
            flex-wrap: wrap;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-2);
            cursor: pointer;
            user-select: none;
        }

        .remember input {
            width: 17px;
            height: 17px;
            accent-color: var(--teal);
            cursor: pointer;
            flex-shrink: 0;
        }

        .forgot {
            font-size: 0.875rem;
        }

        .btn {
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.9rem 1.25rem;
            font-family: var(--font-b);
            font-size: 0.975rem;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-primary {
            background: var(--teal);
            color: #fff;
            box-shadow: 0 6px 20px rgba(0, 191, 165, 0.32);
        }

        .btn-primary:hover {
            background: var(--teal-dark);
            box-shadow: 0 10px 28px rgba(0, 191, 165, 0.38);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            margin: 1.35rem 0;
            color: var(--text-3);
            font-size: 0.8rem;
            font-weight: 500;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: var(--text-2);
        }

        @media (max-width: 360px) {
            .header h1 {
                font-size: 1.35rem;
            }

            .options {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.65rem;
            }
        }
    </style>
</head>

<body>
    <div class="card">

        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="BudgetBuddy">
            <div class="logo-name">BudgetBuddy</div>
            <div class="logo-tag">Track. Budget. Thrive.</div>
        </div>

        <!-- Header -->
        <div class="header">
            <h1>Welcome back</h1>
            <p>Sign in to continue to your dashboard</p>
        </div>

        <!-- Global error -->
        @if ($errors->any())
            <div class="error" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('login.store') }}" method="POST">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <div class="field-wrap">
                    <input type="email" id="email" name="email" placeholder="you@email.com" autocomplete="email"
                        required inputmode="email" value="{{ old('email') }}"
                        class="@error('email') is-invalid @enderror">
                </div>
                @error('email')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <div class="field-wrap">
                    <input type="password" id="password" name="password"
                        class="has-toggle @error('password') is-invalid @enderror" placeholder="Enter your password"
                        autocomplete="current-password" required>
                    <button type="button" class="toggle-pw" id="togglePw" aria-label="Show password">Show</button>
                </div>
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="options">
                <label class="remember">
                    <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>
                <a href="#" class="forgot">Forgot password?</a>
            </div>

            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>

        <div class="divider">or</div>

        <p class="footer">
            Don’t have an account? <a href="{{ route('registration') }}">Create one</a>
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePw = document.getElementById('togglePw');
            const password = document.getElementById('password');

            if (togglePw && password) {
                togglePw.addEventListener('click', function() {
                    const show = password.type === 'password';
                    password.type = show ? 'text' : 'password';
                    togglePw.textContent = show ? 'Hide' : 'Show';
                    togglePw.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
                });
            }
        });
    </script>
</body>

</html>
