<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

$selectUser = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$selectUser->execute([$_SESSION['admin_id']]);
$user = $selectUser->fetch(PDO::FETCH_ASSOC);

$user_email = $user['email'];
$user_pass = $_SESSION['password'];

if (isset($_POST['apply_button'])) {
    $practic_id = $_POST['practic_id'];
    $groupp = $_POST['groupp'];

    // Подготовка SQL запроса для студентов с оценкой "неудовлетворительно"
    $sql = "SELECT users.name, users.surname, users.patronymic
        FROM users
        INNER JOIN interaction ON users.id = interaction.id_student
        WHERE users.groupp = :groupp AND interaction.id_practic = :practic_id AND interaction.ocenka = 'неудовлетворительно'";
    // Подготовка запроса к базе данных
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':groupp', $groupp);
    $stmt->bindParam(':practic_id', $practic_id);

    // Выполнение запроса
    $stmt->execute();

    // Получение результатов
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Создание CSV-файла для студентов с оценкой "неудовлетворительно"
    $csvFileName = 'net.csv';
    $csvFile = fopen($csvFileName, 'w');

    // Добавление BOM для кодировки UTF-8
    fwrite($csvFile, "\xEF\xBB\xBF");

    // Запись данных студентов в один столбец в CSV-файл
    foreach ($students as $student) {
        fwrite($csvFile, $student['surname'] . ' ' . $student['name'] . ' ' . $student['patronymic'] . PHP_EOL);
    }

    // Закрытие CSV-файла
    fclose($csvFile);

    // Предоставление ссылки для скачивания файла
    echo "<p><a href='{$csvFileName}' download>Скачать CSV-файл с оценками 'неудовлетворительно'</a></p>";

    // Подготовка SQL запроса для студентов с оценкой "отлично", "хорошо" или "удовлетворительно"
    $sql_oth = "SELECT users.surname, users.name, users.patronymic
        FROM users
        INNER JOIN interaction ON users.id = interaction.id_student
        WHERE users.groupp = :groupp AND interaction.id_practic = :practic_id AND interaction.ocenka IN ('отлично', 'хорошо', 'удовлетворительно')";

    // Подготовка запроса к базе данных
    $stmt = $conn->prepare($sql_oth);
    $stmt->bindParam(':groupp', $groupp);
    $stmt->bindParam(':practic_id', $practic_id);

    // Выполнение запроса
    $stmt->execute();

    // Получение результатов
    $students_oth = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Создание CSV-файла для студентов с оценкой "отлично", "хорошо" или "удовлетворительно"
    $csvFileName_oth = 'da.csv';
    $csvFile_oth = fopen($csvFileName_oth, 'w');

    // Добавление BOM для кодировки UTF-8
    fwrite($csvFile_oth, "\xEF\xBB\xBF");

    // Запись данных студентов в один столбец в CSV-файл
    foreach ($students_oth as $student) {
        fwrite($csvFile_oth, $student['surname'] . ' ' . $student['name'] . ' ' . $student['patronymic'] . PHP_EOL);
    }

    // Закрытие CSV-файла
    fclose($csvFile_oth);

    // Предоставление ссылки для скачивания файла
    echo "<p><a href='{$csvFileName_oth}' download>Скачать CSV-файл с оценками 'отлично', 'хорошо' или 'удовлетворительно'</a></p>";
    $practic_id = $_POST['practic_id'];
    $groupp = $_POST['groupp'];
    $sql = "SELECT id, vid, type, name, place_practic, address_organization, fio_director_of_company, post_director_of_company, fio_director_of_ugrasu, post_director_of_ugrasu, fio_director_of_organization, post_director_of_organization, from_date, to_date, number_of_prikaz, date 
        FROM practics 
        WHERE id = :practic_id";

    $getPracticsQuery = $conn->prepare($sql);
    $getPracticsQuery->bindParam(':practic_id', $practic_id);
    $getPracticsQuery->execute();
    $practics = $getPracticsQuery->fetchAll(PDO::FETCH_ASSOC);
    foreach ($practics as $practic) {
        $vid = $practic['vid'];
        $type = $practic['type'];
        $from_date = $practic['from_date'];
        $to_date = $practic['to_date'];
        $number_of_prikaz = $practic['number_of_prikaz'];
        $date = $practic['date'];
    }
    $course = 2;
    if ($groupp == "1521б"){
        $kod = "09.03.04";
        $direction = "Программная инженерия";
    }
    else{
        $kod = "09.03.01";
        $direction = "Информатика и вычислительная техника";
    }
    echo "<p>{$groupp}</p>";
    echo "<p>{$vid}</p>";
    echo "<p>{$type}</p>";
    echo "<p>{$from_date}</p>";
    echo "<p>{$to_date}</p>";
    echo "<p>{$number_of_prikaz}</p>";
    echo "<p>{$date}</p>";
    echo "<p>{$direction}</p>";
    echo "<p>{$kod}</p>";
}



if (isset($_POST['create_button'])) {
    if(isset($_FILES['uploaded_file_1']) && $_FILES['uploaded_file_1']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'D:\\xampp\\htdocs\\SecondProject\\AttemptsToWorkWithWord\\';
        $file_name_1 = $_FILES['uploaded_file_1']['name'];
        $file_path_1 = $upload_dir . $file_name_1;
        move_uploaded_file($_FILES['uploaded_file_1']['tmp_name'], $file_path_1);
        if(isset($_FILES['uploaded_file_2']) && $_FILES['uploaded_file_2']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'D:\\xampp\\htdocs\\SecondProject\\AttemptsToWorkWithWord\\';
            $file_name_2 = $_FILES['uploaded_file_2']['name'];
            $file_path_2 = $upload_dir . $file_name_2;
            move_uploaded_file($_FILES['uploaded_file_2']['tmp_name'], $file_path_2);
        }
    }
    $pyscript = shell_exec("D:\\Python\\python.exe D:\\xampp\\htdocs\\SecondProject\\AttemptsToWorkWithWord\\second.py $user_email $user_pass \"$file_name_1\" \"$file_name_2\"");
    echo $pyscript;
    echo '<script>';
    echo 'alert("Действие выполнено успешно!");';
    echo '</script>';
}

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
<?php include 'admin_header.php'; ?>
    <div class="profile-container">
        <div class="section">
            <h3>Практики</h3>
            <?php
            ?>
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
                        echo "<option value='" . $practic['id'] . "'>" . $practic['id'] . " - " . $practic['name'] . "</option>";
                    }
                    ?>
                </select>
                <select name="groupp" id="groupp">
                    <option value="1521б">1521б</option>
                    <option value="1121б">1121б</option>
                </select>
                <input type="submit" name="apply_button" value="Применить" class="btn">
            </form>
            <form method="POST" enctype="multipart/form-data">
                <label>НЕ ПРОШЛИ</label>
                <input type="file" name="uploaded_file_1">
                <p>
                <label>ПРОШЛИ</label>
                <input type="file" name="uploaded_file_2">
                <p>
                <button type="submit" name="create_button">Создать документ</button>
                <a href="output.docx" download="" class="download-link">Скачать документ</a>
            </form>
        </div>
    </div>
</body>
</html>
