<?php
require('lock.php');
require('../dbconnect.php');

$idcustomer = $_GET['idcustomer'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from customer where idcustomer = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $idcustomer);
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

    <h1>Thun's shop: <small>Delete Customer</small></h1>

    <?php
    $sql = "select name from customer where idcustomer = $idcustomer";
    $name = $conn->query($sql);
    $row = $name->fetch_assoc();
    ?>
    <p>Are you sure you want to delete '<?php echo $row['name'] ?>'?</p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="Delete">
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>