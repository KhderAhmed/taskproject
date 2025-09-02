<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/Helpers/lang.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// تعيين اللغة
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'ar';
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['ar', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?>" dir="<?= $_SESSION['lang'] === 'ar' ? 'rtl' : 'ltr' ?>">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= __('welcome') ?> MyTasks</title>
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
      justify-content: center;
      text-align: center;
      padding: 2rem;
      color: #6a1b9a;
    }

    header {
      width: 100%;
      background-color: #fff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      position: fixed;
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
      font-size: 1.6rem;
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

    nav ul li a {
      color: #4a148c;
      text-decoration: none;
      padding: 0.3rem 0.8rem;
      border-radius: 6px;
      font-weight: 700;
      font-size: 1rem;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    nav ul li a:hover,
    nav ul li a:focus {
      background-color: #6a1b9a;
      color: white;
      outline: none;
    }

    main.welcome-content {
      margin-top: 100px;
      max-width: 700px;
    }

    main.welcome-content h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      font-weight: 900;
      letter-spacing: 0.07em;
    }

    main.welcome-content p {
      font-size: 1.25rem;
      margin-bottom: 2rem;
      line-height: 1.6;
    }

    main.welcome-content a.uk-button-primary {
      background-color: #6a1b9a !important;
      border-color: #6a1b9a !important;
      font-weight: 900;
      font-size: 1.1rem;
      padding: 14px 2.5rem;
      border-radius: 12px;
      letter-spacing: 0.06em;
      box-shadow: 0 3px 10px rgba(154, 33, 163, 0.6);
      transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.15s ease;
      cursor: pointer;
      user-select: none;
      text-transform: uppercase;
      text-decoration: none;
      display: inline-block;
    }

    main.welcome-content a.uk-button-primary:hover,
    main.welcome-content a.uk-button-primary:focus {
      background-color: #9c27b0 !important;
      border-color: #9c27b0 !important;
      box-shadow: 0 5px 15px rgba(156, 39, 176, 0.8);
      transform: translateY(-1.5px);
      outline: none;
    }

    /* قسم الشرح */
    .about-section {
      margin-top: 3rem;
      max-width: 700px;
      background: #fff;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(142, 36, 170, 0.15);
      color: #4a148c;
      text-align: right;
      line-height: 1.7;
      font-size: 1.1rem;
    }

    .info-cards {
      margin-top: 2rem;
      display: flex;
      flex-direction: column;
      gap: 1.8rem;
      text-align: right;
    }

    .info-card {
      background: #f3e5f5;
      padding: 1.5rem 2rem;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(106, 27, 154, 0.1);
      font-weight: 600;
      font-size: 1.1rem;
      color: #6a1b9a;
    }

    .info-card h3 {
      margin-top: 0;
      margin-bottom: 0.5rem;
      font-weight: 900;
      font-size: 1.3rem;
      border-bottom: 2px solid #9c27b0;
      display: inline-block;
      padding-bottom: 0.2rem;
    }

    footer {
      width: 100%;
      max-width: 1200px;
      text-align: center;
      margin-top: auto;
      padding: 1rem 0 2rem;
      color: #6a1b9a;
      font-weight: 700;
      user-select: none;
    }

    /* Responsive */
    @media (min-width: 768px) {
      .info-cards {
        flex-direction: row;
      }
    }
  </style>
</head>

<body>

  <header>
  <div class="container">
    <div class="logo">MyTasks</div>
    <nav>
      <ul>
        <li><a href="/login" title="<?= __('login') ?>"><?= __('login') ?></a></li>
        <li><a href="/documentation" title="<?= __('documentation') ?>"><?= __('documentation') ?></a></li>

        <!-- Dropdown لتغيير اللغة -->
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
      </ul>
    </nav>
  </div>
</header>
  <main class="welcome-content">
    <h1><?= __('task') ?></h1>


    <section class="about-section">
      <h2><?= __('about_title') ?></h2>
      <p><?= __('about_paragraph_1') ?></p>
      <p><?= __('about_paragraph_2') ?></p>

      <div class="info-cards">
        <div class="info-card">
          <h3><?= __('info_card_1_title') ?></h3>
          <p><?= __('info_card_1_text') ?></p>
        </div>
        <div class="info-card">
          <h3><?= __('info_card_2_title') ?></h3>
          <p><?= __('info_card_2_text') ?></p>
        </div>
        <div class="info-card">
          <h3><?= __('info_card_3_title') ?></h3>
          <p><?= __('info_card_3_text') ?></p>
        </div>
      </div>
    </section>
  </main>

  <footer>
    © 2025 MyTasks - KHDER G AHMED - INFORMATION TECNOLOGY ENGINEERING
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.23/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.23/dist/js/uikit-icons.min.js"></script>
</body>

</html>


  

