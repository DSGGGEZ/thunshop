<?php
    require('dbconnect.php');
    $idproduct = $_GET['idproduct'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idbranch_store = $_POST['idbranch_store'];
    $idcustomer = $_POST['idcustomer'];
	$date = date('Y-m-d');
    

    $sql = "INSERT INTO customer_order(idpromotion,idproduct,idbranch_store,idcustomer,date) VALUES (?,?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('siiis',$idpromotion,$idproduct,$idbranch_store,$idcustomer,$date);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: index.php');
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Thun's shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

    <h1>Thun's shop<small></small></h1>

    <?php
    $sql = "select spec from product where idproduct = $idproduct";
    $spec = $conn->query($sql);
    $row = $spec->fetch_assoc();
    ?>
    <p>Buy '<?php echo $row['spec']?>'?</p>

    <form method="post" class="form">
        <div class="form-group">
            <label for="idbranch_store">Store</label>
            <select name="idbranch_store" class="form-control" value="<?php echo $row['idbranch_store'] ?>" required>
                <?php
                $idbranch_store = $conn->query('select idbranch_store, storename from branch_store');
                while($row = $idbranch_store->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idbranch_store'] ?>"><?php echo $row['storename'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idcustomer">Customer name</label>
            <select name="idcustomer" class="form-control" value="<?php echo $row['idcustomer'] ?>" required> 
                <?php
                $idcustomer = $conn->query('select idcustomer, name from customer');
                while($row = $idcustomer->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idcustomer'] ?>"><?php echo $row['name'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Price</label>
            <input type="text" name="date" class="form-control" value="<?php $date = date('m-d-Y'); echo "$date" ?>" required disabled>
        </div>
        <input class="btn btn-success" type="submit" value="Buy product"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>