<?require_once("header.php");
$s = $_GET['S'];

?>

<div class="container">
    
   <h1 style='<?if(empty($s)){echo "display:none;";}?>' >You have completed the quiz</h1>
   <h1 style='<?if(empty($s)){echo "display:none;";}?>' >Your result has been saved</h1>
   
   <h1 style='<?if(!empty($s)){echo "display:none;";}?>' >You've already passed this quiz</h1>
   <h1 >Create your own quiz to check your friends <a href='index.php'>Click me</a></h1>
</div>


<?require_once("footer.php");?>