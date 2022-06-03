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
    <div class="set_form" style="left:600px; top:120px">
        <form method="post" enctype="multipart/form-data" style="font-weight: bold; margin: 100px 115px; width: 500px;" action="vendor/addtest.php">
            <h1>Тест #<?php echo $count ?></h1>
            <br>
            <input type="text" name="question" placeholder="Введите описание вопроса">
            <input type="text" name="answerdesc" placeholder="Введите дополнительную информацию">
            <div style="flex-direction: row">
                <input type="radio" name="option" value="1"><input type="text" name="option1" placeholder="Введите первый вариант ответа" style="width: 467px; margin-left: 20px">
            </div>
            <div style="flex-direction: row">
                <input type="radio" name="option" value="2"><input type="text" name="option2" placeholder="Введите второй вариант ответа" style="width: 467px; margin-left: 20px">
            </div>
            <div style="flex-direction: row">
                <input type="radio" name="option" value="3"><input type="text" name="option3" placeholder="Введите третий вариант ответа" style="width: 467px; margin-left: 20px">
            </div>
            <div style="flex-direction: row">
                <input type="radio" name="option" value="4"><input type="text" name="option4" placeholder="Введите четвертый вариант ответа" style="width: 467px; margin-left: 20px">
            </div>
            <button type="submit" class="sub_but" style="margin-top: 10px" name="but" value="onemore">Добавить тест</button>
            <button type="submit" class="sub_but" style="margin-top: 10px" name="but" value="next">Завершить добавление урока</button>
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