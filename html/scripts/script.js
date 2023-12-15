$(function(){
    $("button").click(function(data){
        var page
        if (this.id == 'nytt') {
            page="php/editperson.php"        
        } else if (this.id == 'lista') {
            page="php/getPersons.php"
            listPersons(page)
            return
        } else {
            page="php/searchPerson.php"
        }
          
        $.ajax({url: page, success: function(result){
            $("#main").html(result);
        }});
    });
  });


 function listPersons(page) {
    $.ajax({
    url: page,
    dataType: 'json',
    success: function(data) {
        var table = $('<table id="teletable" align = "center" border="1px" />').addClass('styled-table')
    
        var len = data.length;
        for(var i = 0; i < len; i++) {
            var row = $('<tr />');
            var a = $('<a />').attr('href', `php/edit.php/${data[i].ID}`).text('Edit');

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

        $('#main').html(table);
        // First create your thead section
        $('#teletable').append('<thead><tr></tr></thead>');

        // Then create your head elements
        arr1=["Ändra","förnamn", "efternamn", "adress", "email", "telefon"];
        $thead = $('#teletable > thead > tr:first');
        for (var i = 0, len = arr1.length; i < len; i++) {
            $thead.append('<th>'+arr1[i]+'</th>');
        }

    }
}); 

}
