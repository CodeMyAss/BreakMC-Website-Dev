<?php

    include("../../inc/sql.php");
    include("../../inc/util.php");
    include("../../inc/mail.php");
    
    ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
    
    if(SessionUtil::getUsername() !== null) {
        
        $log = SessionUtil::auth($con, SessionUtil::getUsername(), SessionUtil::getPassword());
        
    }
    
    function isStaff($con) {
                                                    
        $rank = strtolower(MongoUtil::findOne($con, "beam_users", "users", "username_lower", strtolower(SessionUtil::getUsername()), "group"));
            
        if(SessionUtil::getUsername() == "GenericHat" || SessionUtil::getUsername() == "Xertol" || $rank == "admin" || $rank == "developer" || $rank
            == "owner") {
                    return true;
            }
                                                    
        return false;
                                                
    }
    
    if(!$log || !isStaff($con)) {
        
        echo '<script>
        window.location = "../";
        </script>';
        
    }
    
    $tix = MongoUtil::find2($con, "beam_forums", "tickets");
    $tix->sort(array("created" => 1, "completed" => -1));
    $tixts = iterator_to_array($tix);
    
    $id = -1;
    
    if(isset($_REQUEST['mark'])) {
        
        $toMark = intval($_REQUEST['mark']);
        $c = $con->selectCollection("beam_forums", "tickets");
        $c->update(array("id"=>$toMark), array('$set' => array("completed"=>true)));
        echo '<script>
        
        window.location = "/tickets/view";
        
        </script>';
        die();
        
    }
    
    if(isset($_REQUEST['unmark'])) {
        
        $toMark = intval($_REQUEST['unmark']);
        $c = $con->selectCollection("beam_forums", "tickets");
        $c->update(array("id"=>$toMark), array('$set' => array("completed"=>false)));
        echo '<script>
        
        window.location = "/tickets/view";
        
        </script>';
        die();
        
    }
    
    if(isset($_REQUEST['del'])) {
        
        $toDel = intval($_REQUEST['del']);
        $c = $con->selectCollection("beam_forums", "tickets");
        $c->remove(array("id"=>$toDel));
        echo '<script>
        
        window.location = "/tickets/view";
        
        </script>';
        die();
        
    }
    
    if(isset($_REQUEST['id'])) {
        
        $id = intval($_REQUEST['id']);
        if($id < 1) {
            unset($_REQUEST['id']);
        }
        
        $id = MongoUtil::findOne2($con, "beam_forums", "tickets", "id", $id);
        
        if($id === null) {
            unset($_REQUEST['id']);
        }
        
    }
    
?>


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
	    <link rel="icon" href="../../img/favicon.png">
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
                        
                        <li>
                        <a href="/forums"><span class="glyphicon glyphicon-comment" style="padding-right: 3px;"></span> 
                        Forums </a>
                        </li>
                        
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
        
        </head>
        <body>
        
            <div class="container" style="margin-top: 70px;">
            
                <div class="page-header" style="margin-top: 0px;">
                    <h1>Ticket Viewer<small style="padding-left: 5px;"> You can view tickets here.</small></h1>
                </div><br>
            
                <?php
                
                    if(!isset($_REQUEST['id'])) {
                        
                        ?>
                        
                            <div class="alert alert-danger"><strong>Hello <?php echo SessionUtil::getUsername(); ?>! </strong>The dealt with section marks whether or not a ticket has been sorted out, you can change it in the ticket window.</div><br>
                        
                            <table class="table table-hover table-striped" style="font-size: 14.5px;">
                           
                                <tbody>
                               
                                    <tr style="font-size: 15.5px;">
                                   
                                        <td class="text-left"><strong>Username</strong></td>
                                        <td class="text-center"><strong>Preview</strong></td>
                                        <td class="text-right"><strong>Email</strong></td>
                                        <td class="text-right"><strong>Dealt With</strong></td>
                                   
                                    </tr>
                                    
                                    <?php
                                    
                                        $count = 0;
                                        foreach($tixts as $ticket) {
                                            
                                            $count+=1;
                                            
                                            if($count === 200) {
                                                break;
                                            }
                                            
                                            echo '<tr>';
                                                
                                                echo '<td class="text-left">
                                                        
                                                        <a href="' . $ticket["id"] . '">' . $ticket["name"] . '</a>
                                                        
                                                </td>';
                                                
                                                echo '<td class="text-center" style="color: gray;">
                                                        
                                                        ' . str_replace("&lt;/strong&gt;", "</strong>", str_replace("&lt;strong&gt;", "<strong>", str_replace("&lt;br&gt;", " ", substr($ticket['message'], 0, 70)))) . '
                                                        
                                                </td>';
                                                
                                                echo '<td class="text-right">
                                                        
                                                        ' . $ticket["email"] . '
                                                        
                                                </td>';
                                                
                                                echo '<td class="text-right">
                                                        
                                                        ' . ($ticket["completed"] === false ? '<div class="label label-default" style="display: block; width: 40%; float:right;">No</div>' : '<div style="display: block; width: 40%; float:right;" class="label label-primary">Yes</div>') . '
                                                        
                                                </td>';
                                                
                                            echo '</tr>';
                                            
                                        }
                                    
                                    ?>
                                    
                                </tbody>
                                
                            </table>
                        
                        <?php
                        
                    } else {
                        
                        ?>
                        
                            <?php
                            
                                if($id["completed"]) {
                                    
                                    ?>
                                    
                                        <div class="alert alert-danger">
                                            <strong>Hey <?php echo SessionUtil::getUsername(); ?>! </strong>This has already been dealt with, the sender may be a bit confused if you reply.
                                        </div>
                                    
                                    <?php
                                    
                                } else {
                                    
                                    ?>
                                    
                                        <div style="background-color: #f5f5f5; border: 1px solid #e7e7e7;" class="alert">
                                            <strong>Hey <?php echo SessionUtil::getUsername(); ?>! </strong>This ticket is good to go and reply to, you can contact them via email or in-game.
                                        </div>
                                    
                                    <?php
                                    
                                }
                            
                            ?>
                        
                            <div class="panel panel-default">
                            
                                <div class="panel-heading">
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            
                                            <?php echo $id["name"]; ?>
                                            
                                        </div>
                                        
                                        <div class="col-md-4">
                                            
                                            <div style="float:right; padding-right: 32%;"><?php echo $id["email"]; ?></div>
                                            
                                        </div>
                                        
                                        <div class="col-md-4">
                                            
                                            <div style="float:right;"><?php echo $id["ip"]; ?></div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="panel-body">
                                
                                                <div style="margin-bottom: 25px;">
                                                
                                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?del=<?php echo $id['id']; ?>"><div style="margin-left: 5px; float: right; display: block;" class="glyphicon glyphicon-trash"></div></a>
                                                    <?php
                                                    
                                                        if($id['completed']) {
                                                            
                                                            ?>
                                                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?unmark=<?php echo $id['id']; ?>"><div style="margin-left: 5px; float: right; display: block;" class="glyphicon glyphicon-remove"></div></a>
                                                            <?php
                                                            
                                                        } else {
                                                            
                                                            ?>
                                                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?mark=<?php echo $id['id']; ?>"><div style="margin-left: 5px; float: right; display: block;" class="glyphicon glyphicon-ok"></div></a>
                                                            <?php
                                                            
                                                        }
                                                    
                                                    ?>
                                                
                                                </div>
                                
                                    <div style="margin-top: -25px;">
                                        <?php echo str_replace("&lt;/strong&gt;", "</strong>", str_replace("&lt;strong&gt;", "<strong>", str_replace("&lt;br&gt;", "<br>", $id['message']))); ?>
                                    </div>
                                
                                </div>
                            
                            </div>
                        
                        <?php
                        
                    }
                
                ?>
            
            </div>
        
        </body>
        </html>
        