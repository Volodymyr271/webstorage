<?php
session_start();

@include_once('config.php');

switch ($_GET['operation']) {
    case 'logOut':
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy();
	header('location: index.php');
        break;
    case 'activation':
        $uniqID = $_GET['uniqID'];
        $query= mysql_query("UPDATE users SET rank = 1, tempID = NULL  WHERE tempID = '$uniqID'"); //mysql_query("UPDATE sh SET x=1 WHERE n LIKE '%".$uniqID."' AND x=0");
        if ($query) {
            if (mysql_affected_rows()==1) {
                echo '<h2>Ваша учетная запись активирована.</h2><br/>'.
                     'Теперь вы можете <a href="index.php">войти на сайт</a> используя данные указанные при регистрации';
            }
            else {
                echo 'Активация невозможна: профиль уже активирован или ссылка неккоректна';
                    }
        }
        else {
            echo 'Ошибка активации';
        }
        break;
    case 'changePassword':
        $login = $_GET['login'];
        $password = $_GET['password'];
        $checkUniqID = mysql_query("SELECT i FROM users WHERE tempID = '$password'");
        if (mysql_num_rows($checkUniqID)) {
            $changePassword = mysql_query("UPDATE users SET pass = '$password', tempID = NULL WHERE tempID = '$password'");
            if ($changePassword) {
                echo "<h3>Ваш пароль был изменен</h3><p>Теперь вы можете <a href='http://webstorage.com.ua'>Войти на сайт</a> используя свой новый пароль</p>";
            }
            else {
               echo "Повторите запрос позже";
            }

        }
        else {
            header('location: index.php');
        }
}
