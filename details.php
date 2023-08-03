<?php
define ("TITLE", "Details | Amerigas Approvals");
require_once "includes/functions.php";
require_once "includes/header.php";
require_once "includes/sessions.php";

$uid = $_GET['invoiceID'];
$data = json_decode(file_get_contents("http://192.168.0.35/AmerigasSVC/FrtJSON.aspx?UID=".$uid));
splooge($data);
?>

<div class="container">
    <div class="row">
        <div class="col-12">
        </div>
    </div>
</div>



<?php
require_once "includes/footer.php";
?>