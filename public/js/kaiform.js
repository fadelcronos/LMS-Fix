var i=2;


  function addRow(){
    var names = $('#nameEmp option:selected').val();
    var emp = names.split("- ");
    // console.log(re[0]);
   
    var table = document.getElementById("myRows");
    var row = table.rows;

    
     
    var z = document.getElementById("myRows").rows.length+1;
          
          var rw = table.insertRow(-1);
          var cl1 = rw.insertCell(0);
          var cl2 = rw.insertCell(1);
          var cl3 = rw.insertCell(2);
          var cl4 = rw.insertCell(3);
      
                                      
          cl1.innerHTML = "<select class='form-control' name='role[]' style='width:auto'><option value='Sponsor'>Sponsor</option><option value='Facilitator'>Facilitator</option><option value='Leader'>Leader</option><option value='Co-Leader'>Co-Leader</option><option value='Participant'>Participant</option></select>";
          cl2.innerHTML = "<input class='form-control' name='kpk[]' type='text' value='"+ emp[1] +"' readonly></input>";
          cl3.innerHTML = "<input class='form-control' name='name[]' type='text' value='"+ emp[0] +"' readonly></input>";
          cl4.innerHTML = "<button type='button' onclick='delRow(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button>";
          
          // if(z == 2){
          //   cl4.innerHTML = "<button type='button' onclick='delRow()'  class='btn btn-danger'><i class='fas fa-trash'></i></button>";
          // }else{
          //   row[z-2].deleteCell(3);
          //   cl4.innerHTML = "<button type='button' onclick='delRow()'  class='btn btn-danger'><i class='fas fa-trash'></i></button>";
          // }

          // console.log(z);
          
          var x = document.getElementById("myRows").rows.length;
          // console.log(x);

          document.getElementById("totRow").value=x;
      
  }

  function delRow(r){
    // var x = document.getElementById("myRows").rows.length;
    var i = r.parentNode.parentNode.rowIndex;
    var y = document.getElementById("myTab").deleteRow(i);
    var x = document.getElementById("myRows").rows.length;
    console.log(x);
    document.getElementById("totRow").value=x;
    
    
    // var table = document.getElementById("myRows");
    // var row = table.rows;
    // var z = document.getElementById("myRows").rows.length+1;
    // var cl4 = row[z].insertCell(3);
    // cl4.innerHTML = "<button type='button' onclick='delRow()'  class='btn btn-danger'><i class='fas fa-trash'></i></button>";


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


function addScope(){
   
  var table = document.getElementById("scopeRow");
    
   
  var z = document.getElementById("scopeRow").rows.length+1;
        
        var rw = table.insertRow(-1);
        var cl1 = rw.insertCell(0);
        var cl2 = rw.insertCell(1);
        var cl3 = rw.insertCell(2);
    
                                    
        cl1.innerHTML = "<p class='text-dark text-center'>Scope "+z+"</p>";
        cl2.innerHTML = "<textarea class='form-control' name='scope[]' rows='1'></textarea>";
        cl3.innerHTML = "<button type='button' onclick='delScope(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button>";
        i+=1;
        
        var x = document.getElementById("scopeRow").rows.length;
        console.log(x);

        document.getElementById("totRowScope").value=x;
    
}
function delScope(r){
  var i = r.parentNode.parentNode.rowIndex;
  var y = document.getElementById("scopeTab").deleteRow(i);
  var x = document.getElementById("scopeRow").rows.length;
  console.log(x);
  document.getElementById("totRowScope").value=x;

}
function addBack(){
   
  var table = document.getElementById("backRow");
    
   
  var z = document.getElementById("backRow").rows.length+1;
        
        var rw = table.insertRow(-1);
        var cl1 = rw.insertCell(0);
        var cl2 = rw.insertCell(1);
        var cl3 = rw.insertCell(2);
    
                                    
        cl1.innerHTML = "<p class='text-dark text-center'>Background "+z+"</p>";
        cl2.innerHTML = "<textarea class='form-control' name='back[]' rows='1'></textarea>";
        cl3.innerHTML = "<button type='button' onclick='delBack(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button>";
        i+=1;
        
        var x = document.getElementById("backRow").rows.length;
        console.log(x);

        document.getElementById("totRowBack").value=x;
    
}
function delBack(r){
  var i = r.parentNode.parentNode.rowIndex;
  var y = document.getElementById("backTab").deleteRow(i);
  var x = document.getElementById("backRow").rows.length;
  console.log(x);
  document.getElementById("totRowBack").value=x;

}
function addBase(){
   
  var table = document.getElementById("baseRow");
    
   
  var z = document.getElementById("baseRow").rows.length+1;
        
        var rw = table.insertRow(-1);
        var cl1 = rw.insertCell(0);
        var cl2 = rw.insertCell(1);
        var cl3 = rw.insertCell(2);

                                    
        cl1.innerHTML = "<p class='text-dark text-center'>Baseline"+z+"</p>";
        cl2.innerHTML = "<textarea class='form-control' name='base[]' id='base"+z+"' rows='1'></textarea>";
        cl3.innerHTML = "<button type='button' onclick='delBase(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button>";
        
        i+=1;
        
        var x = document.getElementById("baseRow").rows.length;
        console.log(x);

        document.getElementById("totRowBase").value=x;
    
}
function delBase(r){
  var i = r.parentNode.parentNode.rowIndex;

  var y = document.getElementById("baseTab").deleteRow(i);
  var x = document.getElementById("baseRow").rows.length;
  console.log(x);
  document.getElementById("totRowBase").value=x;

}
function addGoals(){
   
  var table = document.getElementById("goalsRow");
    
   
  var z = document.getElementById("goalsRow").rows.length+1;
        
        var rw = table.insertRow(-1);
        var cl1 = rw.insertCell(0);
        var cl2 = rw.insertCell(1);
        var cl3 = rw.insertCell(2);
    
                                    
        cl1.innerHTML = "<p class='text-dark text-center'>Goals "+z+"</p>";
        cl2.innerHTML = "<textarea class='form-control' name='goals[]' rows='1'></textarea>";
        cl3.innerHTML = "<button type='button' onclick='delGoals(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button>";
        i+=1;
        
        var x = document.getElementById("goalsRow").rows.length;
        console.log(x);

        document.getElementById("totRowGoals").value=x;
    
}
function delGoals(r){
  var i = r.parentNode.parentNode.rowIndex;

  var y = document.getElementById("goalsTab").deleteRow(i);
  var x = document.getElementById("goalsRow").rows.length;
  console.log(x);
  document.getElementById("totRowGoals").value=x;

}
function addDeliv(){
   
  var table = document.getElementById("delivRow");
    
   
  var z = document.getElementById("delivRow").rows.length+1;
        
        var rw = table.insertRow(-1);
        var cl1 = rw.insertCell(0);
        var cl2 = rw.insertCell(1);
        var cl3 = rw.insertCell(2);
    
                                    
        cl1.innerHTML = "<p class='text-dark text-center'>Deliverables "+z+"</p>";
        cl2.innerHTML = "<textarea class='form-control' name='deliv[]' rows='1'></textarea>";
        cl3.innerHTML = "<button type='button' onclick='delDeliv(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button>";
        i+=1;
        
        var x = document.getElementById("delivRow").rows.length;
        console.log(x);

        document.getElementById("totRowDeliv").value=x;
    
}
function delDeliv(r){
  var i = r.parentNode.parentNode.rowIndex;

  var y = document.getElementById("delivTab").deleteRow(i);
  var x = document.getElementById("delivRow").rows.length;
  console.log(x);
  document.getElementById("totRowDeliv").value=x;

}



function changeInput(){
  var x = document.getElementById("kpi1").value;

  if(x == "Quality"){
    document.getElementById("sub1").innerHTML = "YESSSSSSSSSSSSS";
  }else{
    document.getElementById("sub1").innerHTML = "You selected: " + x;

  }

}

function getData(){
  // var x = document.getElementById("myRows").rows.length;
  document.getElementById("totRow").value = "Yeayyy";
}

var memberList = [];

function addMemss(){
  var names = $('#nameEmp option:selected').val();
  // var emp = names.split("- ");

  memberList.push(names);

  for(var i = 0; i < memberList.length; i++){
    var newData = "<button class='btn btn-danger' onClick='delBtn("+i+");'>X</button>"+ memberList[i] +" <br>";
  }
  document.getElementById('myRows').innerHTML += newData;

}

