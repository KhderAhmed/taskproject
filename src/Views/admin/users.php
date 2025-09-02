<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?? 'ar' ?>" dir="<?= ($_SESSION['lang'] ?? 'ar') === 'ar' ? 'rtl' : 'ltr' ?>">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= __('dashboard') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/uikit@3.18.0/dist/css/uikit.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;800&display=swap" rel="stylesheet">


  <style>
    :root {
      --bg: #121212;
      --panel: #1d1d1f;
      --muted: #cfcfcf;
      --accent-start: #7b5cff;
      --accent-end: #4c00ff;
      --success: #28a745;
      --danger: #dc3545;
      --info: #17a2b8;
      --warning: #ffc107;
    }

    .header-actions {
      display: flex;
      gap: 14px;
      align-items: center;
    }

    .dropdown {
      position: relative;
    }

    .dropbtn {
      background: linear-gradient(135deg, var(--accent-start), var(--accent-end));
      color: white;
      padding: 8px 14px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .dropbtn:hover {
      opacity: 0.9;
      transform: translateY(-1px);
    }

    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background: var(--panel);
      min-width: 140px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4);
      border-radius: 8px;
      overflow: hidden;
      z-index: 1200;
    }

    .dropdown-content a {
      display: block;
      padding: 10px 14px;
      text-decoration: none;
      color: var(--muted);
      transition: all 0.2s ease;
    }

    .dropdown-content a:hover {
      background: rgba(124, 92, 255, 0.15);
      color: white;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }


    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Cairo', sans-serif;
      background: var(--bg);
      color: var(--muted);
      display: flex;
      flex-direction: column;
      height: 100vh;
    }

    /* Header */
    header {
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      background: linear-gradient(90deg, #1a1a1a, #121212);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
      z-index: 1100;
    }

    header .title {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    header .logo-circle {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: grid;
      place-items: center;
      background: linear-gradient(135deg, var(--accent-start), var(--accent-end));
      color: white;
      font-weight: 900;
      font-size: 16px;
    }

    /* Layout */
    .app {
      display: flex;
      flex: 1;
      height: calc(100vh - 64px);
      overflow: hidden;
    }

    /* Sidebar */
    .sidebar {
      background: var(--panel);
      width: 80px;
      transition: width 0.3s ease;
      display: flex;
      flex-direction: column;
      padding-top: 20px;
    }

    .sidebar:hover {
      width: 220px;
    }

    .sidebar .logo {
      color: white;
      font-weight: 800;
      text-align: center;
      padding: 10px;
      white-space: nowrap;
      overflow: hidden;
      opacity: 0;
      transition: all 0.3s ease;
    }

    .sidebar:hover .logo {
      opacity: 1;
    }

    .sidebar .menu {
      display: flex;
      flex-direction: column;
      gap: 6px;
      padding: 0 10px;
    }

    .sidebar .menu a {
      display: block;
      padding: 10px 12px;
      border-radius: 8px;
      text-decoration: none;
      color: var(--muted);
      font-weight: 600;
      transition: all 0.2s ease;
    }

    .sidebar .menu a:hover {
      background: rgba(124, 92, 255, 0.15);
      color: white;
    }

    .sidebar .menu a.active {
      background: linear-gradient(90deg, var(--accent-start), var(--accent-end));
      color: #fff;
      box-shadow: 0 6px 18px rgba(124, 92, 255, 0.3);
    }

    /* Main Content */
    main {
      flex: 1;
      padding: 24px;
      overflow-y: auto;
    }

    h2 {
      margin-bottom: 20px;
      font-weight: 700;
      font-size: 22px;
    }

    /* Form */
    .form-inline {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
      max-width: 600px;
    }

    .form-inline input {
      flex: 1;
      padding: 10px 14px;
      border-radius: 8px;
      border: 1px solid rgba(255, 255, 255, 0.15);
      background: #1a1a1a;
      color: white;
    }

    .form-inline button {
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      background: var(--accent-start);
      color: white;
      font-weight: 600;
      cursor: pointer;
    }

    .form-inline button:hover {
      opacity: 0.9;
    }

    /* Table */
    .table-wrap {
      overflow-x: auto;
      width: 100%;
      max-width: 1000px;
      margin-top: 20px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4);
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      font-size: 14px;
    }

    thead th {
      background: #1e1e1e;
      color: var(--accent-start);
      font-weight: 700;
      text-align: right;
      padding: 12px 20px;
    }

    tbody tr {
      background: #222;
      transition: all 0.3s ease;
    }

    tbody tr:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(124, 92, 255, 0.3);
    }

    td {
      padding: 12px 20px;
      text-align: right;
    }

    /* Badges */
    .badge-complete {
      padding: 4px 10px;
      background: var(--success);
      color: #fff;
      border-radius: 20px;
      font-size: 13px;
    }

    .badge-pending {
      padding: 4px 10px;
      background: var(--warning);
      color: #fff;
      border-radius: 20px;
      font-size: 13px;
    }

    /* Actions */
    .actions button {
      margin-left: 6px;
      padding: 6px 14px;
      border-radius: 6px;
      font-size: 13px;
      border: none;
      color: #fff;
      cursor: pointer;
    }

    .complete {
      background: var(--info);
    }

    .cancel {
      background: var(--warning);
    }

    .delete {
      background: var(--danger);
    }

    .actions button:hover {
      opacity: 0.85;
      transform: translateY(-1px);
    }
  </style>
</head>

<body>

  <header>
    <div class="title">
      <div class="logo-circle">لو</div>
      <div>
        <div><?= __('tasks') ?></div>
        <div class="muted" style="font-size:12px;font-weight:600"><?= __('dashboard') ?></div>
      </div>
    </div>

    <div class="header-actions">
      <!-- Language Switch -->
      <div class="dropdown">
        <button class="dropbtn">🌐 <?= strtoupper($_SESSION['lang'] ?? 'AR') ?></button>
        <div class="dropdown-content">
          <a href="?lang=ar">🇸🇦 العربية</a>
          <a href="?lang=en">🇺🇸 English</a>
        </div>
      </div>

      <!-- Admin Menu -->
      <div class="dropdown">
        <button class="dropbtn">👤 <?= htmlspecialchars($_SESSION['name'] ?? __('dashboard')) ?></button>
        <div class="dropdown-content">
          <a href="/profile"><?= __('profile') ?></a>
          <a href="/logoutadmin"><?= __('logout') ?></a>
        </div>
      </div>
    </div>

  </header>

  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo"><?= htmlspecialchars($_SESSION['name'] ?? '') ?></div>
      <nav class="menu">
        <a href="/admin" class="active"><?= __('home') ?></a>
        <a href="/tasks-admin"><?= __('my_tasks') ?></a>
        <a href="/users"><?= __('users') ?></a>
        <a href="#"><?= __('settings') ?></a>
      </nav>
    </aside>

    <!-- Main -->
    <main>


      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th><?= __('id') ?></th>
              <th><?= __('name') ?></th>
              <th><?= __('email') ?></th>
              <th><?= __('created_at') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td>
                  <?= ($user->id) ?>
                </td>
                <td>
                  <?= ($user->username) ?>
                </td>
                <td>
                  <?= ($user->email) ?>
                </td>
                <td>
                  <?= ($user->created_at) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>

</html>