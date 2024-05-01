<?php
@include 'config.php';
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Обработка выбора практики
if (isset($_POST['select_practice'])) {
    $id_practice = $_POST['practice_id'];
    $id_student = $_SESSION['user_id'];

    // Проверяем, есть ли уже запись с user_id в таблице interaction
    $checkInteraction = $conn->prepare("SELECT * FROM interaction WHERE id_student = ?");
    $checkInteraction->execute([$id_student]);
    $existingInteraction = $checkInteraction->fetch();

    if ($existingInteraction) {
        // Если запись уже существует, обновляем поле id_practic
        $updateInteraction = $conn->prepare("UPDATE interaction SET id_practic = ? WHERE id_student = ?");
        $updateInteraction->execute([$id_practice, $id_student]);
    } else {
        // Если запись не существует, добавляем новую запись в таблицу interaction
        $insertInteraction = $conn->prepare("INSERT INTO interaction (id_student, id_practic) VALUES (?, ?)");
        $insertInteraction->execute([$id_student, $id_practice]);
    }

    // Редирект пользователя после выбора практики
    header('Location: practic.php');
    exit;
}


// Запрос для получения списка практик
$selectPractices = $conn->prepare("SELECT id, name FROM practics");
$selectPractices->execute();
$practices = $selectPractices->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выбор практики</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Выберите практику:</h1>
    <form action="practic.php" method="POST">
        <select name="practice_id">
            <?php foreach ($practices as $practice): ?>
                <option value="<?= $practice['id'] ?>"><?= $practice['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="select_practice">Выбрать</button>
    </form>
</body>
</html>
