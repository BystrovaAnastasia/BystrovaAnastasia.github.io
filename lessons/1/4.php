<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>
<!--ПРАКТИЧЕСКАЯ ЧАСТЬ-->
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
        <?php $_SESSION['lessonpage'] = '4.php' ?>
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
            <div style="font-size: 3ex; margin: 18px 0">Что означает свойство алгоритма "результативность"?</div>
        </div>
        <div class="progress" style="top:70px">
            <div class="fill" style="width: 337.5px">
            </div>
            <div class="all">
            </div>
        </div>
    </div>
    <hr class='hr-line' style='width: calc(100% - 420px); position: absolute; top: 350px; left: 215px; border-top: 3px solid #377e84;'>
    <div class="les_options">

        <form class="form" method="get">
            <div class="radio-container" style="display: flex">
                <table>
                    <tr>
                        <td>
                            <div class="form-item radio-btn nth-2">
                                <input type="radio" name="option1" id="radio1" value="1" onChange="this.form.submit()">
                                <label for="radio1"> Что может быть только один верный результат </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-item radio-btn nth-2">
                                <input type="radio" name="option1" id="radio2" value="2" onChange="this.form.submit()">
                                <label for="radio2"> Что результат будет получен в любом случае</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-item radio-btn nth-2">
                                <input type="radio" name="option1" id="radio3" value="3" onChange="this.form.submit()">
                                <label for="radio3"> Что результат может быть как получен, так и не получен </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-item radio-btn nth-2">
                                <input type="radio" name="option1" id="radio4" value="4" onChange="this.form.submit()">
                                <label for="radio4"> Что через конечное число шагов будет получен результат </label>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <?php

        if( isset( $_GET['option1'] ) )
        {
            switch( $_GET['option1'] )
            {
                case '1':
                case '3':
                case '2':
                    echo
                    '<div class="t_f_msg" style="border: 10px solid #bf3329;">
                        <b>Неверно</b>
                        <br>
                        Алгоритмическая инструкция лишь тогда может быть названа алгоритмом, когда при любом сочетании исходных данных она гарантирует, что через конечное число шагов будет обязательно получен результат
                        <div class="next_les">
                        <a class="arrow-3" href="results.php">Далее
                            <svg class="arrow-3-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                <g fill="none" stroke="#07575b" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
                                    <circle class="arrow-3-iconcircle" cx="16" cy="16" r="15.12"></circle>
                                    <path class="arrow-3-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
                                </g>
                            </svg>
                        </a>
                        </div>
                    </div>';
                    $point = 0;
                    break;
                case '4':
                    echo
                    '<div class="t_f_msg" style="border: 10px solid #009742;">
                        <b>Верно</b>
                        <br>
                        Алгоритмическая инструкция лишь тогда может быть названа алгоритмом, когда при любом сочетании исходных данных она гарантирует, что через конечное число шагов будет обязательно получен результат
                        <div class="next_les">
                        <a class="arrow-3" href="results.php">Далее
                            <svg class="arrow-3-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                <g fill="none" stroke="#07575b" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
                                    <circle class="arrow-3-iconcircle" cx="16" cy="16" r="15.12"></circle>
                                    <path class="arrow-3-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
                                </g>
                            </svg>
                        </a>
                        </div>
                    </div>
                    ';
                    $point = 1;
                    break;
            }
            $points = $_SESSION['point'] + $point;
            $_SESSION['point'] = $points;
            /*echo $_SESSION['point'];*/
        }
        ?>

    </div>
</div>

<div class="footer" style="background-color: #00272e; height: 100px;">
    <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
</div>

</body>
</html>