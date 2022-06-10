<?require_once("header.php");
$Qid= $_GET['Qid'];
?>

<script>
   
 // if (localStorage.getItem('Link<?=$_GET['Qid'];?>') === null){
    map = new Map(JSON.parse(localStorage.Newmap)); 

    link=window.location.host+'/bridge.php?'+'Answer=true'+'&User='+localStorage.getItem('UserId')+'&Qid=<?=$_GET['Qid'];?>';
    for (var i = 1; i <= map.size-2; i++) {
        link+= '&Q'+i+'='+map.get('Q'+i);
    }
    document.cookie = "Link="+link;
    code = localStorage.getItem('UserId') + 'BT' + map.get("Quiz_Id");
    document.cookie = "code="+code;
    
 
        link = '/bridge.php?Code='+code;
        
        
   
    
      
    
  
 // }
// if (localStorage.getItem('Link<?=$_GET['Qid'];?>') !== null){
//    link =  localStorage.getItem('Link<?=$_GET['Qid'];?>');
//       <?
//       $link = "<script>
//       document.write(link);
//       </script>";?>
//   }

</script>

<?

if (empty($_COOKIE['code']) && empty($_COOKIE['Link'])) {
   require_once("public/Functions/smth.php");
  
}
else {
    $cc = $_COOKIE['code'];
    $cc1 = $_COOKIE['Link'];
    $q = mysqli_query($connect,"SELECT `id` FROM `Url` WHERE `short` = '$cc'");
    $r = mysqli_fetch_assoc($q);
    $mid = $r['id'];
    if (empty($mid)) {
    $ins= mysqli_query($connect,"INSERT INTO `Url`(`url`, `short`) VALUES ('$cc1','$cc')");
}
}
?> 


<div class="container" >    
        <?
        $us = $_COOKIE['UserId'];
         $q = mysqli_query($connect,"SELECT MAX(id) FROM `Results` WHERE `userid` = '$us'");
         $r = mysqli_fetch_assoc($q);
         $mid = $r['MAX(id)'];
         echo "<script>console.log('$mid')</script>";
        ?>
        <div class="tabskr ng-scope" ng-if="arrOtherUserStat.length==0">
                            <!--------------------------------->
                                                <!--------------------------------->
                    <div class="para">
                        <ul>
                            
                            <li style="<?if(!empty($mid)) {echo "display:none;";}?>">
                                
                                <div id="nonAttemptUserStatsDiv" style="display: block;">No one has given this quiz yet.</div>
                            </li>
                            <?if(!empty($mid)) {
                                for($i=1; $i<=$mid;$i++){
                                    $q = mysqli_query($connect,"SELECT * FROM `Results` WHERE `userid` = '$us' AND `id` = '$i'");
                                     $r = mysqli_fetch_assoc($q);
                                     $m = $r['fid'];
                                     echo "<script>console.log('$mid')</script>";
                                     $q1 = mysqli_query($connect,"SELECT `name` FROM `users` WHERE `id` = '$m'");
                                     $r1 = mysqli_fetch_assoc($q1);
                                     
                                ?>
                                
                                <li >
                                
                                <div  style="display: flex; justify-content:space-around; font-size:20px;"><p>Name: <?=$r1['name'];?></p><p>Result: <?=$r['result'];?></p></div>
                            </li>
                                <?}
                                }?>
                        </ul>    
                   </div>
        </div>



       <div class="enter_quiz reddy">    
    <!-- <br/>  -->
                   <h1 class="redeed">Your Quiz is Ready!</h1>
                   <p>Share your quiz-link with your friends!</p>
                       <p>They will try to guess your answers &amp; get a score out of 10.</p>
                   <div class="link_share" id="linkDiv">
                   <script>
            document.write(link);
            </script>
                   </div>
            <div class="link-copied">Link Copied</div>
           <div class="clearfix"></div>
           <button class="btn btn-default cop_textred" id="copy-link">Copy Link</button>

                                   
           
           </div>
           
           <div class="resltss">
         <!--   <h2>You can see the results when you open your quiz-link in this browser only.</h2>-->
           </div>
          
		   
                          <div>
               
           </div>      
                   <!-- <a onclick="return gtmEventTracking('view_scoreboard')" target="_blank" href="" class="btn btn-default cop_textred">View Your Scoreboard</a> -->
                    
          
           
           
        </div>
        
  
    </div>

    <script>
    document.cookie = 'Link=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
    document.cookie = 'code=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
    </script>
<?require_once("footer.php");?>