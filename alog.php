<? 
require("header.php");
?>

<?
    if(isset($_POST["Log"])){
        $login = trim(htmlspecialchars(strip_tags($_POST["login"])));
        $pass= trim(htmlspecialchars(strip_tags($_POST["pass"])));

        if(!empty($login)){
            $last_login = $login;
        }else{
            $error_login = "Enter the login";
        }
        
        if(!empty($pass)){
            $last_password = md5($pass);
        }else{
            $error_password = "Enter the password";
        }
    

    if(isset($last_login) && isset($last_password)){
      
		$q = mysqli_query($connect, "SELECT * FROM `admins` WHERE `login` = '$last_login' AND `password` = '$last_password'");
		$row = mysqli_fetch_assoc($q);
		if(isset($row["login"])){           
			$_SESSION["AdminLogin"] = $row["login"];
            $_SESSION['Status'] = $row['status'];
            $_SESSION["last_time"] = time();
            echo "<script>window.location.href='adminpanel.php?Part=Admin';  
            </script>";
           
            // header("location: adminpanel.php");
		}  
	}

}   



?>


<div class="container" style="margin-top: 2rem;">

    <div>    
    <h1 class="ng-binding">Login in admin panel</h1>
    <form method="POST">
    <?=(isset($error_login))?"<p style='color:red;'>$error_login</p>":""; ?>
    <input class="form-control" required="" placeholder="Enter your login" maxlength="25" name="login" id="login" type="text" value="<?=$last_login?>" style="margin-bottom: 1rem;">
    <?=(isset($error_password))?"<p style='color:red;'>$error_password</p>":""; ?>
    <input class="form-control"  placeholder="Enter your password" maxlength="25" name="pass" id="pass" type="password" value=""  style="margin-bottom: 1rem;">
    <input class="btn btn-lg btn-success btn-block" type="submit" name="Log" value="Login">
    </form>
    </div>
  

</div>

<? require_once("footer.php"); ?>