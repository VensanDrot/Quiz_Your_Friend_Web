<?require_once("header.php");?>
<?

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

$q = mysqli_query($connect,"SELECT `status` FROM `$n` WHERE `qid`=$qn");
$stat =mysqli_fetch_assoc($q);
$stat = $stat['status'];

$q = mysqli_query($connect,"SELECT `question` FROM `$n` WHERE `qid`=$qn AND `id`=$min");
$que= mysqli_fetch_assoc($q);
$que = $que['question'];

?>

<script type="text/javascript">
if(localStorage.getItem('<?echo $n;?>') !== null){
    window.location.href='finish.php';
}



var g = 1;
// map creating
var map = new Map([
["Quiz_Id", "<? echo $n ?>"],
["User_ID", "<? echo $_COOKIE['UserId'];?>"],
]);
// pars to local storage
map = new Map(JSON.parse(localStorage.Newmap));

//save the answer to the map
function saveChange(clicked_id) {
    var res= clicked_id;
    
    //console.log("onit");
    map.set("Q<?echo $qn;?>", res);
    var fss = JSON.stringify(Array.from(map.entries()));
    localStorage.setItem('Newmap', fss);

    if(<?echo $qn;?> < <?echo $maxq;?>){ 
    window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn+1;?>';
    } 
    
    }

    console.log(map.size);

    if(map.size == <?=$maxq+2?>){
        window.location.href='finish.php?Qid=<?=$n;?>';
        localStorage.setItem("<?echo $n;?>", "<?echo $_COOKIE['UserId'];?>");
    

    }
  

</script>




 <div class="container ">
 	<div class="quiz_block">
 	<h1 class="ng-binding"><?echo $que;?></h1>
 	<button onclick="move()" class="btn btn-default quizzzzz" >Change question</button>
 </div>
 	 <div class="quiz_container">
 	 	<div class="number_question">
 	 		<ul class="pageing">
 	 			<? 
                for ($i=1; $i <= $row['MAX(qid)']; $i++) { 
                    ?> 
                        
                        <li class="<? if($qn==$i) {echo "active";}?>" id ="Q<?echo $i;?>"><a href="quiz.php?Qid=<?echo $n;?>&Qn=<?echo $i;?>"><?echo $i;?></a></li> <!--  -->
                    <?
                }
                ?>
                <!-- sample of li
 	 			<li><a href="">10</a></li>
 	 		-->
            </ul>
 	 	</div>
          
        <!-- For those who has no img start-->
 	 	<div class="answer_questions" style="<?if($stat==1) { echo 'display:none';}?>">

 	 		<ul class="questionNoList">
                
                <? if($stat == 0) {
                for ($i=$min; $i <=$max ; $i++) { 
                 $q = mysqli_query($connect,"SELECT * FROM `$n` WHERE `qid`=$qn AND `id` = $i");
                $r = mysqli_fetch_assoc($q);
                ?>
             <li  id="qa<?echo $i;?>" style="<?if(empty($r['answer'])){echo "display:none;";}?>"><button class="answers"  id="<?echo $i;?>" onclick="saveChange(this.id)"> <? echo $r['answer']; ?> </button></li>
              <?  }
              }
                ?>

                <!-- sample of li
  	 			<li><button class="answers">Version 1</button></li>
 	 			-->
 	 		</ul>
              
 	 	</div>
        <!-- For those who has no img end-->
        <div id="questionDiv" class="ui-tabs-panel">
    		        	  <ul class="ques_pt_sec imglist">
    		                    <!-- ngRepeat: option in currentQuestion.options -->
       
                                <? if($stat == 1) {
                              for ($i=$min; $i <=$max ; $i++) {   
                                $q = mysqli_query($connect,"SELECT * FROM `$n` WHERE `qid`=$qn AND `id` = $i");
                                $r = mysqli_fetch_assoc($q);
                             ?>
        <li class="ng-scope" id="qa<?echo $i;?>" <?if (empty($r['answer'])&&empty($r['img'])){echo "style='display:none;'";}?>>
        <a id="<?echo $i;?>" class="ng-binding"  onclick="saveChange(this.id)">
        <div class="img_ser"><img alt="" src="<?echo $r["img"];?>"></div>
        <figcaption><?=$r['answer']?></figcaption></a>
        </li><!-- end ngRepeat: option in currentQuestion.options -->

                                    <? }
                                }
                                    ?>
<!-- end ngRepeat: option in currentQuestion.options -->
    		                </ul>  
    	</div>

 	 </div>
 </div>






<? require_once("footer.php"); ?>