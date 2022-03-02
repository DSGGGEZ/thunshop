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
    $sql = "SELECT * FROM branch_store";
    $results = $conn->query($sql);
?>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <h1>Thun's shop Admin </h1>
    <div>
    <h4><a href="index.php" >Customer</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="product.php" >Product</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="store.php" >Store</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="order.php" >Order</a><a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    <a href="addstore.php" class="btn btn-info pull-right" style="margin-left: 10px">Add </a><h4>
    <div>
    </div>
    <br>
</div>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Store Name</th>
                <th>Address</th>
                <th>City</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['storename'] ?></td>
                <td><?php echo $row['address'] ?></td>
                <td><?php echo $row['city'] ?></td>
                <td class="text-center">
                    <a href="editstore.php?idbranch_store=<?php echo $row['idbranch_store'] ?>" class="btn btn-sm btn-info">
                        <span class="glyphicon glyphicon-edit"></span>
                    <a href="deletestore.php?idbranch_store=<?php echo $row['idbranch_store'] ?>" class="btn btn-sm btn-danger">
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
