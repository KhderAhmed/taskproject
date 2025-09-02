<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title> <?= __('crena') ?></title>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/uikit@3.16.23/dist/css/uikit.min.css" />
  <style>
    body {
      background: linear-gradient(135deg, #fce4ec, #d1c4e9);
      font-family: "Cairo", sans-serif, "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 1.5rem;
    }

    .login-box {
      background: #fff;
      padding: 3rem 2.5rem;
      border-radius: 15px;
      box-shadow: 0 15px 40px rgba(142, 36, 170, 0.25);
      max-width: 400px;
      width: 100%;
      transition: transform 0.3s ease;
    }

    .login-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 60px rgba(142, 36, 170, 0.35);
    }

    label.uk-form-label {
      color: #7b1fa2;
      font-weight: 700;
      font-size: 1.1rem;
    }

    .uk-input {
      border: 2px solid #ce93d8;
      padding: 12px;
      font-size: 1rem;
      border-radius: 8px;
      transition: border-color 0.4s ease, box-shadow 0.4s ease;
    }

    .uk-input:focus {
      border-color: #6a1b9a;
      box-shadow: 0 0 10px #ab47bc;
      outline: none;
    }

    .uk-button-primary {
      background-color: #6a1b9a !important;
      border-color: #6a1b9a !important;
      font-weight: 900;
      font-size: 1rem;
      padding: 10px 0;
      border-radius: 12px;
      letter-spacing: 0.06em;
      box-shadow: 0 3px 10px rgba(154, 33, 163, 0.6);
      transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.15s ease;
      cursor: pointer;
      user-select: none;
      text-transform: uppercase;
    }

    .uk-button-primary:hover,
    .uk-button-primary:focus {
      background-color: #9c27b0 !important;
      border-color: #9c27b0 !important;
      box-shadow: 0 5px 15px rgba(156, 39, 176, 0.8);
      transform: translateY(-1.5px);
      outline: none;
    }

    .uk-button-primary:active {
      background-color: #4a148c !important;
      border-color: #4a148c !important;
      box-shadow: 0 2px 7px rgba(74, 20, 140, 0.6);
      transform: translateY(0);
    }

    .uk-link-reset {
      color: #8e24aa;
      font-weight: 700;
      font-size: 0.9rem;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .uk-link-reset:hover {
      color: #d05ce3;
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="login-box uk-box-shadow-large">

    <!-- هنا عرض الأخطاء -->
    <?php if (!empty($errors)): ?>
      <div class="uk-alert-danger" uk-alert>
        <ul class="uk-list">
          <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form class="uk-form-stacked" method="POST" action="/register.php" novalidate>
      <h2 class="uk-heading-line uk-text-center" style="color:#6a1b9a; margin-bottom: 1.8rem;">
        <span><?= __('crena') ?></span>
      </h2>

      <div class="uk-margin">
        <label class="uk-form-label" for="name"><?= __('fullname') ?></label>
        <div class="uk-form-controls">
          <input
            class="uk-input"
            id="username"
            name="username"
            type="text"
            placeholder="<?= __('fullname') ?>"
            required
            autofocus />
        </div>
      </div>

      <div class="uk-margin">
        <label class="uk-form-label" for="email"><?= __('email') ?> </label>
        <div class="uk-form-controls">
          <input
            class="uk-input"
            id="email"
            name="email"
            type="email"
            placeholder="example@mail.com"
            required />
        </div>
      </div>

      <div class="uk-margin">
        <label class="uk-form-label" for="password"> <?= __('password') ?></label>
        <div class="uk-form-controls">
          <input
            class="uk-input"
            id="password"
            name="password"
            type="password"
            placeholder="••••••••"
            required />
        </div>
      </div>

      <div class="uk-margin">
        <label class="uk-form-label" for="password_confirm"> <?= __('password_confirm') ?></label>
        <div class="uk-form-controls">
          <input
            class="uk-input"
            id="password_confirm"
            name="password_confirm"
            type="password"
            placeholder="••••••••"
            required />
        </div>
      </div>

      <button
        type="submit"
        class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-top">
       <?= __('register') ?>
      </button>

      <p class="uk-text-center uk-margin-top" style="color:#6a1b9a; font-weight:700;">
      <?= __('alredyaccount') ?> <a href="/login.php" class="uk-link-reset">      <?= __('login') ?></a>
      </p>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.23/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.23/dist/js/uikit-icons.min.js"></script>
</body>

</html>