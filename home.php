<?php
  define ("TITLE", "Home | Amerigas Approvals");
  require_once 'includes/functions.php';
  require_once 'includes/sessions.php';
  require_once 'includes/header.php';
  require_once 'includes/mysqlConnector.php';


  if (!isset($_SESSION['userID'])) {
    redirect_to('index.php');
  }

$listConn = my_conn();
$listSql = "SELECT * FROM held_invoices where auth_status =  'H'";
$listResult = $listConn->query($listSql);

?>
  
  <div class="container mt-5">
    <div class="row mt-3">
      <div class="col-12">
        <table id="dataTable" class="table mt-5">
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
    $seq = $row["seq"];
  ?>

  <tr>
    <td class='pro'><?php echo $pro; ?></td>
    <td class='scac'><?php echo $scac; ?></td>
    <td class = "id d-none"><?php echo $id; ?></td>
    <td><?php echo $oZip; ?></td>
    <td><?php echo $dZip; ?></td>
    <td><?php echo '$'.number_format(floatval($bAmt),2); ?></td>
    <td>
      <i class="fa-solid fa-file-arrow-down viewButton"data-toggle="tooltip" title="Download/View Backup docs"></i> &nbsp;
      <i class="fa-solid fa-thumbs-up approveButton" style="color:green"data-toggle="tooltip" title="Approve Invoice"></i> &nbsp;
      <i class="fa-solid fa-thumbs-down rejectButton" style="color:red"data-toggle="tooltip" title="Reject Invoice"></i> &nbsp;
      <i class="fa-solid fa-comment commentButton" style="color:brown"data-toggle="tooltip" title="Add Comment only"></i>
    </td>
  </tr>

  <?php
  }
  $listConn -> close();
  ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
<script type="text/javascript">

$(".viewButton").click(function() {

        let id = $(this).closest("tr")   // Finds the closest row <tr> 
        .find(".id")     // Gets a descendent with class="pro"
        .text();         // Retrieves the text within <td>
        
    // window.open(`backupDocs.php?id=${id}`);
    // window.location.replace(`https://payments.dblinc.net/GetClientIMG/GetImage.aspx?CLIENT=AMG&UID=${id}`);
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

$(".commentButton").click(function() {
          let id = $(this).closest("tr")   // Finds the closest row <tr> 
        .find(".id")     // Gets a descendent with class="pro"
        .text();         // Retrieves the text within <td>

    window.location.replace(`comment.php?invoiceID=${id}`);
});

</script>

<?php 
require_once 'includes/footer.php'; 
?>