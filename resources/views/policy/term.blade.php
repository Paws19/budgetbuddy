<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service — BudgetBuddy</title>
    <meta name="description" content="BudgetBuddy Terms of Service.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/terms.css') }}">
</head>

<body>

    <header class="bb-navbar">
        <div class="bb-container py-3 d-flex align-items-center justify-content-between">
            <a href="{{ route('index') }}" class="bb-brand">
                <img src="{{ asset('img/logo.png') }}" alt="BudgetBuddy">
                BudgetBuddy
            </a>
            <a href="{{ route('index') }}" style="font-size:0.9rem;font-weight:500;color:var(--bb-text-muted);">← Back
                to home</a>
        </div>
    </header>

    <main>
        <div class="page-hero">
            <div class="bb-container">
                <h1>Terms of Service</h1>
                <p>The simple rules for using BudgetBuddy.</p>
                <span class="last-updated">Last updated: September 19, 2026</span>
            </div>
        </div>

        <div class="bb-container">
            <div class="content-card">

                <h2>1. Welcome</h2>
                <p>Thanks for using BudgetBuddy. These Terms of Service explain how you can use our website and app. By
                    creating an account or using the service, you agree to these terms.</p>
                <p>If you don’t agree with them, please don’t use BudgetBuddy.</p>

                <h2>2. What BudgetBuddy is</h2>
                <p>BudgetBuddy is a personal budgeting tool that helps you track income, log expenses, set monthly
                    budgets, and understand your spending. It’s made to be simple and practical for everyday money
                    management.</p>

                <h2>3. Your account</h2>
                <p>Most features require an account. You’re responsible for:</p>
                <ul>
                    <li>Giving accurate information when you sign up</li>
                    <li>Keeping your login details private</li>
                    <li>Everything that happens under your account</li>
                </ul>
                <p>If you think someone else has access to your account, contact us as soon as possible.</p>

                <h2>4. Acceptable use</h2>
                <p>Please use BudgetBuddy only for personal and lawful purposes. Don’t:</p>
                <ul>
                    <li>Try to break, overload, or disrupt the service</li>
                    <li>Attempt to access other people’s data</li>
                    <li>Use the service for anything illegal</li>
                    <li>Share your account with others</li>
                </ul>

                <h2>5. Your data</h2>
                <p>You own the financial information you enter (income, expenses, budgets, etc.). By using BudgetBuddy,
                    you give us permission to store and process that data so the service can work.</p>
                <p>We do not sell your personal or financial data.</p>

                <h2>6. Service availability</h2>
                <p>We work hard to keep BudgetBuddy running smoothly, but we can’t guarantee it will always be available
                    or completely free of errors. We may update, pause, or remove features when needed.</p>

                <h2>7. Limitation of liability</h2>
                <p>BudgetBuddy is a tool to help you organize your finances. It is not financial, tax, or investment
                    advice. We’re not responsible for decisions you make based on the information in the app, or for any
                    losses that result from using (or being unable to use) the service.</p>

                <h2>8. Changes to these terms</h2>
                <p>We may update these terms from time to time. When we do, we’ll change the “Last updated” date at the
                    top of this page. Continuing to use BudgetBuddy after changes means you accept the new terms.</p>

                <h2>9. Contact</h2>
                <p>Questions about these terms? Email us at <a
                        href="mailto:budgetbuddyofficialsgmail.com">budgetbuddyofficialsgmail.com</a>.</p>

            </div>
        </div>
    </main>

    <footer class="bb-footer">
        <div class="bb-container">
            <a href="{{ route('index') }}">Home</a>
            <a href="{{ route('terms') }}">Terms</a>
            <a href="{{ route('privacy') }}">Privacy</a>
            <div style="margin-top:1.15rem;">© 2026 BudgetBuddy. All rights reserved.</div>
        </div>
    </footer>

</body>

</html>
