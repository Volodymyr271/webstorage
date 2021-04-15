<div class="doc">
    <div class="docHead">
        <h2>
            <span onClick="createInputField(this)" name="name"    class="docProperty firstProperty">Покупатель</span>
            Долг
            <span onClick="createInputField(this)" name="debt" class="docProperty">0.00</span>
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
                <th >Долг</th>
                <th >Сумма</th>
                <th >Накладная</th>
                <th >Автор</th>
            </tr>
            <tr class="template hidden">
                <td style = "max-width:20px" class="date"></td>
                <td style = "max-width:10px" class="debt"></td>
                <td style = "max-width:10px" class="sum"></td>
                <td style = "max-width:30px" class="waybill linkColumn"></td>
                <td style = "max-width:15px" class="author"></td>
            </tr>
        </table>
    </div>
    <div class="docMenu">
        <a href = "#" name = "save"        onClick = "save(this)" >Сохранить</a> |
        <a href = "#" name = "load"        onClick = "Selsheet(this, 'Выберите покупателя', 'load', 30)" >Выбрать</a> |
        <a href = "#" name = "delete"      onClick = "deleteDoc(this)">Удалить</a> |
        <a href = "#" name = "showHistory" onClick = "showHistory(this);">История</a>
        <p class="messageBox"></p>
    </div>
    <div class="objectData hidden">
        {
        "extension": 30,
        "library": "pages/client030l.php",
        "nameForm": ["name", " Долг ", "debt"],
        "delMsg": "Покупатель успешно удален",
        "saveMsg": "Покупатель успешно сохранен",
        "cancelSaveMsg": "Введите имя покупателя",
        "defaultTabName": "Покупатель",
        "link": "pages/client030.php",
        "isSaved": true,
        "id": "",
        "saveType": "save_new",
        "firstProperty": "Покупатель",
        "docData": {"tabl": [], "oper": {}}
        }
    </div>
</div>
<!--<div class="doc">
        <div class = "docHead">
		<h2>
			<div>
				<span onClick = "createInputField(this)" name = "name" class = 'docProperty'>Покупатель</span>
				Долг <span onClick = "createInputField(this)" name = "debt" class = 'docProperty'>0,00</span>грн
			</div>
			<span class = "lastOperationDate" style = "font-size:8pt;">Последняя операция: <span onClick = "createInputField(this)" name = "lastOperationDate"></span></span>
		</h2>
	</div>
	<div class = "docHistoryContainer" style = "display: none">
		<table>
			<tr class = head>
				<th >Дата</th>
				<th >Долг</th>
				<th >Сумма</th>
				<th >Документ</th>
				<th >Автор</th>
			</tr>
			<tr class = "rowTemplate" style = "display: none">
				<td style = "max-width:20px" name = "date"></td>
				<td style = "max-width:10px" name = "debt">0</td>
				<td style = "max-width:10px" name = "sum">0</td>
				<td style = "max-width:30px" name = "name">0</td>
				<td style = "max-width:15px" name = "author">0</td>
			</tr>
		</table>
	</div>
	<div class = "docMenu">
		<a href = "#" name = "save" onClick = "save(this)" >Сохранить</a> |
		<a href = "#" name = "load" onClick = "Selsheet(this, 'Выберите покупателя', 'load', 30)" >Выбрать</a> |
		<a href = "#" name = "delete" onClick = "deleteDoc(this)">Удалить</a> |
                <a href = "#" name = "showHistory" onClick = "showHistory(this);">История</a><br />
                <p class = "messageBox"></p>
	</div>
        <p class = "objectData" style = "display:none;">{"extension": 30,
                                                       "library": "pages/client030l.php",
                                                       "nameForm": ["name", " Долг ", "debt"],
                                                       "delMsg": "Покупатель успешно удален",
                                                       "saveMsg": "Покупатель успешно сохранен",
                                                       "cancelSaveMsg": "Введите имя покупателя",
                                                       "defaultTabName": "Покупатель",
                                                       "link": "pages/client030.php",
                                                       "isSaved": true,
                                                       "id": "",
                                                       "saveType": "save_new",
                                                       "firstProperty": "Покупатель",
                                                       "docData": {"tabl": [], "oper": {}}
                                                      }</p>
</div>-->