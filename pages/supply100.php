<div class="doc">
    <div class="docHead">
        <h2>
            <span style="font-size:14px;">№</span>
            <span onClick="createInputField(this)" name="num" class="docProperty">хххх</span>
            <span style="font-size:14px;">от</span>
            <span onClick="createInputField(this)" name="datdoc" class="docProperty"></span>
            <span style="font-size:14px;">Поставщик</span>
            <span name="supplier" class='docProperty'>Не выбран</span>
            <span name="idsupplier" class='docProperty hidden'>0</span>
            <span name="draft" class='docProperty hidden'>no</span>
            <span name="purchaseTotalRun" class='docProperty hidden'>0</span>
        </h2>
    </div>
    <div class="lastOperationDateContainer">
        Оприходовано
        <span onClick="createInputField(this)" name="lastOperationDate" class='docProperty'></span>
    </div>
    <div class="childDocsContainer">
        <table class="childDocs">
            <tr>
                <th >Наименование</th>
                <th >К. накл</th>
                <th >К. факт</th>
                <th >Цен. зак</th>
                <th >Сумма </th>
                <th >%</th>
                <th >Ц. прод</th>
                <th >Сумма</th>
            </tr>
            <tr class="template hidden">
                <td name="name"         style="max-width: 90px" class="linkColumn stringData"></td>
                <td name="number"  style="max-width: 10px" onClick="createInputFieldInTabl(this)"></td>
                <td name="actualNumber" style="max-width: 10px"></td>
                <td name="priceBeforeMarkup"  style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
                <td name="sumBeforeMarkup"    style="max-width: 20px" class="totalPart"></td>
                <td name="markup"       style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
                <td name="priceAfterMarkup" style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
		<td name="sumAfterMarkup"   style="max-width: 20px"></td>
            </tr>
	</table>
    </div>
    <div class="total">
        Итого
        <span name="purchaseTotal" class='docProperty'>0,00</span>
    </div>
    <div class="docHistoryContainer hidden">
        <table class="docHistory">
            <tr>
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
        <a href="#" name="addgoods" onClick="Selsheet(this, 'Выберите товар', 'insertGoodsInSupply', 10)" >Товар</a>  |
        <a href="#" name="selectsupplier" onClick="Selsheet(this, 'Выберите поставщика', 'insertSupplierInSupply', 20)">Поставщик</a> |
        <a href="#" name="delete" onClick="deleteDoc(this)">Удалить</a> |
        <a href="#" name="save" onClick="save(this)">Сохранить</a> |
        <a href="#" name="runDoc" onClick="runDoc(this, 'pages/supply100l.php','runDoc', '')">Провести</a> |
        <a href="#" name="load" onClick="Selsheet(this, 'Выберите приход', 'load', 100)">Выбрать</a> |
        <a href="#" name="loadHistory" onClick="showHistory(this)">История</a> |
        <a href="#" name="printDocument" onClick="printDoc(this)">Распечатать</a>
        <p class="messageBox"></p>
    </div>
    <div class="objectData hidden">
       {"extension": 100,
        "library": "pages/supply100l.php",
        "nameForm": ["№ ", "num", " от ", "datdoc", " ", "supplier"],
        "delMsg": "Приход успешно удален",
        "saveMsg": "Приход успешно сохранен",
        "cancelSaveMsg": "Введите номер прихода",
        "defaultTabName": "Приход",
        "link": "pages/supply100.php",
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
		 		<span style="font-size:14px;"> № </span><span onClick="createInputField(this)" name="num" class='docProperty'>хххх</span>
				<span style="font-size:14px;"> от </span><span onClick="createInputField(this)" name="datdoc" class='docProperty'></span>
				<span style="font-size:14px;"> Поставщик </span><span  name="supplier" class="docProperty">Не выбран</span>
				<span style="display: none" name="idsupplier" class="docProperty">0</span>
			</div>
			<span class="lastOperationDate" style="font-size:8pt;">Оприходовано <span onClick="createInputField(this)" name="lastOperationDate" class='docProperty'></span></span>
		</h2>
		<span name="draft" style="display: none" class='docProperty'>no</span>
		<table class="childDocs">
			<tr class="head main">
				<th >Наименование</th>
				<th >К. накл</th>
				<th >К. факт</th>
				<th >Цен. зак</th>
				<th >Сумма </th>
				<th >%</th>
				<th >Ц. прод</th>
				<th >Сумма</th>
			</tr>
			<tr class="rowTemplate main" style="display: none">
				<td name="name" style="max-width: 90px"></td>
				<td name="number" style="max-width: 10px" onClick="createInputFieldInTabl(this)"></td>
				<td name="actualNumber" style="max-width: 10px"></td>
				<td name="priceBeforeMarkup" style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
				<td name="sumBeforeMarkup" style="max-width: 20px"></td>
				<td name="markup" style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
				<td name="priceAfterMarkup" style="max-width: 15px" onClick="createInputFieldInTabl(this)"></td>
				<td name="sumAfterMarkup" style="max-width: 20px"></td>
			</tr>
		</table>
		<h2><div >
		<span style="float: right;" name="purchaseTotal" class='docProperty'>Итого 0,00 </span>
		<span style="display: none" name="purchaseTotalRun" class='docProperty'>0</span>
		</div>
		</h2>
	</div>
	<div class="docHistoryContainer" style="display: none">
		<table>
			<tr class="head history">
				<th >Дата кор</th>
				<th >Накладная</th>
				<th >Автор</th>
			</tr>
			<tr class="rowTemplate history" style="display: none">
				<td style="max-width:20px" name="date"></td>
				<td style="max-width:10px" name="waybill">0</td>
				<td style="max-width:15px" name="author">0</td>
			</tr>
		</table>
	</div>
	<div class="docMenu">
                <a href="#" name="addgoods" onClick="Selsheet(this, 'Выберите товар', 'insertGoodsInSupply', 10)" >Товар</a>  |
		<a href="#" name="selectsupplier" onClick="Selsheet(this, 'Выберите поставщика', 'insertSupplierInSupply', 20)">Поставщик</a> |
		<a href="#" name="delete" onClick="deleteDoc(this)">Удалить</a> |
		<a href="#" name="save" onClick="save(this)">Сохранить</a> |
		<a href="#" name="runDoc" onClick="runDoc(this, 'pages/supply100l.php','runDoc', '')">Провести</a> |
		<a href="#" name="load" onClick="Selsheet(this, 'Выберите приход', 'load', 100)">Выбрать</a> |
		<a href="#" name="loadHistory" onClick="showHistory(this)">История</a> |
                <a href="#" name="printDocument" onClick="printDoc(this)">Распечатать</a>
                <p class="messageBox"></p>
	</div>
        <p class="objectData" style="display:none;">{"extension": 100,
                                                       "library": "pages/supply100l.php",
                                                       "nameForm": ["№ ", "num", " от ", "datdoc", " ", "supplier"],
                                                       "delMsg": "Приход успешно удален",
                                                       "saveMsg": "Приход успешно сохранен",
                                                       "cancelSaveMsg": "Введите номер прихода",
                                                       "defaultTabName": "Приход",
                                                       "link": "pages/supply100.php",
                                                       "isSaved": true,
                                                       "id": "",
                                                       "saveType": "save_new",
                                                       "firstProperty": "хххх",
                                                       "docData": {"tabl": [], "oper": {}}
                                                      }</p>
 </div> -->