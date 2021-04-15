<?php
session_start();
@include("../config.php");
@include("sheet.php");

function genshnam($jsOper, $id){
	if(get_magic_quotes_gpc())
		$jsOper = stripslashes($jsOper);
	$oper=json_decode($jsOper);
	if($oper)
		echo trim($oper->num).' г';
	else
		echo '';
}
function newReport($param, $id){
    $prm = explode(',',$param);
    if (in_array('firstReport', $prm)) {
        $reportDate = date('Y-m-d', strtotime('01.'.$prm[0]));
        calculation($id, $reportDate);
    }
    else {
        $q = mysql_query("SELECT ADDDATE(max(D),INTERVAL 1 MONTH) as Dat FROM `sh` WHERE X=230 and A=".$_SESSION['UID']." and I<>".$id." group by A");
        while($row = @mysql_fetch_assoc($q)) {
            $reportDate=$row['Dat'];
            calculation($id,$reportDate);
        }
    }
}
function recalculation($param, $id){
    $prm=explode(',',$param);
    $q = mysql_query("SELECT D as Dat FROM `sh` WHERE A=".$_SESSION['UID']." and I=".$id." and X=230");
    if($row = @mysql_fetch_assoc($q)) {
        $reportDate=$row['Dat'];
    	calculation($id,$reportDate);
    }
}
function calculation($id,$reportDate){
    $clientsRep = new sheet($id);
    $clientsRep->b->tabl='';
    $clientsRep->b->oper->datdoc=date('d.m.Y',strtotime($reportDate));
    $clientsRep->b->oper->num=rusDate('F Y',strtotime($reportDate)) ;
    $clientsRep->n=rusDate('F Y',strtotime($reportDate)).' г' ;
    $clientsRep->d=date('Y-m-d',strtotime($reportDate));
    $q = mysql_query("SELECT I FROM sh WHERE X=30 AND A=".$_SESSION['UID']);
    $clientsRep->b->oper->balance=0;
    $unixRepDate = strtotime($reportDate);
    for($i = 1; $row = @mysql_fetch_assoc($q); $i++){
        $client= new sheet($row['I']);
        $shipment = 0; $revenue = 0; $openingBalance = 0; $finalBalance = 0; $ESflag=true;
        if ($client->h != NULL) {
            foreach($client->h as &$val) {
                $unixClientDate = strtotime($val[1]);
                if ($unixClientDate < $unixRepDate) { //&& $unixClientDate >= dateAdd('m',-1,$unixRepDate)) {
                    $openingBalance += $val[3];
                }
                if( $unixClientDate >= $unixRepDate && $unixClientDate < dateAdd('m',1,$unixRepDate)) {
                    if($ESflag) {
                        $finalBalance=$val[2]+$val[3]; $ESflag=false;
                    }
                    if($val[3]>0)  {
                        $shipment+=$val[3]; }
                    else {
                        $revenue+=$val[3];
                    }
                }
            }
        }
        $checkStr = $shipment.$revenue.$finalBalance;
        if (preg_match("/[1-9]/", $checkStr)) {
            $clientsRep->addRow(array($row['I'],$i,$client->b->oper->name,$openingBalance,$shipment,$revenue,$finalBalance));
            $clientsRep->b->oper->balance+=$finalBalance;
        }
    }
    $clientsRep->addHistory(array( $id,date("d.m.Y"),$_SESSION['user'])) ;
    $clientsRep->save();
}

$_POST['func']($_POST['param'],$_POST['id']);
