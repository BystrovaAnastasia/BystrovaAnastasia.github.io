<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
    $_SESSION['lesson'] = $_GET['lesid'];
    $less_id = $_SESSION['lesson'];
    $_SESSION['count'] = 0;
    $_SESSION['point'] = 0;
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

<div class="lesson_class">
    <div class='but_class'>
        <div class='les_desc'>
            <?php
            $check_lessons = mysqli_query($connect, "SELECT * FROM `lesson` WHERE `LessonId` = $less_id");
            if (mysqli_num_rows($check_lessons) > 0) {
                while ($row = mysqli_fetch_assoc($check_lessons)) {
                    $temp1 = $row['LessonName'];
                    $temp2 = $row['Description'];
                    echo "
                        
                                <h2>$temp1</h2>
                                <hr class='hr-line' style='width: calc(100% - 45px); position: absolute; top: 85px; left: 23px; color: #c4dfe6'>
                                <h3>$temp2</h3>
                                ";
                }
            }
            ?>
            <button type='submit' class='sub_but' onclick="document.location='../lessons.php'">Вернуться к списку уроков</button>
        </div>
    </div>
    <?php
    $date = date("y-m-d H:i:s");
    $user_id = $_SESSION['user']['id'];
    $check_page_update = mysqli_query($connect, "SELECT * FROM `session` WHERE `UserId` = $user_id AND `LessonId` = $less_id AND `Status` = 'Finished'");
    if (mysqli_num_rows($check_page_update) > 0) {
        $link = 'alreadyfinished.php';
    }
    else{
        $link = 'theory.php';
    }
    ?>
    <a href="<?php echo $link ?>" style="z-index:3;">
        <div class="arrow-6">
            <svg width="18px" height="17px" viewBox="-1 0 18 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g>
                    <polygon class="arrow-6-pl" points="16.3746667 8.33860465 7.76133333 15.3067621 6.904 14.3175671 14.2906667 8.34246869 6.908 2.42790698 7.76 1.43613596"></polygon>
                    <polygon class="arrow-6-pl-fixed" points="16.3746667 8.33860465 7.76133333 15.3067621 6.904 14.3175671 14.2906667 8.34246869 6.908 2.42790698 7.76 1.43613596"></polygon>
                    <path d="M-4.58892184e-16,0.56157424 L-4.58892184e-16,16.1929159 L9.708,8.33860465 L-1.64313008e-15,0.56157424 L-4.58892184e-16,0.56157424 Z M1.33333333,3.30246869 L7.62533333,8.34246869 L1.33333333,13.4327013 L1.33333333,3.30246869 L1.33333333,3.30246869 Z"></path>
                </g>
            </svg>
        </div>
    </a>
</div>

<div class="footer" style="background-color: #00272e; height: 100px;">
    <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
</div>

</body>
</html>