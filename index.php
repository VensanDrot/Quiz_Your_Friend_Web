<? require_once("header.php");
    
?>
 <script>
    localStorage.removeItem('Newmap')
    localStorage.removeItem('Answered')
    localStorage.removeItem('NewAnswer')
    localStorage.removeItem('result')
    localStorage.removeItem('r')
    window.localStorage.removeItem('r');
    window.localStorage.removeItem('Answered');
    window.localStorage.removeItem('NewAnswer');
    document.cookie = 'upload=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
    document.cookie = 'r=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
    document.cookie = 'result=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
    </script>


    <div class="main_sec middle_conatainer">
        <div class="container">

<?  
                for ($i=1; $i <= $row['MAX(id)'] ; $i++) { 
                    $rere = mysqli_query($connect,"SELECT * FROM `Quizes` WHERE `id` = $i");
                    $data = mysqli_fetch_assoc($rere);

?>                  
                    <div class="main_area" style="<? if($data['status'] == false) echo "display: none;";?>">
                    <a href=""><img src=" <?echo $data['img'];?>" alt="" class="img-responsive"></a>
                    <div class="content_area">
                    <h1><? echo $data['name'];?></h1>
                    <a  href="bridge.php?Qid=<?echo 'Q'.$data['id'];?>" class="btn btn-default">Start Now</a>
                    </div>
                  </div>
           
<?
                }
               
?>
           

            <!-- sample of box
            <div class="main_area">
                <a href=""><img src="https://img.holaquiz.com/public/site_content/quiz/category/HolaQuiz-Category5f86fd669085d.jpg" alt="" class="img-responsive"></a>
                <div class="content_area">
                    <h1>How Well Do Your Friends Know You?</h1>
                    <a  href="quiz.php" class="btn btn-default">Start Now</a>
                </div>
            </div>
           

        -->



        </div>
    </div>

    <script>
        var f=0;
        document.cookie = "f=0";
    </script>
 
 

<?require_once("footer.php");?>