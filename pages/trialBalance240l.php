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
        $q = mysql_query("SELECT ADDDATE(max(D),INTERVAL 1 MONTH) as Dat FROM `sh` WHERE X=240 and A=".$_SESSION['UID']." and I<>".$id." group by A");
        while($row = @mysql_fetch_assoc($q)) {
            $reportDate=$row['Dat'];
            calculation($id,$reportDate);
        }
    }
}
function recalculation($param, $id){
    $prm=explode(',',$param);
    $q = mysql_query("SELECT D as Dat FROM `sh` WHERE A=".$_SESSION['UID']." and I=".$id." and X=240");
    if($row = @mysql_fetch_assoc($q)) {
        $reportDate=$row['Dat'];
    	calculation($id,$reportDate);
    }
}
function calculation($id,$reportDate){
    $trialBal = new sheet($id);
    $trialBal->b->tabl='';
    $trialBal->b->oper->datdoc=date('d.m.Y',strtotime($reportDate));
    $trialBal->b->oper->num=rusDate('F Y',strtotime($reportDate)) ;
    $trialBal->n=rusDate('F Y',strtotime($reportDate)).' г' ;
    $trialBal->d=date('Y-m-d',strtotime($reportDate));
    $q = mysql_query("SELECT I FROM sh WHERE X=10 AND A=".$_SESSION['UID']);
    $trialBal->b->oper->balance=0;
    for($i = 1; $row = @mysql_fetch_assoc($q); $i++){
        $goods= new sheet($row['I']);
        $supply = 0; $shipment = 0; $openingBalance = 0; $finalBalance = 0; $ESflag=true;
        if ($goods->h != NULL) {
            foreach($goods->h as &$val) {
                $unixGoodsDate = strtotime($val[1]);
                $unixRepDate = strtotime($reportDate);

                if ($unixGoodsDate < $unixRepDate) {  // && $unixGoodsDate >= dateAdd('m',-1,$unixRepDate)) {
                    $openingBalance += $val[3];
                }
                if($unixGoodsDate >= $unixRepDate && $unixGoodsDate < dateAdd('m',1,$unixRepDate)) {
                    if($ESflag) {
                        $finalBalance=$val[2]+$val[3]; $ESflag=false;
                    }
                    if($val[3]>0)  {
                        $supply+=$val[3]; }
                    else {
                        $shipment+=$val[3];
                    }
                }
            }
        }
        $checkStr = $supply.$shipment.$finalBalance;
        if (preg_match("/[1-9]/", $checkStr)) {
            $trialBal->addRow(array($row['I'],$i,$goods->b->oper->name,$openingBalance,$supply,$shipment,$finalBalance));
            $trialBal->b->oper->balance+=$finalBalance;
        }
    }
    $trialBal->addHistory(array( $id,date("d.m.Y"),$_SESSION['user'])) ;
    $trialBal->save();
}

$_POST['func']($_POST['param'],$_POST['id']);
    //$prevDate -> sub(strtotime('-1 month'));
   /*$prevBalanceDate = date('Y-m-d', strtotime($reportDate.'-1 month'));
    $prevQ = mysql_query("SELECT i FROM sh WHERE x=240 AND d='".$prevBalanceDate."' AND a = ".$_SESSION['UID']);
    $prevResult = mysql_fetch_array($prevQ);
    $prevDoc = new sheet($prevResult[0]);
    $prevBalanceTabl = $prevDoc->b->tabl; */
