<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    if (!preg_match('/^(\+7|8)?9\d{9}$/', $phone_number)) {
        $error = "Неверный формат номера телефона. Пожалуйста, введите корректный номер телефона для России.";
    } else {

        $sql = "INSERT INTO Contacts (full_name, phone_number, company_name, address, email) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$full_name, $phone_number, $company_name, $address, $email]);

        header('Location: contact.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить контакт</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background: linear-gradient(135deg, #3A8DFF, #00E4B5);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            position: relative;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #555;
        }
        .form-group input[type="text"], .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #22ff1f;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-group button:hover {
            background-color: #007BFF;
        }
        .logout-button {
            position: absolute;
            left: 0;
            top: 0;
            margin: 10px;
        }
        .logout-button img {
            width: 30px;
            height: 30px;
            cursor: pointer;
        }
        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logout-button">
        <a href="contact.php"><img src="../icon/icon2.png"></a>
    </div>
    <div class="header">
        <h1>Добавить контакт</h1>
    </div>

    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="full_name">Полное имя</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Номер телефона</label>
            <input type="text" id="phone_number" name="phone_number" required>
        </div>
        <div class="form-group">
            <label for="company_name">Компания</label>
            <input type="text" id="company_name" name="company_name">
        </div>
        <div class="form-group">
            <label for="address">Адрес</label>
            <input type="text" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div class="form-group">
            <button type="submit">Добавить</button>
        </div>
    </form>
</div>

</body>
</html>
