<?php
    require('dbconnect.php');
    require('header.php');

$sql = "SELECT * FROM product";
$results = $conn->query($sql);
?>
    <h1>Select something to buy<small></small></h1>
    <div class="row">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Brand</th>
                    <th>spec</th>
                    <th>type</th>
                    <th>price</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    while($row = $results->fetch_assoc()) {
                    echo '<tr>
                            <td>'.$row['brand'].'</td>
                            <td>'.$row['spec'].'</td>
                            <td>'.$row['producttype'].' baht </td>
                            <td>'.$row['price'].' baht </td>
                            <td><center><a href="checkout.php?idproduct='.$row['idproduct'].'" class="btn btn-success" role="button">Buy now</a></center></td>
                        <tr>';
                    }
                    ?>
                </tbody>
            </table>
    </div>

<?php
require('footer.php');
?>
