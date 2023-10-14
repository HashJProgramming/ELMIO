<?php
  $page_title = 'Edit User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   // page_require_level(1);
?>
<?php
  $e_customer = find_by_id('customers',(int)$_GET['id']);
  if(!$e_customer){
    $session->msg("d","Missing user id.");
    redirect('customers.php');
  }
?>

<?php
//Update User basic info
  if(isset($_POST['update'])) {
    $req_fields = array('fullname','address','phone');
    validate_fields($req_fields);
    if(empty($errors)){
            $id = (int)$e_customer['id'];
            $fullname = remove_junk($db->escape($_POST['fullname']));
            $address = remove_junk($db->escape($_POST['address']));
            $phone = remove_junk($db->escape($_POST['phone']));
            $sql = "UPDATE customers SET fullname ='{$fullname}', address ='{$address}',phone='{$phone}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Customer Updated ");
            redirect('edit_customer.php?id='.(int)$e_customer['id'], false);
          } else {
            $session->msg('d',' Sorry failed to Customer!');
            redirect('edit_customer.php?id='.(int)$e_customer['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_customer.php?id='.(int)$e_customer['id'],false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Update <?php echo remove_junk(ucwords($e_customer['fullname'])); ?> Account
        </strong>
       </div>
       <div class="panel-body">
          <form method="post" action="edit_customer.php?id=<?php echo (int)$e_customer['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="fullname" class="control-label">Fullname</label>
                  <input type="text" class="form-control" name="fullname" value="<?php echo remove_junk(ucwords($e_customer['fullname'])); ?>">
            </div>
            <div class="form-group">
                  <label for="address" class="control-label">Address</label>
                  <input type="text" class="form-control" name="address" value="<?php echo remove_junk(ucwords($e_customer['address'])); ?>">
            </div>
            <div class="form-group">
                  <label for="phone" class="control-label">Phone</label>
                  <input type="text" class="form-control" name="phone" value="<?php echo remove_junk(ucwords($e_customer['phone'])); ?>">
            </div>
            <div class="form-group clearfix">
                <button type="submit" name="update" class="btn btn-info">Update</button>
            </div>
        </form>
       </div>
     </div>
  </div>
 </div>
<?php include_once('layouts/footer.php'); ?>
