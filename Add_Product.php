    <!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php
	include_once("Connect.php");
	function bind_Category_List($conn){
		$sqlistring="SELECT Cat_ID, Cat_Name from Category";
		$result=mysqli_query($conn, $sqlistring);
		echo"<select name='CategoryList' class='form-control'>
		<option value='0'>
			Choose category
		</option>";
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			echo "<option value='".$row['Cat_ID']."'>".$row['Cat_Name']."</option>";
		}
		echo "</select>"; 
	}
	if(isset($_POST["btnAdd"])){
		$id=$_POST["txtbID"];
		$proname=$_POST["txtbName"];
		$small=$_POST["txtbShort"];
		$detail=$_POST["txtbDetail"];
		$price=$_POST["txtbPrice"];
		$qty=$_POST["txtbqty"];
		$pic=$_FILES['txtbImage'];
		$category=$_POST['CategoryList'];
		$err="";
		if(trim($id)==""){
			$err.="<li>Please enter Product ID!</li>";
		}
		if(trim($proname)==""){
			$err.="<li>Please enter Product Name!</li>";
		}
		if($category=="0"){
			$err.="<li>Please choose Product Category!</li>";
		}
		if(!is_numeric($price)){
			$err.="<li>Product price must be number!</li>";
		}
		if(!is_numeric($qty)){
			$err.="<li>Product quantity must be number!</li>";
		}
		if($err.=""){
			echo "<ul>$err</ul>";	
		}
		else{
			if($pic['type']=="image/jpg" || $pic['type']=="image/jpeg" || $pic['type']=="image/png" || $pic['type']=="image/gif"){
				if($pic['size']<=614400){
					$sq="Select * from product where Pro_ID='$id'or Pro_Name='$proname'";
					$result=mysqli_query($conn, $sq);
					if(mysqli_num_rows($result)==0){
						copy($pic['tmp_name'], "Images/".$pic['name']);
						$filePic=$pic['name'];
						$sql="INSERT INTO product (Pro_ID, Pro_Name, Price, OldPrice, SmallDes, DetailDes, ProDate, Pro_qty, Pro_img, Cat_ID)
                                    VALUES('$id', '$proname', '$price', '0', '$small', '$detail', '".date('Y-m-d H:i:s')."', $qty, '$filePic', '$category')";		
						mysqli_query($conn, $sql) or die(mysqli_error($conn));
						echo '<meta http-equiv="refresh" content="0;URL=?page=Product"/>';
					}
					else{
						echo "<li>Already Product ID or Name</li>";
					}
				}
					else{
						echo "Image format is not correct!";
					}
				}
		}
	}
	
?>
<div class="container">
	<h2>Adding New Product</h2>

	 	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="txtbTen" class="col-sm-2 control-label">Product ID:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtbID" id="txtbID" class="form-control" placeholder="Product ID" value=''/>
							</div>
				</div> 
				<div class="form-group"> 
					<label for="txtTen" class="col-sm-2 control-label">Product Name:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtbName" id="txtbName" class="form-control" placeholder="Product Name" value=''/>
							</div>
                </div>   
                <div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Product category:  </label>
							<div class="col-sm-10">
							      <?php bind_Category_List($conn); ?>
							</div>
                </div>  
                          
                <div class="form-group">
    			<label for="lblGia" class="col-sm-2 control-label">Price: </label>
    			<div class="col-sm-10">
    				<input type="text" name="txtbPrice" id="txtbPrice" class="form-control" placeholder="Price" value='' />
    			</div>
    		</div>

    		<div class="form-group">
    			<label for="lblShort" class="col-sm-2 control-label">Short description: </label>
    			<div class="col-sm-10">
    				<input type="text" name="txtbShort" id="txtbShort" class="form-control" placeholder="Short description" value='' />
    			</div>
    		</div>

    		<div class="form-group">
    			<label for="lblDetail" class="col-sm-2 control-label">Detail description: </label>
    			<div class="col-sm-10">
    				<textarea name="txtbDetail" rows="4" class="ckeditor"></textarea>
    				<script language="javascript">
    					CKEDITOR.replace('txtbDetail', {
    						skin: 'kama',
    						extraPlugins: 'uicolor',
    						uiColor: '#eeeeee',
    						toolbar: [
    							['Source', 'DocProps', '-', 'Save', 'NewPage', 'Preview', '-', 'Templates'],
    							['Cut', 'Copy', 'Paste', 'PasteText', 'PasteWord', '-', 'Print', 'SpellCheck'],
    							['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
    							['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
    							['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Subscript', 'Superscript'],
    							['OrderedList', 'UnorderedList', '-', 'Outdent', 'Indent', 'Blockquote'],
    							['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull'],
    							['Link', 'Unlink', 'Anchor', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
    							['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
    							['Style', 'FontFormat', 'FontName', 'FontSize'],
    							['TextColor', 'BGColor'],
    							['UIColor']
    						]
    					});
    				</script>

    			</div>
    		</div>

    		<div class="form-group">
    			<label for="lblSoLuong" class="col-sm-2 control-label">Quantity: </label>
    			<div class="col-sm-10">
    				<input type="number" name="txtbqty" id="txtbqty" class="form-control" placeholder="Quantity" value="" />
    			</div>
    		</div>

    		<div class="form-group">
    			<label for="sphinhanh" class="col-sm-2 control-label">Image: </label>
    			<div class="col-sm-10">
    				<input type="file" name="txtbImage" id="txtbImage" class="form-control" value="" />
    			</div>
    		</div>

    		<div class="form-group">
    			<div class="col-sm-offset-2 col-sm-10">
    				<input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add" />
    				<input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='index.php'" />

    			</div>
    		</div>
    	</form>
    </div>