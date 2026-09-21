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
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
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
                                <input type="text" id="firstName" name="firstName" placeholder="Rogelio"
                                    autocomplete="given-name" required value="{{ old('firstName') }}"
                                    class="@error('firstName') is-invalid @enderror">
                                @error('firstName')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="field">
                                <label for="lastName">Last name</label>
                                <input type="text" id="lastName" name="lastName" placeholder="Cerenado"
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
                    <p class="login-link">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
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
