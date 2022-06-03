<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Настройки</title>
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

<div class="settings_style">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <div class="down_av" style="flex-direction: column;" >
        <div class="avatar" style="width: 225px; height: 225px;">
            <img src="<?= $_SESSION['user']['avatar'] ?>" width="100%" height="100%" alt="" style="border-radius: 20px;object-fit: cover; opacity: 20%">
        </div>
        <div class="form-group">
            <form action="vendor/imagechange.php" method="post" enctype="multipart/form-data">
                <input type='hidden' name='id' value='<?= $_SESSION['user']['id'] ?>' />
                <label for="file" class="label">
                    <input type="file" name="avatar">
                    <i class="material-icons">attach_file</i>
                    <span class="title">Загрузить новое фото профиля</span>
                </label>
                <button type="submit" class="sub_but" style="width:235px; top: 72px; left: 170px; margin: 0px; position: relative">Изменить фото</button>
                <?php
                if ($_SESSION['message1']) {
                    echo "<p class='msg' style='position: relative;
    top: 75px;
    left: 80px;'>";
                    echo $_SESSION['message1'];
                    echo "</p>";
                }
                unset($_SESSION['message1']);
                ?>
            </form>
        </div>
    </div>
    <div class="set_form">
        <form action="vendor/datachange.php" method="post" enctype="multipart/form-data" style="font-weight: bold; margin: 100px 115px; width: 500px;">
            <label>ФИО</label>
            <input type="text" name="full_name" value="<?= $_SESSION['user']['full_name'] ?>">
            <label>Логин</label>
            <input type="text" name="login" value="<?= $_SESSION['user']['login'] ?>">
            <label>Почта</label>
            <input type="email" name="email" value="<?= $_SESSION['user']['email'] ?>">
            <button type="submit" class="sub_but">Изменить данные</button>
            <input type='hidden' name='id' value='<?= $_SESSION['user']['id'] ?>' />
            <?php
            if ($_SESSION['message2']) {
                echo "<p class='msg'>";
                echo $_SESSION['message2'];
                echo "</p>";
            }
            unset($_SESSION['message2']);
            ?>
        </form>

        <form action="vendor/passwordchange.php" method="post" enctype="multipart/form-data" style="font-weight: bold; margin: 100px 0px; width: 500px;">
            <label>Старый пароль</label>
            <input type="password" name="old_password" placeholder="Введите свой старый пароль">
            <label>Новый пароль</label>
            <input type="password" name="new_password" placeholder="Введите новый пароль">
            <label>Подтверждение пароля</label>
            <input type="password" name="password_confirm" placeholder="Подтвердите новый пароль">
            <button type="submit" class="sub_but">Изменить пароль</button>
            <input type='hidden' name='id' value='<?= $_SESSION['user']['id'] ?>' />
            <?php
            if ($_SESSION['message3']) {
                echo "<p class='msg'>";
                echo $_SESSION['message3'];
                echo "</p>";
            }
            unset($_SESSION['message3']);
            ?>
        </form>
    </div>
</div>

<!--<div class="sign" style="background-color: #377e84">
    <form style="color: #c4dfe6; font-weight: bold;">
        <h2 style="margin: 10px 0;"><?/*= $_SESSION['user']['full_name'] */?></h2>
        <a href="#"><?/*= $_SESSION['user']['email'] */?></a>
        <a href="vendor/logout.php" class="logout">Выход</a>
    </form>
</div>-->


<div class="footer" style="background-color: #00272e; height: 100px;">
    <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
</div>

</body>
</html>