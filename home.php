<?php
  define ("TITLE", "Home | Amerigas Approvals");
  require_once 'includes/functions.php';
  require_once 'includes/sessions.php';
  require_once 'includes/header.php';


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
        <table class="table">
          <thead>
            <tr>
              <th>PRO</th>
              <th>SCAC</th>
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
    $scac = $rst->Fields("scac");
    $oZip = $rst->Fields("ozip");
    $dZip = $rst->Fields("dzip");
    $bAmt = $rst->Fields("bill_amt");
  ?>

  <tr>
    <td><?php echo $pro; ?></td>
    <td><?php echo $scac; ?></td>
    <td><?php echo $oZip; ?></td>
    <td><?php echo $dZip; ?></td>
    <td><?php echo '$'.number_format(floatval($bAmt),2); ?></td>
    <td>
      <i class="fa-solid fa-eye" style="color:blue"></i>&nbsp;
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

<!-- <script type="text/javascript">


// //define row context menu contents


  var table = new Tabulator("#approve", {
    ajaxURL:"includes/_hold_data.php", //ajax URL
    layout:"fitColumns", //fit columns to width of table (optional)
    headerSort:false,
    height:"100%",
    tooltips: function (cell) {
        let data = cell.getRow();
        return data._row.data.NOTES;
        },
    rowClick:function(e, row){ //nav to edit screen when row is clicked
      errorEntry(row._row.data.ID)
    },

    //Define Table Columns
    columns:[ 
      {title:"ID", field:"ID", visible:false},
      {title:"PRO", field:"PRO", headerFilter:true, headerFilterPlaceholder:"Filter by PRO..."},
      {title:"SCAC", field:"SCAC", headerFilter:true, headerFilterPlaceholder:"Filter by SCAC..."},
      {title:"Origin Zip", field:"OZIP"},
      {title:"Destination Zip", field:"DZIP"},
      {title:"Bill Amount", field:"BILL_AMT", formatter: "money"},
    ],
    pagination:'local',
    paginationSize: 15,
  });

  // $("#export").click(function(){
  //   table.download("csv", "errors.csv");
  // });

console.log(readCookie('user'));

</script> -->

<?php 
require_once 'includes/footer.php'; 
?>