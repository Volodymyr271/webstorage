<div class="doc">
    <div class="docHead">
        <h2>
            <span style="font-size:14px;">За</span>
            <span onClick="createInputField(this)" name="num" class="docProperty">хххх</span>
            <span name="datdoc" class="docProperty hidden"></span>
            <span name="draft"  class="docProperty hidden">no</span>
        </h2>
    </div>
    <div class="lastOperationDateContainer">
        Расчитано
        <span onClick="createInputField(this)" name="lastOperationDate" class='docProperty'></span>
    </div>
    <div class="childDocsContainer">
        <table class="childDocs">
            <tr >
                <th >№ п/п</th>
                <th >Дата</th>
                <th >Накладная</th>
                <th >Сумма</th>
            </tr>
            <tr class="template hidden">
                <td name="number" style="max-width: 3px"></td>
                <td name="date" style="max-width: 5px"></td>
                <td name="waybill" style="max-width: 90px" class="linkColumn"></td>
                <td name="sum" style="max-width: 15px"></td>
            </tr>
	</table>
    </div>
    <div class="docHistoryContainer hidden">
        <table class="docHistory">
            <tr >
                <th>Дата кор</th>
		<th>Автор</th>
            </tr>
            <tr class="template hidden">
                <td style="max-width:20px" name="date"></td>
                <td style="max-width:15px" name="author">0</td>
            </tr>
        </table>
    </div>
    <div class="docMenu">
        <a href="#" name ="newReport"  onClick="newReport(this)">Новая</a> |
        <a href="#" name ="load" onClick="Selsheet(this, 'Выберите кассу', 'load', 210)" >Выбрать</a> |
        <a href="#" name ="delete" onClick="deleteDoc(this)">Удалить</a> |
        <a href="#" name ="recalc"  onClick="runDoc(this,'pages/cashbox210l.php', 'recalculation', '');">Пересчитать</a> |
        <a href="#" name ="loadHistory" onClick="showHistory(this);">История</a>
        <!--<a href="#" name ="save" style="display: none" onClick="save(this);"></a>-->
        <p class="messageBox"></p>
    </div>
    <div class="objectData hidden">
        {
        "extension": 210,
        "library": "pages/cashbox210l.php",
        "nameForm": ["num", " г"],
        "delMsg": "Касса успешно удалена",
        "cancelDelMsg": "Удалить можно только последнюю кассу",
        "saveMsg": "Касса успешно сохранена",
        "defaultTabName": "Касса",
        "link": "pages/cashbox210.php",
        "isSaved": true,
        "id": "",
        "saveType": "save_new",
        "firstProperty": "#",
        "docData": {"tabl": [], "oper": {}},
        "createButtonStatus": 0
        }
    </div>
</div>
<!--<div class="doc">
	<div class="docHead">
		<h2>
			<div>
		 		<span style="font-size:14px;"> За </span><span onClick="createInputField(this)" name="num" class="docProperty">хххх</span>
			    <span name="datdoc" style="display: none" class="docProperty">12.03.2011</span>
			</div>
			<span class="lastOperationDate" style="font-size:8pt;">Расчитано <span onClick="createInputField(this)" name="lastOperationDate" style="font-size:8pt;" class="docProperty"></span></span>
		</h2>
		<span name="draft" style="display: none" class="docProperty">no</span>
		<table class="childDocs">
			<tr >
				<th >№ п/п</th>
				<th >Дата</th>
				<th >Накладная</th>
				<th >Сумма</th>
			</tr>
			<tr class="rowTemplate" style="display: none">
				<td name="number" style="max-width: 3px"></td>
				<td name="date" style="max-width: 5px"></td>
    			<td name="name" style="max-width: 90px"></td>
				<td name="sum" style="max-width: 15px"></td>
			</tr>
		</table>
		<h2><div>
		</div>
		</h2>
	</div>
	<div class="docHistoryContainer" style="display: none">
		<table>
			<tr >
				<th >Дата кор</th>
				<th >Автор</th>
			</tr>
			<tr class="rowTemplate" style="display: none">
				<td style="max-width:20px" name="date"></td>
				<td style="max-width:15px" name="author">0</td>
			</tr>
		</table>
	</div>
	<div class="docMenu">
		<a href="#" name ="newReport"  onClick="newReport(this)">Новая</a> |
		<a href="#" name ="load" onClick="Selsheet(this, 'Выберите кассу', 'load', 210)" >Выбрать</a> |
                <a href="#" name ="delete" onClick="deleteDoc(this)">Удалить</a> |
		<a href="#" name ="recalc"  onClick="runDoc(this,'pages/cashbox210l.php', 'recalculation', '');">Пересчитать</a> |
		<a href="#" name ="save" style="display: none" onClick="save(this);"></a>
		<a href="#" name ="loadHistory" onClick="showHistory(this);">История</a>
                <p class="messageBox"></p>
	</div>
        <p class="objectData" style="display:none;">{"extension": 210,
                                                       "library": "pages/cashbox210l.php",
                                                       "nameForm": ["num", " г"],
                                                       "delMsg": "Касса успешно удалена",
                                                       "cancelDelMsg": "Удалить можно только последнюю кассу",
                                                       "saveMsg": "Касса успешно сохранена",
                                                       "defaultTabName": "Касса",
                                                       "link": "pages/cashbox210.php",
                                                       "isSaved": true,
                                                       "id": "",
                                                       "saveType": "save_new",
                                                       "firstProperty": "#",
                                                       "docData": {"tabl": [], "oper": {}},
                                                       "createButtonStatus": 0
                                                      }</p>
 </div>-->