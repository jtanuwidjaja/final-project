function initMap() {
       
          //this is for putting the marker
       var marker = {lat: -36.8453816, lng: 174.7630664}; 
      
       var map = new google.maps.Map(document.getElementById('map'), {
           //this is for putting the marker
           // how would you add multiple markers???
           center: marker,
           
           //this is without the marker
         /* center: {lat: -34.397, lng: 150.644},*/
          zoom: 16
           
        });
          
         ////this is for putting the marker
          var marker = new google.maps.Marker({
          position: marker,
          map: map
          });  
          
          
          
      }


var Lst;
var Lst2;

function SelectItem(obj){
    //if (Lst) Lst.className='';
    //alert("in");
    var lis = document.getElementById("select_artist").getElementsByTagName("li");
    //alert(lis.length);
    for (var i = 0; i < lis.length; i++) {
        var Object = lis.item(i);
        //alert(Object.value);
        Object.className='';
        //lis.item[i].className='';
    }
    
    obj.className='active';
    Lst=obj;
    //alert(Lst.value);
    document.getElementById("artist_id").value = Lst.value;
    document.getElementById('select_time').hidden = true;
    checkstep2();
    /*alert('Work');*/
}

function SelectTime(obj){
    if (Lst2) Lst2.className='';
    obj.className='active';
    Lst2=obj;
    //alert(Lst2.value);
    document.getElementById("slot_id").value = Lst2.value;
    checkstep3();
}

function checkform()
    {
        var f = document.getElementsByClassName("rq");
        var cansubmit = true;
        for (var i = 0; i < f.length; i++) {
            if (f[i].value.length == 0) cansubmit = false;
        }
        document.getElementById('signup').disabled = !cansubmit;
    }

function checkstep1() {
    var f = document.forms["book_param"].elements;
    var cansubmitstep1 = true;
    for (var i = 0; i < f.length; i++) {
        if (f[i].value.length == 0) {
            cansubmitstep1 = false;
        }
    }
    document.getElementById('step1').disabled = !cansubmitstep1;
    document.getElementById('select_artist').hidden = true;
    document.getElementById('select_time').hidden = true;
}

function checkstep2() {
    var cansubmitstep2 =true;
    if (!Lst) {
        cansubmitstep2 = false;
    }
    document.getElementById('step2').disabled = !cansubmitstep2;
}

function checkstep3() {
    var cansubmitstep3 =true;
    if (!Lst2) {
        cansubmitstep3 = false;
    }
    document.getElementById('submitbutton').disabled = !cansubmitstep3;
}

function checkform2()
    {
        var f = document.forms["details"].elements;
        var cansubmit = true;
        

        for (var i = 0; i < f.length; i++) {
            if (f[i].value.length == 0) cansubmit = false;
        }               document.getElementById('submitbutton').disabled = !cansubmit;
    }




//function isDate(ExpiryDate) { 
//    var objDate,  // date object initialized from the ExpiryDate string 
//        mSeconds, // ExpiryDate in milliseconds 
//        day,      // day 
//        month,    // month 
//        year;     // year 
//    // date length should be 10 characters (no more no less) 
//    if (ExpiryDate.length !== 10) { 
//        return false; 
//    } 
//    // 5th and 8th character should be '/' 
//    if (ExpiryDate.substring(4, 5) !== '-' || ExpiryDate.substring(7, 8) !== '-') { 
//        return false; 
//    } 
//    // extract month, day and year from the ExpiryDate (expected format is mm/dd/yyyy) 
//    // subtraction will cast variables to integer implicitly (needed 
//    // for !== comparing) 
//    month = ExpiryDate.substring(5, 7) - 1; // because months in JS start from 0 
//    day = ExpiryDate.substring(8, 10) - 0; 
//    year = ExpiryDate.substring(0, 4) - 0; 
//    // test year range 
//    if (year < 1000 || year > 3000) { 
//        return false; 
//    } 
//    // convert ExpiryDate to milliseconds 
//    mSeconds = (new Date(year, month, day)).getTime(); 
//    // initialize Date() object from calculated milliseconds 
//    objDate = new Date(); 
//    objDate.setTime(mSeconds); 
//    // compare input date and parts from Date() object 
//    // if difference exists then date isn't valid 
//    if (objDate.getFullYear() !== year || 
//        objDate.getMonth() !== month || 
//        objDate.getDate() !== day) { 
//        return false; 
//    } 
//    // otherwise return true 
//    return true; 
//}


