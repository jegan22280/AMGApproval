<?php
  define ("TITLE", "Home | Amerigas Approvals");
  require_once 'includes/functions.php';
  require_once 'includes/sessions.php';
  require_once 'includes/header.php';
  require_once 'includes/connector.php';


  if (!isset($_SESSION['ID'])) {
    redirect_to('index.php');
  }


$connStr = 
        'Driver={Microsoft Access Driver (*.mdb, *.accdb)};' .
        'Dbq=\\\\192.168.0.22\\n-drive\\AmerigasPHPTest.accdb';
$con = new COM("ADODB.Connection", NULL, CP_UTF8);  // specify UTF-8 code page
$con->Open($connStr);

$rst = new COM("ADODB.Recordset");
$sql = "SELECT * FROM frtbill";
$rst->Open($sql, $con, 3, 3);  // adOpenStatic, adLockOptimistic
?>
  
  <div class="container mt-5">
    <div class="row mt-3">
      <div class="col-12">
        <table id="dataTable" class="table">
          <thead>
            <tr>
              <th>PRO</th>
              <th>SCAC</th>
              <th>SEQUENCE</th>
              <th>Origin Zip</th>
              <th>Destination Zip</th>
              <th>Bill Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
<?php
  while (!$rst->EOF) {
    $pro = $rst->Fields("pro");
    $seq = $rst->Fields("seq");
    $scac = $rst->Fields("scac");
    $oZip = $rst->Fields("ozip");
    $dZip = $rst->Fields("dzip");
    $bAmt = $rst->Fields("bill_amt");
  ?>

  <tr>
    <td class="pro"><?php echo $pro; ?></td>
    <td class="scac"><?php echo $scac; ?></td>
    <td class = "seq"><?php echo $seq; ?></td>
    <td><?php echo $oZip; ?></td>
    <td><?php echo $dZip; ?></td>
    <td><?php echo '$'.number_format(floatval($bAmt),2); ?></td>
    <td>
      <i class="fa-solid fa-eye viewButton" style="color:blue"></i>&nbsp;
      <i class="fa-solid fa-thumbs-up" style="color:green"></i> &nbsp;
      <i class="fa-solid fa-thumbs-down" style="color:red"></i> &nbsp;
      <i class="fa-solid fa-comment" style="color:brown"></i>
    </td>
  </tr>
  <?php
  $rst->MoveNext;
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
</script>

<?php 
require_once 'includes/footer.php'; 
?>