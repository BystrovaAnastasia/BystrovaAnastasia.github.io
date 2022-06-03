<?php
session_start();
require_once '../../vendor/connect.php';
if($_POST['les_name']){
    $les_name = $_POST['name'];
    $desc = $_POST['description'];

    $check_lesson = mysqli_query($connect,"SELECT * FROM `lesson` WHERE `LessonName` = '$les_name'");

    if(mysqli_num_rows($check_lesson) > 0){
        $_SESSION['message'] = 'Урок с таким названием уже создан';
        header('Location: ../lesson.php');
    }
    else{
        $new_lesson = mysqli_query($connect, "INSERT INTO `lesson`(LessonId, LessonName, Description) VALUES(NULL, '$les_name', '$desc')");
        header('Location: ../theory.php');
    }
}
else{
    $_SESSION['message'] = 'Поля не заполнены';
    header('Location: ../lesson.php');
}
?>

<pre>
    <?php
    print_r(mysqli_num_rows($check_login));
    ?>
</pre>
