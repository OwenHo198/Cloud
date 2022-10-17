<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css">  
	<?php
		include_once("Connect.php");
	 	if(isset($_POST["btnAdd"])){
			 $id=$_POST["txtbID"];
			 $name=$_POST["txtbName"];
			 $des=$_POST["txtbDes"];
			 $err="";
			 if($id==""){
				 $err.="<li>Please enter Category ID!</li>";
			 }
			 if($name==""){
				 $err.="<li>Please enter Category Name!</li>";
			 }
			 if($err!==""){
				 echo "<ul>$err</ul>";
			 }
			 else{
				 $sq="Select * from category where Cat_ID='$id' or Cat_Name='$name'";
				 $result=mysqli_query($conn,$sq);
				 if(mysqli_num_rows($result)==0){
					 mysqli_query($conn,"INSERT INTO category (Cat_ID,Cat_Name, CAt_Des) VALUES ('$id', '$name', '$des') ");
					 echo '<meta http-equiv="refresh" content="0; URL=?page=Category" />';
				 }
				 else{
					 echo "<li>Already category ID or Name!</li>";
				 }
			 }
		 }
	?>
<div class="container">
	<h2>Adding Category</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtbTen" class="col-sm-2 control-label">Category ID:</label>
							<div class="col-sm-10">
							      <input style="length:50px" type="text" name="txtbID" id="txtbID" class="form-control" placeholder="Category ID" value='<?php echo isset($_POST["txtbID"])?($_POST["txtbID"]):"";?>'>
							</div>
					</div>	
					<div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Category Name:</label>
							<div class="col-sm-10">
							      <input type="text" name="txtbName" id="txtbName" class="form-control" placeholder="Catepgy Name" value='<?php echo isset($_POST["txtbName"])?($_POST["txtbName"]):"";?>'>
							</div>
					</div>
                    <div class="form-group">
						    <label for="txtbMoTa" class="col-sm-2 control-label">Description:</label>
							<div class="col-sm-10">
							      <input type="text" name="txtbDes" id="txtbDes" class="form-control" placeholder="Description" value='<?php echo isset($_POST["txtbDes"])?($_POST["txtbDes"]):"";?>'>
							</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add"/>
                              <input type="button" class="btn btn-primary" name="btnCancel"  id="btnCancel" value="Cancel" onclick="window.location='index.php'" />
                              	
						</div>
					</div>
				</form>
	</div>