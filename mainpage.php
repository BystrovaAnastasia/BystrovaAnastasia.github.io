<?php
require_once 'vendor/connect.php';
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
$user_id = $_SESSION['user']['id'];
$less_id = $_SESSION['lesson'];
if (isset($_GET['lesend'])){
    /*mysqli_query($connect, "DELETE FROM `session` WHERE `LessonId` = $less_id AND `UserId` = $user_id AND `Status` = 'Started'");*/
    $date = date("y-m-d H:i:s");
    $a = mysqli_query($connect, "UPDATE `session` SET `FinishTime` = '$date', `Points` = 0, `Status` = 'Terminated' WHERE `LessonId` = $less_id AND `UserId` = $user_id and `Status` = 'Started'");

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body style="background-color: #c4dfe6">

<!-- Форма авторизации -->
<header style="background-color: #07575b;">
    <a href="#"><img src="images/default-logo.png" width="70px" alt="" style="visibility: hidden"></a>
    <nav>
        <a style="color: #c4dfe6;">Главная</a>
        <a href="lessons.php">Уроки</a>
        <a href="profile.php">Личный кабинет</a>
    </nav>
</header>

<div class="mainpage">
    <div class="annotation">
        <h1 style="font-size: 7ex">
            ОБУЧЕНИЕ
        </h1>
        <br>
        <h1 style="font-size: 7ex">
            PYTHON
        </h1>
        <br>
        <h1 style="font-size: 7ex">
            С НУЛЯ
        </h1>
        <div style="position: absolute; width: 350px; height: 350px; top:-25px; left: 250px">
            <img src="../images/python.png" style="height: 100%; width:100%">
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h2>
            - Основы алгоритмизации
        </h2>
        <br>
        <br>
        <h2>
            - PYTHON на примерах
        </h2>
        <br>
        <br>
        <h2>
            - Контрольные тесты в конце каждого урока
        </h2>
    </div>
    <div class="rating" style="box-shadow: 12px 12px #66a5ad;">
        <div class="rating_h1">
            ТОП-10 учеников
        </div>
        <table style="border-spacing: 20px 10px; color: #c4dfe6; font-size: 2.2ex; font-weight: bold; top: -10px; position:relative;">
            <?php
            $query = mysqli_query($connect,"SELECT * FROM `users` WHERE NOT `login` = 'admin'");
            $maketemp = mysqli_query($connect,"
                CREATE TEMPORARY TABLE temp_table (
                  `Id` int NOT NULL AUTO_INCREMENT,
                  `UserId` int,
                  `Points` int,
                  PRIMARY KEY(id)
                ) AUTO_INCREMENT=1
              ");
            while ($d = mysqli_fetch_assoc($query)){
                $user = $d['id'];
                $sumpoint = 0;
                $k = mysqli_query($connect,"SELECT `Points` FROM `session` as a join (SELECT max(`FinishTime`) as maxtime FROM `session` WHERE `UserId`=$user AND `Status` = 'Finished' GROUP BY `LessonId`) as k ON a.FinishTime = k.maxtime");
                while ($row = mysqli_fetch_assoc($k)){
                    $sumpoint = $sumpoint + $row['Points'];
                }
                mysqli_query($connect,"INSERT INTO `temp_table` (`Id`, `UserId`, `Points`) VALUES (NULL, $user, $sumpoint)");
            }
            $res = mysqli_query($connect, "SELECT t.UserId, u.login, u.avatar, t.Points FROM temp_table as t JOIN `users` as u ON t.UserId = u.id ORDER BY t.Points desc LIMIT 10");
            $count = 0;
            while($n = mysqli_fetch_assoc($res)){
                $count = $count + 1;
                $avatar = $n['avatar'];
                $login = $n['login'];
                $point = $n['Points'];
                $user = $n['UserId'];
                    echo "<tr style='line-height: 0;'>";
                if ($count == 1){
                    echo "<td style='height: 50px; width:50px;text-align: center; border-radius: 50px; background-color: gold'>";
                }
                elseif ($count == 2){
                    echo "<td style='height: 50px; width:50px;text-align: center; border-radius: 50px; background-color: silver'>";
                }
                elseif ($count == 3){
                    echo "<td style='height: 50px; width:50px;text-align: center; border-radius: 50px; background-color: #cd7f32'>";
                }
                else{
                    echo "<td style='height: 50px; width:50px; text-align: center'>";
                }
                echo "
                        <h4 style='text-shadow: #00272e 0 0 5px;'>$count</h4>
                    </td>
                    <td style='height: 35px; width:35px; text-align: center'>
                        <img src='$avatar' width='100%' height='100%' style='border-radius: 50px;object-fit: cover;'>
                    </td>
                    <td style='height: 50px;text-align: start'>
                        $login
                    </td>
                    <td style='height: 50px; text-align: center'>
                        $point
                    </td>
            </tr>
                ";
            }
            ?>
        </table>
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