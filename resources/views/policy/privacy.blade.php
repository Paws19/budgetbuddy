<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy — BudgetBuddy</title>
    <meta name="description" content="BudgetBuddy Privacy Policy.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --bb-bg: #F7FAF9;
            --bb-bg-alt: #EEF6F4;
            --bb-surface: #FFFFFF;
            --bb-text: #0F1C2E;
            --bb-text-muted: #5A6A7A;
            --bb-text-faint: #8A9AAB;
            --bb-border: #D8E5E1;
            --bb-primary: #00C4A7;
            --bb-primary-dark: #00A88E;
            --bb-primary-light: #D4F7F0;
            --bb-navy: #1A2B4A;
            --bb-radius-md: 20px;
            --bb-font-head: 'Nunito', system-ui, sans-serif;
            --bb-font-body: 'Inter', system-ui, sans-serif;
        }

        body {
            font-family: var(--bb-font-body);
            color: var(--bb-text);
            background: var(--bb-bg);
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2,
        h3 {
            font-family: var(--bb-font-head);
            color: var(--bb-navy);
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        a {
            color: var(--bb-primary-dark);
            text-decoration: none;
        }

        a:hover {
            color: var(--bb-primary);
        }

        .bb-navbar {
            background: rgba(247, 250, 249, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--bb-border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .bb-brand {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-family: var(--bb-font-head);
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--bb-navy);
        }

        .bb-brand img {
            height: 48px;
            width: auto;
        }

        .bb-container {
            max-width: 760px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .page-hero {
            padding: 3.25rem 0 2rem;
            text-align: center;
        }

        .page-hero h1 {
            font-size: clamp(1.85rem, 4vw, 2.35rem);
            margin-bottom: 0.6rem;
        }

        .page-hero p {
            color: var(--bb-text-muted);
            font-size: 1.05rem;
            max-width: 40ch;
            margin: 0 auto;
        }

        .last-updated {
            display: inline-block;
            background: var(--bb-primary-light);
            color: var(--bb-primary-dark);
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            margin-top: 1.15rem;
        }

        .content-card {
            background: var(--bb-surface);
            border: 1px solid var(--bb-border);
            border-radius: var(--bb-radius-md);
            padding: clamp(1.75rem, 4vw, 2.75rem);
            margin-bottom: 3rem;
            box-shadow: 0 8px 24px rgba(15, 28, 46, 0.04);
        }

        .content-card h2 {
            font-size: 1.3rem;
            margin: 2.1rem 0 0.75rem;
        }

        .content-card h2:first-child {
            margin-top: 0;
        }

        .content-card h3 {
            font-size: 1.05rem;
            margin: 1.5rem 0 0.5rem;
            color: var(--bb-text);
        }

        .content-card p,
        .content-card li {
            color: var(--bb-text-muted);
            font-size: 0.975rem;
            margin-bottom: 0.85rem;
        }

        .content-card ul {
            padding-left: 1.25rem;
            margin-bottom: 1rem;
        }

        .content-card li {
            margin-bottom: 0.4rem;
        }

        .bb-footer {
            border-top: 1px solid var(--bb-border);
            padding: 2.25rem 0;
            background: var(--bb-bg-alt);
            text-align: center;
            font-size: 0.9rem;
            color: var(--bb-text-faint);
        }

        .bb-footer a {
            margin: 0 0.7rem;
            color: var(--bb-text-muted);
            font-weight: 500;
        }

        .bb-footer a:hover {
            color: var(--bb-primary-dark);
        }

        @media (max-width: 576px) {
            .page-hero {
                padding: 2.25rem 0 1.5rem;
            }

            .content-card {
                padding: 1.5rem 1.25rem;
            }

            .bb-brand img {
                height: 40px;
            }
        }
    </style>
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
                <h1>Privacy Policy</h1>
                <p>How we collect, use, and protect your information.</p>
                <span class="last-updated">Last updated: September 19, 2026</span>
            </div>
        </div>

        <div class="bb-container">
            <div class="content-card">

                <h2>1. Our approach</h2>
                <p>We built BudgetBuddy to help you manage money, not to collect unnecessary data. This policy explains
                    what information we gather, why we need it, and how we look after it.</p>

                <h2>2. Information we collect</h2>

                <h3>Account details</h3>
                <p>When you sign up we collect your name, email address, and password (stored in a secure hashed form).
                </p>

                <h3>Financial data you enter</h3>
                <p>This includes income, expenses, budget amounts, categories, and any notes you add. This information
                    stays private to your account.</p>

                <h3>Technical data</h3>
                <p>Like most websites, we may collect basic technical information such as browser type, device type, and
                    approximate location (country or city level) to keep the service working and secure.</p>

                <h2>3. How we use your information</h2>
                <p>We use your information to:</p>
                <ul>
                    <li>Provide and improve the BudgetBuddy service</li>
                    <li>Send important emails (verification codes, password resets, etc.)</li>
                    <li>Respond to support requests</li>
                    <li>Keep the platform secure and prevent abuse</li>
                </ul>
                <p>We do <strong>not</strong> sell your personal or financial data.</p>

                <h2>4. How we protect your data</h2>
                <p>We use standard security practices, including encrypted connections (HTTPS) and hashed passwords.
                    Access to user data is limited to what’s needed to run and support the service.</p>
                <p>No system is completely secure, but we take reasonable steps to protect your information.</p>

                <h2>5. When we share data</h2>
                <p>We only share information in these limited situations:</p>
                <ul>
                    <li>With trusted service providers who help us operate BudgetBuddy (for example, sending emails),
                        under strict confidentiality</li>
                    <li>When required by law</li>
                    <li>If necessary to protect the rights, safety, or security of BudgetBuddy or our users</li>
                </ul>

                <h2>6. Cookies</h2>
                <p>We use essential cookies so you can stay logged in and the site works properly. We don’t use
                    advertising trackers or sell data to advertisers.</p>

                <h2>7. Your choices</h2>
                <p>You can:</p>
                <ul>
                    <li>Update your account information at any time</li>
                    <li>Request a copy of the data we hold about you</li>
                    <li>Ask us to delete your account and related data</li>
                </ul>
                <p>Just email us at <a href="mailto:budgetbuddyofficialsgmail.com">budgetbuddyofficialsgmail.com</a> and
                    we’ll help.</p>

                <h2>8. Children’s privacy</h2>
                <p>BudgetBuddy is not intended for children under 13. We don’t knowingly collect personal information
                    from children under 13. If you believe a child has created an account, please contact us and we’ll
                    remove it.</p>

                <h2>9. Changes to this policy</h2>
                <p>We may update this Privacy Policy from time to time. The latest version will always be posted here
                    with an updated date.</p>

                <h2>10. Contact</h2>
                <p>Questions about privacy? Write to us at <a
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
