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
    $exp = new sheet($id);
    foreach($exp->b->tabl as &$value) {
        if ($value[2] > $value[3])  {
            $expItem = new sheet($value[0]);
            $waybill = $exp->b->oper->num.' от '.$exp->b->oper->datdoc.' '.$exp->b->oper->cashier.' '.$exp->b->oper->purchaseTotal;
            $expItem->addHistory(array($id, date("d.m.Y"), $expItem->b->oper->balance, $value[2]-$value[3], $waybill, $_SESSION['user'])) ;
            $expItem->b->oper->balance += $value[2]-$value[3];
            $expItem->n = trim($expItem->b->oper->name).' Остаток '.trim($expItem->b->oper->balance);
            $expItem->save();
            $value[3] = $value[2];
        }
        if ($value[2] < $value[3])  {
            $expItem = new sheet($value[0]);
            if($expItem->b->oper->number >= $value[3]-$value[2]) {
                $waybill = $exp->b->oper->num.' от '.$exp->b->oper->datdoc.' '.$exp->b->oper->cashier.' '.$exp->b->oper->purchaseTotal;
                $expItem->addHistory(array( $id, date("d.m.Y"), $expItem->b->oper->number, $value[3]-$value[2], $expItem->b->oper->price, $waybill, $_SESSION['user'])) ;
                $expItem->b->oper->number -= $value[3]-$value[2];
                $expItem->save();
                $value[3] = $value[2];
            }
        }
    }
    $cashier = new sheet($exp->b->oper->idcashier);
    $waybill2 = $exp->b->oper->num.' от '.$exp->b->oper->datdoc.' '.$exp->b->oper->purchaseTotal;
    $cashier->addHistory(array( $id, date("d.m.Y"), $cashier->b->oper->balance, -(mb_substr($exp->b->oper->purchaseTotal, 6, 100, 'utf-8')-mb_substr($exp->b->oper->purchaseTotalRun, 6, 100, 'utf-8')), $waybill2, $_SESSION['user']));
    $cashier->b->oper->balance -= mb_substr($exp->b->oper->purchaseTotal, 6, 100, 'utf-8') - mb_substr($exp->b->oper->purchaseTotalRun, 6, 100, 'utf-8');
    $cashier->n = trim($cashier->b->oper->name).' Остаток '.trim($cashier->b->oper->balance);
    $cashier->save();
    $exp->b->oper->purchaseTotalRun = $exp->b->oper->purchaseTotal;
    $exp->addHistory(array( $id, date("d.m.Y"), $waybill2.' '.$exp->b->oper->cashier, $_SESSION['user'])) ;
    $exp->save();
}


$_POST['func']($_POST['param'], $_POST['id']);
