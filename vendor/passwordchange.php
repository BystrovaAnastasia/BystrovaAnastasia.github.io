<?php
session_start();
require_once 'connect.php';

$old_pass = $_POST['old_password'];
$new_pass = $_POST['new_password'];
$pass_conf = $_POST['password_confirm'];
$user_id = $_POST['id'];

$check_user = mysqli_query($connect, "SELECT `password` FROM `users` WHERE `id`='$user_id'");
$result = mysqli_fetch_array($check_user);

if ($result[0]==md5($old_pass)){
    if ($new_pass === $pass_conf) {

        $new_pass = md5($new_pass);

        $change_pass = mysqli_query($connect, "UPDATE `users` SET `password`='$new_pass' WHERE `id`='$user_id';");

        unset($_SESSION['message']);
        $_SESSION['message3'] = 'Данные успешно изменены';
    }
    else{
        unset($_SESSION['message']);
        $_SESSION['message3'] = 'Пароли не совпадают';
    }
}
else{
    unset($_SESSION['message']);
    $_SESSION['message3'] = 'Неверный нынешний пароль';
}

header('Location: ../settings.php');
?>

<pre>
    <?php
    print_r($check_user);
    print_r($result);
    print_r($result[0]);
    ?>
</pre>
