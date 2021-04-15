<?php
session_start();

@include_once('config.php');
include ('AccountFunctions.php');
if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
    $login = $_COOKIE['login'];
    $pass = md5($_COOKIE['password']);
    $query = mysql_query("SELECT i FROM users WHERE login='$login' AND pass='$pass'");
    if (mysql_num_rows($query)) {
        $userID = mysql_result($query, 0);
    }
    include ('DocsFunctions.php');
}

switch ($_POST['operation']) {
    case 'loadMenu':
        $response = loadMenu($userID);
        break;

    case 'saveDoc':
        $response = saveDoc($userID, $_POST['saveType'], addslashes($_POST['docName']), $_POST['extension'], addslashes($_POST['docData']), $_POST['id']);
        break;

    case 'loadDocsList':
        $response = loadDocsList($userID, $_POST['extension'], $_POST['go']);
        break;

    case 'loadUsersList':
        $response = loadUsersList($userID, $_POST['go']);
        break;

    case 'loadDoc':
        $response = loadDoc($userID, $_POST['id']);
        break;

    case 'deleteDoc':
        $response = deleteDoc($userID, $_POST['id'], $_POST['extension']);
        break;

    case 'loadDocHistory':
        $response = loadDocHistory($userID, $_POST['id']);
        break;

    case 'getNumberOfDocs':
        $response = getNumberOfDocs($userID, $_POST['extension']);
        break;

    case 'insideReg':
        $response = insideReg(trim($_POST['login']), trim($_POST['password']), trim($_POST['passwordRepeat']), trim($_POST['name']), $_POST['menuType'], $userID);
        break;

    case 'outsideReg':
        $response = outsideReg(trim($_POST['login']), trim($_POST['password']), trim($_POST['passwordRepeat']), $_SESSION['code'], $_POST['usersCode']);
        break;

    case 'authorization':
        $response = authorization(trim($_POST['login']), trim($_POST['password']));
        break;

    case 'newPassword':
        $response = newPassword(trim($_POST['login']));
        break;

    case 'selectUser':
        $response = selectUser($userID, $_POST['id']);
        break;

    case 'editUser':
        $response = editUser($userID, $_POST['id'], $_POST['attr']);
}
echo $response;
/*case 'updateSQL':
    $quqery = mysql_query("SELECT B, I, H, D FROM sh WHERE a != 0");
    while (($result =mysql_fetch_assoc($quqery))!= false) {
        /*$update = str_replace("postav", "supplier", $result['B']);
        $update = str_replace("pokupa", "client", $update);
        $update = str_replace("itogo2p", "total2run", $update);
        $update = str_replace("itogo2", "total2", $update);
         *

        //echo
        preg_match_all('/"\d\d\.\d\d\.\d\d"/', $result["B"], $matches);
        foreach($matches[0] as $value) {
            $new = '"'.substr(substr($value, 1, -1), 0, 6).'20'.substr($value, 7, 8);
            echo $value.'        '.$new."\n";
            //$result["H"] = str_replace($value, $new, $result["H"]);
        }
        //var_dump($result["H"]);
        // $result['D'].'      '.preg_replace('/\d\d-\d\d-\d\d/', )
        //mysql_query('UPDATE sh SET h="'.addslashes($result["H"]).'" WHERE i ='.$result['I']);
        */


