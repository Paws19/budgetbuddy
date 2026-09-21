<!DOCTYPE html>
<html lang="en">
<!-- Head -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BudgetBuddy — Take Control of Your Money</title>
    <meta name="description"
        content="BudgetBuddy helps you track income, manage expenses, set monthly budgets, and understand your spending habits.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts: Nunito (friendly rounded) + Inter (clean body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
</head>

<body>

    <header class="bb-navbar" id="bbNavbar">
        <nav class="navbar navbar-expand-lg bb-container py-2.5" aria-label="Main navigation">
            <a class="bb-brand" href="#home">
                <img src="{{ asset('img/logo.png') }}" alt="BudgetBuddy" class="bb-logo-img" width="150"
                    height="150" loading="lazy">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#bbNav"
                aria-controls="bbNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="bbNav">
                <ul class="navbar-nav align-items-lg-center gap-lg-1 mb-3 mb-lg-0">
                    <li class="nav-item"><a class="nav-link bb-nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link bb-nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link bb-nav-link" href="#how-it-works">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link bb-nav-link" href="#about">About</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2 ms-lg-3">
                    <a href="{{ route('login') }}" class="btn btn-bb-ghost">Login</a>
                    <a href="{{ route('registration') }}" class="btn btn-bb-primary">Get Started</a>
                </div>
            </div>
        </nav>
    </header>

    <main id="home">

        <section class="bb-hero bb-container">
            <div class="bb-blob bb-blob-float"
                style="width: 380px; height: 380px; top: -110px; left: -150px; background: var(--bb-primary-glow);"
                aria-hidden="true"></div>
            <div class="bb-blob bb-blob-float is-b"
                style="width: 280px; height: 280px; bottom: -80px; right: -90px; background: rgba(0, 196, 167, 0.12);"
                aria-hidden="true"></div>

            <div class="row align-items-center g-5">
                <div class="col-lg-6 bb-hero-copy">
                    <span class="bb-eyebrow">👋 Hey, nice to see you</span>
                    <h1>Take Control of Your Money, <span class="bb-highlight">One Budget</span> at a Time.</h1>
                    <p class="bb-lead">
                        Track income, manage everyday expenses, set monthly budgets, and finally understand where your
                        money goes — all in one calm, friendly place.
                    </p>
                    <div class="bb-hero-actions">
                        <a href="{{ route('registration') }}" class="btn btn-bb-primary">Get Started — It’s Free</a>
                        <a href="#features" class="btn btn-bb-outline">Explore Features</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="bb-hero-mock-wrap">
                        <div class="bb-hello" aria-hidden="true">Hi! 👋 Ready to budget?</div>

                        <div class="bb-mock-card" role="img" aria-label="Preview of the BudgetBuddy dashboard">
                            <div class="bb-mock-head">
                                <p class="bb-mock-title">This Month</p>
                                <div class="bb-mock-dot-row" aria-hidden="true">
                                    <span class="bb-mock-dot"></span>
                                    <span class="bb-mock-dot"></span>
                                    <span class="bb-mock-dot"></span>
                                </div>
                            </div>

                            <div class="bb-stat-grid">
                                <div class="bb-stat">
                                    <p class="bb-stat-label">Income</p>
                                    <p class="bb-stat-value is-income mb-0">
                                        <span class="bb-count" data-prefix="&#8369;" data-target="15000">&#8369;0</span>
                                    </p>
                                </div>
                                <div class="bb-stat">
                                    <p class="bb-stat-label">Expenses</p>
                                    <p class="bb-stat-value is-expense mb-0">
                                        <span class="bb-count" data-prefix="&#8369;" data-target="8250">&#8369;0</span>
                                    </p>
                                </div>
                                <div class="bb-stat">
                                    <p class="bb-stat-label">Left</p>
                                    <p class="bb-stat-value mb-0">
                                        <span class="bb-count" data-prefix="&#8369;"
                                            data-target="6750">&#8369;0</span>
                                    </p>
                                </div>
                            </div>

                            <div class="bb-chart bb-animate-chart" aria-hidden="true">
                                <div class="bb-chart-bar" data-height="32"></div>
                                <div class="bb-chart-bar is-strong" data-height="68"></div>
                                <div class="bb-chart-bar" data-height="48"></div>
                                <div class="bb-chart-bar is-strong" data-height="82"></div>
                                <div class="bb-chart-bar" data-height="40"></div>
                            </div>
                            <div class="bb-chart-labels" aria-hidden="true">
                                <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span>
                            </div>

                            <div class="bb-tx-list">
                                <div class="bb-tx-row">
                                    <div class="bb-tx-left">
                                        <span class="bb-tx-icon" aria-hidden="true">🍔</span>
                                        <div>
                                            <p class="bb-tx-name mb-0">Food</p>
                                            <p class="bb-tx-sub mb-0">Today</p>
                                        </div>
                                    </div>
                                    <span class="bb-tx-amount is-expense">-&#8369;250</span>
                                </div>
                                <div class="bb-tx-row">
                                    <div class="bb-tx-left">
                                        <span class="bb-tx-icon" aria-hidden="true">🚌</span>
                                        <div>
                                            <p class="bb-tx-name mb-0">Transport</p>
                                            <p class="bb-tx-sub mb-0">Today</p>
                                        </div>
                                    </div>
                                    <span class="bb-tx-amount is-expense">-&#8369;100</span>
                                </div>
                                <div class="bb-tx-row">
                                    <div class="bb-tx-left">
                                        <span class="bb-tx-icon" aria-hidden="true">🌐</span>
                                        <div>
                                            <p class="bb-tx-name mb-0">Internet</p>
                                            <p class="bb-tx-sub mb-0">Yesterday</p>
                                        </div>
                                    </div>
                                    <span class="bb-tx-amount is-expense">-&#8369;1,200</span>
                                </div>
                                <div class="bb-tx-row">
                                    <div class="bb-tx-left">
                                        <span class="bb-tx-icon" aria-hidden="true">💼</span>
                                        <div>
                                            <p class="bb-tx-name mb-0">Freelance</p>
                                            <p class="bb-tx-sub mb-0">2 days ago</p>
                                        </div>
                                    </div>
                                    <span class="bb-tx-amount is-income">+&#8369;2,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bb-section">
            <div class="bb-container text-center">
                <h2 class="bb-reveal"
                    style="font-size: clamp(1.9rem, 3.5vw, 2.55rem); max-width: 16ch; margin-inline: auto;">
                    Your Money. Your Plan. Your Progress.
                </h2>
                <p class="bb-lead mx-auto mt-3 bb-reveal" style="max-width: 48ch;">
                    BudgetBuddy brings income, expenses, and budgets into one clear view so you always know exactly
                    where you stand — and what to do next.
                </p>
            </div>
        </section>

        <section id="features" class="bb-section bb-section-alt">
            <div class="bb-container">
                <div class="bb-heading-row bb-center bb-reveal">
                    <h2>Everything You Need to Manage Your Budget</h2>
                    <p class="bb-lead mx-auto">
                        A focused set of tools that cover the whole picture — from daily spending to long-term habits.
                    </p>
                </div>

                <div class="row g-4 bb-stagger">
                    <div class="col-md-6 col-lg-3 bb-reveal" style="--bb-i: 0;">
                        <div class="bb-feature-card">
                            <div class="bb-feature-icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M3 3v18h18" />
                                    <path d="M18 17V9" />
                                    <path d="M13 17V5" />
                                    <path d="M8 17v-3" />
                                </svg>
                            </div>
                            <h3>Track Expenses</h3>
                            <p>Log every purchase in seconds and see exactly where your daily spending adds up.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 bb-reveal" style="--bb-i: 1;">
                        <div class="bb-feature-card">
                            <div class="bb-feature-icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 1v22" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                            </div>
                            <h3>Manage Income</h3>
                            <p>Record salary, freelance, and other income so your full picture stays accurate.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 bb-reveal" style="--bb-i: 2;">
                        <div class="bb-feature-card">
                            <div class="bb-feature-icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="16" rx="2" />
                                    <path d="M8 2v4" />
                                    <path d="M16 2v4" />
                                    <path d="M3 10h18" />
                                </svg>
                            </div>
                            <h3>Set Budgets</h3>
                            <p>Set a limit for each category and always know how much room you have left.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 bb-reveal" style="--bb-i: 3;">
                        <div class="bb-feature-card">
                            <div class="bb-feature-icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M12 7v5l3 3" />
                                </svg>
                            </div>
                            <h3>See Patterns</h3>
                            <p>Spot habits over time and understand which ones help or hurt your goals.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works" class="bb-section">
            <div class="bb-container">
                <div class="bb-heading-row bb-center bb-reveal">
                    <h2>Budgeting Made Simple</h2>
                    <p class="bb-lead mx-auto">Three clear steps are all it takes to get a full view of your finances.
                    </p>
                </div>

                <div class="row g-4 bb-stagger">
                    <div class="col-md-4 bb-reveal" style="--bb-i: 0;">
                        <div class="bb-step">
                            <div class="bb-step-num" aria-hidden="true">1</div>
                            <h3>Add Your Income</h3>
                            <p>Enter your salary or other sources of income for the month.</p>
                        </div>
                    </div>
                    <div class="col-md-4 bb-reveal" style="--bb-i: 1;">
                        <div class="bb-step-connector d-md-block"></div>
                        <div class="bb-step">
                            <div class="bb-step-num" aria-hidden="true">2</div>
                            <h3>Track Expenses</h3>
                            <p>Log what you spend as it happens, sorted into clear categories.</p>
                        </div>
                    </div>
                    <div class="col-md-4 bb-reveal" style="--bb-i: 2;">
                        <div class="bb-step-connector d-md-block"></div>
                        <div class="bb-step">
                            <div class="bb-step-num" aria-hidden="true">3</div>
                            <h3>Watch Progress</h3>
                            <p>See your budget update in real time and stay ahead of overspending.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bb-section bb-section-alt">
            <div class="bb-container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-5 bb-reveal-left">
                        <h2 class="mb-3" style="font-size: clamp(1.85rem, 3.3vw, 2.35rem);">See Where Your Money
                            Goes</h2>
                        <p class="bb-lead">
                            One dashboard brings balance, income, expenses, and budget progress together — so nothing
                            gets lost in a spreadsheet.
                        </p>
                    </div>

                    <div class="col-lg-7 bb-reveal-right">
                        <div class="bb-mock-card">
                            <div class="bb-mock-head">
                                <p class="bb-mock-title">Overview</p>
                                <div class="bb-mock-dot-row" aria-hidden="true">
                                    <span class="bb-mock-dot"></span>
                                    <span class="bb-mock-dot"></span>
                                    <span class="bb-mock-dot"></span>
                                </div>
                            </div>

                            <div class="bb-stat-grid">
                                <div class="bb-stat">
                                    <p class="bb-stat-label">Balance</p>
                                    <p class="bb-stat-value mb-0">
                                        <span class="bb-count" data-prefix="&#8369;"
                                            data-target="6750">&#8369;0</span>
                                    </p>
                                </div>
                                <div class="bb-stat">
                                    <p class="bb-stat-label">Income</p>
                                    <p class="bb-stat-value is-income mb-0">
                                        <span class="bb-count" data-prefix="&#8369;"
                                            data-target="15000">&#8369;0</span>
                                    </p>
                                </div>
                                <div class="bb-stat">
                                    <p class="bb-stat-label">Expenses</p>
                                    <p class="bb-stat-value is-expense mb-0">
                                        <span class="bb-count" data-prefix="&#8369;"
                                            data-target="8250">&#8369;0</span>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="bb-stat-label mb-0">Budget Used</span>
                                    <span class="bb-stat-label mb-0">55%</span>
                                </div>
                                <div class="bb-progress-track" role="progressbar" aria-label="Budget used"
                                    aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">
                                    <div class="bb-progress-fill" data-progress="55"></div>
                                </div>
                            </div>

                            <p class="bb-mock-title mb-2" style="font-size: 0.95rem;">Spending Categories</p>
                            <div class="mb-4">
                                <div class="bb-cat-row">
                                    <span class="bb-cat-dot" style="background: #00C4A7;" aria-hidden="true"></span>
                                    <span class="bb-cat-name">Internet</span>
                                    <span class="bb-cat-track"><span class="bb-cat-fill"
                                            data-progress="62"></span></span>
                                    <span class="bb-cat-amount">&#8369;1,200</span>
                                </div>
                                <div class="bb-cat-row">
                                    <span class="bb-cat-dot" style="background: #5EEAD4;" aria-hidden="true"></span>
                                    <span class="bb-cat-name">Food</span>
                                    <span class="bb-cat-track"><span class="bb-cat-fill" data-progress="32"
                                            style="background: linear-gradient(90deg, #5EEAD4, #99F6E4);"></span></span>
                                    <span class="bb-cat-amount">&#8369;250</span>
                                </div>
                                <div class="bb-cat-row">
                                    <span class="bb-cat-dot" style="background: #E84A5F;" aria-hidden="true"></span>
                                    <span class="bb-cat-name">Transport</span>
                                    <span class="bb-cat-track"><span class="bb-cat-fill" data-progress="20"
                                            style="background: linear-gradient(90deg, #E84A5F, #FB7185);"></span></span>
                                    <span class="bb-cat-amount">&#8369;100</span>
                                </div>
                            </div>

                            <p class="bb-mock-title mb-2" style="font-size: 0.95rem;">Recent Transactions</p>
                            <div class="bb-tx-list">
                                <div class="bb-tx-row">
                                    <div class="bb-tx-left">
                                        <span class="bb-tx-icon" aria-hidden="true">🌐</span>
                                        <p class="bb-tx-name mb-0">Internet</p>
                                    </div>
                                    <span class="bb-tx-amount is-expense">-&#8369;1,200</span>
                                </div>
                                <div class="bb-tx-row">
                                    <div class="bb-tx-left">
                                        <span class="bb-tx-icon" aria-hidden="true">🍔</span>
                                        <p class="bb-tx-name mb-0">Food</p>
                                    </div>
                                    <span class="bb-tx-amount is-expense">-&#8369;250</span>
                                </div>
                                <div class="bb-tx-row">
                                    <div class="bb-tx-left">
                                        <span class="bb-tx-icon" aria-hidden="true">💼</span>
                                        <p class="bb-tx-name mb-0">Freelance</p>
                                    </div>
                                    <span class="bb-tx-amount is-income">+&#8369;2,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bb-section">
            <div class="bb-container">
                <div class="bb-blob"
                    style="width: 280px; height: 280px; top: 12%; left: 50%; transform: translateX(-50%); background: var(--bb-primary-glow);"
                    aria-hidden="true"></div>

                <div class="bb-budget-card bb-reveal-scale">
                    <p class="bb-eyebrow mb-2">This Month’s Budget</p>
                    <div class="bb-budget-figures">
                        <div>
                            <p class="bb-budget-figure-label mb-0">Monthly Budget</p>
                            <p class="bb-budget-figure-value mb-0">
                                <span class="bb-count" data-prefix="&#8369;" data-target="10000">&#8369;0</span>
                            </p>
                        </div>
                        <div>
                            <p class="bb-budget-figure-label mb-0">Spent</p>
                            <p class="bb-budget-figure-value mb-0" style="color: var(--bb-expense);">
                                <span class="bb-count" data-prefix="&#8369;" data-target="7500">&#8369;0</span>
                            </p>
                        </div>
                        <div>
                            <p class="bb-budget-figure-label mb-0">Remaining</p>
                            <p class="bb-budget-figure-value mb-0" style="color: var(--bb-success);">
                                <span class="bb-count" data-prefix="&#8369;" data-target="2500">&#8369;0</span>
                            </p>
                        </div>
                    </div>

                    <div class="bb-progress-track" role="progressbar" aria-label="Monthly budget spent"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                        <div class="bb-progress-fill" data-progress="75"></div>
                    </div>
                    <div class="bb-progress-caption">
                        <span>75% of your budget used</span>
                        <span>&#8369;2,500 left</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="bb-section">
            <div class="bb-container">
                <div class="bb-cta bb-reveal-scale" id="get-started">
                    <h2>Ready to Understand Your Spending Better?</h2>
                    <p>
                        Join BudgetBuddy and start building a clearer, calmer relationship with your money — whether
                        you’re 12 or 35.
                    </p>
                    <a href="{{ route('registration') }}" class="btn btn-bb-on-dark">Get Started — It’s Free</a>
                </div>
            </div>
        </section>

    </main>

    <footer id="about" class="bb-footer">
        <div class="bb-container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <a class="bb-brand mb-2 d-inline-flex" href="#home">
                        <img src="{{ asset('img/logo.png') }}" alt="BudgetBuddy" class="bb-logo-img" width="120"
                            height="42"> Budget Buddy
                    </a>
                    <p class="mt-2 mb-0" style="max-width: 34ch;">
                        A simple, friendly way to track income, manage expenses, and stay on top of your monthly budget
                        — for every generation.
                    </p>
                </div>

                <div class="col-lg-7 d-flex align-items-start justify-content-lg-end">
                    <nav aria-label="Footer navigation" class="bb-footer-links">
                        <a href="#home">Home</a>
                        <a href="#features">Features</a>
                        <a href="#how-it-works">How It Works</a>
                        <a href="#about">About</a>
                    </nav>
                </div>
            </div>

            <div class="bb-footer-bottom">
                © 2026 BudgetBuddy. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            var navCollapseEl = document.getElementById('bbNav');
            if (navCollapseEl) {
                navCollapseEl.querySelectorAll('a.nav-link').forEach(function(link) {
                    link.addEventListener('click', function() {
                        if (navCollapseEl.classList.contains('show') && window.bootstrap) {
                            window.bootstrap.Collapse.getOrCreateInstance(navCollapseEl).hide();
                        }
                    });
                });
            }

            var navbar = document.getElementById('bbNavbar');
            var onScroll = function() {
                if (window.scrollY > 12) {
                    navbar.classList.add('is-scrolled');
                } else {
                    navbar.classList.remove('is-scrolled');
                }
            };
            document.addEventListener('scroll', onScroll, {
                passive: true
            });
            onScroll();

            function animateCount(el) {
                var target = parseInt(el.dataset.target, 10) || 0;
                var prefix = el.dataset.prefix || '';
                if (reduceMotion) {
                    el.textContent = prefix + target.toLocaleString('en-PH');
                    return;
                }
                var start = 0;
                var duration = 1300;
                var startTime = null;

                function step(timestamp) {
                    if (!startTime) startTime = timestamp;
                    var progress = Math.min((timestamp - startTime) / duration, 1);
                    var eased = 1 - Math.pow(1 - progress, 3);
                    var value = Math.round(start + (target - start) * eased);
                    el.textContent = prefix + value.toLocaleString('en-PH');
                    if (progress < 1) window.requestAnimationFrame(step);
                }
                window.requestAnimationFrame(step);
            }

            function animateFill(el) {
                var value = el.dataset.progress || el.dataset.height || '0';
                requestAnimationFrame(function() {
                    if (el.classList.contains('bb-chart-bar')) {
                        el.style.height = value + '%';
                    } else {
                        el.style.width = value + '%';
                    }
                });
            }

            var revealTargets = document.querySelectorAll(
                '.bb-reveal, .bb-reveal-scale, .bb-reveal-left, .bb-reveal-right');
            var counters = document.querySelectorAll('.bb-count');
            var fills = document.querySelectorAll('[data-progress], .bb-chart-bar[data-height]');

            if ('IntersectionObserver' in window) {
                var revealObserver = new IntersectionObserver(function(entries, obs) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            obs.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.12,
                    rootMargin: '0px 0px -40px 0px'
                });

                revealTargets.forEach(function(el) {
                    revealObserver.observe(el);
                });

                var chartObserver = new IntersectionObserver(function(entries, obs) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.querySelectorAll('.bb-chart-bar').forEach(function(bar) {
                                animateFill(bar);
                            });
                            obs.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.35
                });

                document.querySelectorAll('.bb-animate-chart').forEach(function(el) {
                    chartObserver.observe(el);
                });

                var countObserver = new IntersectionObserver(function(entries, obs) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            animateCount(entry.target);
                            obs.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.4
                });

                counters.forEach(function(el) {
                    countObserver.observe(el);
                });

                var fillObserver = new IntersectionObserver(function(entries, obs) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            animateFill(entry.target);
                            obs.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.4
                });

                fills.forEach(function(el) {
                    if (!el.classList.contains('bb-chart-bar')) {
                        fillObserver.observe(el);
                    }
                });
            } else {
                revealTargets.forEach(function(el) {
                    el.classList.add('is-visible');
                });
                counters.forEach(animateCount);
                fills.forEach(animateFill);
            }
        });
    </script>

</body>

</html>
