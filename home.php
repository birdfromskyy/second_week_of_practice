<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
 header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Главная</title>

   <link rel="stylesheet" href="style.css">
</head>
<body>
   <?php include 'header.php'; ?>
   <?php
        
        $selectUser = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
        $selectUser->execute([$_SESSION['user_id']]);
        $user = $selectUser->fetch(PDO::FETCH_ASSOC);
        
        $selectInteraction = $conn->prepare("SELECT * FROM `interaction` WHERE id_student = ?");
        $selectInteraction->execute([$_SESSION['user_id']]);
        $interaction = $selectInteraction->fetch(PDO::FETCH_ASSOC);

        $id_practic = $interaction['id_practic'];

        $user_email = $user['email'];
        $user_pass = $_SESSION['password'];
        
        $selectPractice = $conn->prepare("SELECT * FROM `practics` WHERE id = ?");
        $selectPractice->execute([$id_practic]);
        $practice = $selectPractice->fetch(PDO::FETCH_ASSOC);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_document'])) {
            // Проверяем, загружен ли файл
            if(isset($_FILES['uploaded_file']) && $_FILES['uploaded_file']['error'] === UPLOAD_ERR_OK) {
                // Перемещаем загруженный файл в указанную папку
                $upload_dir = 'D:\\xampp\\htdocs\\SecondProject\\AttemptsToWorkWithWord\\';
                $file_name = $_FILES['uploaded_file']['name'];
                $file_path = $upload_dir . $file_name;
                move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path);
                
                // Запускаем скрипт после перемещения файла
                // Передаем email, пароль и имя файла в качестве аргументов
                $pyscript = shell_exec("D:\\Python\\python.exe D:\\xampp\\htdocs\\SecondProject\\AttemptsToWorkWithWord\\AttemptsToWorkWithWord.py $user_email $user_pass \"$file_name\"");
                
                // Выводим результат выполнения скрипта
                echo $pyscript;
                echo '<script>';
                echo 'alert("Действие выполнено успешно!");';
                echo '</script>';
            } else {
                // Если файл не был загружен или возникла ошибка при загрузке, выводим сообщение об ошибке
                echo '<script>';
                echo 'alert("Произошла ошибка при загрузке файла!");';
                echo '</script>';
            }
        }
        
   ?>
   <div class="profile-container">
      <div class="section">
         <h3>Личные данные</h3>
         <div class="input-group">
               <label>Email:</label>
               <span><?= $user['email'] ?></span>
         </div>
         <div class="input-group">
               <label>Курс:</label>
               <span><?= $user['course'] ?></span>
         </div>
         <div class="input-group">
               <label>Группа:</label>
               <span><?= $user['groupp'] ?></span>
         </div>
         <div class="input-group">
               <label>Имя:</label>
               <span><?= $user['name'] ?></span>
         </div>
         <div class="input-group">
               <label>Фамилия:</label>
               <span><?= $user['surname'] ?></span>
         </div>
         <div class="input-group">
               <label>Отчество:</label>
               <span><?= $user['patronymic'] ?></span>
         </div>
         <div class="input-group">
               <label>Институт:</label>
               <span><?= $user['institute'] ?></span>
         </div>
         <div class="input-group">
               <label>Направление:</label>
               <span><?= $user['direction'] ?></span>
         </div>


        
        <!-- Отображение данных о взаимодействии -->
        <h3>Данные о взаимодействии</h3>
        <div class="input-group">
            <label>Оплачиваемая ли практика:</label>
            <span><?= $interaction['payment'] ?></span>
        </div>
        <div class="input-group">
            <label>Как справился:</label>
            <span><?= $interaction['spravlyalsya'] ?></span>
        </div>
        <div class="input-group">
            <label>Качества:</label>
            <span><?= $interaction['kachestva'] ?></span>
        </div>
        <div class="input-group">
            <label>Объём выполнения:</label>
            <span><?= $interaction['amount_vipolneniya'] ?></span>
        </div>
        <div class="input-group">
            <label>Замечания:</label>
            <span><?= $interaction['zamechaniya'] ?></span>
        </div>
        <div class="input-group">
            <label>Оценка:</label>
            <span><?= $interaction['ocenka'] ?></span>
        </div>
        <h3>Данные о практике</h3>
        <div class="input-group">
            <label>Вид практики:</label>
            <span><?= $practice['vid'] ?></span>
        </div>
        <div class="input-group">
            <label>Тип практики:</label>
            <span><?= $practice['type'] ?></span>
        </div>
        <div class="input-group">
            <label>Наименование практики:</label>
            <span><?= $practice['name'] ?></span>
        </div>
        <div class="input-group">
            <label>Место практики:</label>
            <span><?= $practice['place_practic'] ?></span>
        </div>
        <div class="input-group">
            <label>Адрес организации:</label>
            <span><?= $practice['address_organization'] ?></span>
        </div>
        <div class="input-group">
            <label>ФИО руководителя от предприятия:</label>
            <span><?= $practice['fio_director_of_company'] ?></span>
        </div>
        <div class="input-group">
            <label>Должность руководителя от предприятия:</label>
            <span><?= $practice['post_director_of_company'] ?></span>
        </div>
        <div class="input-group">
            <label>ФИО руководителя от ЮГУ:</label>
            <span><?= $practice['fio_director_of_ugrasu'] ?></span>
        </div>
        <div class="input-group">
            <label>Должность руководителя от ЮГУ:</label>
            <span><?= $practice['post_director_of_ugrasu'] ?></span>
        </div>
        <div class="input-group">
            <label>ФИО руководителя от организации:</label>
            <span><?= $practice['fio_director_of_organization'] ?></span>
        </div>
        <div class="input-group">
            <label>Должность руководителя от организации:</label>
            <span><?= $practice['post_director_of_organization'] ?></span>
        </div>
        <div class="input-group">
            <label>С:</label>
            <span><?= $practice['from_date'] ?></span>
        </div>
        <div class="input-group">
            <label>До:</label>
            <span><?= $practice['to_date'] ?></span>
        </div>
        <div class="input-group">
            <label>Номер приказа:</label>
            <span><?= $practice['number_of_prikaz'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата приказа:</label>
            <span><?= $practice['date'] ?></span>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="uploaded_file">
            <button type="submit" name="create_document">Создать документ</button>
            <a href="output.docx" download="" class="download-link">Скачать документ</a>
        </form>
</body>
</html>