<?php
require_once 'vendor/connect.php';
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
$user_id = $_SESSION['user']['id'];
if (isset($_GET['lesend'])){
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
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body style="background-color: #c4dfe6">

<!-- Форма авторизации -->
<header style="background-color: #07575b;">
    <a href="#"><img src="images/default-logo.png" width="70px" alt="" style="visibility: hidden"></a>
    <nav>
        <a href="mainpage.php">Главная</a>
        <a href="lessons.php">Уроки</a>
        <a style="color: #c4dfe6;">Личный кабинет</a>
    </nav>
</header>

<div class="user_info" style="background-color: #377e84">
    <div class="avatar" style="width: 225px; height: 225px">
        <img src="<?= $_SESSION['user']['avatar'] ?>" width="100%" height="100%" alt="" style="border-radius: 20px;object-fit: cover;">
    </div>
    <div class="user_name">
        <h2><?= $_SESSION['user']['full_name'] ?></h2>
    </div>
    <div class="u_button">
        <button type="submit" class="user_button" onclick="document.location='settings.php'">Редактировать профиль</button>
        <button type="submit" class="user_button" style="padding: 3px 20px; margin: 0 0 0 20px"><a href="vendor/logout.php" class="logout">✖</a></button>
    </div>
    <hr class="hr-line">
    <div class="statistics">
        <div class="stat_div">
            <?php
                $k =  mysqli_fetch_assoc(mysqli_query($connect,"SELECT count(DISTINCT `LessonId`) as num_les FROM `session` WHERE `UserId`=$user_id"))[num_les];
                switch($k){
                    case '1':
                        echo "<h1>$k</h1>
                            <h4>Урок пройден</h4>";
                        break;
                    case '2':
                    case '3':
                    case '4':
                        echo "<h1>$k</h1>
                                <h4>Урока пройдено</h4>";
                        break;
                    default:
                        echo "<h1>$k</h1>
                            <h4>Уроков пройдено</h4>";
                        break;
                }
                ?>

        </div>
        <div class="stat_div">
            <?php
            $sumpoint = 0;
            $k = mysqli_query($connect,"SELECT `Points` FROM `session` as a join (SELECT max(FinishTime) as maxtime FROM `session` WHERE `UserId`=$user_id AND `Status` = 'Finished' GROUP BY `LessonId`) as k ON a.FinishTime = k.maxtime");
            while ($row = mysqli_fetch_assoc($k)){
                $sumpoint = $sumpoint + $row['Points'];
            }
            switch($sumpoint){
                case '1':
                case '11':
                    echo "<h1>$sumpoint</h1>
                            <h4>Балл заработан</h4>";
                    break;
                case '2':
                case '3':
                case '4':
                case '22':
                case '23':
                case '24':
                    echo "<h1>$sumpoint</h1>
                                <h4>Балла заработано</h4>";
                    break;
                default:
                    echo "<h1>$sumpoint</h1>
                            <h4>Баллов заработано</h4>";
                    break;
            }
            ?>
        </div>
        <div class="stat_div">
            <?php
                /*$h = 0;
                $m = 0;
                $s = 0;*/
                $summ = 0;
                $query = mysqli_query($connect, "SELECT * FROM `session` WHERE `UserId` = $user_id AND `Status` = 'Finished'");
                while ($row = mysqli_fetch_assoc($query)) {
                    $diff = strtotime($row['FinishTime']) - strtotime($row['StartTime']);
                    $summ = $summ + $diff;
                }
                $h = round(($summ)/3600);
                $m = round((($summ)%3600)/60);
                $s = round((($summ)%3600)%60);
                echo "<h1>$h : $m : $s</h1>"
            ?>
            <h4>Времени затрачено</h4>
        </div>
    </div>
    <!--<a href="vendor/logout.php" class="logout">Выход</a>-->
</div>

<!--<div class="sign" style="background-color: #377e84">
    <form style="color: #c4dfe6; font-weight: bold;">
        <h2 style="margin: 10px 0;"><?/*= $_SESSION['user']['full_name'] */?></h2>
        <a href="#"><?/*= $_SESSION['user']['email'] */?></a>
        <a href="vendor/logout.php" class="logout">Выход</a>
    </form>
</div>-->
<div class="element" style="overflow-y: scroll;">
<div class="lk_lesson">
    <div class="urok">
        <h2>Мои уроки</h2>
    </div>
    <?php
    require_once 'vendor/connect.php';
    $check_lessons = mysqli_query($connect, "SELECT * FROM `lesson`");
    /*if (mysqli_num_rows($check_lessons) > 0) {*/


        while( $row = mysqli_fetch_assoc($check_lessons)){
            $k = $row['LessonName'];
            $lid = $row['LessonId'];
            $max = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `LessonId`, count(*) as c_l FROM `test` WHERE `LessonId` = $lid GROUP BY `LessonId`;"))['c_l'];
            $d = mysqli_fetch_assoc(mysqli_query($connect,"SELECT `Points`,0 FROM `session` as a join (SELECT max(FinishTime) as maxtime FROM `session` WHERE `UserId`=$user_id AND `Status` = 'Finished' GROUP BY `LessonId`) as k ON a.FinishTime = k.maxtime AND `LessonId`=$lid"))['Points'];
            if (!isset($d)){
                $d = 0;
            }
            if ($max == 0){
                $max = 1;
            }?>
    <div class='but_class'>
        <div class='lesson_list'>
            <h2><?php echo $k?></h2>
        </div>
        <div class='l_button'>
            <div class='rating-result'>
                 <?php
                 $rate = ($d / $max) * 100;
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
            <button type='submit' class='lesson_button' onclick="document.location='lessons/theory.php?lesson=<?php  $_SESSION['count'] = 0; $_SESSION['point'] = 0; echo $lid ?>'">
                <?php
                    $query = mysqli_query($connect, "SELECT * FROM `session` WHERE `UserId` = $user_id AND `LessonId` = $lid AND `Status` = 'Finished'");
                    if (mysqli_num_rows($query) > 0){
                        echo 'Пройти заново';
                    }
                    else{
                        echo 'Начать урок';
                    }
                ?>
            </button>
        </div>
    </div><?php ;
        };
        if ($user_id == 4){
            echo "<div style='flex-direction: row'>
                  <button type='submit' class='lesson_button' style='width: 300px; left: 460px; top: 40px; position: relative; border-radius: 10px; background-color: #377e84' onclick=document.location='add/lesson.php'> Добавить новый урок </button>
                  <button type='submit' class='lesson_button' style='width: 300px; left: 430px; top: 40px; position: relative; border-radius: 10px; background-color: #377e84' onclick=document.location='statistics.php'> Посмотреть статитстику </button>
                  </div>";
        }
        echo "<div class='but_class'><div class='lesson_list' style='left: 625px; height: 0;visibility: hidden'></div></div>";
        ?>
</div>
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

<div class="footer" style="background-color: #00272e; height: 100px; position: relative;">
    <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
</div>

</body>
</html>