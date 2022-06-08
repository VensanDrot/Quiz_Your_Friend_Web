/*
    Common functions and jquery code for site.
    
    To Do:
    Convert as much code as possible into angular.js
*/



// To Do
// Convert this into angular.js code

$(document).ready(function() {

    $('#login-confirm-psw').focus(function() {
        $('#login-password-err').hide();
    });

    $('#country_dropdown').click(function() {
        $('#country_selector').slideToggle();
    });

    /* $(".menu_section_tord").click(function(){
         $("nav").removeClass('show');
         $("#menu").removeClass('show in');
     });*/

    //code for removing the error message in input box when user click in the box 
    $("#name").focus(function() {
        $(".bottom_div .error").css('display', 'none');
    });
    $('.user_friend_side textarea').focus(function() { //to do for all themes for 
        $(".error").css('display', 'none');
    });
    //end

    //code for closing the menu bar  to do in truth n dare
    $(".middle_conatainer").click(function() {
        $("#menu,nav,.navbar-collapse").removeClass('in show');
        $("#menu,.navbar-collapse").attr('aria-expanded', "false");
        $(".collapse-icon").attr('aria-expanded', "false");
    });

    //
    // if($('#userStatsModal').length>0){
    //     $('#userStatsModal').on('show.bs.modal', function (e) {
    //         let id      =   $(e.relatedTarget).data('id');
    //         let name    =   $(e.relatedTarget).html();
    //         $('.modal-title',this).html(name+"'s answers");
    //         $.ajax({
    //                     url     :   '/get-quiz-by-user-quiz-id',
    //                     method  :   'post',
    //                     data    :   {id,id},
    //                     dataType:   'json'
    //         }).done(function(data){
    //             let html     =   '';
    //             questions  =   data.questions;
    //             questions.forEach(function(question){
    //                 html     +=   '<div class="row">'+
    //                                 '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">'+
    //                                     '<div class="userStatsModal-box">Q. '+question.question+'<br>';
    //                 options =   question.options;
    //                 options.forEach(function(option){
    //                     if(question.chQuestionOptionId==option.questionOptionId)
    //                     {
    //                         if(question.AlQuestionOptionId==question.chQuestionOptionId)
    //                             html            +=  '<div class="userStatsModal-correct">'+option.content+'</div>';
    //                         else
    //                             html            +=  '<div class="userStatsModal-wrong">'+option.content+'</div>';
    //                     }

    //                 });
    //                 html            +=  '</div></div></div>';    
    //             });
    //             $('#userStatsModalBody').append(html);
    //         });
    //     });

    //     $('#userStatsModal').on('hidden.bs.modal', function () {
    //         $('.modal-title',this).empty();
    //         $('#userStatsModalBody').empty();
    //     });
    // }

    if (document.getElementById("kakao-link-btn")) {
        url = document.getElementById("kakao-link-btn").getAttribute("data-url");
        Kakao.init('efea97f7053b32bb5acdb88fc42d1d85');
        Kakao.Link.createScrapButton({
            container: '#kakao-link-btn',
            requestUrl: url
        });
    }

    if (arrJsConfig.DFP_ADREFRESH_TI > 0) {
        setInterval(function() {
            refreshDfpAdd()
        }, arrJsConfig.DFP_ADREFRESH_TI);
    }

    var hamburger = document.querySelector('.hamburger');
    if (hamburger) {
        hamburger.addEventListener('click', function() { return hamburger.classList.toggle('opened'); });
    }


    if ($('#canvas') && $('#canvas').length > 0) {
        var HeartsBackground = {
            heartHeight: 20,
            heartWidth: 24,
            hearts: [],
            heartImage: '/public/images/lovemeter/Heart.png',
            maxHearts: 20,
            minScale: 0.2,
            draw: function() {
                this.setCanvasSize();
                this.ctx.clearRect(0, 0, this.w, this.h);
                for (var i = 0; i < this.hearts.length; i++) {
                    var heart = this.hearts[i];
                    heart.image = new Image();
                    heart.image.style.height = heart.height;
                    heart.image.src = this.heartImage;
                    this.ctx.globalAlpha = heart.opacity;
                    this.ctx.drawImage(heart.image, heart.x, heart.y, heart.width, heart.height);
                }
                this.move();
            },
            move: function() {
                for (var b = 0; b < this.hearts.length; b++) {
                    var heart = this.hearts[b];
                    heart.y += heart.ys;
                    if (heart.y > this.h) {
                        heart.x = Math.random() * this.w;
                        heart.y = -1 * this.heartHeight;
                    }
                }
            },
            setCanvasSize: function() {
                this.canvas.width = document.getElementsByClassName("main_container")[0].clientWidth;
                this.canvas.height = document.getElementsByClassName("main_container")[0].clientHeight;
                this.w = this.canvas.width;
                this.h = this.canvas.height;
            },
            initialize: function() {
                this.canvas = $('#canvas')[0];

                if (!this.canvas.getContext)
                    return;

                this.setCanvasSize();
                this.ctx = this.canvas.getContext('2d');

                for (var a = 0; a < this.maxHearts; a++) {
                    var scale = (Math.random() * (1 - this.minScale)) + this.minScale;
                    this.hearts.push({
                        x: Math.random() * this.w,
                        y: Math.random() * this.h,
                        ys: Math.random() + 1,
                        height: scale * this.heartHeight,
                        width: scale * this.heartWidth,
                        opacity: scale
                    });
                }

                setInterval($.proxy(this.draw, this), 30);
            }
        };

        HeartsBackground.initialize();

    }
});






function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function addHoverClass(event) {
    $("#" + event.id).parent('div').addClass('optionHover');
}

function removeHoverClass(event) {
    $("#" + event.id).parent('div').removeClass('optionHover');
}
var elem = document.documentElement;

function playHtml5Game() {
    $(".play_container").attr('src', $("#gameUrl").val());
    $('.banner_sec').addClass('play_game_sec');
    let diviceWidth = $(document).width();
    if (diviceWidth < 992) {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.webkitRequestFullscreen) { /* Safari */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE11 */
            elem.msRequestFullscreen();
        }
    }
}






$(".ins_submit_btn").click(function() {
    let id = $("#name").val();
    if (id == "") {
        $('#name').parent().addClass('err_active');

    } else {
        $('#name').parent().removeClass('err_active');
    }
});
$('#name').click(function() {
    $(this).parent().removeClass('err_active');
});




function check_play_form(name, e) {
    var isvalid = true;


    $('.nameMsg').hide();
    $('.genderMsg').hide();
    $('.countryMsg').hide();
    $('.atinnameMsg').hide();
    $(".curseWordMsg").hide();
    if ($("#genderMsg")) {
        $("#genderMsg").removeClass('enter_name_error');
    }
    var name = $("#name").val().replace(/ /g, '');
    if (name == '') {
        $('.nameMsg').show();
        isvalid = false;
    }
    if (name !== '') {
        var text = $("#name").val();
        var notrequiredChar = arrJsConfig.NAME_JUNK_WORD_LIST;
        for (var i = 0; i < notrequiredChar.length; i++) {
            var index = text.indexOf(notrequiredChar[i]);
            if (index > 0) {
                isvalid = false;
                break;
            }
        }
    }

    if (document.getElementById("countryId")) {
        if ($("#countryId").val() == '' || $("#countryId").val() == '0') {
            $('.countryMsg').show();
            isvalid = false;
        }
    }


    var name = $("#name").val();
    if (name.indexOf('@') != -1) {
        $('.atinnameMsg').show();
        isvalid = false;
    }

    if (abusive_words_list.length > 0) {
        const regexp = new RegExp(`\\b^.*(${abusive_words_list.join('|')}).*$\\b`, 'gi');
        const is_found = name.match(regexp);
        if (is_found) {
            isvalid = false;
            $(".curseWordMsg").show();
        }
    }
    if (isvalid == true) {
        gtmEventTracking('confirm');
    }
    return isvalid;
}


function country_selected(id, name) {
    $("#countryId").val(id);

    $("#country_dropdown_text").html(name);
    $('.countryMsg').hide();
    $('#country_selector').hide();
    return val(name);
    //gtmEventTracking('country');
}