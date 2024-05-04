<?php

include 'config.php';

session_start();

// Проверяем, активна ли сессия
if(isset($_SESSION['user_id'])){
    header('location:home.php');
    exit(); // Останавливаем выполнение скрипта
}

$message = array(); // Создаем массив для сообщений

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $_SESSION['password'] = $_POST['pass'];
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $sql = "SELECT * FROM `users` WHERE email = ? AND pass = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($row['type_account'] == 'user'){
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }
   elseif ($row['type_account'] == 'admin'){
      $_SESSION['admin_id'] = $row['id'];
      header('location:main.php');
   }
   else{
         $message[] = 'Пользователь не найден!';
      }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php

if(!empty($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
   
<section class="form-container">

   <form action="" method="POST">
      <h3>Авторизация</h3>
      <input type="email" name="email" class="box" placeholder="Введите ваш email" required>
      <input type="password" name="pass" class="box" placeholder="Введите ваш пароль" required>
      <input type="submit" value="Войти" class="btn" name="submit">
      <p>У вас нет аккаунта? <a href="register.php">Зарегистрироваться</a></p>
   </form>

</section>


</body>
</html>