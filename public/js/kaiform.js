var i=2;
  function addRow(){
   
    var table = document.getElementById("myRows");
      
     
          
          var rw = table.insertRow(0);
          var cl1 = rw.insertCell(0);
          var cl2 = rw.insertCell(1);
          var cl3 = rw.insertCell(2);
          var cl4 = rw.insertCell(3);
      
          cl1.innerHTML = "<input class='form-control' id='role[]' value='abc' name='role"+i+"' type ='text'></input>";
          cl2.innerHTML = "<input class='form-control' name='kpk"+i+"' type='text'></input>";
          cl3.innerHTML = "<input class='form-control' name='name"+i+"' type='text'></input>";
          cl4.innerHTML = "<button type='button' onclick='delRow()'  class='btn btn-danger'>Delete</button>";
          i+=1;
          
          var x = document.getElementById("myRows").rows.length;
          console.log(x);

          document.getElementById("totRow").value=x;
      
  }

  function delRow(){
    // var x = document.getElementById("myRows").rows.length;
    var y = document.getElementById("myTab").deleteRow(1);
    var x = document.getElementById("myRows").rows.length;
    console.log(x);
    document.getElementById("totRow").value=x;


    // var table = document.getElementById("myRows");
    // var rowCount = table.rows.length;
    // table.deleteRow(rowCount -1);
    // console.log(rowCount);
  }

function test(){
  // var inputs = document.getElementsByClassName('test'),
  //     names = [].map.call(inputs, function(input){
  //       return input.value;
  //     }).join('|');

  //     alert(names);

  //     var x = document.getElementById("myRows").rows.length;
  //     console.log(x);

  //     alert(document.getElementById("myRows").rows[0].innerHTML);
    
    }