<?php
session_start();
@include("../config.php");
@include("sheet.php");

function genshnam($jsOper, $id){
	if(get_magic_quotes_gpc()) {
            $jsOper  =  stripslashes($jsOper);
        }
	$oper = json_decode($jsOper);
	if($oper) {
		echo '№ '.trim($oper->num).' от '.trim($oper->datdoc).' '.trim($oper->cashier);//.' '.($oper->sum);
        }
	else {
		echo '';
        }
}

function runDoc($param, $id){
    $prm = explode(',', $param);
    $revenue = new sheet($id);
    foreach($revenue->b->tabl as &$value) {
        if ($value[2]>$value[3])  {
            $client = new sheet($value[0]);
            $waybill = $revenue->b->oper->num.' от '.$revenue->b->oper->datdoc.' '.$revenue->b->oper->cashier.' '.$revenue->b->oper->purchaseTotal;
            $client->addHistory(array($id, date("d.m.Y"), $client->b->oper->debt, $value[3]-$value[2], $waybill, $_SESSION['user'])) ;
            $client->b->oper->debt -= $value[2]-$value[3];
            $client->n = trim($client->b->oper->name).' Долг '.trim($client->b->oper->debt);
            $client->save();
            $value[3] = $value[2];
        }
        if ($value[2]<$value[3])  {
            $client = new sheet($value[0]);
            if($client->b->oper->number >= $value[3]-$value[2]) {
                $waybill = $revenue->b->oper->num.' от '.$revenue->b->oper->datdoc.' '.$revenue->b->oper->cashier.' '.$revenue->b->oper->purchaseTotal;
                $client->addHistory(array( $id, date("d.m.Y"), $client->b->oper->number, $value[3]-$value[2], $client->b->oper->price, $waybill, $_SESSION['user'])) ;
                $client->b->oper->number -= $value[3]-$value[2];
                $client->save();
                $value[3] = $value[2];
            }
        }
    }
    $cashier = new sheet($revenue->b->oper->idcashier);
    $waybill2 = $revenue->b->oper->num.' от '.$revenue->b->oper->datdoc.' '.$revenue->b->oper->purchaseTotal;
    $cashier->addHistory(array( $id, date("d.m.Y"), $cashier->b->oper->balance, mb_substr($revenue->b->oper->purchaseTotal, 6, 100, 'utf-8')-mb_substr($revenue->b->oper->purchaseTotalRun, 6, 100, 'utf-8'), $waybill2, $_SESSION['user'])) ;
    $cashier->b->oper->balance += mb_substr($revenue->b->oper->purchaseTotal, 6, 100, 'utf-8')-mb_substr($revenue->b->oper->purchaseTotalRun, 6, 100, 'utf-8');
    $cashier->n = trim($cashier->b->oper->name).' Остаток '.trim($cashier->b->oper->balance);
    $cashier->save();
    $revenue->b->oper->purchaseTotalRun = $revenue->b->oper->purchaseTotal;
    $revenue->addHistory(array( $id, date("d.m.Y"), $waybill2.' '.$revenue->b->oper->cashier, $_SESSION['user'])) ;
    $revenue->save();
}


$_POST['func']($_POST['param'], $_POST['id']);
