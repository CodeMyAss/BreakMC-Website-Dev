<?php
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();        
    }
    
    $username = $_SESSION['breakmc_usrname'];
    $_SESSION['breakmc_usrname'] = "";
    
?>
<!DOCTYPE html>
<html>

        <head>
    
        <!-- CSS Links  -->
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/css/wheel.css">
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
        <link rel="icon" href="/img/favicon.png">
        <!-- /Title & Meta -->
        
        <!-- Extra Scripts  -->

        <?php

            function secondsToDHMS($seconds)
      {

         $days = floor($seconds/86400);
         $hrs = floor($seconds/3600);
         $mins = intval(($seconds / 60) % 60); 
         $sec = intval($seconds % 60);

            if($days>0){
              //echo $days;exit;
              $hrs = str_pad($hrs,2,'0',STR_PAD_LEFT);
              $hours=$hrs-($days*24);
              $return_days = $days." Days ";
              $hrs = str_pad($hours,2,'0',STR_PAD_LEFT);
         }else{
          $return_days="";
          $hrs = str_pad($hrs,2,'0',STR_PAD_LEFT);
         }

         $mins = str_pad($mins,2,'0',STR_PAD_LEFT);
         $sec = str_pad($sec,2,'0',STR_PAD_LEFT);

         return $return_days.$hrs.":".$mins.":".$sec;
      }

        ?>
        
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
        
            function slideError() {
                
                $('.logged_in_error').animate({"marginTop":"15%"}, 2000);
                $('.logged_in_error').delay(1950).animate({"marginTop":"30%", "opacity":"0.0"}, 2000);
                $('.logged_in_error').delay(0).fadeOut('slow');
                
                setTimeout(function() {
                    
                    window.history.back();
                    
                }, 6000);
                
            }
        
        </script>
        
        <!-- /Extra Scripts -->
        
        <style>
        
            .quik-info {
                    
            border-right: 1px solid #eeeeee; 
                    
            }
        
            @media (max-width: 1024px) {
                
                .quik-info {
                    
                    border-left: 0px solid white;
                    border-right: 0px solid white;
                    border-bottom: 1px solid #eeeeee;
                    
                }
                
            }
        
        </style>
        
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
                            
                    <a class="navbar-brand" href="/">
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
                                        echo '<li><a href="/servers/' . strtolower($server) . '">' . ucfirst($server) . '</a></li>';
                                    }
                                
                                ?>
                                    
                            </ul>
                                    
                        </li> <!-- End of Servers Dropdown -->
                        
                        <li class="dropdown"> <!-- Vote Dropdown -->
                                
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-thumbs-up" style="padding-right: 3px;"></span> 
                            Vote <span class="caret"></span></a>
                                    
                            <ul class="dropdown-menu" role="menu">
                                
                                <?php
                                
                                    foreach($voting as $vote) {
                                        echo '<li><a href="/vote/' . strtolower($vote) . '">' . ucfirst($vote) . '</a></li>';
                                    }
                                
                                ?>
                                    
                            </ul>
                                    
                        </li> <!-- End of Vote Dropdown -->
                        
                           <li class="dropdown"> <!-- Shop Dropdown -->
                                
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart" style="padding-right: 3px;"></span>
                            Store <span class="caret"></span></a>
                                    
                            <ul class="dropdown-menu" role="menu">
                                
                                <?php
                                
                                    foreach($shops as $shop) {
                                        echo '<li><a href="/store/' . strtolower($shop) . '">' . ucfirst($shop) . '</a></li>';
                                    }
                                
                                ?>
                                    
                            </ul>
                                    
                        </li> <!-- End of Shop Dropdown -->
                        
                        <li>
                        <a href="/stats"><span class="glyphicon glyphicon-stats" style="padding-right: 3px;"></span>
                        Stats </a>
                        </li>
                        
                        <li>
                        <a href="/forums"><span class="glyphicon glyphicon-comment" style="padding-right: 3px;"></span> 
                        Forums </a>
                        </li>
                        
                     <li class="dropdown"> <!-- Help Dropdown -->
                                
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-question-sign" style="padding-right: 3px;"></span> 
                            Help <span class="caret"></span></a>
                                    
                            <ul class="dropdown-menu" role="menu">
                                
                                <li><a href="/help">Help </a></li>
                                <li><a href="/tickets">Tickets </a></li>
                                    
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
                                            
                                            <a href="/acc/signout.php" class="btn btn-primary" style="width: 95%; margin-left: 2%;">Sign Out</a><br><hr>
                                        
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
                                            
                                            <form action="/acc/index.php" method="post">
                                                
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
        
        <div class="container" style="margin-top: 20px;">
        
            <div class="page-header info-1" style="display: none;">
            
                <h1><?php echo $username; ?></h1>
            
            </div><br>
            
            <div class="row">

                <div class="col-md-3 quik-info info-3" style="display: none;">
                
                    <img src="http://minecraft-skin-viewer.com/body.php?u=<?php echo $username; ?>&s=110" style="display: block; margin-left: auto; margin-right: auto;">
                    
                    <hr>
                    
                     <div class="alert alert-info" style="width: 100%; display: block; padding-top: 5px; padding-bottom: 5px; text-align: center;">
                        
                        <?php 
                        
                            $info = MongoUtil::findOne($con, "beam_users", "users", 'username_lower', strtolower($username), 'group');
                            
                            if(!isset($info)) {
                                $info = "Player";
                            }
                            
                            echo $info;
                        
                        ?>
                        
                    </div>
                    
                    <hr>
                    
                    <table class="table table-striped table-hover">
                    
                       
                        
                        <tbody>
                            
                            <tr>
                            
                                <td>
                                    Logins
                                </td>
                                
                                <td>
                                    <?php 
                                    
                                    if(MongoUtil::findOne($con, "beam_users", "users", "username_lower", strtolower($username), "sign_in_count") !== null &&
                                    MongoUtil::findOne($con, "beam_users", "users", "username_lower", strtolower($username), "sign_in_count") !== "") {
                                        echo MongoUtil::findOne($con, "beam_users", "users", "username_lower", strtolower($username), "sign_in_count");
                                    } else {
                                        echo 'Unknown';
                                    }
                                    
                                    ?>
                                </td>
                            
                            </tr>
                        
                            <tr>
                            
                                <td>Last Join</td>
                                <td><?php 

                                date_default_timezone_set("America/Denver");                               
                                
                                $date = date('m-d-Y G:i', explode(' ', MongoUtil::findOne($con, "beam_users", "users", "username_lower", strtolower($username), "date_joined"))[1]);
                                
                                echo $date;
                                
                                ?></td>
                            
                            </tr>
                        
                        </tbody>
                    
                    </table>
                
                </div>
            
                
                <div class="col-md-9 info-5" style="display: none;">
            
                   <ul class="nav nav-tabs" role="tablist">
                      <li class="active"><a href="#home" role="tab" data-toggle="tab">AdvancedPvP</a></li>
                      <li><a href="#elite" role="tab" data-toggle="tab">EliteKits</a></li>
                      <li><a href="#profile" role="tab" data-toggle="tab">DeathBan</a></li>
                    </ul>


                <div class="col-md-8">
                <!-- Tab panes -->
                  <div class="tab-content">
                      <div class="tab-pane active" id="home" style="margin-left: 20px; margin-top: 20px;">
                      
                    
                    <table class="table table-striped table-condensed">
                                            <tr>
                                                <th>Team:</th>
                                                <td class="ng-binding" style="text-align: right; ;">425</td>
                                            </tr>
                                            <tr>
                                                <th>Money:</th>
                                                <td class="ng-binding" style="text-align: right; ;">124</td>
                                            </tr>
                                            <tr>
                                                <th>K/D Ratio:</th>
                                                <td class="ng-binding" style="text-align: right; ;">Illuminati team</td>
                                            </tr>
                                    
                                            
                                        </tbody>
                                    </table>
     
                      
                      </div>
                      
                      
                      <div class="tab-pane" id="elite" style="margin-left: 20px; margin-top: 20px;">
                      
                    
                    <table class="table table-striped table-condensed">
                                            <tr>
                                                <th>Kills:</th>
                                                <td class="ng-binding" style="text-align: right; ;">425</td>
                                            </tr>
                                            <tr>
                                                <th>Deaths:</th>
                                                <td class="ng-binding" style="text-align: right; ;">124</td>
                                            </tr>
                                            <tr>
                                                <th>K/D Ratio:</th>
                                                <td class="ng-binding" style="text-align: right; ;">Illuminati team</td>
                                            </tr>
                                            <tr>
                                                <th>Highest Killstreak:</th>
                                                <td class="ng-binding" style="text-align: right; ;">435</td>
                                            </tr>
                                            <tr>
                                                <th>ELO:</th>
                                                <td class="ng-binding" style="text-align: right; ;">435</td>
                                            </tr>
                                            <tr>
                                                <th>Money:</th>
                                                <td class="ng-binding" style="text-align: right; ;">435</td>
                                            </tr>
                                            <tr>
                                                <th>1v1 Wins:</th>
                                                <td class="ng-binding" style="text-align: right; ;">435</td>
                                            </tr>
                                            <tr>
                                                <th>1v1 Losses:</th>
                                                <td class="ng-binding" style="text-align: right; ;">435</td>
                                            </tr>
                                            <tr>
                                                <th>Event Wins:</th>
                                                <td class="ng-binding" style="text-align: right; ;">435</td>
                                            </tr>
                                        </tbody>
                                    </table>
     
                      
                      </div>
                      
                      
                      <div class="tab-pane" id="profile" style="margin-left: 20px; margin-top: 20px;">
                      
                      
                      <table class="table table-striped table-condensed">
                                            <tr>
                                                <th>Team:</th>
                                                <td class="ng-binding" style="text-align: right; ;">425</td>
                                            </tr>
                                            <tr>
                                                <th>Kills:</th>
                                                <td class="ng-binding" style="text-align: right; ;">124</td>
                                            </tr>
                                            <tr>
                                                <th>Deaths:</th>
                                                <td class="ng-binding" style="text-align: right; ;">Illuminati team</td>
                                            </tr>
                                            <tr>
                                                <th>K/D Ration:</th>
                                                <td class="ng-binding" style="text-align: right; ;">435</td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Gold:</th>
                                                <td class="ng-binding" style="text-align: right; ;">Yes</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
     
                      
                      </div>
                      
                     
                     </div>
            
            
            </div>
            
            
            
            <div class="col-md-4">
            <span style="display: block; margin-top: 20px;">
                Player Details
            </span>
            </div>
            
          
         </div> 
            
        </div>
        
    </body>

</html>