 function change_branch(){
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.open("GET","ajax.php?branch="+document.getElementById("branchdd").value,false);
          xmlhttp.send(null);
          document.getElementById("tower").innerHTML=xmlhttp.responseText; 


         if(document.getElementById("branchdd").value=="Select")
          {
            document.getElementById("level").innerHTML="<label for='ex2'>Choose Tower*</label><select class='form-control'><option>Select</option></select>"
          }
           if(document.getElementById("branchdd").value!="Select")
          {
            document.getElementById("level").innerHTML="<label for='ex2'>Choose Tower*</label><select class='form-control'><option>Select</option></select>"
          }


        }

        function change_tower()
        {
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.open("GET","ajax.php?tower="+document.getElementById("towerdd").value,false);
          xmlhttp.send(null);
          document.getElementById("level").innerHTML=xmlhttp.responseText;  
}