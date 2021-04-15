<div class="doc">
    <div class="docHead">
        <h2>
            <span style="font-size:14px;">№</span>
            <span onClick="createInputField(this)" name="num" class="docProperty">хххх</span>
            <span style="font-size:14px;">от</span>
            <span onClick="createInputField(this)" name="datdoc" class="docProperty"></span>
            <span style="font-size:14px;">Покупатель</span>
            <span name="client" class='docProperty'>Не выбран</span>
            <span name="idclient" class='docProperty hidden'>0</span>
            <span name="draft" class='docProperty hidden'>no</span>
            <span name="sellingTotalRun" class='docProperty hidden'>0</span>
        </h2>
    </div>
    <div class="lastOperationDateContainer">
        Отгружено
        <span onClick="createInputField(this)" name="lastOperationDate" class='docProperty'></span>
    </div>
    <div class="childDocsContainer">
        <table class="childDocs">
            <tr >
           	<th >Наименование</th>
                <th >К. заяв</th>
                <th >К. факт</th>
                <th >Цен. прод</th>
                <th >Сумма </th>
                <th >%</th>
                <th >Ц. Отп</th>
                <th >Сумма</th>
            </tr>
            <tr class="template hidden">
                <td name="name"            style="max-width: 90px" class="linkColumn stringData"></td>
                <td name="number"          style="max-width: 10px" onClick="createInputFieldInTabl(this)"></td>
                <td name="actualNumber"    style="max-width: 10px"></td>
                <td name="priceBeforeMarkup"    style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
                <td name="sumBeforeMarkup"      style="max-width: 20px" ></td>
                <td name="markup"          style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
                <td name="priceAfterMarkup"    style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
		<td name="sumAfterMarkup"      style="max-width: 20px" class="totalPart"></td>
            </tr>
	</table>
    </div>
    <div class="total">
        Итого
        <span name="sellingTotal" class='docProperty'> 0,00</span>
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
        <a href="#" name="addgoods"     onClick="Selsheet(this, 'Выберите товар', 'insertGoodsInShipment', 10)" >Товар</a>  |
        <a href="#" name="selectClient" onClick="Selsheet(this, 'Выберите покупателя', 'insertClientInShipment', 30)">Покупатель</a> |
        <a href="#" name="delete"       onClick="deleteDoc(this)">Удалить</a> |
        <a href="#" name="save"         onClick="save(this)">Сохранить</a> |
        <a href="#" name="runDoc"       onClick="runDoc(this, 'pages/shipment110l.php', 'runDoc', '')">Провести</a> |
        <a href="#" name="load"         onClick="Selsheet(this, 'Выберите отгрузку', 'load', 110)">Выбрать</a> |
        <a href="#" name="loadHistory"  onClick="showHistory(this)">История</a>
        <p class="messageBox"></p>
    </div>
    <div class="objectData hidden">
        {
        "extension": 110,
        "library": "pages/shipment110l.php",
        "nameForm": ["№ ", "num", " от ", "datdoc", " ", "client"],
        "delMsg": "Отгрузка успешно удалена",
        "saveMsg": "Отгрузка успешно сохранена",
        "cancelSaveMsg": "Введите номер отгрузки",
        "defaultTabName": "Отгрузка",
        "link": "pages/shipment110.php",
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
				<span style="font-size:14px;"> от </span><span onClick="createInputField(this)" name="datdoc" class="docProperty">12.03.2011</span>
				<span style="font-size:14px;"> Покупатель </span><span  name="client" class='docProperty'>Не выбран</span>
				<span style="display: none" name="idclient" class='docProperty'title="0">0</span>
			</div>
			<span class="lastOperationDate" style="font-size:8pt">Отгружено <span onClick="createInputField(this)" name="lastOperationDate" class='docProperty'>12.03.2011</span></span>
		</h2>
		<span name="draft" style="display: none" class='docProperty'>no</span>
		<table class="childDocs">
			<tr >
				<th >Наименование</th>
				<th >К. заяв</th>
				<th >К. факт</th>
				<th >Цен. прод</th>
				<th >Сумма </th>
				<th >%</th>
				<th >Ц. Отп</th>
				<th >Сумма</th>
			</tr>
			<tr class="rowTemplate" style="display: none">
				<td name="name" style="max-width: 90px"></td>
				<td name="number" style="max-width: 10px" onClick="createInputFieldInTabl(this)"></td>
				<td name="actualNumber" style="max-width: 10px"></td>
				<td name="priceAfterMarkup" style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
				<td name="sumAfterMarkup" style="max-width: 20px"></td>
				<td name="markup" style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
				<td name="priceAfterMarkup" style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
				<td name="sumAfterMarkup" style="max-width: 20px"></td>
			</tr>
		</table>
		<h2><div >
		<span style="float: right;" name="sellingTotal" class='docProperty'>Итого 0,00 </span>
		<span style="display: none" name="sellingTotalRun" class='docProperty'>0</span>
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
                <a href="#" name="addgoods" onClick="Selsheet(this, 'Выберите товар', 'insertGoodsInShipment', 10)" >Товар</a>  |
		<a href="#" name="selectClient" onClick="Selsheet(this, 'Выберите покупателя', 'insertClientInShipment', 30)">Покупатель</a> |
		<a href="#" name="delete" onClick="deleteDoc(this)">Удалить</a> |
		<a href="#" name="save" onClick="save(this)">Сохранить</a> |
		<a href="#" name="runDoc" onClick="runDoc(this, 'pages/shipment110l.php', 'runDoc', '')">Провести</a> |
		<a href="#" name="load" onClick="Selsheet(this, 'Выберите отгрузку', 'load', 110)">Выбрать</a> |
		<a href="#" name="loadHistory" onClick="showHistory(this)">История</a>
                <p class="messageBox"></p>
	</div>
        <p class="objectData" style="display:none;">{"extension": 110,
                                                       "library": "pages/shipment110l.php",
                                                       "nameForm": ["№ ", "num", " от ", "datdoc", " ", "client"],
                                                       "delMsg": "Отгрузка успешно удалена",
                                                       "saveMsg": "Отгрузка успешно сохранена",
                                                       "cancelSaveMsg": "Введите номер отгрузки",
                                                       "defaultTabName": "Отгрузка",
                                                       "link": "pages/shipment110.php",
                                                       "isSaved": true,
                                                       "id": "",
                                                       "saveType": "save_new",
                                                       "firstProperty": "хххх",
                                                       "docData": {"tabl": [], "oper": {}}
                                                      }</p>
 </div> -->