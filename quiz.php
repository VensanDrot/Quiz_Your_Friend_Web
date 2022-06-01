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
var f=0;
var g = 1;
var map = new Map([
["Quiz_Id", "<? echo $n ?>"],
["User_ID", "<? echo $_COOKIE['UserId'];?>"],
]);
map = new Map(JSON.parse(localStorage.Newmap));

function saveChange(clicked_id) {
    var res= clicked_id;
    
    //console.log("onit");
    map.set("Q<?echo $qn;?>", res);
    var fss = JSON.stringify(Array.from(map.entries()));
    localStorage.setItem('Newmap', fss);

    if(<?echo $qn;?> < <?echo $maxq;?>){ 
    window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn+1;?>';
    } else {
    //window.location.href='index.php';
    localStorage.setItem("<?echo $n;?>", "<?echo $_COOKIE['UserId'];?>");
    }
    }
    
  
  
   function move(){
       
    f = <? echo $_COOKIE["f"];?>;
       
        if (<?echo $qn?> == <?echo $maxq?> && f==0) {
                f=1;
                document.cookie = "f="+f;
            }
        if (<?echo $qn?> == 1 && f==1) {
            f=0;
            document.cookie = "f="+f;
            }

        while(<?echo $qn?> < <?echo $maxq?> && f==0 ){
            
            
            window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn+1;?>';
            break;
            
         }
         while(<?echo $qn?> > 1 && f==1){
            
            
            window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn-1;?>';

           break;
            
         }
       
    }

  

</script>



 <div class="container ">
 	<div class="quiz_block">
 	<h1 class="ng-binding">Quesiton smth</h1>
 	<button onclick="move()" class="btn btn-default quizzzzz" >Change question</button>
 </div>
 	 <div class="quiz_container">
 	 	<div class="number_question">
 	 		<ul class="pageing">
 	 			<? 
                for ($i=1; $i <= $row['MAX(qid)']; $i++) { 
                    ?> 
                        
                        <li class="<?if($qn==$i) echo "active"?>" id ="Q<?echo $i?>"><a href="quiz.php?Qid=<?echo $n;?>&Qn=<?echo $i;?>"><?echo $i;?></a></li> <!--  -->
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
            ?> <li  id="qa<?echo $i;?>" ><button class="answers" onclick="saveChange(this.id)" id="<?echo $i;?>"> <? echo $r['answer']; ?> </button></li>
              <?  }
                ?>

                <!-- sample of li
  	 			<li><button class="answers">Version 1</button></li>
 	 			-->
 	 		</ul>
 	 	</div>
        <!-- For those who has no img end-->

        
 	 </div>
 </div>

<script> 

for(i=1; i<= <?echo $maxq?>; i++){
    if(map.get("Q"+i)){
     
        const check = document.getElementById("Q"+i);
        check.classList.add("done");
    }
    for(g=<?echo $min?>; g<= <?echo $max?>; g++){
       // console.log(map.get("Q"+i));
        if(map.get("Q"+i) == g){
            const check = document.getElementById("qa"+g).firstChild;
            check.classList.add("lidone");
        }
    }

    }

    

</script>




<? require_once("footer.php"); ?>