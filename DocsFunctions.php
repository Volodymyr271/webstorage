<?php

function saveDoc($userID, $saveType, $docName, $docExtension, $docData, $docID = 0) {
    $objectDataChanges = array();
    if ($saveType == 'save_new') {
        $currDate = date("Y-m-d");
        mysql_query("INSERT INTO sh (a, n, x, d, b) VALUES('$userID', '$docName', '$docExtension', '$currDate', '$docData')");
        $getDocID = mysql_query("SELECT i FROM sh WHERE n = '$docName' AND a = '$userID'");
        $objectDataChanges['saveType'] = 'save_curr';
        $objectDataChanges['id'] = mysql_result($getDocID, 0);
    }
    else {
        mysql_query("UPDATE sh SET n = '$docName', b = '$docData' WHERE i ='$docID' AND a = '$userID'");

    }
    $objectDataChanges['saveStatus'] = 'yes';
    return json_encode(array('err_msg' => '', 'objectDataChanges' => $objectDataChanges));
}

function loadDocsList($userID, $docsExtension, $funcName) {
    $query = mysql_query("SELECT n, i FROM sh WHERE a = '$userID' AND x = '$docsExtension' ORDER BY d DESC");
    $response = '';
    while(($result = mysql_fetch_assoc($query)) != false) {
        if ($result['n'] != false ) {
            $docName = $result['n'];
            $docID = $result['i'];
            $response .= "<a class='modal_id' href='#' onclick='$funcName($docID)'>$docName</br></a>";
        }
    }
    return $response;
}

function loadDoc($userID, $docID) {
    $query = mysql_query("SELECT b, x FROM sh WHERE i = '$docID' AND a = '$userID'");
    $result = mysql_fetch_assoc($query);
    if (json_decode($result['b'], true) == null) {
        return 'Такого документа не существует';
    }
    $objectDataChanges = array('id' => $docID,
                               'docData' => json_decode($result['b'], true),
                               'saveStatus' => 'yes',
                               'saveType' => 'save_curr',
                               'extension' => $result['x']);
    return json_encode(array('objectDataChanges' => $objectDataChanges, 'err_msg' => ''));
}

function deleteDoc($userID, $docID, $docExtension) {
    if ($docExtension <= 240 && $docExtension >= 220) {
        $query = mysql_query("SELECT i FROM sh WHERE x = '$docExtension' AND a = '$userID' ORDER BY d DESC LIMIT 1");
        if (mysql_result($query, 0) != $docID) {
            return json_encode(array('objectDataChanges' => array(), 'err_msg' => 'error'));
        }
    }
    mysql_query("DELETE FROM sh WHERE i ='$docID' AND a = '$userID'");
    $objectDataChanges = array('id' => '',
                           'saveType' => 'save_new',
                           'saveStatus' => 'yes',
                           'docData' => '{"tabl": [], "oper": {}}');
    return json_encode(array('objectDataChanges' => $objectDataChanges, 'err_msg' => ''));
}

function loadDocHistory($userID, $docID) {
    $query = mysql_query("SELECT h FROM sh WHERE i = '$docID' AND a = '$userID'");
    return json_encode(array('history' => json_decode(mysql_result($query, 0)), 'err_msg' => ''));
}

function getNumberOfDocs($userID, $docsExtension) {
    $query = mysql_query("SELECT i FROM sh WHERE a = '$userID' AND x = '$docsExtension'");
    return mysql_num_rows($query);
}

