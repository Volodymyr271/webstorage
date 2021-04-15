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
        $q = mysql_query("SELECT ADDDATE(max(D),INTERVAL 1 MONTH) as Dat FROM `sh` WHERE X=220 and A=".$_SESSION['UID']." and I<>".$id." group by A");
        while($row = @mysql_fetch_assoc($q)) {
            $reportDate=$row['Dat'];
            calculation($id,$reportDate);
        }
    }
}
function recalculation($param, $id){
    $prm=explode(',',$param);
    $q = mysql_query("SELECT D as Dat FROM `sh` WHERE A=".$_SESSION['UID']." and I=".$id." and X=220");
    if($row = @mysql_fetch_assoc($q)) {
        $reportDate=$row['Dat'];
    	calculation($id,$reportDate);
    }
}
function calculation($id,$reportDate){
    $suppRep = new sheet($id);
    $suppRep->b->tabl='';
    $suppRep->b->oper->datdoc=date('d.m.Y',strtotime($reportDate));
    $suppRep->b->oper->num=rusDate('F Y',strtotime($reportDate)) ;
    $suppRep->n=rusDate('F Y',strtotime($reportDate)).' г' ;
    $suppRep->d=date('Y-m-d',strtotime($reportDate));
    /*$prevBalanceDate = date('Y-m-d', strtotime($reportDate.'-1 month'));
    $prevRepQuery = mysql_query("SELECT B FROM sh WHERE X=220 AND D=".$prevBalanceDate." AND A=".$_SESSION['UID']);
    $prevDocData = mysql_fetch_assoc($prevRepQuery);
    $decodedPDD = json_decode($prevDocData); */
    $suppRepQuery = mysql_query("SELECT I FROM sh WHERE X=20 AND A=".$_SESSION['UID']);
    $suppRep->b->oper->balance=0;
    for($i = 1; $row = @mysql_fetch_assoc($suppRepQuery); $i++){
        $supp= new sheet($row['I']);
        $supply = 0; $paySupp = 0; $openingBalance = 0; $finalBalance = 0; $ESflag=true;
        if ($supp->h != NULL) {
            foreach($supp->h as &$val) {
                $unixSuppDate = strtotime($val[1]);
                $unixRepDate = strtotime($reportDate);
                if ($unixSuppDate < $unixRepDate) { // && ($unixSuppDate >= dateAdd('m',-1,$unixRepDate))) {
                    $openingBalance += $val[3];
                }
                if($unixSuppDate >= $unixRepDate && $unixSuppDate < dateAdd('m',1,$unixRepDate)) {
                    if($ESflag) {
                        $finalBalance=$val[2]+$val[3]; $ESflag=false;
                    }
                    if($val[3]>0)  {
                        $supply+=$val[3]; }
                    else {
                        $paySupp+=$val[3];
                    }
                }
            }
        }
        $checkStr = $supply.$paySupp.$finalBalance;
        if (preg_match("/[1-9]/", $checkStr)) {
            $suppRep->addRow(array($row['I'],$i,$supp->b->oper->name,$openingBalance,$supply,$paySupp,$finalBalance));
            $suppRep->b->oper->balance+=$finalBalance;
        }
    }
    $suppRep->addHistory(array($id, date("d.m.Y"), $_SESSION['user'])) ;
    $suppRep->save();
}

$_POST['func']($_POST['param'],$_POST['id']);
