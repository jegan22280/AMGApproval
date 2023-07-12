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

<script>
  var table = new Tabulator("#log",{
    ajaxURL:"includes/_log_data.php", //ajax url
    layout:"fitColumns", //fit columns to width of table (optional)
    headerSort:false,
    height:"100%",

    //Define Table Columns
    columns:[ 
      {title:"ID", field:"uniqueID", visible:false},
      {title:"Date", field:"date", headerFilter:true, headerFilterPlaceholder:"Filter by Date..."},
      {title:"PRO", field:"pro", headerFilter:true, headerFilterPlaceholder:"Filter by PRO..."},
      {title:"SCAC", field:"scac", headerFilter:true, headerFilterPlaceholder:"Filter by SCAC..."},
      {title:"Type", field:"action", headerFilter:true, headerFilterPlaceholder:"Filter by Type..."},
      {title:"User", field:"user", headerFilter:true, headerFilterPlaceholder:"Filter by User..."},
      {title:"Comment", field:"comment"},
    ],
    pagination:'local',
    paginationSize: 15,
  })

</script>
  <!-- create a tabulator table ordered by date bat default with all the logs in it -->