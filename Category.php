<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('Please log-in!')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
}
else{
    if(isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
        echo "<script>alert('You're not adminitrator!')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    } 
 else {
?>
    <script language="javascript">
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
                pg_query($conn, "DELETE FROM category WHERE Cat_ID='$id'");
            }
        }
        ?>
    <form name="frm" method="post" action="">
        <h1>Category</h1>
        <p>
            <a class="glyphicon glyphicon-plus" href="?page=Add_Category" style="margin-left:0px">Add</a>
        </p>
        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Category Name</strong></th>
                    <th><strong>Description</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("Connect.php");
                $No = 1;
                $result = pg_query($conn, "SELECT * FROM category");
                while ($row = pg_fetch_array($result)) {
                ?>
                    <tr>
                        <td class="Category"><?php echo $No; ?></td>
                        <td><?php echo $row["Cat_Name"]; ?></td>
                        <td><?php echo $row["CAt_Des"]; ?></td>
                        <td style='text-align:center'>
                            <a href="?page=Update_Category&&id=<?php echo $row["Cat_ID"]; ?>" class="glyphicon glyphicon-pencil"></a>
                        </td>
                        <td style='text-align:center'>
                            <a href="?page=Category&&function=del&&id=<?php echo $row["Cat_ID"]; ?>" class="glyphicon glyphicon-trash" onclick="return deleteConfirm()">
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