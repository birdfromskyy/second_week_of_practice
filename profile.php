<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
    exit(); // Останавливаем выполнение скрипта
};

// Получаем данные пользователя из базы данных
$stmt = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['save'])){
    // Обработка и сохранение данных из формы
    $course = $_POST['course'];
    $groupp = $_POST['groupp'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $patronymic = $_POST['patronymic'];
    $institute = $_POST['institute'];
    $direction = $_POST['direction'];

    // Обновление данных в базе данных
    $update = $conn->prepare("UPDATE `users` SET course=?, groupp=?, name=?, surname=?, patronymic=?, institute=?, direction=? WHERE id=?");
    $update->execute([$course, $groupp, $name, $surname, $patronymic, $institute, $direction, $user_id]);
    header('location:profile.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php include 'header.php'; ?>
    <div class="profile-container">
        <div class="section">
            <h3>Личные данные</h3>
            <form action="" method="POST">
            <div class="input-group">
                    <label for="course">Курс:</label>
                    <input type="text" id="course" name="course" value="<?= $user['course'] ?>" placeholder="Введите ваш курс">
                </div>
                <div class="input-group">
                    <label for="groupp">Группа:</label>
                    <input type="text" id="groupp" name="groupp" value="<?= $user['groupp'] ?>" placeholder="Введите вашу группу">
                </div>
                <div class="input-group">
                    <label for="name">Имя:</label>
                    <input type="text" id="name" name="name" value="<?= $user['name'] ?>" placeholder="Введите ваше имя">
                </div>
                <div class="input-group">
                    <label for="surname">Фамилия:</label>
                    <input type="text" id="surname" name="surname" value="<?= $user['surname'] ?>" placeholder="Введите вашу фамилию">
                </div>
                <div class="input-group">
                    <label for="patronymic">Отчество:</label>
                    <input type="text" id="patronymic" name="patronymic" value="<?= $user['patronymic'] ?>" placeholder="Введите ваше отчество">
                </div>
                <div class="input-group">
                    <label for="institute">Институт:</label>
                    <input type="text" id="institute" name="institute" value="<?= $user['institute'] ?>" placeholder="Введите ваш институт">
                </div>
                <div class="input-group">
                    <label for="direction">Направление:</label>
                    <input type="text" id="direction" name="direction" value="<?= $user['direction'] ?>" placeholder="Введите ваше направление">
                </div>
                <input type="submit" name="save" value="Сохранить">
            </form>
        </div>
    </div>
</body>
</html>
