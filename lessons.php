<?php
require_once 'vendor/connect.php';
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
if (isset($_GET['lesend'])){
    $user_id = $_SESSION['user']['id'];
    $less_id = $_SESSION['lesson'];
    /*mysqli_query($connect, "DELETE FROM `session` WHERE `LessonId` = $less_id AND `UserId` = $user_id AND `Status` = 'Started'");*/
    $date = date("y-m-d H:i:s");
    $a = mysqli_query($connect, "UPDATE `session` SET `FinishTime` = '$date', `Points` = 0, `Status` = 'Terminated' WHERE `LessonId` = $less_id AND `UserId` = $user_id and `Status` = 'Started'");

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Уроки</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body style="background-color: #c4dfe6">

<!-- Форма авторизации -->
<header style="background-color: #07575b;">
    <a href="#"><img src="images/default-logo.png" width="70px" alt="" style="visibility: hidden"></a>
    <nav>
        <a href="mainpage.php">Главная</a>
        <a style="color: #c4dfe6;">Уроки</a>
        <a href="profile.php">Личный кабинет</a>
    </nav>
</header>
<div class="element" style="overflow-y: scroll; height: 775px">
    <div class="settings_style">
        <div class="lk_lesson" >
            <!--<div class="urok">
                <h2>Пройденные темы</h2>
            </div>-->
            <?php
            require_once 'vendor/connect.php';
            $check_lessons = mysqli_query($connect, "SELECT * FROM `lesson`");
            if (mysqli_num_rows($check_lessons) > 0) {
                while ($row = mysqli_fetch_assoc($check_lessons)) {
                        $temp1 = $row['LessonName'];
                        $temp2 = $row['Description'];
                        $less_id = $row['LessonId'];
                        echo "
                            <div class='but_class'>
                                <div class='lesson_list' style='left: 625px; height: 140px;'>
                                    <h2 style='font-size: 1.8em'>$temp1</h2>
                                    <hr class='hr-line' style='width: 593px; position: absolute; top: 35px; left: 13px; color: #94c9d0'>
                                    <h3>$temp2</h3>
                                    <a href='lessons/index.php?lesid=$less_id'><span style='position:absolute; width:100%; height:100%; top:0; left: 0; z-index: 1;'></span></a>
                                </div>
                            </div>";
                }
                echo "<div class='but_class'><div class='lesson_list' style='left: 625px; height: 20px;visibility: hidden'></div></div>";
            }
            ?>
            <!--<div class="but_class">
                <div class="lesson_list">
                    <h2>Введение в алгоритмизацию программирования</h2>
                </div>
                <div class="l_button">
                    <button type="submit" class="lesson_button">Продолжить урок</button>
                    <button type="submit" class="lesson_button">Начать заново</button>
                </div>
            </div>-->
        </div>
    </div>
</div>
<!--<div class="sign" style="background-color: #377e84">
    <form style="color: #c4dfe6; font-weight: bold;">
        <h2 style="margin: 10px 0;"><?/*= $_SESSION['user']['full_name'] */?></h2>
        <a href="#"><?/*= $_SESSION['user']['email'] */?></a>
        <a href="vendor/logout.php" class="logout">Выход</a>
    </form>
</div>-->


<div class="footer" style="background-color: #00272e; height: 100px;">
    <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
</div>

</body>
</html>