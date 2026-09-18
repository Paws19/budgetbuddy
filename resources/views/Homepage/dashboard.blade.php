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

    <!-- Modals -->
    <div class="modal-backdrop" id="modalIncome">
        <div class="modal">
            <h2>Add income</h2>
            <p class="sub">Record salary, freelance, or other money in.</p>
            <form id="formIncome">
                <div class="field"><label for="incName">Source</label><input id="incName"
                        placeholder="e.g. Salary, Freelance" required></div>
                <div class="field"><label for="incAmt">Amount (₱)</label><input id="incAmt" type="number"
                        min="1" step="1" placeholder="2000" required></div>
                <div class="field"><label for="incCat">Category</label>
                    <select id="incCat">
                        <option>Work</option>
                        <option>Side hustle</option>
                        <option>Gift</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-outline" data-close="modalIncome">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save income</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-backdrop" id="modalExpense">
        <div class="modal">
            <h2>Log expense</h2>
            <p class="sub">Track what you spent today.</p>
            <form id="formExpense">
                <div class="field"><label for="expName">Description</label><input id="expName"
                        placeholder="e.g. Lunch, Grab" required></div>
                <div class="field"><label for="expAmt">Amount (₱)</label><input id="expAmt" type="number"
                        min="1" step="1" placeholder="250" required></div>
                <div class="field"><label for="expCat">Category</label>
                    <select id="expCat">
                        <option value="Food">Food</option>
                        <option value="Transport">Transport</option>
                        <option value="Internet">Internet</option>
                        <option value="Fun">Fun / leisure</option>
                        <option value="Bills">Bills</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-outline" data-close="modalExpense">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save expense</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-backdrop" id="modalBudget">
        <div class="modal">
            <h2>Set budget</h2>
            <p class="sub">Update monthly limit for a category.</p>
            <form id="formBudget">
                <div class="field"><label for="budCat">Category</label>
                    <select id="budCat">
                        <option value="Food">Food</option>
                        <option value="Transport">Transport</option>
                        <option value="Internet">Internet</option>
                        <option value="Fun">Fun / leisure</option>
                    </select>
                </div>
                <div class="field"><label for="budLimit">Monthly limit (₱)</label><input id="budLimit" type="number"
                        min="100" step="100" placeholder="5000" required></div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-outline" data-close="modalBudget">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save budget</button>
                </div>
            </form>
        </div>
    </div>

    <div class="app">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <img src="budgetbuddy-logo.png" alt="" onerror="this.style.display='none'">
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
                <div class="avatar">AR</div>
                <div>
                    <div class="user-name">Alex Reyes</div>
                    <div class="user-email">alex@email.com</div>
                </div>
            </div>
        </aside>

        <div class="main">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menuToggle" aria-label="Menu"><svg viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 6h16M4 12h16M4 18h16" />
                        </svg></button>
                    <div>
                        <h1 class="page-title" id="pageTitle">Dashboard</h1>
                        <p class="page-sub">September 2026 · Interactive demo</p>
                    </div>
                </div>
                <div class="topbar-actions">
                    <button type="button" class="btn btn-export" id="btnExport"
                        title="Download Excel (.xlsx)">Export Excel</button>
                    <button type="button" class="btn btn-danger" id="btnReset"
                        title="Clear all entries">Reset</button>
                    <button type="button" class="btn btn-outline" id="btnIncome">+ Income</button>
                    <button type="button" class="btn btn-primary" id="btnExpense">+ Expense</button>
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
                            <div class="progress-caption"><span id="dashProgressLabel">0% used</span><span>Demo
                                    month</span></div>
                            <div style="margin-top:1.5rem">
                                <h3 class="panel-title" style="font-size:.95rem;margin-bottom:.9rem">Category budgets
                                </h3>
                                <div class="cat-list" id="dashCats"></div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-head">
                                <h2 class="panel-title">Spending this week</h2><span class="badge">Patterns</span>
                            </div>
                            <div class="week-chart" id="weekChart"></div>
                            <p style="font-size:.85rem;color:var(--text-2);margin:.75rem 0 0" id="weekInsight">
                                Loading…</p>
                        </div>
                    </div>
                    <div class="bottom-panels">
                        <div class="panel">
                            <div class="panel-head">
                                <h2 class="panel-title">Recent income</h2>
                                <button type="button" class="btn btn-ghost nav-jump" data-view="income">See
                                    all</button>
                            </div>
                            <div class="tx-list" id="dashIncome"></div>
                        </div>
                        <div class="panel">
                            <div class="panel-head">
                                <h2 class="panel-title">Recent expenses</h2>
                                <button type="button" class="btn btn-ghost nav-jump" data-view="expenses">See
                                    all</button>
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
                    <div class="panel">
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Source</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th style="text-align:right">Amount</th>
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
                    <div class="panel">
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th style="text-align:right">Amount</th>
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
                            <h2 class="panel-title">Spending this week</h2><span class="badge">Live demo</span>
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

                <p class="footer-note">Interactive demo · Data stays in this browser session · BudgetBuddy</p>
            </div>
        </div>
    </div>

    <script>
        (function() {
            // ——— Sample dump data ———
            function getDefaultState() {
                return {
                    income: [{
                            id: 1,
                            name: 'Salary',
                            cat: 'Work',
                            amount: 13000,
                            date: '2026-09-01'
                        },
                        {
                            id: 2,
                            name: 'Freelance design',
                            cat: 'Side hustle',
                            amount: 2000,
                            date: '2026-09-12'
                        }
                    ],
                    expenses: [{
                            id: 1,
                            name: 'Internet bill',
                            cat: 'Internet',
                            amount: 1200,
                            date: '2026-09-17'
                        },
                        {
                            id: 2,
                            name: 'Lunch & snacks',
                            cat: 'Food',
                            amount: 250,
                            date: '2026-09-18'
                        },
                        {
                            id: 3,
                            name: 'Jeep / Grab',
                            cat: 'Transport',
                            amount: 100,
                            date: '2026-09-18'
                        },
                        {
                            id: 4,
                            name: 'Game pass',
                            cat: 'Fun',
                            amount: 450,
                            date: '2026-09-14'
                        },
                        {
                            id: 5,
                            name: 'Groceries',
                            cat: 'Food',
                            amount: 1850,
                            date: '2026-09-10'
                        },
                        {
                            id: 6,
                            name: 'Mobile load',
                            cat: 'Bills',
                            amount: 300,
                            date: '2026-09-08'
                        }
                    ],
                    budgets: {
                        Food: 5000,
                        Transport: 2000,
                        Internet: 1500,
                        Fun: 1500
                    },
                    weekSpend: [420, 890, 560, 1100, 480, 320, 680],
                    nextId: 10
                };
            }

            var state = getDefaultState();
            window.__bbState = state;

            var catIcons = {
                Food: '🍔',
                Transport: '🚌',
                Internet: '🌐',
                Fun: '🎮',
                Bills: '📄',
                Other: '📦',
                Work: '💼',
                'Side hustle': '💻',
                Gift: '🎁'
            };
            var catColors = {
                Food: '#F5A623',
                Transport: '#3B82F6',
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
                    return e.cat === cat || (cat === 'Fun' && e.cat === 'Fun');
                }).reduce(function(s, e) {
                    return s + e.amount;
                }, 0);
            }

            function formatDate(d) {
                if (!d) return 'Today';
                var parts = d.split('-');
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

            // Navigation
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

            // Mobile menu
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

            // Open modals
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

            // Forms
            document.getElementById('formIncome').addEventListener('submit', function(e) {
                e.preventDefault();
                var name = document.getElementById('incName').value.trim();
                var amount = parseInt(document.getElementById('incAmt').value, 10);
                var cat = document.getElementById('incCat').value;
                if (!name || !amount) return;
                state.income.unshift({
                    id: state.nextId++,
                    name: name,
                    cat: cat,
                    amount: amount,
                    date: new Date().toISOString().slice(0, 10)
                });
                closeModal('modalIncome');
                e.target.reset();
                toast('Income added: ' + peso(amount));
                render();
            });

            document.getElementById('formExpense').addEventListener('submit', function(e) {
                e.preventDefault();
                var name = document.getElementById('expName').value.trim();
                var amount = parseInt(document.getElementById('expAmt').value, 10);
                var cat = document.getElementById('expCat').value;
                if (!name || !amount) return;
                state.expenses.unshift({
                    id: state.nextId++,
                    name: name,
                    cat: cat,
                    amount: amount,
                    date: new Date().toISOString().slice(0, 10)
                });
                // bump today's week bar a bit for demo feel
                state.weekSpend[new Date().getDay() === 0 ? 6 : new Date().getDay() - 1] += Math.min(amount,
                    500);
                closeModal('modalExpense');
                e.target.reset();
                toast('Expense logged: ' + peso(amount));
                render();
            });

            document.getElementById('formBudget').addEventListener('submit', function(e) {
                e.preventDefault();
                var cat = document.getElementById('budCat').value;
                var limit = parseInt(document.getElementById('budLimit').value, 10);
                if (!limit) return;
                state.budgets[cat] = limit;
                closeModal('modalBudget');
                e.target.reset();
                toast('Budget updated for ' + cat);
                render();
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
                var max = Math.max.apply(null, state.weekSpend.concat([1]));
                var days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                var html = '';
                var maxIdx = 0;
                state.weekSpend.forEach(function(v, i) {
                    if (v > state.weekSpend[maxIdx]) maxIdx = i;
                });
                state.weekSpend.forEach(function(v, i) {
                    var h = Math.round((v / max) * 100);
                    html += '<div class="week-bar-wrap"><div class="week-bar' + (i === maxIdx ? ' hi' : '') +
                        '" style="height:' + h + '%"></div>' +
                        '<span class="week-label">' + days[i] + '</span></div>';
                });
                el.innerHTML = html;
            }

            function render() {
                window.__bbState = state;
                var inc = totalIncome();
                var exp = totalExpenses();
                var bal = inc - exp;
                var bud = totalBudget();
                var usedPct = bud ? Math.min(100, Math.round((exp / bud) * 100)) : 0;

                // Stats
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

                // Category bars (dashboard)
                var catHtml = '';
                Object.keys(state.budgets).forEach(function(cat) {
                    var spent = spentInCat(cat);
                    var limit = state.budgets[cat];
                    var pct = limit ? Math.min(100, Math.round((spent / limit) * 100)) : 0;
                    var color = catColors[cat] || '#00BFA5';
                    catHtml += '<div class="cat-row"><div class="cat-icon" style="background:' + color +
                        '22">' + (catIcons[cat] || '📦') + '</div>' +
                        '<div><div class="cat-name">' + cat +
                        '</div><div class="cat-bar-track"><div class="cat-bar-fill" style="width:' + pct +
                        '%;background:' + color + '"></div></div></div>' +
                        '<div><div class="cat-amt">' + peso(spent) + '</div><div class="cat-limit">of ' + peso(
                            limit) + '</div></div></div>';
                });
                document.getElementById('dashCats').innerHTML = catHtml;
                document.getElementById('budgetPageList').innerHTML = catHtml;
                document.getElementById('patternsCats').innerHTML = catHtml;

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

                // Recent lists
                document.getElementById('dashIncome').innerHTML = state.income.slice(0, 4).map(function(i) {
                    return renderTxRow(i, true);
                }).join('') || '<div class="empty">No income yet</div>';
                document.getElementById('dashExpenses').innerHTML = state.expenses.slice(0, 5).map(function(e) {
                    return renderTxRow(e, false);
                }).join('') || '<div class="empty">No expenses yet</div>';

                // Tables
                var incBody = state.income.map(function(i) {
                    return '<tr><td><strong>' + i.name + '</strong></td><td>' + i.cat + '</td><td>' +
                        formatDate(i.date) +
                        '</td><td style="text-align:right;color:var(--teal-dark);font-weight:700">' + peso(i
                            .amount) + '</td></tr>';
                }).join('');
                document.getElementById('incomeTable').innerHTML = incBody;
                document.getElementById('incomeEmpty').style.display = state.income.length ? 'none' : 'block';

                var expBody = state.expenses.map(function(e) {
                    return '<tr><td><strong>' + e.name + '</strong></td><td>' + e.cat + '</td><td>' +
                        formatDate(e.date) +
                        '</td><td style="text-align:right;color:var(--red);font-weight:700">' + peso(e.amount) +
                        '</td></tr>';
                }).join('');
                document.getElementById('expenseTable').innerHTML = expBody;
                document.getElementById('expenseEmpty').style.display = state.expenses.length ? 'none' : 'block';

                // Charts + insight
                renderWeekChart('weekChart');
                renderWeekChart('patternsChart');
                var days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                var maxIdx = 0;
                state.weekSpend.forEach(function(v, i) {
                    if (v > state.weekSpend[maxIdx]) maxIdx = i;
                });
                var insight = 'Highest spend was <strong>' + days[maxIdx] + '</strong> (' + peso(state.weekSpend[
                    maxIdx]) + '). Food and transport usually lead the week.';
                document.getElementById('weekInsight').innerHTML = insight;
                document.getElementById('patternsInsight').innerHTML = insight +
                    ' Add more expenses to see patterns change.';
            }


            function escapeCsv(val) {
                var s = String(val == null ? '' : val);
                if (/[",\n]/.test(s)) return '"' + s.replace(/"/g, '""') + '"';
                return s;
            }

            function buildMonthlyCsv() {
                var lines = [];
                var month = 'September 2026';
                lines.push('BudgetBuddy Export');
                lines.push('Month,' + escapeCsv(month));
                lines.push('Generated,' + escapeCsv(new Date().toISOString()));
                lines.push('');
                lines.push('SUMMARY');
                lines.push('Total Income,' + totalIncome());
                lines.push('Total Expenses,' + totalExpenses());
                lines.push('Balance,' + (totalIncome() - totalExpenses()));
                lines.push('Total Budget Limits,' + totalBudget());
                lines.push('');
                lines.push('INCOME');
                lines.push('Date,Source,Category,Amount');
                state.income.forEach(function(i) {
                    lines.push([escapeCsv(i.date), escapeCsv(i.name), escapeCsv(i.cat), i.amount].join(','));
                });
                lines.push('');
                lines.push('EXPENSES');
                lines.push('Date,Description,Category,Amount');
                state.expenses.forEach(function(e) {
                    lines.push([escapeCsv(e.date), escapeCsv(e.name), escapeCsv(e.cat), e.amount].join(','));
                });
                lines.push('');
                lines.push('BUDGETS BY CATEGORY');
                lines.push('Category,Limit,Spent,Remaining');
                Object.keys(state.budgets).forEach(function(cat) {
                    var spent = spentInCat(cat);
                    var limit = state.budgets[cat];
                    lines.push([escapeCsv(cat), limit, spent, limit - spent].join(','));
                });
                return lines.join('\n');
            }

            function downloadExcel() {
                var monthLabel = 'September 2026';
                var fileBase = 'budgetbuddy-september-2026';
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

                var hiExp = maxExpense();
                var loExp = minExpense();
                var hiInc = maxIncome();
                var loInc = minIncome();
                var incTotal = totalIncome();
                var expTotal = totalExpenses();
                var bal = incTotal - expTotal;
                var bud = totalBudget();
                var usedPct = bud ? Math.round((expTotal / bud) * 100) : 0;

                var expensesSorted = state.expenses.slice().sort(function(a, b) {
                    return b.amount - a.amount;
                });
                var incomeSorted = state.income.slice().sort(function(a, b) {
                    return b.amount - a.amount;
                });

                // Top category by spend
                var catSpend = {};
                state.expenses.forEach(function(e) {
                    catSpend[e.cat] = (catSpend[e.cat] || 0) + e.amount;
                });
                var topCat = null;
                var topCatAmt = 0;
                Object.keys(catSpend).forEach(function(c) {
                    if (catSpend[c] > topCatAmt) {
                        topCatAmt = catSpend[c];
                        topCat = c;
                    }
                });

                var maxWeekIdx = 0;
                state.weekSpend.forEach(function(v, i) {
                    if (v > state.weekSpend[maxWeekIdx]) maxWeekIdx = i;
                });
                var minWeekIdx = 0;
                state.weekSpend.forEach(function(v, i) {
                    if (v < state.weekSpend[minWeekIdx]) minWeekIdx = i;
                });

                // ——— Free rule-based "AI" recommendations ———
                function buildRecommendations() {
                    var tips = [];
                    tips.push(['BudgetBuddy Recommendations', '', '']);
                    tips.push(['(Free insights based on your numbers — no paid AI required)', '', '']);
                    tips.push(['', '', '']);
                    tips.push(['#', 'Recommendation', 'Why']);

                    var n = 1;
                    if (usedPct >= 90) {
                        tips.push([n++, 'Slow down spending for the rest of the month', 'You have used about ' +
                            usedPct + '% of your total budget limits.'
                        ]);
                    } else if (usedPct >= 70) {
                        tips.push([n++, 'Watch discretionary spending', 'You are at ' + usedPct +
                            '% of budget — still OK, but leave room for bills.'
                        ]);
                    } else {
                        tips.push([n++, 'You are on track this month', 'Only about ' + usedPct +
                            '% of category budgets used. Keep logging consistently.'
                        ]);
                    }

                    if (topCat && expTotal > 0) {
                        var share = Math.round((topCatAmt / expTotal) * 100);
                        tips.push([n++, 'Focus on ' + topCat + ' first if you want to save', topCat +
                            ' is your top category (' + share + '% of expenses, ' + topCatAmt + ' pesos).'
                        ]);
                    }

                    Object.keys(state.budgets).forEach(function(cat) {
                        var spent = spentInCat(cat);
                        var limit = state.budgets[cat];
                        if (!limit) return;
                        var p = Math.round((spent / limit) * 100);
                        if (p >= 90) {
                            tips.push([n++, 'Almost at limit for ' + cat, 'Spent ' + spent + ' of ' + limit +
                                ' (' + p + '%). Avoid extra ' + cat.toLowerCase() + ' this month.'
                            ]);
                        } else if (p >= 75) {
                            tips.push([n++, 'Careful with ' + cat, p + '% of your ' + cat +
                                ' budget is used.'
                            ]);
                        }
                    });

                    if (hiExp && expTotal > 0 && hiExp.amount >= expTotal * 0.25) {
                        tips.push([n++, 'Review your biggest single expense', '"' + hiExp.name + '" (' + hiExp.amount +
                            ' pesos) is a large share of total spend.'
                        ]);
                    }

                    if (state.weekSpend[maxWeekIdx] > 0) {
                        tips.push([n++, 'Plan around your high-spend day', dayNames[maxWeekIdx] +
                            ' was your highest day this week. Prep meals or set a daily cap that day.'
                        ]);
                    }

                    if (bal < 0) {
                        tips.push([n++, 'Expenses exceed income',
                            'Balance is negative. Cut non-essentials or add income before next month.'
                        ]);
                    } else if (bal > 0 && expTotal > 0) {
                        tips.push([n++, 'Protect your surplus', 'You have ' + bal +
                            ' pesos left. Consider moving part of it to savings when you get paid.'
                        ]);
                    }

                    if (state.expenses.length < 3) {
                        tips.push([n++, 'Log more expenses for better tips',
                            'More entries = clearer trends and smarter recommendations.'
                        ]);
                    }

                    tips.push([n++, 'Export before Reset',
                        'Download this Excel file anytime so you keep a monthly record.'
                    ]);
                    tips.push([n++, 'Set realistic category limits',
                        'Update budgets under Budgets so limits match your real lifestyle.'
                    ]);

                    return tips;
                }

                // Header style helpers (xlsx-js-style)
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
                var styleWarn = {
                    font: {
                        bold: true,
                        color: {
                            rgb: 'E14B5A'
                        }
                    }
                };
                var styleGood = {
                    font: {
                        bold: true,
                        color: {
                            rgb: '00A08A'
                        }
                    }
                };
                var styleMoney = {
                    numFmt: '#,##0',
                    alignment: {
                        horizontal: 'right'
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

                    // ===== Summary =====
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
                    applyRowStyle(wsSummary, 14, 4, styleHeader); // header row Metric/Name...
                    XLSX.utils.book_append_sheet(wb, wsSummary, 'Summary');

                    // ===== Trends (chart-ready data) =====
                    // User can select this table in Excel → Insert → Line Chart / Column Chart
                    var trend = [
                        ['TREND DATA — Select a table below → Insert → Charts → Line or Column'],
                        [],
                        ['Weekly spending (for line / column chart)'],
                        ['Day', 'Amount (PHP)'],
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
                        var spent = spentInCat(cat);
                        var limit = state.budgets[cat];
                        var p = limit ? Math.round((spent / limit) * 100) : 0;
                        trend.push([cat, spent, limit, p]);
                    });
                    // Also include categories that appear in expenses but not in budgets
                    Object.keys(catSpend).forEach(function(cat) {
                        if (!state.budgets[cat]) {
                            trend.push([cat, catSpend[cat], '', '']);
                        }
                    });
                    var wsTrend = sheetFromAoA(trend, [28, 16, 14, 12]);
                    if (wsTrend['A1']) wsTrend['A1'].s = styleTitle;
                    if (wsTrend['A3']) wsTrend['A3'].s = styleSection;
                    if (wsTrend['A4']) applyRowStyle(wsTrend, 3, 2, styleHeader);
                    XLSX.utils.book_append_sheet(wb, wsTrend, 'Trends (Chart Data)');

                    // ===== Recommendations =====
                    var rec = buildRecommendations();
                    var wsRec = sheetFromAoA(rec, [6, 55, 55]);
                    if (wsRec['A1']) wsRec['A1'].s = styleTitle;
                    if (wsRec['A4']) applyRowStyle(wsRec, 3, 3, styleHeader);
                    XLSX.utils.book_append_sheet(wb, wsRec, 'Recommendations');

                    // ===== Income List =====
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

                    // ===== Expense List =====
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

                    // ===== Budgets =====
                    var budgetRows = [
                        ['Category', 'Limit', 'Spent', 'Remaining', '% Used']
                    ];
                    Object.keys(state.budgets).forEach(function(cat) {
                        var spent = spentInCat(cat);
                        var limit = state.budgets[cat];
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

                // CSV fallback
                var lines = buildMonthlyCsv().split('\n');
                lines.push('');
                lines.push('RECOMMENDATIONS');
                buildRecommendations().forEach(function(row) {
                    if (row[0] === '#' || row[0] === '') return;
                    lines.push([row[0], row[1], row[2]].join(','));
                });
                var blob = new Blob(['\ufeff' + lines.join('\n')], {
                    type: 'text/csv;charset=utf-8;'
                });
                var url = URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = fileBase + '.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
                toast('CSV downloaded — open with Excel');
            }

            var exportBtn = document.getElementById('btnExport');
            if (exportBtn) exportBtn.addEventListener('click', downloadExcel);

            var resetBtn = document.getElementById('btnReset');
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    var ok = window.confirm(
                        'Delete all income and expenses?\n\nTip: use Export Excel first if you want to keep a copy.\n\nRestore demo sample data?'
                    );
                    if (!ok) return;
                    if (typeof getDefaultState === 'function') {
                        state = getDefaultState();
                        window.__bbState = state;
                    } else {
                        state.income = [];
                        state.expenses = [];
                        state.weekSpend = [0, 0, 0, 0, 0, 0, 0];
                    }
                    toast('Data reset');
                    render();
                    if (typeof showView === 'function') showView('dashboard');
                });
            }


            render();
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
                <p>Free assistant · uses your data</p>
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
            <input type="text" id="chatInput" placeholder="Ask about your budget…" autocomplete="off"
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
                if (!s) {
                    return {
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
                }
                var inc = (s.income || []).reduce(function(a, i) {
                    return a + Number(i.amount);
                }, 0);
                var exp = (s.expenses || []).reduce(function(a, e) {
                    return a + Number(e.amount);
                }, 0);
                var bud = 0;
                var budgets = s.budgets || {};
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
                var hiExp = (s.expenses && s.expenses.length) ?
                    s.expenses.reduce(function(a, b) {
                        return Number(a.amount) >= Number(b.amount) ? a : b;
                    }) :
                    null;
                var week = s.weekSpend || [0, 0, 0, 0, 0, 0, 0];
                var maxW = 0;
                week.forEach(function(v, i) {
                    if (v > week[maxW]) maxW = i;
                });

                function spentInCat(cat) {
                    return (s.expenses || []).filter(function(e) {
                            return e.cat === cat;
                        })
                        .reduce(function(a, e) {
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

                if (!fab || !panel || !msgs) {
                    console.error('BudgetBuddy chat: elements not found');
                    return;
                }

                var greeted = false;

                function openChat() {
                    panel.classList.add('open');
                    fab.classList.add('open');
                    if (!greeted) {
                        greeted = true;
                        addBot("Hi! I'm your free BudgetBuddy assistant 👋 I answer using your dashboard numbers.");
                        addBot("Tap a quick question, or type your own.");
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
                    if (panel.classList.contains('open')) closeChat();
                    else openChat();
                };

                if (closeBtn) {
                    closeBtn.onclick = function(e) {
                        e.preventDefault();
                        closeChat();
                    };
                }

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

                    if (/hello|hi\b|hey|good morning|good afternoon/.test(t)) {
                        return "Hey! 👋 Ask about <strong>balance</strong>, <strong>spending</strong>, <strong>budget</strong>, or how to <strong>save</strong>.";
                    }
                    if (/balance|left|remaining money|how much.*(have|left)/.test(t)) {
                        return "Balance: <strong>" + peso(d.bal) + "</strong><br>Income " + peso(d.inc) +
                            " − Expenses " + peso(d.exp) + ".";
                    }
                    if (/income|earn|salary/.test(t)) {
                        return "Total income: <strong>" + peso(d.inc) + "</strong> (" + d.income.length + " entries).";
                    }
                    if (/expense|spent|spending|where.*money|top spend|most/.test(t)) {
                        var msg = "Total expenses: <strong>" + peso(d.exp) + "</strong>.";
                        if (d.topCat) msg += "<br>Most spent on <strong>" + d.topCat + "</strong> (" + peso(d.topAmt) +
                            ").";
                        if (d.hiExp) msg += "<br>Biggest item: <strong>" + d.hiExp.name + "</strong> (" + peso(d.hiExp
                            .amount) + ").";
                        return msg;
                    }
                    if (/budget|limit|on track|how am i|doing|status|overview/.test(t)) {
                        var tone = d.usedPct >= 90 ? "Near the limit — cut non-essentials." :
                            d.usedPct >= 70 ? "OK but leave room for bills." :
                            "Looking good — keep logging.";
                        return "Budget used: <strong>" + d.usedPct + "%</strong> of " + peso(d.bud) + ".<br>" + tone;
                    }
                    if (/warn|danger|over|risk|problem/.test(t)) {
                        var warns = [];
                        if (d.usedPct >= 85) warns.push("Overall budget at " + d.usedPct + "%.");
                        Object.keys(d.budgets).forEach(function(cat) {
                            var s = d.spentInCat(cat),
                                lim = d.budgets[cat];
                            if (lim && s / lim >= 0.85) warns.push(cat + " at " + Math.round(s / lim * 100) +
                                "% of limit.");
                        });
                        if (d.bal < 0) warns.push("Expenses exceed income.");
                        if (!warns.length) return "No major warnings ✅";
                        return "Heads-up:<br>• " + warns.join("<br>• ");
                    }
                    if (/save|saving|cut|reduce|tips|recommend|should i|what should/.test(t)) {
                        var tips = [];
                        if (d.topCat) tips.push("Trim <strong>" + d.topCat + "</strong> first.");
                        if (d.week[d.maxW] > 0) tips.push("Spend less on <strong>" + dayNames[d.maxW] + "</strong>.");
                        tips.push("Export Excel before Reset.");
                        tips.push("Update limits under Budgets.");
                        return "Try this:<br>• " + tips.join("<br>• ");
                    }
                    if (/food|transport|internet|fun/.test(t)) {
                        var cat = /food/.test(t) ? 'Food' : /transport/.test(t) ? 'Transport' : /internet/.test(t) ?
                            'Internet' : 'Fun';
                        if (d.budgets[cat] != null) {
                            var s = d.spentInCat(cat),
                                lim = d.budgets[cat],
                                p = lim ? Math.round(s / lim * 100) : 0;
                            return "<strong>" + cat + "</strong>: " + peso(s) + " of " + peso(lim) + " (" + p + "%).";
                        }
                        return "No budget set for that category yet.";
                    }
                    if (/export|excel|download|csv/.test(t)) {
                        return "Use <strong>Export Excel</strong> in the top bar.";
                    }
                    if (/reset|delete|clear/.test(t)) {
                        return "Reset restores demo data. Export first if you need a copy.";
                    }
                    if (/help|what can you|commands/.test(t)) {
                        return "Ask about balance, spending, budget, warnings, saving, or a category.";
                    }
                    if (/thank|salamat|thanks/.test(t)) {
                        return "You're welcome! 💪";
                    }
                    return "Try: <strong>How am I doing?</strong>, <strong>Top spending</strong>, or <strong>How to save</strong>.";
                }

                function ask(q) {
                    if (!q || !String(q).trim()) return;
                    addUser(String(q).trim());
                    setTimeout(function() {
                        addBot(replyTo(q));
                    }, 250);
                }

                if (form) {
                    form.onsubmit = function(e) {
                        e.preventDefault();
                        var q = input.value;
                        input.value = '';
                        ask(q);
                        return false;
                    };
                }
                if (quick) {
                    Array.prototype.forEach.call(quick.querySelectorAll('button[data-q]'), function(b) {
                        b.onclick = function() {
                            ask(b.getAttribute('data-q'));
                        };
                    });
                }

                console.log('BudgetBuddy chat ready');
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', boot);
            } else {
                boot();
            }
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/xlsx-js-style@1.2.0/dist/xlsx.min.js"></script>
</body>

</html>
