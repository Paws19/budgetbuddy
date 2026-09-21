<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — BudgetBuddy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

</head>

<body>
    <div class="overlay" id="overlay"></div>
    <div class="toast" id="toast"></div>

    <form id="resetForm" action="{{ route('dashboard.reset') }}" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>

    <!-- ==================== ADD INCOME MODAL ==================== -->
    <div class="modal-backdrop" id="modalIncome">
        <div class="modal">
            <h2>Add income</h2>
            <p class="sub">Record salary, freelance, or other money in.</p>
            @if ($errors->any())
                <div
                    style="background:#FEE2E2;color:#991B1B;padding:12px 16px;border-radius:12px;margin-bottom:16px;font-size:14px;">
                    <ul style="margin:0;padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('income.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label for="incSource">Source</label>
                    <input id="incSource" name="source" type="text" value="{{ old('source') }}"
                        placeholder="e.g. Salary, Freelance" required>
                </div>
                <div class="field">
                    <label for="incAmount">Amount (₱)</label>
                    <input id="incAmount" name="amount_display" type="text" inputmode="decimal"
                        value="{{ old('amount') ? number_format(old('amount'), 2) : '' }}" placeholder="20,000.00"
                        required>
                    <input type="hidden" name="amount" id="incAmountHidden" value="{{ old('amount') }}">
                </div>
                <div class="field">
                    <label for="incDate">Date</label>
                    <input id="incDate" type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                        required>
                </div>
                <div class="field">
                    <label for="incDesc">Description</label>
                    <input id="incDesc" name="description" type="text" value="{{ old('description') }}"
                        placeholder="Optional notes">
                </div>
                <div class="field">
                    <label for="incCat">Category</label>
                    <select id="incCat" name="category_id" required>
                        <option value="">Select category</option>
                        @foreach (($incomeCategories ?? collect())->sortBy('name') as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}</option>
                        @endforeach
                        <option value="other" {{ old('category_id') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="field" id="incOtherField"
                    style="display: {{ old('category_id') == 'other' ? 'block' : 'none' }};">
                    <label for="incOtherCat">Other category name</label>
                    <input id="incOtherCat" name="other_category" type="text" value="{{ old('other_category') }}"
                        placeholder="e.g. Rental, Commission, Gift">
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-outline" data-close="modalIncome">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save income</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== ADD EXPENSE MODAL ==================== -->
    <div class="modal-backdrop" id="modalExpense">
        <div class="modal">
            <h2>Log expense</h2>
            <p class="sub">Track what you spent today.</p>
            @if ($errors->any())
                <div
                    style="background:#FEE2E2;color:#991B1B;padding:12px 16px;border-radius:12px;margin-bottom:16px;font-size:14px;">
                    <ul style="margin:0;padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('expense.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label for="expName">Description</label>
                    <input id="expName" name="source" type="text" value="{{ old('source') }}"
                        placeholder="e.g. Lunch, Grab" required>
                </div>
                <div class="field">
                    <label for="expAmt">Amount (₱)</label>
                    <input id="expAmt" name="amount" type="number" min="0.01" step="0.01"
                        value="{{ old('amount') }}" placeholder="250" required>
                </div>
                <div class="field">
                    <label for="expDate">Date</label>
                    <input id="expDate" name="date" type="date" value="{{ old('date', date('Y-m-d')) }}"
                        required>
                </div>
                <div class="field">
                    <label for="expCat">Category</label>
                    <select id="expCat" name="category_id" required>
                        <option value="">Select category</option>
                        @foreach ($expenseCategories ?? [] as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name == 'Transport' ? 'Transportation' : $cat->name }}
                            </option>
                        @endforeach
                        <option value="other" {{ old('category_id') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="field" id="expOtherField"
                    style="display: {{ old('category_id') == 'other' ? 'block' : 'none' }};">
                    <label for="expOtherCat">Other category name</label>
                    <input id="expOtherCat" name="other_category" type="text"
                        value="{{ old('other_category') }}" placeholder="e.g. Shopping, Medical, Subscription">
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-outline" data-close="modalExpense">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save expense</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== ADD BUDGET MODAL ==================== -->
    <div class="modal-backdrop" id="modalBudget">
        <div class="modal">
            <h2>Set budget</h2>
            <p class="sub">Update monthly limit for a category.</p>
            <form action="{{ route('budget.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label for="budCat">Category</label>
                    <select id="budCat" name="category_id" required>
                        <option value="">Select category</option>
                        @foreach ($budgetCategories ?? [] as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name == 'Transport' ? 'Transportation' : $cat->name }}
                            </option>
                        @endforeach
                        <option value="other" {{ old('category_id') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="field" id="budOtherField"
                    style="display: {{ old('category_id') == 'other' ? 'block' : 'none' }};">
                    <label for="budOtherCat">Other category name</label>
                    <input id="budOtherCat" name="other_category" type="text"
                        value="{{ old('other_category') }}" placeholder="e.g. Shopping, Medical, Education">
                </div>
                <div class="field">
                    <label for="budLimit">Monthly limit (₱)</label>
                    <input id="budLimit" name="monthly_limit_display" type="text" inputmode="decimal"
                        value="{{ old('monthly_limit') ? number_format(old('monthly_limit'), 0) : '' }}"
                        placeholder="5,000" required>
                    <input type="hidden" name="monthly_limit" id="budLimitHidden"
                        value="{{ old('monthly_limit') }}">
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-outline" data-close="modalBudget">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save budget</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== EDIT INCOME MODAL ==================== -->
    <div class="modal-backdrop" id="modalEditIncome">
        <div class="modal">
            <h2>Edit income</h2>
            <p class="sub">Update this income entry.</p>
            <form id="formEditIncome" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editIncId">
                <div class="field">
                    <label for="editIncSource">Source</label>
                    <input id="editIncSource" name="source" type="text" required>
                </div>
                <div class="field">
                    <label for="editIncAmount">Amount (₱)</label>
                    <input id="editIncAmount" name="amount_display" type="text" inputmode="decimal" required>
                    <input type="hidden" name="amount" id="editIncAmountHidden">
                </div>
                <div class="field">
                    <label for="editIncDate">Date</label>
                    <input id="editIncDate" type="date" name="date" required>
                </div>
                <div class="field">
                    <label for="editIncCat">Category</label>
                    <select id="editIncCat" name="category_id" required>
                        <option value="">Select category</option>
                        @foreach (($incomeCategories ?? collect())->sortBy('name') as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="field" id="editIncOtherField" style="display:none;">
                    <label for="editIncOtherCat">Other category name</label>
                    <input id="editIncOtherCat" name="other_category" type="text">
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-outline" data-close="modalEditIncome">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update income</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== EDIT EXPENSE MODAL ==================== -->
    <div class="modal-backdrop" id="modalEditExpense">
        <div class="modal">
            <h2>Edit expense</h2>
            <p class="sub">Update this expense entry.</p>
            <form id="formEditExpense" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editExpId">
                <div class="field">
                    <label for="editExpName">Description</label>
                    <input id="editExpName" name="source" type="text" required>
                </div>
                <div class="field">
                    <label for="editExpAmt">Amount (₱)</label>
                    <input id="editExpAmt" name="amount" type="number" min="0.01" step="0.01" required>
                </div>
                <div class="field">
                    <label for="editExpDate">Date</label>
                    <input id="editExpDate" name="date" type="date" required>
                </div>
                <div class="field">
                    <label for="editExpCat">Category</label>
                    <select id="editExpCat" name="category_id" required>
                        <option value="">Select category</option>
                        @foreach ($expenseCategories ?? [] as $cat)
                            <option value="{{ $cat->id }}">
                                {{ $cat->name == 'Transport' ? 'Transportation' : $cat->name }}</option>
                        @endforeach
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="field" id="editExpOtherField" style="display:none;">
                    <label for="editExpOtherCat">Other category name</label>
                    <input id="editExpOtherCat" name="other_category" type="text">
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-outline" data-close="modalEditExpense">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update expense</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== EDIT BUDGET MODAL ==================== -->
    <div class="modal-backdrop" id="modalEditBudget">
        <div class="modal">
            <h2>Edit budget</h2>
            <p class="sub">Update monthly limit for this category.</p>
            <form id="formEditBudget" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="category" id="editBudCatName">
                <div class="field">
                    <label>Category</label>
                    <input type="text" id="editBudCatDisplay" disabled
                        style="background:#f1f5f9; cursor:not-allowed;">
                </div>
                <div class="field">
                    <label for="editBudLimit">Monthly limit (₱)</label>
                    <input id="editBudLimit" name="monthly_limit_display" type="text" inputmode="decimal"
                        required>
                    <input type="hidden" name="monthly_limit" id="editBudLimitHidden">
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-outline" data-close="modalEditBudget">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update budget</button>
                </div>
            </form>
        </div>
    </div>

    @php
        $user = auth()->user();
        $firstName = $user->first_name ?? 'Buddy';
        $lastName = $user->last_name ?? '';
        $displayName = trim($firstName . ' ' . $lastName) ?: $user->name ?? 'User';
        $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
        if (strlen($initials) < 2) {
            $initials = strtoupper(substr($displayName, 0, 2));
        }
    @endphp

    <div class="app">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <img src="{{ asset('img/logo.png') }}" alt="BudgetBuddy"
                    style="height:42px;width:auto;object-fit:contain;" onerror="this.style.display='none'">
                <span>BudgetBuddy</span>
            </div>
            <ul class="nav-list">
                <li><button type="button" class="nav-btn active" data-view="dashboard">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="9" rx="1" />
                            <rect x="14" y="3" width="7" height="5" rx="1" />
                            <rect x="14" y="12" width="7" height="9" rx="1" />
                            <rect x="3" y="16" width="7" height="5" rx="1" />
                        </svg>
                        Dashboard</button></li>
                <li><button type="button" class="nav-btn" data-view="income">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 1v22" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                        Income</button></li>
                <li><button type="button" class="nav-btn" data-view="expenses">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v18h18" />
                            <path d="M18 17V9" />
                            <path d="M13 17V5" />
                            <path d="M8 17v-3" />
                        </svg>
                        Expenses</button></li>
                <li><button type="button" class="nav-btn" data-view="budgets">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="16" rx="2" />
                            <path d="M8 2v4" />
                            <path d="M16 2v4" />
                            <path d="M3 10h18" />
                        </svg>
                        Budgets</button></li>
                <li><button type="button" class="nav-btn" data-view="patterns">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 7v5l3 3" />
                        </svg>
                        Patterns</button></li>
            </ul>
            <div class="sidebar-user">
                <div class="sidebar-user-info">
                    <div class="avatar">{{ $initials }}</div>
                    <div>
                        <div class="user-name">{{ $displayName }}</div>
                        <div class="user-email">{{ $user->email ?? '' }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" id="logoutFormSidebar">
                    @csrf
                    <button type="submit" class="btn-logout" title="Log out">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" y1="12" x2="9" y2="12" />
                        </svg>
                        Log out
                    </button>
                </form>
            </div>
        </aside>

        <div class="main">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menuToggle" aria-label="Menu">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div>
                        <h1 class="page-title" id="pageTitle">Dashboard</h1>
                        <p class="page-sub" id="pageSub">
                            Hi <strong>{{ $firstName }}</strong>! Here’s your money overview for
                            {{ now()->format('F Y') }}
                        </p>
                    </div>
                </div>
                <div class="topbar-actions">
                    <button type="button" class="theme-toggle" id="themeToggle" title="Toggle dark mode"
                        aria-label="Toggle dark mode">
                        <svg class="icon-moon" viewBox="0 0 24 24">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                        </svg>
                        <svg class="icon-sun" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="5" />
                            <path
                                d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
                        </svg>
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="btn-logout-top-wrap"
                        style="display:contents">
                        @csrf
                        <button type="submit" class="btn-logout-top" title="Log out" aria-label="Log out">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <polyline points="16 17 21 12 16 7" />
                                <line x1="21" y1="12" x2="9" y2="12" />
                            </svg>
                            <span class="btn-full">Log out</span><span class="btn-short">Out</span>
                        </button>
                    </form>
                    <button type="button" class="btn btn-export" id="btnExport"
                        title="Download Excel (.xlsx)"><span class="btn-full">Export Excel</span><span
                            class="btn-short">Export</span></button>
                    <button type="button" class="btn btn-danger" id="btnReset"
                        title="Permanently delete all data">Reset</button>
                    <button type="button" class="btn btn-outline" id="btnIncome"><span class="btn-full">+
                            Income</span><span class="btn-short">+ Income</span></button>
                    <button type="button" class="btn btn-primary" id="btnExpense"><span class="btn-full">+
                            Expense</span><span class="btn-short">+ Expense</span></button>
                </div>
            </header>

            <div class="content">
                <!-- DASHBOARD -->
                <div class="view active" id="view-dashboard">
                    <div class="quick-actions">
                        <button type="button" class="quick-card" id="qaIncome">
                            <div class="quick-icon"><svg width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 5v14" />
                                    <path d="M5 12h14" />
                                </svg></div>
                            <div>
                                <div class="quick-label">Add income</div>
                                <div class="quick-sub">Salary, freelance, gifts</div>
                            </div>
                        </button>
                        <button type="button" class="quick-card" id="qaExpense">
                            <div class="quick-icon"><svg width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14" />
                                </svg></div>
                            <div>
                                <div class="quick-label">Log expense</div>
                                <div class="quick-sub">Food, transport, bills</div>
                            </div>
                        </button>
                        <button type="button" class="quick-card" id="qaBudget">
                            <div class="quick-icon"><svg width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="16" rx="2" />
                                    <path d="M3 10h18" />
                                </svg></div>
                            <div>
                                <div class="quick-label">Set budget</div>
                                <div class="quick-sub">Limits per category</div>
                            </div>
                        </button>
                    </div>
                    <div class="stats" id="dashStats"></div>
                    <div class="panels">
                        <div class="panel">
                            <div class="panel-head">
                                <h2 class="panel-title">This month’s budget</h2>
                                <button type="button" class="btn btn-ghost" id="dashManageBudget">Manage</button>
                            </div>
                            <div id="dashBudgetSummary"></div>
                            <div class="progress-track">
                                <div class="progress-fill" id="dashProgress"></div>
                            </div>
                            <div class="progress-caption"><span id="dashProgressLabel">0% used</span><span>This
                                    month</span></div>
                            <div style="margin-top:1.5rem">
                                <h3 class="panel-title" style="font-size:.95rem;margin-bottom:.9rem">Category budgets
                                </h3>
                                <div class="cat-list" id="dashCats"></div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-head">
                                <h2 class="panel-title">Spending this week</h2><span class="badge">This week</span>
                            </div>
                            <div class="week-chart" id="weekChart"></div>
                            <p style="font-size:.85rem;color:var(--text-2);margin:.75rem 0 0" id="weekInsight">
                                Loading…</p>
                        </div>
                    </div>
                    <div class="bottom-panels">
                        <div class="panel">
                            <div class="panel-head">
                                <h2 class="panel-title">Recent income</h2><button type="button"
                                    class="btn btn-ghost nav-jump" data-view="income">See all</button>
                            </div>
                            <div class="tx-list" id="dashIncome"></div>
                        </div>
                        <div class="panel">
                            <div class="panel-head">
                                <h2 class="panel-title">Recent expenses</h2><button type="button"
                                    class="btn btn-ghost nav-jump" data-view="expenses">See all</button>
                            </div>
                            <div class="tx-list" id="dashExpenses"></div>
                        </div>
                    </div>
                </div>

                <!-- INCOME -->
                <div class="view" id="view-income">
                    <div class="section-head">
                        <p style="margin:0;color:var(--text-2);font-size:.95rem">Manage all money coming in.</p>
                        <button type="button" class="btn btn-primary" id="incPageAdd">+ Add income</button>
                    </div>
                    <div class="filter-bar" id="incomeFilterBar">
                        <div class="filter-search">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <path d="M21 21l-4.35-4.35" />
                            </svg>
                            <input type="text" id="incFilterSearch" placeholder="Search source or category…">
                        </div>
                        <select id="incFilterCat">
                            <option value="">All categories</option>
                        </select>
                        <button type="button" class="btn-clear-filter" id="incFilterClear">Clear</button>
                        <span class="filter-count" id="incFilterCount"></span>
                    </div>
                    <div class="panel">
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Source</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th style="text-align:right">Amount</th>
                                        <th style="text-align:center;width:110px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="incomeTable"></tbody>
                            </table>
                        </div>
                        <div class="empty" id="incomeEmpty" style="display:none">No income yet. Click “+ Add
                            income”.</div>
                    </div>
                </div>

                <!-- EXPENSES -->
                <div class="view" id="view-expenses">
                    <div class="section-head">
                        <p style="margin:0;color:var(--text-2);font-size:.95rem">Track every purchase.</p>
                        <button type="button" class="btn btn-primary" id="expPageAdd">+ Log expense</button>
                    </div>
                    <div class="filter-bar" id="expenseFilterBar">
                        <div class="filter-search">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <path d="M21 21l-4.35-4.35" />
                            </svg>
                            <input type="text" id="expFilterSearch" placeholder="Search description or category…">
                        </div>
                        <select id="expFilterCat">
                            <option value="">All categories</option>
                        </select>
                        <button type="button" class="btn-clear-filter" id="expFilterClear">Clear</button>
                        <span class="filter-count" id="expFilterCount"></span>
                    </div>
                    <div class="panel">
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th style="text-align:right">Amount</th>
                                        <th style="text-align:center;width:110px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="expenseTable"></tbody>
                            </table>
                        </div>
                        <div class="empty" id="expenseEmpty" style="display:none">No expenses yet. Click “+ Log
                            expense”.</div>
                    </div>
                </div>

                <!-- BUDGETS -->
                <div class="view" id="view-budgets">
                    <div class="section-head">
                        <p style="margin:0;color:var(--text-2);font-size:.95rem">Set limits so you stay on track.</p>
                        <button type="button" class="btn btn-primary" id="budPageAdd">Set / edit budget</button>
                    </div>
                    <div class="filter-bar" id="budgetFilterBar">
                        <div class="filter-search">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <path d="M21 21l-4.35-4.35" />
                            </svg>
                            <input type="text" id="budFilterSearch" placeholder="Search category…">
                        </div>
                        <select id="budFilterStatus">
                            <option value="">All status</option>
                            <option value="ok">On track (&lt;75%)</option>
                            <option value="watch">Watch (75–89%)</option>
                            <option value="over">Near/Over limit (≥90%)</option>
                        </select>
                        <button type="button" class="btn-clear-filter" id="budFilterClear">Clear</button>
                        <span class="filter-count" id="budFilterCount"></span>
                    </div>
                    <div class="panel">
                        <div class="cat-list" id="budgetPageList"></div>
                    </div>
                    <div class="panel" style="margin-top:1.25rem">
                        <div class="panel-head">
                            <h2 class="panel-title">Monthly total budget</h2>
                        </div>
                        <div id="budgetPageTotal"></div>
                    </div>
                </div>

                <!-- PATTERNS -->
                <div class="view" id="view-patterns">
                    <div class="panel" style="margin-bottom:1.25rem">
                        <div class="panel-head">
                            <h2 class="panel-title">Spending this week</h2><span class="badge">This week</span>
                        </div>
                        <div class="week-chart" id="patternsChart"></div>
                        <p style="font-size:.9rem;color:var(--text-2);margin:.75rem 0 0" id="patternsInsight"></p>
                    </div>
                    <div class="panel">
                        <div class="panel-head">
                            <h2 class="panel-title">By category</h2>
                        </div>
                        <div class="cat-list" id="patternsCats"></div>
                    </div>
                </div>

                <p class="footer-note">BudgetBuddy · Finance Tracker</p>
            </div>
        </div>
    </div>

    <script>
        @php
            $__bbData = $dashboardData ?? [
                'income' => [],
                'expenses' => [],
                'budgets' => new \stdClass(),
                'weekSpend' => [0, 0, 0, 0, 0, 0, 0],
            ];
        @endphp
        window.__bbInitialData = @json($__bbData);

        (function() {
            function normalizeCat(name) {
                if (!name) return 'Other';
                var n = String(name).replace(/_/g, ' ').trim();
                if (n.toLowerCase() === 'transport') return 'Transportation';
                return n;
            }

            function normalizeIncome(list) {
                return (list || []).map(function(i) {
                    return {
                        id: i.id,
                        name: i.name || i.source || 'Income',
                        cat: normalizeCat(i.cat || i.category || 'Other'),
                        amount: Number(i.amount) || 0,
                        date: i.date || ''
                    };
                });
            }

            function normalizeExpenses(list) {
                return (list || []).map(function(e) {
                    return {
                        id: e.id,
                        name: e.name || e.source || e.description || 'Expense',
                        cat: normalizeCat(e.cat || e.category || 'Other'),
                        amount: Number(e.amount) || 0,
                        date: e.date || ''
                    };
                });
            }

            function normalizeBudgets(obj) {
                var out = {};
                if (!obj) return out;
                if (Array.isArray(obj)) {
                    obj.forEach(function(b) {
                        var key = normalizeCat(b.category || b.cat || 'Other');
                        out[key] = Number(b.monthly_limit || b.amount_limit || b.limit || b.amount) || 0;
                    });
                } else {
                    Object.keys(obj).forEach(function(k) {
                        out[normalizeCat(k)] = Number(obj[k]) || 0;
                    });
                }
                return out;
            }

            function computeWeekSpend(expenses) {
                var spend = [0, 0, 0, 0, 0, 0, 0];
                if (!expenses || !expenses.length) return spend;
                var now = new Date();
                var day = now.getDay();
                var mondayOffset = day === 0 ? -6 : 1 - day;
                var monday = new Date(now.getFullYear(), now.getMonth(), now.getDate() + mondayOffset);
                monday.setHours(0, 0, 0, 0);
                var sunday = new Date(monday);
                sunday.setDate(monday.getDate() + 6);
                sunday.setHours(23, 59, 59, 999);

                expenses.forEach(function(e) {
                    if (!e.date) return;
                    var parts = String(e.date).slice(0, 10).split('-');
                    if (parts.length < 3) return;
                    var d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10),
                        12, 0, 0);
                    if (isNaN(d.getTime())) return;
                    if (d < monday || d > sunday) return;
                    var idx = d.getDay() === 0 ? 6 : d.getDay() - 1;
                    spend[idx] += Number(e.amount) || 0;
                });
                return spend;
            }

            function buildStateFromServer(raw) {
                raw = raw || {};
                return {
                    income: normalizeIncome(raw.income),
                    expenses: normalizeExpenses(raw.expenses),
                    budgets: normalizeBudgets(raw.budgets),
                    weekSpend: computeWeekSpend(normalizeExpenses(raw.expenses)),
                    nextId: 1
                };
            }

            var state = buildStateFromServer(window.__bbInitialData);
            window.__bbState = state;

            var filters = {
                income: {
                    search: '',
                    cat: ''
                },
                expenses: {
                    search: '',
                    cat: ''
                },
                budgets: {
                    search: '',
                    status: ''
                }
            };

            var catIcons = {
                Food: '🍔',
                Transport: '🚌',
                Transportation: '🚌',
                Internet: '🌐',
                Fun: '🎮',
                Bills: '📄',
                Other: '📦',
                Work: '💼',
                'Side hustle': '💻',
                'Side Hustle': '💻',
                Gift: '🎁'
            };
            var catColors = {
                Food: '#F5A623',
                Transport: '#3B82F6',
                Transportation: '#3B82F6',
                Internet: '#00BFA5',
                Fun: '#7C6CF0',
                Bills: '#E14B5A',
                Other: '#8B95A5'
            };

            function peso(n) {
                return '₱' + Number(n).toLocaleString('en-PH');
            }

            function totalIncome() {
                return state.income.reduce(function(s, i) {
                    return s + i.amount;
                }, 0);
            }

            function totalExpenses() {
                return state.expenses.reduce(function(s, e) {
                    return s + e.amount;
                }, 0);
            }

            function totalBudget() {
                var t = 0;
                for (var k in state.budgets) t += state.budgets[k];
                return t;
            }

            function spentInCat(cat) {
                return state.expenses.filter(function(e) {
                        return e.cat === cat;
                    })
                    .reduce(function(s, e) {
                        return s + e.amount;
                    }, 0);
            }

            function formatDate(d) {
                if (!d) return '—';
                var parts = String(d).split('-');
                if (parts.length < 3) return d;
                var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                return months[parseInt(parts[1], 10) - 1] + ' ' + parseInt(parts[2], 10);
            }

            function toast(msg) {
                var el = document.getElementById('toast');
                el.textContent = msg;
                el.classList.add('show');
                setTimeout(function() {
                    el.classList.remove('show');
                }, 2500);
            }

            function openModal(id) {
                document.getElementById(id).classList.add('show');
            }

            function closeModal(id) {
                document.getElementById(id).classList.remove('show');
            }

            function showView(name) {
                document.querySelectorAll('.view').forEach(function(v) {
                    v.classList.remove('active');
                });
                document.querySelectorAll('.nav-btn').forEach(function(b) {
                    b.classList.remove('active');
                });
                var view = document.getElementById('view-' + name);
                if (view) view.classList.add('active');
                var btn = document.querySelector('.nav-btn[data-view="' + name + '"]');
                if (btn) btn.classList.add('active');

                var titles = {
                    dashboard: 'Dashboard',
                    income: 'Income',
                    expenses: 'Expenses',
                    budgets: 'Budgets',
                    patterns: 'Patterns'
                };
                document.getElementById('pageTitle').textContent = titles[name] || 'Dashboard';

                var firstName = @json($firstName);
                var monthYear = @json(now()->format('F Y'));
                var sub = document.getElementById('pageSub');
                if (sub) {
                    if (name === 'dashboard') sub.innerHTML = 'Hi <strong>' + firstName +
                        '</strong>! Here’s your money overview for ' + monthYear;
                    else if (name === 'income') sub.innerHTML = 'Hi <strong>' + firstName +
                        '</strong>! Manage all money coming in.';
                    else if (name === 'expenses') sub.innerHTML = 'Hi <strong>' + firstName +
                        '</strong>! Track every purchase here.';
                    else if (name === 'budgets') sub.innerHTML = 'Hi <strong>' + firstName +
                        '</strong>! Set limits so you stay on track.';
                    else if (name === 'patterns') sub.innerHTML = 'Hi <strong>' + firstName +
                        '</strong>! See your spending patterns.';
                }
                render();
                closeMenu();
            }

            document.querySelectorAll('.nav-btn').forEach(function(b) {
                b.addEventListener('click', function() {
                    showView(b.getAttribute('data-view'));
                });
            });
            document.querySelectorAll('.nav-jump').forEach(function(b) {
                b.addEventListener('click', function() {
                    showView(b.getAttribute('data-view'));
                });
            });

            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('overlay');

            function closeMenu() {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
            }

            function openMenu() {
                sidebar.classList.add('open');
                overlay.classList.add('show');
            }
            document.getElementById('menuToggle').addEventListener('click', function() {
                sidebar.classList.contains('open') ? closeMenu() : openMenu();
            });
            overlay.addEventListener('click', closeMenu);

            document.getElementById('btnIncome').addEventListener('click', function() {
                openModal('modalIncome');
            });
            document.getElementById('btnExpense').addEventListener('click', function() {
                openModal('modalExpense');
            });
            document.getElementById('qaIncome').addEventListener('click', function() {
                openModal('modalIncome');
            });
            document.getElementById('qaExpense').addEventListener('click', function() {
                openModal('modalExpense');
            });
            document.getElementById('qaBudget').addEventListener('click', function() {
                openModal('modalBudget');
            });
            document.getElementById('incPageAdd').addEventListener('click', function() {
                openModal('modalIncome');
            });
            document.getElementById('expPageAdd').addEventListener('click', function() {
                openModal('modalExpense');
            });
            document.getElementById('budPageAdd').addEventListener('click', function() {
                openModal('modalBudget');
            });
            document.getElementById('dashManageBudget').addEventListener('click', function() {
                showView('budgets');
            });

            document.querySelectorAll('[data-close]').forEach(function(b) {
                b.addEventListener('click', function() {
                    closeModal(b.getAttribute('data-close'));
                });
            });
            document.querySelectorAll('.modal-backdrop').forEach(function(bd) {
                bd.addEventListener('click', function(e) {
                    if (e.target === bd) bd.classList.remove('show');
                });
            });

            function renderTxRow(item, isIncome) {
                var icon = catIcons[item.cat] || (isIncome ? '💰' : '📦');
                return '<div class="tx-row"><div class="tx-left"><div class="tx-icon">' + icon + '</div><div>' +
                    '<div class="tx-name">' + item.name + '</div>' +
                    '<div class="tx-sub">' + formatDate(item.date) + ' · ' + item.cat + '</div></div></div>' +
                    '<div class="tx-amt ' + (isIncome ? 'up' : 'down') + '">' + (isIncome ? '+' : '−') + peso(item
                        .amount) + '</div></div>';
            }

            function renderWeekChart(containerId) {
                var el = document.getElementById(containerId);
                if (!el) return;
                var values = state.weekSpend || [0, 0, 0, 0, 0, 0, 0];
                var max = Math.max.apply(null, values.concat([1]));
                var days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                var html = '',
                    maxIdx = 0;
                values.forEach(function(v, i) {
                    if (v > values[maxIdx]) maxIdx = i;
                });
                var anySpend = values.some(function(v) {
                    return v > 0;
                });
                values.forEach(function(v, i) {
                    var h = v <= 0 ? 0 : Math.max(8, Math.round((v / max) * 100));
                    html += '<div class="week-bar-wrap" title="' + days[i] + ': ' + peso(v) + '">' +
                        '<div class="week-bar-amt">' + (v > 0 ? peso(v) : '') + '</div>' +
                        '<div class="week-bar' + (i === maxIdx && v > 0 ? ' hi' : '') + '" style="height:' + h +
                        '%"></div>' +
                        '<span class="week-label">' + days[i] + '</span></div>';
                });
                if (!anySpend) {
                    html =
                        '<div class="empty" style="padding:1.5rem;text-align:center;width:100%">No spending this week yet. Log an expense to see the chart.</div>';
                }
                el.innerHTML = html;
            }

            function getFilteredIncome() {
                var list = state.income.slice();
                var q = (filters.income.search || '').toLowerCase().trim();
                var cat = filters.income.cat || '';
                if (q) list = list.filter(function(i) {
                    return (i.name || '').toLowerCase().indexOf(q) !== -1 || (i.cat || '').toLowerCase()
                        .indexOf(q) !== -1;
                });
                if (cat) list = list.filter(function(i) {
                    return i.cat === cat;
                });
                return list;
            }

            function getFilteredExpenses() {
                var list = state.expenses.slice();
                var q = (filters.expenses.search || '').toLowerCase().trim();
                var cat = filters.expenses.cat || '';
                if (q) list = list.filter(function(e) {
                    return (e.name || '').toLowerCase().indexOf(q) !== -1 || (e.cat || '').toLowerCase()
                        .indexOf(q) !== -1;
                });
                if (cat) list = list.filter(function(e) {
                    return e.cat === cat;
                });
                return list;
            }

            function getFilteredBudgetCats() {
                var cats = Object.keys(state.budgets);
                var q = (filters.budgets.search || '').toLowerCase().trim();
                var status = filters.budgets.status || '';
                if (q) cats = cats.filter(function(c) {
                    return c.toLowerCase().indexOf(q) !== -1;
                });
                if (status) {
                    cats = cats.filter(function(cat) {
                        var spent = spentInCat(cat);
                        var limit = state.budgets[cat];
                        var pct = limit ? Math.round((spent / limit) * 100) : 0;
                        if (status === 'ok') return pct < 75;
                        if (status === 'watch') return pct >= 75 && pct < 90;
                        if (status === 'over') return pct >= 90;
                        return true;
                    });
                }
                return cats;
            }

            function populateFilterDropdowns() {
                var incCats = {};
                state.income.forEach(function(i) {
                    if (i.cat) incCats[i.cat] = true;
                });
                var incSel = document.getElementById('incFilterCat');
                if (incSel) {
                    var cur = incSel.value;
                    incSel.innerHTML = '<option value="">All categories</option>';
                    Object.keys(incCats).sort().forEach(function(c) {
                        incSel.innerHTML += '<option value="' + c + '"' + (cur === c ? ' selected' : '') + '>' +
                            c + '</option>';
                    });
                }
                var expCats = {};
                state.expenses.forEach(function(e) {
                    if (e.cat) expCats[e.cat] = true;
                });
                var expSel = document.getElementById('expFilterCat');
                if (expSel) {
                    var curE = expSel.value;
                    expSel.innerHTML = '<option value="">All categories</option>';
                    Object.keys(expCats).sort().forEach(function(c) {
                        expSel.innerHTML += '<option value="' + c + '"' + (curE === c ? ' selected' : '') +
                            '>' + c + '</option>';
                    });
                }
            }

            function buildCatHtml(cats, withActions) {
                var catHtml = '';
                (cats || Object.keys(state.budgets)).forEach(function(cat) {
                    var spent = spentInCat(cat);
                    var limit = state.budgets[cat] || 0;
                    var pct = limit ? Math.min(100, Math.round((spent / limit) * 100)) : 0;
                    var color = catColors[cat] || '#00BFA5';
                    catHtml += '<div class="cat-row">' +
                        '<div class="cat-icon" style="background:' + color + '22">' + (catIcons[cat] || '📦') +
                        '</div>' +
                        '<div style="flex:1"><div class="cat-name">' + cat + '</div>' +
                        '<div class="cat-bar-track"><div class="cat-bar-fill" style="width:' + pct +
                        '%;background:' + color + '"></div></div></div>' +
                        '<div style="text-align:right;min-width:90px"><div class="cat-amt">' + peso(spent) +
                        '</div><div class="cat-limit">of ' + peso(limit) + '</div></div>';
                    if (withActions) {
                        catHtml += '<div class="action-btns">' +
                            '<button type="button" class="btn-action edit" onclick="editBudget(\'' + cat
                            .replace(/'/g, "\\'") +
                            '\')" title="Edit" aria-label="Edit"><svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>' +
                            '<button type="button" class="btn-action delete" onclick="deleteBudget(\'' + cat
                            .replace(/'/g, "\\'") +
                            '\')" title="Delete" aria-label="Delete"><svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg></button>' +
                            '</div>';
                    }
                    catHtml += '</div>';
                });
                return catHtml;
            }

            function render() {
                window.__bbState = state;
                var inc = totalIncome();
                var exp = totalExpenses();
                var bal = inc - exp;
                var bud = totalBudget();
                var usedPct = bud ? Math.min(100, Math.round((exp / bud) * 100)) : 0;

                document.getElementById('dashStats').innerHTML =
                    '<div class="stat-card"><div class="stat-label">Balance</div><div class="stat-value">' + peso(bal) +
                    '</div><div class="stat-meta">Left this month</div></div>' +
                    '<div class="stat-card"><div class="stat-label">Income</div><div class="stat-value up">' + peso(
                        inc) + '</div><div class="stat-meta">' + state.income.length + ' entries</div></div>' +
                    '<div class="stat-card"><div class="stat-label">Expenses</div><div class="stat-value down">' + peso(
                        exp) + '</div><div class="stat-meta">' + usedPct + '% of budget</div></div>' +
                    '<div class="stat-card"><div class="stat-label">Monthly budget</div><div class="stat-value">' +
                    peso(bud) + '</div><div class="stat-meta">' + peso(Math.max(0, bud - exp)) +
                    ' remaining</div></div>';

                document.getElementById('dashBudgetSummary').innerHTML =
                    '<div class="budget-summary">' +
                    '<div><div class="budget-fig-label">Budget</div><div class="budget-fig-val">' + peso(bud) +
                    '</div></div>' +
                    '<div><div class="budget-fig-label">Spent</div><div class="budget-fig-val" style="color:var(--red)">' +
                    peso(exp) + '</div></div>' +
                    '<div><div class="budget-fig-label">Left</div><div class="budget-fig-val" style="color:var(--teal-dark)">' +
                    peso(Math.max(0, bud - exp)) + '</div></div></div>';
                document.getElementById('dashProgress').style.width = usedPct + '%';
                document.getElementById('dashProgressLabel').textContent = usedPct + '% used';

                var allCatHtml = buildCatHtml(null, false);
                document.getElementById('dashCats').innerHTML = allCatHtml ||
                    '<div class="empty">No budgets set yet</div>';
                document.getElementById('patternsCats').innerHTML = allCatHtml ||
                    '<div class="empty">No budgets set yet</div>';

                var filteredBudCats = getFilteredBudgetCats();
                document.getElementById('budgetPageList').innerHTML = buildCatHtml(filteredBudCats, true) ||
                    '<div class="empty">' + (Object.keys(state.budgets).length ? 'No matching budgets' :
                        'No budgets set yet') + '</div>';

                var budCountEl = document.getElementById('budFilterCount');
                if (budCountEl) {
                    var totalBud = Object.keys(state.budgets).length;
                    budCountEl.textContent = filteredBudCats.length === totalBud ?
                        (totalBud + ' categor' + (totalBud === 1 ? 'y' : 'ies')) :
                        (filteredBudCats.length + ' of ' + totalBud);
                }

                document.getElementById('budgetPageTotal').innerHTML =
                    '<div class="budget-summary"><div><div class="budget-fig-label">Total limits</div><div class="budget-fig-val">' +
                    peso(bud) + '</div></div>' +
                    '<div><div class="budget-fig-label">Spent</div><div class="budget-fig-val" style="color:var(--red)">' +
                    peso(exp) + '</div></div>' +
                    '<div><div class="budget-fig-label">Remaining</div><div class="budget-fig-val" style="color:var(--teal-dark)">' +
                    peso(Math.max(0, bud - exp)) + '</div></div></div>' +
                    '<div class="progress-track"><div class="progress-fill" style="width:' + usedPct +
                    '%"></div></div>' +
                    '<div class="progress-caption"><span>' + usedPct +
                    '% used</span><span>Across all categories</span></div>';

                document.getElementById('dashIncome').innerHTML = state.income.slice(0, 4).map(function(i) {
                    return renderTxRow(i, true);
                }).join('') || '<div class="empty">No income yet</div>';
                document.getElementById('dashExpenses').innerHTML = state.expenses.slice(0, 5).map(function(e) {
                    return renderTxRow(e, false);
                }).join('') || '<div class="empty">No expenses yet</div>';

                // Income table with Edit/Delete
                var filteredInc = getFilteredIncome();
                var incBody = filteredInc.map(function(i) {
                    return '<tr>' +
                        '<td><strong>' + i.name + '</strong></td><td>' + i.cat + '</td><td>' + formatDate(i
                            .date) + '</td>' +
                        '<td style="text-align:right;color:var(--teal-dark);font-weight:700">' + peso(i
                            .amount) + '</td>' +
                        '<td style="text-align:center"><div class="action-btns">' +
                        '<button type="button" class="btn-action edit" onclick="editIncome(' + i.id +
                        ')" title="Edit" aria-label="Edit"><svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>' +
                        '<button type="button" class="btn-action delete" onclick="deleteIncome(' + i.id +
                        ')" title="Delete" aria-label="Delete"><svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg></button>' +
                        '</div></td></tr>';
                }).join('');
                document.getElementById('incomeTable').innerHTML = incBody;
                var incomeEmpty = document.getElementById('incomeEmpty');
                if (!state.income.length) {
                    incomeEmpty.style.display = 'block';
                    incomeEmpty.textContent = 'No income yet. Click “+ Add income”.';
                } else if (!filteredInc.length) {
                    incomeEmpty.style.display = 'block';
                    incomeEmpty.textContent = 'No matching income. Try clearing filters.';
                } else {
                    incomeEmpty.style.display = 'none';
                }
                var incCountEl = document.getElementById('incFilterCount');
                if (incCountEl) {
                    incCountEl.textContent = filteredInc.length === state.income.length ?
                        (state.income.length + ' entr' + (state.income.length === 1 ? 'y' : 'ies')) :
                        (filteredInc.length + ' of ' + state.income.length);
                }

                // Expense table with Edit/Delete
                var filteredExp = getFilteredExpenses();
                var expBody = filteredExp.map(function(e) {
                    return '<tr>' +
                        '<td><strong>' + e.name + '</strong></td><td>' + e.cat + '</td><td>' + formatDate(e
                            .date) + '</td>' +
                        '<td style="text-align:right;color:var(--red);font-weight:700">' + peso(e.amount) +
                        '</td>' +
                        '<td style="text-align:center"><div class="action-btns">' +
                        '<button type="button" class="btn-action edit" onclick="editExpense(' + e.id +
                        ')" title="Edit" aria-label="Edit"><svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>' +
                        '<button type="button" class="btn-action delete" onclick="deleteExpense(' + e.id +
                        ')" title="Delete" aria-label="Delete"><svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg></button>' +
                        '</div></td></tr>';
                }).join('');
                document.getElementById('expenseTable').innerHTML = expBody;
                var expenseEmpty = document.getElementById('expenseEmpty');
                if (!state.expenses.length) {
                    expenseEmpty.style.display = 'block';
                    expenseEmpty.textContent = 'No expenses yet. Click “+ Log expense”.';
                } else if (!filteredExp.length) {
                    expenseEmpty.style.display = 'block';
                    expenseEmpty.textContent = 'No matching expenses. Try clearing filters.';
                } else {
                    expenseEmpty.style.display = 'none';
                }
                var expCountEl = document.getElementById('expFilterCount');
                if (expCountEl) {
                    expCountEl.textContent = filteredExp.length === state.expenses.length ?
                        (state.expenses.length + ' entr' + (state.expenses.length === 1 ? 'y' : 'ies')) :
                        (filteredExp.length + ' of ' + state.expenses.length);
                }

                populateFilterDropdowns();
                renderWeekChart('weekChart');
                renderWeekChart('patternsChart');

                var days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                var maxIdx = 0;
                state.weekSpend.forEach(function(v, i) {
                    if (v > state.weekSpend[maxIdx]) maxIdx = i;
                });
                var insight = state.weekSpend[maxIdx] > 0 ?
                    ('Highest spend was <strong>' + days[maxIdx] + '</strong> (' + peso(state.weekSpend[maxIdx]) +
                        ').') :
                    'No spending logged this week yet.';
                document.getElementById('weekInsight').innerHTML = insight;
                document.getElementById('patternsInsight').innerHTML = insight;
            }

            // Filters
            function bindFilters() {
                var incSearch = document.getElementById('incFilterSearch');
                var incCat = document.getElementById('incFilterCat');
                var incClear = document.getElementById('incFilterClear');
                if (incSearch) incSearch.addEventListener('input', function() {
                    filters.income.search = this.value;
                    render();
                });
                if (incCat) incCat.addEventListener('change', function() {
                    filters.income.cat = this.value;
                    render();
                });
                if (incClear) incClear.addEventListener('click', function() {
                    filters.income = {
                        search: '',
                        cat: ''
                    };
                    if (incSearch) incSearch.value = '';
                    if (incCat) incCat.value = '';
                    render();
                });

                var expSearch = document.getElementById('expFilterSearch');
                var expCat = document.getElementById('expFilterCat');
                var expClear = document.getElementById('expFilterClear');
                if (expSearch) expSearch.addEventListener('input', function() {
                    filters.expenses.search = this.value;
                    render();
                });
                if (expCat) expCat.addEventListener('change', function() {
                    filters.expenses.cat = this.value;
                    render();
                });
                if (expClear) expClear.addEventListener('click', function() {
                    filters.expenses = {
                        search: '',
                        cat: ''
                    };
                    if (expSearch) expSearch.value = '';
                    if (expCat) expCat.value = '';
                    render();
                });

                var budSearch = document.getElementById('budFilterSearch');
                var budStatus = document.getElementById('budFilterStatus');
                var budClear = document.getElementById('budFilterClear');
                if (budSearch) budSearch.addEventListener('input', function() {
                    filters.budgets.search = this.value;
                    render();
                });
                if (budStatus) budStatus.addEventListener('change', function() {
                    filters.budgets.status = this.value;
                    render();
                });
                if (budClear) budClear.addEventListener('click', function() {
                    filters.budgets = {
                        search: '',
                        status: ''
                    };
                    if (budSearch) budSearch.value = '';
                    if (budStatus) budStatus.value = '';
                    render();
                });
            }
            bindFilters();

            // ========== EDIT & DELETE ==========
            window.editIncome = function(id) {
                var item = state.income.find(function(i) {
                    return i.id == id;
                });
                if (!item) return toast('Income not found');
                document.getElementById('editIncId').value = item.id;
                document.getElementById('editIncSource').value = item.name;
                document.getElementById('editIncAmount').value = Number(item.amount).toLocaleString('en-PH', {
                    minimumFractionDigits: 2
                });
                document.getElementById('editIncAmountHidden').value = item.amount;
                document.getElementById('editIncDate').value = item.date;
                document.getElementById('formEditIncome').action = '/income/' + item.id;
                openModal('modalEditIncome');
            };

            window.deleteIncome = function(id) {
                if (!confirm('Delete this income entry?\n\nThis cannot be undone.')) return;
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/income/' + id;
                form.innerHTML = '@csrf @method('DELETE')';
                document.body.appendChild(form);
                form.submit();
            };

            window.editExpense = function(id) {
                var item = state.expenses.find(function(e) {
                    return e.id == id;
                });
                if (!item) return toast('Expense not found');
                document.getElementById('editExpId').value = item.id;
                document.getElementById('editExpName').value = item.name;
                document.getElementById('editExpAmt').value = item.amount;
                document.getElementById('editExpDate').value = item.date;
                document.getElementById('formEditExpense').action = '/expense/' + item.id;
                openModal('modalEditExpense');
            };

            window.deleteExpense = function(id) {
                if (!confirm('Delete this expense?\n\nThis cannot be undone.')) return;
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/expense/' + id;
                form.innerHTML = '@csrf @method('DELETE')';
                document.body.appendChild(form);
                form.submit();
            };

            window.editBudget = function(cat) {
                var limit = state.budgets[cat];
                if (limit == null) return toast('Budget not found');
                document.getElementById('editBudCatName').value = cat;
                document.getElementById('editBudCatDisplay').value = cat;
                document.getElementById('editBudLimit').value = Number(limit).toLocaleString('en-PH');
                document.getElementById('editBudLimitHidden').value = limit;
                document.getElementById('formEditBudget').action = '/budget/' + encodeURIComponent(cat);
                openModal('modalEditBudget');
            };

            window.deleteBudget = function(cat) {
                if (!confirm('Delete the budget for "' + cat + '"?\n\nThis cannot be undone.')) return;
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/budget/' + encodeURIComponent(cat);
                form.innerHTML = '@csrf @method('DELETE')';
                document.body.appendChild(form);
                form.submit();
            };

            // ========== EXCEL EXPORT ==========
            function downloadExcel() {
                var now = new Date();
                var monthLabel = now.toLocaleString('en-US', {
                    month: 'long',
                    year: 'numeric'
                });
                var fileBase = 'budgetbuddy-' + now.toLocaleString('en-US', {
                    month: 'long'
                }).toLowerCase() + '-' + now.getFullYear();
                var days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                var dayNames = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

                function maxExpense() {
                    if (!state.expenses.length) return null;
                    return state.expenses.reduce(function(a, b) {
                        return a.amount >= b.amount ? a : b;
                    });
                }

                function minExpense() {
                    if (!state.expenses.length) return null;
                    return state.expenses.reduce(function(a, b) {
                        return a.amount <= b.amount ? a : b;
                    });
                }

                function maxIncome() {
                    if (!state.income.length) return null;
                    return state.income.reduce(function(a, b) {
                        return a.amount >= b.amount ? a : b;
                    });
                }

                function minIncome() {
                    if (!state.income.length) return null;
                    return state.income.reduce(function(a, b) {
                        return a.amount <= b.amount ? a : b;
                    });
                }

                var hiExp = maxExpense(),
                    loExp = minExpense(),
                    hiInc = maxIncome(),
                    loInc = minIncome();
                var incTotal = totalIncome(),
                    expTotal = totalExpenses(),
                    bal = incTotal - expTotal;
                var bud = totalBudget(),
                    usedPct = bud ? Math.round((expTotal / bud) * 100) : 0;

                var expensesSorted = state.expenses.slice().sort(function(a, b) {
                    return b.amount - a.amount;
                });
                var incomeSorted = state.income.slice().sort(function(a, b) {
                    return b.amount - a.amount;
                });

                var catSpend = {};
                state.expenses.forEach(function(e) {
                    catSpend[e.cat] = (catSpend[e.cat] || 0) + e.amount;
                });
                var topCat = null,
                    topCatAmt = 0;
                Object.keys(catSpend).forEach(function(c) {
                    if (catSpend[c] > topCatAmt) {
                        topCatAmt = catSpend[c];
                        topCat = c;
                    }
                });

                var maxWeekIdx = 0,
                    minWeekIdx = 0;
                state.weekSpend.forEach(function(v, i) {
                    if (v > state.weekSpend[maxWeekIdx]) maxWeekIdx = i;
                });
                state.weekSpend.forEach(function(v, i) {
                    if (v < state.weekSpend[minWeekIdx]) minWeekIdx = i;
                });

                function buildRecommendations() {
                    var tips = [
                        ['BudgetBuddy Recommendations', '', ''],
                        ['(Insights based on your numbers)', '', ''],
                        ['', '', ''],
                        ['#', 'Recommendation', 'Why']
                    ];
                    var n = 1;
                    if (usedPct >= 90) tips.push([n++, 'Slow down spending for the rest of the month',
                        'You have used about ' + usedPct + '% of your total budget limits.'
                    ]);
                    else if (usedPct >= 70) tips.push([n++, 'Watch discretionary spending', 'You are at ' + usedPct +
                        '% of budget — still OK, but leave room for bills.'
                    ]);
                    else tips.push([n++, 'You are on track this month', 'Only about ' + usedPct +
                        '% of category budgets used. Keep logging consistently.'
                    ]);

                    if (topCat && expTotal > 0) {
                        var share = Math.round((topCatAmt / expTotal) * 100);
                        tips.push([n++, 'Focus on ' + topCat + ' first if you want to save', topCat +
                            ' is your top category (' + share + '% of expenses, ' + topCatAmt + ' pesos).'
                        ]);
                    }
                    Object.keys(state.budgets).forEach(function(cat) {
                        var spent = spentInCat(cat),
                            limit = state.budgets[cat];
                        if (!limit) return;
                        var p = Math.round((spent / limit) * 100);
                        if (p >= 90) tips.push([n++, 'Almost at limit for ' + cat, 'Spent ' + spent + ' of ' +
                            limit + ' (' + p + '%). Avoid extra ' + cat.toLowerCase() + ' this month.'
                        ]);
                        else if (p >= 75) tips.push([n++, 'Careful with ' + cat, p + '% of your ' + cat +
                            ' budget is used.'
                        ]);
                    });
                    if (hiExp && expTotal > 0 && hiExp.amount >= expTotal * 0.25)
                        tips.push([n++, 'Review your biggest single expense', '"' + hiExp.name + '" (' + hiExp.amount +
                            ' pesos) is a large share of total spend.'
                        ]);
                    if (state.weekSpend[maxWeekIdx] > 0)
                        tips.push([n++, 'Plan around your high-spend day', dayNames[maxWeekIdx] +
                            ' was your highest day this week. Prep meals or set a daily cap that day.'
                        ]);
                    if (bal < 0) tips.push([n++, 'Expenses exceed income',
                        'Balance is negative. Cut non-essentials or add income before next month.'
                    ]);
                    else if (bal > 0 && expTotal > 0) tips.push([n++, 'Protect your surplus', 'You have ' + bal +
                        ' pesos left. Consider moving part of it to savings when you get paid.'
                    ]);
                    if (state.expenses.length < 3) tips.push([n++, 'Log more expenses for better tips',
                        'More entries = clearer trends and smarter recommendations.'
                    ]);
                    tips.push([n++, 'Export before Reset',
                        'Download this Excel file anytime so you keep a monthly record.'
                    ]);
                    tips.push([n++, 'Set realistic category limits',
                        'Update budgets under Budgets so limits match your real lifestyle.'
                    ]);
                    return tips;
                }

                var styleTitle = {
                    font: {
                        bold: true,
                        sz: 16,
                        color: {
                            rgb: '152238'
                        }
                    },
                    alignment: {
                        vertical: 'center'
                    }
                };
                var styleSection = {
                    font: {
                        bold: true,
                        sz: 12,
                        color: {
                            rgb: 'FFFFFF'
                        }
                    },
                    fill: {
                        fgColor: {
                            rgb: '00BFA5'
                        }
                    },
                    alignment: {
                        vertical: 'center'
                    }
                };
                var styleHeader = {
                    font: {
                        bold: true,
                        sz: 11,
                        color: {
                            rgb: 'FFFFFF'
                        }
                    },
                    fill: {
                        fgColor: {
                            rgb: '152238'
                        }
                    },
                    alignment: {
                        horizontal: 'center',
                        vertical: 'center'
                    }
                };

                function applyRowStyle(ws, rowIndex0, colCount, style) {
                    for (var c = 0; c < colCount; c++) {
                        var ref = XLSX.utils.encode_cell({
                            r: rowIndex0,
                            c: c
                        });
                        if (!ws[ref]) ws[ref] = {
                            t: 's',
                            v: ''
                        };
                        ws[ref].s = style;
                    }
                }

                function sheetFromAoA(data, colWidths) {
                    var ws = XLSX.utils.aoa_to_sheet(data);
                    if (colWidths) ws['!cols'] = colWidths.map(function(w) {
                        return {
                            wch: w
                        };
                    });
                    return ws;
                }

                if (typeof XLSX !== 'undefined') {
                    var wb = XLSX.utils.book_new();

                    var summary = [
                        ['BudgetBuddy — Monthly Report'],
                        ['Month', monthLabel],
                        ['Generated', new Date().toLocaleString()],
                        [],
                        ['SUMMARY'],
                        ['Total Income', incTotal],
                        ['Total Expenses', expTotal],
                        ['Balance', bal],
                        ['Total Budget Limits', bud],
                        ['Budget used %', usedPct + '%'],
                        ['Income entries', state.income.length],
                        ['Expense entries', state.expenses.length],
                        [],
                        ['HIGHEST & LOWEST'],
                        ['Metric', 'Name', 'Category', 'Amount'],
                        ['Highest expense', hiExp ? hiExp.name : '—', hiExp ? hiExp.cat : '', hiExp ? hiExp.amount :
                            ''
                        ],
                        ['Lowest expense', loExp ? loExp.name : '—', loExp ? loExp.cat : '', loExp ? loExp.amount :
                            ''
                        ],
                        ['Highest income', hiInc ? hiInc.name : '—', hiInc ? hiInc.cat : '', hiInc ? hiInc.amount :
                            ''
                        ],
                        ['Lowest income', loInc ? loInc.name : '—', loInc ? loInc.cat : '', loInc ? loInc.amount :
                            ''
                        ],
                        [],
                        ['TOP CATEGORY'],
                        ['Category', topCat || '—'],
                        ['Amount spent', topCatAmt],
                        ['Share of expenses', expTotal ? Math.round((topCatAmt / expTotal) * 100) + '%' : '—']
                    ];
                    var wsSummary = sheetFromAoA(summary, [22, 28, 16, 14]);
                    if (wsSummary['A1']) wsSummary['A1'].s = styleTitle;
                    if (wsSummary['A5']) wsSummary['A5'].s = styleSection;
                    if (wsSummary['A14']) wsSummary['A14'].s = styleSection;
                    if (wsSummary['A21']) wsSummary['A21'].s = styleSection;
                    applyRowStyle(wsSummary, 14, 4, styleHeader);
                    XLSX.utils.book_append_sheet(wb, wsSummary, 'Summary');

                    var trend = [
                        ['TREND DATA — Select a table below → Insert → Charts → Line or Column'],
                        [],
                        ['Weekly spending (for line / column chart)'],
                        ['Day', 'Amount (PHP)']
                    ];
                    state.weekSpend.forEach(function(v, i) {
                        trend.push([days[i], v]);
                    });
                    trend.push([]);
                    trend.push(['Peak day', dayNames[maxWeekIdx], state.weekSpend[maxWeekIdx]]);
                    trend.push(['Lowest day', dayNames[minWeekIdx], state.weekSpend[minWeekIdx]]);
                    trend.push([]);
                    trend.push(['Spending by category (for pie / bar chart)']);
                    trend.push(['Category', 'Spent (PHP)', 'Budget limit', '% of limit']);
                    Object.keys(state.budgets).forEach(function(cat) {
                        var spent = spentInCat(cat),
                            limit = state.budgets[cat];
                        var p = limit ? Math.round((spent / limit) * 100) : 0;
                        trend.push([cat, spent, limit, p]);
                    });
                    Object.keys(catSpend).forEach(function(cat) {
                        if (!state.budgets[cat]) trend.push([cat, catSpend[cat], '', '']);
                    });
                    var wsTrend = sheetFromAoA(trend, [28, 16, 14, 12]);
                    if (wsTrend['A1']) wsTrend['A1'].s = styleTitle;
                    if (wsTrend['A3']) wsTrend['A3'].s = styleSection;
                    if (wsTrend['A4']) applyRowStyle(wsTrend, 3, 2, styleHeader);
                    XLSX.utils.book_append_sheet(wb, wsTrend, 'Trends (Chart Data)');

                    var rec = buildRecommendations();
                    var wsRec = sheetFromAoA(rec, [6, 55, 55]);
                    if (wsRec['A1']) wsRec['A1'].s = styleTitle;
                    if (wsRec['A4']) applyRowStyle(wsRec, 3, 3, styleHeader);
                    XLSX.utils.book_append_sheet(wb, wsRec, 'Recommendations');

                    var incomeRows = [
                        ['#', 'Date', 'Source', 'Category', 'Amount (PHP)']
                    ];
                    incomeSorted.forEach(function(i, idx) {
                        incomeRows.push([idx + 1, i.date, i.name, i.cat, i.amount]);
                    });
                    if (!incomeSorted.length) incomeRows.push(['', '', 'No income yet', '', '']);
                    var wsInc = sheetFromAoA(incomeRows, [6, 14, 28, 16, 14]);
                    applyRowStyle(wsInc, 0, 5, styleHeader);
                    XLSX.utils.book_append_sheet(wb, wsInc, 'Income List');

                    var expenseRows = [
                        ['#', 'Date', 'Description', 'Category', 'Amount (PHP)']
                    ];
                    expensesSorted.forEach(function(e, idx) {
                        expenseRows.push([idx + 1, e.date, e.name, e.cat, e.amount]);
                    });
                    if (!expensesSorted.length) expenseRows.push(['', '', 'No expenses yet', '', '']);
                    var wsExp = sheetFromAoA(expenseRows, [6, 14, 28, 16, 14]);
                    applyRowStyle(wsExp, 0, 5, styleHeader);
                    XLSX.utils.book_append_sheet(wb, wsExp, 'Expense List');

                    var budgetRows = [
                        ['Category', 'Limit', 'Spent', 'Remaining', '% Used']
                    ];
                    Object.keys(state.budgets).forEach(function(cat) {
                        var spent = spentInCat(cat),
                            limit = state.budgets[cat];
                        var pct = limit ? Math.round((spent / limit) * 100) : 0;
                        budgetRows.push([cat, limit, spent, limit - spent, pct + '%']);
                    });
                    var wsBud = sheetFromAoA(budgetRows, [16, 12, 12, 12, 10]);
                    applyRowStyle(wsBud, 0, 5, styleHeader);
                    XLSX.utils.book_append_sheet(wb, wsBud, 'Budgets');

                    XLSX.writeFile(wb, fileBase + '.xlsx');
                    toast('Excel ready — Trends + Recommendations included');
                    return;
                }
                toast('Excel library not loaded. Please refresh the page.');
            }

            var exportBtn = document.getElementById('btnExport');
            if (exportBtn) exportBtn.addEventListener('click', downloadExcel);

            var resetBtn = document.getElementById('btnReset');
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    var ok = window.confirm(
                        '⚠️ DELETE ALL DATA?\n\nThis will permanently delete:\n• All income entries\n• All expense entries\n• All budget limits\n\nThis cannot be undone.\n\nTip: click Export Excel first if you want a backup.\n\nAre you sure you want to continue?'
                    );
                    if (!ok) return;
                    var form = document.getElementById('resetForm');
                    if (form) form.submit();
                    else toast('Reset form not found.');
                });
            }


            // ========== DARK MODE ==========
            (function initTheme() {
                var root = document.documentElement;
                var saved = localStorage.getItem('bb-theme');
                if (saved === 'dark' || (!saved && window.matchMedia && window.matchMedia(
                        '(prefers-color-scheme: dark)').matches)) {
                    root.classList.add('dark');
                }
                var btn = document.getElementById('themeToggle');
                if (btn) {
                    btn.addEventListener('click', function() {
                        root.classList.toggle('dark');
                        localStorage.setItem('bb-theme', root.classList.contains('dark') ? 'dark' :
                            'light');
                    });
                }
            })();

            render();
        })();
    </script>

    <script>
        // Other category toggles
        (function() {
            function bindOther(selectId, fieldId, inputId) {
                var sel = document.getElementById(selectId);
                var field = document.getElementById(fieldId);
                var input = document.getElementById(inputId);
                if (!sel || !field) return;

                function sync() {
                    var isOther = sel.value === 'other';
                    field.style.display = isOther ? 'block' : 'none';
                    if (input) {
                        input.required = isOther;
                        if (!isOther) input.value = '';
                    }
                }
                sel.addEventListener('change', sync);
                sync();
            }
            bindOther('incCat', 'incOtherField', 'incOtherCat');
            bindOther('expCat', 'expOtherField', 'expOtherCat');
            bindOther('budCat', 'budOtherField', 'budOtherCat');
            bindOther('editIncCat', 'editIncOtherField', 'editIncOtherCat');
            bindOther('editExpCat', 'editExpOtherField', 'editExpOtherCat');
        })();
    </script>

    <!-- Chatbot -->
    <button type="button" class="bb-chat-fab" id="chatFab" aria-label="Open chat" title="Ask BudgetBuddy">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z" />
        </svg>
    </button>
    <div class="bb-chat-panel" id="chatPanel" role="dialog" aria-label="BudgetBuddy chat">
        <div class="bb-chat-head">
            <div class="bb-chat-avatar">🤖</div>
            <div>
                <h3>BudgetBuddy AI</h3>
                <p>Your friendly money helper</p>
            </div>
            <button type="button" class="bb-chat-close" id="chatClose" aria-label="Close">×</button>
        </div>
        <div class="bb-chat-msgs" id="chatMsgs"></div>
        <div class="bb-chat-quick" id="chatQuick">
            <button type="button" data-q="How am I doing this month?">How am I doing?</button>
            <button type="button" data-q="Where do I spend the most?">Top spending</button>
            <button type="button" data-q="Any warnings?">Warnings</button>
            <button type="button" data-q="How can I save money?">How to save</button>
            <button type="button" data-q="What is my balance?">Balance</button>
        </div>
        <form class="bb-chat-input" id="chatForm" action="javascript:void(0)">
            <input type="text" id="chatInput" placeholder="Ask me anything about your budget…" autocomplete="off"
                maxlength="200">
            <button type="submit">Send</button>
        </form>
    </div>

    <script>
        (function() {
            function peso(n) {
                return '₱' + Number(n || 0).toLocaleString('en-PH');
            }

            function getData() {
                var s = window.__bbState;
                if (!s) return {
                    inc: 0,
                    exp: 0,
                    bal: 0,
                    bud: 0,
                    usedPct: 0,
                    topCat: null,
                    topAmt: 0,
                    hiExp: null,
                    maxW: 0,
                    week: [0, 0, 0, 0, 0, 0, 0],
                    budgets: {},
                    expenses: [],
                    income: [],
                    spentInCat: function() {
                        return 0;
                    }
                };
                var inc = (s.income || []).reduce(function(a, i) {
                    return a + Number(i.amount);
                }, 0);
                var exp = (s.expenses || []).reduce(function(a, e) {
                    return a + Number(e.amount);
                }, 0);
                var bud = 0,
                    budgets = s.budgets || {};
                Object.keys(budgets).forEach(function(k) {
                    bud += Number(budgets[k]);
                });
                var usedPct = bud ? Math.round((exp / bud) * 100) : 0;
                var catSpend = {};
                (s.expenses || []).forEach(function(e) {
                    catSpend[e.cat] = (catSpend[e.cat] || 0) + Number(e.amount);
                });
                var topCat = null,
                    topAmt = 0;
                Object.keys(catSpend).forEach(function(c) {
                    if (catSpend[c] > topAmt) {
                        topAmt = catSpend[c];
                        topCat = c;
                    }
                });
                var hiExp = (s.expenses && s.expenses.length) ? s.expenses.reduce(function(a, b) {
                    return Number(a.amount) >= Number(b.amount) ? a : b;
                }) : null;
                var week = s.weekSpend || [0, 0, 0, 0, 0, 0, 0],
                    maxW = 0;
                week.forEach(function(v, i) {
                    if (v > week[maxW]) maxW = i;
                });

                function spentInCat(cat) {
                    return (s.expenses || []).filter(function(e) {
                        return e.cat === cat;
                    }).reduce(function(a, e) {
                        return a + Number(e.amount);
                    }, 0);
                }
                return {
                    inc: inc,
                    exp: exp,
                    bal: inc - exp,
                    bud: bud,
                    usedPct: usedPct,
                    topCat: topCat,
                    topAmt: topAmt,
                    hiExp: hiExp,
                    maxW: maxW,
                    week: week,
                    budgets: budgets,
                    expenses: s.expenses || [],
                    income: s.income || [],
                    spentInCat: spentInCat
                };
            }

            function boot() {
                var fab = document.getElementById('chatFab');
                var panel = document.getElementById('chatPanel');
                var closeBtn = document.getElementById('chatClose');
                var msgs = document.getElementById('chatMsgs');
                var form = document.getElementById('chatForm');
                var input = document.getElementById('chatInput');
                var quick = document.getElementById('chatQuick');
                if (!fab || !panel || !msgs) return;

                var greeted = false;
                var firstName = @json($firstName);

                function openChat() {
                    panel.classList.add('open');
                    fab.classList.add('open');
                    if (!greeted) {
                        greeted = true;
                        addBot("Hey " + firstName +
                            "! 👋 I’m your BudgetBuddy assistant — here to help you understand your money in a friendly way."
                        );
                        addBot("Tap a quick question below, or just type whatever’s on your mind!");
                    }
                    if (input) setTimeout(function() {
                        input.focus();
                    }, 100);
                }

                function closeChat() {
                    panel.classList.remove('open');
                    fab.classList.remove('open');
                }

                fab.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    panel.classList.contains('open') ? closeChat() : openChat();
                };
                if (closeBtn) closeBtn.onclick = function(e) {
                    e.preventDefault();
                    closeChat();
                };

                function addBot(html) {
                    var d = document.createElement('div');
                    d.className = 'bb-msg bot';
                    d.innerHTML = html;
                    msgs.appendChild(d);
                    msgs.scrollTop = msgs.scrollHeight;
                }

                function addUser(text) {
                    var d = document.createElement('div');
                    d.className = 'bb-msg user';
                    d.textContent = text;
                    msgs.appendChild(d);
                    msgs.scrollTop = msgs.scrollHeight;
                }

                function replyTo(q) {
                    var t = (q || '').toLowerCase().trim();
                    var d = getData();
                    var dayNames = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

                    if (/hello|hi\b|hey|good morning|good afternoon|kumusta|magandang/.test(t))
                        return "Hey " + firstName +
                            "! 😊 I’m so happy you’re here. Ask me about your <strong>balance</strong>, <strong>spending</strong>, <strong>budget</strong>, or how you can <strong>save</strong> more!";
                    if (/balance|left|remaining money|how much.*(have|left)/.test(t))
                        return "Your current balance is <strong>" + peso(d.bal) + "</strong> 💚<br>That’s from " + peso(
                            d.inc) + " income minus " + peso(d.exp) + " expenses. Keep it up!";
                    if (/income|earn|salary|sweldo/.test(t))
                        return "You’ve logged <strong>" + peso(d.inc) + "</strong> in total income so far (" + d.income
                            .length + " entr" + (d.income.length === 1 ? "y" : "ies") + "). Nice work tracking it!";
                    if (/expense|spent|spending|where.*money|top spend|most/.test(t)) {
                        var msg = "Total expenses so far: <strong>" + peso(d.exp) + "</strong>.";
                        if (d.topCat) msg += "<br>Your biggest category is <strong>" + d.topCat + "</strong> (" + peso(d
                            .topAmt) + ").";
                        if (d.hiExp) msg += "<br>Biggest single item: <strong>" + d.hiExp.name + "</strong> (" + peso(d
                            .hiExp.amount) + ").";
                        msg += "<br><br>Want tips on how to trim that a bit? Just ask!";
                        return msg;
                    }
                    if (/budget|limit|on track|how am i|doing|status|overview/.test(t)) {
                        var tone = d.usedPct >= 90 ?
                            "You’re close to the limit — maybe slow down on non-essentials for now 💪" :
                            d.usedPct >= 70 ? "You’re doing okay, but leave a little room for bills and surprises!" :
                            "Looking really good! Keep logging and you’ll stay in control 🌟";
                        return "You’ve used about <strong>" + d.usedPct + "%</strong> of your " + peso(d.bud) +
                            " budget.<br>" + tone;
                    }
                    if (/warn|danger|over|risk|problem|warning/.test(t)) {
                        var warns = [];
                        if (d.usedPct >= 85) warns.push("Overall budget is at " + d.usedPct + "% — careful!");
                        Object.keys(d.budgets).forEach(function(cat) {
                            var s = d.spentInCat(cat),
                                lim = d.budgets[cat];
                            if (lim && s / lim >= 0.85) warns.push(cat + " is at " + Math.round(s / lim * 100) +
                                "% of its limit.");
                        });
                        if (d.bal < 0) warns.push("Expenses are higher than income right now.");
                        if (!warns.length) return "Great news — no major warnings right now! ✅ You’re doing well.";
                        return "Just a friendly heads-up:<br>• " + warns.join("<br>• ") +
                            "<br><br>You’ve got this — small adjustments can help a lot!";
                    }
                    if (/save|saving|cut|reduce|tips|recommend|should i|what should|paano magtipid/.test(t)) {
                        var tips = [];
                        if (d.topCat) tips.push("Try trimming a bit from <strong>" + d.topCat +
                            "</strong> first — that’s where most of the money goes.");
                        if (d.week[d.maxW] > 0) tips.push("Spend a little less on <strong>" + dayNames[d.maxW] +
                            "</strong> (your highest day this week).");
                        tips.push("Export your Excel report before you hit Reset — it’s a great monthly record.");
                        tips.push("Update your limits under Budgets so they feel realistic for your life.");
                        return "Here are some gentle, practical ideas 💚<br>• " + tips.join("<br>• ");
                    }
                    if (/food|transport|transportation|internet|fun|bills/.test(t)) {
                        var cat = /food/.test(t) ? 'Food' : /transport/.test(t) ? 'Transportation' : /internet/.test(
                            t) ? 'Internet' : /fun/.test(t) ? 'Fun' : 'Bills';
                        var realCat = d.budgets[cat] != null ? cat : (d.budgets['Transport'] != null ? 'Transport' :
                            null);
                        if (realCat && d.budgets[realCat] != null) {
                            var s = d.spentInCat(realCat),
                                lim = d.budgets[realCat],
                                p = lim ? Math.round(s / lim * 100) : 0;
                            return "For <strong>" + realCat + "</strong>: you’ve spent " + peso(s) + " of " + peso(
                                    lim) + " (" + p + "%). " +
                                (p >= 90 ? "Almost at the limit — maybe pause a bit?" : p >= 75 ?
                                    "Getting close, so keep an eye on it!" : "Still comfortable room left 👍");
                        }
                        return "You don’t have a budget set for that category yet. You can add one under Budgets anytime!";
                    }
                    if (/export|excel|download|csv/.test(t))
                        return "Just click the <strong>Export Excel</strong> button in the top bar — it’ll download a nice report with trends and recommendations!";
                    if (/reset|delete|clear/.test(t))
                        return "The Reset button permanently clears all your data, so please export first if you want a backup. Your real database stays safe until you confirm.";
                    if (/help|what can you|commands|ano/.test(t))
                        return "I can help with:<br>• Your balance & income<br>• Where you spend the most<br>• Budget status & warnings<br>• Friendly saving tips<br>• Any specific category<br><br>Just ask in your own words — I’m here for you! 😊";
                    if (/thank|salamat|thanks|ty/.test(t)) return "You’re very welcome, " + firstName +
                        "! 💪 Anytime you need a money check-in, just open me up again.";
                    return "Hmm, I’m not 100% sure what you mean 😊 Try asking:<br>• <strong>How am I doing?</strong><br>• <strong>Top spending</strong><br>• <strong>How to save</strong><br>or just say “help”!";
                }

                function ask(q) {
                    if (!q || !String(q).trim()) return;
                    addUser(String(q).trim());
                    setTimeout(function() {
                        addBot(replyTo(q));
                    }, 280);
                }

                if (form) form.onsubmit = function(e) {
                    e.preventDefault();
                    var q = input.value;
                    input.value = '';
                    ask(q);
                    return false;
                };
                if (quick) Array.prototype.forEach.call(quick.querySelectorAll('button[data-q]'), function(b) {
                    b.onclick = function() {
                        ask(b.getAttribute('data-q'));
                    };
                });
            }

            if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot);
            else boot();
        })();
    </script>

    <script>
        // Amount formatters
        document.addEventListener('DOMContentLoaded', function() {
            // Income add
            const displayInput = document.getElementById('incAmount');
            const hiddenInput = document.getElementById('incAmountHidden');
            if (displayInput && hiddenInput) {
                function formatMoney(value) {
                    let cleaned = value.replace(/[^0-9.]/g, '');
                    const parts = cleaned.split('.');
                    if (parts.length > 2) cleaned = parts[0] + '.' + parts.slice(1).join('');
                    if (parts[1] && parts[1].length > 2) cleaned = parts[0] + '.' + parts[1].substring(0, 2);
                    if (cleaned === '' || cleaned === '.') return '';
                    const number = parseFloat(cleaned);
                    if (isNaN(number)) return '';
                    return number.toLocaleString('en-PH', {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 2
                    });
                }

                function updateValue(raw) {
                    const formatted = formatMoney(raw);
                    displayInput.value = formatted;
                    hiddenInput.value = formatted.replace(/,/g, '') || '';
                }
                displayInput.addEventListener('input', function() {
                    updateValue(this.value);
                });
                displayInput.addEventListener('blur', function() {
                    if (this.value) {
                        const clean = this.value.replace(/,/g, '');
                        const num = parseFloat(clean);
                        if (!isNaN(num)) {
                            this.value = num.toLocaleString('en-PH', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                            hiddenInput.value = num.toFixed(2);
                        }
                    }
                });
                if (displayInput.value) updateValue(displayInput.value);
            }

            // Budget add
            const budDisplay = document.getElementById('budLimit');
            const budHidden = document.getElementById('budLimitHidden');
            if (budDisplay && budHidden) {
                function formatBudget(value) {
                    let cleaned = value.replace(/[^0-9]/g, '');
                    if (cleaned === '') return '';
                    const number = parseInt(cleaned, 10);
                    if (isNaN(number)) return '';
                    return number.toLocaleString('en-PH');
                }

                function updateBudget(raw) {
                    const formatted = formatBudget(raw);
                    budDisplay.value = formatted;
                    budHidden.value = formatted.replace(/,/g, '') || '';
                }
                budDisplay.addEventListener('input', function() {
                    updateBudget(this.value);
                });
                if (budDisplay.value) updateBudget(budDisplay.value);
            }

            // Edit Income amount
            const editIncDisplay = document.getElementById('editIncAmount');
            const editIncHidden = document.getElementById('editIncAmountHidden');
            if (editIncDisplay && editIncHidden) {
                editIncDisplay.addEventListener('input', function() {
                    let cleaned = this.value.replace(/[^0-9.]/g, '');
                    const parts = cleaned.split('.');
                    if (parts.length > 2) cleaned = parts[0] + '.' + parts.slice(1).join('');
                    if (parts[1] && parts[1].length > 2) cleaned = parts[0] + '.' + parts[1].substring(0,
                        2);
                    const num = parseFloat(cleaned);
                    if (!isNaN(num)) {
                        this.value = num.toLocaleString('en-PH', {
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 2
                        });
                        editIncHidden.value = cleaned.replace(/,/g, '');
                    } else {
                        editIncHidden.value = '';
                    }
                });
            }

            // Edit Budget amount
            const editBudDisplay = document.getElementById('editBudLimit');
            const editBudHidden = document.getElementById('editBudLimitHidden');
            if (editBudDisplay && editBudHidden) {
                editBudDisplay.addEventListener('input', function() {
                    let cleaned = this.value.replace(/[^0-9]/g, '');
                    const number = parseInt(cleaned, 10);
                    if (!isNaN(number)) {
                        this.value = number.toLocaleString('en-PH');
                        editBudHidden.value = cleaned;
                    } else {
                        editBudHidden.value = '';
                    }
                });
            }
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toast = document.getElementById('toast');
                if (toast) {
                    toast.textContent = @json(session('success'));
                    toast.classList.add('show');
                    setTimeout(function() {
                        toast.classList.remove('show');
                    }, 3000);
                }
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/xlsx-js-style@1.2.0/dist/xlsx.min.js"></script>
</body>

</html>
