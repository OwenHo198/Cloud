<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css">  
	<?php 
		include_once("Connect.php");
	 	if(isset($_POST["btnAdd"])){
			 $id=$_POST["txtbID"];
			 $name=$_POST["txtbName"];
			 $email=$_POST["txtbEmail"];
			 $addr=$_POST["txtbAddr"];
			 $err="";
			 if($id==""){
				 $err.="<li>Please enter store ID!</li>";
			 }
			 if($name==""){
				 $err.="<li>Please enter store name!</li>";
			 }
			 if($email==""){
				$err.="<li>Please enter store email!</li>";
			}
			if($addr==""){
				$err.="<li>Please enter store address!</li>";
			}
			 if($err!==""){
				 echo "<ul>$err</ul>";
			 }
			 else{
				 $sq="Select * from store where storeid='$id' or storename='$name'";
				 $result=pg_query($conn,$sq);
				 if(pg_num_rows($result)==0){
					pg_query($conn,"INSERT INTO store (storeid,storename,storeemail,storeaddress) VALUES ('$id', '$name','$email','$addr') ");
					 echo '<meta http-equiv="refresh" content="0; URL=?page=Store" />';
				 }
				 else{
					 echo "<li>Already store ID or Name!</li>";
				 }
			 }
		 }
	?>
<div class="container">
	<h2>Adding Store</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtbTen" class="col-sm-2 control-label">Store ID:</label>
							<div class="col-sm-10">
							      <input style="length:50px" type="text" name="txtbID" id="txtbID" class="form-control" placeholder="Store ID" value='<?php echo isset($_POST["txtbID"])?($_POST["txtbID"]):"";?>'>
							</div>
					</div>	
					<div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Store Name:</label>
							<div class="col-sm-10">
							      <input type="text" name="txtbName" id="txtbName" class="form-control" placeholder="Store Name" value='<?php echo isset($_POST["txtbName"])?($_POST["txtbName"]):"";?>'>
							</div>
					</div>
					<div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Store Email:</label>
							<div class="col-sm-10">
							      <input type="text" name="txtbEmail" id="txtbEmail" class="form-control" placeholder="Store Email" value='<?php echo isset($_POST["txtbEmail"])?($_POST["txtbEmail"]):"";?>'>
							</div>
					</div>
					<div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Store Address:</label>
							<div class="col-sm-10">
							      <input type="text" name="txtbAddr" id="txtbAddr" class="form-control" placeholder="Store Address" value='<?php echo isset($_POST["txtbAddr"])?($_POST["txtbAddr"]):"";?>'>
							</div>
					</div>
                    <!-- <div class="form-group">
						    <label for="txtbMoTa" class="col-sm-2 control-label">Description:</label>
							<div class="col-sm-10">
							      <input type="text" name="txtbDes" id="txtbDes" class="form-control" placeholder="Description" value='< php echo isset($_POST["txtbDes"])?($_POST["txtbDes"]):"";?>'>
							</div>
					</div> -->
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add"/>
                              <input type="button" class="btn btn-primary" name="btnCancel"  id="btnCancel" value="Cancel" onclick="window.location='index.php'" />
                              	
						</div>
					</div>
				</form>
	</div>