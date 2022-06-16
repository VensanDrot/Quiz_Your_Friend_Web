<?require_once("header.php");
$s = $_GET['S'];

$qid = $_GET['Qid'];
$user = $_GET['User_Id'];
$fid = $_GET['Fid'];


$q = mysqli_query($connect,"SELECT MAX(qid) FROM `$qid`");
$row = mysqli_fetch_assoc($q);
$maxq= $row['MAX(qid)'];


$q = mysqli_query($connect,"SELECT `result` FROM `results` WHERE `Qid` ='$qid' AND `userid` = $user AND `fid` = $fid");
$row = mysqli_fetch_assoc($q);
$res= $row['result'];

$q = mysqli_query($connect,"SELECT `name` FROM `users` WHERE `id` = '$user' ");
$row = mysqli_fetch_assoc($q);
$name= $row['name'];
//echo $name;

?>

<div class="container">
    
   <h1 style='<?if(empty($s)){echo "display:none;";}?>' >You have completed the quiz</h1>
   <h1 style='<?if(empty($s)){echo "display:none;";}?>' >Congrats! You scored <?=$res;?>/<?echo $maxq;?> in this quiz about <?=$name;?></h1>
   
   <h1 style='<?if(!empty($s)){echo "display:none;";}?>' >You've already passed this quiz</h1>
   <h1 >Now, it’s your turn. Create your own quiz and send to your friends! <br>
   <a href='index.php'>Click me</a></h1>

   <br> <br> <br>

    <!--------------------------------->

   <h1> Who know's <?=$name;?> the best?</h1>
   <div class="tabskr ng-scope" ng-if="arrOtherUserStat.length==0">
          <?
           $q = mysqli_query($connect,"SELECT MAX(id) FROM `results` WHERE `userid` = '$user' AND `Qid`='$qid'");
           $r = mysqli_fetch_assoc($q);
           $mid = $r['MAX(id)'];?>                 
                                                <!--------------------------------->
                    <div class="para">
                        <ul>
                            
                            <li style="<?if(!empty($mid)) {echo "display:none;";}?>">
                                
                                <div id="nonAttemptUserStatsDiv" style="display: block;">No one has given this quiz yet.</div>
                            </li>

                            <?if(!empty($mid)) {
                                for($i=1; $i<=$mid;$i++){
                                     $q = mysqli_query($connect,"SELECT * FROM `results` WHERE `id`='$i' AND `userid` = '$user' AND `Qid`='$qid'");
                                     $r = mysqli_fetch_assoc($q);
                                     $m = $r['fid'];
                                     echo "<script>console.log('$m')</script>";
                                     $q1 = mysqli_query($connect,"SELECT `name` FROM `users` WHERE `id` = '$m'");
                                     $r1 = mysqli_fetch_assoc($q1);
                                     
                                ?>
                                
                                <li style="<?if(empty($r1['name'])) {echo "display:none;";}?>">
                                <div  style="display: flex; justify-content:space-around; font-size:20px;"><p>Name: <?=$r1['name'];?></p><p>Result: <?=$r['result'];?></p></div>
                            </li>
                                <?}
                                }?>
                        </ul>    
                   </div>


</div>





<?require_once("footer.php");?>