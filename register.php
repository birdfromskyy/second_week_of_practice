<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'E-mail уже занят!';
   }else{
      if($pass != $cpass){
         $message[] = 'Пароли не совпадают!';
      }else{
         $insert = $conn->prepare("INSERT INTO `users`(email, pass, course, groupp, surname, name, patronymic, institute, direction) VALUES(?,?,?,?,?,?,?,?,?)");
         $insert->execute([$email, $pass, NULL, NULL, NULL, $name, NULL, NULL, NULL]);

         if($insert){
            $message[] = 'Вы зарегистрированы!';
            header('location:login.php');
         }
      }

   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php

if(isset($message)){
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

   <form action="" enctype="multipart/form-data" method="POST">
      <h3>Регистрация</h3>
      <input type="text" name="name" class="box" placeholder="Введите ваше имя" required>
      <input type="email" name="email" class="box" placeholder="Введите ваш email" required>
      <input type="password" name="pass" class="box" placeholder="Придумайте пароль" required>
      <input type="password" name="cpass" class="box" placeholder="Подтвердите пароль" required>
      <input type="submit" value="Зарегистрироваться" class="btn" name="submit">
      <p>У вас есть аккаунт? <a href="login.php">Авторизация</a></p>
   </form>

</section>


</body>
</html>