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

        if(!empty($pass) && strlen($pass)>=8){
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

    //  Start Quiz Question Edition
            
        $uploadPath = "public/images/"; 
        $status = $statusMsg = '';    

        if (isset($_POST['update'])){
            $answer = trim(htmlspecialchars(strip_tags($_POST["answer"])));                   
            $question_id = trim(htmlspecialchars(strip_tags($_POST["id"]))); 
                
            if(!empty($answer)){
              $last_answer = $answer;
              }else{
              $error_answer = "Enter the correct answer";
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
              

           
        


          if(!empty($last_answer) && !empty($question_id) && $sttt == 0) {
              $QID=$_GET['Qid'];
              $Q=$_GET['Q'];
              $insert = mysqli_query($connect, "UPDATE `Q$QID` SET `answer`='$last_answer' WHERE `id` = $question_id");
              $temp=$_GET['Question'];
          }
          if(!empty($last_answer) && !empty($question_id) && !empty($last_img)) {
            $QID=$_GET['Qid'];
            $Q=$_GET['Q'];
            $insert = mysqli_query($connect, "UPDATE `Q$QID` SET `answer`='$last_answer',`img`='$last_img' WHERE `id` = $question_id");
             $temp=$_GET['Question'];
         } 
         
        }

        if (isset($_POST['q_img'])){
            $question = trim(htmlspecialchars(strip_tags($_POST["QQuestion"])));                   
            $question_id = trim(htmlspecialchars(strip_tags($_POST["id"]))); 
            $checkbox = trim(htmlspecialchars(strip_tags($_POST["active"]))); 
            echo "<script>console.log('$sttt');</script>"; 
            if(!empty($question)){
                $last_question = $question;
                }else{
                $error_question = "Enter the correct question";
                }
            if (empty($checkbox)) {
                    $checkbox = 0;
                }    
               
            if(!empty($last_question) && !empty($question_id) && isset($checkbox)) {
                    $QID=$_GET['Qid'];
                    $Q=$_GET['Q'];
                    $insert = mysqli_query($connect, "UPDATE `Q$QID` SET `status`='$checkbox' WHERE `qid` = $Q");
                    $insert = mysqli_query($connect, "UPDATE `Q$QID` SET `question`='$last_question',`status`='$checkbox' WHERE `id` ='$question_id'");
                    $temp=$_GET['Question'];
                }

        }


        if (isset($_POST['add'])){
            $answern = trim(htmlspecialchars(strip_tags($_POST["answer"])));                   
            $question_id = trim(htmlspecialchars(strip_tags($_POST["id"]))); 
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
            
             

            if(!empty($answern)){
              $last_answern = $answern;
              }else{
              $error_answern = "Enter the correct answer";
              }
          
             
          if(!empty($last_answern) && !empty($question_id) && $sttt == 0) {
              $QID=$_GET['Qid'];
              $Q=$_GET['Q'];
              $insert = mysqli_query($connect, "INSERT INTO `Q$QID`(`qid`, `answer`, `status`, `img`) VALUES ('$Q','$answern','$sttt','$last_img')");
              $temp=$_GET['Question'];
          }
          if(!empty($last_answern) && !empty($question_id) && !empty($last_img)) {
            $QID=$_GET['Qid'];
            $Q=$_GET['Q'];
            $insert = mysqli_query($connect, "INSERT INTO `Q$QID`(`qid`, `answer`, `status`, `img`) VALUES ('$Q','$last_answern','$sttt','$last_img')");
            $temp=$_GET['Question'];
         }
        
        }

        if (isset($_POST['nq'])){
            $question = trim(htmlspecialchars(strip_tags($_POST["new_q"])));                   
            $question_id = trim(htmlspecialchars(strip_tags($_POST["id"]))); 
            $checkbox = trim(htmlspecialchars(strip_tags($_POST["active"]))); 
            if(!empty($question)){
                $last_question = $question;
                }else{
                $error_question = "Enter the correct question";
                }
            if (empty($checkbox)) {
                    $checkbox = 0;
                }    
               
            if(!empty($last_question) && !empty($question_id) && isset($checkbox)) {
                    $QID=$_GET['Qid'];
                    $Q=$_GET['Q'];
                    $insert=mysqli_query($connect,"INSERT INTO `Q$QID`(`qid`, `question`, `answer`, `status`) VALUES ('$Q','$last_question','edit me','$checkbox')");
                }
        }

    //  End Quiz Question Edition        
 
    // Start PassChange
        if(isset($_POST['Change'])) {
            $pass = trim(htmlspecialchars(strip_tags($_POST["pass"])));                   
            $pass1= trim(htmlspecialchars(strip_tags($_POST["pass1"]))); 
            if(!empty($pass) && strlen($pass)>=8){
                $last_password = md5($pass);
                }else{
                $error_password = "Password should be at least 8 characters  ";
            }
            if(!empty($pass1) && strlen($pass)>=8 && $pass == $pass1){
                $last_password = md5($pass);
                }else{
                $error_password1 = "Passwords is not matching!";
            }
            if (!empty($last_password)) {
                $l=$_SESSION["AdminLogin"];
                $update = mysqli_query($connect,"UPDATE `admins` SET `password`='$last_password' WHERE `login`='$l'");
            }
        
        }
    // End PassChange

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

            <div class="answer_questions" >

            <ul class="questionNoList err">
            <li><p>All quizes</p></li>

              <? 
              $q = $q = mysqli_query($connect,"SELECT MAX(id) FROM `quizes`");
              $max_quiz_id = mysqli_fetch_assoc($q);
              $max_quiz_id = $max_quiz_id['MAX(id)'];
              for ($i=1; $i <=$max_quiz_id ; $i++) { 
               $q = mysqli_query($connect,"SELECT * FROM `quizes` WHERE `id` = $i");
               $r = mysqli_fetch_assoc($q);



              if(!empty($r['QName'])) { 

            ?>
           <li style="display: flex; justify-content:space-between;">
           <button class="erase" id='<?=$r['id'];?>' onclick="location.href='adminpanel.php?Part=QuizEdit&Qid=<?=$r['id']?>&Question=<?=$r['questions']?>&Q=1'" >
           <i style="font-size:15px;" class="fa-solid fa-pen-to-square"></i>
            </button>
           <p><?=$r['QName'];?></p>
           <p><?=$r['status'];?></p>
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


            <?}?>

        
     <!-- End of the Quiz part-->         

     <!-- Start of the QuizEdit part-->               
        <?
        if ($Part == 'QuizEdit') {
        $Quiz_id = $_GET['Qid'];
        ?>
     
        <div class="">
 	        <h1 class="ng-binding">Edit the quiz</h1>

         <div class="number_question">
 	 		<ul class="pageing">
              
 	 			<? 
                for ($i=1; $i <= $_GET['Question']; $i++) { 
                    ?> 
                        <li  id ="Q<?echo $i;?>">
                        <a href="adminpanel.php?Part=QuizEdit&Qid=<?echo $_GET['Qid'];?>&Question=<?echo $_GET['Question'];?>&Q=<?echo $i;?>"><?echo $i;?>
                       </a></li> <!--  -->
                    <?
                }
                ?>
                <!-- sample of li
 	 			<li><a href="">10</a></li>
 	 		-->
            </ul>
 	 	 </div>
        </div>

        <div class=""> 
             <ul class="questionNoList">
         <?
         $QID=$_GET['Qid'];
         $Q=$_GET['Q'];
         $q = mysqli_query($connect,"SELECT MAX(id) FROM `Q$QID` WHERE `qid` = '$Q'");
         $mmm = mysqli_fetch_assoc($q);
         $mmm = $mmm['MAX(id)'];
         $g=1;
         $f=1;
        if (isset($mmm)) {
            $q = mysqli_query($connect,"SELECT MIN(id) FROM `Q$QID` WHERE `qid`= $Q");
            $min = mysqli_fetch_assoc($q);
            $min = $min['MIN(id)'];
            $q = mysqli_query($connect,"SELECT MAX(id) FROM `Q$QID` WHERE `qid`= $Q");
            $max = mysqli_fetch_assoc($q);
            $max = $max['MAX(id)'];

            for($i=$min; $i<=$max;$i++) {
             $q = mysqli_query($connect,"SELECT * FROM `Q$QID` WHERE `qid`= $Q AND `id` = $i");
             $r = mysqli_fetch_assoc($q);
             
            if(!empty($r)){
             ?>
             <? if(!empty($r['question'])) {
             $smth =$r['question'];
             $sttt =$r['status'];
             ?> 

             <form method='POST' style='margin-bottom: 2rem;'>
             <p>Question<p>
             <input name='id' type='hidden' value="<?=$r['id']?>">
             <?=(isset($error_question) && $question_id == $r['id'])?"<p style='color:red; font-size:23px;'>$error_question</p>":""; ?>
             <input class='form-control' required placeholder='Question' value='<?=$smth;?>' name='QQuestion' style='margin-bottom: 2rem;'>
             <div class='checkbox_cont'> 
              <input type='checkbox' name='active' style=' width: 15px; height: 15px; margin-top:11px;' value='1' <?if($r['status']==1){echo 'checked';}?>>
              <label style="height: 15px; margin-top:8px;">Image Status</label>
              
             </div>
             <button type='submit' class='btn' name='q_img'>Update Question</button>
             </form > <? } ?>
             <li  class="ng-scope" id="qa<?echo $i;?>">
             <p>Answer number <?=$g;?><p>
             <form method='POST' style="margin:1rem 0;" enctype="multipart/form-data">
             <input name='id' type='hidden' value="<?=$r['id']?>">
             <?=(isset($error_answer) && $question_id == $r['id'])?"<p style='color:red; font-size:23px;'>$error_answer</p>":""; ?>
             <input class="form-control" required placeholder="Answer" name="answer" type="text" value="<?=$r['answer']?>" style="margin-bottom: 1rem;">
             <?=(isset($statusMsg) && $question_id == $r['id'] && $sttt == 1)?"<p style='color:red; font-size:23px;'>$statusMsg</p>":""; ?>
             <? if($sttt==1){ ?> 
             <input class="form-control" type="file" name="image" style="margin-bottom: 1rem;"> 
             <?}?> 
             <input type="submit" class="btn" name='update'>
             </form>
             </li>
             <?
             $g++;
                }
               }
               $g++;
        }
        if (!isset($mmm)) {
            $g=1;
         ?>

             <form method='POST' style='margin-bottom: 2rem;'>
             <p>Add a question<p>
             <input name='id' type='hidden' value="<?=$g;?>">
             <?=(isset($error_question) && $question_id == $g)?"<p style='color:red; font-size:23px;'>$error_question</p>":""; ?>
             <input class='form-control' required placeholder='Question' value='' name='new_q' style='margin-bottom: 2rem;'>
             <div class='checkbox_cont'> 
              <input type='checkbox' name='active' style=' width: 15px; height: 15px; margin-top:11px;' value='1' >
              <label style="height: 15px; margin-top:8px;">Image Status</label>
              
             </div>
             <button type='submit' class='btn' name='nq'>Add Question</button>
             </form>

         <?}
         ?>
         
         <li  class="ng-scope" id="qa<?echo $i;?>">
             <p>Add a new answer<p>
             <form method='POST' style="margin:1rem 0;">
             <input name='id' type='hidden' value="<?=$g?>">
            <?=(isset($error_answern) && $question_id == $g)?"<p style='color:red; font-size:23px;'>$error_answern</p>":""; ?>
            <input class="form-control" required placeholder="New Answer" name="answer" type="text" value="<?=$answern?>" style="margin-bottom: 1rem;">
            <?=(isset($statusMsg) && $question_id == $g && $sttt == 1)?"<p style='color:red; font-size:23px;'>$statusMsg</p>":""; ?>
            <? if($sttt==1){ ?><input class="form-control" type="file" name="image" style="margin-bottom: 1rem;"> <?}?> 
            <input type="submit" class="btn" name='add'>
             </form>
         </li>
         
             </ul>
         </div>
      

            <?
            }?>

        
     <!-- End of the QuizEdit part-->
     
     <!-- Start of Password Change-->
      <?
        if ($Part == 'ChangePass') {
        $Quiz_id = $_GET['Qid'];
        ?>
     
            <div class="">
            <h1 class="ng-binding">Change Your Password</h1>
            <form method="POST" style="margin:1rem 0;">
            <?=(isset($error_password))?"<p style='color:red; font-size:23px;'>$error_password</p>":""; ?>
            <input class="form-control"  placeholder="Enter password" maxlength="25" name="pass" id="pass" type="password" value=""  style="margin-bottom: 1rem;">
            <?=(isset($error_password1))?"<p style='color:red; font-size:23px;'>$error_password1</p>":""; ?>
            <input class="form-control"  placeholder="Enter password again" maxlength="25" name="pass1" id="pass" type="password" value=""  style="margin-bottom: 1rem;">
            <input class="btn btn-lg btn-success btn-block" type="submit" name="Change" value="Change password">
            </form>
            </div>

        <?}?>
     <!-- End of Password Change-->        

    </div>   

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

    


<?


?>



            









<? require_once("footer.php"); ?>