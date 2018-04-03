function saveData(){
  var name = $('#nm').val();
  var email = $('#em').val();
  var phone = $('#ph').val();
  var address = $('#ad').val();
  $.ajax({
    type: "GET",
    url: "server.php?p=add",
    data: "nm="+name+"&em="+email+"&ph="+phone+"&ad="+address,
  }).done(function(msg){
    // $('#result').html("<br/><div class='alert alert-info'>"+msg+"</div>");
    viewData();
  });
}

function viewData(){
  $.ajax({
    type: "GET",
    url: "server.php",
    success: function(data){
      $('tbody').html(data);
    }
  });
}

function updateData(str){
  var id = str;
  var name = $('#nm-'+str).val();
  var email = $('#em-'+str).val();
  var phone = $('#ph-'+str).val();
  var address = $('#ad-'+str).val();
  $.ajax({
    type: "GET",
    url: "server.php?p=edit",
    data: "nm="+name+"&em="+email+"&ph="+phone+"&ad="+address+"&id="+id,
  }).done(function(msg){
    // $('#result').html("<br/><div class='alert alert-info'>"+msg+"</div>");
    viewData();
  });
}

function deleteData(str){
  var id = str;
  $.ajax({
    type: "GET",
    url: "server.php?p=del",
    data: "id="+id,
  }).done(function(msg){
    $('#result').html("<br/><div class='alert alert-danger'>Deleted successfully!</div>");
    viewData();
  });
}
