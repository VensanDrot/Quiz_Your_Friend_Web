<?  
    require_once('header.php'); 
    $Qid = $_GET['Qid'];
?>
 <script>
     if (localStorage.getItem('UserId') !== null) {
        window.location.href='quiz.php?Qid=<?echo $Qid;?>&Qn=1';
        document.cookie = "UserId="+localStorage.getItem('UserId');
     }
 </script>
   


   <?
   if( isset($_POST["startQuiz"]) && !isset($_COOKIE['UserId']) ){
    $q = mysqli_query($connect,"SELECT MAX(id) FROM `users`");
    $newid=$row["MAX(id)"]+1;
    $row = mysqli_fetch_assoc($q);
    $name = trim(htmlspecialchars(strip_tags($_POST["name"])));
    $cid = trim(htmlspecialchars(strip_tags($_POST["countryId"])));
    echo $newid;
    echo $cid;
    
    if(!empty($name) && !empty($cid)) {
    $insert = mysqli_query($connect, "INSERT INTO `users`(`name`, `countryID`) VALUES ('$name','$cid')");
    ?> 
    <script type="text/javascript">
      document.cookie = "UserId=<?echo $newid;?>";
       localStorage.setItem('UserId', <?echo $newid;?>);
    </script>
<?     
    
    echo"<script>
       window.location.href='quiz.php?Qid=$Qid&Qn=1';
        </script>";
    }/**/
   }

 
?>

   	<div class="container">
   		<div class="enter_quiz">
   			<h1>How Well Do You Friend's Know You?</h1>
   			<h2 class="heading">Instructions:</h2>
   			<div class="points">
   				<ul>
   					<li>Choose your region.</li>
   					<li>Enter your name.</li>
   					<li>Answer any 10 Questions about yourself.</li>
   					<li>Your quiz-link will be ready.</li>
   					<li>Share your quiz-link with your friends.</li> 
   					<li>Your friends will try to guess the right answers.</li>
   					<li>Check the score of your friends at your quiz-link!</li>
   				</ul>
   			</div>
   			<button class="fullWidthButton" type="button" id="country_dropdown">
				    <span id="country_dropdown_text">Select your region</span>
					<span class="caret"></span>
				</button>
				<div class="" id="country_selector">
                                            <div class="dropdown_item custom_dropdown_item" onclick="country_selected(1, 'India')">
                            <a class="custom_dropdown_item_anchor">India</a>
                        </div>
                            
                                            <div class="dropdown_item custom_dropdown_item" onclick="country_selected(2, 'USA')">
                            <a class="custom_dropdown_item_anchor">USA</a>
                        </div>
                            
                                            <div class="dropdown_item custom_dropdown_item" onclick="country_selected(8, 'Philippines')">
                            <a class="custom_dropdown_item_anchor">Philippines</a>
                        </div>
                            
                                            <div class="dropdown_item custom_dropdown_item" onclick="country_selected(6, 'Canada')">
                            <a class="custom_dropdown_item_anchor">Canada</a>
                        </div>
                            
                                            <div class="dropdown_item custom_dropdown_item" onclick="country_selected(4, 'Australia')">
                            <a class="custom_dropdown_item_anchor">Australia</a>
                        </div>
                            
                                            <div class="dropdown_item custom_dropdown_item" onclick="country_selected(5, 'United Kingdom')">
                            <a class="custom_dropdown_item_anchor">United Kingdom</a>
                        </div>
                            
                                            <div class="dropdown_item custom_dropdown_item" onclick="country_selected(7, 'Singapore')">
                            <a class="custom_dropdown_item_anchor">Singapore</a>
                        </div>
                            
                                            <div class="dropdown_item custom_dropdown_item" onclick="country_selected(9, 'Greece')">
                            <a class="custom_dropdown_item_anchor">Greece</a>
                        </div>
                            
                                            <div class="dropdown_item custom_dropdown_item" onclick="country_selected(10, 'Lebanon')">
                            <a class="custom_dropdown_item_anchor">Lebanon</a>
                        </div>
                            
                                            <div class="dropdown_item custom_dropdown_item" onclick="country_selected(3, 'Others')">
                            <a class="custom_dropdown_item_anchor">Others</a>
                        </div>
                            
                                        
				</div>
				<div class="error countryMsg">Please select your region</div>
				<div class="h_play_form">
	           <form  method="POST" class="ng-pristine ng-valid">
	                    <fieldset>
				    	  	<div class="form-group">
				    		    <input class="form-control" required="" placeholder="Enter your name (eg. Jack)" maxlength="25" name="name" id="name" type="text" value="">
				    		    <div class="error nameMsg">Please Enter your name</div>
								<div class="error atinnameMsg">@ is Not Allowed</div>
                                <div class="error curseWordMsg">Abusive language is not allowed</div>
				    		</div>
				    		<input type="hidden" name="countryId" id="countryId" value="0" required>
				    		<input class="btn btn-lg btn-success btn-block" type="submit" name="startQuiz" value="Confirm">
				    	</fieldset>
                  </form>
            </div>
   		</div>
   	</div>

 <script type="text/javascript" src="public/js/jquery.min.js"></script>
 <script type="text/javascript" src="public/js/site.js"></script>
 


<?
    
   require_once('footer.php');

?>