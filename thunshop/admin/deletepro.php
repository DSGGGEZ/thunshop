<?php
require('lock.php');
require('../dbconnect.php');

$idproduct = $_GET['idproduct'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from product where idproduct = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $idproduct);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: product.php');
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

    <h1>Thun's shop: <small>Delete Product</small></h1>

    <?php
    $sql = "select spec from product where idproduct = $idproduct";
    $name = $conn->query($sql);
    $row = $name->fetch_assoc();
    ?>
    <p>Are you sure you want to delete '<?php echo $row['spec'] ?>'?</p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="Delete">
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>