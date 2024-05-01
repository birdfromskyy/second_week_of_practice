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
<header class="header">

<div class="flex">
   <nav class="navbar">
      <a href="home.php">ГЛАВНАЯ</a>
      <a href="profile.php">ПРОФИЛЬ</a>
      <a href="practic.php">ПРАКТИКА</a>
      <a href="tasks.php">ЗАДАЧИ</a>
      <a href="logout.php">ВЫЙТИ</a>
   </nav>
</div>

</header>