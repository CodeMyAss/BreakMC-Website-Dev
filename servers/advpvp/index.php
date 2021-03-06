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
        
                <script>
        
            $(document).ready(function(){
            
                $("[rel='tooltip']").tooltip();
                
            });
        
        </script>
        
        <script type="text/javascript">
        
            $(document).ready(function() {
                
                $('.navbar-slide-init').animate({"top":"0px"}, 500);
                $('.big-banner').delay(750).fadeIn(400);
                $('.head1').delay(750).fadeIn(400)
                $('.info-1').delay(1000).fadeIn(400);
                $('.info-2').delay(1300).fadeIn(400);
                $('.info-3').delay(1500).fadeIn(400);
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
           <h1>AdvancedPVP
              <small>Join AdvancedPVP.com to play!</small>
           </h1>
           <hr style="margin-bottom: 40px; margin-top: 30px;"> 
        
            <div class="row">
            
                <div class="col-md-4 info-1" style="display: none; text-align: center; margin: 0 auto; padding: 0 auto;">
                <img src="http://i.imgur.com/HwlKOmC.png" class="img-responsive" style="margin-left: auto; margin-right: auto;">
                    <h1>Competition</h1>
                    AdvancedPVP is a server that allows a player to fight other players and create teams.  You can fight your enemies on the server and team with your friends.  AdvancedPVP has much competition such as tracking, pvping, and raiding players.  You can do anything you want in the map, such building a base or griefing one.  Start your journey on BreakMC's hardcore server, AdvancedPVP.

                    <br><br>
                </div>
                
                <div class="col-md-4 info-2" style="display: none; text-align: center; margin: 0 auto; padding: 0 auto;">
                <img src="http://i.imgur.com/xRyKXaR.png" class="img-responsive" style="margin-left: auto; margin-right: auto;">
                    <span style="margin-bottom: 25px;"><h1>Excitement</h1>
                    AdvancedPVP hosts monthly events on the server such as the end event, tower event, and other custom coded events.  Players who win these events get gear usually not obtainable in the game.  Start playing now on AdvancedPVP to participate in these often hosted events on the server.

                    </span>
                <br>
                <br>
                </div>
            
                <div class="col-md-4 info-3" style="display: none; text-align: center; margin: 0 auto; padding: 0 auto;">
                <img src="http://i.imgur.com/6chRtD7.png" class="img-responsive" style="margin-left: auto;margin-right: auto;">
                    <span style="margin-bottom: 25px;"><h1>Community</h1>
                    AdvancedPVP's community is full of players that are PVPing right now.  You can use kits right when you join the server, so you can start your voyage on the server immediately.  Feel free to contribute for items on the server at AdvancedPVP's store page.  

                    </span>
                </div>
            
            </div>
        
            <hr>
           <div class="page-header head2" style="margin-top: -0px; display: none;">
               <h1>Online Players
                  <small>who's on advpvp?</small>
               </h1>
           </div><br>
           
           <div class="panel panel-default">
               <div class="panel-heading">
                   <strong>Online</strong><span style="float:right;" class="online-count"></span>
               </div>
               
               <div class="panel-body online-player">
                   
                   
                   
               </div>
           </div>
        
    </body>
</html>