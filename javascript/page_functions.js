function InsPart(id) {
    $.post("PostOperations.php",
          {
       operation: 'loadDoc',
       id: id
           },
           function (response) {
               $(".in").removeClass();
               var obj = $('.post:visible').children('.docHead'),
                   etalon = obj.find(".rowTemplate").clone().removeClass().addClass("in").removeAttr("style"),
                   lnk = obj.find("table").children().append(etalon);
               lnk.find(".in").attr("tableRowId", id);
               lnk.find(".in").find("td:first").text(response.objectDataChanges.docData.oper['name']);
               //$(lnk).find('.in').find('[name="priceAfterMarkup"]').text(dat.oper["price"])
               tableDataCalc(lnk.children(".in").children("td:first"));
               obj.data('isSaved', 'no');
               $('#msg_box, #cover_div').remove();
           },
           'json'
    );
    return false;
}

function insertCashier(id) {
    $.post("PostOperations.php",
           {
            operation: 'loadDoc',
            id: id
           },
           function(response) {
               var obj = $('.post:visible').children('.docHead');
               obj.find('span[name="idcashier"]').text(id);
               obj.find('span[name="cashier"]').text(response.objectDataChanges.docData.oper['name']);
               obj.data('isSaved', 'no');
               $('#msg_box, #cover_div').remove();
           },
           'json'
    );
    return false;
}

function insertGoodsInSupply(id) {
    $.post("PostOperations.php",
           {
            operation: 'loadDoc',
            id: id
           },
           function (response) {
               $(".in").removeClass();
               var obj = $('.post:visible').children('.docHead'),
                   etalon = obj.find(".rowTemplate").clone().removeClass().addClass("in").removeAttr("style"),
                   lnk = obj.find("table").children().append(etalon);
               lnk.find(".in").attr("tableRowId", id);
               lnk.find(".in").find("td:first").text(response.objectDataChanges.docData.oper["name"]);
               lnk.find('.in').find('[name="priceAfterMarkup"]').text(response.objectDataChanges.docData.oper["price"]);
               tableDataCalc(lnk.children(".in").children("td:first"));
               obj.data('isSaved', 'no');
               $('#msg_box, #cover_div').remove();
            },
            'json'
    );
    return false;
}

function insertSupplierInSupply(id) {
    $.post("PostOperations.php",
           {
            operation: 'loadDoc',
            id: id
           },
           function (response) {
               var obj = $('.post:visible').children('.docHead');
               obj.find('span[name="idsupplier"]').text(id);
               obj.find('span[name="supplier"]').text(response.objectDataChanges.docData.oper['name']);
               obj.data('isSaved', 'no');
               $('#msg_box, #cover_div').remove();
           },
           'json'
    );
    return false;
}


function insertGoodsInShipment(id) {
    $.post("PostOperations.php",
           {
            operation: 'loadDoc',
            id: id
           },
           function (response) {
               $(".in").removeClass();
               var obj = $('.post:visible').children('.docHead'),
                   etalon = obj.find(".rowTemplate").clone().removeClass().addClass("in").removeAttr("style"),
                   lnk = obj.find("table").children().append(etalon);
               lnk.find(".in").attr("tableRowId", id);
               lnk.find(".in").find("td:first").text(response.objectDataChanges.docData.oper["name"]);
               lnk.find('.in').find('[name="priceAfterMarkup"], [name="priceBeforeMarkup"]').text(response.objectDataChanges.docData.oper["price"]);
               tableDataCalc(lnk.children(".in").children("td:first"));
               obj.data('isSaved', 'no');
               $('#msg_box, #cover_div').remove();
           },
           'json'
    );
    return false;
}

function insertClientInShipment(id) {
    $.post("PostOperations.php",
           {
            operation: 'loadDoc',
            id: id
           },
           function (response) {
               var obj = $('.post:visible').children('.docHead');
               obj.find('span[name="idclient"]').text(id);
               obj.find('span[name="client"]').text(response.objectDataChanges.docData.oper['name']);
               obj.data('isSaved', 'no');
               $('#msg_box, #cover_div').remove();
           },
           'json'
    );
    return false;
}

