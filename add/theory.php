<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
$count = $_SESSION['count'] + 1;
$_SESSION['count'] = $count;
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
    <div class="set_form" style="left:600px; top:200px">
        <form method="post" enctype="multipart/form-data" action="vendor/addtheory.php" style="font-weight: bold; margin: 100px 115px; width: 500px;">
            <h1>Теория #<?php echo $count ?></h1>
            <br>
            <textarea name="theory" placeholder="Введите теоретическую часть урока"></textarea>
            <button type="submit" class="sub_but" style="margin-top: 10px" name="but" value="onemore">Добавить теорию</button>
            <button type="submit" class="sub_but" style="margin-top: 10px" name="but" value="next">Перейти к добавлению тестов</button>
            <?php
            if ($_SESSION['message']) {
                echo "<p class='msg'>";
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