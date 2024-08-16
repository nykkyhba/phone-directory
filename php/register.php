<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if (strlen($username) < 3 || strlen($username) > 32) {
        $error = "Логин должен быть от 3 до 32 символов";
    }

    elseif ($password !== $confirm_password) {
        $error = "Пароли не совпадают";
    } else {

        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);

        header('Location: login.php');
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #b721ff, #21d4fd);
        }
        .container {
            text-align: center;
            padding: 40px;
            background-color: white;
            border-radius: 15px;
            width: 320px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 14px;
            margin: 10px 0 5px;
            text-align: left;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            padding: 10px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(to right, #00c914, #9013fe);
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: linear-gradient(to right, #00c914, #c74444);
        }
        p {
            margin-top: 20px;
            font-size: 12px;
            color: #555;
        }
        p a {
            color: #4a90e2;
            text-decoration: none;
        }
        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Регистрация</h2>
        <?php if (!empty($error)) echo '<p style="color: red;">' . $error . '</p>'; ?>
        <form method="post">
            <label for="username">Логин</label>
            <input type="text" name="username" id="username" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" required>
            <label for="confirm_password">Подтвердите пароль</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            <button type="submit">Зарегистрироваться</button>
        </form>
        <p>Уже есть аккаунт? <a href="login.php">Войти здесь</a></p>
    </div>
</body>
</html>
