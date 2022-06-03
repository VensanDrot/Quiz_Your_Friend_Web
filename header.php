<?session_start();
require_once("public/Functions/dbcon.php");?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>How much do your friends know you? Create your HolaQuiz!</title>
    <link href="public/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="public/css/common-spinner.css" rel="stylesheet" type="text/css" />
    <link href="public/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="public/css/quiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100;0,8..144,200;0,8..144,300;0,8..144,400;0,8..144,500;1,8..144,100;1,8..144,200;1,8..144,300;1,8..144,400;1,8..144,500&display=swap" rel="stylesheet">
    <script type="text/javascript" src="public/js/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/bd35cfa493.js" crossorigin="anonymous"></script>
</head>

<body class="home">
    <nav class="navbar navbar-default navbar-static-top navbar-custom" role="navigation" ng-controller="headerController">

        <div class="navbar-header">

            <a class="navbar-brand" href="index.php">
                <img src="public/images/buz.png" alt="" width="200" height="41">
            </a>

            <button type="button" class="navbar-toggle" id="navbarToggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-1">
            <ul class="nav navbar-nav  navbar-right">

                <!-- 
                <li class="lang-selector">
                   class="change-language" for new design changes, not ready yet
                    <select class="" name="lang" onchange="changeLang(this)">
                        <option value='cn'>繁體中文</option><option value='ch'>简体中文</option><option value='kr'>한국어</option><option value='th'>ภาษาไทย</option><option value='jp'>日本語</option><option value='my'>Bahasa Melayu</option><option value='id'>Bahasa Indonesia</option><option value='vn'>tiếng Việt</option><option value='es'>Español</option><option value='pt'>Português</option><option value='it'>Italiano</option><option value='fr'>Français</option><option value='de'>Deutsch</option><option value='nl'>Nederlands</option><option value='fi'>Suomi</option><option value='ru'>Русский</option><option value='ar'>عربي</option><option value='il'>עִבְרִית</option><option value='tr'>Türkçe</option><option value='el'>Ελληνικά</option><option value='bg'>Български</option><option value='rs'>Srpsko-hrvatski</option><option value='rom'>Română</option><option value='hu'>Magyar</option><option value='cz'>čeština</option><option value='dk'>Dansk</option><option value='no'>Norsk</option><option value='se'>svenska</option><option value='en' selected>English</option><option value='lv'>Latviešu</option><option value='si'>Slovenščina</option><option value='slk'>Slovenčina</option><option value='ee'>Eesti</option><option value='ge'>ქართული</option><option value='cat'>Català</option><option value='ua'>українська</option><option value='hi'>हिंदी</option><option value='bn'>বাঙালি</option><option value='ta'>தமிழ்</option><option value='pl'>Polskie</option><option value='ph'>Tagalog</option><option value='hg'>Hinglish</option>   
                        </select>
                </li> -->
                <!-- links should be changed -->
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="social.php">Social</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
            </ul>
        </div>
    </nav>