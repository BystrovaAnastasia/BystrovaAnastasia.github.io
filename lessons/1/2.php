<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>
<!--ТЕОРЕТИЧЕСКАЯ ЧАСТЬ-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php
        require_once '../../vendor/connect.php';
        $check_lessons = mysqli_query($connect, "SELECT * FROM `lesson` WHERE `LessonId` = 1");
        if (mysqli_num_rows($check_lessons) > 0) {
            while ($row = mysqli_fetch_assoc($check_lessons)) {
                $temp1 = $row['LessonName'];
                $temp2 = $row['Description'];
                $less_id = $row['LessonId'];
                echo $temp1;
            }
        } else {
            $_SESSION['message'] = 'Такого урока не существует';
        }
        ?>
    </title>
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>
<body style="background-color: #c4dfe6">

<!-- Форма авторизации -->
<header style="background-color: #07575b;">
    <a href="#"><img src="../../images/default-logo.png" width="70" alt="" style="visibility: hidden"></a>
    <nav>
        <?php $_SESSION['lessonpage'] = '2.php' ?>
        <a href="forceexit.php?exit=mainpage">Главная</a>
        <a href="forceexit.php?exit=lessons">Уроки</a>
        <a href="forceexit.php?exit=profile">Личный кабинет</a>
    </nav>
</header>

<div class="user_info" style="background-color: #377e84; height: 200px">
    <div class="les_name" style="top:40%; left:210px; position: absolute; color: #c4dfe6;">
        <h1 style="font-weight: normal">
            <?php
            echo $temp1;
            ?>
        </h1>
    </div>
    <div class="les_info">
        <div class="theory">
            Неотъемлемым свойством алгоритма является его <i>результативность</i>, то есть алгоритмическая инструкция лишь тогда может быть названа алгоритмом, когда при любом сочетании исходных данных она гарантирует, что через конечное число шагов будет обязательно получен результат.
            <br><br>
            На практике получили известность два способа изображения алгоритмов:
            <br>
            - <b>в виде пошагового словесного описания;</b>
            <br>
            - <b>в виде блок-схем.</b>
            <br><br>
            Первый из этих способов получил значительно меньшее распространение из-за его многословности и отсутствия наглядности.
            <br>
            Второй, напротив, оказался очень удобным средством изображения алгоритмов и получил широкое распространение в научной и учебной литературе.
        </div>
        <div class="progress">
            <div class="fill" style="width: 112.5px">
            </div>
            <div class="all">
            </div>
            <div class="next_les">
                <a class="arrow-3" href="3.php">Далее
                    <svg class="arrow-3-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <g fill="none" stroke="#07575b" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
                            <circle class="arrow-3-iconcircle" cx="16" cy="16" r="15.12"></circle>
                            <path class="arrow-3-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
                        </g>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="footer" style="background-color: #00272e; height: 100px;">
    <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
</div>

</body>
</html>