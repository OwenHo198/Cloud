<?php
    if(isset($_POST['btnsearch']))
    {
        include_once("Connect.php");
        $se= $_POST['txtbSearch'];
        $result = pg_query($conn,"SELECT * from product where productname like '%{$se}%'");
    }
    ?>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <h1>Product</h1>
    <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Product Name</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>Images</strong></th>
                    <th><strong></strong></th>
            </tr>
        </thead>
			<body>
            <?php
				$No=1;
                while($row = pg_fetch_array($result))
                {
			?>
			<tr>
              <td class="cotcheckbox"><?php echo $No; ?></td>
              <td><?php echo $row["productname"] ?></td>
              <td><?php echo $row["price"] ?></td>
              <td align='center' class='columnfunction'>
                        <img src='images/<?php echo $row["proimg"] ?>' border='0' width="50px" height="60px" />
              </td>
              <td style="">Buy</td>
                        <!-- <td align='center' class='columnfunction'>
                        <a href="#" class="btn btn-warning" style="color:black">Buy</a>
                        </td> -->
            </tr>
            <?php
            $No++;
                }
			?>
			</body>
        </table>  