<?php
include_once 'includes/classes/Crud.php';
$crud = new Crud();
$page = isset($_GET['q']) ? $_GET['q']: '';

function checker($result, $str){
  if($result){
    echo $str."ed Successfully";
  } else {
    echo $str." Failed";
  }
}

if($page == 'add'){
    $total = $_GET['total'];
    $query = "INSERT INTO price_log (price) VALUES ('$total')";
    $result = $crud->execute($query);
} else if($page == 'addPrice'){
  // $price = $_GET['pr'];
  // $unit = $_GET['un'];
  // $total = $price*$unit;
  // $query = "INSERT INTO pr SET (price) VALUES(1)";
  // $query = "INSERT INTO pr SET (price, unit, total) VALUES ($price,$unit,$total)";
  $result = $crud->execute('price','price','1');
  echo $result;
  // checker($result, "Insert");
}
else if($page == 'edit'){
    $id = $_GET['id'];
    $price = $_GET['pr'];
    $query = "UPDATE price_log SET price='$price' WHERE id='$id'";
    // echo $query;
    $result = $crud->execute($query);
    if($result){
      echo 'Updated successfully';
    } else {
      echo "Update Error!";
    }
} else if($page == 'del'){
  $id = $_GET['id'];
  $result = $crud->execute("DELETE FROM price_log WHERE id=$id");
  if($result){
    echo "deleted successfully";
  } else {
    echo "error in deletion";
  }
} else {
  $i=1;
  $result = $crud->getData("SELECT * FROM price_log ORDER BY id DESC");
  $total = 0;

  foreach($result as $key => $row){
    $total = $total + $row['price'];
    ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $row['price'] ?></td>
      <td><?php echo date('h:i:s a', strtotime($row['time'])); ?></td>
      <td>
        <button class="btn btn-warning" data-toggle="modal" data-target="#edit-<?php echo $row['id']; ?>">Edit</button>

        <div class="modal fade" id="edit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editLabel-<?php echo $row['id'];?>">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="editLabel-<?php echo $row['id']; ?>">Edit Data</h5>
              </div>

              <form>
                <div class="modal-body">
                  <input type="hidden" id="<?php echo $row['id']; ?>">
                    <div class="form-group">
                      <label for="pr">Price</label>
                      <input type="text" class="form-control" id="pr-<?php echo $row['id']; ?>" placeholder="Price" value="<?php echo $row['price']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" onclick="updateData(<?php echo $row['id']; ?>)" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </td>


      <td><button class="btn btn-danger" onclick="deleteData(<?php echo $row['id'] ?>)">Delete</button></td>
    </tr>
    <?php
    $i++;
  }
  ?>
  <td><h4>Total</h4></td>
  <td><h4><?php echo $total." Taka"; ?></h4></td>
  <?php
}
?>
