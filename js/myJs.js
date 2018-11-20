var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("dateIn").setAttribute("min", today);

var i = document.getElementById("dateIn").value;


var minOut = document.getElementById("dateIn");
minOut.onchange = function() {
    
    var outDay = new Date();
    outDay = document.getElementById("dateIn").value;
    document.getElementById("dateOut").setAttribute("min", outDay);
    
}
