<script type="text/javascript" class="JSlibrary">
    function TR200autostartFunc(docSelector) {
        $(docSelector).find("[name='newReport]").trigger('click');
    }
</script>
<div class="post">
	<div class="postitem">
		<h2>
			<div>
		 		<span style="font-size:14px;"> За </span><span onClick="createInputField(this)" name="num" class="inf_from_user">хххх</span>
			    <span name="datdoc" style="display: none" class="inf_from_user">12.03.2011</span>
			</div>
			<span class="postinfo" style="font-size:8pt;">Расчитано <span onClick="createInputField(this)" name="datop" style="font-size:8pt;" class="inf_from_user"></span></span>
		</h2>
		<span name="draft" style="display: none" class="inf_from_user">no</span>
		<table>
			<tr class="head">
				<th class="row_headers">№ п/п</th>
				<th class="row_headers">Дата</th>
				<th class="row_headers">Накладная</th>
				<th class="row_headers">Сумма</th>
			</tr>
			<tr class="nullrow" style="display: none">
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
	<div class="posthistory" style="display: none">
		<table>
			<tr class=head>
				<th class="row_headers">Дата кор</th>
				<th class="row_headers">Автор</th>
			</tr>
			<tr class="nullrow" style="display: none">
				<td style="max-width:20px" name="date"></td>
				<td style="max-width:15px" name="author">0</td>
			</tr>
		</table>
	</div>
	<div class="postbottom">
		<a href="#" name ="newReport"  onClick="newReport(this)">Новый</a> |
		<a href="#" name ="load" onClick="Selsheet(this, 'Выберите товарный отчет', 'load', 200)" >Выбрать</a> |
                <a href="#" name ="delete" onClick="deleteDoc(this)">Удалить</a> |
		<a href="#" name ="recalc"  onClick="runDoc(this,'pages/tradeReport200l.php', 'recalculation', '');">Пересчитать</a> |
		<a href="#" name ="save" style="display: none" onClick="save(this);"></a>
		<a href="#" name ="loadHistory" onClick="showHistory(this);">История</a>
                <p class="msg_box1"></p>
	</div>
        <p class="objectData" style="display:none;">{"extension": 200,
                                                     "autostartFuncName": "TR200autostartFunc"
                                                       "library": "pages/tradeReport200l.php",
                                                       "nameForm": ["num", " г"],
                                                       "delMsg": "Товарный отчет успешно удален",
                                                       "cancelDelMsg": "Удалить можно только последний товарный отчет",
                                                       "saveMsg": "Товарный отчет успешно сохранен",
                                                       "defaultTabName": "Тов.отчет",
                                                       "link": "pages/tradeReport200.php",
                                                       "saveStatus": "yes",
                                                       "id": "",
                                                       "saveType": "save_new",
                                                       "firstAttr": "#",
                                                       "docData": {"tabl": [], "oper": {}},
                                                       "createButtonStatus": 0
                                                      }</p>
 </div>