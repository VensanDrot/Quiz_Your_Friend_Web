<? require_once("header.php"); 


$n= $_GET['Qid'];
$qn= $_GET['Qn'];
$q = mysqli_query($connect,"SELECT MAX(qid) FROM `$n`");
$row = mysqli_fetch_assoc($q);
$maxq= intval($row['MAX(qid)']);
$q = mysqli_query($connect,"SELECT MAX(id) FROM `$n` WHERE `qid`=$qn");
$max = mysqli_fetch_assoc($q);
$max=intval($max['MAX(id)']);
$q = mysqli_query($connect,"SELECT MIN(id) FROM `$n` WHERE `qid`=$qn");
$min = mysqli_fetch_assoc($q);
$min = intval($min['MIN(id)']);



?>


<script type="text/javascript">


    var map = new Map([
    ["Quiz_Id", "<? echo $n ?>"],
    ["User_ID", "<? echo $_COOKIE['UserId'];?>"],
    ]);
   
    map = new Map(JSON.parse(localStorage.Newmap));
    console.log(map);

    function saveChange(clicked_id) {
        var res= clicked_id;
        map.set(<?echo $qn;?>, res);
        var fss = JSON.stringify(Array.from(map.entries()));
        localStorage.setItem('Newmap', fss);
        if(<?echo $qn;?> < <?echo $maxq;?>){ 
        window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn+1;?>';
    } else {
        //window.location.href='index.php';
        localStorage.setItem("<?echo $n;?>", "<?echo $_COOKIE['UserId'];?>");
    }
    
}
    

</script>




 <div class="container ">
 	<div class="quiz_block">
 	<h1 class="ng-binding">Quesiton smth</h1>
 	<a class="btn btn-default quizzzzz" href="quiz.php?Qid=<?echo $n;?>&Qn=<?echo rand(1, intval($row['MAX(qid)']));?>">Change question</a>
 </div>
 	 <div class="quiz_container">
 	 	<div class="number_question">
 	 		<ul class="pageing">
 	 			<? 
                for ($i=1; $i <= $row['MAX(qid)']; $i++) { 
                    ?> 
                        <li class="<?if($qn==$i) echo "active"?>"><a href="quiz.php?Qid=<?echo $n;?>&Qn=<?echo $i;?>"><?echo $i;?></a></li>
                    <?
                }
                ?>
                <!-- sample of li
 	 			<li><a href="">10</a></li>
 	 		-->
            </ul>
 	 	</div>
 	 	<div class="answer_questions">
 	 		<ul class="questionNoList ">
                
                <?
                for ($i=$min; $i <=$max ; $i++) { 
                 $q = mysqli_query($connect,"SELECT * FROM `$n` WHERE `qid`=$qn AND `id` = $i");
                $r = mysqli_fetch_assoc($q);
            ?> <li ><button class="answers" onclick="saveChange(this.id) " id="<?echo $i;?>"> <? echo $r['answer']; ?> </button></li>
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