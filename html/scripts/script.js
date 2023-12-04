$(function(){
    $("button").click(function(data){
        var page
        if (this.id == 'nytt') {
            page="php/person.php"        
        } else if (this.id == 'lista') {
            page="php/getPersons.php"
        } else {
            page="php/searchPerson.php"
        }
          
        $.ajax({url: page, success: function(result){
            $("#main").html(result);
        }});
    });
  });


 /* $(function(){
    $.ajax({
    url: 'handler.php',
    dataType: 'json',
    success: function(data) {
        var table = $('<table />');

        var len = data.length;
        for(var i = 0; i < len; i++) {
            var row = $('<tr />');
            var a = $('<a />').attr('href', '#').addClass('button');

            row.append($('<td />').append(a));
            row.append($('<td />').html(data[i].id);
            row.append($('<td />').html(data[i].name);

            table.append(row);
        }

        table.find('.button').click(function() {
            // Do something
        });

        $('#container').html(table);
    }
}); */




