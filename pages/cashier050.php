<div class="doc">
    <div class="docHead">
        <h2>
            <span onClick="createInputField(this)" name="name"    class="docProperty firstProperty">Кассир</span>
            Остаток
            <span onClick="createInputField(this)" name="balance" class="docProperty">0.00</span>
            грн
        </h2>
    </div>
    <div class="lastOperationDateContainer">
        Последняя операция:
        <span onClick="createInputField(this)" name="lastOperationDate" class='docProperty'></span>
    </div>
    <div class="docHistoryContainer hidden">
        <table class="docHistory">
            <tr >
                <th >Дата</th>
                <th >Остаток</th>
                <th >Сумма</th>
                <th >Накладная</th>
                <th >Автор</th>
            </tr>
            <tr class="template hidden">
                <td class="date"></td>
                <td class="balance"></td>
                <td class="sum"></td>
                <td class="waybill linkColumn"></td>
                <td class="author"></td>
            </tr>
        </table>
    </div>
    <div class="docMenu">
        <a href = "#" name = "save"        onClick = "save(this)" >Сохранить</a> |
        <a href = "#" name = "load"        onClick = "Selsheet(this, 'Выберите кассира', 'load', 50)" >Выбрать</a> |
        <a href = "#" name = "delete"      onClick = "deleteDoc(this)">Удалить</a> |
        <a href = "#" name = "showHistory" onClick = "showHistory(this);">История</a><br />
        <p class="messageBox"></p>
    </div>
    <div class="objectData hidden">
        {
        "extension": 50,
        "library": "pages/cashier050l.php",
        "nameForm": ["name", " Остаток ", "balance"],
        "delMsg": "Кассир успешно удален",
        "saveMsg": "Кассир успешно сохранен",
        "cancelSaveMsg": "Введите имя кассира",
        "defaultTabName": "Кассир",
        "link": "pages/cashier050.php",
        "isSaved": true,
        "id": "",
        "saveType": "save_new",
        "firstProperty": "Кассир",
        "docData": {"tabl": [], "oper": {}}
        }
    </div>
</div>
<!--<div class="doc">
        <div class = "docHead">
		<h2>
			<div>
				<span onClick = "createInputField(this)" name = "name" class = 'docProperty'>Кассир</span>
				Остаток <span onClick = "createInputField(this)" name = "balance" class = 'docProperty'>0,00</span>грн
			</div>
			<span class = "lastOperationDate" style = "font-size:8pt;">Последняя операция: <span onClick = "createInputField(this)" name = "lastOperationDate"></span></span>
		</h2>
	</div>
	<div class = "docHistoryContainer" style = "display: none">
		<table>
			<tr class = head>
				<th >Дата</th>
				<th >Остаток</th>
				<th >Сумма</th>
				<th >Документ</th>
				<th >Автор</th>
			</tr>
			<tr class = "rowTemplate" style = "display: none">
				<td style = "max-width:20px" name = "date"></td>
				<td style = "max-width:10px" name = "balance">0</td>
				<td style = "max-width:10px" name = "sum">0</td>
				<td style = "max-width:30px" name = "name">0</td>
				<td style = "max-width:15px" name = "author">0</td>
			</tr>
		</table>
	</div>
	<div class = "docMenu">
		<a href = "#" name = "save" onClick = "save(this)" >Сохранить</a> |
		<a href = "#" name = "load" onClick = "Selsheet(this, 'Выберите кассира', 'load', 50)" >Выбрать</a> |
		<a href = "#" name = "delete" onClick = "deleteDoc(this)">Удалить</a> |
                <a href = "#" name = "showHistory" onClick = "showHistory(this);">История</a><br />
                <p class = "messageBox"></p>
	</div>
        <p class = "objectData" style = "display:none;">{"extension": 50,
                                                           "library": "pages/cashier050l.php",
                                                           "nameForm": ["name", " Остаток ", "balance"],
                                                           "delMsg": "Кассир успешно удален",
                                                           "saveMsg": "Кассир успешно сохранен",
                                                           "cancelSaveMsg": "Введите имя кассира",
                                                           "defaultTabName": "Кассир",
                                                           "link": "pages/cashier050.php",
                                                           "isSaved": true,
                                                           "id": "",
                                                           "saveType": "save_new",
                                                           "firstProperty": "Кассир",
                                                           "docData": {"tabl": [], "oper": {}}
                                                      }</p>
</div>-->