<?php 
  define ("TITLE", "Reject | Amerigas Approvals");
  require_once 'includes/functions.php';
  require_once 'includes/sessions.php';
  require_once 'includes/header.php';
  require_once 'includes/mysqlConnector.php';

  if ($_SESSION['ULevel'] < 700) {
    $_SESSION['errorMessage'] = 'You do not have permission to preform this action';
    redirect_to('error.php');
  }
  
  if (!isset($_SESSION['userID'])) {
    redirect_to('index.php');
  }

$_SESSION['queryParameter'] = $_GET["invoiceID"];
$queryParameter = $_SESSION['queryParameter'];
$_SESSION['shipDate'] = $_GET['shipDate'];

// fill out info in the table
$info = getInfo($queryParameter);
  
  // output data of each row
    $pro =$info['pro'];
    $_SESSION['pro']=$pro; //this is here to carry the pro to the log
    $scac =$info['scac'];
    $_SESSION['scac']=$scac; //this is here to carry the scac to the log
    $oZip = $info["ozip"];
    $dZip = $info["dzip"];
    $amount = $info["bill_amt"];
  
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-4">
            <h3>Reject Invoice</h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-4">
            <table class="table-sm">
                <tr>
                    <th scope="row">PRO</th>
                    <td class="text-right"><?php echo $pro; ?></td>
                </tr>
                <tr>
                    <th scope="row">SCAC</th>
                    <td class="text-right"><?php echo $scac; ?></td>
                </tr>
                <tr>
                    <th scope="row">Origin Zip</th>
                    <td class="text-right"><?php echo $oZip; ?></td>
                </tr>
                <tr>
                    <th scope="row">Detination Zip</th>
                    <td class="text-right"><?php echo $dZip; ?></td>
                </tr>
                <tr>
                    <th scope="row">Amount</th>
                    <td class="text-right"><?php echo "$".$amount; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-2">
            <span><strong>Comments:</strong></span>
        </div>
    </div>
    <form action="action.php" method="post">
        <div class="row">
            <div class="col-6">
                <textarea type="text" class="form-control" name="comment"> </textarea>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-1">
                <input class="btn btn-primary" type="submit" name="Reject"></input>
            </div>
            <div class="col-1">
                <button class="btn btn-danger canButton" type="submit" value="cancel">Cancel</button>
            </div>
        </div>
    </form>
</div>

<script>
    $('.canButton').click(function(event){
        event.preventDefault();
        window.location.replace(`home.php`)
    })
</script>


<?php require_once "includes/footer.php";  ?>