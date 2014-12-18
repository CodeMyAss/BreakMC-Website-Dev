<?php

    include("../inc/sql.php");
    include("../inc/util.php");
    
    if(SessionUtil::getUsername() !== null) {
        
        $log = SessionUtil::auth($con, SessionUtil::getUsername(), SessionUtil::getPassword());
        
    }
    
                                                function isStaff($con) {
                                                    
                                                $rank = strtolower(MongoUtil::findOne($con, "beam_users", "users", "username_lower", strtolower(SessionUtil::getUsername()), "group"));
            
                                                if(SessionUtil::getUsername() == "GenericHat" || SessionUtil::getUsername() == "Xertol" || $rank == "mod" || $rank == "admin" || $rank == "developer" || $rank
                                                    == "owner") {
                                                        return true;
                                                    }
                                                    
                                                return false;
                                                
                                            }
                                            
        function up($log, $con, $id) {
            
            if($log) {
                
                if(!isStaff($con)) {
                    
                    echo '<script>window.location = "' . stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) . '";</script>';
                    die();
                    
                }
                
            } else {
                    
                    echo '<script>window.location = "' . stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) . '";</script>';
                    die();
                    
            }
            
            $id_now = MongoUtil::findOne($con, "beam_forums", "categories", "list", $id, "id");
            $id_above = MongoUtil::findOne($con, "beam_forums", "categories", "list", $id-1, "id");
            
            $c = $con->selectCollection("beam_forums", "categories");
            
            $newdata = array('$set' => array("list" => intval($id-1)));
            $c->update(array("id" => $id_now), $newdata);
            
            $newdata = array('$set' => array("list" => intval($id)));
            $c->update(array("id" => $id_above), $newdata);
            
            
            echo '<script>window.location = "' . stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) . '";</script>';
            die();
            
        }
        
        function down($log, $con, $id) {
            
            if($log) {
                
                if(!isStaff($con)) {
                    
                    echo '<script>window.location = "' . stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) . '";</script>';
                    die();
                    
                }
                
            } else {
                    
                    echo '<script>window.location = "' . stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) . '";</script>';
                    die();
                    
            }
            
            $id_now = MongoUtil::findOne($con, "beam_forums", "categories", "list", $id, "id");
            $id_below = MongoUtil::findOne($con, "beam_forums", "categories", "list", $id+1, "id");
            
            $c = $con->selectCollection("beam_forums", "categories");
            
            $newdata = array('$set' => array("list" => intval($id+1)));
            $c->update(array("id" => $id_now), $newdata);
            
            $newdata = array('$set' => array("list" => intval($id)));
            $c->update(array("id" => $id_below), $newdata);
            
            
            echo '<script>window.location = "' . stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) . '";</script>';
            die();
            
        }

        function delete2($log, $con, $id) {
            
            if($log) {
                
                if(!isStaff($con)) {
                    
                    echo '<script>window.location = "' . stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) . '";</script>';
                    die();
                    
                }
                
            } else {
                    
                    echo '<script>window.location = "' . stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) . '";</script>';
                    die();
                    
            }
            
            $c = $con->selectCollection("beam_forums", "categories");
            $c->remove(array('id' => intval($id)));
            
            $c = $con->selectCollection("beam_forums", "threads");
            $c->remove(array('parent' => intval($id)));
            
                    echo '<script>window.location = "' . stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) . '";</script>';
                    die();
            
        }
                                            
        if(isset($_REQUEST['up']) && intval($_REQUEST['up']) !== null) {
            
            $id = intval($_REQUEST['up']);
            up($log, $con, $id);
            
        } else if(isset($_REQUEST['down']) && intval($_REQUEST['down']) !== null) {
            
            $id = intval($_REQUEST['down']);
            down($log, $con, $id);
            
        } else if(isset($_REQUEST['delete']) && intval($_REQUEST['delete']) !== null) {
            
            $id = intval($_REQUEST['delete']);
            delete2($log, $con, $id);
            
        }
    
?>


<html>

        <head>
    
        <!-- CSS Links  -->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/table.css">
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
                        
                        <li>
                        <a href="../forums"><span class="glyphicon glyphicon-comment" style="padding-right: 3px;"></span> 
                        Forums </a>
                        </li>
                        
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
                
                   <h1>BreakMC Forums
                      <small>Jump right into the community.</small>
                   </h1>
        
                </div><br>
                
                <div class="info-2" style="display: none;">
                
                    <?php
                    
                        if(isset($_REQUEST['id'])) {
                            
                                // Get category from ID.
                                $catName = MongoUtil::findOne($con, "beam_forums", "categories", "id", intval($_REQUEST['id']), "name");
                                $catStaff = MongoUtil::findOne($con, "beam_forums", "categories", "id", intval($_REQUEST['id']), "staff");
                                if($catName == null) {
                                    echo '<script>window.location="' . stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) . '";</script>';
                                    die();
                                }
                                
                                if($catStaff == "true") {
                                    
                                    if(!isStaff($con)) {
                                        
                                        echo '<script>window.location="' . stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) . '";</script>';
                                        die();
                                        
                                    }
                                    
                                }
                            
                            if(isset($_REQUEST['thread'])) {
                                
                                
                                
                            } else {
                                
                                $PER_PAGE = 10;
                                
                                $threads = MongoUtil::find($con, "beam_forums", "threads", "parent", intval($_REQUEST['id']));
                                $threads->sort(array("id" => -1));
                                $thrd = iterator_to_array($threads);
                                
                                $pages = sizeof($thrd) / $PER_PAGE;
                                    
                            }
                                
                                ?>
                                
                                    <ul class="breadcrumb info-3" style="display: none; text-align: center;">
                                      <li><a href="<?php echo stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">Forums</a></li>
                                      <li class="active"><?php echo $catName; ?></li>
                                    </ul>
                                    
                                    <form action="thread.php" method="post">
                                    
                                        <button type="submit" class="btn btn-primary info-4" style="width: 100%; display: none; margin-bottom: -12px;">Create a thread</button>
                                    
                                    </form>
                                    
                                    <br>
                                
                                    <table class="info-5 table table-hover table-compressed" style="display: none;">
                                
                                        <thead>
                                        
                                            <tr>
                                                
                                                <th>
                                                    Name
                                                </th>
                                                
                                                <th>
                                                    Author
                                                </th>
                
                                                <th>
                                                    Sticky
                                                </th>
                
                                                <th>
                                                    Important
                                                </th>
                                                
                                            </tr>
                                        
                                        </thead>
                                    
                                        <tbody>
                                        
                                            <?php
                                            
                                                $count = 0;
                                                foreach($thrd as $thread) {
                                                    
                                                    $count+=1;
                                                    if($count >= $PER_PAGE) {
                                                        
                                                        break;
                                                        
                                                    }
                                                    
                                                    echo '<tr>';
                                                        
                                                        echo '<td><a href="?id=' . $thread["parent"] . '&thread=' . $thread["id"] . '">' . $thread['name'] . '</a></td>';
                                                        echo '<td><img src="http://cravatar.eu/helmavatar/' . $thread['author'] . '/16" style="margin-left: 3.5%;"></td>';
                                                        
                                                        echo '<td>';
                                                        
                                                            if($thread["sticky"] == "true") {
                                                                echo '<div class="label" style="background-color: #F15725; width: 100%;">Sticky</div>';
                                                            } else {
                                                                echo '<div class="label label-default" style="width: 100%;">None</div>';
                                                            }
                                                            
                                                        echo '</td>';
                                                        
                                                        echo '<td>';
                                                        
                                                            if($thread["important"] == "true") {
                                                                echo '<div class="label label-danger" style="=width: 100%;">Important</div>';
                                                            } else {
                                                                echo '<div class="label label-default" style="width: 100%;">None</div>';
                                                            }
                                                            
                                                        echo '</td>';
                                                        
                                                    echo '</tr>';
                                                    
                                                }
                                            
                                            ?>
                                        
                                        </tbody>
                                    
                                    </table>
                                
                                <?php
                                
                        } else {
                            
                            ?>
                            
                                <ul class="breadcrumb info-3" style="display: none; margin-top: -12px; text-align: center;">
                                  <li class="active">Forums</li>
                                </ul>
                                
                                <table class="info-4 table table-hover" style="display: none;">
                                
                                    <thead>
                                    
                                            
                                            <th>
                                                Name
                                            </th>
                                            
                                            <th>
                                                Description
                                            </th>
            
                                            <th>
                                                Threads
                                            </th>
                                            
                                            <?php
                                            
                                                if(isStaff($con)) {
                                                    
                                                    ?>
                                                    
                                                        <th>
                                                        
                                                            Options
                                                        
                                                        </th>
                                                    
                                                    <?php
                                                    
                                                }
                                            
                                            ?>
                                            
                                        </tr>
                                    
                                    </thead>
                                    
                                    <tbody>
                                   
   
                                <?php
                                        
                                            function threads($con, $id) {
                                                
                                                $amount  = 0;
                                                $threads = MongoUtil::find2($con, "beam_forums", "threads");
                                                
                                                foreach($threads as $thread) {
                                                    if($thread["id"] == $id) {
                                                        $amount++;
                                                    }
                                                }
                                                
                                                return $amount;
                                                
                                            }
                                            
                                            $categories = MongoUtil::find2($con, "beam_forums", "categories");
                                            $categories->sort(array("list" => 1));
                                            $cats = iterator_to_array($categories);
                                            
                                            $count = -1;
                                            foreach($cats as $cat) {
                                                
                                                $count+=1;                                                
                                                
                                                if($cat["staff"] == "true") {
                                                    
                                                    if($log && isStaff($con)) {
                                                        
                                                        echo '<tr>';
                                                            echo '<td><a href="?id=' . $cat["id"] . '">' . $cat["name"] . '</a></td>';
                                                            echo '<td>' . $cat["desc"] . '</td>';
                                                            echo '<td>' . threads($con, $cat["id"]) . '</td>';
                                                        
                                                            if(isStaff($con)) {
                                                                
                                                                ?>
                                                                
                                                                    <td>
                                                                        
                                                                        <?php
                                                                        
                                                                            if(!($count-1 < 0)) {
                                                                                
                                                                                ?>
                                                                                    <a href="<?php echo stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) ?>?up=<?php echo $cat["list"]; ?>"><span class="glyphicon glyphicon-arrow-up"></span></a>
                                                                                <?php
                                                                        
                                                                            } else {
                                                                                
                                                                                ?>
                                                                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                                                                <?php
                                                                                
                                                                            }
                                                                            
                                                                            if($count+1 !== sizeof($cats)) {
                                                                                
                                                                                ?>
                                                                                    <a href="<?php echo stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) ?>?down=<?php echo $cat["list"]; ?>"><span class="glyphicon glyphicon-arrow-down"></span></a>
                                                                                <?php
                                                                                
                                                                            } else {
                                                                                
                                                                                ?>
                                                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                                                                <?php
                                                                                
                                                                            }
                                                                            
                                                                            
                                                                        
                                                                        ?><a href="<?php echo stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) ?>?delete=<?php echo $cat["id"]; ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                                        
                                                                    </td>
                                                                
                                                                <?php
                                                                
                                                            }
                                                        
                                                        echo '</tr>';
                                                        
                                                    }
                                                    
                                                } else {
                                                    
                                                    echo '<tr>';
                                                        echo '<td><a href="?id=' . $cat["id"] . '">' . $cat["name"] . '</a></td>';
                                                        echo '<td>' . $cat["desc"] . '</td>';
                                                        echo '<td>' . threads($con, $cat["id"]) . '</td>';
                                                        
                                                            if(isStaff($con)) {
                                                                
                                                                ?>
                                                                
                                                                    <td>
                                                                        
                                                                        <?php
                                                                        
                                                                            if(!($count-1 < 0)) {
                                                                                
                                                                                ?>
                                                                                    <a href="<?php echo stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) ?>?up=<?php echo $cat["list"]; ?>"><span class="glyphicon glyphicon-arrow-up"></span></a>
                                                                                <?php
                                                                        
                                                                            } else {
                                                                                
                                                                                ?>
                                                                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                                                                <?php
                                                                                
                                                                            }
                                                                            
                                                                            if($count+1 !== sizeof($cats)) {
                                                                                
                                                                                ?>
                                                                                    <a href="<?php echo stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) ?>?down=<?php echo $cat["list"]; ?>"><span class="glyphicon glyphicon-arrow-down"></span></a>
                                                                                <?php
                                                                                
                                                                            } else {
                                                                                
                                                                                ?>
                                                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                                                                <?php
                                                                                
                                                                            }
                                                                            
                                                                            
                                                                        
                                                                        ?><a href="<?php echo stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])) ?>?delete=<?php echo $cat["id"]; ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                                        
                                                                    </td>
                                                                
                                                                <?php
                                                                
                                                            }
                                                        
                                                    echo '</tr>';
                                                
                                                }
                                                
                                            }
                                        
                                        ?>

        
                                    
                                    </tbody>
                                    
                                </table>
                            
                            <?php
                                            
                                            if(sizeof($cats) == 0) {
                                                echo '<strong class="info-6" style="display: none; font-size: 18px; text-align:center;">Sorry! No categories were found.</strong>';
                                            }
                            
                        }
                        
                    ?>
                
                </div>
                
            </div>
        
        </body>
        </html>
        