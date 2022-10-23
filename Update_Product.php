<link rel="stylesheet" href="css/bootstrap.min.css">
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php
    if(isset($_SESSION["admin"]) && $_SESSION["admin"]!=1)
    {
        echo "<script> alert('You are not administrator!')</script>";
        echo'<meta http-equiv ="refresh" content="0,URL=index.php">';
    }
    else{
?>
<?php
		include_once("Connect.php");
		function bind_Category_List($conn, $selectedValue){
			$sqlstring = "SELECT CategoryID, CategoryName from category";
			$result = pg_query($conn, $sqlstring);
			echo "<select name='CategoryList' class='form-control'>
					option value='0'>Choose category</option>";
					while ($row = pg_fetch_array($result))
					{
						if ($row['CategoryID'] == $selectedValue)
						{
							echo "<option value='" . $row['CategoryID']."' selected>".$row['CategoryName']."</option>";
						}
						else{
							echo "<option value='" .$row['CategoryID']."'>".$row['CategoryName']."</option>";
						}
					}
			echo"</select>";
		}
		if(isset($_GET["id"]))
		{
			$id = $_GET["id"];
			$sqlstring = "SELECT ProductName, Price, DetailDes, ProductQuantity, CategoryID FROM product WHERE ProductID='$id' ";
			$result=pg_query($conn, $sqlstring);
			$row = pg_fetch_array($result);
			$pro_name 	= $row["ProductName"];
			$price 		= $row["Price"];
			$qty 		= $row["ProductQuantity"];
			$image 		= $row["ProductImg"];
			$category 	= $row["CategoryID"];
	?>
<div class="container">
	<h2>Updating Product</h2>
	 	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="txtTen" class="col-sm-2 control-label">Product ID:  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtbID" id="txtbID" class="form-control" 
								  placeholder="Product ID" readonly value='<?php echo $id?>'/>
							</div>
				</div> 
				<div class="form-group"> 
					<label for="txtTen" class="col-sm-2 control-label">Product Name:  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtbPro_Name" id="txtbPro_Name" class="form-control" 
								  placeholder="Product Name" value='<?php echo $pro_name?>'/>
							</div>
                </div>   
                <div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Product category:  </label>
							<div class="col-sm-10">
							      <?php bind_Category_List($conn,$category);?>
							</div>
                </div>  
                <div class="form-group">  
                    <label for="lblGia" class="col-sm-2 control-label">Price:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtbPrice" id="txtbPrice" class="form-control" placeholder="Price" value='<?php echo $price ?>'/>
							</div>
                 </div>   
                <div class="form-group">   
                    <label for="lblShort" class="col-sm-2 control-label">Short description:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtbSmall" id="txtbSmall" class="form-control" placeholder="Small description" value='<?php echo $short_des ?>'/>
							</div>
                </div>
                <!-- <div class="form-group">  
        	        <label for="lblDetail" class="col-sm-2 control-label">Detail description:  </label>
							<div class="col-sm-10">
							      <textarea name="txtbDetail" rows="10" style="width:100%" class="ckeditor">< ?php echo $detail_des ?></textarea>
              					  <script language="javascript">
                                        CKEDITOR.replace( 'txtbDetail',
                                        {
                                            skin : 'kama',
                                            extraPlugins : 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar : [ ['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
                                                ['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                ['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
                                                ['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
                                                ['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
                                                ['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                                ['Style','FontFormat','FontName','FontSize'],
                                                ['TextColor','BGColor'],[ 'UIColor' ] ]
                                        });	
                                    </script> 
                                  
							</div>
                </div> -->
                            
            	<div class="form-group">  
                    <label for="lblSoLuong" class="col-sm-2 control-label">Quantity:  </label>
							<div class="col-sm-10">
							      <input type="number" name="txtbqty" id="txtbqty" class="form-control" placeholder="Quantity" value="<?php echo $qty ?>"/>
							</div>
                </div>
 
				<div class="form-group">  
	                <label for="sphinhanh" class="col-sm-2 control-label">Image:  </label>
							<div class="col-sm-10">
							<img src='Images/<?php echo $image ?>' border='0' width="50" height="auto"  />
							      <input type="file" name="txtbImage" id="txtbImage" class="form-control" value=""/>
							</div>
                </div>
                        
				<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                              <input type="button" class="btn btn-primary" name="btnCancel"  id="btnIgnore" value="Ignore" onclick="window.location='index.php'" />
                              	
						</div>
				</div>
			</form>
</div>
<?php
	if (isset($_POST["btnUpdate"])) {
		$id = $_POST["txtbID"];
		$proname = $_POST["txtbPro_Name"];
		$small = $_POST["txtbSmall"];
		$detail = $_POST["txtbDetail"];
		$price = $_POST["txtbPrice"];
		$qty = $_POST["txtbqty"];
		$pic = $_FILES["txtbImage"];
		$category = $_POST["CategoryList"];
		$err = "";
		if (trim($id) == "") {
			$err .= "<li>Please enter Product ID!</li>";
		}
		if (trim($proname) == "") {
			$err .= "<li>Please enter Product Name!</li>";
		}
		if ($category == "0") {
			$err .= "<li>Please choose Category!</li>";
		}
		if (!is_numeric($price)) {
			$err .= "<li>Product price must be number!</li>";
		}
		if (!is_numeric($qty)) {
			$err .= "<li>Product quantity must be number!</li>";
		} else {
			if ($pic['name'] != "") {
				if ($pic["type"] == "image/jpg" || $pic["type"] == "image/jpeg" || $pic["type"] == "image/png" || $pic["type"] == "image/gif") {
					if ($pic["size"] < 614400) {
						$sq = "SELECT * FROM product WHERE ProductID != '$id' and ProductName = '$proname'";
						$result = pg_query($conn, $sq);
							if (pg_num_rows($result) == 0){
								copy($pic['tmp_name'], "images" . $pic['name']);
								$filePic = $pic['name'];
								$sqlstring = "UPDATE product SET 
								ProductName = '$proname', 
								Price ='$price',
								SmallDes = '$small',
								DetailDes = '$detail', 
								ProDate = '" . date('Y-m-d H:i:s') . "',
								ProductQuantity = '$qty',
								ProductImg = '$filePic',
								CategoryID = '$category'WHERE ProductID ='$id'";
							pg_query($conn, $sqlstring);
							echo '<meta http-equiv="refresh" content = "0; URL=?page=Product"/>';
							} else {
								echo "<li>Already Category ID or Name!</li>";
							}
						} else {
							echo "Size of image too big!";
						}
					} else {
						echo "Image format is not correct!";
					}
			} else {
				$sq = "SELECT * FROM product WHERE ProductID != '$id' and ProductName = '$proname'";
				$result = pg_query($conn, $sq);
				if (pg_num_rows($result) == 0) {
					$sqlstring = "UPDATE product SET ProductName = '$proname', Price ='$price', SmallDes = '$small', DetailDes = '$detail', ProDate = '" . date('Y-m-d H:i:s') . "', ProductQuantity = '$qty', CategoryID = '$category' WHERE ProductID = '$id'";
					pg_query($conn, $sqlstring);
					echo '<meta http-equiv="refresh" content = "0; URL=?page=Product"/>';
				} else {
					echo "<li>Already Product ID or Name</li>";
				}
			}
		}
	}
	?>
<?php
        }
    else{
        echo '<meta http-equiv="refresh" content="0;URL=?page=Product"/>';
    }
?>
<?php	
	}
?>