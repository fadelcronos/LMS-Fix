var i=2;



  function addRow(){
   
    var table = document.getElementById("myRows");
      
     
    var z = document.getElementById("myRows").rows.length+1;
          
          var rw = table.insertRow(-1);
          var cl1 = rw.insertCell(0);
          var cl2 = rw.insertCell(1);
          var cl3 = rw.insertCell(2);
          var cl4 = rw.insertCell(3);
      
                                      
          cl1.innerHTML = "<select class='form-control' name='role"+z+"' style='width:auto'><option value='Sponsor'>Sponsor</option><option value='Facilitator'>Facilitator</option><option value='Leader'>Leader</option><option value='Co-Leader'>Co-Leader</option><option value='Participant'>Participant</option></select>";
          cl2.innerHTML = "<input class='form-control' name='kpk"+z+"' type='text'></input>";
          cl3.innerHTML = "<input class='form-control' name='name"+z+"' type='text'></input>";
          cl4.innerHTML = "<button type='button' onclick='delRow()'  class='btn btn-danger'><i class='fas fa-trash'></i></button>";
          i+=1;
          
          var x = document.getElementById("myRows").rows.length;
          console.log(x);

          document.getElementById("totRow").value=x;
      
  }

  function delRow(){
    // var x = document.getElementById("myRows").rows.length;
    var y = document.getElementById("myTab").deleteRow(-1);
    var x = document.getElementById("myRows").rows.length;
    console.log(x);
    document.getElementById("totRow").value=x;

  }

function getDate() {
    var date = new Date();
    var str = date.getFullYear() + "" + (date.getMonth() + 1) + "" + date.getDate() + "" +  date.getHours() + "" + date.getMinutes() + "" + date.getSeconds();
    var kzid = "KZ"+str;
    var a = document.getElementById("kzid").innerHTML += kzid;
    var b = document.getElementById("kzidi").value = kzid;
}

function changePage() {
  var x = document.getElementById("allK");
  var y = document.getElementById("myK");

  if (x.style.display === "none" && y.style.display === "block") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
  }
}