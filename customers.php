<?php
  $page_title = 'All User';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
 // page_require_level(1);
//pull out all user form database
 $all_customers = find_all_customer();
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
          <span>Customers</span>
       </strong>
         <a href="add_customer.php" class="btn btn-info pull-right">Add New Customer</a>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Fullname </th>
            <th>Address</th>
            <th>Total Purchase</th>
            <th>Phone</th>
            <th style="width: 20%;">Created Date</th>
            <th class="text-center" style="width: 150px;">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_customers as $a_customer): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_customer['fullname']))?></td>
           <td><?php echo remove_junk(ucwords($a_customer['address']))?></td>
           <td>₱<?php echo remove_junk(ucwords(number_format($a_customer['total_sales']), 2))?></td>
           <td><?php echo remove_junk(ucwords($a_customer['phone']))?></td>
           <td><?php echo read_date($a_customer['created_at'])?></td>
           <td class="text-center">
             <div class="btn-group">
             <a href="add_sale.php?id=<?php echo (int)$a_customer['id'];?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Add Sale">
                  <i class="glyphicon glyphicon-list-alt"></i>
               </a>
              <a href="view_customer.php?id=<?php echo (int)$a_customer['id'];?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="View">
                  <i class="glyphicon glyphicon-eye-open"></i>
               </a>
                <a href="edit_customer.php?id=<?php echo (int)$a_customer['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                <a href="delete_customer.php?id=<?php echo (int)$a_customer['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
                </div>
           </td>
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
