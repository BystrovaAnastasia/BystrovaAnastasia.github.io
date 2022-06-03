<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
if (isset($_GET['count'])){
    $count = $_GET['count'];
}
else{
    $count = $_SESSION['count'] + 1;
}
    $_SESSION['count'] = $count;
    $less_id = $_SESSION['lesson'];
    /*echo $count;*/
?>
<!--ПРАКТИЧЕСКАЯ ЧАСТЬ-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php
        require_once '../vendor/connect.php';

        $count_test = mysqli_fetch_assoc(mysqli_query($connect, "SELECT count(*) as c_t FROM `test` WHERE LessonId = $less_id"))['c_t'];

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
        <?php $_SESSION['lessonpage'] = 'test.php' ?>
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
        </h1>
    </div>
    <div class="les_info">
        <div class="theory">
            <div style="font-size: 3ex; margin: 18px 0">
                <?php
                if(isset($_GET['option1'] ) ){
                    $count = $count - 1;
/*                    $_SESSION['count'] = $count;*/
                }
                    $query = mysqli_query($connect, "SELECT * FROM `test` WHERE LessonId = $less_id AND OrderNumber = $count");
                    while($k = mysqli_fetch_assoc($query)){
                        $true_desc = $k['AnswerDesc'];
                        $_SESSION['true_desc'] = $true_desc;
                        $test_id = $k['Id'];
                        $_SESSION['test_id'] = $test_id;
                        echo $k['Description'];
                    }
                ?>
            </div>
        </div>
        <div class="progress" style="top:70px">
            <div class="fill" style="width: calc(450px*<?php echo ($count+$n_theory)/$num_pages ?>)">
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
                    <?php

                        $query = mysqli_query($connect, "SELECT * FROM `options` WHERE TestId = $test_id");
                        $c = 0;
                        while($k = mysqli_fetch_assoc($query)){
                            if ($c == 0 || $c == 2){
                                echo "<tr>";
                            }
                            $c = $c + 1;
                            $desc = $k['Description'];
                            $option_id = $k['Id'];
                            echo "
                                <td>
                                    <div class='form-item radio-btn nth-2'>
                                        <input type='radio' name='option1' id='$option_id' value='$option_id' onChange='this.form.submit()'>
                                        <label for='$option_id'> $desc </label>
                                    </div>
                                </td>
                            ";
                            if ($c==2 || $c == 4){
                                echo "</tr>";
                            }
                        }

                    ?>
                </table>
            </div>
        </form>
       <!-- --><?php
/*        if (isset($_SESSION['t_f'])) {
            echo $_SESSION['t_f'];
        }
        unset($_SESSION['t_f']);
        */?>
        <?php

        $true_option = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `options` WHERE TestId = $test_id AND IsTrue = 1"))['Id'];

        if ($count < $count_test) {
            $link =  'test.php';
        } else {
            $link = 'results.php';
        }

        if( isset( $_GET['option1'] ) )
        {
            $_SESSION['count'] = $count;
            switch( $_GET['option1'] )
            {
                case $true_option:
                    echo
                    "<div class='t_f_msg' style='border: 10px solid #009742;'>
                        <b>Верно</b>
                        <br>
                        $true_desc
                        <div class='next_les'>
                        <a class='arrow-3' href='$link'>Далее
                            <svg class='arrow-3-icon' xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'>
                                <g fill='none' stroke='#07575b' stroke-width='1.5' stroke-linejoin='round' stroke-miterlimit='10'>
                                    <circle class='arrow-3-iconcircle' cx='16' cy='16' r='15.12'></circle>
                                    <path class='arrow-3-icon--arrow' d='M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98'></path>
                                </g>
                            </svg>
                        </a>
                        </div>
                    </div>
                    ";
                    $point = 1;
                    break;
                default:
                    echo
                    "<div class='t_f_msg' style='border: 10px solid #bf3329;'>
                        <b>Неверно</b>
                        <br>
                        $true_desc
                        <div class='next_les'>
                        <a class='arrow-3' href='$link'>Далее
                            <svg class='arrow-3-icon' xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'>
                                <g fill='none' stroke='#07575b' stroke-width='1.5' stroke-linejoin='round' stroke-miterlimit='10'>
                                    <circle class='arrow-3-iconcircle' cx='16' cy='16' r='15.12'></circle>
                                    <path class='arrow-3-icon--arrow' d='M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98'></path>
                                </g>
                            </svg>
                        </a>
                        </div>
                    </div>
                    ";
                    $point = 0;
                    break;
            }
            $points = $_SESSION['point'] + $point;
            $_SESSION['point'] = $points;

        }
        ?>

    </div>
</div>

<div class="footer" style="background-color: #00272e; height: 100px;">
    <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
</div>

</body>
</html>