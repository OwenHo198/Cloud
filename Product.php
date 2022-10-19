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
                pg_query($conn, "DELETE FROM Product WHERE ProductID ='$id'");
            }
        }
        ?>
        <form name="frm" method="post" action="">
            <h1>Product Management</h1>
            <a class="glyphicon glyphicon-plus" href="?page=Add_Product">
                Add
            </a>
            <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><strong>No.</strong></th>
                        <th><strong>Product ID</strong></th>
                        <th><strong>Product Name</strong></th>
                        <th><strong>Price</strong></th>
                        <th><strong>Quantity</strong></th>
                        <th><strong>Category Name</strong></th>
                        <th><strong>Image</strong></th>
                        <th><strong>Edit</strong></th>
                        <th><strong>Delete</strong></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    include_once("Connect.php");
                    $No = 1;
                    $result = pg_query($conn, "SELECT ProductID, ProductName, Price, ProductQuantity, CatgoryID, SuppilerID FROM Product a, Category b WHERE a.CatgoryID=b.CatogryID ORDER BY ProductDate DESC");
                    while ($row = pg_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $No;  ?></td>
                            <td><?php echo $row["ProductID"]; ?></td>
                            <td><?php echo $row["ProductName"]; ?></td>
                            <td><?php echo $row["Price"]; ?></td>
                            <td><?php echo $row["ProductQuantity"]; ?></td>
                            <td><?php echo $row["CatgoryName"]; ?></td>
                            <td align='center' class='ProductImages'>
                                <img src='Images/<?php echo $row['ProductImg'] ?>' border='0' width="50" height="50" />
                            </td>
                            <td align='center' class='Update_Product'><a class="glyphicon glyphicon-pencil" href="?page=Update_Product&&id=<?php echo $row["ProductID"]; ?>"></a></td>
                            <td align='center' class='Delete_Product'><a href="?page=Product&&function=del&&id=<?php echo $row["ProductID"]; ?>" class="glyphicon glyphicon-trash" onclick="return deleteConfirm()"></a></td>
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