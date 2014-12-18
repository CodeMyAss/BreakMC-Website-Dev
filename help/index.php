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
        
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">An account?</h4>
                  </div>
                  <div class="modal-body" style="font-size: 16px;">
                    <u>Advantages</u>
                    <ul>
                        <li>You can submit support tickets to staff.</li>
                        <li>You can post to the forums.</li>
                        <li>You get to see your username on the navbar all the time!</li>
                    </ul>
                    <br>
                    
                    <u>How does it work?</u>
                    <ol>
                        <li>Log into any BreakMC server.</li>
                        <li>Type /register in the chat, and follow any further instructions.</li>
                        <li>Once you've received confirmation, head back here.</li>
                        <li>In the top right corner of the page (navigation bar), hit the profile icon.</li>
                        <li>Enter your new username & password in the dropdown; press submit.</li>
                        <li>Your name should now appear in the top right, you're logged in!</li>
                    </ol>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Dismiss</button>
                  </div>
                </div>
              </div>
            </div>
        
            <div class="container" style="margin-top: 70px;">
    
                <div class="page-header info-1" style="margin-top: 0px; display: none;">
                
                   <h1>BreakMC Help
                      <small>Wanting a quick answer? You're in the right place.</small>
                   </h1>
        
                </div><br>
                
                <div class="row">
                    
                    <div class="col-md-9 info-2" style="display: none;">
                        
                        <div class="alert alert-info" data-toggle="modal" data-target="#myModal" 
                            style="width: 100%; text-align:center; cursor: pointer;">
                                Hey there! You can get an account by logging into any BreakMC server and typing /register in the chat.
                        </div>
                        
                    </div>
                    
                    
                    <div class="col-md-9 info-3" style="display: none;">
                            
                        <div class="panel panel-default" style="width: 100%;">
                            <div class="panel-heading" style="text-align:center;">
                                <strong style="font-size: 18px;">Rules</strong>
                            </div>
                            <div class="panel-body">
                                1. No hacks or mods that will give you advantages over other players. This includes Xray, Minimap, and hacked clients.<br><br>
                                2. No spamming. This includes global chat, and private messaging.<br><br>
                                3. No Cyber-Terroristic threats/or actions. This includes all DDOS paraphernalia.<br><br>
                                4. Use common sense. Don't just say "it's not in the rules" when you're clearly doing something wrong.<br><br>
                                5. Do not exploit any bugs. Always report them to staff.<br><br>
                                6. No DIRECT racism. Calling a specific person a racial slur is DIRECT. Saying it without direction, but just saying it, is NOT direct racism.
                            </div>
                        </div>
                        
                         <div class="panel panel-default" style="width: 100%;">
                            <div class="panel-heading" style="text-align:center;">
                                <strong style="font-size: 18px;">FAQ</strong>
                            </div>
                            <div class="panel-body">
                       Q: Can I spam in private message?<br>
                       A: No, you can not. <br><br>
 
                       Q: How do I get Youtube rank?<br>
                       A: Message TurtleBwo in game! <br><br>
 
                       Q: How do I apply for staff?<br>
                       A: Email Contact@AdvancedPvP.com! <br><br>
 
                       Q: Can I use Damage Indicators mod?<br>
                       A: Yes, as long as the mod doesn't give you an advantage over other players. <br><br>
 
                       Q: Can I use racial slurs towards my friends?<br>
                       A: No, that is direct racism. It may be a friend as a joke, but we do not joke about
                       racism.<br><br>
 
                        Q: If I find a glitch in the system, can I use it?<br>
                       A: No, please report all glitches and exploits to staff so we can fix it ASAP. 
                            </div>
                        </div>
                            
                            
                     <div class="panel panel-default" style="width: 100%;">
                            <div class="panel-heading" style="text-align:center;">
                                <strong style="font-size: 18px;">Player Commands</strong>
                            </div>
                            <div class="panel-body">
                       /team: Displays the commands for Teams. <Br> <Br>
                      /track: Displays the commands for Tracking. <Br> <Br>
                      /go: Displays the commands for warping. (warps are homes!) <Br> <Br>
                      /buy: Buy an in-game item from the market. (/donate is for in-game ranks!) <Br> <Br>
                      /sell: Sell an in-game item for money. <Br> <Br>
                      /price: Check a price of an item. <Br> <Br>
 
                      World Border: 10,000 by 10,000!
                            </div>
                        </div>
                    
                    </div>

                    <div class="col-md-3 info-4 staff-mrg-top" style="display:none;">
                        
                        <div class="panel panel-default">
                        
                            <div class="panel-heading"><h4>BreakMC Staff <small style="padding-left: 5px;">who's online to help?</small></h4></div>
                            
                            <div class="panel-body">
                            
                                <?php 
                            
                                    $users  = MongoUtil::getCollection($con, "beam_users", "users");
                                    $cursor = $users->find();
                                    
                                    $limit = 15;
                                    
                                    $mods = array();
                                    $admins = array();
                                    $devs = array();
                                    $owners = array();
                                    
                                    foreach ($cursor as $doc) {
                                        
                                        if ($doc['group'] == "Moderator") {
                                            
                                            array_push($mods, $doc['username']);
                                            
                                        } else if ($doc['group'] == "Admin") {
                                            
                                            array_push($admins, $doc['username']);
                                            
                                        } else if ($doc['group'] == "Developer") {
                                            
                                            array_push($devs, $doc['username']);
                                            
                                        } else if ($doc['group'] == "Owner") {
                                            
                                            array_push($owners, $doc['username']);
                                            
                                        }
                                        
                                    }
                            
                                ?>
                                
                                <div class="page-header" style="margin-top: 0;">
                                    <h4>Owners</h4>
                                </div>
                                
                                <?php
                                
                                    if(sizeof($owners) == 0) {
                                        echo 'Sorry! No owners could be found.';
                                    }
                                
                                    $count = 0;
                                    foreach($owners as $owner) {
                                        $count++;
                                        
                                        if($count == $limit)
                                            break;
                                        
                                        echo '<img rel="tooltip" data-original-title="' . $owner . '" src="http://cravatar.eu/helmavatar/' . $owner . '/32.png" style="padding: 2px;">';
                                    }
                                
                                ?><br>
                                
                                <div class="page-header" style="margin-top: 30px;">
                                    <h4>Developers</h4>
                                </div>
                                
                                <?php 
                                
                                    if(sizeof($devs) == 0) {
                                        echo 'Sorry! No developers could be found.';
                                    }
                                
                                    $count = 0;
                                    foreach($devs as $dev) {
                                        $count++;
                                        
                                        if($count == $limit)
                                            break;
                                            
                                        echo '<img rel="tooltip" data-original-title="' . $dev . '" src="http://cravatar.eu/helmavatar/' . $dev . '/32.png" style="padding: 2px;">';
                                    }
                                
                                ?><br>
                                
                                <div class="page-header" style="margin-top: 30px;">
                                    <h4>Admins</h4>
                                </div>
                                
                                <?php 
                                
                                    if(sizeof($admins) == 0) {
                                        echo 'Sorry! No administrators could be found.';
                                    }
                                
                                    $count = 0;
                                    foreach($admins as $admin) {
                                        $count++;
                                        
                                        if($count == $limit)
                                            break;
                                            
                                        echo '<img rel="tooltip" data-original-title="' . $admin . '" src="http://cravatar.eu/helmavatar/' . $admin . '/32.png" style="padding: 2px;">';
                                    }
                                
                                ?>
                                
                                <div class="page-header" style="margin-top: 30px;">
                                    <h4>Mods</h4>
                                </div>
                                
                                <?php 
                                
                                    if(sizeof($mods) == 0) {
                                        echo 'Sorry! No moderators could be found.';
                                    }
                                
                                    $count = 0;
                                    foreach($mods as $mod) {
                                        $count++;
                                        
                                        if($count == $limit)
                                            break;
                                            
                                        echo '<img rel="tooltip" data-original-title="' . $mod . '" src="http://cravatar.eu/helmavatar/' . $mod . '/32.png" style="padding: 2px;">';
                                    }
                                
                                ?><br>
                                <hr>
                        
                        </div>
                    
                    </div>                    
                
                </div>
        
        </body>
        </html>
        