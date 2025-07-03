<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SembakoKu - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff1d6, #fceabb);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 60px 50px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .login-container img {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }

        .login-container h2 {
            margin-bottom: 30px;
            font-size: 32px;
            font-weight: 600;
            color: #cf313b;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 18px 20px;
            margin-bottom: 25px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
        }

        .login-container input:focus {
            border-color: #cf313b;
            outline: none;
        }

        .login-container button {
            width: 100%;
            padding: 18px;
            background-color: #cf313b;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container button:hover {
            background-color: #a3252c;
        }

        .error {
            background-color: #ffe5e5;
            color: #d8000c;
            padding: 12px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .login-container img {
            width: 400px;
            height: auto;
            margin-bottom: -10px;
        }


        @media (max-width: 480px) {
            .login-container {
                padding: 40px 25px;
                max-width: 100%;
            }

            .login-container h2 {
                font-size: 26px;
            }

            .login-container img {
                width: 80px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <a href="<?= base_url(); ?>">
            <img src="<?= base_url('assets/img/logo/logo.png'); ?>" alt="Logo SembakoKu">
        </a>

        <h2>Login</h2>

        <?php if (session()->getFlashdata('failed')): ?>
            <div class="error"><?= session()->getFlashdata('failed') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>