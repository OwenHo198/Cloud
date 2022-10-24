<link rel="stylesheet" href="css/bootstrap.min.css">
<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('Please log-in!')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
} else {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    } else {
?>
        <script>
            function deleteConfirm() {
                if (confirm("Are you sure to delete?")) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
        <?php
        include_once("Connect.php");
        if (isset($_GET["function"]) == "del") {
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                pg_query($conn, "DELETE FROM product WHERE productid ='$id'");
            }
        }
        ?>
        <form name="frm" method="post" action="">
            <h1>Product Management</h1>
            <a class="glyphicon glyphicon-plus" href="?page=Add_Product">Add</a>
            <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><strong>No.</strong></th>
                        <th><strong>Product ID</strong></th>
                        <th><strong>Product Name</strong></th>
                        <th><strong>Price</strong></th>
                        <th><strong>Supplier ID</strong></th>
                        <th><strong>Product Quantity</strong></th>
                        <th><strong>Store ID</strong></th>
                        <th><strong>Category ID</strong></th>
                        <th><strong>Image</strong></th>
                        <th><strong>Edit</strong></th>
                        <th><strong>Delete</strong></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    include_once("Connect.php");
                    $No = 1;
                    $result = pg_query($conn, "SELECT productid, productname, price, suppilerid, productquantity, storeid, categoryid, proimg  FROM product");
                    while ($row = pg_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $No;  ?></td>
                            <td><?php echo $row["productid"]; ?></td>
                            <td><?php echo $row["productname"]; ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td><?php echo $row["suppilerid"]; ?></td>
                            <td><?php echo $row["productquantity"]; ?></td>
                            <td><?php echo $row["storeid"]; ?></td>
                            <td><?php echo $row["categoryid"]; ?></td>
                            <td align='center' class='proimg'>
                                <img src='images/<?php echo $row['proimg'] ?>' border='0' width="50" height="50" />
                            </td>
                            <td align='center' class='Update_Product'><a class="glyphicon glyphicon-pencil" href="?page=Update_Product&&id=<?php echo $row["productid"]; ?>"></a></td>
                            <td align='center' class='Delete_Product'><a href="?page=Product&&function=del&&id=<?php echo $row["productid"]; ?>" class="glyphicon glyphicon-trash" onclick="return deleteConfirm()"></a></td>
                        </tr>
                    <?php
                        $No++;
                    }
                    ?>
                </tbody>

            </table>

        </form>
<?php
    }
}
?>