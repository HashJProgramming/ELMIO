<?php
  $page_title = 'Add User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  // page_require_level(1);
  $groups = find_all('user_groups');
?>
<?php
  if(isset($_POST['add_customer'])){

   $req_fields = array('fullname','address','phone');
   validate_fields($req_fields);

   if(empty($errors)){
       $fullname   = remove_junk($db->escape($_POST['fullname']));
       $address   = remove_junk($db->escape($_POST['address']));
       $phone   = remove_junk($db->escape($_POST['phone']));
        $query = "INSERT INTO customers (";
        $query .="fullname,address,phone";
        $query .=") VALUES (";
        $query .=" '{$fullname}', '{$address}', '{$phone}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"Customer has been created! ");
          redirect('add_customer.php', false);
        } else {
          //failed
          $session->msg('d',' Sorry failed to create customer!');
          redirect('add_customer.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_customer.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Customer</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="add_customer.php">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="fullname" placeholder="Full Name">
            </div>
            <div class="form-group">
                <label for="username">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
            <div class="form-group">
                <label for="username">Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Phone">
            </div>
            <div class="form-group clearfix">
              <button type="submit" name="add_customer" class="btn btn-primary">Add Customer</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
