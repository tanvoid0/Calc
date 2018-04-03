<?php
  include_once 'includes/classes/Crud.php';
  $crud = new Crud();
  $page = isset($_GET['p']) ? $_GET['p']: '';
  if($page == 'add'){
      $name = $_GET['nm'];
      $email = $_GET['em'];
      $phone = $_GET['ph'];
      $address = $_GET['ad'];
      $query = "INSERT INTO crud (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
      echo $query;
      $result = $crud->execute($query);
  }
  else if($page == 'edit'){
      $id = $_GET['id'];
      $name = $_GET['nm'];
      $email = $_GET['em'];
      $phone = $_GET['ph'];
      $address = $_GET['ad'];
      $query = "UPDATE crud SET name='$name', email='$email', phone='$phone', address='$address' WHERE id='$id'";
      // echo $query;
      $result = $crud->execute($query);
  }
  else if($page == 'del'){
    $id = $_GET['id'];
    $result = $crud->delete($id, 'crud');
    if($result){

    }
  }
  else {
      $result = $crud->show('crud');
      foreach ($result as $key => $row){
        ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['phone']; ?></td>
          <td><?php echo $row['address']; ?></td>
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
                          <label for="nm">Full Name</label>
                          <input type="text" class="form-control" id="nm-<?php echo $row['id']; ?>" placeholder="Name" value="<?php echo $row['name']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="em">Email address</label>
                          <input type="email" class="form-control" id="em-<?php echo $row['id']; ?>" placeholder="Enter email" value="<?php echo $row['email']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="em">Phone Number</label>
                          <input type="number" class="form-control" id="ph-<?php echo $row['id']; ?>" placeholder="Enter Phone Number" value="<?php echo $row['phone']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Address</label>
                          <textarea class="form-control" id="ad-<?php echo $row['id']; ?>" placeholder="Address"><?php echo $row['address']; ?></textarea>
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

            <button class="btn btn-danger" onclick="deleteData(<?php echo $row['id'] ?>)">Delete</button>
          </td>
        </tr>
        <?php
    }
}

?>
