<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
$_SESSION['count'] = 0;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавление урока</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body style="background-color: #c4dfe6">

<!-- Форма авторизации -->
<header style="background-color: #07575b;">
    <a href="#"><img src="../images/default-logo.png" width="70px" alt="" style="visibility: hidden"></a>
    <nav>
        <a href="../mainpage.php">Главная</a>
        <a href="../lessons.php">Уроки</a>
        <a href="../profile.php">Личный кабинет</a>
    </nav>
</header>

<div class="settings_style" >
    <div class="set_form" style="left:600px; top:230px">
        <form method="post" enctype="multipart/form-data" action="vendor/addlesson.php" style="font-weight: bold; margin: 100px 115px; width: 500px;">
            <label>Название урока</label>
            <input type="text" name="name" placeholder="Введите название урока">
            <label>Описание</label>
            <textarea name="description" placeholder="Введите описание урока"></textarea>
            <button type="submit" class="sub_but" style="margin-top: 10px">Перейти к добавлению теории</button>
            <?php
            if ($_SESSION['message']) {
                echo "<p class='msg''>";
                echo $_SESSION['message'];
                echo "</p>";
            }
            unset($_SESSION['message']);
            ?>
        </form>
    </div>
</div>


<div class="footer" style="background-color: #00272e; height: 100px;">
    <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
</div>

</body>
</html>