<?php
session_start();
@include_once("config.inc.php");
if( ! isset($_SESSION['user']) || ! trim($_SESSION['user'])){
	@header("Location: index.php");
	die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
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
    <script type="text/css" src="js_lib/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css"></script>
    <script type="text/javascript" src="js_lib/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script type="text/javascript" src="javascript/stil.js"></script>
    <script type="text/javascript" src="javascript/page_functions.js"></script>
</head>
<body>
    <div id="outer">
        <div id="stilheader">
            <div id="treeImage"></div>
            <h1><a href="#">WEBSTORAGE</a></h1>
            <h2>Онлайн склад...</h2>
            <div id="mainmenu"></div>
        </div>
        <div id="user">
            <p><?php echo $_SESSION['user']; ?>&nbsp<a href="GetOperations.php?operation=logOut">Выйти</a></p>
        </div>
        <div id="content">
                <div id="tertiaryContent"></div>
                <div id="border"></div>
                <div id="primaryContentContainer">
                    <div id="primaryContent">
                        <div id='tabs'>
                            <button id='prev' onclick="correctTabsPosition('prevButtonPressed');">&lt;</button>
                            <button id='next' onclick="correctTabsPosition('nextButtonPressed');">&gt;</button>
                            <div id="slider">
                                <ul>
                                </ul>
                            </div>
                        </div>
                        <div id="page"></div>
                    </div>
                </div>
                <div id="secondaryContent">
                    <p text-align="center"></p>
                </div>
                <div class="clear"></div>
            <div style="display:none" id ="isFile"></div>
        </div>
    </div>
    <div id="footer">
            <p>Copyright &copy; 2015</p>
    </div>
</body>
</html>