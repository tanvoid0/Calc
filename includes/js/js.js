$(document).ready(function(e) {
  console.log("Start of Program!");
  $('#keydiv').focus();
  //Reset display
  $('#display').val('0');

  // Set Variables
  var log = false;
  var total = 0;
  var row;
  var product = [];
  var item = [];
  var count = 1;
  var unit = 1;
  function reset_table(){
    $('#product_price').html("");
    total = 0;
    $('#product_total').text(0);
  }


  function rowData(row, price, unit){
    var str =
      "<tr id='row"+row+"'>\
        <th scope='row'>"+row+"</th>\
        <td id='price-"+row+"'>"+price/unit+"</td>\
        <td id='unit-"+row+"'>"+unit+"</td>\
        <td id='total-"+row+"'>"+price+"</td>\
      <td><button class='btn btn-primary' onclick='alert(this)'>Edit</button></td>\
      <td><button class='btn btn-danger' onclick=deleteVar("+row+")>Delete</button></td>\
      </tr>";
      return str;
  }



  // Click Plus
  $('#plus').click(function(){
    var display = $('#display');
    var price = Number(display.val());
    row = item.length+1;

    if(unit != 1){
      var temp = unit;
      unit = price;
      price = price * temp;

    }
    product.push(price);
    product.push(unit);
    item.push(product);
    product.splice(0,2);

    $('#product_price').append(rowData(row,price,unit));

    total = total + price;
    $('#product_total').text(total);

    unit = 1;
    display.val(0);

  });

  // Click minus
  $('#minus').click(function(){
    var cng = $('#display').val()-total;
    // console.log(cng);
    $('#price_change').text(cng);
  });
  // Click Multiplication
  $('#multiplication').click(function(){
    unit = Number($('#display').val());
    $('#display').val('0');
  });

  // Numeric button
  $('#1,#2,#3,#4,#5,#6,#7,#8,#9,#0').click(function(){
    setZero();
    var v = $(this).val();
  	$('#display').val($('#display').val() + v);
  });

  // Cancel button
  $('#cancel').click(function(){
    $('#display').val('0');
  });

  // Clear button
  $('#clear').click(function(){
    $('#display').val('0');
    total = 0;
    $('#product_total').text(total);
  });

  // Plus minus button
  $('#plus_minus').click(function(){
    var v = $('#display').val();
    if($.isNumeric(v)){
      v = v * (-1);
      display(v);
    } else {
      return;
    }
  });

  // Dot button
  $('#dot').click(function(){
    var v = $('#display').val()
    if((Number.isInteger(Number(v)) == true) && (v.slice(-1) != ".")){
      $('#display').val($('#display').val()+'.');
    }
  });

  // Del button
  $('#backspace').click(function(){
    var v = $('#display').val();
    v = v.slice(0,-1);
    $('#display').val(v);
  });


  // Equal Button
  $('#equal').click(function(){
    calculate();
  });


  //  Set 0 in display
  function setZero(){
    var v = $('#display').val();
    if($('#display').val() == '0'){
      $('#display').val('');
    }
  }


$('#keydiv').bind('keydown', function(event) {
   // console.log(event.keyCode);
   var x = event.key;

   if(x >= 0 && x <= 9){
     $("#"+x).trigger('click');
   } else if(x == '*'){
     $('#multiplication').trigger('click');
   }else if(x == '+'){
     $('#plus').trigger('click');
   }else if(x == '-'){
     $('#minus').trigger('click');
   }else if(x == '/'){
     $('#devision').trigger('click');
   }else if(x == 'Delete'){
     $('#backspace').trigger('click');
   }else if(x == 'Enter'){
     // $('#plus').trigger('click');
     saveData(total);
     reset_table();
   }
   // console.log(x);
});



});

function deleteVar(row) {
  console.log($('#price-'+row));
}

function saveData(x){
  console.log("Inserted");
  $.ajax({
    type: "GET",
    url: "data.php?q=add",
    data: "total="+x,
  }).done(function(msg){
    $('#msg').html("<br/><div class='alert alert-success' >Inserted successfully</div>");
    viewData();
  });
  total = 0;
}

function updateData(str){
  var id = str;
  var price = $('#pr-'+str).val();

  $.ajax({
    type: "GET",
    url: "data.php?q=edit",
    data: "id="+id+"&pr="+price,
  }).done(function(msg){
    $('#result').html("<br/><div class='alert alert-info'>"+msg+"</div>");
    viewData();
  });
}

function deleteData(str){
  var id = str;
  $.ajax({
    type: "GET",
    url: "data.php?q=del",
    data: "id="+id,
  }).done(function(msg){
    $('#msg').html("<br/><div class='alert alert-danger'>Deleted successfully!</div>");
    viewData();
  });
}

function viewData(){
  $.ajax({
    type: "GET",
    url: "data.php",
    success: function(data){
      $('#data_table').html(data);
    }
  });
}
