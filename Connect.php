<?php
    
	/*$Connect = mysqli_connect("localhost","root","","qlbh") or die("Lỗi".mysqli_error($Connect));
	
	mysqli_query($Connect,'SET NAMES "utf8"');
	//mysqli_close($Connect);*/
	$Connect = pg_connect("postgres://ciocoljphegkiz:2ad8543206b87c7d4a126cb77aeb1ef0daa7e28570549133c73d73e04982ef94@ec2-3-220-207-90.compute-1.amazonaws.com:5432/d2l6jhcru6rleg");
    //$Connect = pg_connect("host=localhost port=5432 dbname=postgres");
	//$Connect = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=123456");
	
    if (!$Connect) {
        die("Connection failed");
    }
?>