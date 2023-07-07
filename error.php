<?php  
 define ("TITLE", "Error | Amerigas Approvals");
require_once 'includes/sessions.php';
require_once 'includes/header.php'; 
?>

<div class="container">
  <div class="row">
    <div class="col-4 offset-4">
      <div class="error my-5 mx-auto">
        <?php echo errorMessage()  ?>
        <?php echo successMessage() ?>
      </div>
    </div>
  </div>
</div>

<?php  require_once 'includes/footer.php'; ?>
