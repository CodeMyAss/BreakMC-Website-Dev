<?php

    include("../inc/sql.php");
    include("../inc/util.php");
    
    if(SessionUtil::getUsername() !== null) {
        
        $log = SessionUtil::auth($con, SessionUtil::getUsername(), SessionUtil::getPassword());
        
    }
    
?>


<html>

        <head>
    
        <!-- CSS Links  -->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/wheel.css">
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
	    <link rel="icon" href="../img/favicon.png">
        <!-- /Title & Meta -->
        
        <!-- Extra Scripts  -->
        
        <style>
        
               .staff-mrg-top {
                   margin-top: -75px;
               } 
        
            @media (max-width:1024px) {
            
               .staff-mrg-top {
                   margin-top: 0px;
               } 
            
            }
        
        </style>
        
       <script>
        
            $(document).ready(function(){
            
                $("[rel='tooltip']").tooltip();
                
            });
        
        </script>
        
        <script type="text/javascript">
        
            $(document).ready(function() {
                
                $('.info-1').delay(1000).fadeIn(400);
                $('.info-2').delay(1300).fadeIn(400);
                $('.info-3').delay(1500).fadeIn(400);
                $('.info-4').delay(1700).fadeIn(400);
                $('.info-5').delay(1900).fadeIn(400);
                $('.info-6').delay(2100).fadeIn(400);
                $('.info-7').delay(2300).fadeIn(400);
                $('.info-8').delay(2500).fadeIn(400);
                $('.info-9').delay(2600).fadeIn(400);
                 

                
                
                
                
            });
        
        </script>
        
        
    <script type="text/javascript">
        
            $(document).ready(function() {
                
                $('.navbar-slide-init').animate({"top":"0px"}, 500);
                
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
                            
                    <a class="navbar-brand" href="../">
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
                                        echo '<li><a href="../servers/' . strtolower($server) . '">' . ucfirst($server) . '</a></li>';
                                    }
                                
                                ?>
                                    
                            </ul>
                                    
                        </li> <!-- End of Servers Dropdown -->
                        
                        <li>
                        <a href="../forums"><span class="glyphicon glyphicon-comment" style="padding-right: 3px;"></span> 
                        Forums </a>
                        </li>
                        
                           <li class="dropdown"> <!-- Shop Dropdown -->
                                
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart" style="padding-right: 3px;"></span>
                            Store <span class="caret"></span></a>
                                    
                            <ul class="dropdown-menu" role="menu">
                                
                                <?php
                                
                                    foreach($shops as $shop) {
                                        echo '<li><a href="../store/' . strtolower($shop) . '">' . ucfirst($shop) . '</a></li>';
                                    }
                                
                                ?>
                                    
                            </ul>
                                    
                        </li> <!-- End of Shop Dropdown -->
                        
                        <li>
                        <a href="../stats"><span class="glyphicon glyphicon-stats" style="padding-right: 3px;"></span>
                        Stats </a>
                        </li>
                        
                        <li class="dropdown"> <!-- Vote Dropdown -->
                                
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-thumbs-up" style="padding-right: 3px;"></span> 
                            Vote <span class="caret"></span></a>
                                    
                            <ul class="dropdown-menu" role="menu">
                                
                                <?php
                                
                                    foreach($voting as $vote) {
                                        echo '<li><a href="../vote/' . strtolower($vote) . '">' . ucfirst($vote) . '</a></li>';
                                    }
                                
                                ?>
                                    
                            </ul>
                                    
                        </li> <!-- End of Vote Dropdown -->
                        
                     <li class="dropdown"> <!-- Help Dropdown -->
                                
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-question-sign" style="padding-right: 3px;"></span> 
                            Help <span class="caret"></span></a>
                                    
                            <ul class="dropdown-menu" role="menu">
                                
                                <li><a href="../help">Help </a></li>
                                <li><a href="../tickets">Tickets </a></li>
                                    
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
                                            
                                            <a href="../acc/signout.php" class="btn btn-primary" style="width: 95%; margin-left: 2%;">Sign Out</a><br><hr>
                                        
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
                                            
                                                
                                            <form action="../acc/index.php" method="post">
                                                
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
                
        </nav><br>
        
        </head>
        <body>
        
            <div class="container" style="margin-top: 70px;">
    
                <div class="page-header info-1" style="margin-top: 0px; display: none;">
                
                   <h1>BreakMC Tickets
                      <small>Can't find <a href="../help">help</a>? Submit a ticket for staff below.</small>
                   </h1>
                   
                   <div style="float:right; margin-top: -25px;">
                       
                       <a href="view">View tickets here.</a>
                       
                   </div>
        
                </div><br>
                
                <?php
                
                    if(!$log) {
                        
                        ?>
                        
                            <div class="info-2" style="text-align: center; margin-top: 10%; display: none;">
                
                                <span class="glyphicon glyphicon-remove" style="font-size: 128px;"></span>
                                <h3>You need to be logged in to do this.</h3>
                            
                            </div>
                        
                        <?php
                     
                        die();
                        
                    }
                    
                ?>

                <div class="info-2" style="display: none;">
                    
                    <form action="submit/index.php" method="post">
                    
                        <div class="form-body">
                        
                            <label>Your Username:</label>
                                <input disabled placeholder="<?php echo SessionUtil::getUsername(); ?>"
                                    style="width: 100%;" class="form-control">
                                    
                            <Br>
                        
                            <label>Your Email:</label>
                                <input disabled placeholder="<?php echo MongoUtil::findOne($con, "beam_users", "users", "username_lower", strtolower(SessionUtil::getUsername()), "email"); ?>"
                                    style="width: 100%;" class="form-control">
                                    
                            <Br>
                            
                            <label>Please enter the location in which the problem occurred:</label>                                    
                                <div class="row">
                                    <div class="col-md-10">
                                      
                                      <div class="row">
                                        
                                         <div class="col-md-3">           <select required="" type="text" name="world" class="form-control" style="width:180px;" placeholder="Which world?">
                                                                            <option>Overworld</option>
                                                                            <option>Nether</option>
                                                                          </select> </div>
                                         <div class="col-md-2">            <input type="text" name="x" class="form-control" style="width:100px;" placeholder="X?" required maxlength="7"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"> </div>
                                         <div class="col-md-2">            <input type="text" name="y" class="form-control" style="width:100px;" placeholder="Y?" required maxlength="7"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"> </div> 
                                         <div class="col-md-2">            <input type="text" name="z" class="form-control" style="width:100px;" placeholder="Z?" required maxlength="7"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"> </div>
                                                    
                                      </div>
                                    </div>
                                </div>
                                
                            <Br>
                            
                            <input placeholder="What is the warp name?" name="warp"
                                style="width: 100%;" class="form-control">
                                
                            <Br>
                            
                            <input placeholder="Who else had a warp?" name="who_else_warp"
                                style="width: 100%;" class="form-control"> 
                                
                            <Br>
                            
                            <label>Please add any other issues:</label>
                            <textarea class="form-control" style="width: 100%;" name="issues"></textarea>
                            
                            <Br>
                            
                            <button type="submit" class="btn btn-primary" style="width: 100%;">
                                Submit
                            </button>
                            
                            <Hr>
                            
                            <p style="text-align:center; width: 70%; margin: auto; padding: auto;">
                                By clicking the above button you agree that <strong>all details</strong>
                                listed above, your <strong>IP Address</strong> and your 
                                <strong>Internet Service Provider</strong> will be recorded. 
                                Upon clicking the button incorrectly that it is considered abusing the BreakMC
                                network has the right to terminate your account and access to the BreakMC website and any or all BreakMC servers.<br><br>
                                
                                Please allow up to 48 hours for a reply from a staff member, either by email or in-game.
                            </p>
                            
                        </div>
                    
                    </form>
                    
                </div>
                
            </div>
        
        </body>
        </html>
        