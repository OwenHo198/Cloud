     <!-- Bootstrap --> 
     <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <?php
		include_once("Connect.php");
		if(isset($_GET["id"])){
			$id=$_GET["id"];
			$result=pg_query($conn, "SELECT * FROM Category WHERE CatgoryID='$id'");
			$row=pg_fetch_array($result);
			$cat_id=$row['CatgoryID'];
			$cat_name=$row['CatgoryName'];
	?>
	<?php
		}
		else{
			echo'<meta http-equiv="refresh" content="0;URL=Category.php" />';
		}
	?>
	
<div class="container">
	<h2>Updating Product Category</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtbTen" class="col-sm-2 control-label">Category ID:  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtbID" id="txtbID" class="form-control" placeholder="Catepgy ID" readonly 
								  value='<?php echo $cat_id; ?>'>
							</div>
				</div>	
				 <div class="form-group">
						    <label for="txtbTen" class="col-sm-2 control-label">Category Name:  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtbName" id="txtbName" class="form-control" placeholder="Catepgy Name" 
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
			$des=$_POST["txtbDes"];
			$err="";
			if($name==""){
				$err.="<li>Please enter Category Name!</li>";
			}
			if($err!=""){
				echo"<ul>$err</ul>";
			}
			else{
				$sq="SELECT * From Category WHERE CatgoryID !='$id' and CatgoryName='$name'";
				$result=pg_query($conn,$sq);
				if(pg_num_rows($result)==0){
					pg_query($conn, "UPDATE Category SET CatgoryName='$name' WHERE CatgoryID='$id'");
					echo '<meta http-equiv="refresh" content="0; URL=?page=Category" />';
				}
				else{
					echo "<li>Already Category Name!</li>";
				}
			}
		}
	?>
