<?php
  define ("TITLE", "Logs | Amerigas Approvals");
  require_once 'includes/functions.php';
  require_once 'includes/sessions.php';
  require_once 'includes/header.php';
  require_once 'includes/mysqlConnector.php';
  ?>

<div class="container mt-5">
  <div class="row">
    <div class="col-12">
        <div id="log"></div>
    </div>
  </div>

  <!-- create a tabulator table ordered by date bat default with all the logs in it -->
<script>
  var table = new Tabulator("#log",{
    ajaxURL:"includes/_log_data.php", //ajax url
    layout:"fitColumns", //fit columns to width of table (optional)
    headerSort:false,
    height:"100%",

    //Define Table Columns
    columns:[ 
      {title:"ID", field:"uniqueID", visible:false},
      {title:"Note Date", field:"note_date", headerFilter:true, headerFilterPlaceholder:"Filter Date",width:"12rem"},
      {title:"Ship Date", field:"ship_date", headerFilter:true, headerFilterPlaceholder:"Filter Date",width:"12rem"},
      {title:"PRO", field:"pro", headerFilter:true, headerFilterPlaceholder:"Filter PRO",width:"12rem"},
      {title:"SCAC", field:"scac", headerFilter:true, headerFilterPlaceholder:"Filter SCAC",width:"12rem"},
      {title:"User", field:"user", headerFilter:true, headerFilterPlaceholder:"Filter User",width:"12rem"},
      {title:"Type", field:"action",width:"10rem"},
      {title:"Comment", field:"comment", formatter:"textarea", width:"30rem"},
    ],
    pagination:'local',
    paginationSize: 15,
  })

</script>

<?php require_once "includes/footer.php";  ?>
