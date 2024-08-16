<?php
require 'db.php';


$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT id, phone_number, full_name, company_name, address, email FROM Contacts WHERE phone_number LIKE ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["%$search%"]);
} else {
    $sql = "SELECT id, phone_number, full_name, company_name, address, email FROM Contacts";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            min-height: 100vh;
        }
        .container {
            width: 80%;
            max-width: 800px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }
        .header img {
            max-width: 80px;
        }
        .header h1 {
            margin: 10px 0;
            font-size: 28px;
        }
        .search-box-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .logo-container {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        .logo-container img {
            max-width: 40px;
            margin-right: 10px;
        }
        .logo-container span {
            font-size: 24px;
            font-weight: bold;
        }
        .search-box {
            display: flex;
            flex-grow: 1;
            justify-content: center;
        }
        .search-box input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .search-box button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #22ff1f;
            color: black;
            border: none;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
            font-weight: bold;
        }
        .add-button, .logout-button {
            display: flex;
            justify-content: flex-end;
            margin: 20px 0;
        }
        .add-button a, .logout-button a {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #22ff1f;
            color: black;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .add-button a:hover, .logout-button a:hover {
            background-color: #005bb5;
        }
        .contact-info {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .contact-info .title {
            font-weight: bold;
            color: #0078d7;
            font-size: 18px;
        }
        .contact-info .email {
            color: #0078d7;
        }
        .contact-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="search-box-container">
        <div class="logo-container">
            <img src="../icon/icon.png" alt="Логотип">
            <span>Телефонный справочник</span>
        </div>
        <div class="search-box">
            <form method="get">
                <input type="text" name="search" placeholder="Введите номер телефона..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit">Поиск</button>
            </form>
        </div>
    </div>

    <div class="add-button">
        <a href="add_contact.php">Добавить контакт</a>
    </div>

    <div class="logout-button">
        <a href="login.php">Выйти</a>
    </div>

    <div class="section">
        <h2>Контакты</h2>
        <?php if (count($contacts) > 0): ?>
            <?php foreach ($contacts as $contact): ?>
                <div class="contact-info">
                    <p class="title">ID: <?= htmlspecialchars($contact['id']) ?> | <?= htmlspecialchars($contact['full_name']) ?></p>
                    <p>Телефон: <?= htmlspecialchars($contact['phone_number']) ?> | Email: <span class="email"><?= htmlspecialchars($contact['email']) ?></span></p>
                    <p>Компания: <?= htmlspecialchars($contact['company_name']) ?></p>
                    <p>Адрес: <?= htmlspecialchars($contact['address']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Контакты не найдены.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
