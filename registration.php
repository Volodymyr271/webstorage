<?php
function registration($login, $pass, $userMenu) {
    $query = mysql_query("SELECT i FROM sh WHERE a = 0 AND n LIKE '".$login."|%'");
    if (!mysql_num_rows($query)) {
        $uniqID = uniqid(true);
        $sql = "INSERT INTO sh (n, d, b, r)  VALUES('".$login."|".$pass."', '".date("Y-m-d")."', '".$userMenu."', '".$uniqID."')";
        if (mysql_query($sql)) {
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .=  'From: support@webstorage.com.ua'."\r\n".'Precedence: bulk'."\r\n";
            $subject = "Подтверждение регистрации на сайте WebStorage.com.ua";
            $message = 'Для активации аккаунта пройдите по следующей ссылке <a href="http://'
                        .$_SERVER['SERVER_NAME'].'/GetOperations.php?operation=activation&uniqID='.$uniqID.'" target="_blank">WEBStorage.com.ua</a>'
                        .' или скопируйте ссылку в окно ввода адреса браузера и нажмите enter.';

            if (mail($login, $subject, $message, $headers)) {
                echo 'Регистрация завершена, на введеный Вами e-mail было отправлено сообщение для активации аккаунта';
            }
            else {
                echo 'Регистрация невозможна. Повторите запрос позже';
            }
        }
        else {
            echo 'Регистрация невозможна. Повторите запрос позже<br />\n'.mysql_error();
        }
    }
    else {
        echo 'Регистрация невозможна. Пользователь с таким логином уже существует<br/>';
    }
}

function checkData($login, $pass, $passRepeat, $code = null, $usersCode = null, $name = null) {
    if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
        return "Регистрация невозможна. Логин должен соответствовать шаблону: name@domen.com";
    }
    if (strlen($pass) <= 3) {
        return "Регистрация невозможна. Пароль слишком короткий";
    }
    if ($pass != $passRepeat) {
        return "Регистрация невозможна. Введенные пароли не совпадают";
    }
    if ($code != $usersCode) {
        return "Регистрация невозможна. Код подтверждения введен неверно";
    }
    if (!is_null($name) && $name) {
        return "Регистрация невозможна. Введите имя";
    }
    return 0;
}

function authorization($login, $password) {
    $query = mysql_query("SELECT i FROM sh WHERE n = '".$login."|".md5($password)."' AND a = 0 AND x = 1");
    if (mysql_num_rows($query)) {
        $_SESSION['user'] = $login;
        setcookie('login', $login);
        setcookie('password', $password);
        $result = mysql_fetch_array($query);
        $_SESSION['UID'] = $result[0];
        return 1;
    }
}

function newPassword($login) {
    $query = mysql_query("SELECT i FROM sh WHERE a = 0 AND n LIKE '".$login."|%'");
    if (mysql_num_rows($query)) {
        $newPassword = substr(md5(uniqid(rand(),true)), mt_rand(1, 10), mt_rand(6, 10));
        $result = mysql_fetch_array($query);
        $userID = $result[0];
        if ( mysql_query('UPDATE sh SET r ="'.md5($newPassword).'" WHERE i = '.$userID)) {
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .=  'From: support@webstorage.com.ua'."\r\n".'Precedence: bulk'."\r\n";
            $subject = "Смена пароля на сайте WebStorage.com.ua";
            $message = 'Ваш новый пароль: '.$newPassword.'</br>Для смены пароля пройдите по следующей ссылке <a href="http://'
                        .$_SERVER['SERVER_NAME'].'/GetOperations.php?operation=changePassword&password='.md5($newPassword)
                        .'&login='.$login.'" target="_blank">WEBStorage.com.ua</a>'
                        .' или скопируйте ссылку в окно ввода адреса браузера и нажмите enter.';
            if (mail($login, $subject, $message, $headers)) {
                return 'На указанный вами email отправлено письмо с ссылкой на изменение пароля';
            }

            else {
                return "Ошибка: повторите запрос позже";
            }
        }

        else {
            return "Ошибка: повторите запрос позже";
        }

    }

    else {
        return "Ошибка: такого логина не существует";
    }
}
?>