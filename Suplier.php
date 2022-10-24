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
                pg_query($conn, "DELETE FROM suppiler WHERE suppilerid ='$id'");
            }
        }
?>
<form name="frm" method="post" action="">
        <h1>Supplier Managment</h1>
        <p>
            <a class="glyphicon glyphicon-plus" href="?page=Add_Suplier" style="margin-left:0px; font-size:20px">ADD</a>
        </p>
        <table id="tablesuplier" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Supplier ID</strong></th>
                    <th><strong>Supplier Name</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("Connect.php");
                $No = 1;
                $result = pg_query($conn, "SELECT * FROM suppiler");
                while ($row = pg_fetch_array($result)) {
                ?>
                    <tr>
                        <td class="Suplier"><?php echo $No; ?></td>
                        <td><?php echo $row["suppilerid"]; ?></td>
                        <td><?php echo $row["suppilername"]; ?></td>
                        <td style='text-align:center'>
                            <a href="?page=Update_Suplier&&id=<?php echo $row["suppilerid"]; ?>" class="glyphicon glyphicon-pencil"></a>
                        </td>
                        <td style='text-align:center'>
                            <a href="?page=Suplier&&function=del&&id=<?php echo $row["suppilerid"]; ?>" class="glyphicon glyphicon-trash" onclick="return deleteConfirm()">
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
}