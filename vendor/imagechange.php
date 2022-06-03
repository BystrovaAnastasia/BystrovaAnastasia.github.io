<?php
require_once 'connect.php';
session_start();
$sid = session_id();

$user_id = $_POST['id'];

$path = 'uploads/' . time() . $_FILES['avatar']['name'];
if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
    $_SESSION['message1'] = 'Ошибка при загрузке фотографии';
} else {
    $update_image = mysqli_query($connect, "UPDATE `users` SET `avatar`='$path' WHERE `id`='$user_id';");

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

    $_SESSION['message1'] = 'Фотография успешно загружена';


}
header('Location: ../settings.php');
?>

<pre>
    <?php
    print_r($path);
    ?>
</pre>

