<?php
  $page_title = 'All User';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
 // page_require_level(1);
//pull out all user form database
 $all_customers = find_all_customer_purchase((int)$_GET['id']);
 $e_customer = find_by_id('customers',(int)$_GET['id']);
 if(!$e_customer){
   $session->msg("d","Missing user id.");
   redirect('customers.php');
 }
 $c_purchase       = get_purchase($_GET['id']);
 $c_sale          = get_sales($_GET['id']);
 
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Customer <?php echo remove_junk(ucwords($e_customer['fullname'])); ?></span>
       </strong>
         <a href="#" class="btn btn-info pull-right">Add New Sale</a>
      </div>
     <div class="panel-body">
     
     <div class="row">
      <a href="#" style="color:black;">
        <div class="col-md-3">
          <div class="panel panel-box clearfix">
            <div class="panel-icon pull-left bg-blue2">
              <i class="glyphicon glyphicon-shopping-cart"></i>
            </div>
            <div class="panel-value pull-right">
              <h2 class="margin-top"><?php  echo $c_purchase['total']; ?> </h2>
              <p class="text-muted">Total Purchase</p>
            </div>
          </div>
        </div>
      </a>
      
      <a href="#" style="color:black;">
        <div class="col-md-3">
          <div class="panel panel-box clearfix">
            <div class="panel-icon pull-left bg-green">
              <i class="glyphicon glyphicon-usd"></i>
            </div>
            <div class="panel-value pull-right">
              <h2 class="margin-top">₱<?php  echo number_format($c_sale['total'], 2); ?></h2>
              <p class="text-muted">Total Sales</p>
            </div>
          </div>
        </div>
      </a>
    </div>

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Fullname </th>
            <th>Address</th>
            <th>Phone</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Total</th>
            <th style="width: 20%;">Purchase Date</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_customers as $a_customer): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_customer['fullname']))?></td>
           <td><?php echo remove_junk(ucwords($a_customer['address']))?></td>
           <td><?php echo remove_junk(ucwords($a_customer['phone']))?></td>
           <td><?php echo remove_junk(ucwords($a_customer['name']))?></td>
           <td><?php echo remove_junk(ucwords($a_customer['qty']))?></td>
           <td><?php echo '₱'.remove_junk(ucwords(number_format($a_customer['price']), 2))?></td>
           <td><?php echo read_date($a_customer['date'])?></td>
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
