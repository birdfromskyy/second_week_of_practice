<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_POST['save_practice'])){
    $id = $_POST['practic_id']; // Получение реального идентификатора

    // Обработка и сохранение данных из формы
    $vid = $_POST['vid'];
    $type = $_POST['type'];
    $name = $_POST['name'];
    $place_practic = $_POST['place_practic'];
    $address_organization = $_POST['address_organization'];
    $fio_director_of_company = $_POST['fio_director_of_company'];
    $post_director_of_company = $_POST['post_director_of_company'];
    $fio_director_of_ugrasu = $_POST['fio_director_of_ugrasu'];
    $post_director_of_ugrasu = $_POST['post_director_of_ugrasu'];
    $fio_director_of_organization = $_POST['fio_director_of_organization'];
    $post_director_of_organization = $_POST['post_director_of_organization'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $number_of_prikaz = $_POST['number_of_prikaz'];
    $date = $_POST['date'];

    // Подготовка запроса на обновление данных о практике в базе данных
    $updatePractice = $conn->prepare("UPDATE `practics` SET vid=?, type=?, name=?, place_practic=?, address_organization=?, fio_director_of_company=?, post_director_of_company=?,fio_director_of_ugrasu=?, post_director_of_ugrasu=?, fio_director_of_organization=?, post_director_of_organization=?, from_date=?, to_date=?, number_of_prikaz=?, date=? WHERE id=?");

    // Обновление данных о практике в базе данных
    $updatePractice->execute([$vid, $type, $name, $place_practic, $address_organization, $fio_director_of_company, $post_director_of_company, $fio_director_of_ugrasu, $post_director_of_ugrasu, $fio_director_of_organization, $post_director_of_organization, $from_date, $to_date, $number_of_prikaz, $date, $id]);
    header('location:practics.php');
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практики</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="profile-container">
        <div class="section">
        <h3>Практики</h3>
            <form method="post">
            <label for="practic_id">Выберите практику:</label>
            <select name="practic_id" id="practic_id">
            <?php
            // Запрос к базе данных для получения списка практик
            $getPracticsQuery = $conn->prepare("SELECT id, vid, type, name, place_practic, address_organization, fio_director_of_company, post_director_of_company, fio_director_of_ugrasu, post_director_of_ugrasu, fio_director_of_organization, post_director_of_organization, from_date, to_date, number_of_prikaz, date FROM practics");
            $getPracticsQuery->execute();
            $practics = $getPracticsQuery->fetchAll();

            // Вывод списка практик
            foreach ($practics as $practic) {
                echo "<option value='" . $practic['id'] . "_" . $practic['id'] . "'>" . $practic['id'] . " - " . $practic['name'] . "</option>";
            }
            ?>

            </select>
            <div class="input-group">
                <label for="vid">Вид практики:</label>
                <select name="vid" id="vid" required>
                    <option value="учебная">учебная</option>
                    <option value="производственная">производственная</option>
                </select>
            </div>
            <div class="input-group">
                <label for="type">Тип практики:</label>
                <input type="text" id="type" name="type" value="" placeholder="Введите тип практики" required>
            </div>
            <div class="input-group">
                <label for="name">Название организации:</label>
                <input type="text" id="name" name="name" value="" placeholder="Введите название организации" required>
            </div>
            <div class="input-group">
                <label for="place_practic">Место практики:</label>
                <input type="text" id="place_practic" name="place_practic" value="" placeholder="Введите место практики" required>
            </div>
            <div class="input-group">
                <label for="address_organization">Адрес организации:</label>
                <input type="text" id="address_organization" name="address_organization" value="" placeholder="Введите адрес организации" required>
            </div>
            <div class="input-group">
                <label for="fio_director_of_company">ФИО руководителя от Предприятия:</label>
                <input type="text" id="fio_director_of_company" name="fio_director_of_company" value="" placeholder="Введите ФИО руководителя от Предприятия" required>
            </div>
            <div class="input-group">
                <label for="post_director_of_company">Должность руководителя от Предприятия:</label>
                <input type="text" id="post_director_of_company" name="post_director_of_company" value="" placeholder="Введите должность руководителя от Предприятия" required>
            </div>
            <div class="input-group">
                <label for="fio_director_of_ugrasu">ФИО руководителя от ЮГУ:</label>
                <input type="text" id="fio_director_of_ugrasu" name="fio_director_of_ugrasu" value="" placeholder="Введите ФИО руководителя от ЮГУ" required>
            </div>
            <div class="input-group">
                <label for="post_director_of_ugrasu">Должность руководителя от ЮГУ:</label>
                <input type="text" id="post_director_of_ugrasu" name="post_director_of_ugrasu" value="" placeholder="Введите должность руководителя от ЮГУ" required>
            </div>
            <div class="input-group">
                <label for="fio_director_of_organization">ФИО руководителя от организации:</label>
                <input type="text" id="fio_director_of_organization" name="fio_director_of_organization" value="" placeholder="Введите ФИО руководителя от организации" required>
            </div>
            <div class="input-group">
                <label for="post_director_of_organization">Должность руководителя от организации:</label>
                <input type="text" id="post_director_of_organization" name="post_director_of_organization" value="" placeholder="Введите должность руководителя от организации" required>
            </div>
            <div class="input-group">
                <label for="from_date">С:</label>
                <input type="date" id="from_date" name="from_date" value="" required>
            </div>
            <div class="input-group">
                <label for="to_date">До:</label>
                <input type="date" id="to_date" name="to_date" value="" required>
            </div>
            <div class="input-group">
                <label for="number_of_prikaz">Номер приказа:</label>
                <input type="text" id="number_of_prikaz" name="number_of_prikaz" value="" placeholder="Введите номер приказа" required>
            </div>
            <div class="input-group">
                <label for="date">Дата приказа:</label>
                <input type="date" id="date" name="date" value="" required>
            </div>
            <input type="submit" name="save_practice" value="Сохранить" class="btn">
        </div>
    </div>
</body>
</html>