<?php
session_start();

if ($_SESSION['user']) {
    header('Location: profile.php');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body style="background-color: #c4dfe6">

<!-- Форма авторизации -->
    <header style="background-color: #07575b;">
    </header>

    <div class="signform" style="background-color: #377e84">
        <form action="vendor/signin.php" method="post" style="color: #c4dfe6; font-weight: bold;">
            <label>Логин</label>
            <input type="text" name="login" placeholder="Введите свой логин">
            <label>Пароль</label>
            <input type="password" name="password" placeholder="Введите пароль">
            <button type="submit">Войти</button>
            <p>
                У вас нет аккаунта? - <a href="/register.php" style="font-weight: bold;">зарегистрируйтесь</a>!
            </p>
            <?php
                if ($_SESSION['message']) {
                    echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
                }
                unset($_SESSION['message']);
            ?>
        </form>
    </div>

    <div class="footer" style="background-color: #00272e; height: 100px">
        <div class="footer_text" style="color: #ffffff; "> © 2022 Сайт по изучению алгоритмизации и основ программирования </div>
    </div>

</body>
</html>