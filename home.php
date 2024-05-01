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

      $selectTasks = $conn->prepare("SELECT * FROM `tasks` WHERE id_student = ?");
      $selectTasks->execute([$_SESSION['user_id']]);
      $tasks = $selectTasks->fetch(PDO::FETCH_ASSOC);

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  $pyscript = shell_exec("D:\\Python\\python.exe D:\\xampp\\htdocs\\SecondProject\\AttemptsToWorkWithWord\\AttemptsToWorkWithWord.py $user_email $user_pass");
                  echo $pyscript;
                  echo '<script>';
                  echo 'alert("Действие выполнено успешно!");';
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
        <h3>Задачи</h3>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_1'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_1'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_2'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_2'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_3'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_3'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_4'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_4'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_5'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_5'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_6'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_6'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_7'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_7'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_8'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_8'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_9'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_9'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_10'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_10'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_11'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_11'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_12'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_12'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_13'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_13'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_14'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_14'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_15'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_15'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_16'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_16'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_17'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_17'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_18'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_18'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_19'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_19'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_20'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_20'] ?></span>
        </div>
        <div class="input-group">
            <label>Задача:</label>
            <span><?= $tasks['task_name_21'] ?></span>
        </div>
        <div class="input-group">
            <label>Дата:</label>
            <span><?= $tasks['task_date_21'] ?></span>
        </div>
        <form method="POST">
            <button type="submit">Создать документ</button>
            <a href="output.docx" download="" class="download-link">
                  Скачать документ
            </a>
        </form>
</body>
</html>