<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
$less_id = $_SESSION['lesson'];
?>
<!--ТЕОРЕТИЧЕСКАЯ ЧАСТЬ-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php
        require_once '../vendor/connect.php';
        $check_lessons = mysqli_query($connect, "SELECT * FROM `lesson` WHERE `LessonId` = $less_id");
        if (mysqli_num_rows($check_lessons) > 0) {
            while ($row = mysqli_fetch_assoc($check_lessons)) {
                $temp1 = $row['LessonName'];
                $temp2 = $row['Description'];
                echo $temp1;
            }
        } else {
            $_SESSION['message'] = 'Такого урока не существует';
        }
        ?>
    </title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body style="background-color: #c4dfe6">

<!-- Форма авторизации -->
<header style="background-color: #07575b;">
    <a href="#"><img src="../images/default-logo.png" width="70" alt="" style="visibility: hidden"></a>
    <nav>
        <a href="../mainpage.php">Главная</a>
        <a href="../lessons.php">Уроки</a>
        <a href="../profile.php">Личный кабинет</a>
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
    <?php
    $date = date("y-m-d H:i:s");
    $user_id = $_SESSION['user']['id'];
    $all_points = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `LessonId`, count(*) as c_l FROM `test` WHERE `LessonId` = $less_id GROUP BY `LessonId`;"))['c_l'];
    $right_points = $_SESSION['point'];
    $a = mysqli_query($connect, "UPDATE `session` SET `FinishTime` = '$date', `Points` = $right_points, `Status` = 'Finished' WHERE `LessonId` = $less_id AND `UserId` = $user_id and `Status` = 'Started'");
    ?>
    <div class="results">
        <div class="les_end">
            <h2>Урок завершен!</h2>
            <div class="rating-result">
                <?php
                $rate = ($right_points / $all_points) * 100;
                if ($rate == 100){
                    echo '
                    <span class="active"></span>
                    <span class="active"></span>
                    <span class="active"></span>
                    <span class="active"></span>
                    <span class="active"></span>
                    ';
                }
                elseif ($rate < 100 && $rate >=75){
                    echo '
                    <span class="active"></span>
                    <span class="active"></span>
                    <span class="active"></span>
                    <span class="active"></span>
                    <span></span>
                    ';
                }
                elseif ($rate < 75 && $rate >=50){
                    echo '
                    <span class="active"></span>
                    <span class="active"></span>
                    <span class="active"></span>
                    <span></span>
                    <span></span>
                    ';
                }
                elseif ($rate < 50 && $rate >=25){
                    echo '
                    <span class="active"></span>
                    <span class="active"></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    ';
                }
                elseif ($rate < 25 && $rate >0){
                    echo '
                    <span class="active"></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    ';
                }
                elseif ($rate == 0){
                    echo '
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    ';
                }
                ?>
            </div>
        </div>
        <div class="res_points">
            <h3>Вы ответили верно на <?php echo $right_points ?> из <?php echo $all_points ?> вопросов</h3>
        </div>
        <div class="next_les">
            <?php
            $next = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `lesson` WHERE `LessonId` > $less_id ORDER BY `LessonId` asc LIMIT 1"))['LessonId'];
            ?>
            <a class="arrow-3" href="index.php?lesid=<?php echo $next ?>">Перейти к следующему уроку
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

<div class="footer" style="background-color: #00272e; height: 100px;">
    <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
</div>

</body>
</html>