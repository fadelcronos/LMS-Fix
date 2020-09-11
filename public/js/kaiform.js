

  function addRow(){
    var num = document.getElementById("memberNum").value;
    document.getElementById("myTab").style.display = "block";
    var table = document.getElementById("myRows");
      
      for(var i=0; i<num; i++){
          
          var rw = table.insertRow(0);
          var cl1 = rw.insertCell(0);
          var cl2 = rw.insertCell(1);
          var cl3 = rw.insertCell(2);
          var cl4 = rw.insertCell(3);
      
          cl1.innerHTML = "<input type ='text'></input>";
          cl2.innerHTML = "<input type ='text'></input>";
          cl3.innerHTML = "<input type ='text'></input>";
          cl4.innerHTML = "<button onclick='delRow("+ i +")'  class='btn btn-danger'>Delete</button>";
      }
  }

  function delRow(i){
    document.getElementById("myTab").deleteRow(1);
    
    console.log("delete " + i);
  }
