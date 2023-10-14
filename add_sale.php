<?php
  $page_title = 'Add Sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(3);
  $e_customer = find_by_id('customers',(int)$_GET['id']);
?>
<?php

  if(isset($_POST['add_sale'])){
    $req_fields = array('customer_id','s_id','quantity','price','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $customer_id = $db->escape((int)$_POST['customer_id']);
          $p_id      = $db->escape((int)$_POST['s_id']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();

          $sql  = "INSERT INTO sales (";
          $sql .= " product_id,customer_id,qty,price,date";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$customer_id}','{$s_qty}','{$s_total}','{$s_date}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);
                  $session->msg('s',"Sale added. ");
                  redirect('add_sale.php?id='.$customer_id, false);
                } else {
                  $session->msg('d',' Sorry failed to add!');
                  redirect('add_sale.php?id='.$customer_id, false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('add_sale.php?id='.$customer_id,false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Find It</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Search for product name">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add Sale <?php echo remove_junk(ucwords($e_customer['fullname'])); ?></span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php">
          <input type="hidden" name="customer_id" value="<?php echo $_GET['id']?? '' ?>">
         <table class="table table-bordered">
           <thead>
            <th> Item </th>
            <th> Price </th>
            <th> Qty </th>
            <th> Total </th>
            <th> Date</th>
            <th> Action</th>
           </thead>
             <tbody  id="product_info">

              </tbody>
         </table>
       </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
