<?php
session_set_cookie_params(2*7*24*60*60);
session_start();
if(isset($_SESSION['user']) AND trim($_SESSION['user'])){
	header("Location: stil.php");
	die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <title>WEBStorage</title>
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="ru" />
    <meta name="resource-type" content="document" />
    <link href="default.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js_lib/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="javascript/index.js"></script>
</head>
<body>
    <div id="outer">
        <div id="header">
                <div id="treeImage"></div>
                <h1><a href="#">WEBSTORAGE</a></h1>
                <h2>Онлайн склад...</h2>
        </div>
        <div id="menu">
                <ul>
                        <li class="first"><a href="pages/home.html" accesskey="1" title="">Главная</a></li>
                        <li><a href="pages/tariff.html" accesskey="2" title="">Тарифы</a></li>
                        <li><a href="pages/help.html" accesskey="3" title="">Справка</a></li>
                </ul>
        </div>
        <div id="content">
                <div id="tertiaryContent"></div>
                <div id="border"></div>
                <div id="primaryContentContainer">
                    <div id="primaryContent">
                </div>
                </div>
                <div id="secondaryContent">
                    <div id= "authWindow">
                        <p>
                            <h3>Вход на сайт</h3>
                            Логин: </br>
                            <input type ="text" id="login" value="<?php echo $_COOKIE['login']; ?>"></input></br>
                            Пароль: </br>
                            <input type="password" id="password" value="<?php echo $_COOKIE['password']; ?>"></input></br>
                            <input type="submit" id="authorization" value="Войти"></input></br>
                            <a href='pages/restore.html'>Забыли пароль?</a></br>
                            <a href='pages/outsideRegForm.php'>Регистрация</a></br>
                            <p id="msgbox1"></p>
                        </p>
                    </div>
                </div>
                <div class="clear"></div>
        </div>
    </div>
    <div id="footer">
        <p>Copyright &copy; 2015</p>
    </div>
</body>
</html>