// глобальные переменные //
window.documentsTemplate = {};
window.extensionToLink = { 10: "pages/goods010.php",
                           20: "pages/supplier020.php",
                           30: "pages/client030.php",
                           40: "pages/expenditureItem040.php",
                           50: "pages/cashier050.php",
                          100: "pages/supply100.php",
                          110: "pages/shipment110.php",
                          120: "pages/revenue120.php",
                          130: "pages/expenditure130.php",
                          140: "pages/paymentToSupplier140.php"
                         };
window.generalMessages = { 'deleteNotSavedDoc' : 'Все поля успешно очищены',
                           'runNotSavedDoc': 'Документ не сохранен. Сохраните документ для проведения данной операции',
                           'dateFormat': 'Введите дату в формате мм.гггг, где мм - месяц, гггг - год',
                           'wrongDate': 'Дата введена некорректно, попробуйте еще раз',
                           'deleteBeforeCreate': "Удалите текущий документ прежде чем создать новый, или откройте новую вкладку",
                           'noChanges': 'Изменения за текущий месяц отсутствуют',
                           'wrongTableData': 'Табличные данные некорректны'};

$(function() {
    $.ajaxSetup({
		async: false,
		/*complete: function (XMLHttpRequest, textStatus){
			this; // the options for this ajax request
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
			var msg = 'Ошибка запроса к файлу: "' + this.url + '"<br /><br />Текст ошибки:<br />' + XMLHttpRequest.responseText;
			show_msgBox(this, 'Ошибка AJAX', msg, 'CL', '', '');
                        return false;
		}*/
	});
    $('body').on('click', '#secondaryContent a, #tabs a, #mainmenu a, .docMenu a, .modal_id', function(){
        return false;
    });
    /////////////////////////////// MENU ///////////////////////////////////
    $('body').on('click', '#mainmenu a', function() {
        $('.pt_of_mnmenu:visible').hide();
        $('.pt_of_mnmenu[name='+$(this).attr('name')+']').show();

    });

    $.post ('PostOperations.php',
            { operation: 'loadMenu'},
            function(response) {
                $('#mainmenu').html(response.firstLvl);
                $('#secondaryContent').html(response.secondLvl);
            },
            'json'
    );

    $('body').on('click', '#secondaryContent a', function(){
        createNewDoc($(this).attr('href'));
    });


    $(window).resize(function() {
        correctTabsPosition('screenScaling');
    });


    ////////////////// MSG_BOX //////////////////////
    $('body').on('click', '.msgBoxClose', function() {
        $('#msgBox, #cover').remove();
    });

    /////////////////         ///////////////////////
    $('body').on('keyup', '#searchQuery', function() {
        var searchQuery = $(this).val().replace(/\s+/g, '');
        $('.modal_id').each(function() {
            var item = $(this).text().replace(/\s+/g, '');
            if (item.indexOf(searchQuery, 0) + 1) {
                $(this).show();
            }
            else {
                $(this).hide();
            }
        });
    });
});


function save(childNode) {
    var doc = $(childNode).closest('.doc'),
        docData = doc.data();
    if (doc.find('.firstProperty').text() === docData.firstProperty) {
        outputMessage(doc, docData.cancelSaveMsg);
        return false;
    }
    var childDocs = shapeTableData(doc),
        properties = shapePropertiesArray(doc),
        docName = createDocName(docData.nameForm, properties);
    $.post('PostOperations.php',
           {
            operation: 'saveDoc',
            docData: JSON.stringify({'childDocs': childDocs, 'properties': properties}),
            docName: docName,
            extension: docData.extension,
            saveType: docData.saveType,
            id: docData.id
           },
           function(response) {
               if (response.ErrorMessage === '') {
                   outputMessage(doc, docData.saveMsg);
                   installTabName(doc, docName);
                   doc.data(response.docDataChanges);
               }

           },
           'json'

   );

};


function Selsheet(object, header, functionName, extension) {
    if (extension === 300) {
        var operation = 'loadUsersList';
    }
    else {
        var operation = 'loadDocsList';
    }
    $.post('PostOperations.php',
            {
                operation: operation,
                extension: extension,
                go: functionName
            },
            function(docsList) {
                var body = '<div id="searchForm"><input type="text" id="searchQuery" placeholder="Найти" /></div><ul id="docsList">'+docsList+'</ul>';
                showMsgBox(header, body);
    });
}
function load(docId) {
    var doc = $('.doc:visible');
    doc.find(".record").remove();
    doc.find(".docHistoryContainer").addClass('hidden');
    $.post('PostOperations.php',
            {
                operation: 'loadDoc',
                id: docId
            },
            function (response) {
                var docData = response.objectDataChanges.docData;
                for (var propertyName in docData.oper) {
                    doc.find('.docProperty[name='+propertyName+']').text(docData.oper[propertyName]);
                };
                if (docData.tabl === "") {
                    outputMessage(doc, generalMessages.noChanges);
                    doc.find('[name="balance"]').text("");
                }
                else {
                    fillTable(docData.tabl, doc.children('.childDocsContainer').children('table'));
                }
                doc.data(response.objectDataChanges);
                var docName = createDocName(doc.data('nameForm'), docData.oper);
                installTabName(doc, docName);
                $('#msgBox, #cover').remove();
            },
           'json'
    );
}

function createInputField(propertyContainer, value) {
    if (value === undefined) {
        value = $(propertyContainer).html();
    }
    var inputField = '<input type="text" style="width: ' + (($(propertyContainer).width() < 120) ? 120 : $(propertyContainer).width()) +
                    'px; font-size: 14px;" onBlur="removeInputField(this);" value="'+value+'">';
    $(inputField).appendTo($(propertyContainer).empty()).select();
}

function removeInputField(inputField) {
    var propertyContainer = $(inputField).parent(),
        obj = propertyContainer.closest('.doc');
    propertyContainer.html($(inputField).val());
    propertyContainer.attr("onClick", "createInputField(this);");
    if ( obj.data('extension') >= 200 && propertyContainer.attr('name') === 'num' && obj.data('createButtonStatus') === 1) {
        var date = $(inputField),
            checkDate = /(0[1-9]|1[012])\.(\d{4})/;
        if (checkDate.test(date.val())) {
            newReport(obj);
        }
        else {
            outputMessage(obj, generalMessages['wrongDate']);
        }
    }
}

function createInputFieldInTabl(tableCell) {
    $('#oldkursor').removeAttr("id");
    var tableRow = $(tableCell).parent();
    var inputField = '<input type="text" style="width: ' + $(tableCell).width() +
                     'px; font-size: 14px;" id="kursor" onBlur="removeInputFieldInTabl(this);" onKeyDown="onEnter(this, event);" value="' +
                     $(tableCell).text() + '">';
    $(tableCell).html(inputField);
    $(tableCell).removeAttr("OnClick");
    $('#kursor').select();
}

function removeInputFieldInTabl(inputField) {
    var tableCell = $(inputField).parent(),
        value = $(inputField).val();
    tableCell.html(value);
    if(!tableCell.hasClass('stringData')) {
        var tableRow = tableCell.parent(),
            response = shapeAndCheckTableRowData(tableRow);
        if (response.isCorrect) {
            calcAndSetTableRowData(response.tableRowData, tableRow, tableCell.attr('name'));
            var doc = tableCell.closest('.doc');
            shapeAndSetTotal(doc);
        }
    }
    tableCell.attr("onClick", "createInputFieldInTabl(this);");
    tableCell.attr("id", "oldkursor");
}

function onEnter(rf, e) {
    if(e.keyCode == 13) {
        link = $(rf).parent();
        //link.html($(rf).val());
        //link.attr('onClick','createInputFieldInTabl(this);');
        removeInputFieldInTabl(rf);
        if (link.next().length > 0) {
            if (link.next().attr("onClick") == "createInputFieldInTabl(this)")
                createInputFieldInTabl(link.next());
            else
                createInputFieldInTabl(link.next().next());
        }
        else if (link.parent().next().length > 0)
            createInputFieldInTabl(link.parent().next("tr").children("td:first").next());
    }
 }

function deleteDoc(childNode) {
    var doc = $(object).closest('.doc'),
        objectData = doc.data(),
        newDoc = window.documentsTemplate[objectData.link].clone(true);
    /*doc.find(".docHead").children("table").children().children("tr").not(".rowTemplate").not(".head").remove();
    doc.find(".docHistoryContainer").children("table").children().children("tr").not(".rowTemplate").not(".head").remove();
    doc.find(".docHistoryContainer").attr("style","display: none"); */
    if (objectData.id === '') {
        doc.replaceWith(newDoc);
        outputMessage(newDoc, generalMessages['deleteNotSavedDoc']);
        return false;
    }
    $.post('PostOperations.php',
           {
            operation: 'deleteDoc',
            id: objectData.id,
            extension: objectData.extension
           },
           function (response) {
               if (response.ErrorMessage === '') {
                   var tab = $('.tab').eq(doc.index()).children('a');
                   tab.text(objectData.defaultTabName);
                   tab.removeAttr('title');
                   doc.replaceWith(newDoc);
                   outputMessage(newDoc, newDoc.data('delMsg'));
               }
               else {
                   outputMessage(doc, newDoc.data('cancelDelMsg'));
               }
           },
           'json'
    );




}

function runDoc(rf, lib,func,param){
    var obj = $(rf).closest('.doc');
    if ( ($(obj).data('id') == 0 || obj.data('isSaved')) && func !== 'newReport') {
        outputMessage(obj, generalMessages['runNotSavedDoc']);
        return false;
    }
    if (func === 'newReport') {
        save(rf);
    }
    if (obj.find('.docProperty').eq(0).text() === obj.data('firstProperty') && func !== 'newReport') {
        outputMessage(obj, obj.data('cancelSaveMsg'));
        return false;
    };
    $.post(lib,
           {
            func: func,
            param: param,
            id: obj.data('id')
           },
           function(response){
               load(obj.data('id'));

           }
    );
}

function showHistory(childNode) {
    var doc = $(childNode).closest('.doc');
    doc.children('.docHistoryContainer').children('.record').remove();
    doc.children('.docHistoryContainer').removeClass('hidden');
    $.post('PostOperations.php',
            {
             operation: 'loadDocHistory',
             id: doc.data('id')},
            function(response) {
                //if (response.errorMessage === 'success') {
                fillTable(response.history, doc.children('.docHistoryContainer').children('table'));
                //}
            },
            'json'
    );
};

function closeDoc(save, docIndex) {
    if (save) {
        save($('.doc').eq(docIndex));
    }
    $('.doc').eq(docIndex).data('isSaved', true);
    $('.msg_exit').trigger('click');
    $('.exit').eq(docIndex).trigger('click');
}

function createDocName(nameForm, properties) {
    var docName = '';
    for (var element in nameForm) {
        if (nameForm[element] in properties) {
            docName = docName + properties[nameForm[element]];
        }
        else {
            docName = docName + nameForm[element];
        }
    }
    return docName;
}

/*function changeTabBorderColor(tabIndex) {
    $('.openTab').removeClass('openTab');
    $('.tab').eq(tabIndex).addClass('openTab');

}*/

function outputMessage(doc, message) {
    $(doc).find('.messageBox').fadeTo(200, 0.1, function(){
            $(this).html(message).addClass('messageboxerror').fadeTo(900,1);
        });
}

function createNewDoc(link) {
    if (typeof link === 'number') {
        $.post('PostOperations.php',
               {
                operation: 'loadDoc',
                id: link
               },
               function(response) {
                   link = window.extensionToLink[response.objectDataChanges.extension];
               },
               'json'
        );
    }
    if (link in window.documentsTemplate) {
        $('.doc:visible').hide();
        $('#page').append( (window.documentsTemplate[link]).clone(true) );
    }
    else {
        $.post(link,
               function(response) {
                   if (response === 'nothing') {
                       alert('Такого документа не существует');
                       $('#isFile').text('1');
                   }
                   else {
                       $('.doc:visible').hide();
                       $('#page').append(response);
                       var ld = new Date(),
                           s_date =  ld.getDate() + '.' + (ld.getMonth() + 1) + '.' + ld.getFullYear(),
                           doc = $('.doc').last();
                       doc.find('[name="lastOperationDate"]').text(s_date);
                       doc.find('[name="datdoc"]').text(s_date);
                       var defaultProp = JSON.parse(doc.children('.objectData').text());
                       doc.data(defaultProp);
                       $('#page').children('.JSlibrary').remove();
                       var documentTemplate = doc.clone(true);
                       window.documentsTemplate[link] = documentTemplate;
                   }
               }
        );
    }
    if ($('#isFile').text() === '1') {
        $('#isFile').text('0');
        return false;
    }
    var doc = $('.doc').last();
    addTab(doc);
    if (window[doc.data('autostartFuncName')] !== undefined) {
        window[doc.data('autostartFuncName')](doc);
    }
}

function newReport(object) {
    var obj = $(object).closest('.doc'),
        objectData = obj.data();
    if (objectData.id != 0 ) {
        outputMessage(obj, generalMessages['deleteBeforeCreate']);
        return false;
    }
    $.post ('PostOperations.php',
            {
                operation: 'getNumberOfDocs',
                extension: objectData.extension
            },
            function(response) {
                if (response.number === 0) {
                    var date = obj.find('[name="num"]'),
                        checkDate = /(0[1-9]|1[012])\.(\d{4})/;
                    if (checkDate.test(date.text())) {
                        runDoc(object, objectData.library, "newReport", date.text()+','+'firstReport');
                    }
                    else {
                        outputMessage(obj, generalMessages['dateFormat']);
                        createInputField(date, 'мм.гггг');
                    }
                }
                else {
                    runDoc(object, objectData.library, "newReport", '');
                }
            }
           );


}

function showRegForm() {
    $('.doc:visible').find('.docHead').load('pages/insideRegForm.php');
}

function sendUserData(buttonObject) {
    var regForm = $(buttonObject).parents('table'),
        login = regForm.find('#login').val(),
        password = regForm.find('#password').val(),
        passwordRepeat = regForm.find('#passwordRepeat').val(),
        name = regForm.find('#userName').val(),
        menuType = regForm.find('#menuType').val();
    $.post('PostOperations.php', {
        operation: 'insideReg',
        login: login,
        password: password,
        passwordRepeat: passwordRepeat,
        name: name,
        menuType: menuType},
    function(response) {
        outputMessage(regForm.parents('.doc'), response);
    });

}

function selectUser(userId) {
    var obj = $('.doc:visible').find('.docHead');
    $.post('PostOperations.php', {
        operation: 'selectUser',
        id: userId},
    function(response) {
        obj.load('pages/editUserForm.php');
        obj.find('#login').val(response.login);
        obj.find('#userName').val(response.name);
        obj.parent('.doc').data('id', response.id);
        installTabName(obj.parent(), response.login);
        $('#msgBox, #cover').remove();

    },
    'json'
            );
}

function installTabName(doc, docName) {
    var tab = $('.tab').eq($(doc).index()).children('a'),
        tabName = $(doc).data('defaultTabName') + ': ' + docName;
    tab.attr('title', docName),
    tab.text(docName);
}

function editUser(buttonObject, attribute) {
    var regForm = $(buttonObject).parents('table'),
        attr = [attribute];

    if (attribute === 'password') {
        attr[1] = regForm.find('#password').val();
        attr[2] = regForm.find('#passwordRepeat').val();
    }

    else if (attribute === 'name') {
        attr[1] = regForm.find('#userName').val();
    }

    else if (attribute === 'menuType') {
        attr[1] = regForm.find('#menuType').val();
    }

    $.post('PostOperations.php', {
        operation: 'editUser',
        id: regForm.parents('.doc').data('id'),
        attr: attr},
    function(response) {
        outputMessage(regForm.parents('.doc'), response);

    });
}

/*function closeTab(tab) {
    var maxNumOfVisibleTabs = getMaxNumOfVisibleTabs();
    var i = $(tab).index();
    if ( $('.doc').eq(i).data('isSaved')) {
        var check = (i === $('.doc:visible').index());
        $('.doc').eq(i).remove();
        if (check) {
            if (i-1 !== -1) {
                $('.doc').eq(i-1).show();
            }
            else {
                $('.doc').eq(i).show();
            }
        }
        $(tab).remove();
        var tabLength = $('.tab').length;
        if (tabLength <= maxNumOfVisibleTabs) {
            $('#pointer').remove();
        }

        if (tabLength === 0) {
            $('#tabs').css('height', '0');
        }

        if (tabLength >= maxNumOfVisibleTabs && $('.tab').last().is(':visible')) {
            $('.tab:visible:eq(0)')#prev('.tab').show('fast');
        }
        else if (tabLength >= maxNumOfVisibleTabs && $('.tab').last().is(':hidden')) {
            $('.tab:visible').last()#next('.tab').show('slide', {direction: 'right'}, 50);
        }
        changeTabBorderColor($('.doc:visible').index());
    }
    else {
        var modal = '<div id="msg_box">'+
                    '<div class="msg_top"><span style="float:left; font-size:11pt; margin: 6px 4px;">Закрытие документа</span><div class="msg_exit"></div></div>'+
                    '<div id="msgBox_cont">Внимание !!!<br>Документ не сохранен.<br><br>Сохранить документ ?</div>'+
                    '<div id="msgBox_btn"><button id="btn_no" style="margin-left: 5px;" onclick ="closeDoc(\'no\', '+i+');"><span>Нет</span></button>'+
                    '<button id="btn_yes" style="" onclick="closeDoc(\'yes\', '+i+');"><span>Да</span></button>'+
                    '<button id="btn_cl" style="margin-right: 5px;" onclick ="$(\'.msg_exit\').trigger(\'click\');"><span>Отмена</span></button></div>'+
                    '</div>';
        $('body').append('<div id="cover_div"></div>');
        $('body').append(modal);
    }

}*/

function addTab(doc) {
    var tabName = $(doc).data('defaultTabName'),
        tabHtml = '<li class="tab"><a href="#" onclick="openTab($(this).parent().index())" >'+tabName+'</a><button class="closeTab" onclick="closeTab($(this).parent())">&#215;</button></li>',
        tab = $(tabHtml).appendTo($('#slider').children());
    openTab(tab.index());
    correctTabsPosition('add');
}
function correctTabsPosition(operation) {
    var slider = $('#slider'),
        overflow = slider.find('li:last').offset().left + slider.find('li:last').outerWidth() - slider.find('li:first').offset().left > slider.width(),
        overflowValue = slider.find('li:last').outerWidth() + slider.find('li:last').offset().left - slider.offset().left - slider.width(),
        offset = Math.abs(parseInt(slider.children().css('marginLeft'))),
        length = 0,
        next = $('#next'),
        prev = $('#prev');
    switch (operation) {
        case 'add':
            if (overflow) {
                length = overflowValue;
                next.css('visibility','hidden');
                prev.css('visibility','visible');
                moveRight(length);
            }
            break;
        case 'close':
            if (overflow) {
                if (overflowValue <= 0) {
                    length = overflowValue;
                    next.css('visibility','hidden');
                }
            }
            else {
                length = -offset;
                $('#next, #prev').css('visibility', 'hidden');
            }
            moveRight(length);
            break;
        case 'nextButtonPressed':
            length = 200;
            if (overflowValue - length <= 0) {
                length = overflowValue;
                next.css('visibility','hidden');
            }
            prev.css('visibility','visible');
            moveRight(length);
            break;
        case 'prevButtonPressed':
            length = 200;
            if (offset <= length) {
                length = offset;
                prev.css('visibility','hidden');
            }
            next.css('visibility','visible');
            moveLeft(length);
            break;
        case 'screenScaling':
            if (overflow) {
                if (overflowValue <= 0) {
                    length = overflowValue;
                    next.css('visibility','hidden');
                }
                else {
                    next.css('visibility','visible');
                }
            }
            else {
                length = -offset;
                $('#tabs').children('button').css('visibility', 'hidden');
            }
            moveRight(length);
    }
}
function moveRight(length) {
    var tabsList = $('#tabs').find('ul');
    tabsList.animate({marginLeft: "-=" + length}, 400, 'swing');
}
function moveLeft(length) {
    var tabsList = $('#tabs').find('ul');
    tabsList.animate({marginLeft: '+=' + length}, 400, 'swing');
}
function closeTab(tab) {

    var tabIndex = $(tab).index(),
        OpenTabClosing = $(tab).hasClass('openTab');
    if ($('.doc').eq(tabIndex).data('isSaved')) {
        $('.doc').eq(tabIndex).remove();
        $(tab).remove();
        correctTabsPosition('close');
        if (OpenTabClosing) {
            if (tabIndex === $('#tabs').find('.tab').length) {
                tabIndex -= 1;
            }
            openTab(tabIndex);
        }
    }
    else {
        var header = 'Закрытие документа',
            body =  '<div id="msgBoxText">Внимание !!!</br>Документ не сохранен.</br> Сохранить документ ?</div>'+
                    '<div id="msgBoxButtons"><button id="btn_no" onclick ="closeDoc(false, '+tabIndex+');">Нет</button>'+
                    '<button id="btn_yes" onclick="closeDoc(true, '+tabIndex+');">Да</button>'+
                    '<button id="btn_cl" class="msgBoxClose">Отмена</button></div>'+
                    '</div>';
        showMsgBox(header, body);
    }
}

function openTab(tabIndex) {
    $('.doc:visible').hide();
    $('.doc').eq(tabIndex).show();
    $('.openTab').removeClass('openTab');
    $('#slider').find('li').eq(tabIndex).addClass('openTab');
}
/*function addTab() {
    var maxNumOfVisibleTabs = getMaxNumOfVisibleTabs(),
        tabName = $('.doc').last().data('defaultTabName');
    var tab = '<div class="tab"><a href="#" onclick="showDoc($(this).parent().index())" >'+tabName+'</a><div class="closeTab" onclick="closeTab($(this).parent())" ></div></div>';
    if ($('div').is('.tab')) {
        $('.tab:eq(-1)').after(tab);
    }
    else {
        $('#tabs').append(tab);
    }

    if ($('.tab').length <= maxNumOfVisibleTabs) {
        $('.tab:hidden').last().show('fast');
    }
    else {
        if (!$('div').is('#pointer')) {
            $('#tabs').append('<div id="pointer"><div id="left" onclick="moveTabsLeft()"></div>'+
                              '<div id="right" onclick="moveTabsRight()"></div></div>');
        }

        if ($('.tab:eq(-2)').is(':hidden')) {
            $('.tab').hide();
            $('.tab').slice(-3).show('fast');

        }
        else {
            $('.tab:visible:first').hide('fast');
            $('.tab:visible:eq(-1)')#next('.tab').show('fast');
        }
    }
    changeTabBorderColor(-1);
}

function showDoc(tabIndex) {
    $('.doc:visible').hide();
    $('.doc:eq('+tabIndex+')').show();
    changeTabBorderColor(tabIndex);
}

function moveTabsLeft() {
    if (!$('.tab:first').is(':visible')) {
        $('.tab:visible').last().hide('fast');
        $('.tab:visible:eq(0)')#prev('.tab').show('fast');
    };
}

function moveTabsRight() {
    if (!$('.tab').last().is(':visible')) {
        $('.tab:visible:first').hide('fast');
        $('.tab:visible').last()#next().show('fast');
    }
}

function resizeTabDiv() {
    var maxNumOfVisibleTabs = getMaxNumOfVisibleTabs();
    if (maxNumOfVisibleTabs > $('.tab:visible').length) {
        if ($('.tab').last().is(':visible')) {
            $('.tab:visible:first')#prev('.tab').show('fast');
        }
        else if ($('.tab').last().is(':hidden')) {
            $('.tab:visible:eq(-1)')#next('.tab').show('fast');
        }
    }
    else if (maxNumOfVisibleTabs < $('.tab:visible').length) {
        $('.tab:visible:first').hide();
    }
    if ($('.tab').length === $('.tab:visible').length) {
        $('#pointer').remove();
    }
    if ($('.tab').length > $('.tab:visible').length && !$('div').is('#pointer')) {
        $('#tabs').append('<div id="pointer"><div id="left" onclick="moveTabsLeft()"></div>'+
                          '<div id="right" onclick="moveTabsRight()"></div></div>');
    }
}

function getMaxNumOfVisibleTabs() {
    var tabsDivWidth = $('#tabs').width(),
        pointerWidth = 40,
        tabWidth = 155;
    var maxNumOfVisibleTabs = Math.floor((tabsDivWidth - pointerWidth) / tabWidth);
    return maxNumOfVisibleTabs;
}*/

function printDoc(childNode) {
    var doc = $(childNode).closest('.doc').clone(),
        entirePage = document.body.innerHTML;
    $('body').addClass('printSelected');
    $('body').append("<div class='printSelection'></div>");
    $('.printSelection').append(doc);
    alert($('body').children('.printSelection').html());
    //document.body.innerHTML = doc.html();
    window.print();
    $('body').removeClass('printSelected');
    $('.printSelection').remove();
    //document.body.innerHTML = entirePage;
}

function shapeTableData(table) {
    var tableData = [];
    table.find('.record').each(function() {
	tableData.push($(this).attr('recordId'));
	$(this).children('td').each(function() {
            if ($(this).hasClass('linkColumn')) {
                var link = $(this).children().length;
                if(link.length > 0)
                    tableData.push(link.html());
		else
                    tableData.push($(this).html());
            }
            else {
		tableData.push($(this).html());
            }
	});
    });
    return tableData;
}

function shapePropertiesArray(doc) {
    var properties = {};
    $(doc).find('.docProperty').each(function() {
        properties[$(this).attr('name')] = $(this).text();
    });
    return properties;
}
function fillTable(tableData, table) {
    var template = table.find('.template').clone().removeClass().addClass("record");
    console.log(table.html());
    $.each(tableData, function(key, value) {
        var presentRow = template.clone().appendTo(table);
        presentRow.attr("recordId", value[0]);
        presentRow.children().each(function(i) {
            if ($(this).hasClass('linkColumn')) {
                var recordName = '<a href="#" onClick="createNewDoc('+value[0]+');  load('+value[0]+');">'+value[i+1]+'</a>';
                $(this).html(recordName);
            }
            else {
                $(this).html(value[i+1]);
            }
        });
    });
}

function shapeAndCheckTableRowData(tableRow) {
    var tableRowData = {},
        isCorrect = true;
    tableRow.children().not('.stringData').each(function() {
        var value = $(this).text().replace(',', '.');
        if (isFinite(value)) {
            tableRowData[$(this).attr('name')] = value;
        }
        else {
            isCorrect = false;
            $(this).text('-');
            outputMessage($(this).closest('.doc'), generalMessages.wrongTableData);
        }
    });
    return {'tableRowData': tableRowData, 'isCorrect': isCorrect};
}

function calcAndSetTableRowData(tableRowData, tableRow, tableCellName) {
    switch (tableCellName) {
        case 'number':
            tableRowData.sumBeforeMarkup = (tableRowData.number * tableRowData.priceBeforeMarkup).toFixed(2),
            tableRowData.sumAfterMarkup = (tableRowData.number * tableRowData.priceAfterMarkup).toFixed(2);
            break;
        case 'priceBeforeMarkup':
            tableRowData.sumBeforeMarkup = (tableRowData.number * tableRowData.priceBeforeMarkup).toFixed(2),
            tableRowData.markup = (100 * (tableRowData.priceAfterMarkup / tableRowData.priceBeforeMarkup - 1)).toFixed(1);
            break;
        case 'priceAfterMarkup':
            tableRowData.sumAfterMarkup = (tableRowData.number * tableRowData.priceAfterMarkup).toFixed(2),
            tableRowData.markup = (100 * (tableRowData.priceAfterMarkup / tableRowData.priceBeforeMarkup - 1)).toFixed(1);
            break;
        case 'markup':
            tableRowData.priceAfterMarkup = (tableRowData.priceBeforeMarkup * (tableRowData.markup / 100 + 1)).toFixed(2),
            tableRowData.sumAfterMarkup = (tableRowData.priceAfterMarkup * tableRowData.number).toFixed(2);
    }
    $(tableRow).children().not('.stringData').each(function() {
        $(this).text(tableRowData[$(this).attr('name')]);
    });
}

function shapeAndSetTotal(doc) {
    var oldTotal = $(doc).children('.total').children('span').text(),
        actualTotal = 0;
    $(doc).children('.childDocsContainer').find('.totalPart').each(function() {
        actualTotal += Number($(this).text());
    });
    if(isFinite(actualTotal)) {
        if (oldTotal !== actualTotal) {
            $(doc).children('.total').children('span').text(actualTotal.toFixed(2));
            doc.find('[name="draft"]').text('yes');
            doc.data('isSaved', false);
        }
    }
    else {
        $(doc).children('.total').children('span').text('-');
        outputMessage(doc, generalMessages.wrongTableData);
    }
}

function showMsgBox(header, body) {
    var msgBox = '<div id="msgBox"><div id="msgBoxHeader">'+header+'<button class="msgBoxClose default">&#215;</button></div>'+body+'</div>';
    $('body').append('<div id="cover"></div>'+msgBox);
}

