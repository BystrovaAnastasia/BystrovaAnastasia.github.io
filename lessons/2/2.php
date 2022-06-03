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
        $check_lessons = mysqli_query($connect, "SELECT * FROM `lesson` WHERE `LessonId` = 2");
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
        <?php $_SESSION['lessonpage'] = '1.php' ?>
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
            <?php
            $date = date("y-m-d H:i:s");
            $user_id = $_SESSION['user']['id'];
            $check_page_update = mysqli_query($connect, "SELECT * FROM `session` WHERE `UserId` = $user_id AND `LessonId` = $less_id AND `Status` = 'Started'");
            if (mysqli_num_rows($check_page_update) == 0) {
                $test = mysqli_query($connect, "INSERT INTO `session` (`SessionId`,`StartTime`,`Status`,`LessonId`,`UserId`) VALUES (NULL, '$date', 'Started', $less_id, $user_id)");
            }
            ?>
        </h1>
    </div>
    <div class="les_info">
        <div class="theory">
            <div style="position: relative; font-size: 1.7ex; display: flex; flex-direction: row">
                <img src="images/preprocess.jpg" style="border-radius: 20px">
                <div style="position: relative; left: 15px; top:25px">
                    <b>- Подготовка данных </b>
                </div>
            </div>
            <div style="position: relative; font-size: 1.7ex; top: 30px">
                Символ «подготовка данных» в произвольной форме (в ГОСТ нет ни пояснений, ни примеров), задает входные значения.
                <br>
                <br>
                Используется обычно для задания циклов со счетчиком.
            </div>
            <div style="position: relative; font-size: 1.7ex; display: flex; flex-direction: row; top:50px">
                <img src="images/connector.jpg" style="border-radius: 20px">
                <div style="position: relative; left: 15px; top:25px">
                    <b>- Соединитель</b>
                </div>
            </div>
            <div style="position: relative; font-size: 1.7ex; top: 80px">
                В случае, если блок-схема не умещается на лист, используется символ соединителя, отражающий переход потока управления между листами.
                <br>
                <br>
                Символ может использоваться и на одном листе, если по каким-либо причинам тянуть линию не удобно.
            </div>
        </div>
        <div class="progress">
            <div class="fill">
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