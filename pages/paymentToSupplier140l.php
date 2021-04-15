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
    $payment = new sheet($id);
    foreach($payment->b->tabl as &$value) {
        if ($value[2]>$value[3])  {
            $supplier = new sheet($value[0]);
            $waybill = $payment->b->oper->num.' от '.$payment->b->oper->datdoc.' '.$payment->b->oper->cashier.' '.$payment->b->oper->purchaseTotal;
            $supplier->addHistory(array($id, date("d.m.Y"), $supplier->b->oper->debt, $value[3]-$value[2], $waybill, $_SESSION['user'])) ;
            $supplier->b->oper->debt += $value[3]-$value[2];
            $supplier->n = trim($supplier->b->oper->name).' Долг '.trim($supplier->b->oper->debt);
            $supplier->save();
            $value[3] = $value[2];
        }
        if ($value[2]<$value[3])  {
            $supplier = new sheet($value[0]);
            if($supplier->b->oper->number >= $value[3]-$value[2]) {
                $waybill = $payment->b->oper->num.' от '.$payment->b->oper->datdoc.' '.$payment->b->oper->cashier.' '.$payment->b->oper->purchaseTotal;
                $supplier->addHistory(array( $id, date("d.m.Y"), $supplier->b->oper->number, $value[3]-$value[2], $supplier->b->oper->price, $waybill, $_SESSION['user'])) ;
                $supplier->b->oper->number -= $value[3]-$value[2];
                $supplier->save();
                $value[3] = $value[2];
            }
        }
    }
    $cashier = new sheet($payment->b->oper->idcashier);
    $waybill2 = $payment->b->oper->num.' от '.$payment->b->oper->datdoc.' '.$payment->b->oper->purchaseTotal;
    $cashier->addHistory(array( $id, date("d.m.Y"), $cashier->b->oper->balance, -(mb_substr($payment->b->oper->purchaseTotal, 6, 100, 'utf-8')-mb_substr($payment->b->oper->purchaseTotalRun, 6, 100, 'utf-8')), $waybill2, $_SESSION['user'])) ;
    $cashier->b->oper->balance -= mb_substr($payment->b->oper->purchaseTotal, 6, 100, 'utf-8')-mb_substr($payment->b->oper->purchaseTotalRun, 6, 100, 'utf-8');
    $cashier->n = trim($cashier->b->oper->name).' Остаток '.trim($cashier->b->oper->balance);
    $cashier->save();
    $payment->b->oper->purchaseTotalRun = $payment->b->oper->purchaseTotal;
    $payment->addHistory(array( $id, date("d.m.Y"), $waybill2.' '.$payment->b->oper->cashier, $_SESSION['user'])) ;
    $payment->save();
}


$_POST['func']($_POST['param'], $_POST['id']);
