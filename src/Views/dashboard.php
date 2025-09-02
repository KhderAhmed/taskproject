<?php
require_once __DIR__ . '/../Helpers/lang.php'; // تحميل الهيلبر الخاص بالترجمة
?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?>">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= __('dashboard_title') ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.23/dist/css/uikit.min.css" />
  <style>
    body {
      font-family: "Cairo", sans-serif, "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      background: linear-gradient(135deg, #fce4ec, #d1c4e9);
      margin: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    header {
      width: 100%;
      background-color: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 999;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 60px;
    }
    .logo {
      font-weight: 900;
      font-size: 1.5rem;
      color: #6a1b9a;
      letter-spacing: 0.1em;
      cursor: default;
      user-select: none;
    }
    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      gap: 2rem;
    }
    nav ul li {
      font-weight: 600;
      color: #4a148c;
    }
    nav ul li a {
      color: #4a148c;
      text-decoration: none;
      padding: 0.3rem 0.5rem;
      border-radius: 6px;
      transition: background-color 0.3s ease, color 0.3s ease;
      font-size: 1rem;
    }
    nav ul li a:hover,
    nav ul li a:focus {
      background-color: #6a1b9a;
      color: white;
      outline: none;
    }
    .welcome-text {
      font-weight: 600;
      color: #4a148c;
      user-select: none;
    }
    .logout-link {
      background-color: #6a1b9a;
      color: white !important;
      padding: 6px 14px;
      border-radius: 20px;
      font-weight: 700;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s ease;
      font-size: 0.95rem;
    }
    .logout-link:hover,
    .logout-link:focus {
      background-color: #9c27b0;
      outline: none;
    }
    .dashboard-container {
      width: 100%;
      max-width: 900px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 15px 40px rgba(142, 36, 170, 0.25);
      padding: 2rem;
      margin: 2rem auto 3rem auto;
    }
    h2 {
      color: #6a1b9a;
      margin-bottom: 1.5rem;
      font-weight: 900;
      text-align: center;
      letter-spacing: 0.05em;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1.5rem;
    }
    table th,
    table td {
      border: 1px solid #ce93d8;
      padding: 0.75rem 1rem;
      text-align: right;
      font-size: 1rem;
      color: #4a148c;
    }
    table th {
      background-color: #f3e5f5;
      font-weight: 700;
    }
    table td button {
      border: none;
      color: white;
      padding: 6px 12px;
      border-radius: 8px;
      font-weight: 700;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    table td form[action="/delete_task.php"] button {
      background-color: #dc3545;
    }
    table td form[action="/delete_task.php"] button:hover {
      background-color: #a71d2a;
    }
    form.form-inline {
      display: flex;
      gap: 0.5rem;
      margin-top: 1rem;
      justify-content: flex-end;
    }
    form.form-inline input[type="text"] {
      flex-grow: 1;
      padding: 8px 12px;
      border: 2px solid #ce93d8;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.4s ease, box-shadow 0.4s ease;
    }
    form.form-inline input[type="text"]:focus {
      border-color: #6a1b9a;
      box-shadow: 0 0 8px #ab47bc;
      outline: none;
    }
    form.form-inline button {
      background-color: #28a745;
      border: none;
      color: white;
      padding: 10px 16px;
      border-radius: 12px;
      font-weight: 900;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    form.form-inline button:hover {
      background-color: #218838;
    }
    .completed {
      text-decoration: line-through;
      color: #9e9e9e;
    }
    footer {
      width: 100%;
      max-width: 900px;
      text-align: center;
      margin-bottom: 2rem;
      color: #6a1b9a;
      font-weight: 700;
    }
  </style>
</head>

<body>
  <header>
    <div class="container">
      <div class="logo">MyTasks</div>
      <nav>
        <ul>
          <li class="welcome-text">
            <?= __('welcome') ?>، <?= htmlspecialchars($_SESSION['username'] ?? '') ?>
          </li>
          <li>
            <div class="uk-inline">
              <button class="uk-button uk-button-default" type="button">
                🌐 <?= $_SESSION['lang'] === 'ar' ? 'العربية' : 'English' ?>
              </button>
              <div uk-dropdown="mode: click">
                <ul class="uk-nav uk-dropdown-nav">
                  <li><a href="?lang=ar">العربية</a></li>
                  <li><a href="?lang=en">English</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <a href="/logout.php" class="logout-link" title="<?= __('logout') ?>">
              <?= __('logout') ?>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="dashboard-container">
    <h2><?= __('your_tasks') ?></h2>

    <form method="post" action="/add_task.php" class="form-inline">
      <input type="text" name="title" placeholder="<?= __('add_new_task') ?>" required>
      <button type="submit"><?= __('add') ?></button>
    </form>

    <table>
      <thead>
        <tr>
          <th><?= __('task') ?></th>
          <th><?= __('status') ?></th>
          <th><?= __('toggle') ?></th>
          <th><?= __('delete') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tasks as $task): ?>
          <tr>
            <td class="<?= $task->completed ? 'completed' : '' ?>">
              <?= htmlspecialchars($task->title) ?>
            </td>
            <td><?= $task->completed ? __('completed') : __('not_completed') ?></td>
            <td>
              <form method="post" action="/toggle_task.php" style="margin:0;">
                <input type="hidden" name="id" value="<?= $task->id ?>">
                <button type="submit" style="background-color:<?= $task->completed ? '#fd7e14' : '#007bff' ?>;">
                  <?= $task->completed ? __('undo') : __('mark_done') ?>
                </button>
              </form>
            </td>
            <td>
              <form method="post" action="/delete_task.php" style="margin:0;">
                <input type="hidden" name="id" value="<?= $task->id ?>">
                <button type="submit" style="background-color:#dc3545;" onclick="return confirm('<?= __('confirm_delete') ?>');">
                  <?= __('delete') ?>
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <footer>
    © 2025 MyTasks - KHDER G AHMED - INFORMATION TECNOLOGY ENGINEERING
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.23/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.23/dist/js/uikit-icons.min.js"></script>
</body>
</html>
