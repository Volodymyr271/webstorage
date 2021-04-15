<div class="doc">
    <div class="docHead">
        <h2>
            <span style="font-size:14px;">№</span>
            <span onClick="createInputField(this)" name="num" class="docProperty">хххх</span>
            <span style="font-size:14px;">от</span>
            <span onClick="createInputField(this)" name="datdoc" class="docProperty"></span>
            <span style="font-size:14px;">Кассир</span>
            <span name="cashier" class='docProperty'>Не выбран</span>
            <span name="idcashier" class='docProperty hidden'>0</span>
            <span name="draft" class='docProperty hidden'>no</span>
            <span name="purchaseTotalRun" class='docProperty hidden'>0</span>
        </h2>
    </div>
    <div class="lastOperationDateContainer">
        Проведено
        <span onClick="createInputField(this)" name="lastOperationDate" class='docProperty'></span>
    </div>
    <div class="childDocsContainer">
        <table class="childDocs">
            <tr >
                <th >Поставщик</th>
                <th >Сумма</th>
                <th >Сумма пров</th>
                <th >Примечание</th>
            </tr>
            <tr class="template hidden">
                <td name="name"      style="max-width: 90px" class="linkColumn"></td>
                <td name="sum"  style="max-width: 15px" onClick="createInputFieldInTabl(this)" class="totalPart"></td>
                <td name="actualSum" style="max-width: 20px"></td>
                <td name="note"      style="max-width: 20px" onClick="createInputFieldInTabl(this)" class="stringData"></td>
            </tr>
	</table>
    </div>
    <div class="total">
        Итого
        <span name="purchaseTotal" class='docProperty'> 0,00</span>
    </div>
    <div class="docHistoryContainer hidden">
        <table class="docHistory">
            <tr >
                <th >Дата кор</th>
                <th >Накладная</th>
                <th >Автор</th>
            </tr>
            <tr class="template hidden">
                <td style="max-width:20px" name="date"></td>
                <td style="max-width:10px" name="waybill">0</td>
                <td style="max-width:15px" name="author">0</td>
            </tr>
        </table>
    </div>
    <div class="docMenu">
        <a href="#" name="addSupplier" onClick="Selsheet(this, 'Выберите поставщика', 'InsPart', 20);" >Поставщик</a>  |
        <a href="#" name="selectcashier" onClick="Selsheet(this, 'Выберите кассира', 'insertCashier', 50);" >Кассир</a> |
        <a href="#" name="delete" onClick="deleteDoc(this)">Удалить</a> |
        <a href="#" name="save" onClick="save(this)">Сохранить</a> |
        <a href="#" name="runDoc" onClick="runDoc(this, 'pages/paymentToSupplier140l.php','runDoc', '')">Провести</a> |
        <a href="#" name="load" onClick="Selsheet(this, 'Выберите оплату поставщику', 'load', 140)">Выбрать</a> |
        <a href="#" name="loadHistory" onClick="showHistory(this)">История</a>
        <p class="messageBox"></p>
    </div>
    <div class="objectData hidden">
        {
        "extension": 140,
        "library": "pages/paymentToSupplier140l.php",
        "nameForm": ["№ ", "num", " от ", "datdoc", " ", "cashier"],
        "delMsg": "Оплата поставщику успешно удалена",
        "saveMsg": "Оплата поставщику успешно сохранена",
        "cancelSaveMsg": "Введите номер оплаты поставщику",
        "defaultTabName": "Оплата поставщику",
        "link": "pages/paymentToSupplier140.php",
        "isSaved": true,
        "id": "",
        "saveType": "save_new",
        "firstProperty": "хххх",
        "docData": {"tabl": [], "oper": {}}
        }
    </div>
</div>
<!--<div class="doc">
	<div class="docHead">
		<h2>
			<div>
		 		<span style="font-size:14px;"> № </span><span onClick="createInputField(this)" name="num" class="docProperty">хххх</span>
				<span style="font-size:14px;"> от </span><span onClick="createInputField(this)" name="datdoc" class="docProperty"></span>
				<span style="font-size:14px;"> Кассир </span><span  name="cashier" class='docProperty'>Не выбран</span>
				<span style="display: none" name="idcashier" class='docProperty'>0</span>
			</div>
			<span class="lastOperationDate" style="font-size:8pt;">Проведено <span onClick="createInputField(this)" name="lastOperationDate" class='docProperty'></span></span>
		</h2>
		<span name="draft" style="display: none" class='docProperty'>no</span>
		<table class="childDocs">
			<tr >
				<th >Поставщик</th>
				<th >Сумма</th>
				<th >Сумма пров</th>
				<th >Примечание</th>
			</tr>
			<tr class="rowTemplate" style="display: none">
				<td name="name" style="max-width: 90px"></td>
				<td class="sum" style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
				<td class="actualSum" style="max-width: 20px"></td>
				<td class="note stringData" style="max-width: 20px" onClick="createInputFieldInTabl(this)"></td>
			</tr>
		</table>
		<h2><div >
		<span style="float: right;" name="purchaseTotal" class='docProperty'>Итого 0,00 </span>
		<span style="display: none;" name="purchaseTotalRun" class='docProperty'>0</span>
		</div>
		</h2>
	</div>
	<div class="docHistoryContainer" style="display: none">
		<table>
			<tr >
				<th >Дата кор</th>
				<th >Накладная</th>
				<th >Автор</th>
			</tr>
			<tr class="rowTemplate" style="display: none">
				<td style="max-width:20px" name="date"></td>
				<td style="max-width:10px" name="waybill">0</td>
				<td style="max-width:15px" name="author">0</td>
			</tr>
		</table>
	</div>
	<div class="docMenu">
                <a href="#" name="addSupplier" onClick="Selsheet(this, 'Выберите поставщика', 'InsPart', 20);" >Поставщик</a>  |
		<a href="#" name="selectcashier" onClick="Selsheet(this, 'Выберите кассира', 'insertCashier', 50);" >Кассир</a> |
		<a href="#" name="delete" onClick="deleteDoc(this)">Удалить</a> |
		<a href="#" name="save" onClick="save(this)">Сохранить</a> |
		<a href="#" name="runDoc" onClick="runDoc(this, 'pages/paymentToSupplier140l.php','runDoc', '')">Провести</a> |
		<a href="#" name="load" onClick="Selsheet(this, 'Выберите оплату поставщику', 'load', 140)">Выбрать</a> |
		<a href="#" name="loadHistory" onClick="showHistory(this)">История</a>
                <p class="messageBox"></p>
		</div>
        <p class="objectData" style="display:none;">{"extension": 140,
                                                     "library": "pages/paymentToSupplier140l.php",
                                                     "nameForm": ["№ ", "num", " от ", "datdoc", " ", "cashier"],
                                                     "delMsg": "Оплата поставщику успешно удалена",
                                                     "saveMsg": "Оплата поставщику успешно сохранена",
                                                     "cancelSaveMsg": "Введите номер оплаты поставщику",
                                                     "defaultTabName": "Оплата поставщику",
                                                     "link": "pages/paymentToSupplier140.php",
                                                     "isSaved": true,
                                                     "id": "",
                                                     "saveType": "save_new",
                                                     "firstProperty": "хххх",
                                                     "docData": {"tabl": [], "oper": {}}
                                                    }</p>
 </div>-->