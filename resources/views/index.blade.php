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

    <style>
        :root {
            /* Matched to logo: teal wallet + navy text */
            --bb-bg: #F7FAF9;
            --bb-bg-alt: #EEF6F4;
            --bb-surface: #FFFFFF;
            --bb-text: #0F1C2E;
            --bb-text-muted: #5A6A7A;
            --bb-text-faint: #8A9AAB;
            --bb-border: #D8E5E1;
            --bb-border-soft: #EAF3F0;

            --bb-primary: #00C4A7;
            /* logo wallet teal */
            --bb-primary-dark: #00A88E;
            --bb-primary-light: #D4F7F0;
            --bb-primary-glow: rgba(0, 196, 167, 0.2);

            --bb-navy: #1A2B4A;
            /* logo "Budget" navy */
            --bb-accent: #00C4A7;
            --bb-accent-light: #D4F7F0;

            --bb-success: #00A88E;
            --bb-expense: #E84A5F;

            --bb-shadow-sm: 0 1px 3px rgba(15, 28, 46, 0.05);
            --bb-shadow-md: 0 10px 28px rgba(15, 28, 46, 0.07);
            --bb-shadow-lg: 0 22px 50px rgba(15, 28, 46, 0.1);
            --bb-shadow-glow: 0 14px 36px rgba(0, 196, 167, 0.25);

            --bb-radius-sm: 14px;
            --bb-radius-md: 20px;
            --bb-radius-lg: 28px;
            --bb-radius-xl: 36px;

            --bb-font-head: 'Nunito', system-ui, sans-serif;
            --bb-font-body: 'Inter', system-ui, sans-serif;

            --bb-ease: cubic-bezier(0.25, 0.8, 0.25, 1);
            --bb-ease-soft: cubic-bezier(0.33, 1, 0.68, 1);
            --bb-ease-bounce: cubic-bezier(0.34, 1.4, 0.64, 1);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--bb-font-body);
            color: var(--bb-text);
            background-color: var(--bb-bg);
            line-height: 1.65;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        .bb-font-head {
            font-family: var(--bb-font-head);
            color: var(--bb-text);
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        p {
            color: var(--bb-text-muted);
        }

        a {
            color: var(--bb-primary-dark);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        a:hover {
            color: var(--bb-primary);
        }

        :focus-visible {
            outline: 2px solid var(--bb-primary);
            outline-offset: 3px;
            border-radius: 6px;
        }

        .bb-container {
            max-width: 1120px;
            margin-inline: auto;
            padding-inline: 1.5rem;
            position: relative;
        }

        .bb-section {
            padding-block: clamp(4.5rem, 8vw, 7rem);
            position: relative;
        }

        .bb-section-alt {
            background-color: var(--bb-bg-alt);
        }

        .bb-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--bb-primary-light);
            color: var(--bb-primary-dark);
            font-weight: 600;
            font-size: 0.8125rem;
            padding: 0.4rem 1rem;
            border-radius: 999px;
            margin-bottom: 1rem;
        }

        .bb-lead {
            font-size: 1.125rem;
            line-height: 1.7;
            max-width: 46ch;
        }

        .bb-heading-row {
            max-width: 560px;
            margin-bottom: 3.4rem;
        }

        .bb-heading-row.bb-center {
            margin-inline: auto;
            text-align: center;
        }

        .bb-heading-row h2 {
            font-size: clamp(1.85rem, 3.4vw, 2.45rem);
            margin-bottom: 0.8rem;
        }

        /* Reveals */
        .bb-reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.9s var(--bb-ease-soft), transform 0.9s var(--bb-ease-soft);
        }

        .bb-reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .bb-reveal-scale {
            opacity: 0;
            transform: scale(0.94) translateY(16px);
            transition: opacity 0.95s var(--bb-ease-soft), transform 0.95s var(--bb-ease-soft);
        }

        .bb-reveal-scale.is-visible {
            opacity: 1;
            transform: scale(1) translateY(0);
        }

        .bb-reveal-left {
            opacity: 0;
            transform: translateX(-32px);
            transition: opacity 0.9s var(--bb-ease-soft), transform 0.9s var(--bb-ease-soft);
        }

        .bb-reveal-left.is-visible {
            opacity: 1;
            transform: translateX(0);
        }

        .bb-reveal-right {
            opacity: 0;
            transform: translateX(32px);
            transition: opacity 0.9s var(--bb-ease-soft), transform 0.9s var(--bb-ease-soft);
        }

        .bb-reveal-right.is-visible {
            opacity: 1;
            transform: translateX(0);
        }

        .bb-stagger>* {
            transition-delay: calc(var(--bb-i, 0) * 85ms);
        }

        @media (prefers-reduced-motion: reduce) {

            .bb-reveal,
            .bb-reveal-scale,
            .bb-reveal-left,
            .bb-reveal-right,
            .bb-stagger>* {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }
        }

        .bb-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
            opacity: 0.55;
        }

        @media (prefers-reduced-motion: no-preference) {
            .bb-blob-float {
                animation: bb-float 14s ease-in-out infinite;
            }

            .bb-blob-float.is-b {
                animation-duration: 18s;
                animation-delay: -6s;
            }
        }

        @keyframes bb-float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(12px, -16px) scale(1.04);
            }
        }

        @keyframes bb-wave {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-6deg);
            }

            75% {
                transform: rotate(6deg);
            }
        }

        @keyframes bb-rise {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bb-rise-scale {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes bb-hello-in {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes bb-shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        /* Buttons */
        .btn-bb-primary {
            background: linear-gradient(135deg, #00C4A7, #00D4B5);
            border: none;
            color: #fff;
            font-family: var(--bb-font-body);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.85rem 1.9rem;
            border-radius: 999px;
            box-shadow: 0 8px 22px rgba(0, 196, 167, 0.3);
            transition: transform 0.35s var(--bb-ease-bounce), box-shadow 0.3s ease;
        }

        .btn-bb-primary:hover {
            color: #fff;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 14px 30px rgba(0, 196, 167, 0.38);
        }

        .btn-bb-primary:active {
            transform: translateY(0) scale(0.98);
        }

        .btn-bb-outline {
            background: transparent;
            border: 1.5px solid var(--bb-border);
            color: var(--bb-text);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.8rem 1.75rem;
            border-radius: 999px;
            transition: border-color 0.25s ease, background-color 0.25s ease, transform 0.35s var(--bb-ease-bounce), color 0.2s ease;
        }

        .btn-bb-outline:hover {
            border-color: var(--bb-primary);
            background-color: var(--bb-primary-light);
            color: var(--bb-primary-dark);
            transform: translateY(-3px);
        }

        .btn-bb-ghost {
            background: transparent;
            border: none;
            color: var(--bb-text-muted);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.7rem 0.75rem;
            transition: color 0.2s ease;
        }

        .btn-bb-ghost:hover {
            color: var(--bb-text);
        }

        /* Navbar */
        .bb-navbar {
            background-color: rgba(247, 250, 249, 0.85);
            backdrop-filter: saturate(180%) blur(14px);
            -webkit-backdrop-filter: saturate(180%) blur(14px);
            border-bottom: 1px solid transparent;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: box-shadow 0.35s ease, border-color 0.35s ease, background-color 0.35s ease;
        }

        .bb-navbar.is-scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            border-bottom-color: var(--bb-border);
            box-shadow: 0 4px 20px rgba(15, 28, 46, 0.05);
        }

        .bb-brand {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            font-family: var(--bb-font-head);
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
            color: var(--bb-navy);
        }

        .bb-brand:hover {
            color: var(--bb-navy);
        }

        .bb-logo-img {
            height: 70px;
            width: auto;
            display: block;
            transition: transform 0.5s var(--bb-ease-bounce);
        }

        .bb-brand:hover .bb-logo-img {
            animation: bb-wave 0.7s ease;
        }

        .bb-nav-link {
            color: var(--bb-text-muted);
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.5rem 1rem !important;
            position: relative;
            transition: color 0.2s ease;
        }

        .bb-nav-link:hover {
            color: var(--bb-text);
        }

        .bb-nav-link::after {
            content: "";
            position: absolute;
            left: 1rem;
            right: 1rem;
            bottom: 0.15rem;
            height: 2.5px;
            background: var(--bb-primary);
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s var(--bb-ease);
        }

        .bb-nav-link:hover::after {
            transform: scaleX(1);
        }

        /* Hero */
        .bb-hero {
            padding-block: clamp(3.5rem, 8vw, 6.5rem);
            overflow: hidden;
            position: relative;
        }

        .bb-hero-copy h1 {
            font-size: clamp(2.45rem, 5.2vw, 3.55rem);
            line-height: 1.1;
            margin-bottom: 1.35rem;
            max-width: 13ch;
            font-weight: 800;
            color: var(--bb-navy);
        }

        .bb-hero-copy h1 .bb-highlight {
            color: var(--bb-primary);
        }

        .bb-hero-actions {
            display: flex;
            gap: 0.85rem;
            flex-wrap: wrap;
            margin-top: 2.2rem;
        }

        .bb-hero-copy>* {
            opacity: 0;
            transform: translateY(18px);
            animation: bb-rise 0.85s var(--bb-ease-soft) forwards;
        }

        .bb-hero-copy>*:nth-child(1) {
            animation-delay: 0.08s;
        }

        .bb-hero-copy>*:nth-child(2) {
            animation-delay: 0.18s;
        }

        .bb-hero-copy>*:nth-child(3) {
            animation-delay: 0.28s;
        }

        .bb-hero-copy>*:nth-child(4) {
            animation-delay: 0.38s;
        }

        .bb-hero-mock-wrap {
            opacity: 0;
            transform: translateY(24px) scale(0.97);
            animation: bb-rise-scale 1s var(--bb-ease-soft) 0.25s forwards;
            position: relative;
        }

        @media (prefers-reduced-motion: reduce) {

            .bb-hero-copy>*,
            .bb-hero-mock-wrap {
                opacity: 1;
                transform: none;
                animation: none;
            }
        }

        .bb-hello {
            position: absolute;
            top: -12px;
            right: 12px;
            background: var(--bb-surface);
            border: 1px solid var(--bb-border);
            border-radius: 16px 16px 4px 16px;
            padding: 0.55rem 0.9rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--bb-text);
            box-shadow: var(--bb-shadow-md);
            z-index: 2;
            opacity: 0;
            transform: translateY(8px) scale(0.9);
            animation: bb-hello-in 0.7s var(--bb-ease-bounce) 1.1s forwards;
        }

        /* Mock card */
        .bb-mock-card {
            background: var(--bb-surface);
            border: 1px solid var(--bb-border);
            border-radius: var(--bb-radius-lg);
            box-shadow: var(--bb-shadow-lg);
            padding: 1.7rem;
            position: relative;
            z-index: 1;
            transition: transform 0.5s var(--bb-ease), box-shadow 0.5s ease;
        }

        .bb-mock-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 28px 56px rgba(15, 28, 46, 0.12);
        }

        .bb-mock-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.3rem;
        }

        .bb-mock-title {
            font-family: var(--bb-font-head);
            font-weight: 700;
            font-size: 1.05rem;
            margin: 0;
            letter-spacing: -0.02em;
            color: var(--bb-navy);
        }

        .bb-mock-dot-row {
            display: flex;
            gap: 6px;
        }

        .bb-mock-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background-color: var(--bb-border);
        }

        .bb-mock-dot:nth-child(1) {
            background: #E84A5F;
        }

        .bb-mock-dot:nth-child(2) {
            background: #FBBF24;
        }

        .bb-mock-dot:nth-child(3) {
            background: #00C4A7;
        }

        .bb-stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.7rem;
            margin-bottom: 1.45rem;
        }

        .bb-stat {
            background: var(--bb-bg);
            border: 1px solid var(--bb-border-soft);
            border-radius: var(--bb-radius-sm);
            padding: 0.9rem 0.85rem;
            transition: transform 0.35s var(--bb-ease-bounce), border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .bb-stat:hover {
            transform: translateY(-3px);
            border-color: #99E8D9;
            box-shadow: 0 6px 16px rgba(0, 196, 167, 0.12);
        }

        .bb-stat-label {
            font-size: 0.7rem;
            color: var(--bb-text-faint);
            margin-bottom: 0.28rem;
            font-weight: 550;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .bb-stat-value {
            font-family: var(--bb-font-head);
            font-weight: 800;
            font-size: 1.12rem;
            color: var(--bb-text);
            letter-spacing: -0.02em;
        }

        .bb-stat-value.is-income {
            color: var(--bb-success);
        }

        .bb-stat-value.is-expense {
            color: var(--bb-expense);
        }

        .bb-chart {
            display: flex;
            align-items: flex-end;
            gap: 0.55rem;
            height: 92px;
            padding: 0.35rem 0.1rem 0;
            margin-bottom: 0.3rem;
            border-bottom: 1px solid var(--bb-border);
        }

        .bb-chart-bar {
            flex: 1;
            background: linear-gradient(180deg, #99E8D9, #D4F7F0);
            border-radius: 7px 7px 0 0;
            height: 0;
            transition: height 1.1s var(--bb-ease-soft);
        }

        .bb-chart-bar.is-strong {
            background: linear-gradient(180deg, #00C4A7, #00D4B5);
        }

        .bb-chart-labels {
            display: flex;
            gap: 0.55rem;
            margin-bottom: 1.35rem;
        }

        .bb-chart-labels span {
            flex: 1;
            text-align: center;
            font-size: 0.68rem;
            color: var(--bb-text-faint);
            font-weight: 500;
        }

        .bb-tx-list {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .bb-tx-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 0.6rem;
            border-bottom: 1px solid var(--bb-border-soft);
            transition: transform 0.3s var(--bb-ease);
        }

        .bb-tx-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .bb-tx-row:hover {
            transform: translateX(4px);
        }

        .bb-tx-left {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .bb-tx-icon {
            width: 36px;
            height: 36px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bb-bg);
            font-size: 1rem;
            flex-shrink: 0;
            transition: transform 0.35s var(--bb-ease-bounce);
        }

        .bb-tx-row:hover .bb-tx-icon {
            transform: scale(1.1) rotate(-6deg);
        }

        .bb-tx-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--bb-text);
        }

        .bb-tx-sub {
            font-size: 0.72rem;
            color: var(--bb-text-faint);
        }

        .bb-tx-amount {
            font-weight: 700;
            font-size: 0.9rem;
            font-family: var(--bb-font-head);
            letter-spacing: -0.01em;
        }

        .bb-tx-amount.is-income {
            color: var(--bb-success);
        }

        .bb-tx-amount.is-expense {
            color: var(--bb-expense);
        }

        /* Features */
        .bb-feature-card {
            background: var(--bb-surface);
            border: 1px solid var(--bb-border);
            border-radius: var(--bb-radius-md);
            padding: 2rem 1.7rem;
            height: 100%;
            transition: box-shadow 0.4s var(--bb-ease), border-color 0.35s ease, transform 0.4s var(--bb-ease);
            position: relative;
            overflow: hidden;
        }

        .bb-feature-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--bb-primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s var(--bb-ease);
        }

        .bb-feature-card:hover {
            box-shadow: var(--bb-shadow-md);
            border-color: transparent;
            transform: translateY(-6px);
        }

        .bb-feature-card:hover::before {
            transform: scaleX(1);
        }

        .bb-feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: var(--bb-primary-light);
            color: var(--bb-primary-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.3rem;
            transition: transform 0.4s var(--bb-ease-bounce), background 0.35s ease, color 0.35s ease;
        }

        .bb-feature-card:hover .bb-feature-icon {
            transform: rotate(-7deg) scale(1.1);
            background: var(--bb-primary);
            color: #fff;
        }

        .bb-feature-card h3 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .bb-feature-card p {
            font-size: 0.94rem;
            margin-bottom: 0;
            line-height: 1.6;
        }

        /* Steps */
        .bb-step {
            text-align: center;
            padding-inline: 0.75rem;
        }

        .bb-step-num {
            width: 58px;
            height: 58px;
            margin-inline: auto;
            margin-bottom: 1.25rem;
            border-radius: 50%;
            background: var(--bb-navy);
            color: #fff;
            font-family: var(--bb-font-head);
            font-weight: 800;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.35s ease, transform 0.4s var(--bb-ease-bounce), box-shadow 0.35s ease;
            box-shadow: 0 8px 20px rgba(15, 28, 46, 0.15);
        }

        .bb-step:hover .bb-step-num {
            background: var(--bb-primary);
            transform: scale(1.1) rotate(-5deg);
            box-shadow: 0 12px 28px rgba(0, 196, 167, 0.3);
        }

        .bb-step h3 {
            font-size: 1.12rem;
            margin-bottom: 0.45rem;
            letter-spacing: -0.02em;
        }

        .bb-step p {
            font-size: 0.94rem;
            max-width: 28ch;
            margin-inline: auto;
            line-height: 1.6;
        }

        .bb-step-connector {
            display: none;
        }

        @media (min-width: 768px) {
            .bb-step-connector {
                display: block;
                border-top: 1.5px dashed var(--bb-border);
                margin-top: 29px;
            }
        }

        /* Budget card */
        .bb-budget-card {
            background: var(--bb-surface);
            border: 1px solid var(--bb-border);
            border-radius: var(--bb-radius-xl);
            box-shadow: var(--bb-shadow-md);
            padding: clamp(2.2rem, 5vw, 3.1rem);
            max-width: 620px;
            margin-inline: auto;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .bb-budget-card::after {
            content: "";
            position: absolute;
            top: -35%;
            right: -15%;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, var(--bb-primary-glow), transparent 70%);
            pointer-events: none;
        }

        .bb-budget-figures {
            display: flex;
            justify-content: space-between;
            gap: 1.2rem;
            margin-bottom: 1.65rem;
            flex-wrap: wrap;
        }

        .bb-budget-figure-label {
            font-size: 0.75rem;
            color: var(--bb-text-faint);
            margin-bottom: 0.28rem;
            font-weight: 550;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .bb-budget-figure-value {
            font-family: var(--bb-font-head);
            font-weight: 800;
            font-size: 1.45rem;
            letter-spacing: -0.03em;
        }

        .bb-progress-track {
            width: 100%;
            height: 12px;
            background-color: var(--bb-bg-alt);
            border-radius: 999px;
            overflow: hidden;
        }

        .bb-progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #00C4A7, #00D4B5);
            border-radius: 999px;
            transition: width 1.4s var(--bb-ease-soft);
            position: relative;
        }

        .bb-progress-fill::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: bb-shimmer 2.5s ease-in-out infinite;
        }

        .bb-progress-caption {
            display: flex;
            justify-content: space-between;
            margin-top: 0.7rem;
            font-size: 0.85rem;
            color: var(--bb-text-faint);
            font-weight: 500;
        }

        /* Categories */
        .bb-cat-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.95rem;
        }

        .bb-cat-row:last-child {
            margin-bottom: 0;
        }

        .bb-cat-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .bb-cat-name {
            font-size: 0.9rem;
            color: var(--bb-text);
            width: 100px;
            flex-shrink: 0;
            font-weight: 550;
        }

        .bb-cat-track {
            flex: 1;
            height: 8px;
            background-color: var(--bb-bg-alt);
            border-radius: 999px;
            overflow: hidden;
        }

        .bb-cat-fill {
            display: block;
            height: 100%;
            width: 0%;
            border-radius: 999px;
            background: linear-gradient(90deg, #00C4A7, #00D4B5);
            transition: width 1.2s var(--bb-ease-soft);
        }

        .bb-cat-amount {
            font-size: 0.875rem;
            color: var(--bb-text-muted);
            width: 72px;
            text-align: right;
            flex-shrink: 0;
            font-weight: 700;
            font-family: var(--bb-font-head);
            letter-spacing: -0.01em;
        }

        /* CTA */
        .bb-cta {
            background: linear-gradient(150deg, #0F1C2E 0%, #1A2B4A 55%, #0F1C2E 100%);
            border-radius: var(--bb-radius-xl);
            padding: clamp(3rem, 6.5vw, 4.6rem);
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .bb-cta::before {
            content: "";
            position: absolute;
            top: -30%;
            left: -12%;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(0, 196, 167, 0.28), transparent 65%);
            pointer-events: none;
            animation: bb-float 16s ease-in-out infinite;
        }

        .bb-cta::after {
            content: "";
            position: absolute;
            bottom: -35%;
            right: -10%;
            width: 340px;
            height: 340px;
            background: radial-gradient(circle, rgba(0, 196, 167, 0.18), transparent 65%);
            pointer-events: none;
            animation: bb-float 18s ease-in-out infinite reverse;
        }

        .bb-cta h2 {
            color: #fff;
            font-size: clamp(1.8rem, 3.5vw, 2.4rem);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
            letter-spacing: -0.02em;
        }

        .bb-cta p {
            color: rgba(255, 255, 255, 0.78);
            max-width: 46ch;
            margin-inline: auto;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .btn-bb-on-dark {
            background: linear-gradient(135deg, #00C4A7, #00D4B5);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 0.975rem;
            padding: 0.95rem 2.15rem;
            border-radius: 999px;
            transition: transform 0.35s var(--bb-ease-bounce), box-shadow 0.3s ease;
            position: relative;
            z-index: 1;
            box-shadow: 0 10px 28px rgba(0, 196, 167, 0.35);
        }

        .btn-bb-on-dark:hover {
            color: #fff;
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 16px 36px rgba(0, 196, 167, 0.42);
        }

        /* Footer */
        .bb-footer {
            border-top: 1px solid var(--bb-border);
            padding-block: 3.4rem 2.4rem;
            background-color: var(--bb-bg-alt);
        }

        .bb-footer p {
            font-size: 0.94rem;
            line-height: 1.65;
        }

        .bb-footer-links {
            display: flex;
            gap: 1.7rem;
            flex-wrap: wrap;
        }

        .bb-footer-links a {
            color: var(--bb-text-muted);
            font-size: 0.94rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .bb-footer-links a:hover {
            color: var(--bb-primary-dark);
        }

        .bb-footer-bottom {
            border-top: 1px solid var(--bb-border);
            margin-top: 2.4rem;
            padding-top: 1.45rem;
            font-size: 0.85rem;
            color: var(--bb-text-faint);
        }

        @media (max-width: 767.98px) {
            .bb-stat-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 0.45rem;
            }

            .bb-stat-value {
                font-size: 0.95rem;
            }

            .bb-stat {
                padding: 0.7rem 0.5rem;
            }

            .bb-hero-copy h1 {
                max-width: 100%;
            }

            .bb-hello {
                display: none;
            }

            .bb-logo-img {
                height: 36px;
            }
        }
    </style>
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
