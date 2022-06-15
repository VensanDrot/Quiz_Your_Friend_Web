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
</div>


<?require_once("footer.php");?>