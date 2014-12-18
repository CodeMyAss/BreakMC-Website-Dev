<?php

    // Add includes
    include("../../inc/sql.php");
    include("../../inc/util.php");
    
    if(SessionUtil::getUsername() !== null) {
        
        $log = SessionUtil::auth($con, SessionUtil::getUsername(), SessionUtil::getPassword());
        
    }

?>
<!DOCTYPE html>
<html lang="en">

    <head>
    
        <!-- CSS Links  -->
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../../css/wheel.css">
        <!-- /CSS Links -->
        
        <!-- Script Links  -->
        <noscript></noscript>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <!-- /Script Links -->
        
        <!-- Title & Meta  -->
        <title>Welcome to BreakMC.com!</title>
        
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="BreakMC is the ultimate minigames server.">
	    <meta name="keywords" content="breakmc, minigames, gamemodes, minecraft, fun, exciting, pvp, hardcore, kits">
	    <meta name="author" content="GenericHat, Xertol">
	    <link rel="icon" href="../../img/favicon.png">
        <!-- /Title & Meta -->
        
        <!-- Extra Scripts  -->
        
        <script type="text/javascript">
        
            $(document).ready(function() {
                
                $('.navbar-slide-init').animate({"top":"0px"}, 500);
                $('.big-banner').delay(750).fadeIn(400);
                $('.head1').delay(750).fadeIn(400)
                $('.info-1').delay(1000).fadeIn(400);
                $('.info-2').delay(1300).fadeIn(400);
                $('.info-3').delay(1500).fadeIn(400);
                $('.info-4').delay(1800).fadeIn(400);
                $('.head2').delay(1550).fadeIn(400)
                $('.panel-main').delay(1550).fadeIn(400);
                $('.panel-main').animate({"width": "100%"}, 400);
                $('.panel-main').animate({"height": "12%"}, 400);
                $('.panel-title-main').delay(2500).fadeIn(700);
                $('.images-panel').delay(2500).fadeIn(700);
                $('.panel-main2').delay(1650).fadeIn(400);
                $('.panel-main2').animate({"width": "100%"}, 400);
                $('.panel-main2').animate({"height": "12%"}, 400);
                $('.panel-title-main2').delay(2600).fadeIn(700);
                $('.images-panel2').delay(2600).fadeIn(700);
                $('.panel-main3').delay(1650).fadeIn(400);
                $('.panel-main3').animate({"width": "100%"}, 400);
                $('.panel-main3').animate({"height": "12%"}, 400);
                $('.panel-title-main3').delay(2600).fadeIn(700);
                $('.images-panel3').delay(2600).fadeIn(700);
                
                
                
                
            });
            
            $(document).ready(function(){
                $("[rel=tooltip]").tooltip({ placement: 'top'});
            });
            
            $(document).ready(function(){
            
                setInterval(function() {
                    //$(".online-player").html("");
                    $(".online-player").load("getlatest.php");
                    $(".online-count").load("getlatest.php?amount")
                }, 2500);
                
            });
            
        </script>
        
        <!-- /Extra Scripts -->
        
    </head>
    
    <body>
    
        <nav class="navbar navbar-default navbar-fixed-top navbar-slide-init" role="navigation" style="top: -150px">
                
            <div class="container">
                    
                <div class="navbar-header">
                        
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            
                        <span class="sr-only">Toggle</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                                
                    </button>
                            
                    <a class="navbar-brand" href="../../">
                        BreakMC
                    </a>
                        
                </div>
                        
                <div class="collapse navbar-collapse" id="navbar-collapse">
                        
                    <ul class="nav navbar-nav">
                            
                        <li class="dropdown"> <!-- Servers Dropdown -->
                                
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-tasks" 
style="padding-right: 3px;"></span>Servers<span class="caret"></span></a>
                                    
                            <ul class="dropdown-menu" role="menu">
                                
                                <?php
                                
                                    foreach($servers as $server) {
                                        echo '<li><a href="../../servers/' . strtolower($server) . '">' . ucfirst($server) . '</a></li>';
                                    }
                                
                                ?>
                                    
                            </ul>
                                    
                        </li> <!-- End of Servers Dropdown -->
                        
                        <li>
                        <a href="../../forums"><span class="glyphicon glyphicon-comment" style="padding-right: 3px;"></span> 
                        Forums </a>
                        </li>
                        
                           <li class="dropdown"> <!-- Shop Dropdown -->
                                
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart" style="padding-right: 3px;"></span>
                            Store <span class="caret"></span></a>
                                    
                            <ul class="dropdown-menu" role="menu">
                                
                                <?php
                                
                                    foreach($shops as $shop) {
                                        echo '<li><a href="../../store/' . strtolower($shop) . '">' . ucfirst($shop) . '</a></li>';
                                    }
                                
                                ?>
                                    
                            </ul>
                                    
                        </li> <!-- End of Shop Dropdown -->
                        
                        <li>
                        <a href="../../stats"><span class="glyphicon glyphicon-stats" style="padding-right: 3px;"></span>
                        Stats </a>
                        </li>
                        
                        <li class="dropdown"> <!-- Vote Dropdown -->
                                
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-thumbs-up" style="padding-right: 3px;"></span> 
                            Vote <span class="caret"></span></a>
                                    
                            <ul class="dropdown-menu" role="menu">
                                
                                <?php
                                
                                    foreach($voting as $vote) {
                                        echo '<li><a href="../../vote/' . strtolower($vote) . '">' . ucfirst($vote) . '</a></li>';
                                    }
                                
                                ?>
                                    
                            </ul>
                                    
                        </li> <!-- End of Vote Dropdown -->
                        
                     <li class="dropdown"> <!-- Help Dropdown -->
                                
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-question-sign" style="padding-right: 3px;"></span> 
                            Help <span class="caret"></span></a>
                                    
                            <ul class="dropdown-menu" role="menu">
                                
                                <li><a href="../../help">Help </a></li>
                                <li><a href="../../tickets">Tickets </a></li>
                                    
                            </ul>
                                    
                        </li> <!-- End of Help Dropdown -->    
                        
                    </ul>
                            
                    <ul class="nav navbar-nav navbar-right" style="margin-right: 2px; margin-top: 1px;">
                                
                        <li class="dropdown">
        				    <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
        							
        					<span class="glyphicon glyphicon-user" <?php if($log) { echo 'style="padding-right: 3px;"'; } ?>></span> <?php echo SessionUtil::getUsername(); ?><b class="caret"></b></a>
        					<div class="dropdown-menu" style="min-width: 300px; text-align:center;">
        							
                                <?php
                                
                                    if($log) {
                                        
                                        ?>
                                        
                                            <div class="page-header" style="margin-top: -7px;">
                                            
                                                <h2><?php echo SessionUtil::getUsername(); ?></h2>
                                            
                                            </div>
                                            
                                            <a href="../../acc/signout.php" class="btn btn-primary" style="width: 95%; margin-left: 2%;">Sign Out</a><br><hr>
                                        
                                        <?php
                                        
                                    } else {
                                        
                                        ?>
                                        
                                            <div class="page-header" style="margin-top: -7px;">
                                            
                                                <h2>Sign In</h2>
                                            
                                            </div>
                                            
                                            <div class="alert alert-success" style="width: 85%; margin-left: 8%; height: 40px; line-height: 40px; padding: 0; vertical-align: central;">
                                            
                                                Use /register in-game in sign up.
                                            
                                            </div>
                                            
                                            <hr>
                                            
                                            <form action="../../acc/index.php" method="post">
                                                
                                                <div class="form-body" style="width: 80%; margin-left: 10%;">
                                                
                                                    <input type="text" name="user" class="form-control" placeholder="Your Username"><br>
                                                    <input type="password" name="pass" class="form-control" placeholder="Your Password" style="margin-top: -15px;"><br>
                                                    <input type="submit" class="btn btn-primary" placeholder="Login" style="margin-top: -10px; width: 100%;">
                                                
                                                </div>
                                                
                                            </form><hr>
                                        
                                        <?php
                                        
                                    }
                                
                                ?>
            							
        					</div>
        							
        				</li>
                                
                    </ul>
                        
                </div>
                    
            </div>
                
        </nav>
    
        <!-- Start of main content -->
    
        <div class="container" style="margin-top: 72px">
        
            <img src="/inc/banner-head.png" class="img-responsive big-banner" style="display:none;">
            <hr class="big-banner" style="display:none;">
            <div class="page-header head1" style="margin-top: -0px; display: none;">
           <h1>EliteKits
              <small>Join EliteKits.net to play!</small>
           </h1>
           </div>
        
            <div class="row">
            
                <div class="col-md-4 info-1" style="display: none; text-align: center; margin: 0 auto; padding: 0 auto;">
                <img src="http://i.imgur.com/GqOqN7A.png" class="img-responsive" style="margin-left: auto; margin-right: auto;">
                    <h1>Kits</h1>
                    EliteKits has custom, original kits.  We continue to add kits to the server weekly, and we also have free kit days, which are 12 hour periods that all kits are free.  You do not need to donate for kits either, they can be achieved straight through doing achievements.  Come try out all the kits at BreakMC's kit server, elitekits.net! 

                    <br><br>
                </div>
                
                <div class="col-md-4 info-2" style="display: none; text-align: center; margin: 0 auto; padding: 0 auto;">
                <img src="http://i.imgur.com/Bn6OZA1.png" class="img-responsive" style="margin-left: auto; margin-right: auto;">
                    <span style="margin-bottom: 25px;"><h1>Events</h1>
                   EliteKits has player hosted events coded into the server, where donors can host any events with tokens on the server.  Events can be full teamed server based, or they can be simply a quick LMS or Wool gamemode.  These events are meant to let players take a break from the hardcore pvping.

                    </span>
                <br>
                <br>
                </div>
            
                <div class="col-md-4 info-3" style="display: none; text-align: center; margin: 0 auto; padding: 0 auto;">
                <img src="http://i.imgur.com/zZQNsoO.png" class="img-responsive" style="margin-left: auto;margin-right: auto;">
                    <span style="margin-bottom: 25px;"><h1>Stats</h1>
                    EliteKits has a complete stats sytem, including a ranks in stats.  You can upgrade your rank by playing more and getting more kills, and the more that you complete achievements, the more custom kits / tokens you will receive for completing these ranks.
   

                    </span>
                </div>
            </div>
        
                <!-- I'll do it -->
                
                <div class="panel panel-default info-4" style="display: none; margin-top: 20px;">
                      <div class="panel-heading">Staff</div>
                              <div class="panel-body" style="margin-top: 10px;">
                                        <div class="row">
                                        
                                        <div class="col-md-6">
                                        <div class="page-header" style="margin-top: -1px;">
                                        Owners
                                        </div>
                                        <img src="http://cravatar.eu/head/Gayzmcgee/60.png" style="margin-right: 8px;" rel="tooltip" data-original-title="Gayzmcgee">
                                        <img src="http://cravatar.eu/head/eatinsalsa/60.png" style="margin-right: 8px" rel="tooltip" data-original-title="Gayzmcgee">
                                        <img src="http://cravatar.eu/head/Vireons/60.png" style="margin-right: 8px" rel="tooltip" data-original-title="Vireons">
                                        <img src="http://cravatar.eu/head/Exoi/60.png" style="margin-right: 8px" rel="tooltip" data-original-title="Exoi">
                                        <img src="http://cravatar.eu/head/Dawhn/60.png" style="margin-right: 8px" rel="tooltip" data-original-title="Dawhn">
                                        <img src="http://cravatar.eu/head/dbluk/60.png" style="margin-right: 8px" rel="tooltip" data-original-title="dbluk">
                                        
                                        <div class="page-header">
                                        Admins
                                        </div>
                                        <img src="http://cravatar.eu/head/robin1436/60.png" rel="tooltip" data-original-title="robin1436">
                                        <img src="http://cravatar.eu/head/GammaByte/60.png" rel="tooltip" data-original-title="GammaByte">
                                        <img src="http://cravatar.eu/head/Malrite/60.png" rel="tooltip" data-original-title="Malrite">
                                        <img src="http://cravatar.eu/head/Bhrid/60.png" rel="tooltip" data-original-title="Bhrid">
                                        <img src="http://cravatar.eu/head/zombielight/60.png" rel="tooltip" data-original-title="zombielight">
                                        <img src="http://cravatar.eu/head/HyperRealistic/60.png" rel="tooltip" data-original-title="HyperRealistic">
                                        
                                         <div class="page-header">
                                        Mod
                                        </div>
                                        <img src="http://cravatar.eu/head/Ziipay/60.png" rel="tooltip" data-original-title="Ziipay">
                                        <img src="http://cravatar.eu/head/OptiFineCape/60.png" rel="tooltip" data-original-title="OptiFineCape">
                                        <img src="http://cravatar.eu/head/DewPlexy/60.png" rel="tooltip" data-original-title="DewPlexy">
                                        <img src="http://cravatar.eu/head/Jacpot69/60.png" rel="tooltip" data-original-title="Jacpot69">
                                        
                                        
                                        </div>
                                        
                                        <div class="col-md-6">
                                        <div class="page-header" style="margin-top: -1px;">
                                        Co-Owner
                                        </div>
                                        <img src="http://cravatar.eu/head/Osodank1/60.png" rel="tooltip" data-original-title="Osodank1">
                                        
                                        <div class="page-header">
                                        Mod+
                                        </div>
                                        <img src="http://cravatar.eu/head/dagresha/60.png" rel="tooltip" data-original-title="dagresha">
                                        <img src="http://cravatar.eu/head/Orgasmz/60.png" rel="tooltip" data-original-title="Orgasmz">
                                        <img src="http://cravatar.eu/head/Woofeh/60.png" rel="tooltip" data-original-title="Woofeh">
                                        <img src="http://cravatar.eu/head/Cooner10/60.png" rel="tooltip" data-original-title="Cooner10">
                                        
                                        <div class="page-header">
                                        tMod
                                        </div>
                                        <img src="http://cravatar.eu/head/RandomRefills/60.png" rel="tooltip" data-original-title="RandomRefills">
                                        <img src="http://cravatar.eu/head/Shirohae/60.png" rel="tooltip" data-original-title="Shirohae">
                                        <img src="http://cravatar.eu/head/Corcheedos/60.png" rel="tooltip" data-original-title="Corcheedos">
                                        <img src="http://cravatar.eu/head/KrunchyTacos/60.png" rel="tooltip" data-original-title="KrunchyTacos">
                                        <img src="http://cravatar.eu/head/gethia_/60.png" rel="tooltip" data-original-title="gethia_">
                                        
                                        
                                        </div>
                                        
                                        </div>
                                        
                                        </div>
                              </div>
                        </div>
        
            </div>
        
    </body>
</html>