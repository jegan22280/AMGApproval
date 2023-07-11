<?php 
  define ("TITLE", "Approve | Amerigas Approvals");
  require_once 'includes/functions.php';
  require_once 'includes/sessions.php';
  require_once 'includes/header.php';
  require_once 'includes/mysqlConnector.php';


  if (!isset($_SESSION['ID'])) {
    redirect_to('index.php');
  }

$_SESSION['Queryparameter'] = $_GET["invoiceID"];
$queryParameter = $_SESSION['Queryparameter'];

// fill out info in the table
    $info = getInfo($queryParameter);
     
    $pro =$info['pro'];
    $scac =$info['scac'];
    $oZip = $info["ozip"];
    $dZip = $info["dzip"];
    $amount = $info["bill_amt"];
  
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-4">
            <h3>Approve Invoice</h3>
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
    <form action="approve.php">
        <div class="row">
            <div class="col-6">
                <textarea type="text" class="form-control" name="comment"> </textarea>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-1">
                <button class="btn btn-primary" type="submit" value="submit">Submit</button>
            </div>
            <div class="col-1">
                <button class="btn btn-danger" type="submit" value="cancel">Cancel</button>
            </div>
        </div>
    </form>
</div>

<?php require_once "includes/footer.php";  ?>
