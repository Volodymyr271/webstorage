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
                <th >Покупатель</th>
                <th >Сумма</th>
                <th >Сумма пров</th>
                <th >Примечание</th>
            </tr>
            <tr class="template hidden">
                <td name="name" style="max-width: 90px" class="linkColumn stringData"></td>
                <td name="sum"        style="max-width: 15px" onClick="createInputFieldInTabl(this)" class="totalPart"></td>
                <td name="actualSum"       style="max-width: 20px"></td>
                <td name="note"            style="max-width: 20px" onClick="createInputFieldInTabl(this)" class="stringData"></td>
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
        <a href="#" name="addclient" onClick="Selsheet(this, 'Выберите покупателя', 'InsPart', 30);" >Покупатель</a>  |
        <a href="#" name="selectcashier" onClick="Selsheet(this, 'Выберите кассира', 'insertCashier', 50);" >Кассир</a> |
        <a href="#" name="delete" onClick="deleteDoc(this)">Удалить</a> |
        <a href="#" name="save" onClick="save(this)">Сохранить</a> |
        <a href="#" name="runDoc" onClick="runDoc(this, 'pages/revenue120l.php','runDoc', '')">Провести</a> |
        <a href="#" name="load" onClick="Selsheet(this, 'Выберите выручку', 'load', 120)">Выбрать</a> |
        <a href="#" name="loadHistory" onClick="showHistory(this)">История</a>
        <p class="messageBox"></p>
    </div>
    <div class="objectData hidden">
        {
        "extension": 120,
        "library": "pages/revenue120l.php",
        "nameForm": ["№ ", "num", " от ", "datdoc", " ", "cashier"],
        "delMsg": "Выручка успешно удалена",
        "saveMsg": "Выручка успешно сохранена",
        "cancelSaveMsg": "Введите номер выручки",
        "defaultTabName": "Выручка",
        "link": "pages/revenue120.php",
        "isSaved": true,
        "id": "",
        "saveType": "save_new",
        "firstProperty": "хххх",
        "docData": {"tabl": [], "oper": {}}
        }
    </div>
</div>