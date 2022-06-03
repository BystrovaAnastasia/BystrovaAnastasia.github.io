<?php
require_once 'connect.php';
session_start();
$sid = session_id();

$login = $_POST['login'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$user_id = $_POST['id'];

$check_login = mysqli_query($connect, "SELECT * FROM `users` WHERE `login`='$login' AND NOT `id` = '$user_id'");
if(mysqli_num_rows($check_login) > 0){
    $_SESSION['message2'] = 'Логин уже занят';
}
else{
    $update_user = mysqli_query($connect, "UPDATE `users` SET `login`='$login', `full_name`='$full_name', `email`='$email' WHERE `id`='$user_id';");

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`='$user_id'");
    $user = mysqli_fetch_assoc($check_user);
    session_id($sid);
    session_start();
    $_SESSION['user'] = [
        "id" => $user['id'],
        "login" => $user['login'],
        "full_name" => $user['full_name'],
        "avatar" => $user['avatar'],
        "email" => $user['email']
    ];

    $_SESSION['message2'] = 'Данные успешно изменены';
}

header('Location: ../settings.php');
?>

<pre>
    <?php
    print_r(mysqli_num_rows($check_login));
    ?>
</pre>
