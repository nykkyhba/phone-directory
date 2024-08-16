<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Пожалуйста, заполните оба поля.";
    } else {
        try {

            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($user) {
                echo "Пользователь найден: ";
                print_r($user);
            } else {
                echo "Пользователь не найден";
            }


            if ($user && $password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: contact.php');
                exit();
            } else {
                $error = "Неверное имя пользователя или пароль.";
            }
        } catch (PDOException $e) {
            $error = "Ошибка базы данных: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма входа</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
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
        input[type="text"], input[type="password"] {
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
            font-size: 15px;
            color: #555;
        }
        p a {
            color: #00c914;
            text-decoration: none;
            font-size: 15px;
        }
        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Вход</h2>

        <form method="post">
            <label for="username">Логин</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Войти</button>
        </form>
        <p>У вас нет учетной записи? <a href="register.php">Зарегистрироваться</a></p>
    </div>
</body>
</html>