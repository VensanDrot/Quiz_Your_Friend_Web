<?require_once("header_ad.php");

    // Start Check for active user
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
    // End Check for active user    

    // Start Get amount of admins
        $Part = $_GET['Part'];
        $q = mysqli_query($connect, "SELECT MAX(id) FROM `admins`");
	    $max_id = mysqli_fetch_assoc($q);
        $max_id = $max_id['MAX(id)'];
    // End Get amount of admins

    // Start Register new admins

        if(isset($_POST["Reg"])){
        $login = trim(htmlspecialchars(strip_tags($_POST["login"])));
        $pass= trim(htmlspecialchars(strip_tags($_POST["pass"])));

        if(!empty($login)){
        $last_login = $login;
        }else{
        $error_login = "Enter the login";
        }

        if(!empty($pass) && strlen($pass)>8){
        $last_password = md5($pass);
        }else{
        $error_password = "Password should be at least 8 characters  ";
        }

        $q = mysqli_query($connect, "SELECT 'login' FROM `admins` WHERE `login` = '$last_login'");
	    $row = mysqli_fetch_assoc($q);
        if (!empty($row['login'])) {
        $error_used="this login is used";
        }
    
        if(isset($last_login) && isset($last_password) && empty($row['login']) ){
        $insert = mysqli_query($connect, "INSERT INTO `admins`(`login`, `password`,`status`) VALUES ('$last_login','$last_password', 0)");
        echo "<script>window.location.href='adminpanel.php?Part=Admin';</script>";
        }   

        }
    
    // End Register new admins

    //  Start New Quiz Creation start
        
        $uploadPath = "public/images/"; 
        $status = $statusMsg = ''; 
        function compressImage($source, $destination, $quality) { 
            // Get image info 
            $imgInfo = getimagesize($source); 
            $mime = $imgInfo['mime']; 

            // Create a new image from file 
            switch($mime){ 
                case 'image/jpeg': 
                    $image = imagecreatefromjpeg($source); 
                    break; 
                case 'image/png': 
                    $image = imagecreatefrompng($source); 
                    break; 
                default: 
                    $image = imagecreatefromjpeg($source); 
            } 

            // Save image 
            imagejpeg($image, $destination, $quality); 

            // Return compressed image 
            return $destination; 
        } 


    
             

        // If upload form is submitted 
       
        if(isset($_POST["New_Quiz"])){ 
            $status = 'error'; 
            $name = trim(htmlspecialchars(strip_tags($_POST["Name"])));
            $nques = trim(htmlspecialchars(strip_tags($_POST["nquestion"])));
            $quiz_name = trim(htmlspecialchars(strip_tags($_POST["quiz_name"])));
            if(!empty($name)){
                $last_name = $name;
                }else{
                $error_name = "Enter the name";
                }
            if(!empty($nques)){
                $last_nques = $nques;
                }else{
                $error_nques = "Enter the name";
                }

            $checkbox = $_POST['active'];
            if (empty($checkbox)) {
                $checkbox = 0;
            }
            if(!empty($quiz_name)){
                $last_quiz_name = $quiz_name;
                }else{
                $error_quiz_name = "Enter the Quiz name";
                }

           
            if(!empty($_FILES["image"]["name"])) { 
                // File info 
                $fileName = basename($_FILES["image"]["name"]); 
                $imageUploadPath = $uploadPath . $fileName; 
                $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 

                // Allow certain file formats 
                $allowTypes = array('jpg','png','jpeg'); 
                if(in_array($fileType, $allowTypes)){ 
                    // Image temp source 
                    $imageTemp = $_FILES["image"]["tmp_name"]; 

                    // Compress size and upload image 
                    $compressedImage = compressImage($imageTemp, $imageUploadPath, 75); 

                    if($compressedImage){ 
                        $status = 'success'; 
                        $last_img = $imageUploadPath;
                    }else{ 
                        $statusMsg = "Image compress failed!"; 
                    } 
                }else{ 
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
                } 
                }else{ 
                $statusMsg = 'Please select an image file to upload.'; 
            } 
          
            if (!empty($last_img) && !empty($last_name) && !empty($last_nques) && !empty($last_quiz_name) ){
                echo "<script>console.log('$last_name');</script>";
                echo "<script>console.log('$last_img');</script>";
                echo "<script>console.log('$last_nques');</script>";
                $insert = mysqli_query($connect,"INSERT INTO `Quizes`(`QName`,`name`, `img`, `questions`, `status`) VALUES ('$last_quiz_name','$last_name','$last_img','$last_nques','$checkbox')");
                $q =  mysqli_query($connect,"SELECT MAX(id) FROM `Quizes`");
                $que = mysqli_fetch_assoc($q);
                $tname = "Q".$que['MAX(id)'];
                echo "<script>console.log('$tname');</script>";
                $table = mysqli_query($connect,"CREATE TABLE $tname (
                    id INT(15) AUTO_INCREMENT PRIMARY KEY,
                    qid INT(15),
                    question VARCHAR(50),
                    answer VARCHAR(50),
                    status TINYINT(1) NULL,
                    img VARCHAR(50)
                    )");
                    
                
            }
            
        
        } 
     

    //  End New Quiz Creation start    

  
?>

 <!-- html part -->

    <div class="container">
     <!-- Start of the Admin part-->
        <?
        if ($Part == 'Admin') {
        ?>
     

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

 	 	    	<ul class="questionNoList err">
                  <li><p>Moderators</p></li>

                    <? 
                    for ($i=1; $i <=$max_id ; $i++) { 
                     $q = mysqli_query($connect,"SELECT * FROM `admins` WHERE `id` = $i");
                    $r = mysqli_fetch_assoc($q);
                    if($r['status']==1){
                        $true ="main_admin";
                    } else {
                        $true ="moderator";
                    }



                    if(!empty($r['login']) && $r['status']!= 1) { 

                  ?>
                 <li style="display: flex; justify-content:space-between;">
                 <button class="erase" id='<?=$r['id'];?>' onclick='deletead(this.id);' style="<?if($_SESSION['Status'] == 0) echo 'display: none;';?>">
                 <i style="font-size:15px;"class="fa-solid fa-eraser"></i></button><p><? echo $r['login'];?></p><p><? echo $true;?></p>
                </li>
                <?
                    }
                    }
                    ?>

                    <!-- sample of li
  	 	    		<li><button class="answers">Version 1</button></li>
 	 	    		-->
 	 	    	</ul>
                
 	 	    </div>

        </div>
                <?}?>

     <!-- End of the Admin part-->

     <!-- Start of the Quiz part-->               
        <?
        if ($Part == 'Quiz') {
        ?>

        <div class="">
 	        <h1 class="ng-binding">Add New Quiz</h1>
            <form method="POST" style="margin:1rem 0;" enctype="multipart/form-data">
            <?=(isset($error_name))?"<p style='color:red; font-size:23px;'>$error_name</p>":""; ?>
            <input class="form-control" required="" placeholder="Enter the label on the quiz" maxlength="25" name="Name" id="Name" type="text" value="<?=$last_name?>" style="margin-bottom: 1rem;">
            <?=(isset($error_quiz_name))?"<p style='color:red; font-size:23px;'>$error_quiz_name</p>":""; ?>
            <input class="form-control" required="" placeholder="Enter the Quiz authentication name" maxlength="25" name="quiz_name" type="text" value="<?=$last_quiz_name?>" style="margin-bottom: 1rem;">
            <?=(isset($error_nques))?"<p style='color:red; font-size:23px;'>$error_nques</p>":""; ?>
            <input class="form-control"  placeholder="Number of questions" maxlength="25" name="nquestion" id="nquestion" type="number" value="<?=$last_nques?>" style="margin-bottom: 1rem;"min="1"; max="15">
            <?=(isset($statusMsg))?"<p style='color:red; font-size:23px;'>$statusMsg</p>":""; ?>
            <input class="form-control" type="file" name="image" style="margin-bottom: 1rem;">
            <div class="checkbox_cont"> 
            <input type="checkbox" name="active" style="  width: 15px; height: 15px;" value='1' <?if($checkbox == 1){echo "checked";}?>>
             <label>Quiz active status</label>
            </div>
             <input class="btn btn-lg btn-success btn-block" type="submit" name="New_Quiz" value="Create new quiz">
            </form>
            <?}?>

        </div>
     <!-- End of the Quiz part-->         



 <!-- script parts -->


 
<script>

    //Delete moders if main admin 
        function deletead(aid) {
         document.cookie = "Adid="+aid;
         <?
             $delid = $_COOKIE['Adid'];
             if($_SESSION['Status'] == 1) {
             $delete = mysqli_query($connect, "DELETE FROM `admins` WHERE `id` = '$delid'");         
            }
         ?>  
        window.location.href='adminpanel.php?Part=Admin';
     }
    //End

    </script>







            









<? require_once("footer.php"); ?>