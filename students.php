<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_POST['submit'])) {
    // Получаем значения полей формы
    $selectedStudentId = $_POST['student_id'];
    $vid_dogovora = $_POST['vid_dogovora'];
    $payment = $_POST['payment'];
    $spravlyalsya = $_POST['spravlyalsya'];
    $kachestva = $_POST['kachestva'];
    $amount_vipolneniya = $_POST['amount_vipolneniya'];
    $zamechaniya = $_POST['zamechaniya'];
    $ocenka = $_POST['ocenka'];

    // Проверяем, существует ли студент с заданным id в таблице interaction
    $checkStudentQuery = $conn->prepare("SELECT COUNT(*) as count FROM interaction WHERE id_student = ?");
    $checkStudentQuery->execute([$selectedStudentId]);
    $result = $checkStudentQuery->fetch();

    if($result['count'] > 0) {
        // Если студент существует, выполняем обновление данных
        $updateInteraction = $conn->prepare("UPDATE interaction SET vid_dogovora=?, payment=?, spravlyalsya=?, kachestva=?, amount_vipolneniya=?, zamechaniya=?, ocenka=? WHERE id_student=?");
        $updateInteraction->execute([$vid_dogovora, $payment, $spravlyalsya, $kachestva, $amount_vipolneniya, $zamechaniya, $ocenka, $selectedStudentId]);
    } else {
        // Если студент не существует, выполняем вставку новых данных
        $insertInteraction = $conn->prepare("INSERT INTO interaction (id_student, vid_dogovora, payment, spravlyalsya, kachestva, amount_vipolneniya, zamechaniya, ocenka) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insertInteraction->execute([$selectedStudentId, $vid_dogovora, $payment, $spravlyalsya, $kachestva, $amount_vipolneniya, $zamechaniya, $ocenka]);
    }

    // Перенаправляем пользователя после выполнения операции
    header('Location: students.php');
    exit; // Важно прекратить выполнение скрипта после перенаправления
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оценить студента</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="profile-container">
        <div class="section">
            <h3>Оцените студента</h3>
            <form method="post">
            <label for="student_id">Выберите студента:</label>
            <select name="student_id" id="student_id">
            <?php
            // Запрос к базе данных для получения списка студентов
            $getStudentsQuery = $conn->prepare("SELECT id, surname, name, patronymic FROM users WHERE type_account = 'user'");
            $getStudentsQuery->execute();
            $students = $getStudentsQuery->fetchAll();

            // Вывод списка студентов
            foreach ($students as $student) {
                echo "<option value='" . $student['id'] . "'>" . $student['id'] . ": " . $student['surname'] . " " . $student['name'] . " " . $student['patronymic'] . "</option>";
            }
            ?>

            </select>

            <!-- Вид договора -->
            <div class="input-group" style="margin-bottom: 10px;">
                <label for="vid_dogovora">Вид договора:</label>
                <input type="text" id="vid_dogovora" name="vid_dogovora" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>

            <!-- Оплачиваемая ли практика -->
            <div class="input-group" style="margin-bottom: 10px;">
                <label for="payment">Оплачиваемая ли практика:</label>
                <select id="payment" name="payment" required style="width: 100%; padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box;">
                    <option value="Да">Да</option>
                    <option value="Нет">Нет</option>
                </select>
            </div>

            <!-- Как справлялся -->
            <div class="input-group" style="margin-bottom: 10px;">
                <label for="spravlyalsya">Как справлялся:</label>
                <input type="text" id="spravlyalsya" name="spravlyalsya" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>

            <!-- Качества -->
            <div class="input-group" style="margin-bottom: 10px;">
                <label for="kachestva">Качества:</label>
                <input type="text" id="kachestva" name="kachestva" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>

            <!-- Объем выполнения -->
            <div class="input-group" style="margin-bottom: 10px;">
                <label for="amount_vipolneniya">Объем выполнения:</label>
                <input type="text" id="amount_vipolneniya" name="amount_vipolneniya" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>

            <!-- Замечания -->
            <div class="input-group" style="margin-bottom: 10px;">
                <label for="zamechaniya">Замечания:</label>
                <input type="text" id="zamechaniya" name="zamechaniya" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>

            <!-- Оценка -->
            <div class="input-group" style="margin-bottom: 10px;">
                <label for="ocenka">Оценка:</label>
                <select id="ocenka" name="ocenka" required style="width: 100%; padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box;">
                    <option value="Отлично">Отлично</option>
                    <option value="Хорошо">Хорошо</option>
                    <option value="Удовлетворительно">Удовлетворительно</option>
                    <option value="Неудовлетворительно">Неудовлетворительно</option>
                </select>
            </div>

            <button type="submit" name="submit" style="padding: 10px 20px; font-size: 16px; border-radius: 5px; background-color: #007bff; color: #fff; border: none; cursor: pointer; transition: background-color 0.3s;">
                Оценить
            </button>
            </form>
        </div>
    </div>

</body>
</html>
