<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css">  
	<?php 
		include_once("Connect.php");
	 	if(isset($_POST["btnAdd"])){
			 $id=$_POST["txtbID"];
			 $name=$_POST["txtbName"];
			 $err="";
			 if($id==""){
				 $err.="<li>Please enter Supplier ID!</li>";
			 }
			 if($name==""){
				 $err.="<li>Please enter Supplier Name!</li>";
			 }
			 if($err!==""){
				 echo "<ul>$err</ul>";
			 }
			 else{
				 $sq="Select * from suppiler where suppilerid='$id' or suppilername='$name'";
				 $result=pg_query($conn,$sq);
				 if(pg_num_rows($result)==0){
					pg_query($conn,"INSERT INTO suppiler (suppilerid,suppilername) VALUES ('$id', '$name') ");
					 echo '<meta http-equiv="refresh" content="0; URL=?page=Suplier" />';
				 }
				 else{
					 echo "<li>Already supplier ID or Name!</li>";
				 }
			 }
		 }
	?>
<div class="container">
	<h2>Adding Supplier</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtbTen" class="col-sm-2 control-label">Supplier ID:</label>
							<div class="col-sm-10">
							      <input style="length:50px" type="text" name="txtbID" id="txtbID" class="form-control" placeholder="Supplier ID" value='<?php echo isset($_POST["txtbID"])?($_POST["txtbID"]):"";?>'>
							</div>
					</div>	
					<div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Supplier Name:</label>
							<div class="col-sm-10">
							      <input type="text" name="txtbName" id="txtbName" class="form-control" placeholder="Supplier Name" value='<?php echo isset($_POST["txtbName"])?($_POST["txtbName"]):"";?>'>
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