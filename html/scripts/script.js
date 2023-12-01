$(function(){
    $("button").click(function(data){
      $.ajax({url: "php/person.php", success: function(result){
        console.log("clickat" + data)
        $("#main").html(result);
      }});
    });
  });
  



var h

var xmax = 600
var ymax = 600
var coords = []


document.addEventListener('DOMContentLoaded',domloaded,false);
function domloaded(){
    h = document.getElementById("hasse");
   
}






function kalle()
{
    i++
    return i;
}

function storeCoordinate(xVal, yVal, array) {
    array.push({x: xVal, y: yVal});
}

function test() {
    x = Math.floor(Math.random() * xmax);
    y = Math.floor(Math.random() * ymax);
    storeCoordinate(x,y,coords)
    paintCoords(coords)
}

function paintCoords(array) {
    i = 0

    var startTime = performance.now()
    var canvas = document.getElementById("myCanvas");   
    canvas.width = xmax
    canvas.height = ymax
     var ctx = canvas.getContext("2d");
    var point = coords[0]
    var xx = point.x
    var yy = point.y
    ctx.lineWidth = 1.0;
    ctx.beginPath();
    ctx.moveTo(coords[0].x, coords[0].y);
    for (i=1; i<array.length;i++) {
        point = coords[i]
        xx = point.x
        yy = point.y
        ctx.lineTo(point.x, point.y)
    }
    ctx.strokeStyle = "black";
    ctx.stroke()
    var endTime = performance.now()
    h.innerHTML=`Call paintCoords took ${endTime - startTime} milliseconds`
    console.log(`Call paintCoords took ${endTime - startTime} milliseconds`)
}




 
