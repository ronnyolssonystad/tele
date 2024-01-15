$(function(){
    $("button").click(function(data){
        var page
        if (this.id == 'nytt') {
            page = 'php/edit'; //create record        
        } else if (this.id == 'lista') {
            page='php/Persons';
        } else if (this.id == 'ladda') {
            page='php/uploadfrm.php';
        }
        else {
            page="php/searchPerson.php"
        }
        result = prepareFrame(page)
        $("#page").empty();
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

function csvJSON(csv){

    var lines=csv.split("\n");
  
    var result = [];
  
    // NOTE: If your columns contain commas in their values, you'll need
    // to deal with those before doing the next step 
    // (you might convert them to &&& or something, then covert them back later)
    // jsfiddle showing the issue https://jsfiddle.net/
    var headers=lines[0].split(",");
  
    for(var i=1;i<lines.length;i++){
  
        var obj = {};
        var currentline=lines[i].split(",");
  
        for(var j=0;j<headers.length;j++){
            obj[headers[j]] = currentline[j];
        }
  
        result.push(obj);
  
    }
  
    //return result; //JavaScript object
    return JSON.stringify(result); //JSON
  }
  function readandconvert() {
    var input = document.createElement('input');
    input.type = 'file';

    input.onchange = e => { 

    // getting a hold of the file reference
    var file = e.target.files[0]; 

    // setting up the reader
    var reader = new FileReader();
    reader.readAsText(file,'UTF-8');

   // here we tell the reader what to do when it's done reading...
    reader.onload = readerEvent => {
      var content = readerEvent.target.result; // this is the content!
      var data = parse(content);
      download(JSON.stringify(data), file + '.json')
   }

    }

input.click();
}
function download(data, filename) {
    // data is the string type, that contains the contents of the file.
    // filename is the default file name, some browsers allow the user to change this during the save dialog.

    // Note that we use octet/stream as the mimetype
    // this is to prevent some browsers from displaying the 
    // contents in another browser tab instead of downloading the file
    var blob = new Blob([data], {type:'octet/stream'});

    //IE 10+
    if (window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(blob, filename);
    }
    else {
        //Everything else
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement('a');
        document.body.appendChild(a);
        a.href = url;
        a.download = filename;

        setTimeout(() => {
            //setTimeout hack is required for older versions of Safari

            a.click();

            //Cleanup
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        }, 1);
    }
}
function parse(data) {
    data = data.split('BEGIN:VCARD')
    var objs = [] 
    for (var i = 0; i < data.length; i++) {
        objs.push(parseVCF(data[i]))
    }
    return objs
}


function parseVCF(input) {
    var Re1 = /^(version|fn|title|org):(.+)$/i;
    var Re2 = /^([^:;]+);([^:]+):(.+)$/;
    var ReKey = /item\d{1,2}\./;
    var fields = [];

    input.split(/\r\n|\r|\n/).forEach(function (line) {
        var results, key;

        if (Re1.test(line)) {
            results = line.match(Re1);
            key = results[1].toLowerCase();
            fields[key] = results[2];
        } else if (Re2.test(line)) {
            results = line.match(Re2);
            key = results[1].replace(ReKey, '').toLowerCase();

            var meta = {};
            results[2].split(';')
                .map(function (p, i) {
                var match = p.match(/([a-z]+)=(.*)/i);
                if (match) {
                    return [match[1], match[2]];
                } else {
                    return ["TYPE" + (i === 0 ? "" : i), p];
                }
            })
                .forEach(function (p) {
                meta[p[0]] = p[1];
            });

            if (!fields[key]) fields[key] = [];

            fields[key].push({
                meta: meta,
                value: results[3].split(';')
            })
        }
    });

    return fields;
};

