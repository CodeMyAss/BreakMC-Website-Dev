<?php

    include("../inc/util.php");
    include("../inc/sql.php");
    
    if(!isset($_REQUEST['cat'])) {
        $_REQUEST['cat'] = 1;
    }
    
    $list = 1;
    if(isset($_REQUEST['list']) && intval($list) !== null) {
        $list = intval($_REQUEST['list']);
    }
    
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
    
    function isOwner($username, $author) {
        
        if(strtolower($username) == strtolower($author)) {
            return true;
        }
        return false;
        
    }
    
                                            function posts($con, $id) {
                                                
                                                $posts  = MongoUtil::find($con, "beam_forums", "posts", "parent", $id);
                                                return sizeof(iterator_to_array($posts));
                                                
                                            }
    
    // Load Categories
    $threads = MongoUtil::find($con, "beam_forums", "threads", "parent", intval($_REQUEST['cat']));
    $threads->sort(array("sticky" => -1, "important" => -1, "last_update" => -1));
    $thrs = iterator_to_array($threads);
    
    $threads = sizeof($thrs);
    $MAX_THREADS = 10;
    
    $lists = ($threads/$MAX_THREADS);
    if($lists < 1) {
        $lists = 1;
    }
    
    $lists = ceil($lists); // this equals 1-0 * 10 = 0, this equals 2-1 = 1 * 10 = 10
    
                            if($list <= 0) {
                            $list = 1;
                        }
                        
                        if($list > $lists) {
                            $list = 1;
                        }
    
    $start = ($list - 1) * 10;
    
    $cat = MongoUtil::findOne2($con, "beam_forums", "categories", "id", intval($_REQUEST['cat']));
    
    if($cat === null) {
        echo '<script>window.location = "/forums/index.php";</script>';
        die();
    }
    
    if($cat["staff"] === false || $cat["staff"] === "false") {
        
        echo '<script>window.location = "/forums/1";</script>';
        die();
        
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
        
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
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
        
        <body>
        
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create a Thread</h4>
                  </div>
                  <div class="modal-body" style="font-size: 16px; padding-bottom: 3px;">
                    
                    <form action="/forums/create.php?thread=<?php echo $cat['id']; ?>" method="post">
                    
                        <div class="form-body">
                        
                            <input type="text" name="name" class="form-control" style="width: 100%;" placeholder="Name" maxlength="50" autocomplete="off" required>
                            <textarea name="post" class="form-control" style="width: 100%; height: 25%; margin-top: 13px; max-width: 558px;" maxlength="1000" placeholder="Enter the contents of your post:" autocomplete="off"></textarea>
                            
                            <?php
                            
                                if(isStaff($con)) {
                                    
                                    ?>
                                    
                                        <input type="checkbox" name="sticky" style="margin-top: 13px; margin-right: 7px;">Sticky<br>
                            <input type="checkbox" name="important" style="margin-right: 7px;">Important
                                    
                                    <?php
                                    
                                }
                            
                            ?>
                            
                        <br><br>
                            You will be able to view the thread <a style="cursor: pointer;" data-dismiss="modal">behind</a> this modal once created.
                            
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
                    <div style="float:right; margin-top: -50px; margin-right: 7.5px;">
                    
                <?php
                    
                        if($list == 1) {
                            
                            ?>
                            
                                <div class="text-center">
                                <ul class="pagination" style="margin-top: 15px;">
                                  <li class="disabled"><a href="#"><</a></li>
                                  <li class="active"><a href="#">1</a></li>
                                  <?php
                                  
                                    for($count = 2; $count <= $lists; $count++) {
                                        
                                        echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/' . $count . '">' . $count . '</a></li>';
                                        
                                        if($count == 5) {
                                            break;
                                        }
                                        
                                    }
                                  
                                  ?>
                                  <li <?php if($list == $lists) { echo 'class="disabled"'; } ?>><a href="/forums/<?php echo $_REQUEST['cat']; ?>/<?php echo $lists; ?>">></a></li>
                                </ul>
                                </div>
                            
                            <?php
                            
                        } else if($list == 2) {
                            
                            ?>
                            
                                <div class="text-center">
                                <ul class="pagination" style="text-center">
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/1"><</a></li>
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/1">1</a></li>
                                  <li class="active"><a href="#">2</a></li>
                                  <?php
                                  
                                    for($count = 3; $count <= $lists; $count++) {
                                        
                                        echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/' . $count . '">' . $count . '</a></li>';
                                        
                                        if($count == 5) {
                                            break;
                                        }
                                        
                                    }
                                  
                                  ?>
                                  <li <?php if($list == $lists) { echo 'class="disabled"'; } ?>><a href="/forums/<?php echo $_REQUEST['cat']; ?>/<?php echo $lists; ?>">></a></li>
                                </ul>
                                </div>
                            
                            <?php
                            
                        } else if ($list == $lists-1) {
                            
                            ?>
                            
                                <div class="text-center">
                                <ul class="pagination" style="text-center">
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/1"><</a></li>
                                  <?php
                                  
                                    for($count = $lists-5; $count <= $lists-2; $count++) {
                                        
                                        echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/' . $count . '">' . $count . '</a></li>';
                                        
                                    }
                                  
                                  ?>
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/<?php echo $lists-2; ?>"><?php echo $lists-2; ?></a></li>
                                  <li class="active"><a href="#"><?php echo $lists-1; ?></a></li>
                                  <li class="disabled"><a href="/forums/<?php echo $_REQUEST['cat']; ?>/<?php echo $lists; ?>">></a></li>
                                </ul>
                                </div>
                            
                            <?php
                            
                        } else if ($list == $lists-2) {
                            
                            ?>
                            
                                <div class="text-center">
                                <ul class="pagination" style="text-center">
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/1"><</a></li>
                                  <?php
                                  
                                    for($count = $lists-5; $count <= $lists-2; $count++) {
                                        
                                        echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/' . $count . '">' . $count . '</a></li>';
                                        
                                    }
                                  
                                  ?>
                                  <li class="active"><a href="#"><?php echo $lists-2; ?></a></li>
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/<?php echo $lists-1; ?>"><?php echo $lists-1; ?></a></li>
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/<?php echo $lists; ?>">></a></li>
                                </ul>
                                </div>
                            
                            <?php
                            
                        } else {
                            
                            echo '<div class="text-center">';
                            echo '<ul class="pagination">';
                                
                                $before1 = $list - 2;
                                $before2 = $list - 1;
                                $after1  = $list + 1;
                                $after2  = $list + 2;
                                
                                $c_init = 0;
                                
                                echo '<li><a href="/forums/' . $_REQUEST['cat'] . '/1"><</a></li>';
                                
                                    echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/' . $before1 . '">' . $before1 . '</a></li>';
                                    echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/' . $before2 . '">' . $before2 . '</a></li>';
                                    echo '<li class="active"><a href="#">' . $list . '</a></li>';
                                    echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/' . $after1 . '">' . $after1 . '</a></li>';
                                    echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/' . $after2 . '">' . $after2 . '</a></li>';
                                
                                echo '<li><a href="/forums/' . $_REQUEST['cat'] . '/' . strval($lists - 1) . '">></a></li>';
                                
                            echo '</ul>';
                            echo '</div>';
                            
                        }
                    
                    ?>
                    
                    </div>
                </div>
                
                <ul class="breadcrumb" style="text-align: center;">
                  <li><a href="/forums">Categories</a></li>
                  <li class="active"><?php echo $cat["name"]; ?></li>
                </ul>
                        
                <?php
                
                    if($log) {
                        
                        ?>
                        
                            <a href="#" class="btn btn-success" style="width: 100%;"
                                data-toggle="modal"
                                data-target="#myModal">Create a Thread</a>
                        
                        
                        
                        <?php
                        
                    }
                
                ?>
                
                        <hr>
                
                <table class="table table-hover table-striped" style="font-size: 14.5px;">
                
                    <tbody>
                    
                        <tr style="font-size: 15.5px;">
                        
                            <td>Thread Name</td>
                            <td class="text-center">Posts</td>
                            <td class="text-center">Author</td>
                            <td class="text-right">Sticky</td>
                            <td class="text-right">Important</td>
                            <td class="text-right">Options</td>
                        
                        </tr>
                        
                        <?php
                        
                            $sofar = 0;
                            foreach($thrs as $category) {
                                
                                $sofar+=1;
                                
                                if($sofar >= $start+1) {
                                    
                                    echo '<tr>';
                                    
                                        echo "<td>
                                        
                                            <a style=\"font-size: 15px;\" href=\"/forums/" . $cat["id"] . '/t/' . $category["id"] . '\"><b>' . $category["name"] . "</b></a>
                                            <br>
                                            <small>" . substr(str_replace("<br />", " ", $category["post"]), 0, 75) . "</small>
                                        
                                        </td>";
                                        echo '<td class="text-center" style="font-size:20px; line-height: 15px; vertical-align: middle;">' . posts($con, $category["id"]) . '</td>';
                                        echo '<td class="text-center" style="font-size:20px; line-height: 15px; vertical-align: middle;">
                                            <img src="http://cravatar.eu/helmavatar/' . $category["author"] . '/16"><span style="margin-left: 5px; font-size: 14px;">' . $category["author"] . '</span></td>';
                                        
                                        if($category['sticky']) {
                                            echo '<td class="text-right" style="font-size: 15px; line-height: 15px; padding-left: 3px; vertical-align: middle;">
                                        
                                            <div class="label" style="background-color: #F15725; width: 100%;">Sticky</div>
                                        
                                        </td>';
                                        } else {
                                            echo '<td class="text-right" style="font-size: 15px; line-height: 15px; vertical-align: middle;">
                                        
                                            <div class="label label-default" style="width: 100%;">None</div>
                                        
                                        </td>';
                                        }
                                        
                                        if($category['important']) {
                                            echo '<td class="text-right" style="font-size: 15px; line-height: 15px; vertical-align: middle; padding-right: 12px;">
                                        
                                            <div class="label" style="background-color: #F15725; width: 100%;">Important</div>
                                        
                                        </td>';
                                        } else {
                                            echo '<td class="text-right" style="font-size: 15px; line-height: 15px; vertical-align: middle; padding-right: 23px;">
                                        
                                            <div class="label label-default" style="width: 100%;">None</div>
                                        
                                        </td>';
                                        }
                                        
                                        if($log && isStaff($con)) {
                                            
                                            echo '<td class="text-right" style="padding-right: 15px;">
                                            
                                                <a href="trash.php?thread=' . $category["id"] . '"><span class="glyphicon glyphicon-trash" style="font-size: 18px; line-height: 34.5px; vertical-align: middle;" alt="Delete"></span></a>
                                                <a href="edit.php?thread=' . $category["id"] . '"><span class="glyphicon glyphicon-pencil" style="font-size: 18px; line-height: 34.5px; vertical-align: middle;" alt="Edit"></span></a>
                                            
                                            </td>';
                                            
                                        } else if ($log && isOwner(SessionUtil::getUsername(), $category["author"])) {
                                            
                                            echo '<td class="text-right" style="padding-right: 15px;">
                                            
                                                <a href="trash.php?thread=' . $category["id"] . '"><span class="glyphicon glyphicon-trash" style="font-size: 18px; line-height: 34.5px; vertical-align: middle;" alt="Delete"></span></a>
                                                <a href="edit.php?thread=' . $category["id"] . '"><span class="glyphicon glyphicon-pencil" style="font-size: 18px; line-height: 34.5px; vertical-align: middle;" alt="Edit"></span></a>
                                            
                                            </td>';
                                            
                                        } else {
                                            
                                            echo '<td class="text-right" style="padding-right: 15px;">-</td>';
                                            
                                        }
                                        
                                    echo '</tr>';
                                }
                                
                                if($sofar == $start + 10) {
                                    break;
                                }
                                
                            }
                        
                        ?>
                    
                    </tbody>
                
                </table><hr>
                
            
                
                <?php
                
                    if(sizeof($thrs) > 0) {
                        
                        ?>
                        
                            <p style="text-align: center;"><span style="width: 50%;"><strong>Boom! </strong>A total of <?php echo sizeof($thrs) . ' '; if(sizeof($thrs) == 1) {
                                echo 'thread was';
                            } else {
                                echo 'threads were';
                            }
                            ?> loaded.</span></p>
                        
                        <?php
                        
                    } else {
                        
                        ?>
                        
                            <p style="text-align: center;"><span style="width: 50%;"><strong>Well, this is awkward. </strong>A total of <?php echo sizeof($thrs) . ' '; if(sizeof($thrs) == 1) {
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