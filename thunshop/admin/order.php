<?php
require('lock.php');
require('../dbconnect.php');
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Thun's shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
<?php
    $idcustomer = isset($_GET['idcustomer']) ? $_GET['idcustomer'] : "";
    if ($idcustomer != "") {
        $sql = "SELECT * FROM customer_order LEFT JOIN customer ON customer.idcustomer=customer_order.idcustomer LEFT JOIN product ON product.idproduct=customer_order.idproduct LEFT JOIN branch_store ON branch_store.idbranch_store = customer_order.idbranch_store WHERE customer_order.idcustomer = '$idcustomer'";
    }
    else {
        $sql = "SELECT * FROM customer_order LEFT JOIN customer ON customer.idcustomer=customer_order.idcustomer LEFT JOIN product ON product.idproduct=customer_order.idproduct LEFT JOIN branch_store ON branch_store.idbranch_store = customer_order.idbranch_store";
    }
        $results = $conn->query($sql);
    ?>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <h1>Thun's shop Admin </h1>
    <div>
    <h4><a href="index.php" >Customer</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="product.php" >Product</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="store.php" >Store</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="order.php" >Order</a><a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    <a href="addorder.php" class="btn btn-info pull-right" style="margin-left: 10px">Add </a><h4>
    <div>
    </div>
    <br>
</div>
    <form method="get" class="form-inline">
            Type: &nbsp;
            <select name="idcustomer" class="form-control">
                <option value="">All</option>
                <?php
                $idcustomer = $conn->query('select idcustomer,name from customer');
                while($row = $idcustomer->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idcustomer'] ?>"><?php echo $row['name'] ?></option>
                    <?php
                }
                ?>
            </select>
            <input class="btn btn-primary" type="submit" value="Filter">
        </form>
    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Product</th>
                <th>Store</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['spec'] ?></td>
                <td><?php echo $row['storename'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['date'] ?></td>
                <td class="text-center">
                    <a href="editorder.php?idcustomer_order=<?php echo $row['idcustomer_order'] ?>" class="btn btn-sm btn-info">
                        <span class="glyphicon glyphicon-edit"></span>
                    <a href="deleteorder.php?idcustomer_order=<?php echo $row['idcustomer_order'] ?>" class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

<?php
$conn->close();
?>
</body>
</html>
