<?php
define ("TITLE", "Details | Amerigas Approvals");
require_once "includes/functions.php";
require_once "includes/header.php";
require_once "includes/sessions.php";

$uid = $_GET['invoiceID'];
$json = file_get_contents("http://192.168.0.35/AmerigasSVC/FrtJSON.aspx?UID=".$uid);
$data = json_decode($json, true);
$mode = array(
    'A'=>'Air',
    'AD'=>'Air Domestic',
    'AI'=>'Air International',
    'B'=>'Bulk',
    'C'=>'Climate Controlled / Reefer',
    'D'=>'Dray',
    'E'=>'Expedite',
    'EQ'=>'Equipment Lease/Rental',
    'F'=>'Forwarding',
    'H'=>'Hourly Rate Transport',
    'IM'=>'Intermodal',
    'L'=>'Less than Truckload',
    'M'=>'Final Mile',
    'N'=>'Non Freight Charges',
    'O'=>'Ocean',
    'OF'=>'Ocean Full Container',
    'OL'=>'Ocean Less than Container',
    'P'=>'Parcel/Small Package ',
    'R'=>'Rail',
    'T'=>'Truckload',
    'W'=>'Warehousing',
    'Y'=>"FLATBED"
);
    // splooge($data);
    ?>

<div class="container">
    <div class="row mt-5">
        <div class="col">
            <strong>Actions:</strong>
            <i class="fa-solid fa-file-arrow-down viewButton ml-5"data-toggle="tooltip" title="Download/View Backup docs"></i> &nbsp;
            <i class="fa-solid fa-thumbs-up approveButton" style="color:green"data-toggle="tooltip" title="Approve Invoice"></i> &nbsp;
            <i class="fa-solid fa-thumbs-down rejectButton" style="color:red"data-toggle="tooltip" title="Reject Invoice"></i> &nbsp;
            <i class="fa-solid fa-comment commentButton" style="color:brown"data-toggle="tooltip" title="Add Comment only"></i>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <h1><?php echo $data[0]['PRO']?> - <span style = "color:red;"><?php echo "$".number_format($data[0]['BILL_AMT'],2)?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h4>Shipped by <?php echo $data[0]['CARRIER']." (BOL:".$data[0]['BL'].")"?></h4>
            <?php echo "Ship date: ".date("Y-m-d", substr($data[0]['RECV_DATE'],6, -2)/1000)?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php echo ($data[0]['RECV_DATE'] <> "") ? "Delivery date: ".date("Y-m-d", substr($data[0]['RECV_DATE'],6, -2)/1000) : "" ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <strong>Shipper:</strong>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $data[0]['SHIPPER']?><br>
                    <?php echo $data[0]['OCITY'].", ".$data[0]['OSTATE']." ".$data[0]['OZIP']?></p>
                </div>
            </div>
        </div>
        
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <strong>Consignee:</strong>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $data[0]['CONSIGNEE']?><br>
                    <?php echo $data[0]['DCITY'].", ".$data[0]['DSTATE']." ".$data[0]['DZIP']?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-12">
            <hr>
        </div>
    </div> -->

    <div class="row">
        <div class="col-8">
            <table class="table  mt-3">
                <tbody>
                    <tr>
                        <td>
                            <?php 
                            echo ($data[0]['PO_NUM'] <> "") ? "<strong>PO:</strong> ".$data[0]['PO_NUM']."<br>" :"No PO on file.<br>" ;
                            echo ($data[0]['ORDER_NUM'] <> "") ? "<strong>Order:</strong> ".$data[0]['ORDER_NUM']."<br>" :"No Order # on file.<br>" 
                            ?>
                        </td>

                        <td>
                            <?php 
                            echo ($data[0]['PC'] =='P') ? "<strong>Terms:</strong> Prepaid<br>" : "";
                            echo ($data[0]['PC'] =='C') ? "<strong>Terms:</strong> Collect<br>" : "";
                            echo" <strong>Mode:</strong> ".$mode[$data[0]['MODE']];
                            ?>
                        </td>

                        <td>
                            <?php
                            if ($data[0]['BILLED_WGT'] <>'' || $data[0]['BILLED_WGT'] == $data[0]['ACTUAL_WGT']) {
                                $bw ="";
                            } else {
                                $bw =  "<strong>Billed as: </strong>".$data[0]['BILLED_WGT']."lbs<br>";
                            }
                            echo "<strong>PO Weight: </strong>".$data[0]['PO_WGT']."lbs<br>";
                            echo ($data[0]['ACTUAL_WGT'] <>'') ? "<strong>Actual weight:</strong> ".$data[0]['ACTUAL_WGT']."lbs<br>" : "";
                            echo $bw;
                            ?>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                    </tr> -->
                </tbody>
            </table>
            <table class="table table-sm mt-3">
                <?php
                echo ($data[0]['TRANSPORT_AMT'] <> 0) ? "<tr><td>Transport amount</td><td class = 'text-right'>$".number_format($data[0]['TRANSPORT_AMT'],2) : "";
                echo ($data[0]['FSC_AMT'] <> 0) ? "<tr><td>FSC amount</td><td class = 'text-right'>$".number_format($data[0]['FSC_AMT'],2) : "";
                echo ($data[0]['APPT_AMT'] <> 0) ? "<tr><td>Appointment amount</td><td class = 'text-right'>$".number_format($data[0]['APPT_AMT'],2) : "";
                echo ($data[0]['EXPEDITE_AMT'] <> 0) ? "<tr><td>Expedited shipping</td><td class = 'text-right'>$".number_format($data[0]['EXPEDITE_AMT'],2) : "";
                echo ($data[0]['SPECHANDLE_AMT'] <> 0) ? "<tr><td>Special handling</td><td class = 'text-right'>$".number_format($data[0]['SPECHANDLE_AMT'],2) : "";
                echo ($data[0]['RES_AMT'] <> 0) ? "<tr><td>Residential shippment</td><td class = 'text-right'>$".number_format($data[0]['RES_AMT'],2) : "";
                echo ($data[0]['CUSTOMS_AMT'] <> 0) ? "<tr><td>Customs charges</td><td class = 'text-right'>$".number_format($data[0]['CUSTOMS_AMT'],2) : "";
                echo ($data[0]['DETENTION'] <> 0) ? "<tr><td>Detention charges</td><td class = 'text-right'>$".number_format($data[0]['DETENTION'],2) : "";
                echo ($data[0]['ACC_AMT'] <> 0) ? "<tr><td>Non-detention Accessorials</td><td class = 'text-right'>$".number_format($data[0]['ACC_AMT'],2) : "";
                ?>
            </table>
            
        </div>
    </div>
    <!-- this is just to hold data i need for the buttons -->
    <div class="row">
        <span class="d-none UID"><?php echo $data[0]['UniqueID']; ?></span>
        <span class="d-none s_date"><?php echo date("Y-m-d", substr($data[0]['RECV_DATE'],6, -2)/1000) ?></span>
    </div>
</div>

<script type="text/javascript">

$(".viewButton").click(function() {
    let id = $(".UID").text();
    window.open(`https://payments.dblinc.net/GetClientIMG/GetImage.aspx?CLIENT=AMG&UID=${id}`);
});

$(".rejectButton").click(function() {
    let id = $(".UID").text();
    let ship = $(".s_date").text();
    window.location.assign(`reject.php?invoiceID=${id}&shipDate=${ship}`);
});

$(".approveButton").click(function() {
    let id = $(".UID").text();
    let ship = $(".s_date").text();
    window.location.assign(`approve.php?invoiceID=${id}&shipDate=${ship}`);
});

$(".commentButton").click(function() {
    let id = $(".UID").text();
    let ship = $(".s_date").text();
    window.location.assign(`comment.php?invoiceID=${id}&shipDate=${ship}`);
});

</script>

<?php
require_once "includes/footer.php";
?>