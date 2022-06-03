<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
if (isset($_GET['lesson'])){
    $less_id = $_GET['lesson'];
    $_SESSION['lesson'] = $less_id;
    $_SESSION['count'] = 0;
}
else{
    $less_id = $_SESSION['lesson'];
}
if (isset($_GET['count'])){
    $count = $_GET['count'];
}
else{
    $count = $_SESSION['count'] + 1;
}
$_SESSION['count'] = $count;
?>
<!--ТЕОРЕТИЧЕСКАЯ ЧАСТЬ-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php
        require_once '../vendor/connect.php';

        $count_theory = mysqli_fetch_assoc(mysqli_query($connect, "SELECT count(*) as c_t FROM `theory` WHERE LessonId = $less_id"))['c_t'];

        $check_lessons = mysqli_query($connect, "SELECT * FROM `lesson` WHERE `LessonId` = $less_id");
        if (mysqli_num_rows($check_lessons) > 0) {
            while ($row = mysqli_fetch_assoc($check_lessons)) {
                $temp1 = $row['LessonName'];
                $temp2 = $row['Description'];
                echo $temp1;
            }
        }

        $n_theory = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `theory` WHERE `LessonId` = $less_id"));
        $n_test = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `test` WHERE `LessonId` = $less_id"));
        $num_pages = $n_theory + $n_test;
        ?>
    </title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body style="background-color: #c4dfe6">

<!-- Форма авторизации -->
<header style="background-color: #07575b;">
    <a href="#"><img src="../images/default-logo.png" width="70" alt="" style="visibility: hidden"></a>
    <nav>
        <?php $_SESSION['lessonpage'] = 'theory.php' ?>
        <a href="forceexit.php?exit=mainpage&count=<?php echo $count ?>">Главная</a>
        <a href="forceexit.php?exit=lessons&count=<?php echo $count ?>">Уроки</a>
        <a href="forceexit.php?exit=profile&count=<?php echo $count ?>">Личный кабинет</a>
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
            if ($count == 1){
                $check_page_update = mysqli_query($connect, "SELECT * FROM `session` WHERE `UserId` = $user_id AND `LessonId` = $less_id AND `Status` = 'Started'");
                if (mysqli_num_rows($check_page_update) == 0) {
                    $test = mysqli_query($connect, "INSERT INTO `session` (`SessionId`,`StartTime`,`Status`,`LessonId`,`UserId`) VALUES (NULL, '$date', 'Started', $less_id, $user_id)");
                }
            }

            ?>
        </h1>
    </div>
    <div class="les_info">
        <div class="theory">
            <?php

            $query = mysqli_query($connect,"SELECT * FROM `theory` WHERE LessonId = $less_id AND OrderNumber = $count");
            while ($k = mysqli_fetch_assoc($query)){
                echo $k['Description'];
            }

            ?>
            </div>
        <div class="progress">
            <div class="fill" style="width: calc(450px*<?php echo $count/$num_pages ?>)">
            </div>
            <div class="all">
            </div>
            <div class="next_les">
                <a class="arrow-3" href="<?php
                    if ($count < $count_theory){
                        echo "theory.php";
                    }
                    else{
                        $_SESSION['count'] = 0;
                        echo "test.php";
                    }
                ?>">Далее
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