<?php
require_once 'vendor/connect.php';
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
if (isset($_GET['lesend'])){
    $user_id = $_SESSION['user']['id'];
    $less_id = $_SESSION['lesson'];
    mysqli_query($connect, "DELETE FROM `session` WHERE `LessonId` = $less_id AND `UserId` = $user_id AND `Status` = 'Started'");
}
?>
<style>
    tr, td{
        padding: 10px 15px;
    }
    h2{
        color: #07575b;
        margin-bottom: 10px;
    }
    input[type="checkbox"]:checked,
    input[type="checkbox"]:not(:checked)
    {
        position: absolute;
        left: -9999px;
    }
    input[type="checkbox"]:checked + label,
    input[type="checkbox"]:not(:checked) + label
    {
        display: inline-block;
        position: relative;
        padding-left: 28px;
        line-height: 20px;
        cursor: pointer;
    }
    input[type="checkbox"]:checked + label:before,
    input[type="checkbox"]:not(:checked) + label:before{
        content: "";
        position: absolute;
        left: 0px;
        top: 0px;
        width: 18px;
        height: 18px;
        border: 1px solid #dddddd;
        background-color: #ffffff;
    }

    input[type="checkbox"]:checked + label:before,
    input[type="checkbox"]:not(:checked) + label:before {
        border-radius: 2px;
    }

    input[type="checkbox"]:checked + label:after,
    input[type="checkbox"]:not(:checked) + label:after{
        content: "";
        position: absolute;
        -webkit-transition: all 0.2s ease;
        -moz-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }

    input[type="checkbox"]:checked + label:after,
    input[type="checkbox"]:not(:checked) + label:after {
        left: 3px;
        top: 4px;
        width: 10px;
        height: 5px;
        border-radius: 1px;
        border-left: 4px solid #07575b;
        border-bottom: 4px solid #07575b;
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    input[type="checkbox"]:not(:checked) + label:after{
        opacity: 0;
    }

    input[type="checkbox"]:checked + label:after{
        opacity: 1;
    }
    .elem::-webkit-scrollbar {
        width: 0;
        height: 0;
    }
</style>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Статистика</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body style="background-color: #c4dfe6">

<!-- Форма авторизации -->
<header style="background-color: #07575b;">
    <a href="#"><img src="images/default-logo.png" width="70px" alt="" style="visibility: hidden"></a>
    <nav>
        <a href="mainpage.php">Главная</a>
        <a href="lessons.php">Уроки</a>
        <a href="profile.php">Личный кабинет</a>
    </nav>
</header>
<div class="element" style="overflow-y: scroll; overflow-x: hidden; height: 775px; flex-direction: row;">
    <form method="post">
    <div class="elem" style="flex-direction: column; top: 150px; position: absolute; left: 70px; overflow-y:auto; height: 720px;-ms-overflow-style: none; scrollbar-width: none;">
        <h2>
            Пользователи
        </h2>
        <?php
        $query = mysqli_query($connect, "SELECT * FROM `users` WHERE NOT `login` = 'admin' ORDER BY `full_name` asc");
        while($row = mysqli_fetch_assoc($query)){
            $full_name = $row['full_name'];
            $u_login = $row['login'];
            $u_id = $row['id'];
            echo "
            <div style='margin-bottom: 15px;'>
                <input type='checkbox' id='$u_login' name='users[]' value='$u_id'> <label for='$u_login'>$full_name</label>
            </div>
            ";
        }
        ?>
        <hr class="hr-line" style="width: 350px; position: relative; margin-top: 10px; margin-bottom: 10px; left: 0; top: 0">
        <h2>
            Уроки
        </h2>
        <?php
        $query = mysqli_query($connect, "SELECT * FROM `lesson` ORDER BY `LessonId` asc");
        while($row = mysqli_fetch_assoc($query)){
            $lesson_name = $row['LessonName'];
            $l_id = $row['LessonId'];
            echo "
            <div style='margin-bottom: 15px;'>
                <input type='checkbox' id='$l_id' name='lessons[]' value='$l_id'> <label for='$l_id'>$lesson_name</label>
            </div>
            ";
        }
        ?>
        <hr class="hr-line" style="width: 350px; position: relative; margin-top: 10px; margin-bottom: 10px; left: 0; top: 0">
        <h2>
            Дополнительно
        </h2>
        <div style='margin-bottom: 15px;'>
            <input type='checkbox' id='isdone' name='isdone' value="yes"> <label for='isdone'>Только пройденные уроки</label>
        </div>
        <button class="sub_but" style="width: 350px;" onclick="this.form.submit()">
            Найти
        </button>
        <div style="height: 50px; width: 350px; visibility: hidden"></div>
    </div>
    </form>
    <div style="position: relative; left: 480px; top: 50px">
        <table style="text-align: start; border-spacing: 30px 20px;border: 1px solid #07575b;border-collapse: collapse; ">
            <tr style='border: 1px solid #07575b'>
                <td style="width: 300px">
                    ФИО ученика
                </td>
                <td style="width: 350px">
                    Урок
                </td>
                <td>
                    Средний балл
                </td>
                <td>
                    Кол-во попыток
                </td>
            </tr>
            <?php
            $users = $_POST['users'];
            $lessons = $_POST['lessons'];
            if (!empty($users) && !empty($lessons)){
                $separated_u = implode(',', $users);
                $separated_l = implode(',', $lessons);
                if ($_POST['isdone'] == 'yes'){
                    $f = mysqli_query($connect, "SELECT a.full_name, a.LessonName, round(avg(a.Points),2), count(*) FROM (SELECT  s.Points as Points, u.id as id, u.full_name as full_name, l.LessonId as LessonId, l.LessonName as LessonName FROM `session` as s 
                                            JOIN `users` as u ON s.UserId = u.id and not u.login = 'admin' AND u.id IN ($separated_u)
                                            JOIN `lesson` as l on s.LessonId = l.LessonId AND l.LessonId IN ($separated_l)) as a GROUP BY a.LessonName, a.full_name ORDER BY a.full_name;");

                }
                else{
                    $f = mysqli_query($connect, "SELECT 
                u.full_name as full_name, 
                l.LessonName as LessonName,
                round(avg(ifnull(s.Points,0)),2) as Points,
                (SELECT count(*) FROM 
                 `session` as se
                 JOIN (SELECT * FROM `users` WHERE not login = 'admin') as us ON se.UserId = us.id and us.full_name = u.full_name   	
                 JOIN `lesson` as le ON se.LessonId = le.LessonId and le.LessonName = l.LessonName
                        ) 
                FROM 
                     (SELECT * FROM `users` WHERE not login = 'admin' AND id IN ($separated_u)) as u
                     CROSS JOIN `lesson` as l ON LessonId IN ($separated_l)
                       LEFT JOIN `session` as s ON s.UserId = u.id and s.LessonId = l.LessonId
                     GROUP BY l.LessonName, u.full_name, l.LessonId
                    ORDER BY u.full_name, l.LessonId;");
                }
                while($k = mysqli_fetch_assoc($f)){
                    echo "<tr>";
                    foreach($k as $s){
                        echo "
                                <td>
                                    $s
                                </td>
                        ";
                    }
                    echo "</tr>";
                }
            }
            elseif(!empty($users)){
                $separated = implode(',', $users);
                if ($_POST['isdone'] == 'yes'){
                    $f = mysqli_query($connect, "SELECT a.full_name, a.LessonName, round(avg(a.Points),2), count(*) FROM (SELECT  s.Points as Points, u.id as id, u.full_name as full_name, l.LessonId as LessonId, l.LessonName as LessonName FROM `session` as s 
                                            JOIN `users` as u ON s.UserId = u.id and not u.login = 'admin' AND u.id IN ($separated)
                                            JOIN `lesson` as l on s.LessonId = l.LessonId) as a GROUP BY a.LessonName, a.full_name ORDER BY a.full_name;");
                }
                else {
                    $f = mysqli_query($connect, "SELECT 
                u.full_name as full_name, 
                l.LessonName as LessonName,
                round(avg(ifnull(s.Points,0)),2) as Points,
                (SELECT count(*) FROM 
                 `session` as se
                 JOIN (SELECT * FROM `users` WHERE not login = 'admin') as us ON se.UserId = us.id and us.full_name = u.full_name   	
                 JOIN `lesson` as le ON se.LessonId = le.LessonId and le.LessonName = l.LessonName
                        ) 
                FROM 
                     (SELECT * FROM `users` WHERE not login = 'admin' AND id IN ($separated)) as u
                     CROSS JOIN `lesson` as l 
                       LEFT JOIN `session` as s ON s.UserId = u.id and s.LessonId = l.LessonId
                     GROUP BY l.LessonName, u.full_name, l.LessonId
                    ORDER BY u.full_name, l.LessonId;");
                }
                while($k = mysqli_fetch_assoc($f)){
                    echo "<tr>";
                    foreach($k as $s){
                        echo "
                                <td>
                                    $s
                                </td>
                        ";
                    }
                    echo "</tr>";
                }
            }
            elseif (!empty($lessons)){
                $separated = implode(',', $lessons);
                if ($_POST['isdone'] == 'yes'){
                    $f = mysqli_query($connect, "SELECT a.full_name, a.LessonName, round(avg(a.Points),2), count(*) FROM (SELECT  s.Points as Points, u.id as id, u.full_name as full_name, l.LessonId as LessonId, l.LessonName as LessonName FROM `session` as s 
                                            JOIN `users` as u ON s.UserId = u.id and not u.login = 'admin'
                                            JOIN `lesson` as l on s.LessonId = l.LessonId AND l.LessonId IN ($separated)) as a GROUP BY a.LessonName, a.full_name ORDER BY a.full_name;");
                }
                else {
                    $f = mysqli_query($connect, "SELECT 
                u.full_name as full_name, 
                l.LessonName as LessonName,
                round(avg(ifnull(s.Points,0)),2) as Points,
                (SELECT count(*) FROM 
                 `session` as se
                 JOIN (SELECT * FROM `users` WHERE not login = 'admin') as us ON se.UserId = us.id and us.full_name = u.full_name   	
                 JOIN `lesson` as le ON se.LessonId = le.LessonId and le.LessonName = l.LessonName
                        ) 
                FROM 
                     (SELECT * FROM `users` WHERE not login = 'admin') as u
                     CROSS JOIN `lesson` as l ON LessonId IN ($separated)
                       LEFT JOIN `session` as s ON s.UserId = u.id and s.LessonId = l.LessonId
                     GROUP BY l.LessonName, u.full_name, l.LessonId
                    ORDER BY u.full_name, l.LessonId;");
                }
                while($k = mysqli_fetch_assoc($f)){
                    echo "<tr>";
                    foreach($k as $s){
                        echo "
                                <td>
                                    $s
                                </td>
                        ";
                    }
                    echo "</tr>";
                }
            }
            else{
                if ($_POST['isdone'] == 'yes'){
                    $f = mysqli_query($connect, "SELECT a.full_name, a.LessonName, round(avg(a.Points),2), count(*) FROM (SELECT  s.Points as Points, u.id as id, u.full_name as full_name, l.LessonId as LessonId, l.LessonName as LessonName FROM `session` as s 
                                            JOIN `users` as u ON s.UserId = u.id and not u.login = 'admin'
                                            JOIN `lesson` as l on s.LessonId = l.LessonId) as a GROUP BY a.LessonName, a.full_name ORDER BY a.full_name;");
                }
                else {
                    $f = mysqli_query($connect, "SELECT 
                u.full_name as full_name, 
                l.LessonName as LessonName,
                round(avg(ifnull(s.Points,0)),2) as Points,
                (SELECT count(*) FROM 
                 `session` as se
                 JOIN (SELECT * FROM `users` WHERE not login = 'admin') as us ON se.UserId = us.id and us.full_name = u.full_name   	
                 JOIN `lesson` as le ON se.LessonId = le.LessonId and le.LessonName = l.LessonName
                        ) 
                FROM 
                     (SELECT * FROM `users` WHERE not login = 'admin') as u
                     CROSS JOIN `lesson` as l
                       LEFT JOIN `session` as s ON s.UserId = u.id and s.LessonId = l.LessonId
                     GROUP BY l.LessonName, u.full_name, l.LessonId
                    ORDER BY u.full_name, l.LessonId;");
                }
                while($k = mysqli_fetch_assoc($f)){
                    echo "<tr>";
                    foreach($k as $s){
                        echo "
                                <td>
                                    $s
                                </td>
                        ";
                    }
                    echo "</tr>";
                }
            }
            ?>
        </table>
        <div style="height: 50px; width: 600px"></div>
    </div>
</div>


<div class="footer" style="background-color: #00272e; height: 100px;">
    <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
</div>

</body>
</html>