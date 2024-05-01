<?php

@include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];




if(!isset($user_id)){
 header('location:login.php');
};
$user_id = $_SESSION['user_id'];
$checkTasks = $conn->prepare("SELECT * FROM tasks WHERE id_student = ?");
$checkTasks->execute([$user_id]);
$existingTasks = $checkTasks->fetch();
if (isset($_POST['save_tasks'])) {
    
    $user_id = $_SESSION['user_id'];
    $checkTasks = $conn->prepare("SELECT * FROM tasks WHERE id_student = ?");
    $checkTasks->execute([$user_id]);
    $existingTasks = $checkTasks->fetch();
    $task_name_1 = $_POST['task1'];
    $task_date_1 = $_POST['date1'];
    $task_name_2 = $_POST['task2'];
    $task_date_2 = $_POST['date2'];
    $task_name_3 = $_POST['task3'];
    $task_date_3 = $_POST['date3'];
    $task_name_4 = $_POST['task4'];
    $task_date_4 = $_POST['date4'];
    $task_name_5 = $_POST['task5'];
    $task_date_5 = $_POST['date5'];
    $task_name_6 = $_POST['task6'];
    $task_date_6 = $_POST['date6'];
    $task_name_7 = $_POST['task7'];
    $task_date_7 = $_POST['date7'];
    $task_name_8 = $_POST['task8'];
    $task_date_8 = $_POST['date8'];
    $task_name_9 = $_POST['task9'];
    $task_date_9 = $_POST['date9'];
    $task_name_10 = $_POST['task10'];
    $task_date_10 = $_POST['date10'];
    $task_name_11 = $_POST['task11'];
    $task_date_11 = $_POST['date11'];
    $task_name_12 = $_POST['task12'];
    $task_date_12 = $_POST['date12'];
    $task_name_13 = $_POST['task13'];
    $task_date_13 = $_POST['date13'];
    $task_name_14 = $_POST['task14'];
    $task_date_14 = $_POST['date14'];
    $task_name_15 = $_POST['task15'];
    $task_date_15 = $_POST['date15'];
    $task_name_16 = $_POST['task16'];
    $task_date_16 = $_POST['date16'];
    $task_name_17 = $_POST['task17'];
    $task_date_17 = $_POST['date17'];
    $task_name_18 = $_POST['task18'];
    $task_date_18 = $_POST['date18'];
    $task_name_19 = $_POST['task19'];
    $task_date_19 = $_POST['date19'];
    $task_name_20 = $_POST['task20'];
    $task_date_20 = $_POST['date20'];
    $task_name_21 = $_POST['task21'];
    $task_date_21 = $_POST['date21'];

    if ($existingTasks) {
        $updateTasks = $conn->prepare("UPDATE tasks SET task_name_1 = ?, task_date_1 = ?, task_name_2 = ?, task_date_2 = ?, task_name_3 = ?, task_date_3 = ?, task_name_4 = ?, task_date_4 = ?, task_name_5 = ?, task_date_5 = ?, task_name_6 = ?, task_date_6 = ?, task_name_7 = ?, task_date_7 = ?, task_name_8 = ?, task_date_8 = ?, task_name_9 = ?, task_date_9 = ?, task_name_10 = ?, task_date_10 = ?, task_name_11 = ?, task_date_11 = ?, task_name_12 = ?, task_date_12 = ?, task_name_13 = ?, task_date_13 = ?, task_name_14 = ?, task_date_14 = ?, task_name_15 = ?, task_date_15 = ?, task_name_16 = ?, task_date_16 = ?, task_name_17 = ?, task_date_17 = ?, task_name_18 = ?, task_date_18 = ?, task_name_19 = ?, task_date_19 = ?, task_name_20 = ?, task_date_20 = ?, task_name_21 = ?, task_date_21 = ? WHERE id_student = ?");
        $updateTasks->execute([$task_name_1, $task_date_1, $task_name_2, $task_date_2, $task_name_3, $task_date_3, $task_name_4, $task_date_4, $task_name_5, $task_date_5, $task_name_6, $task_date_6, $task_name_7, $task_date_7, $task_name_8, $task_date_8, $task_name_9, $task_date_9, $task_name_10, $task_date_10, $task_name_11, $task_date_11, $task_name_12, $task_date_12, $task_name_13, $task_date_13, $task_name_14, $task_date_14, $task_name_15, $task_date_15, $task_name_16, $task_date_16, $task_name_17, $task_date_17, $task_name_18, $task_date_18, $task_name_19, $task_date_19, $task_name_20, $task_date_20, $task_name_21, $task_date_21, $user_id]);
    } else {
        $insertTasks = $conn->prepare("INSERT INTO tasks (id_student, task_name_1, task_date_1 ,task_name_2, task_date_2 ,task_name_3, task_date_3 ,task_name_4, task_date_4 ,task_name_5, task_date_5 ,task_name_6, task_date_6 ,task_name_7, task_date_7 ,task_name_8, task_date_8 ,task_name_9, task_date_9 ,task_name_10, task_date_10 ,task_name_11, task_date_11 ,task_name_12, task_date_12 ,task_name_13, task_date_13 ,task_name_14, task_date_14 ,task_name_15, task_date_15 ,task_name_16, task_date_16 ,task_name_17, task_date_17 ,task_name_18, task_date_18 ,task_name_19, task_date_19 ,task_name_20, task_date_20 ,task_name_21, task_date_21) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertTasks->execute([$user_id, $task_name_1, $task_date_1, $task_name_2, $task_date_2, $task_name_3, $task_date_3, $task_name_4, $task_date_4, $task_name_5, $task_date_5, $task_name_6, $task_date_6, $task_name_7, $task_date_7, $task_name_8, $task_date_8, $task_name_9, $task_date_9, $task_name_10, $task_date_10, $task_name_11, $task_date_11, $task_name_12, $task_date_12, $task_name_13, $task_date_13, $task_name_14, $task_date_14, $task_name_15, $task_date_15, $task_name_16, $task_date_16, $task_name_17, $task_date_17, $task_name_18, $task_date_18, $task_name_19, $task_date_19, $task_name_20, $task_date_20, $task_name_21, $task_date_21]);
    }

    header('Location: tasks.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Задачи</title>
   <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .task {
            margin-bottom: 20px;
        }
        .task input[type="text"] {
            width: 200px;
            margin-right: 10px;
        }
        .task label {
            margin-right: 10px;
        }
    </style>
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <?php include 'header.php'; ?>
    <form method="POST">
        <div class="profile-container">
            <div class="section">
                <div class="task">
                    <label for="task1">Задача 1:</label>
                    <input type="text" id="task1" name="task1" value="<?= $existingTasks['task_name_1'] ?>">
                    <label for="date1">Дата:</label>
                    <input type="date" id="date1" name="date1" value="<?= $existingTasks['task_date_1'] ?>">
                </div>
                <div class="task">
                    <label for="task2">Задача 2:</label>
                    <input type="text" id="task2" name="task2" value="<?= $existingTasks['task_name_2'] ?>">
                    <label for="date2">Дата:</label>
                    <input type="date" id="date2" name="date2" value="<?= $existingTasks['task_date_2'] ?>">
                </div>
                <div class="task">
                    <label for="task3">Задача 3:</label>
                    <input type="text" id="task3" name="task3" value="<?= $existingTasks['task_name_3'] ?>">
                    <label for="date3">Дата:</label>
                    <input type="date" id="date3" name="date3" value="<?= $existingTasks['task_date_3'] ?>">
                </div>
                <div class="task">
                    <label for="task4">Задача 4:</label>
                    <input type="text" id="task4" name="task4" value="<?= $existingTasks['task_name_4'] ?>">
                    <label for="date4">Дата:</label>
                    <input type="date" id="date4" name="date4" value="<?= $existingTasks['task_date_4'] ?>">
                </div>
                <div class="task">
                    <label for="task5">Задача 5:</label>
                    <input type="text" id="task5" name="task5" value="<?= $existingTasks['task_name_5'] ?>">
                    <label for="date5">Дата:</label>
                    <input type="date" id="date5" name="date5" value="<?= $existingTasks['task_date_5'] ?>">
                </div>
                <div class="task">
                    <label for="task6">Задача 6:</label>
                    <input type="text" id="task6" name="task6" value="<?= $existingTasks['task_name_6'] ?>">
                    <label for="date6">Дата:</label>
                    <input type="date" id="date6" name="date6" value="<?= $existingTasks['task_date_6'] ?>">
                </div>
                <div class="task">
                    <label for="task7">Задача 7:</label>
                    <input type="text" id="task7" name="task7" value="<?= $existingTasks['task_name_7'] ?>">
                    <label for="date7">Дата:</label>
                    <input type="date" id="date7" name="date7" value="<?= $existingTasks['task_date_7'] ?>">
                </div>
                <div class="task">
                    <label for="task8">Задача 8:</label>
                    <input type="text" id="task8" name="task8" value="<?= $existingTasks['task_name_8'] ?>">
                    <label for="date8">Дата:</label>
                    <input type="date" id="date8" name="date8" value="<?= $existingTasks['task_date_8'] ?>">
                </div>
                <div class="task">
                    <label for="task9">Задача 9:</label>
                    <input type="text" id="task9" name="task9" value="<?= $existingTasks['task_name_9'] ?>">
                    <label for="date9">Дата:</label>
                    <input type="date" id="date9" name="date9" value="<?= $existingTasks['task_date_9'] ?>">
                </div>
                <div class="task">
                    <label for="task10">Задача 10:</label>
                    <input type="text" id="task10" name="task10" value="<?= $existingTasks['task_name_10'] ?>">
                    <label for="date10">Дата:</label>
                    <input type="date" id="date10" name="date10" value="<?= $existingTasks['task_date_10'] ?>">
                </div>
                <div class="task">
                    <label for="task11">Задача 11:</label>
                    <input type="text" id="task11" name="task11" value="<?= $existingTasks['task_name_11'] ?>">
                    <label for="date11">Дата:</label>
                    <input type="date" id="date11" name="date11" value="<?= $existingTasks['task_date_11'] ?>">
                </div>
                <div class="task">
                    <label for="task12">Задача 12:</label>
                    <input type="text" id="task12" name="task12" value="<?= $existingTasks['task_name_12'] ?>">
                    <label for="date12">Дата:</label>
                    <input type="date" id="date12" name="date12" value="<?= $existingTasks['task_date_12'] ?>">
                </div>
                <div class="task">
                    <label for="task13">Задача 13:</label>
                    <input type="text" id="task13" name="task13" value="<?= $existingTasks['task_name_13'] ?>">
                    <label for="date13">Дата:</label>
                    <input type="date" id="date13" name="date13" value="<?= $existingTasks['task_date_13'] ?>">
                </div>
                <div class="task">
                    <label for="task14">Задача 14:</label>
                    <input type="text" id="task14" name="task14" value="<?= $existingTasks['task_name_14'] ?>">
                    <label for="date14">Дата:</label>
                    <input type="date" id="date14" name="date14" value="<?= $existingTasks['task_date_14'] ?>">
                </div>
                <div class="task">
                    <label for="task15">Задача 15:</label>
                    <input type="text" id="task15" name="task15" value="<?= $existingTasks['task_name_15'] ?>">
                    <label for="date15">Дата:</label>
                    <input type="date" id="date15" name="date15" value="<?= $existingTasks['task_date_15'] ?>">
                </div>
                <div class="task">
                    <label for="task16">Задача 16:</label>
                    <input type="text" id="task16" name="task16" value="<?= $existingTasks['task_name_16'] ?>">
                    <label for="date16">Дата:</label>
                    <input type="date" id="date16" name="date16" value="<?= $existingTasks['task_date_16'] ?>">
                </div>
                <div class="task">
                    <label for="task17">Задача 17:</label>
                    <input type="text" id="task17" name="task17" value="<?= $existingTasks['task_name_17'] ?>">
                    <label for="date17">Дата:</label>
                    <input type="date" id="date17" name="date17" value="<?= $existingTasks['task_date_17'] ?>">
                </div>
                <div class="task">
                    <label for="task18">Задача 18:</label>
                    <input type="text" id="task18" name="task18" value="<?= $existingTasks['task_name_18'] ?>">
                    <label for="date18">Дата:</label>
                    <input type="date" id="date18" name="date18" value="<?= $existingTasks['task_date_18'] ?>">
                </div>
                <div class="task">
                    <label for="task19">Задача 19:</label>
                    <input type="text" id="task19" name="task19" value="<?= $existingTasks['task_name_19'] ?>">
                    <label for="date19">Дата:</label>
                    <input type="date" id="date19" name="date19" value="<?= $existingTasks['task_date_19'] ?>">
                </div>
                <div class="task">
                    <label for="task20">Задача 20:</label>
                    <input type="text" id="task20" name="task20" value="<?= $existingTasks['task_name_20'] ?>">
                    <label for="date20">Дата:</label>
                    <input type="date" id="date20" name="date20" value="<?= $existingTasks['task_date_20'] ?>">
                </div>
                <div class="task">
                    <label for="task21">Задача 21:</label>
                    <input type="text" id="task21" name="task21" value="<?= $existingTasks['task_name_21'] ?>">
                    <label for="date21">Дата:</label>
                    <input type="date" id="date21" name="date21" value="<?= $existingTasks['task_date_21'] ?>">
                </div>
                <input type="submit" name="save_tasks" value="Сохранить" class="btn">
                
            </div>
        </div>
    </form>
</body>
</html>