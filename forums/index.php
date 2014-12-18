<?php

    include("../inc/util.php");
    include("../inc/sql.php");
    
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
    
                                                function threads($con, $id) {
                                                
                                                $amount  = 0;
                                                $threads = MongoUtil::find2($con, "beam_forums", "threads");
                                                
                                                foreach($threads as $thread) {
                                                    if($thread["parent"] == $id) {
                                                        $amount++;
                                                    }
                                                }
                                                
                                                return $amount;
                                                
                                            }
                                            
                                            function posts($con, $id) {
                                                
                                                $amount  = 0;
                                                $thready = MongoUtil::find($con, "beam_forums", "threads", "parent", $id);
                                                
                                                foreach(iterator_to_array($thready) as $thrd) {
                                                        
                                                    $posts  = MongoUtil::find($con, "beam_forums", "posts", "parent", $thrd["id"]);
                                                    $amount += sizeof(iterator_to_array($posts));
                                                    
                                                }
                                                
                                                return $amount;
                                                
                                            }
    
    // Load Categories
    $categories = MongoUtil::find2($con, "beam_forums", "categories");
    $categories->sort(array("id" => 1));
    $cats = iterator_to_array($categories);

?>
<html>

        <head>
    
        <!-- CSS Links  -->
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/css/wheel.css">
        <link rel="stylesheet" type="text/css" href="/css/curve.css">
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
        
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create a Category</h4>
                  </div>
                  <div class="modal-body" style="font-size: 16px; padding-bottom: 3px;">
                    
                    <form action="create.php?category" method="post">
                    
                        <div class="form-body">
                        
                            <input type="text" name="name" class="form-control" style="width: 100%;" placeholder="Name" maxlength="50" autocomplete="off" required>
                            <input type="text" name="desc" class="form-control" style="width: 100%; margin-top: 13px;" placeholder="Description" maxlength="150" autocomplete="off">
                            <select class="form-control" name="view" style="width: 50%; margin-top: 13px; display: inline-block;" required>
                                
                                <option>Everyone</option>
                                <option>Only Staff</option>
                                
                            </select><label style="display: inline-block; margin-left: 8px;">can see this.</label>
                        <br><br>
                            You will be able to view the category <a style="cursor: pointer;" data-dismiss="modal">behind</a> this modal once created.
                            
                        </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button style="float: left;" type="button" class="btn btn-default" data-dismiss="modal">Dismiss</button>
                    <button style="float: left;" type="submit" class="btn btn-primary">Create</button>
                    
                    <span style="display: block; float: right; margin-right: 10px; margin-top: -5px;"><span style="display: inline-block; margin-top: 14px; padding-right: 3px;"><?php echo SessionUtil::getUsername(); ?></span>
                        <img src="http://cravatar.eu/helmavatar/<?php echo SessionUtil::getUsername(); ?>/32.png" style="border-radius: 8px; margin-top: -6px;"> 
                    </span>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- /Modal -->

            <div class="container" style="margin-top: 70px;">
                
                <div class="page-header" style="margin-top: 0px;">
                    <h1>Forums <small>Jump right into the community.</small></h1>
                </div>
                
                <ul class="breadcrumb" style="text-align: center;">
                  <li class="active">Categories</li>
                </ul>
                
                <?php
                
                    if($log && isStaff($con)) {
                        
                        ?>
                        
                            <a href="#" class="btn btn-success" style="width: 100%;"
                               data-toggle="modal"
                               data-target="#myModal">Create a Category</a>
                               
                            <hr>
                        
                        <?php
                        
                    }
                
                ?>
                
                <table class="table table-hover table-striped" style="font-size: 14.5px;">
                
                    <tbody>
                    
                        <tr style="font-size: 15.5px;">
                        
                            <td>Category Name</td>
                            <td class="text-center">Threads</td>
                            <td class="text-center">Posts</td>
                            <?php
                            
                                if($log && isStaff($con)) {
                                    
                                    ?>
                                    
                                        <td class="text-right">Options</td>
                                    
                                    <?php
                                    
                                }
                            
                            ?>
                        
                        </tr>
                        
                        <?php
                        
                            foreach($cats as $category) {
                                
                                if($category["staff"] === "false" || $category["staff"] === false) {
                                    
                                    echo $category["staff"];
                                    
                                    if($log && isStaff($con)) {
                                        echo '<tr>';
                                            
                                            echo '<td>
                                            
                                                <a style="font-size: 15px;" href="' . $category["id"] . '"><b>' . $category["name"] . '</b></a>
                                                <br>
                                                <small>' . $category["desc"] . '</small>
                                            
                                            </td>';
                                            echo '<td class="text-center" style="font-size:20px; line-height: 15px; vertical-align: middle;">' . threads($con, intval($category["id"])) . '</td>';
                                            echo '<td class="text-center" style="font-size:20px; line-height: 15px; vertical-align: middle;">' . posts($con, intval($category["id"])) . '</td>';
                                            
                                            if($log && isStaff($con)) {
                                                
                                                echo '<td class="text-right" style="padding-right: 15px;">
                                                
                                                    <a href="trash.php?cat=' . $category["id"] . '"><span class="glyphicon glyphicon-trash" style="font-size: 18px; line-height: 34.5px; vertical-align: middle;" alt="Delete"></span></a>
                                                    <a href="edit.php?cat=' . $category["id"] . '"><span class="glyphicon glyphicon-pencil" style="font-size: 18px; line-height: 34.5px; vertical-align: middle;" alt="Edit"></span></a>
                                                
                                                </td>';
                                                
                                            }
                                            
                                        echo '</tr>';
                                    }
                                    
                                } else {
                                    echo '<tr>';
                                        
                                        echo '<td>
                                        
                                            <a style="font-size: 15px;" href="' . $category["id"] . '"><b>' . $category["name"] . '</b></a>
                                            <br>
                                            <small>' . $category["desc"] . '</small>
                                        
                                        </td>';
                                        echo '<td class="text-center" style="font-size:20px; line-height: 15px; vertical-align: middle;">' . threads($con, intval($category["id"])) . '</td>';
                                        echo '<td class="text-center" style="font-size:20px; line-height: 15px; vertical-align: middle;">' . posts($con, intval($category["id"])) . '</td>';
                                        
                                        if($log && isStaff($con)) {
                                            
                                            echo '<td class="text-right" style="padding-right: 15px;">
                                            
                                                <a href="trash.php?cat=' . $category["id"] . '"><span class="glyphicon glyphicon-trash" style="font-size: 18px; line-height: 34.5px; vertical-align: middle;" alt="Delete"></span></a>
                                                <a href="edit.php?cat=' . $category["id"] . '"><span class="glyphicon glyphicon-pencil" style="font-size: 18px; line-height: 34.5px; vertical-align: middle;" alt="Edit"></span></a>
                                            
                                            </td>';
                                            
                                        }
                                        
                                    echo '</tr>';
                                }
                                
                            }
                        
                        ?>
                    
                    </tbody>
                
                </table><hr>
                
                <?php
                
                    if(sizeof($cats) > 0) {
                        
                        ?>
                        
                            <p style="text-align: center;"><span style="width: 50%;"><strong>Boom! </strong>A total of <?php echo sizeof($cats) . ' '; if(sizeof($cats) == 1) {
                                echo 'thread was';
                            } else {
                                echo 'threads were';
                            }
                            ?> loaded.</span></p>
                        
                        <?php
                        
                    } else {
                        
                        ?>
                        
                            <p style="text-align: center;"><span style="width: 50%;"><strong>Well, this is awkward. </strong>A total of <?php echo sizeof($cats) . ' '; if(sizeof($cats) == 1) {
                                echo 'thread was';
                            } else {
                                echo 'threads were';
                            }
                            ?> loaded.</span></p>
                        
                        <?php
                        
                    }
                    
                ?>
                
            </div>
        
         
        
        </body>
    </html>