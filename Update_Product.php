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
			$sqlstring = "SELECT categoryid, categoryname from category";
			$result = pg_query($conn, $sqlstring);
			echo "<select name='CategoryList' class='form-control'>
					option value='0'>Choose category</option>";
					while ($row = pg_fetch_array($result))
					{
						if ($row['categoryid'] == $selectedValue)
						{
							echo "<option value='" . $row['categoryid']."' selected>".$row['categoryname']."</option>";
						}
						else{
							echo "<option value='" .$row['categoryid']."'>".$row['categoryname']."</option>";
						}
					}
			echo"</select>";
		}
		function bind_Supplier_List($conn){
			$sqlistring="SELECT suppilerid, suppilername from suppiler";
			$result=pg_query($conn, $sqlistring);
			echo"<select name='SupplierList' class='form-control'>
			<option value='0'>
				Choose Supplier
			</option>";
			while($row=pg_fetch_array($result)){
				echo "<option value='".$row['suppilerid']."'>".$row['suppilername']."</option>";
			}
			echo "</select>"; 
		}
		function bind_Store_List($conn){
			$sqlistring="SELECT storeid, storename from store";
			$result=pg_query($conn, $sqlistring);
			echo"<select name='StoreList' class='form-control'>
			<option value='0'>
				Choose Store
			</option>";
			while($row=pg_fetch_array($result)){
				echo "<option value='".$row['storeid']."'>".$row['storename']."</option>";
			}
			echo "</select>"; 
		}
		if(isset($_GET["id"]))
		{
			$id = $_GET["id"];
			$sqlstring = "SELECT productname, price, suppilerid, productquantity, storeid, categoryid FROM product WHERE productid='$id' ";
			$result=pg_query($conn, $sqlstring);
			$row = pg_fetch_array($result);
			$pro_name 	= $row["productname"];
			$price 		= $row["price"];
			$qty 		= $row["productquantity"];
			$image 		= $row["proimg"];
			$category 	= $row["categoryid"];
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
                    <label for="lblGia" class="col-sm-2 control-label">Price:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtbPrice" id="txtbPrice" class="form-control" placeholder="Price" value='<?php echo $price ?>'/>
							</div>
                </div>   
				<div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Supplier ID:  </label>
							<div class="col-sm-10">
							      <?php bind_Supplier_List($conn,$category);?>
							</div>
                </div>
				<div class="form-group">  
                    <label for="lblSoLuong" class="col-sm-2 control-label">Quantity:  </label>
							<div class="col-sm-10">
							      <input type="number" name="txtbqty" id="txtbqty" class="form-control" placeholder="Quantity" value="<?php echo $qty ?>"/>
							</div>
                </div>
				<div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Store ID:  </label>
							<div class="col-sm-10">
							      <?php bind_Store_List($conn,$category);?>
							</div>
                </div>
				<div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Category ID:  </label>
							<div class="col-sm-10">
							      <?php bind_Category_List($conn,$category);?>
							</div>
                </div>
				<div class="form-group">  
	                <label for="sphinhanh" class="col-sm-2 control-label">Image:  </label>
							<div class="col-sm-10">
							<img src='images/<?php echo $image ?>' border='0' width="50" height="auto"  />
							      <input type="file" name="txtbImage" id="txtbImage" class="form-control" value=""/>
							</div>
                </div>  
                <!-- <div class="form-group">   
                    <label for="lblShort" class="col-sm-2 control-label">Short description:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtbSmall" id="txtbSmall" class="form-control" placeholder="Small description" value='<?php echo $short_des ?>'/>
							</div>
                </div> -->
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
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                              <input type="button" class="btn btn-primary" name="btnCancel"  id="btnIgnore" value="Ignore" onclick="window.location='index.php'" />
                              	
						</div>
				</div>
			</form>
</div>
<?php
	if (isset($_POST["btnUpdate"])) {
		$id=$_POST["txtbID"];
		$proname=$_POST["txtbName"];
		$price=$_POST["txtbPrice"];
		$qty=$_POST["txtbqty"];
		$catid=$_POST["CategoryList"];
		$storeid=$_POST["StoreList"];
		$supid=$_POST["SupplierList"];
		$pic = $_FILES["txtbImage"];
		$err = "";
		if(trim($id)==""){
			$err.="<li>Please enter product ID!</li>";
		}
		if(trim($proname)==""){
			$err.="<li>Please enter product name!</li>";
		}
		if(!is_numeric($price)){
			$err.="<li>Product price must be number!</li>";
		}
		if(trim($supid)==""){
			$err.="<li>Please enter supplier ID!</li>";
		}
		if(!is_numeric($qty)){
			$err.="<li>Product quantity must be number!</li>";
		}
		if(trim($storeid)==""){
			$err.="<li>Please enter store ID!</li>";
		}
		if(trim($catid)==""){
			$err.="<li>Please enter category ID!</li>";
		} 
		else {
			if ($pic['name'] != "") {
				if ($pic["type"] == "image/jpg" || $pic["type"] == "image/jpeg" || $pic["type"] == "image/png" || $pic["type"] == "image/gif") {
					if ($pic["size"] < 614400) {
						$sq = "SELECT * FROM product WHERE productid != '$id' and productname = '$proname'";
						$result = pg_query($conn, $sq);
							if (pg_num_rows($result) == 0){
								copy($pic['tmp_name'], "images" . $pic['name']);
								$filePic = $pic['name'];
								$sqlstring = "UPDATE product SET 
								productname = '$proname', 
								price ='$price',
								suppilerid = '$supid',
								productquantity = '$qty', 
								storeid = '$storeid',
								categoryid = '$cateid',
								proimg = '$filePic' WHERE productid ='$id'";
							pg_query($conn, $sqlstring);
							echo '<meta http-equiv="refresh" content = "0; URL=?page=Product"/>';
							} 
							else {
								echo "<li>Already category ID or Name!</li>";
							}
						} 
						else {
							echo "Size of image too big!";
						}
					} 
					else {
						echo "Image format is not correct!";
					}
			} else {
				$sq = "SELECT * FROM product WHERE productid != '$id' and productname = '$proname'";
				$result = pg_query($conn, $sq);
				if (pg_num_rows($result) == 0) {
					$sqlstring = "UPDATE product SET productname = '$proname', price ='$price', suppilerid = '$supid', productquantity = '$qty', storeid='$storeid', categoryid='$cateid' ProDate = '" . date('Y-m-d H:i:s') . "', ProductQuantity = '$qty', CategoryID = '$category' WHERE ProductID = '$id'";
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