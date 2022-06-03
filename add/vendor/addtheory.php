<?php
session_start();
require_once '../../vendor/connect.php';
$count = $_SESSION['count'];

if ($_POST['but']=='onemore'){

    if($_POST['theory']){
        $theory = $_POST['theory'];
        $last_add = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `lesson` ORDER BY `LessonId` desc LIMIT 1"))['LessonId'];
        $new_theory = mysqli_query($connect, "INSERT INTO `theory`(id, LessonId, Description, OrderNumber) VALUES(NULL, $last_add, '$theory', $count)");
        header('Location: ../theory.php');
    }
    else{
        $_SESSION['count'] = $count - 1;
        $_SESSION['message'] = 'Поля не заполнены';
        header('Location: ../theory.php');
    }
}
else{
    $_SESSION['count'] = 0;
    header('Location: ../test.php');
}

?>

<pre>
    <?php
    print_r($theory);
    print_r($_POST['but']);
    print_r($last_add);
    print_r($count);
    ?>
</pre>
