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
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <!-- Back to home -->
    <a href="{{ route('index') }}" class="back-link" aria-label="Back to home">
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M19 12H5" />
            <path d="M12 19l-7-7 7-7" />
        </svg>
        Back
    </a>

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
