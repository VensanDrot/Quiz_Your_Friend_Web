<?require_once("header.php");?>
<?
//variables

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

//end of variables

if (empty($_GET['Answer'])){

    ?>
    <script type="text/javascript">
    console.log('hehe');
    if(localStorage.getItem('<?echo $n;?>') !== null){
        window.location.href='finish.php?Qid=<?=$n;?>';
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
        

        //console.log("onit");
        var res= clicked_id;
        map.set("Q<?echo $qn;?>", res);
        var fss = JSON.stringify(Array.from(map.entries()));
        localStorage.setItem('Newmap', fss);

        if(<?echo $qn;?> < <?echo $maxq;?>){ 
        window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn+1;?>';
        } 

        if(map.size == <?=$maxq+2?>){
            localStorage.setItem("<?echo $n;?>", "<?echo $_COOKIE['UserId'];?>");
            window.location.href='finish.php?Qid=<?=$n;?>';
        }
    

        }
        
        console.log(map.size);

        if(map.size == <?=$maxq+2?>){
            localStorage.setItem("<?echo $n;?>", "<?echo $_COOKIE['UserId'];?>");
            window.location.href='finish.php?Qid=<?=$n;?>';
        }
    

        function move(){

    f = <? echo $_COOKIE["f"];?>;   

    if (<?echo $qn-1?> == 0 && <? echo $_COOKIE["f"];?>==1) {
            f=0;
            console.log("up");
            document.cookie = "f="+f;
            console.log("<? echo $_COOKIE["f"];?>");
            }
        
        if (<?echo $qn?> == <?echo $maxq?> && <? echo $_COOKIE["f"];?>==0) {
                f=1;
                console.log("down");
                document.cookie = "f="+f;
                console.log("<? echo $_COOKIE["f"];?>");
            }
        
        
        while(<?echo $qn?> < <?echo $maxq?> && f==0 ){
        
            window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn+1;?>';
            break;
        
         }
         while(<?echo $qn?> > 1 && f==1){
        
            window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn-1;?>';
           break;
        
         }
         console.log("<? echo $_COOKIE["f"];?>");

}

    </script>

<?}



if (!empty($_GET['Answer'])){

?>

<script type="text/javascript">

if(localStorage.getItem('F<?echo $n;?>') !== null){
    window.location.href='friend.php?S=true';
    window.localStorage.removeItem('r');
    window.localStorage.removeItem('Answered');
    window.localStorage.removeItem('NewAnswer');
    document.cookie = 'upload=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
    document.cookie = 'r=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
    window.localStorage.removeItem('result');
}


result = 0;

// resulting variable
if (localStorage.getItem('result') === null) {
        localStorage.setItem('result', result);
    }
    var map = new Map([
    ["Quiz_Answers", "Done"],
    ]);
    // pars to local storage
    map = new Map(JSON.parse(localStorage.Answered));

    answered = new Map(JSON.parse(localStorage.Answered));
    ans = new Map(JSON.parse(localStorage.NewAnswer));
    r = 3;

    if (localStorage.getItem('r') === null) {
          localStorage.setItem('r',r);
        }
    else {
        r = localStorage.getItem('r');
    }
  
    


// start save the answer to the map
    
      

    function saveChange(clicked_id) {
        


        answer = new Map(JSON.parse(localStorage.NewAnswer));
        map.set("Q<?echo $qn;?>", 'done'); 
            var fss = JSON.stringify(Array.from(map.entries()));
            localStorage.setItem('Answered', fss);
       
       
            if (answer.get('Q<?=$_GET['Qn'];?>') == clicked_id ){
            result = parseInt(localStorage.getItem('result'));
            result = result +1;
            localStorage.setItem('result', result); 
           
        } 
        if (<?=$qn+1;?> <= <?=$maxq;?>) {
           window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn+1;?>&Answer=True';
        }else {
            window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=1&Answer=True';
        }
  
                r = localStorage.getItem('r');
                r ++;
                localStorage.setItem('r',r);
                r = localStorage.getItem('r');

                if(r == answered.size-1) {
                document.cookie = 'FriendId='+ans.get('FriendId');
                document.cookie = 'User_Id='+ans.get('User_ID');
                document.cookie = 'result='+ localStorage.getItem('result');
                document.cookie = 'r='+r;
                document.cookie = 'upload='+'smth';
                localStorage.setItem('F<?=$n;?>','<?=$n;?>');
                
        }
    



        }
// end ofsave the answer to the map    

      

if (answered.get('Q<?=$qn;?>')=='done' && <?=$qn+1;?> <= <?=$maxq;?> && r !=answered.size-1) {
          window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn+1;?>&Answer=True';
      }
      if (answered.get('Q<?=$qn;?>')=='done' && <?=$qn+1;?> > <?=$maxq;?> && r !=answered.size-1) {
          window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=1&Answer=True';
      }
      


            
    
    // adding info to map nav
    for (i=1; i <= <?=$maxq;?>;i++) {
        //console.log('hehe');
        map = new Map(JSON.parse(localStorage.Answered));
        
        if (map.get('Q'+i) == null) {
        map.set("Q"+i, 'not');
        var fss = JSON.stringify(Array.from(map.entries()));
        localStorage.setItem('Answered', fss);
    }
    }

// function of movement
    function move(){

      f = <? echo $_COOKIE["f"];?>;

      if (<?echo $qn-1?> == 0 && <? echo $_COOKIE["f"];?>==1) {
              f=0;
              console.log("up");
              document.cookie = "f="+f;
            //  console.log("<? echo $_COOKIE["f"];?>");
              }
          
          if (<?echo $qn?> == <?echo $maxq?> && <? echo $_COOKIE["f"];?>==0) {
                  f=1;
                  console.log("down");
                  document.cookie = "f="+f;
                  console.log("<? echo $_COOKIE["f"];?>");
              }
          
          
          while(<?echo $qn?> < <?echo $maxq?> && f==0 ){
        
              window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn+1;?>&Answer=True';
              break;
        
           }
           while(<?echo $qn?> > 1 && f==1){
        
              window.location.href='quiz.php?Qid=<?echo $n;?>&Qn=<?echo $qn-1;?>&Answer=True';
             break;
        
           }
           console.log("<? echo $_COOKIE["f"];?>");

}



</script>


<?
               $fid = $_COOKIE['FriendId'];
               $uid = $_COOKIE['User_Id'];
               $result =  $_COOKIE['result'];
               
               //echo "<script>console.log($fid)</script>";
               //echo "<script>console.log($uid)</script>";
               //echo "<script>console.log($result)</script>";
                if ($_COOKIE['upload']=='smth' ) {
                  $insert = mysqli_query($connect,"INSERT INTO `results`( `userid`, `Qid`, `fid`, `result`) VALUES ('$uid','$n','$fid','$result')");
                    echo "<script>  
                        window.localStorage.removeItem('r');
                        window.localStorage.removeItem('Answered');
                        window.localStorage.removeItem('NewAnswer');
                        document.cookie = 'upload=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
                        document.cookie = 'r=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
                        window.localStorage.removeItem('result');
                        window.location.href='friend.php?S=true';
                       // window.location.href='index.php';
                        </script>";
                }
            ?>
<?


}?>







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
                        
                        <li class="<? if($qn==$i) {echo "active";}?>" id ="Q<?echo $i;?>"><a href="quiz.php?Qid=<?echo $n;?>&Qn=<?echo $i;?><?if(!empty($_GET['Answer'])){echo "&Answer=True";}?>"><?echo $i;?></a></li> <!--  -->
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