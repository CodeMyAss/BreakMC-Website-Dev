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
        
            <img src="http://placehold.it/1691x282" class="img-responsive big-banner" style="display:none;">
            <hr class="big-banner" style="display:none;">
            <div class="page-header head1" style="margin-top: -0px; display: none;">
           <h1>TeamsPvP
              <small>join TeamsPvP.com to play!</small>
           </h1>
           <hr style="margin-bottom: 40px; margin-top: 30px;"> 
        
            <div class="row">
            
                <div class="col-md-4 info-1" style="display: none; text-align: center; margin: 0 auto; padding: 0 auto;">
                <img src="http://placehold.it/500x200" class="img-responsive" style="margin-left: auto; margin-right: auto;">
                    <h1>Competition</h1>
                    Lorem ipsum dolor sit amet, ad velit scribentur vel, sea posse scribentur an, mei an detracto singulis. Et vix tation nostrum reprimique, cibo reque intellegat quo at. Ex saepe fabulas qui, sea vidisse albucius abhorreant ea. Accusam deleniti scriptorem vix at, et exerci deterruisset nam. Eum wisi facilis nominati id. Quo eu euismod atomorum, eam an accusam accusata.
                    <br><br>
                </div>
                
                <div class="col-md-4 info-2" style="display: none; text-align: center; margin: 0 auto; padding: 0 auto;">
                <img src="http://placehold.it/500x200" class="img-responsive" style="margin-left: auto; margin-right: auto;">
                    <span style="margin-bottom: 25px;"><h1>Hardcore</h1>
                    Lorem ipsum dolor sit amet, ad velit scribentur vel, sea posse scribentur an, mei an detracto singulis. Et vix tation nostrum reprimique, cibo reque intellegat quo at. Ex saepe fabulas qui, sea vidisse albucius abhorreant ea. Accusam deleniti scriptorem vix at, et exerci deterruisset nam. Eum wisi facilis nominati id. Quo eu euismod atomorum, eam an accusam accusata.
                    </span>
                <br>
                <br>
                </div>
            
                <div class="col-md-4 info-3" style="display: none; text-align: center; margin: 0 auto; padding: 0 auto;">
                <img src="http://placehold.it/500x200" class="img-responsive" style="margin-left: auto;margin-right: auto;">
                    <span style="margin-bottom: 25px;"><h1>Community</h1>
                    Lorem ipsum dolor sit amet, ad velit scribentur vel, sea posse scribentur an, mei an detracto singulis. Et vix tation nostrum reprimique, cibo reque intellegat quo at. Ex saepe fabulas qui, sea vidisse albucius abhorreant ea. Accusam deleniti scriptorem vix at, et exerci deterruisset nam. Eum wisi facilis nominati id. Quo eu euismod atomorum, eam an accusam accusata.
                    </span>
                </div>
            
            </div>
        
            <hr>
           <div class="page-header head2" style="margin-top: -0px; display: none;">
           <h1>Quick stats
              <small>see how your doing!</small>
           </h1>
        </div>
        
    </body>
</html>