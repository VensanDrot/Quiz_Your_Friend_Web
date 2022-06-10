<?require_once("header.php");
$Qid= $_GET['Qid'];
?>

<script>
   
 // if (localStorage.getItem('Link<?=$_GET['Qid'];?>') === null){
    map = new Map(JSON.parse(localStorage.Newmap)); 

    link=window.location.host+'/bridge.php?'+'Answer=true'+'&User='+localStorage.getItem('UserId')+'&Qid=<?=$_GET['Qid'];?>';
    for (var i = 1; i <= map.size-2; i++) {
        link+= '&Q'+i+'='+map.get('Q'+i);
    }
    document.cookie = "Link="+link;
    code = localStorage.getItem('UserId') + 'BT' + map.get("Quiz_Id");
    document.cookie = "code="+code;
    
 
        link = '/bridge.php?Code='+code;
        
        
   
    
      
    
  
 // }
// if (localStorage.getItem('Link<?=$_GET['Qid'];?>') !== null){
//    link =  localStorage.getItem('Link<?=$_GET['Qid'];?>');
//       <?
//       $link = "<script>
//       document.write(link);
//       </script>";?>
//   }

</script>

<?

if (empty($_COOKIE['code']) && empty($_COOKIE['Link'])) {
   require_once("public/Functions/smth.php");
  
}
else {
    $cc = $_COOKIE['code'];
    $cc1 = $_COOKIE['Link'];
    $ins= mysqli_query($connect,"INSERT INTO `Url`(`url`, `short`) VALUES ('$cc1','$cc')");
}
?> 


<div class="container" >
       <div class="enter_quiz reddy">    
    <!-- <br/>  -->
                   <h1 class="redeed">Your Quiz is Ready!</h1>
                   <p>Share your quiz-link with your friends!</p>
                       <p>They will try to guess your answers &amp; get a score out of 10.</p>
                   <div class="link_share" id="linkDiv">
                   <script>
            document.write(link);
            </script>
                   </div>
            <div class="link-copied">Link Copied</div>
           <div class="clearfix"></div>
           <button class="btn btn-default cop_textred" id="copy-link">Copy Link</button>

                                   
           <div class="share_part">
            <a onclick="return socialButton(this,'whatsapp')" href="whatsapp://send?text=🙋‍♀ _How much do you know about me?_ 🙋‍♂%0A*Answer my HolaQuiz* 🖊📘 %0A😇👇👇👇👇👇😇%0Ahttps://holaquiz.com/sync-quiz/crkBp" class="btn btn-lg btn-block onl_btn-whatsapp wats" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
              <img src="https://holaquiz.com/public/images/whatsapp.png" alt=""> <span class="share_text_page">Set Status</span>
              <span class="hidden-xs"></span>
            </a>
               <div class="row">
               <div class="col-md-6 col-sm-6 col-xs-6 share_incre">
                    <a href="javascript:void(0)" onclick="fb_share('https://holaquiz.com/sync-quiz/crkBp?utm_site_source=share&amp;utm_site_medium=facebook&amp;utm_site_campaign=facebook-shares');socialButton(this,'fb_share');" class="btn btn-lg btn-block onl_btn-facebook" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
              <i class="fa fa-facebook fa-2x"></i> <span class="share_text_page">Share</span>
              <span class="hidden-xs"></span>
            </a>
               </div>
                   <div class="col-md-6 col-sm-6 col-xs-6  share_decre">
                                                <a onclick="return socialButton(this,'snap_share')" href="#" class="btn btn-lg btn-block onl_btn-bell stroke snapchat-share-button" data-share-url="https://holaquiz.com/sync-quiz/crkBp?utm_site_source=share&amp;utm_site_medium=snapchat&amp;utm_site_campaign=snapchat-shares">
                        
        	<img src="https://holaquiz.com/public/images/snapchat.png">
					<span class="share_text_page_que_share">Share</span>
              <span class="hidden-xs"></span>
            </a>
               </div>
                   <div class="col-md-6 col-sm-6 col-xs-6 share_incre">
                    <a onclick="return socialButton(this,'messenger_share')" href="fb-messenger://share?link=https://holaquiz.com/sync-quiz/crkBp?utm_site_source=share-facebook-messenger" class="btn btn-lg btn-block onl_btn-messanger" data-toggle="tooltip" data-placement="top" title="" data-original-title="messanger">
              <img src="https://holaquiz.com/public/images/messanger.png" alt=""> Share              <span class="hidden-xs"></span>
            </a>
               </div>
                   
                   <div class="col-md-6 col-sm-6 col-xs-6  share_decre">
                   <a onclick="return socialButton(this,'twitter_share')" target="_blank" href="http://twitter.com/share?text=How+much+do+you+know+about+me%3F+Answer+my+HolaQuiz+%40holaquizcom+%F0%9F%91%89&amp;url=https%3A%2F%2Fholaquiz.com%2Fsync-quiz%2FcrkBp%3Futm_site_source%3Dshare%26utm_site_medium%3Dtwitter%26utm_site_campaign%3Dtwitter-shares" class="btn btn-lg btn-block onl_btn-twitter" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
              <i class="fa fa-twitter fa-2x"></i>  <span class="share_text_page">Share</span>
              <span class="hidden-xs"></span>
            </a>
               </div>
                   
                   <div class="col-md-6 col-sm-6 col-xs-6 share_incre">
                   <a onclick="return socialButton(this,'insta_share')" data-target="#myModalInsta" class="btn btn-lg btn-block onl_btn-bio" data-toggle="modal" data-placement="top" title="" data-original-title="Twitter">
              <i class="fa fa-instagram"></i>  <span class="share_text_page">Add to Bio</span>
              <span class="hidden-xs"></span>
            </a>
               </div>
                   
                   <div class="col-md-6 col-sm-6 col-xs-6  share_decre">
                  <a onclick="return socialButton(this,'whatsapp_status')" href="whatsapp://send?text=🙋‍♀ _How much do you know about me?_ 🙋‍♂%0A*Answer my HolaQuiz* 🖊📘 %0A😇👇👇👇👇👇😇%0Ahttps://holaquiz.com/sync-quiz/crkBp" class="btn btn-lg btn-block onl_btn-whatsapp wats" data-placement="top" title="" data-original-title="Facebook">
              <img src="https://holaquiz.com/public/images/whatsapp.png" alt=""> Set Status              <span class="hidden-xs"></span>
            </a>
               </div>

               <!--div class="col-md-3 col-sm-3 col-xs-3">
                    <a href="viber://forward?text=How%20much%20do%20you%20know%20about%20me%3F%20Answer%20my%20HolaQuiz%20%40holaquizcom%20%F0%9F%91%89https%3A%2F%2Fholaquiz.com%2Fsync-quiz%2FcrkBp%3Futm_site_source%3Dshare-viber" class="btn btn-lg btn-block onl_btn-viber" >
                        <img src="https://holaquiz.com/public/images/share-btn-viber.png" alt="" class="center">
                        <span class="hidden-xs"></span>
                    </a>
                </div-->
                    
                <div class="col-md-6 col-sm-6 col-xs-6 share_incre  ">
                    <a onclick="return socialButton(this,'line_share')" href="line://msg/text/?How%20much%20do%20you%20know%20about%20me%3F%20Answer%20my%20HolaQuiz%20%40holaquizcom%20%F0%9F%91%89https%3A%2F%2Fholaquiz.com%2Fsync-quiz%2FcrkBp%3Futm_site_source%3Dshare-lineit" class="btn btn-lg btn-block onl_btn-line">
                        <img src="https://holaquiz.com/public/images/share-btn-line.png">
                        <span class="share_text_page">Share</span>
                        <span class="hidden-xs"></span>
                        </a>
                 </div>
                    
                <!--div class="col-md-3 col-sm-3 col-xs-3">
                    <a href="skype:?chat=How%20much%20do%20you%20know%20about%20me%3F%20Answer%20my%20HolaQuiz%20%40holaquizcom%20%F0%9F%91%89https%3A%2F%2Fholaquiz.com%2Fsync-quiz%2FcrkBp%3Futm_site_source%3Dshare-skype" class="btn btn-lg btn-block  onl_btn-skype skype-share" data-href='https://holaquiz.com/sync-quiz/crkBp?utm_site_source=share-skype' data-lang='' data-text='How much do you know about me? Answer my HolaQuiz @holaquizcom 👉' data-style='' id="">
                        <img src="https://holaquiz.com/public/images/share-btn-skype.png" alt="" class="center">
                        <span class="hidden-xs"></span>
                    </a>
                </div-->
                    
                <div class="col-md-6 col-sm-6 col-xs-6 share_decre">
                    <a onclick="return socialButton(this,'telegram_share')" href="tg://msg?text=How%20much%20do%20you%20know%20about%20me%3F%20Answer%20my%20HolaQuiz%20%40holaquizcom%20%F0%9F%91%89https%3A%2F%2Fholaquiz.com%2Fsync-quiz%2FcrkBp%3Futm_site_source%3Dshare-telegram" class="btn btn-lg btn-block onl_btn-telegram">
                        <img src="https://holaquiz.com/public/images/share-btn-telegram.png">
                        <span class="share_text_page">Share</span>
                        <span class="hidden-xs"></span>
                    </a>
                </div>

               
               <div class="col-md-6 col-sm-6 col-xs-6 share_incre">
					<a onclick="return socialButton(this,'kakao_share')" href="#" class="btn btn-lg btn-block onl_btn-kakao" data-toggle="tooltip" data-placement="top" title="" data-original-title="Kakao" id="kakao-link-btn" data-url="https://holaquiz.com/sync-quiz/crkBp?utm_site_source=share-kakao">
                      <img src="https://holaquiz.com/public/images/share-btn-kakao.png" alt="" class="center">
                      <span class="share_text_page"> Share</span>
					  <span class="hidden-xs"></span>
					</a>
               </div>
			   
			   <div class="col-md-6 col-sm-6 col-xs-6 share_decre">
					<a onclick="return socialButton(this,'bbm_share')" href="bbmi://api/share?userCustomMessage=How much do you know about me? Answer my HolaQuiz @holaquizcom 👉&amp;message=https%3A%2F%2Fholaquiz.com%2Fsync-quiz%2FcrkBp%3Futm_site_source%3Dshare-bb" class="btn btn-lg btn-block onl_btn-BBM" data-toggle="tooltip" data-placement="top" title="" data-original-title="BBM">
                      <img src="https://holaquiz.com/public/images/share-btn-bb.png" alt="" class="center">
                      <span class="share_text_page"> Share</span>
					  <span class="hidden-xs"></span>
					</a>
               </div> 
			   <div class="col-md-6 col-sm-6 col-xs-6 share_incre">
					<a onclick="return socialButton(this,'vk_share')" href="http://vk.com/share.php?url=https://holaquiz.com/sync-quiz/crkBp?utm_site_source=share-vk&amp;title=How+much+do+you+know+about+me%3F+Answer+my+HolaQuiz%21&amp;description=It%E2%80%99s+the+test+of+our+friendship.+Answer+these+simple+questions+about+me+now%21&amp;image=https://img.holaquiz.com/public/site_content/quiz/ck_editor/images/meta/Hola_one/Hola_One_English_Friend(1).jpg" class="btn btn-lg btn-block onl_btn-VK" data-toggle="tooltip" data-placement="top" title="" data-original-title="VK">
                      <img src="https://holaquiz.com/public/images/share-btn-vk.png" alt="" class="center">
                      <span class="share_text_page"> Share</span>
					  <span class="hidden-xs"></span>
					</a>
               </div> 
               <div class="col-md-6 col-sm-6 col-xs-6 share_decre">
                   <a onclick="return socialButton(this,'tiktok_share')" data-target="#myModalTiktok" class="btn btn-lg btn-block onl_btn-tiktok" data-toggle="modal" data-placement="top" title="" data-original-title="Tiktok">
                   <img src="https://holaquiz.com/public/images/tiktok.png" alt="" class="center">  <span class="share_text_page">Add to Bio</span>
              <span class="hidden-xs"></span>
            </a>
               </div>
           </div>
           </div>
           
           <div class="resltss">
            <h2>You can see the results when you open your quiz-link in this browser only.</h2>
           </div>
          
		   
                          <div>
               
           </div>      
                    <a onclick="return gtmEventTracking('view_scoreboard')" target="_blank" href="" class="btn btn-default cop_textred">View Your Scoreboard</a>
          
           
           
        </div>
        
  
    </div>

    <script>
    document.cookie = 'Link=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
    document.cookie = 'code=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
    </script>
<?require_once("footer.php");?>