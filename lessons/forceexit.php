<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
$less_id = $_SESSION['lesson'];
?>

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
        }
        ?>
    </title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body style="background-color: #c4dfe6">

<!-- Форма авторизации -->
<header style="background-color: #07575b;">

</header>

<div class="lesson_class">
    <div class='but_class'>
        <div class='les_desc' style="left:645px; height: 330px; top: 170px; width: max-content">
            <h2> Вы точно хотите выйти из урока? </h2>
            <hr class='hr-line' style='width: calc(100% - 45px); position: absolute; top: 85px; left: 23px; color: #c4dfe6'>
            <h3 style="font-size: 2.5ex"> Урок не будет отображаться, как пройденный, <br> и ваш прогресс не сохранится,<br> но попытка будет засчитана </h3>
            <button type='submit' class='sub_but' style="width: 250px" onclick="document.location='../<?php echo $_GET['exit'] ?>.php?lesend=true'; <?php $_SESSION['lesson'] = $less_id ?>">Да</button>
            <button type='submit' class='sub_but' style="width: 250px; left: 300px" onclick="document.location='<?php echo $_SESSION['lessonpage'] ?>?count=<?php echo $_GET['count'] ?>'">Нет</button>
        </div>
    </div>
</div>

<div class="footer" style="background-color: #00272e; height: 100px;">
    <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
</div>

</body>
</html>