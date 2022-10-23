     <!-- Bootstrap --> 
     <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <?php
		include_once("Connect.php");
		if(isset($_GET["id"])){
			$id=$_GET["id"];
			$result=pg_query($conn, "SELECT * FROM suppiler WHERE SuppilerID='$id'");
			$row=pg_fetch_array($result);
			$store_id=$row['SuppilerID'];
			$cat_name=$row['SuppilerName'];
	?>
	<?php
		}
		else{
			echo'<meta http-equiv="refresh" content="0;URL=Suplier.php" />';
		}
	?>
	
<div class="container">
	<h2>Updating Store</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtbTen" class="col-sm-2 control-label">Supplier ID:  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtbID" id="txtbID" class="form-control" placeholder="Store ID" readonly 
								  value='<?php echo $store_id; ?>'>
							</div>
				</div>	
				 <div class="form-group">
						    <label for="txtbTen" class="col-sm-2 control-label">Supplier Name:  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtbName" id="txtbName" class="form-control" placeholder="Store Name" 
								  value='<?php echo $cat_name; ?>'>
							</div>
				</div>
                    
				<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                              <input type="button" class="btn btn-primary" name="btnCancel"  id="btnCancel" value="Cancel" onclick="window.location='index.php'" />
						</div>
				</div>
				</form>
</div>
    <?php
		if(isset($_POST["btnUpdate"])){
			$id=$_POST["txtbID"];
			$name=$_POST["txtbName"];
			// $des=$_POST["txtbDes"];
			$err="";
			if($name==""){
				$err.="<li>Please enter supplier name!</li>";
			}
			if($err!=""){
				echo"<ul>$err</ul>";
			}
			else{
				$sq="SELECT * From store WHERE SuppilerID !='$id' and SuppilerName='$name'";
				$result=pg_query($conn,$sq);
				if(pg_num_rows($result)==0){
					pg_query($conn, "UPDATE suppiler SET SuppilerName='$name' WHERE SuppilerID='$id'");
					echo '<meta http-equiv="refresh" content="0; URL=?page=Suplier" />';
				}
				else{
					echo "<li>Already Store Name!</li>";
				}
			}
		}
	?>
