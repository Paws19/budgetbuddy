<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account — BudgetBuddy</title>
    <meta name="description" content="Create your free BudgetBuddy account and start tracking your budget.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg: #F7FAF9;
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
            --font-display: 'Plus Jakarta Sans', system-ui, sans-serif;
            --font-body: 'Inter', system-ui, sans-serif;
            --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            height: 100%;
        }

        body {
            margin: 0;
            min-height: 100%;
            font-family: var(--font-body);
            color: var(--text);
            background: var(--bg);
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: var(--teal-dark);
            text-decoration: none;
            transition: color 0.15s;
        }

        a:hover {
            color: var(--teal);
        }

        :focus-visible {
            outline: 2px solid var(--teal);
            outline-offset: 2px;
        }

        .page {
            display: grid;
            grid-template-columns: minmax(320px, 1.05fr) minmax(360px, 1fr);
            min-height: 100vh;
        }

        @media (max-width: 900px) {
            .page {
                grid-template-columns: 1fr;
            }

            .side {
                display: none;
            }
        }

        .side {
            background: linear-gradient(155deg, #0F1C2E 0%, #152238 45%, #0A3D36 100%);
            color: #fff;
            padding: clamp(2rem, 5vw, 3.5rem);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .side::before {
            content: "";
            position: absolute;
            width: 480px;
            height: 480px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 191, 165, 0.28), transparent 68%);
            top: -15%;
            right: -25%;
            pointer-events: none;
        }

        .side::after {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 191, 165, 0.12), transparent 68%);
            bottom: 0;
            left: -15%;
            pointer-events: none;
        }

        .side-inner {
            position: relative;
            z-index: 1;
            max-width: 420px;
        }

        .side-logo {
            margin-bottom: 2.75rem;
        }

        .side-logo img {
            height: 110px;
            width: auto;
            display: block;
            filter: drop-shadow(0 8px 24px rgba(0, 0, 0, 0.25));
        }

        .greeting {
            margin-bottom: 2rem;
        }

        .greeting-line {
            overflow: hidden;
            margin-bottom: 0.45rem;
        }

        .greeting-line span {
            display: block;
            font-family: var(--font-display);
            font-weight: 800;
            letter-spacing: -0.035em;
            line-height: 1.15;
            opacity: 0;
            transform: translateY(110%);
            animation: riseUp 0.85s var(--ease-out) forwards;
        }

        .greeting-line:nth-child(1) span {
            font-size: clamp(1.9rem, 3.2vw, 2.45rem);
            color: #fff;
            animation-delay: 0.12s;
        }

        .greeting-line:nth-child(2) span {
            font-size: clamp(1.45rem, 2.6vw, 1.85rem);
            color: var(--teal);
            animation-delay: 0.32s;
        }

        .greeting-line:nth-child(3) span {
            font-size: 1.05rem;
            font-weight: 500;
            font-family: var(--font-body);
            letter-spacing: 0;
            line-height: 1.55;
            color: rgba(255, 255, 255, 0.72);
            margin-top: 0.65rem;
            animation-delay: 0.55s;
        }

        @keyframes riseUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .side-points {
            list-style: none;
            padding: 0;
            margin: 2.25rem 0 0;
            opacity: 0;
            animation: fadeIn 0.7s var(--ease-out) 0.9s forwards;
        }

        .side-points li {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            font-size: 0.975rem;
            color: rgba(255, 255, 255, 0.82);
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .side-points li::before {
            content: "";
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--teal);
            box-shadow: 0 0 0 4px rgba(0, 191, 165, 0.2);
            flex-shrink: 0;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: clamp(1.75rem, 4vw, 3rem) 1.5rem;
            background: var(--bg);
        }

        .main-inner {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
            opacity: 0;
            transform: translateY(20px);
            animation: formIn 0.75s var(--ease-out) 0.35s forwards;
        }

        @keyframes formIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-logo-mobile {
            display: none;
            margin-bottom: 1.25rem;
            text-align: center;
        }

        .main-logo-mobile img {
            height: 72px;
            width: auto;
        }

        @media (max-width: 900px) {
            .main-logo-mobile {
                display: block;
            }
        }

        .hello-chip {
            display: none;
            background: var(--teal-soft);
            color: var(--teal-dark);
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.55rem 1rem;
            border-radius: 99px;
            margin-bottom: 1.35rem;
            text-align: center;
        }

        @media (max-width: 900px) {
            .hello-chip {
                display: block;
            }
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-3);
            margin-bottom: 1.65rem;
            transition: color 0.15s;
        }

        .back-home:hover {
            color: var(--text-2);
        }

        .form-header {
            margin-bottom: 1.85rem;
        }

        .form-header h1 {
            font-family: var(--font-display);
            font-size: clamp(1.55rem, 3vw, 1.8rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--navy);
            margin: 0 0 0.45rem;
            line-height: 1.2;
        }

        .form-header p {
            margin: 0;
            font-size: 0.975rem;
            color: var(--text-2);
            line-height: 1.55;
        }

        .field {
            margin-bottom: 1.15rem;
        }

        .field label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.4rem;
        }

        .field input {
            width: 100%;
            padding: 0.8rem 0.95rem;
            font-family: var(--font-body);
            font-size: 0.95rem;
            color: var(--text);
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            transition: border-color 0.2s, box-shadow 0.2s;
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

        .field-hint {
            font-size: 0.75rem;
            color: var(--text-3);
            margin-top: 0.4rem;
        }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.9rem;
        }

        @media (max-width: 420px) {
            .field-row {
                grid-template-columns: 1fr;
            }
        }

        .password-wrap {
            position: relative;
        }

        .password-wrap input {
            padding-right: 3rem;
        }

        .toggle-pw {
            position: absolute;
            right: 0.7rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 0.35rem 0.4rem;
            cursor: pointer;
            color: var(--text-3);
            font-size: 0.8rem;
            font-weight: 600;
            font-family: var(--font-body);
        }

        .toggle-pw:hover {
            color: var(--text-2);
        }

        .terms {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            margin: 1.35rem 0 1.6rem;
            font-size: 0.875rem;
            color: var(--text-2);
            line-height: 1.5;
        }

        .terms input {
            margin-top: 0.2rem;
            accent-color: var(--teal);
            flex-shrink: 0;
            width: 17px;
            height: 17px;
            cursor: pointer;
        }

        .btn-submit {
            width: 100%;
            padding: 0.9rem 1.25rem;
            font-family: var(--font-body);
            font-size: 0.975rem;
            font-weight: 600;
            color: #fff;
            background: var(--teal);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0, 191, 165, 0.32);
            transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
        }

        .btn-submit:hover {
            background: var(--teal-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(0, 191, 165, 0.38);
        }

        .btn-submit:active {
            transform: scale(0.99);
        }

        .btn-ghost-link {
            background: none;
            border: none;
            color: var(--teal-dark);
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
        }

        .btn-ghost-link:hover {
            color: var(--teal);
        }

        .btn-ghost-link:disabled {
            color: var(--text-3);
            cursor: not-allowed;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            margin: 1.6rem 0;
            color: var(--text-3);
            font-size: 0.8rem;
            font-weight: 500;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .login-link {
            text-align: center;
            font-size: 0.925rem;
            color: var(--text-2);
            margin: 0;
        }

        .login-link a {
            font-weight: 600;
        }

        /* Steps */
        .step {
            display: none;
        }

        .step.active {
            display: block;
            animation: stepIn 0.45s var(--ease-out);
        }

        @keyframes stepIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* OTP */
        .code-inputs {
            display: flex;
            gap: 0.55rem;
            justify-content: center;
            margin: 1.5rem 0 1.25rem;
        }

        .code-inputs input {
            width: 48px;
            height: 56px;
            text-align: center;
            font-family: var(--font-display);
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--navy);
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            transition: border-color 0.2s, box-shadow 0.2s;
            caret-color: var(--teal);
        }

        .code-inputs input:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 4px rgba(0, 191, 165, 0.14);
        }

        .code-inputs input.error {
            border-color: var(--red);
            box-shadow: 0 0 0 4px rgba(225, 75, 90, 0.12);
        }

        @media (max-width: 400px) {
            .code-inputs input {
                width: 42px;
                height: 50px;
                font-size: 1.2rem;
            }

            .code-inputs {
                gap: 0.4rem;
            }
        }

        .code-error {
            display: none;
            text-align: center;
            font-size: 0.85rem;
            color: var(--red);
            margin: -0.5rem 0 1rem;
        }

        .code-error.show,
        .code-error[style*="display:block"] {
            display: block;
        }

        .resend-row {
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-2);
            margin: 1.25rem 0 0;
            line-height: 1.5;
        }

        /* Success */
        .success-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1.35rem;
            border-radius: 50%;
            background: var(--teal-soft);
            color: var(--teal-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.65rem;
            font-weight: 700;
        }

        .success-block {
            text-align: center;
        }

        .success-block h1 {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin: 0 0 0.5rem;
            color: var(--navy);
        }

        .success-block p {
            color: var(--text-2);
            font-size: 0.975rem;
            margin: 0 0 1.6rem;
            line-height: 1.55;
        }

        .mail-icon {
            width: 56px;
            height: 56px;
            margin: 0 auto 1.25rem;
            border-radius: 16px;
            background: var(--teal-soft);
            color: var(--teal-dark);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mail-icon svg {
            width: 26px;
            height: 26px;
        }

        /* Error styles */
        .field input.is-invalid {
            border-color: #E84A5F !important;
            box-shadow: none;
        }

        .field input.is-invalid:focus {
            border-color: #E84A5F !important;
            box-shadow: 0 0 0 3px rgba(232, 74, 95, 0.15);
        }

        .field-error {
            color: #E84A5F;
            font-size: 0.82rem;
            margin-top: 0.35rem;
            font-weight: 500;
        }

        /*password requirements*/
        .password-rules {
            list-style: none;
            padding: 0;
            margin: 0.6rem 0 0;
            font-size: 0.8rem;
        }

        .password-rules li {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            color: var(--text-3);
            margin-bottom: 0.3rem;
            transition: color 0.2s;
        }

        .password-rules li::before {
            content: "○";
            font-size: 0.7rem;
            color: var(--text-3);
        }

        .password-rules li.valid {
            color: #00A08A;
        }

        .password-rules li.valid::before {
            content: "✓";
            color: #00A08A;
            font-weight: 700;
        }

        .password-rules li.invalid {
            color: #E14B5A;
        }

        .password-rules li.invalid::before {
            content: "✕";
            color: #E14B5A;
        }
    </style>
</head>

<body>

    <div class="page">

        <aside class="side" aria-hidden="true">
            <div class="side-inner">
                <div class="side-logo">
                    <img src="{{ asset('img/logo.png') }}" alt="BudgetBuddy">
                </div>
                <div class="greeting">
                    <div class="greeting-line"><span>Hello there! 👋</span></div>
                    <div class="greeting-line"><span>Ready to track your budget?</span></div>
                    <div class="greeting-line"><span>Create a free account and start in under a minute.</span></div>
                </div>
                <ul class="side-points">
                    <li>See income &amp; expenses clearly</li>
                    <li>Set monthly budgets that stick</li>
                    <li>Built for real life — simple &amp; free</li>
                </ul>
            </div>
        </aside>

        <main class="main">
            <div class="main-inner">
                <div class="main-logo-mobile">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="BudgetBuddy">
                    </a>
                </div>

                <div class="hello-chip">Hello! Ready to start tracking your budget?</div>
                <a href="{{ route('index') }}" class="back-home">← Back to home</a>

                <!-- STEP 1: Register -->
                <div class="step {{ !session('show_verify_step') && !session('show_success_step') ? 'active' : '' }}"
                    id="stepRegister">
                    <div class="form-header">
                        <h1>Create your account</h1>
                        <p>Join BudgetBuddy and take control of your money.</p>
                    </div>

                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf

                        <div class="field-row">
                            <div class="field">
                                <label for="firstName">First name</label>
                                <input type="text" id="firstName" name="firstName" placeholder="Alex"
                                    autocomplete="given-name" required value="{{ old('firstName') }}"
                                    class="@error('firstName') is-invalid @enderror">
                                @error('firstName')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="field">
                                <label for="lastName">Last name</label>
                                <input type="text" id="lastName" name="lastName" placeholder="Reyes"
                                    autocomplete="family-name" required value="{{ old('lastName') }}"
                                    class="@error('lastName') is-invalid @enderror">
                                @error('lastName')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="you@email.com"
                                autocomplete="email" required value="{{ old('email') }}"
                                class="@error('email') is-invalid @enderror">
                            @error('email')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="password">Password</label>
                            <div class="password-wrap">
                                <input type="password" id="password" name="password"
                                    placeholder="Create a strong password" autocomplete="new-password" minlength="8"
                                    required class="@error('password') is-invalid @enderror">
                                <button type="button" class="toggle-pw" id="togglePw"
                                    aria-label="Show password">Show</button>
                            </div>

                            <!-- Live requirements -->
                            <ul class="password-rules" id="passwordRules">
                                <li data-rule="length">At least 8 characters</li>
                                <li data-rule="upper">One uppercase letter (A–Z)</li>
                                <li data-rule="lower">One lowercase letter (a–z)</li>
                                <li data-rule="number">One number (0–9)</li>
                                <li data-rule="symbol">One symbol (@ $ ! % * # ? &)</li>
                            </ul>

                            @error('password')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="password_confirmation">Confirm password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Repeat password" autocomplete="new-password" minlength="8" required>
                        </div>

                        <label class="terms">
                            <input type="checkbox" id="terms" name="terms" value="1" required
                                {{ old('terms') ? 'checked' : '' }}>
                            <span>I agree to the <a href="{{ route('terms') }}">Terms</a> and <a
                                    href="{{ route('privacy') }}">Privacy
                                    Policy</a>.</span>
                        </label>
                        @error('terms')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn-submit">Create account</button>
                    </form>

                    <div class="divider">or</div>
                    <p class="login-link">Already have an account? <a href="#">Log in</a></p>
                </div>

                <!-- STEP 2: Verification -->
                <div class="step {{ session('show_verify_step') ? 'active' : '' }}" id="stepVerify">
                    <div class="mail-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                    </div>

                    <div class="form-header" style="text-align:center">
                        <h1>Check your email</h1>
                        <p>
                            We sent a 6-digit code to<br>
                            <strong>{{ session('pending_email', 'you@email.com') }}</strong>
                        </p>
                    </div>

                    <form action="{{ route('verify.code') }}" method="POST" id="verifyForm">
                        @csrf
                        <input type="hidden" name="code" id="fullCode">

                        <div class="code-inputs" id="codeInputs">
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                                aria-label="Digit 1" autocomplete="one-time-code">
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                                aria-label="Digit 2">
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                                aria-label="Digit 3">
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                                aria-label="Digit 4">
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                                aria-label="Digit 5">
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                                aria-label="Digit 6">
                        </div>

                        @error('code')
                            <p class="code-error show">{{ $message }}</p>
                        @else
                            <p class="code-error" id="codeError">That code doesn’t look right. Please try again.</p>
                        @enderror

                        <button type="submit" class="btn-submit" id="verifyBtn">Verify code</button>
                    </form>

                    <p class="resend-row">
                        Didn’t get the code?
                        <button type="button" class="btn-ghost-link" id="resendBtn" disabled>
                            Resend in <span id="resendTimer">30</span>s
                        </button>
                    </p>

                    <p class="resend-row" style="margin-top:0.75rem">
                        <button type="button" class="btn-ghost-link" id="backToRegister"
                            style="font-weight:500;color:var(--text-3)">← Change email</button>
                    </p>
                </div>

                <!-- STEP 3: Success -->
                <div class="step {{ session('show_success_step') ? 'active' : '' }}" id="stepSuccess">
                    <div class="success-block">
                        <div class="success-icon" aria-hidden="true">✓</div>
                        <h1>You're verified!</h1>
                        <p>Welcome to BudgetBuddy. Your account is ready — start tracking your budget.</p>
                        <a href="{{ route('dashboard') }}" class="btn-submit"
                            style="display:inline-block;text-align:center;text-decoration:none;">Go to home</a>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const rules = document.querySelectorAll('#passwordRules li');

        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const val = this.value;

                const checks = {
                    length: val.length >= 8,
                    upper: /[A-Z]/.test(val),
                    lower: /[a-z]/.test(val),
                    number: /[0-9]/.test(val),
                    symbol: /[@$!%*#?&]/.test(val),
                };

                rules.forEach(li => {
                    const rule = li.getAttribute('data-rule');
                    li.classList.remove('valid', 'invalid');

                    if (val.length === 0) {
                        // reset when empty
                        return;
                    }

                    if (checks[rule]) {
                        li.classList.add('valid');
                    } else {
                        li.classList.add('invalid');
                    }
                });
            });
        }
        document.addEventListener('DOMContentLoaded', function() {

            // Password show/hide
            const togglePw = document.getElementById('togglePw');
            const password = document.getElementById('password');
            if (togglePw && password) {
                togglePw.addEventListener('click', function() {
                    const show = password.type === 'password';
                    password.type = show ? 'text' : 'password';
                    togglePw.textContent = show ? 'Hide' : 'Show';
                });
            }

            // OTP inputs behavior
            const codeInputs = document.querySelectorAll('#codeInputs input');
            const codeError = document.getElementById('codeError');

            codeInputs.forEach((input, index) => {
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/\D/g, '').slice(0, 1);
                    this.classList.remove('error');
                    if (codeError) codeError.classList.remove('show');

                    if (this.value && index < codeInputs.length - 1) {
                        codeInputs[index + 1].focus();
                    }
                });

                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && !this.value && index > 0) {
                        codeInputs[index - 1].focus();
                    }
                });

                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pasted = (e.clipboardData || window.clipboardData)
                        .getData('text').replace(/\D/g, '').slice(0, 6);

                    pasted.split('').forEach((char, i) => {
                        if (codeInputs[i]) {
                            codeInputs[i].value = char;
                            codeInputs[i].classList.remove('error');
                        }
                    });

                    if (codeError) codeError.classList.remove('show');
                    const focusIndex = Math.min(pasted.length, codeInputs.length - 1);
                    codeInputs[focusIndex].focus();
                });
            });

            // Combine 6 digits before submitting
            const verifyForm = document.getElementById('verifyForm');
            if (verifyForm) {
                verifyForm.addEventListener('submit', function(e) {
                    let code = '';
                    codeInputs.forEach(input => code += input.value.trim());
                    document.getElementById('fullCode').value = code;

                    if (code.length !== 6) {
                        e.preventDefault();
                        codeInputs.forEach(el => el.classList.add('error'));
                        if (codeError) {
                            codeError.textContent = 'Please enter the full 6-digit code.';
                            codeError.classList.add('show');
                        }
                    }
                });
            }

            // Resend timer (UI only for now)
            const resendBtn = document.getElementById('resendBtn');
            let left = 30;
            if (resendBtn) {
                const timer = setInterval(() => {
                    left--;
                    const timerEl = document.getElementById('resendTimer');
                    if (timerEl) timerEl.textContent = left;

                    if (left <= 0) {
                        clearInterval(timer);
                        resendBtn.disabled = false;
                        resendBtn.textContent = 'Resend code';
                    }
                }, 1000);
            }

            // Back to register
            const backBtn = document.getElementById('backToRegister');
            if (backBtn) {
                backBtn.addEventListener('click', function() {
                    document.getElementById('stepVerify').classList.remove('active');
                    document.getElementById('stepRegister').classList.add('active');
                });
            }
        });
    </script>

</body>

</html>
