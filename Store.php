<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('Please log-in!')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
} else {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
        echo "<script>alert('You are not adminitrator!')</script>";
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
                pg_query($conn, "DELETE FROM store WHERE storeid ='$id'");
            }
        }
?>
<form name="frm" method="post" action="">
        <h1>Store Managment</h1>
        <p>
            <a class="glyphicon glyphicon-plus" href="?page=Add_Store" style="margin-left:0px; font-size:20px">ADD</a>
        </p>
        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Store ID</strong></th>
                    <th><strong>Store Name</strong></th>
                    <th><strong>Store Email</strong></th>
                    <th><strong>Store Address</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("Connect.php");
                $No = 1;
                $result = pg_query($conn, "SELECT * FROM store");
                while ($row = pg_fetch_array($result)) {
                ?>
                    <tr>
                        <td class="Store"><?php echo $No; ?></td>
                        <td><?php echo $row["storeid"]; ?></td>
                        <td><?php echo $row["storename"]; ?></td>
                        <td><?php echo $row["storeemail"]; ?></td>
                        <td><?php echo $row["storeaddress"]; ?></td>
                        <td style='text-align:center'>
                            <a href="?page=Update_Store&&id=<?php echo $row["storeid"]; ?>" class="glyphicon glyphicon-pencil"></a>
                        </td>
                        <td style='text-align:center'>
                            <a href="?page=Store&&function=del&&id=<?php echo $row["storeid"]; ?>" class="glyphicon glyphicon-trash" onclick="return deleteConfirm()">
                            </a>
                        </td>
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