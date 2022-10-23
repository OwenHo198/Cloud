<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<?php
    if (isset($_POST['btnLogin']))
	{
		$us = $_POST['txtbUsername'];
		$pa = $_POST['txtbpassword'];
    echo $us;
    echo $pa;

		$err = "";
		if($us=="") 
		{
			$err .= "Enter Username, please<br/>";
		}
		if($pa=="")
		{
			$err .= "Enter Password, please<br/>";
		}

		if($err !="")
		{
			echo $err;
		}
		else
		{
			include_once("Connect.php");
			$pass = md5($pa);
			$res = pg_query($conn, "SELECT account, userpassword, state FROM userr WHERE account='$us' AND userpassword='$pa'");
			$row = pg_fetch_array($res);
			if(pg_num_rows($res)==1)
			{
				$_SESSION["us"] = $us;
				$_SESSION["admin"] = $row["state"];
				echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
			}
			else
			{
			echo "you loged in fail";
			}
		}
	}
?>
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Log in</h3>
        </div>
        <div class="panel-body">
          <form accept-charset="UTF-8" role="form" method="post">
            <form method="post">
              <fieldset>
                <div class="form-group">
                  <input class="form-control" placeholder="Username" name="txtbUsername" id="txtbUsername" type="text" value="<?php if (isset($_POST['txtbUsername'])) echo $_POST['txtbUsername']; ?>" />
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Password" name="txtbpassword" id="txtbpassword" type="password" value="">
                </div>
                <input class="btn btn-lg btn-primary btn-block" type="submit" id="btnLogin" value="Login" name="btnLogin">
                <a class="small text-muted" href="#">Forgot password?</a>
                <p class="mt-2 mb-5 pb-lg-2">
                  <a href="?page=Register" id="small" style="margin-left:65px; font-size:22px">Create New Account</a>
                </p>
              </fieldset>
            </form>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>