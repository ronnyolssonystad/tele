$(function(){
    $("button").click(function(data){
        var page
        if (this.id == 'nytt') {
            page = 'php/edit'; //create record        
        } else if (this.id == 'lista') {
            page='php/Persons';
        } else {
            page="php/searchPerson.php"
        }
        result = prepareFrame(page)
        $("#page").html(result);
    });
  });

  function prepareFrame(src) {
    var ifrm = document.createElement("iframe");
    ifrm.setAttribute("src", src);
    ifrm.style.width = "1100px";
    ifrm.style.height = "1100px";
    return ifrm
}


 function listPersons(page) {
    $.ajax({
    url: page,
    dataType: 'json',
    success: function(data) {
        var table = $('<table id="teletable" align = "center" border="1px" />').addClass('styled-table')
    
        var len = data.length;
        for(var i = 0; i < len; i++) {
            var row = $('<tr />');
            var a = $('<a target="_self"/>').attr('href', `php/edit/${data[i].ID}`).text('Edit');

            row.append($('<td />').append(a));
            //row.append($('<td />').html(data[i].ID));
            row.append($('<td />').html(data[i].name));
            row.append($('<td />').html(data[i].lname));
            row.append($('<td />').html(data[i].adress));
            row.append($('<td />').html(data[i].email));
            row.append($('<td />').html(data[i].nr));
            table.append(row);
        }

        table.find('.button').click(function() {
            // Do something
        });

        $(table).append('<thead><tr></tr></thead>');;
        // First create your thead section
        

        // Then create your head elements
        arr1=["Ändra","förnamn", "efternamn", "adress", "email", "telefon"];
        thead = $('#teletable > thead > tr:first');
        for (var i = 0, len = arr1.length; i < len; i++) {
            thead.append('<th>'+arr1[i]+'</th>');
        }
        $(table).append(thead)
        return table
    }
}); 

}
