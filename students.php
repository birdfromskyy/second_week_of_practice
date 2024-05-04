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
$ocenka = $_POST['ocenka'];

// Определение качеств и объема выполнения в зависимости от оценки
switch ($ocenka) {
    case 'отлично':
        $payment = "нет";
        $kachestva = "высокая ответственность, пунктуальность, тщательность в выполнении заданий";
        $amount_vipolneniya = "полностью";
        $spravlyalsya = "оперативно";
        $zamechaniya = "отсутствуют";
        break;
    case 'хорошо':
        $payment = "нет";
        $kachestva = "ответственность, пунктуальность";
        $amount_vipolneniya = "большинство заданий";
        $spravlyalsya = "хорошо";
        $zamechaniya = "отсутствуют";
        break;
    case 'удовлетворительно':
        $payment = "нет";
        $kachestva = "удовлетворительная ответственность, пунктуальность, выполнение в срок";
        $spravlyalsya = "с трудом";
        $amount_vipolneniya = "не в полном объеме";
        $zamechaniya = "малоактивен";
        break;
    case 'неудовлетворительно':
        $payment = "нет";
        $kachestva = "низкая ответственность, непунктуальность, неполное выполнение заданий";
        $spravlyalsya = "плохо";
        $amount_vipolneniya = "неуспешно";
        $zamechaniya = "не проявлял активности, требуется значительное улучшение";
        break;
    default:
        $payment = "нет";
        $kachestva = "";
        $amount_vipolneniya = "";
        $zamechaniya = "";
        break;
}


    // Проверяем, существует ли студент с заданным id в таблице interaction
    $checkStudentQuery = $conn->prepare("SELECT COUNT(*) as count FROM interaction WHERE id_student = ?");
    $checkStudentQuery->execute([$selectedStudentId]);
    $result = $checkStudentQuery->fetch();

    if($result['count'] > 0) {
        // Если студент существует, выполняем обновление данных
        $updateInteraction = $conn->prepare("UPDATE interaction SET payment=?, spravlyalsya=?, kachestva=?, amount_vipolneniya=?, zamechaniya=?, ocenka=? WHERE id_student=?");
        $updateInteraction->execute([$payment, $spravlyalsya, $kachestva, $amount_vipolneniya, $zamechaniya, $ocenka, $selectedStudentId]);
    } else {
        // Если студент не существует, выполняем вставку новых данных
        $insertInteraction = $conn->prepare("INSERT INTO interaction (id_student, payment, spravlyalsya, kachestva, amount_vipolneniya, zamechaniya, ocenka) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertInteraction->execute([$selectedStudentId, $payment, $spravlyalsya, $kachestva, $amount_vipolneniya, $zamechaniya, $ocenka]);
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
            <!-- Оценка -->
            <div class="input-group" style="margin-bottom: 10px;">
                <label for="ocenka">Оценка:</label>
                <select id="ocenka" name="ocenka" required style="width: 100%; padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box;">
                    <option value="отлично">Отлично</option>
                    <option value="хорошо">Хорошо</option>
                    <option value="удовлетворительно">Удовлетворительно</option>
                    <option value="неудовлетворительно">Неудовлетворительно</option>
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
