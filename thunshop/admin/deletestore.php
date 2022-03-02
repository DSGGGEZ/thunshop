<?php
require('lock.php');
require('../dbconnect.php');

$idbranch_store = $_GET['idbranch_store'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from branch_store where idbranch_store = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $idbranch_store);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: store.php');
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

    <h1>Thun's shop: <small>Delete Branch Store</small></h1>

    <?php
    $sql = "select storename from branch_store where idbranch_store = $idbranch_store";
    $storename = $conn->query($sql);
    $row = $storename->fetch_assoc();
    ?>
    <p>Are you sure you want to delete '<?php echo $row['storename'] ?>'?</p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="Delete">
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>