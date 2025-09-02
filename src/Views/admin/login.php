<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>تسجيل الدخول - Admin Panel</title>
    <link
        href="https://cdn.jsdelivr.net/npm/uikit@3.18.0/dist/css/uikit.min.css"
        rel="stylesheet" />
<style>         
        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');

        body {
            margin: 0;
            font-family: 'Cairo', sans-serif;
            background-color: #121212;
            color: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: 16px;
            line-height: 1.6;
            overflow: hidden;
            user-select: none;
        }

        .login-container {
            background: #181818;
            padding: 3rem 4rem;
            border-radius: 12px;
            box-shadow: 0 0 24px rgba(214, 64, 130, 0.5);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 2rem;
            color: #f472b6;
            font-weight: 900;
            font-size: 1.8rem;
            user-select: none;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.3rem;
        }

        label {
            text-align: right;
            font-weight: 700;
            font-size: 1rem;
            user-select: none;
        }

        input[type="text"],
        input[type="password"] {
            background: #1e1e1e;
            border: none;
            border-radius: 8px;
            padding: 0.8rem 1rem;
            color: #eee;
            font-size: 1rem;
            transition: box-shadow 0.3s ease;
            user-select: text;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            box-shadow: 0 0 8px #d64082;
            background: #2c2c2c;
        }

        button {
            background: #f472b6;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 900;
            font-size: 1.1rem;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            user-select: none;
            box-shadow: 0 2px 14px #f472b6cc;
        }

        button:hover {
            background: #d64082;
            box-shadow: 0 5px 20px #d64082cc;
        }

        /* Responsive */
        @media (max-width: 400px) {
            .login-container {
                width: 90vw;
                padding: 2rem 1.5rem;
            }
        }
   </style>
</head>

<body>
    <div class="login-container" >
        <h2>تسجيل الدخول</h2>

        <form method="POST" action="/loginadmin" >
            <label for="name">اسم المستخدم</label>
            <input type="text" id="name" name="name" required />

            <label for="password">كلمة المرور</label>
            <input type="password" id="password" name="password" required />

            <button type="submit">دخول</button>
        </form>
    </div>


</body>

</html>