<?php
    
	/*$Connect = mysqli_connect("localhost","root","","qlbh") or die("Lỗi".mysqli_error($Connect));
	
	mysqli_query($Connect,'SET NAMES "utf8"');
	//mysqli_close($Connect);*/
	$conn = pg_connect("postgres://zpircocemsqdrp:20d825e0fa0bdaa94522ebc1115e461d354e429b6a2845f96df60c10c48dad0e@ec2-35-170-146-54.compute-1.amazonaws.com:5432/d3joh403v838aq");
    //$Connect = pg_connect("host=localhost port=5432 dbname=postgres");
	//$Connect = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=123456");
	
    if (!$conn) {
        die("Connection failed");
    }
?>