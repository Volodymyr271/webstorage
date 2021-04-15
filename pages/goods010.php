<div class="doc">
    <div class="docHead">
        <h2>
            <span onClick="createInputField($(this))" name="name" class="docProperty firstProperty">Наименование товара</span>
            <span onClick="createInputField(this)" name="number" class="docProperty">0</span>
            <span onClick="createInputField(this)" name="dimension" class="docProperty">шт</span>
            <span onClick="createInputField(this)" name="price" class="docProperty">0.00</span>
            грн
        </h2>
    </div>
    <div class="lastOperationDateContainer">
        Последнее движение:
        <span onClick="createInputField(this)" name="lastOperationDate" class='docProperty'></span>
    </div>
    <div class="docHistoryContainer hidden">
        <table class="docHistory">
            <tr >
                <th >Дата</th>
                <th >Ост.</th>
                <th >Кол-во</th>
                <th >Цена</th>
                <th >Накладная</th>
                <th >Автор</th>
            </tr>
            <tr class="template hidden">
                <td class="date"></td>
                <td class="balance"></td>
                <td class="number"></td>
                <td class="price"></td>
                <td class="waybill linkColumn"></td>
                <td class="author"></td>
            </tr>
        </table>
    </div>
    <div class="docMenu">
        <a href="#" name="save" onClick="save(this)" >Сохранить</a> |
        <a href="#" name="load" onClick="Selsheet(this, 'Выберите товар', 'load', 10)" >Выбрать</a> |
        <a href="#" name="delete" onClick="deleteDoc(this)">Удалить</a> |
        <a href="#" name="showHistory" onClick="showHistory(this);">История</a><br />
        <p class="messageBox"></p>
    </div>
    <div class="objectData hidden">
        {
        "extension": 10,
        "library": "pages/goods010l.php",
        "nameForm": ["name", " ", "number", " ", "dimension", " ", "price"],
        "delMsg": "Товар успешно удален",
        "saveMsg": "Товар успешно сохранен",
        "cancelSaveMsg": "Введите наименование товара",
        "defaultTabName": "Товар",
        "link": "pages/goods010.php",
        "isSaved": true,
        "id": "",
        "saveType": "save_new",
        "firstProperty": "Наименование товара",
        "docData": {"tabl": [], "oper": {}}
        }
    </div>
</div>
<!--<div class="doc">
	<div class="docHead">
		<h2>
			<div>
				<span onClick="createInputField(this)" name="name" class="docProperty firstProperty">Наименование товара</span>
			 	<span onClick="createInputField(this)" name="number" class="docProperty">0</span>
				<span onClick="createInputField(this)" name="dimension" class="docProperty">шт</span>
				<span onClick="createInputField(this)" name="price" class="docProperty">0.00</span>&nbsp;грн
			</div>
			<span class="lastOperationDate" style="font-size:8pt;">Последнее движение: <span onClick="createInputField(this)" name="lastOperationDate" class="docProperty">2056.43.43</span></span>
		</h2>
	</div>
	<div class="docHistoryContainer" style="display: none">
			<table>
			<tr class = "head">
				<th >Дата</th>
				<th >Ост.</th>
				<th >Кол-во</th>
				<th >Цена</th>
				<th >Накладная</th>
				<th >Автор</th>
			</tr>
			<tr class=rowTemplate style="display: none">
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td name="name"></td>
				<td></td>
			</tr>
		    </table>
	</div>
	<div class="docMenu">
		<a href="#" name = "save" onClick="save(this)" >Сохранить</a> |
		<a href="#" name = "load" onClick="Selsheet(this, 'Выберите товар', 'load', 10)" >Выбрать</a> |
		<a href="#" name = "delete" onClick="deleteDoc(this)">Удалить</a> |
                <a href="#" name = "showHistory" onClick="showHistory(this);">История</a><br />
                <p class="messageBox"></p>
	</div>
        <p class="objectData" style="display:none;">{"extension": 10,
                                                       "library": "pages/goods010l.php",
                                                       "nameForm": ["name", " ", "number", " ", "dimension", " ", "price"],
                                                       "delMsg": "Товар успешно удален",
                                                       "saveMsg": "Товар успешно сохранен",
                                                       "cancelSaveMsg": "Введите наименование товара",
                                                       "defaultTabName": "Товар",
                                                       "link": "pages/goods010.php",
                                                       "isSaved": true,
                                                       "id": "",
                                                       "saveType": "save_new",
                                                       "firstProperty": "Наименование товара",
                                                       "docData": {"tabl": [], "oper": {}}
                                                      }</p>
 </div>-->