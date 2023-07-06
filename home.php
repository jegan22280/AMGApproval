<?php
  define ("TITLE", "Home | Amerigas Approvals");
  require_once 'includes/functions.php';
  require_once 'includes/sessions.php';
  require_once 'includes/header.php';


  if (!isset($_SESSION['ID'])) {
    redirect_to('index.php');
  }

?>
  
  <div class="container mt-5">
    <div class="row mt-3">
      <div class="col-12">
        <div id="approve"></div>
      </div>
    </div>
  </div>

<script type="text/javascript">


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

</script>

<?php 
require_once 'includes/footer.php'; 
?>