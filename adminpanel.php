<?require_once("header_ad.php");

    // Check for active user
    if(!isset($_SESSION["AdminLogin"])){
       echo "<script>window.location.href='alog.php';  </script>";
       echo $_SESSION["AdminLogin"];
    }

    if(isset($_SESSION["AdminLogin"])){
        if ((time() - $_SESSION['last_time'])>1200){
            echo "<script>window.location.href='public/functions/logout.php';</script>";
        }
        else {
            $_SESSION['last_time'] = time();
        }
    }

    // Get amount of admins

    
    $q = mysqli_query($connect, "SELECT MAX(id) FROM `admins`");
	$max_id = mysqli_fetch_assoc($q);
    $max_id = $max_id['MAX(id)'];

    // Register new admins

    if(isset($_POST["Reg"])){
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

    $q = mysqli_query($connect, "SELECT 'login' FROM `admins` WHERE `login` = '$last_login'");
	$row = mysqli_fetch_assoc($q);
    if (!empty($row['login'])) {
        $error_used="this login is used";
    }
 
    if(isset($last_login) && isset($last_password) && empty($row['login']) ){
    $insert = mysqli_query($connect, "INSERT INTO `admins`(`login`, `password`) VALUES ('$last_login','$last_password')");
    }   

    }   

    //Delete moders if main admin 





?>
   
    <div class="container">
        <div class="">
 	    <h1 class="ng-binding">Add New Admin</h1>
         <?=(isset($error_used))?"<p style='color:red; font-size:23px;'>$error_used</p>":""; ?>
        <form method="POST" style="margin:1rem 0;">
        <?=(isset($error_login))?"<p style='color:red; font-size:23px;'>$error_login</p>":""; ?>
        <input class="form-control" required="" placeholder="Enter login" maxlength="25" name="login" id="login" type="text" value="<?=$last_login?>" style="margin-bottom: 1rem;">
        <?=(isset($error_password))?"<p style='color:red; font-size:23px;'>$error_password</p>":""; ?>
        <input class="form-control"  placeholder="Enter password" maxlength="25" name="pass" id="pass" type="password" value=""  style="margin-bottom: 1rem;">
        <input class="btn btn-lg btn-success btn-block" type="submit" name="Reg" value="Register">
        </form>
    
        <div class="answer_questions" >

 	 		<ul class="questionNoList">
                
                <? 
                for ($i=1; $i <=$max_id ; $i++) { 
                 $q = mysqli_query($connect,"SELECT * FROM `admins` WHERE `id` = $i");
                $r = mysqli_fetch_assoc($q);
                if($r['status']==1){
                    $true ="main_admin";
                } else {
                    $true ="moderator";
                }
                
                ?>
               
             <li style="display: flex; justify-content:space-around; "><p><? echo $r['id'];?></p><p><? echo $r['login'];?></p><p><? echo $true;?></p></li>
              <?  }
              
                ?>

                <!-- sample of li
  	 			<li><button class="answers">Version 1</button></li>
 	 			-->
 	 		</ul>
              
 	 	</div>

        </div>

    </div>

<? require_once("footer.php"); ?>