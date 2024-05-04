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
        <a href="main.php">ГЛАВНАЯ</a>
        <a href="add_student.php">ДОБАВИТЬ СТУДЕНТА</a>
        <a href="students.php">ОЦЕНИТЬ СТУДЕНТА</a>
        <a href="add_practic.php">ДОБАВИТЬ ПРАКТИКУ</a>
        <a href="practics.php">ПРАКТИКИ</a>
        <a href="logout.php">ВЫЙТИ</a>
    </nav>
</div>

</header>