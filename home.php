<?php
  define ("TITLE", "Home | Amerigas Approvals");
  require_once 'includes/functions.php';
  require_once 'includes/sessions.php';
  require_once 'includes/header.php';
  require_once 'includes/mysqlConnector.php';


  if (!isset($_SESSION['ID'])) {
    redirect_to('index.php');
  }

$listConn = my_conn();
$listSql = "SELECT * FROM held_invoices where auth_status =  'H'";
$listResult = $listConn->query($listSql);

?>
  
  <div class="container mt-5">
    <div class="row mt-3">
      <div class="col-12">
        <table id="dataTable" class="table">
          <thead>
            <tr>
              <th>PRO</th>
              <th>SCAC</th>
              <th class="d-none">id</th>
              <th>Origin Zip</th>
              <th>Destination Zip</th>
              <th>Bill Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
<?php
  foreach ($listResult as $row) {
    $scac =$row['scac'];
    $pro =$row['pro'];
    $oZip = $row["ozip"];
    $dZip = $row["dzip"];
    $bAmt = $row["bill_amt"];
    $id = $row["uniqueID"];
  ?>

  <tr>
    <td><?php echo $pro; ?></td>
    <td><?php echo $scac; ?></td>
    <td class = "id d-none"><?php echo $id; ?></td>
    <td><?php echo $oZip; ?></td>
    <td><?php echo $dZip; ?></td>
    <td><?php echo '$'.number_format(floatval($bAmt),2); ?></td>
    <td>
      <i class="fa-solid fa-eye viewButton" style="color:blue"></i>&nbsp;
      <i class="fa-solid fa-thumbs-up approveButton" style="color:green"></i> &nbsp;
      <i class="fa-solid fa-thumbs-down rejectButton" style="color:red"></i> &nbsp;
      <i class="fa-solid fa-comment" style="color:brown"></i>
    </td>
  </tr>
  <?php
  }

  ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
<script type="text/javascript">

$(".viewButton").click(function() {
        let pro = $(this).closest("tr")   // Finds the closest row <tr> 
        .find(".pro")     // Gets a descendent with class="pro"
        .text();         // Retrieves the text within <td>
        let scac = $(this).closest("tr")   // Finds the closest row <tr> 
        .find(".scac")     // Gets a descendent with class="pro"
        .text();         // Retrieves the text within <td>
        let seq = $(this).closest("tr")   // Finds the closest row <tr> 
        .find(".seq")     // Gets a descendent with class="pro"
        .text();         // Retrieves the text within <td>
        let id = pro+scac+seq
    window.open(`backupDocs.php?id=${id}`);
});

$(".rejectButton").click(function() {
          let id = $(this).closest("tr")   // Finds the closest row <tr> 
        .find(".id")     // Gets a descendent with class="pro"
        .text();         // Retrieves the text within <td>

    window.location.replace(`reject.php?invoiceID=${id}`);
});

$(".approveButton").click(function() {
          let id = $(this).closest("tr")   // Finds the closest row <tr> 
        .find(".id")     // Gets a descendent with class="pro"
        .text();         // Retrieves the text within <td>

    window.location.replace(`approve.php?invoiceID=${id}`);
});
</script>

<?php 
require_once 'includes/footer.php'; 
?>