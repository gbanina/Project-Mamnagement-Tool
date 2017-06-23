function goBack() {
    window.history.back();
}

function dateFormat(date)
{
    console.log(date);
    var dd = date.getDate();
    var mm = date.getMonth()+1; //January is 0!

    var yyyy = date.getFullYear();
    if(dd<10){
        dd='0'+dd;
    }
    if(mm<10){
        mm='0'+mm;
    }
    return dd+'-'+mm+'-'+yyyy;
}

function showDiff(date1, date2){

    var diff = (date2 - date1)/1000;
    var diff = Math.abs(Math.floor(diff));

    var days = Math.floor(diff/(24*60*60));
    var leftSec = diff - days * 24*60*60;

    var hrs = Math.floor(leftSec/(60*60));
    var leftSec = leftSec - hrs * 60*60;

    var min = Math.floor(leftSec/(60));
    var leftSec = leftSec - min * 60;

    min = ( min < 10 ? "0" : "" ) + min;
    leftSec = ( leftSec < 10 ? "0" : "" ) + leftSec;

    return hrs + ":" + min + ":" + leftSec;
}

function showDiffWAdd(date1, date2, h, m, s){

    var diff = (date2 - date1)/1000;
    var diff = Math.abs(Math.floor(diff));

    var days = Math.floor(diff/(24*60*60));
    var leftSec = diff - days * 24*60*60;
    leftSec = leftSec + s;
    leftSec = leftSec + (m * 60);
    leftSec = leftSec + (h * 60) * 60;

    var hrs = Math.floor(leftSec/(60*60));
    var leftSec = leftSec - hrs * 60*60;

    //hrs = hrs + h;
    var min = Math.floor(leftSec/(60));
    var leftSec = leftSec - min * 60;

    //min = min + m;
    min = ( min < 10 ? "0" : "" ) + min;
    //leftSec = leftSec + s;
    leftSec = ( leftSec < 10 ? "0" : "" ) + leftSec;

    return hrs + ":" + min + ":" + leftSec;
}
