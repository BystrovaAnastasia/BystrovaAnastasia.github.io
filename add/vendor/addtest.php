<?php
session_start();
require_once '../../vendor/connect.php';
$count = $_SESSION['count'];

if ($_POST['but']=='onemore'){
    if($_POST['question']){
        if ($_POST['option1'] && $_POST['option2']){
            if (isset($_POST['option'])){
                switch($_POST['option']){
                    case 1:
                        $a = 1;
                        $b = 0;
                        $c = 0;
                        $d = 0;
                        break;
                    case 2:
                        $a = 0;
                        $b = 1;
                        $c = 0;
                        $d = 0;
                        break;
                    case 3:
                        $a = 0;
                        $b = 0;
                        $c = 1;
                        $d = 0;
                        break;
                    case 4:
                        $a = 0;
                        $b = 0;
                        $c = 0;
                        $d = 1;
                        break;
                }
                $quest = $_POST['question'];
                $desc = $_POST['answerdesc'];
                $last_les = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `lesson` ORDER BY `LessonId` desc LIMIT 1"))['LessonId'];
                $new_theory = mysqli_query($connect, "INSERT INTO `test`(Id, LessonId, Description, AnswerDesc, OrderNumber) VALUES(NULL, $last_les, '$quest', '$desc', $count)");
                $op1 = $_POST['option1'];
                $op2 = $_POST['option2'];
                $last_test = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `test` ORDER BY `Id` desc LIMIT 1"))['Id'];
                $new_options = mysqli_query($connect, "INSERT INTO `options`(Id, TestId, Description, IsTrue) VALUES(NULL, $last_test, '$op1', $a)");
                $new_options = mysqli_query($connect, "INSERT INTO `options`(Id, TestId, Description, IsTrue) VALUES(NULL, $last_test, '$op2', $b)");
                if($_POST['option3']){
                    $op3 = $_POST['option3'];
                    $new_options = mysqli_query($connect, "INSERT INTO `options`(Id, TestId, Description, IsTrue) VALUES(NULL, $last_test, '$op3', $c)");
                }
                if($_POST['option4']){
                    $op4 = $_POST['option4'];
                    $new_options = mysqli_query($connect, "INSERT INTO `options`(Id, TestId, Description, IsTrue) VALUES(NULL, $last_test, '$op4', $d)");
                }
                header('Location: ../test.php');
            }
            else{
                $_SESSION['count'] = $count - 1;
                $_SESSION['message'] = 'Выберите верный вариант ответа';
                header('Location: ../test.php');
            }
        }
        else{
            $_SESSION['count'] = $count - 1;
            $_SESSION['message'] = 'Должно быть хотя бы два варианта ответа';
            header('Location: ../test.php');
        }

    }
    else{
        $_SESSION['count'] = $count - 1;
        $_SESSION['message'] = 'Поля не заполнены';
        /*/*header('Location: ../test.php');*/
    }
}
else{
    $_SESSION['count'] = 0;
    header('Location: ../../profile.php');
}

?>

<pre>
    <?php
    print_r($a);
    print_r($b);
    print_r($c);
    print_r($d);
    ?>
</pre>
