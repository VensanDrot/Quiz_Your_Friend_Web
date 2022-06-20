<?require_once("header.php");?>
<?
//variables

    $n= $_GET['Qid'];
    $qn= $_GET['Qn'];

    $n= $_GET['Qid'];
    $id = $int = (int) filter_var($n, FILTER_SANITIZE_NUMBER_INT);
    //echo $id;
    $q = mysqli_query($connect,"SELECT `type` FROM `Quizes` WHERE `id` = '$id'");
    $row = mysqli_fetch_assoc($q);
    $type= intval($row['type']);

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

    $class = array("bg_org_tran","bg_pink_tran","bg_blue_tran","bg_ping_tran");

//end of variables

// Start of every thing for usual type
    if (empty($_GET['Answer']) && $type == '0'){

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
                //console.log("<? echo $_COOKIE["f"];?>");
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
             //console.log("<? echo $_COOKIE["f"];?>");

        }

            </script>

    <?}



    if (!empty($_GET['Answer']) && $type == '0'){

        ?>

        <script type="text/javascript">
        answer = new Map(JSON.parse(localStorage.NewAnswer)); 
        document.cookie= 'findname='+answer.get('User_ID'); 
        if(localStorage.getItem('F<?echo $n;?>') == answer.get('User_ID')){
            ans = new Map(JSON.parse(localStorage.NewAnswer));
            window.location.href='friend.php?S=true&Qid=<?echo $n;?>&User_Id='+ans.get('User_ID')+"&Fid="+ans.get('FriendId');
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
                        localStorage.setItem('F<?=$n;?>',ans.get('User_ID'));
                        document.cookie = 'result='+ localStorage.getItem('result');
                        document.cookie = 'r='+r;
                        document.cookie = 'upload='+'smth';
                        
                    
                        
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
                       // "friend.php?S=true&Qid=$n&User_Id=+ans.get('User_ID')+&Fid=+ans.get('FriendId')"
                        if ($_COOKIE['upload']=='smth' ) {
                          $insert = mysqli_query($connect,"INSERT INTO `results`( `userid`, `Qid`, `fid`, `result`) VALUES ('$uid','$n','$fid','$result')");
                            echo "<script>  
                                ans = new Map(JSON.parse(localStorage.NewAnswer));
                                window.location.href='friend.php?S=true&Qid=$n&User_Id='+ans.get('User_ID')+'&Fid='+ans.get('FriendId');
                                document.cookie = 'upload=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
                                document.cookie = 'r=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
                                window.localStorage.removeItem('result');
                               // window.location.href='index.php';
                                window.localStorage.removeItem('r');
                                window.localStorage.removeItem('Answered');
                                window.localStorage.removeItem('NewAnswer');
                                </script>";
                        }
                    ?>
        <?


        }
// End of every thing for usual type


// Start of every thing for this||that type
    if (empty($_GET['Answer']) && $type == '1') {
        ?>
        
        <script>
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

        function thissave(id) {

            const t = document.getElementById(id);
            const di = document.getElementById('e'+id);   
            const to = document.getElementById('e'+di.getAttribute('name'));
            name = t.getAttribute('name');
            
            
            //console.log(di.getAttribute('name'));
            di.style='display:block'; 
            to.style='display:none';   
           // console.log(t.getAttribute('name'));
            map.set("Q"+name, id );
            var fss = JSON.stringify(Array.from(map.entries()));
            localStorage.setItem('Newmap', fss);
            
            if(map.size == <?=$maxq+2?>){
                localStorage.setItem("<?echo $n;?>", "<?echo $_COOKIE['UserId'];?>");
                window.location.href='finish.php?Qid=<?=$n;?>';
            }

        }

        </script>
        
    <?
    }

    if (!empty($_GET['Answer']) && $type == '1') {
        ?>
        
        <script>
       
            // pars to local storage
           
        answer = new Map(JSON.parse(localStorage.NewAnswer)); 
        document.cookie= 'findname='+answer.get('User_ID'); 
        if(localStorage.getItem('F<?echo $n;?>') === answer.get('User_ID')){
            //console.log('ass');
            window.location.href='friend.php?S=true&Qid=<?echo $n;?>&User_Id='+answer.get('User_ID')+"&Fid="+answer.get('FriendId');
            //window.localStorage.removeItem('r');
            window.localStorage.removeItem('Answered');
            window.localStorage.removeItem('NewAnswer');
            document.cookie = 'upload=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
            //document.cookie = 'r=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
            window.localStorage.removeItem('result');
        }
      
       
        
        result = 0;
        if (localStorage.getItem('result') === null) {
                localStorage.setItem('result', result);
        }
        
        var map = new Map([
            ["Quiz_Answers", "Done"],
            ]);




        function thissave(id) {
            result = localStorage.getItem('result');
            answer = new Map(JSON.parse(localStorage.NewAnswer));  
            const t = document.getElementById(id);
            const di = document.getElementById('e'+id);   
            const to = document.getElementById('e'+di.getAttribute('name'));
            name = t.getAttribute('name');
            
            if (answer.get('Q'+name) == id && map.get('Q'+name)==null ) {
                //console.log('right');
                result++;
                localStorage.setItem('result', result);
                map.set('Q'+name, id);
                //console.log(result);
            }
            if (answer.get('Q'+name) !== id && map.get('Q'+name)==null ) {
                //console.log('wrong');
                map.set('Q'+name, id);
                //console.log(result);
            }
            if (answer.get('Q'+name) == id && map.get('Q'+name)!==id ) {
                //console.log('here +');
                result ++;
                localStorage.setItem('result', result);
                map.set('Q'+name, id);
                //console.log(result);
            }
            if (answer.get('Q'+name) !== id && map.get('Q'+name)!==id ) {
                //console.log('here -');
                result--;
                localStorage.setItem('result', result);
                map.set('Q'+name, id);
                //console.log(result);
            }

            console.log(map);
            console.log(map.size);

            if (map.size-1 === <?=$maxq;?>) {
                document.cookie = 'FriendId='+answer.get('FriendId');
                document.cookie = 'User_Id='+answer.get('User_ID');
                document.cookie = 'result='+ localStorage.getItem('result');
                localStorage.setItem('F<?=$n;?>', answer.get('User_ID'));
                document.cookie = 'upload='+'smth';
                location.reload();
            }


            
           //console.log(id);
            di.style='display:block'; 
            to.style='display:none';   
            
          
            

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
                                answer = new Map(JSON.parse(localStorage.NewAnswer));  
                                window.location.href='friend.php?S=true&Qid=$n&User_Id='+answer.get('User_ID')+'&Fid='+answer.get('FriendId'); 
                                window.localStorage.removeItem('Answered');
                                window.localStorage.removeItem('NewAnswer');
                                window.localStorage.removeItem('r');
                                window.localStorage.removeItem('result');
                                document.cookie = 'upload=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
                                </script>";
                        }
            ?>
        
    <?
    }
// End of every thing for usual type

// Start of every thing for everhaveI type 
    if (empty($_GET['Answer']) && $type == '2'){?>
        <script>
            if(localStorage.getItem('<?echo $n;?>') !== null){
            window.location.href='finish.php?Qid=<?=$n;?>';
            }
            var g = 1;
            // map creating
            var map = new Map([
            ["Quiz_Id", "<? echo $n ?>"],
            ["User_ID", "<? echo $_COOKIE['UserId'];?>"],
            ]);
           
            for (i=1;i<=<?=$maxq;?>;i++){
            map.set("Q"+i, '0' );
            var fss = JSON.stringify(Array.from(map.entries()));
            localStorage.setItem('Newmap', fss);
            }
            map = new Map(JSON.parse(localStorage.Newmap));
            //console.log(map);
        


            function hsave(id){
            const t = document.getElementById(id);
            const di = document.getElementById('ic'+id);   
            name = t.getAttribute('name');
            if(di.classList.contains('fa-check-square-o') == false){ 
                di.classList.add('fa-check-square-o');
                map.set("Q"+name, id );
                var fss = JSON.stringify(Array.from(map.entries()));
                localStorage.setItem('Newmap', fss);
            }
            else {
                di.classList.remove('fa-check-square-o');
                map.set("Q"+name, 0 );
                var fss = JSON.stringify(Array.from(map.entries()));
                localStorage.setItem('Newmap', fss);
            }
            
            
            map = new Map(JSON.parse(localStorage.Newmap));
            console.log(map);
            
            }


            function fin(){
                
                localStorage.setItem("<?echo $n;?>", "<?echo $_COOKIE['UserId'];?>");
                window.location.href='finish.php?Qid=<?=$n;?>';
            }
        </script>
   <?}

    if (!empty($_GET['Answer']) && $type == '2'){?> 
        <script>
            answer = new Map(JSON.parse(localStorage.NewAnswer));  
            document.cookie= 'findname='+answer.get('User_ID');
            if(localStorage.getItem('F<?echo $n;?>') === answer.get('User_ID')){
                //console.log('ass');
                window.location.href='friend.php?S=true&Qid=<?echo $n;?>&User_Id='+answer.get('User_ID')+"&Fid="+answer.get('FriendId');
                //window.localStorage.removeItem('r');
                window.localStorage.removeItem('Answered');
                window.localStorage.removeItem('NewAnswer');
                document.cookie = 'upload=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
                //document.cookie = 'r=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
                window.localStorage.removeItem('result');
            }
        result = 0;
        if (localStorage.getItem('result') === null) {
                localStorage.setItem('result', result);
        }
        
        for(i=1;i<answer.size-2;i++) {
            if (answer.get('Q'+i) == 0) {
                result=localStorage.getItem('result');
                        result ++;
                        localStorage.setItem('result', result);
            }
        }
        console.log(localStorage.getItem('result'));
        
        

        function hsave(id){
                
                answer = new Map(JSON.parse(localStorage.NewAnswer)); 
                const t = document.getElementById(id);
                const di = document.getElementById('ic'+id);   
                name = t.getAttribute('name');
                if(di.classList.contains('fa-check-square-o') == false){ 
                    di.classList.add('fa-check-square-o');
                    if (answer.get('Q'+name) == id) {
                        result=localStorage.getItem('result');
                        result ++;
                        localStorage.setItem('result', result);
                    }
                    if (answer.get('Q'+name) == 0) {
                        result=localStorage.getItem('result');
                        result --;
                        localStorage.setItem('result', result);
                    }

                }
                else {
                    di.classList.remove('fa-check-square-o');
                    if (answer.get('Q'+name) == 0) {
                        result=localStorage.getItem('result');
                        result ++;
                        localStorage.setItem('result', result);
                    }
                    if (answer.get('Q'+name) == id) {
                        result=localStorage.getItem('result');
                        result --;
                        localStorage.setItem('result', result);
                    }
                }
                

               console.log(localStorage.getItem('result'));
                //map = new Map(JSON.parse(localStorage.Newmap));
                //console.log(map);
               
            }

            function fin(){
                answer = new Map(JSON.parse(localStorage.NewAnswer)); 
                document.cookie = 'FriendId='+answer.get('FriendId');
                document.cookie = 'User_Id='+answer.get('User_ID');
                document.cookie = 'result='+ localStorage.getItem('result');
                localStorage.setItem('F<?=$n;?>', answer.get('User_ID'));
                document.cookie = 'upload='+'smth';
                location.reload();
            
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
                                answer = new Map(JSON.parse(localStorage.NewAnswer));  
                                window.location.href='friend.php?S=true&Qid=$n&User_Id='+answer.get('User_ID')+'&Fid='+answer.get('FriendId'); 
                                window.localStorage.removeItem('Answered');
                                window.localStorage.removeItem('NewAnswer');
                                window.localStorage.removeItem('r');
                                window.localStorage.removeItem('result');
                                document.cookie = 'upload=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
                                </script>";
                        }
            ?>
    <?}

// End of every thing for everhaveI type

?>




<div class="container  <?if($type == 2) {echo "main_container";}?>" >

<!-- Start of Usual Quiz Type -->  
    <?if($type == '0') {
        $ANSWER = $_GET['Answer'];
        $findname= $_COOKIE['findname'];
        $q = mysqli_query($connect,"SELECT `name` FROM `users` WHERE `id`='$findname'");
        $found =mysqli_fetch_assoc($q);
        $found = $found['name'];
        ?>

     	<div class="quiz_block">
     	<h1 class="ng-binding" style="<?if($ANSWER==True) {echo 'display:none';}?>"><?echo $que;?></h1>
         <h1 class="ng-binding" style="<?if($ANSWER==True) {echo 'display:block';}else {echo 'display:none';}?>">
         <?
         $healthy = array("you","You");
         $found = $found."'s";
         echo str_replace($healthy,$found, $que);
         ?></h1>
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
    <?}?>                   
    
<!-- End of Usual Quiz Type -->   
    

<!-- Start of This||That Quiz Type -->
    <?if($type == '1') {
        $ANSWER = $_GET['Answer'];
        $findname= $_COOKIE['findname'];
        $q = mysqli_query($connect,"SELECT `name` FROM `users` WHERE `id`='$findname'");
        $found =mysqli_fetch_assoc($q);
        $found = $found['name'];
        ?>
        <div class="middle_area menu_sec ques_page ng-scope" id="quizDiv" ng-controller="QuizController" ng-init="showAllQuestion(0,0);enableOnePageOptionSelection(1);enableMaxScore();enableUseMeta();">
            <div class="top_heading inst_head">
                <h2 class="text-center" style="<?if($ANSWER==True) {echo 'display:none';}?>"> This or That game!</h2>
                <h2 class="text-center" style="<?if($ANSWER==True) {echo 'display:block';} else {echo 'display:none';}?>"> Guess <span style="font-weight:bold; "><?=$found;?>'s</span> This Or That answers</h2>
            </div>
            <?
            for($i=1; $i <= $maxq; $i++) {
                
                $q = mysqli_query($connect,"SELECT MAX(id) FROM `$n` WHERE `qid`='$i'");
                $max = mysqli_fetch_assoc($q);
                $max=intval($max['MAX(id)']);
                // echo $max.'   ';
                $q = mysqli_query($connect,"SELECT MIN(id) FROM `$n` WHERE `qid`='$i'");
                $min = mysqli_fetch_assoc($q);
                $min = intval($min['MIN(id)']);
                // echo $min.'   ';

                $q = mysqli_query($connect,"SELECT * FROM `$n` WHERE `qid`=$i AND `id` =$min ");
                $ans1 = mysqli_fetch_assoc($q);
                $ans1 = $ans1['answer'];

                $q = mysqli_query($connect,"SELECT * FROM `$n` WHERE `qid`=$i AND `id` =$max ");
                $ans = mysqli_fetch_assoc($q);
                $ans = $ans['answer'];
               
                
              
                ?>
            <div class="question-div ques_row user_side user_question_page ng-scope bg_yell" >
                    


                    <span class="question_number count_no ng-binding textarea-form-user_friend textarea-form-user-unselect"><?=$i;?>.</span>
                    <span class="or_sec">or</span>
                            
                    <!-- ngRepeat: option in question.options -->
                    <div  class="question-div question_option color0" name='<?=$i;?>' id=<?=$min?> onclick ="thissave(this.id)">
                       
                                <div class="edit " id='e<?=$min?>' name='<?=$max;?>' >
                                    <span class="edit_icon" >
                                         <i class="fa fa-check" aria-hidden="true"></i>
                                    </span>
                                </div>
                        <div class="input-group card_body ques1 ng-binding">
                        <!--<div class="input-group card_body ques1" ng-class="question.editing?'active':''">-->
                                <!--<div  class="cricle_edit  " ng-class="question.editing?'lieditable':''">-->
                                <div class="cricle_edit" >
                                    <textarea ng-readonly="question.editing?false:true" id="" maxlength="56" spellcheck="false" rows="1" cols="60"  ng-model="option.content" class="ng-pristine ng-valid" readonly="readonly"><?=$ans1;?></textarea>    
                                </div>                              
                        </div>
                        </div>
                        <!-- end ngRepeat: option in question.options -->
                        <div class="question-div question_option color1" name='<?=$i;?>' id=<?=$max?>  onclick ="thissave(this.id)">
                       
                                <div class="edit " id='e<?=$max?>' name='<?=$min;?>'>
                                    <span class="edit_icon">
                                         <i class="fa fa-check" aria-hidden="true"></i>
                                    </span>
                                </div>
                        <div class="input-group card_body ques1 ng-binding" >
                        <!--<div class="input-group card_body ques1" ng-class="question.editing?'active':''">-->
                                <!--<div  class="cricle_edit  " ng-class="question.editing?'lieditable':''">-->
                               
                                <div class="cricle_edit " >
                                    <textarea ng-readonly="question.editing?false:true" id="" maxlength="56" spellcheck="false" rows="1" cols="60"  ng-model="option.content" class="ng-pristine ng-valid" readonly="readonly"><?=$ans;?></textarea>    
                                </div> 
                                                             
                        </div>
                        </div><!-- end ngRepeat: option in question.options -->
            </div>
            <?
    
        }?>
            

            
        </div>
    <?}?>  
<!-- End of This||That Quiz Type -->

<!-- Start of everhaveI Quiz Type -->
    <?if($type == '2') {
         $ANSWER = $_GET['Answer'];
         $findname= $_COOKIE['findname'];
         $q = mysqli_query($connect,"SELECT `name` FROM `users` WHERE `id`='$findname'");
         $found =mysqli_fetch_assoc($q);
         $found = $found['name'];
         ?>
        <head>
        <link href="public/css/never.css" rel="stylesheet" type="text/css" />
        </head>
        <div class="main_sec middle_conatainer">
        
          <div class="middle_area middle_conatainer ng-scope" id="quizDiv" ng-controller="QuizController" ng-init="showAllQuestion(10,1);enableSaveOptionText(0);">
                <div class="top_heading">
                  <h2 style="<?if($ANSWER==True) {echo 'display:none';}?>">Personalised Edition</h2>
                  <h2 class="text-center" style="<?if($ANSWER==True) {echo 'display:block';} else {echo 'display:none';}?>"> Guess <span style="font-weight:bold; "><?=$found;?>'s</span> Never Have I Ever answers</h2>
                </div>
            

                
                <div class="middle_div">
                                       
                <?$r=0;
                 for($i=1; $i <= $maxq; $i++) { 
                    $q = mysqli_query($connect,"SELECT * FROM `$n` WHERE `qid` = '$i'");
                    $row = mysqli_fetch_assoc($q);
                    if($r == 3) {
                        $r=0;
                    }
                    $key = array_rand($class);
                    //fa-check-square-o
                    ?>
                   
                    <div class="question-div card box_shadow_min mb_30 ng-scope  <?echo $class[$r];?>" id="<?=$row['id']?>" name ="<?=$row['qid']?>" onclick="hsave(this.id)">
                        <div class="card_head text-center">
                            <p>Never Have I Ever</p>
                        </div>
                        <div class="input-group card_body">
                        <span class="edit_icon"><i   class="fa fa-pencil-square-o fa-3x " aria-hidden="true" id="ic<?=$row['id']?>"></i>
                        </span>
                                                <ul class="hlist cricle_row">
                                <li id="myP" class="cricle_edit lieditable" ng-class="question.editing?'lieditable':''">
                                    <textarea maxlength="56" spellcheck="false" rows="1" cols="60"  class="ng-pristine ng-valid" readonly>
                                        <?=$row['question'];?>
                                    </textarea>    
                                </li>
                            </ul>
                        </div>
                    </div>

                <?$r++;
                }?>



                </div>
                
                <div class="continue_btn_div  btn_sec p_5_per mb_30">
                   
                        <button onclick="fin()" class="question_continue_btn">Continue</button>
                   
                </div>
            </div>
          
        
  
</div>
    <?}?>  
<!-- End of everhaveI Quiz Type -->

</div>






<? require_once("footer.php"); ?>