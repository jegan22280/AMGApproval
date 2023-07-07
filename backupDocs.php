<?php  require_once 'includes/connector.php';  ?>
<?php  require_once 'includes/sessions.php';  ?>
<?php  require_once 'includes/functions.php'; ?>
<?php  require_once 'PDFMerger/PDFMerger.php'; ?>
<?php  use PDFMerger\PDFMerger;  ?>
<?php
$_SESSION['Queryparameter'] = $_GET["id"];
$queryParameter = $_SESSION['Queryparameter'];

    $backupQuery = ("SELECT CLIENT, MICRO, SCAC, PRO, SEQ, PAGE_NUM, KEYER from frtbill where PRO+SCAC+SEQ = :parameter");
    $stmt = $invDbh->prepare($backupQuery);
    $stmt->bindParam(':parameter', $queryParameter);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    // output data of each row
    foreach ($result as $row) {
      $_SESSION['pro'] = $row["PRO"];
      $_SESSION['seq'] = $row["SEQ"];
      $_SESSION['scac'] = $row["SCAC"];
      $pro =$_SESSION['pro'];
      $seq =$_SESSION['seq'];
      $scac =$_SESSION['scac'];
      $client = $row["CLIENT"];
      $micro = $row["MICRO"];
      $startPage = $row["PAGE_NUM"];
      $keyer = $row["KEYER"];
      
    }
    
    
    if (!isset($client)) {
      $_SESSION["errorMessage"] = "Image not available.";
      redirect_to('error.php');
    }
    
    if ($keyer == "EDI" ) {
      redirect_to('backupEDI.php');
    }
    
    
    $nextDocPageQuery = "SELECT top 1 CLIENT, MICRO, SCAC, PRO, SEQ, PAGE_NUM FROM frtbill WHERE micro = $micro and client = '$client' and page_num > $startPage order by PAGE_NUM";
    $nextPage = $invDbh->query($nextDocPageQuery);
    
    while ($nextRow = $nextPage->fetch()) {
      $endPage = $nextRow['PAGE_NUM'];
    }
    
    if (!isset($endPage)) {
      $endPage = 128;
    }
    
    
    if (isset($micro)) {
      
      $pdf = new PDFMerger;
      //the micro number needs broken to date and batch. the last chars represent the batch
      $batch = substr($micro, -1);
      // this will take the micro and toss the last digit [substr($micro,0,-1)] then force it to me a 6 digit [sprintf("%06d",] number then format it as a date
      $date = DateTime::createFromFormat('mdY',sprintf("%06d", substr($micro,0,-1)))->format('m-d-y');
      
      $pathTofile = '\\\\192.168.0.22\\x-drive\\DB\\'.$client.' '.$date.' '.$batch.'.pdf';
      $filename = $client.' '.$date.' '.$batch.'.pdf';
      
    if (!file_exists($pathTofile) || $endPage == 128) {
      $_SESSION["errorMessage"] = "Image not available.";
      redirect_to('error.php');
    }

    $pdf->addPDF($pathTofile, $startPage."-".($endPage-1))->merge('browser', $filename);
  // //       //REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
  // //     	//You do not need to give a file path for browser, string, or download - just the name.
    
  }
  
?>



