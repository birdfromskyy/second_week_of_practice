<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
    exit(); 
};

if(isset($_POST['submit'])) {
    // Получаем значения полей формы
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $patronymic = $_POST['patronymic'];

    // Генерируем пароль
    $password = generatePassword(7); // Генерируем пароль из 7 символов

    // Генерируем email
    $email = generateEmail($surname, $name, $patronymic);

    // Подготавливаем запрос для вставки данных в таблицу users
    $insertUser = $conn->prepare("INSERT INTO users (surname, name, patronymic, pass, email) VALUES (?, ?, ?, ?, ?)");

    // Выполняем запрос
    $insertUser->execute([$surname, $name, $patronymic, $password, $email]);

    // Перенаправляем пользователя после выполнения операции
    header('Location: add_student.php');
    exit(); // Важно прекратить выполнение скрипта после перенаправления
}

// Функция для генерации пароля
function generatePassword($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }
    return $password;
}

// Функция для генерации email
function generateEmail() {
    // Генерируем 4 случайных цифры
    $randomDigits = mt_rand(10000000, 99999999);
    // Составляем email
    $email = $randomDigits . '@ugrasu.ru'; 
    return $email;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить студента</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>  <section class="form-container">
    <form action="" enctype="multipart/form-data" method="POST">
        <input type="text" name="surname" class="box" placeholder="Введите Фамилию" required>
        <input type="text" name="name" class="box" placeholder="Введите Имя" required>
        <input type="text" name="patronymic" class="box" placeholder="Введите Отчество" required>
        <input type="submit" value="Добавить студента" class="btn" name="submit">
    </form>
</section>

</body>
</html>