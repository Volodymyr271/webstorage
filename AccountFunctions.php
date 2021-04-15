<?php
function checkData($login = null, $pass = null, $passRepeat = null, $code = null, $usersCode = null, $name = null) {
    if (!is_null($login)) {
        if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
            return "Логин должен соответствовать шаблону: name@domen.com";
        }
        $query = mysql_query("SELECT i FROM users WHERE login='$login'");
        if (mysql_num_rows($query)) {
            return 'Пользователь с таким логином уже существует';
        }
    }
    if (!is_null($pass)) {
        if (strlen($pass) <= 3) {
            return "Длина пароля должна быть не меньше 4 символов";
        }
        if ($pass != $passRepeat) {
            return "Введенные пароли не совпадают";
        }
    }

    if ($code != $usersCode) {
        return "Код подтверждения введен неверно";
    }
    if (!is_null($name) && !$name) {
        return "Введите имя";
    }
    return 0;
}

function authorization($login, $password) {
    $query = mysql_query("SELECT i FROM users WHERE login = '$login' AND pass='".md5($password)."' AND rank = 1");
    if (mysql_num_rows($query)) {
        $_SESSION['user'] = $login;
        setcookie('login', $login);
        setcookie('password', $password);
        $_SESSION['UID'] = mysql_result($query, 0);
        return 1;
    }
}

function newPassword($login) {
    $query = mysql_query("SELECT i FROM users WHERE login='$login'");
    if (mysql_num_rows($query)) {
        $newPassword = substr(md5(uniqid(rand(),true)), mt_rand(1, 10), mt_rand(6, 10));
        $userID = mysql_result($query, 0);
        if ( mysql_query('UPDATE users SET tempID ="'.md5($newPassword).'" WHERE i = '.$userID)) {
            $subject = "Смена пароля на сайте WebStorage.com.ua";
            $message = 'Ваш новый пароль: '.$newPassword.'</br>Для смены пароля пройдите по следующей ссылке <a href="http://'
                        .$_SERVER['SERVER_NAME'].'/GetOperations.php?operation=changePassword&password='.md5($newPassword)
                        .'&login='.$login.'" target="_blank">WEBStorage.com.ua</a>'
                        .' или скопируйте ссылку в окно ввода адреса браузера и нажмите enter.';
            $successMsg = 'На указанный вами email отправлено письмо с ссылкой на изменение пароля';
            return sendMail($login, $subject, $message, $successMsg);
        }

        else {
            return "Ошибка: повторите запрос позже";
        }

    }

    else {
        return "Ошибка: такого логина не существует";
    }
}

function selectUser($parentID, $userID) {
    $query = mysql_query("SELECT name, login FROM users WHERE prntLnk ='$parentID' OR i='$parentID' AND i ='$userID'");
    $result = mysql_fetch_assoc($query);
    return json_encode(array('login' => $result['login'], 'name' => $result['name'], 'id' => $userID));
}

function editUser($parentID, $userID, $attr) {
    switch ($attr[0]) {
        case 'password':
            $checkResult = checkData(null, $attr[1], $attr[2]);
            if (!$checkResult) {
                $query = mysql_query("UPDATE users SET pass ='".md5($attr[1])."' WHERE prntLnk ='$parentID' OR i='$parentID' AND i='$userID'");
                if ($query) {
                    setcookie('password', $attr[1]);
                    return 'Пароль успешно изменен';
                }
            }
            else {
                return $checkResult;
            }
            break;
        case 'name':
            if (!$attr[1] == '') {
                $query = mysql_query("UPDATE users SET name='$attr[1]' WHERE prntLnk='$parentID' OR i='$parentID' AND i='$userID'");
                if ($query) {

                    return 'Имя успешно изменено';
                }
            }
            else {
                return 'Введите имя';
            }
            break;
        case 'menuType':
            $menu = addslashes(file_get_contents($attr[1]));
            $query = mysql_query("UPDATE users SET menu='$menu' WHERE prntLnk='$parentID' OR i='$parentID' AND i='$userID'");
            if ($query) {
                return 'Меню пользователя успешно изменено';
            }
    }
}

function loadUsersList($parentID, $funcName) {
    $query = mysql_query("SELECT login, i FROM users WHERE prntLnk = '$parentID' OR i='$parentID'");
    $response = '';
    while(($result = mysql_fetch_assoc($query)) != false) {
        $response = $response.'<a class="modal_id" href="#" onclick="'.$funcName.'('.$result['i'].')">'.$result['login'].'</br></a>';
    }
    return $response;
}

function outsideReg($login, $pass, $passRepeat, $code, $inputCode) {
    $check = checkData($login, $pass, $passRepeat, $code, $inputCode);
    if ($check) {
        return $check;
    }
    else {
        $uniqID = uniqid(true);
        $currDate = date("Y-m-d");
        $hpass = md5($pass);
        $menu = addslashes(file_get_contents('default.json'));
        $query = mysql_query("INSERT INTO users (login, pass, date, menu, tempID)  VALUES('$login', '$hpass', '$currDate', '$menu', '$uniqID')");
        if ($query) {
            $subject = "Подтверждение регистрации на сайте WebStorage.com.ua";
            $message = 'Для активации аккаунта пройдите по следующей ссылке <a href="http://'
                        .$_SERVER['SERVER_NAME'].'/GetOperations.php?operation=activation&uniqID='.$uniqID.'" target="_blank">WEBStorage.com.ua</a>'
                        .' или скопируйте ссылку в окно ввода адреса браузера и нажмите enter.';
            $successMsg = 'Регистрация завершена. На указанный вами email отправлено письмо с ссылкой для активации аккаунта';
            return sendMail($login, $subject, $message, $successMsg);
        }
        else {
            return "Регистрация невозможна. Повторите запрос позже\n".mysql_error();
        }
    }

}

function insideReg($login, $pass, $passRepeat, $name, $menuType, $parentID) {
    $checkResult = checkData($login, $pass, $passRepeat, null, null, $name);
    if ($checkResult) {
        return $checkResult;
    }
    else {
        $hpass = md5($pass);
        $menu = addslashes(file_get_contents($menuType));
        $currDate = date("Y-m-d");
        $query = mysql_query("INSERT INTO users (prntLnk, login, pass, rank, date, name,  menu)  VALUES('$parentID', '$login', '$hpass', 1, '$currDate', '$name', '$menu')");
        if ($query) {
            return 'Регистрация завершена';
        }
        else {
            echo 'Регистрация невозможна. Повторите запрос позже<br />\n'.mysql_error();
        }
    }
}

function sendMail($login, $subject, $message, $successMsg) {
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .=  'From: support@webstorage.com.ua'."\r\n".'Precedence: bulk'."\r\n";
    if (mail($login, $subject, $message, $headers)) {
        return $successMsg;
    }
    else {
        return 'Ошибка. Повторите запрос позже';
    }
}

function loadMenu($userID) {
    $query = mysql_query("SELECT menu FROM users WHERE i='$userID'");
    return mysql_result($query, 0);
}
?>