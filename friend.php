<?require_once("header.php");
$s = $_GET['S'];

?>

<div class="container">
    
   <h1 style='<?if(empty($s)){echo "display:none;";}?>' >You have completed the quiz</h1>
   <h1 style='<?if(empty($s)){echo "display:none;";}?>' >Congrats! You scored 7/10 in this quiz about dsa</h1>
   
   <h1 style='<?if(!empty($s)){echo "display:none;";}?>' >You've already passed this quiz</h1>
   <h1 >Now, it’s your turn. Create your own quiz and send to your friends!<a href='index.php'>Click me</a></h1>
</div>


<?require_once("footer.php");?>