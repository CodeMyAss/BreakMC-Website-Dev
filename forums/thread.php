<?php

    include("../inc/util.php");
    include("../inc/sql.php");
    
    $cat = null;
    if(!isset($_REQUEST['cat']) || intval($_REQUEST['cat']) === null) {
        
        echo '<script>window.location = "/forums/index.php";</script>';
        die();
        
    }
    $cat = intval($_REQUEST['cat']);
    
    $thread = null;
    if(!isset($_REQUEST['thread']) || intval($_REQUEST['thread']) === null) {
        
        echo '<script>window.location = "/forums/' . $_REQUEST['cat'] . '";</script>';
        die();
        
    }
    $thread = intval($_REQUEST['thread']);
    
    /*$posts_per_page = 10;
    
    $post_mongo = null;
    if(isset($_REQUEST['post']) && intval($_REQUEST['post']) !== null) {
        
        $post_mongo = MongoUtil::findOne2($con, "beam_forums", "posts", "id", intval($_REQUEST['post']));
        $post_all   = MongoUtil::find($con, "beam_forums", "posts", "parent", intval($thread));
        $posts_all = iterator_to_array($post_all);
        
        $post_count = 0;
        
        foreach($post_all as $post_) {
            
            $post_count++;      
            
            if($post_["id"] == $post_mongo["id"]) {
                
                break;
                
            }
            
        }
        
        $val = ceil($post_count / $posts_per_page);
        
        
        
    }*/
    
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

    $cat = MongoUtil::findOne2($con, "beam_forums", "categories", "id", $cat);
    
    if($cat === null) {
        echo '<script>window.location = "/forums/index.php";</script>';
        die();
    }
    
    if($cat["staff"] === false || $cat["staff"] === "false") {
        
        echo '<script>window.location = "/forums/1";</script>';
        die();
        
    }
    
    $thread = MongoUtil::findOne2($con, "beam_forums", "threads", "id", $thread);
    
    if($thread === null) {
        echo '<script>window.location = "/forums/' . $cat . '";</script>';
        die();
    }
    
    
    
    $posts = MongoUtil::find($con, "beam_forums", "posts", "parent", intval($thread["id"]));
    $posts->sort(array("created" => 1));
    $psts = iterator_to_array($posts);
    
    $posts_ = sizeof($psts);
    $MAX_THREADS = 10;
    
    $lists = ($posts_/$MAX_THREADS);
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
    
    if(isset($_REQUEST['post']) && intval($_REQUEST['post']) !== null) {
        
        $post2 = intval($_REQUEST['post']);
        $exists = MongoUtil::findOne2($con, "beam_forums", "posts", "id", $post2);
        
        if($exists == null) {
        
            echo '<script>window.location = "/forums/index.php";</script>';
            die();
            
        } else {
            
            $thread2 = MongoUtil::findOne($con, "beam_forums", "posts", "id", $post2, "parent");
            
            if($thread2 === null) {
        
                echo '<script>window.location = "/forums/index.php";</script>';
                die();
            
            }
            
            $category2 = MongoUtil::findOne($con, "beam_forums", "threads", "id", $thread2, "parent");
            
            if($category2 === null) {
        
                echo '<script>window.location = "/forums/index.php";</script>';
                die();
            
            }
            
            if($thread["id"] === $thread2) {
                
                $sofar1 = 0;
                $page_   = 1;
                foreach($posts as $pst) {
                    
                    $sofar += 1;
                    
                    if($pst["id"] === $post2) {
                        
                        echo '<script>window.location = "/forums/' . $category2 . '/t/' . $thread2 . '/' . $page_ . '/#' . $pst["id"] . '";</script>';
                        die();
                    }
                    
                    if($sofar === 10) {
                        $page_ += 1;
                    }
                    
                }
                
            }
            
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
                
                var x = window.location.hash;
                $(x).css("border", "1px solid #d9534f");
                
            });
            
        </script>
        
        <!-- /Extra Scripts -->
        
    </head>

    <body>
    
        <div id="top">
        </div>
    
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
        
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create a Post</h4>
                  </div>
                  <div class="modal-body" style="font-size: 16px; padding-bottom: 3px;">
                    
                    <form action="/forums/create.php?post3=<?php echo $thread['id']; ?>" method="post">
                    
                        <div class="form-body">
                    
                            <textarea name="post" class="form-control" style="width: 100%; height: 25%; max-width: 558px;" maxlength="1000" placeholder="Enter the contents of your post:" autocomplete="off"></textarea>
                            
                           
                        <br><br>
                            You will be able to view the post <a style="cursor: pointer;" data-dismiss="modal">behind</a> this modal once created.
                            
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
                        
                                <ul class="pagination" style="margin-top: 15px;">
                                  <li class="disabled"><a href="#"><</a></li>
                                  <li class="active"><a href="#">1</a></li>
                                  <?php
                                  
                                    for($count = 2; $count <= $lists; $count++) {
                                        
                                        echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/t/' . $thread["id"] . '/' . $count . '">' . $count . '</a></li>';
                                        
                                        if($count == 5) {
                                            break;
                                        }
                                        
                                    }
                                  
                                  ?>
                                  <li <?php if($list == $lists) { echo 'class="disabled"'; } ?>><a href="/forums/<?php echo $_REQUEST['cat']; ?>/t/<?php echo $thread["id"]; ?>/<?php echo $lists; ?>">></a></li>
                                </ul>
                                
                            <?php
                        
                    } else if($list == 2) {
                        
                        ?>
                        
                                <ul class="pagination" style="margin-top: 15px;">
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/t/<?php echo $thread["id"]; ?>/1"><</a></li>
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/t/<?php echo $thread["id"]; ?>/1">1</a></li>
                                  <li class="active"><a href="#">2</a></li>
                                  <?php
                                  
                                    for($count = 3; $count <= $lists; $count++) {
                                        
                                        echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/t/' . $thread["id"] . '/' . $count . '">' . $count . '</a></li>';
                                        
                                        if($count == 5) {
                                            break;
                                        }
                                        
                                    }
                                  
                                  ?>
                                  <li <?php if($list == $lists) { echo 'class="disabled"'; } ?>><a href="/forums/<?php echo $_REQUEST['cat']; ?>/t/<?php echo $thread["id"]; ?>/<?php echo $lists; ?>">></a></li>
                                </ul>
                                
                            <?php
                        
                        } else if ($list == $lists-1) {
                            
                            ?>
                            
                                <ul class="pagination" style="text-center">
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/t/<?php echo $_REQUEST['cat']; ?>/1"><</a></li>
                                  <?php
                                  
                                    for($count = $lists-5; $count <= $lists-2; $count++) {
                                        
                                        echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/t/' . $thread['id'] . '/' . $count . '">' . $count . '</a></li>';
                                        
                                    }
                                  
                                  ?>
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/t/<?php echo $thread["id"]; ?>/<?php echo $lists-2; ?>"><?php echo $lists-2; ?></a></li>
                                  <li class="active"><a href="#"><?php echo $lists-1; ?></a></li>
                                  <li class="disabled"><a href="#">></a></li>
                                </ul>
                            
                            <?php
                            
                        } else if ($list == $lists-2) {
                            
                            ?>
                            
                                <ul class="pagination" style="text-center">
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/t/<?php echo $_REQUEST['cat']; ?>/1"><</a></li>
                                  <?php
                                  
                                    for($count = $lists-5; $count <= $lists-2; $count++) {
                                        
                                        echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/t/' . $thread['id'] . '/' . $count . '">' . $count . '</a></li>';
                                        
                                    }
                                  
                                  ?>
                                  <li class="active"><a href="#"><?php echo $lists-2; ?></a></li>
                                  <li><a href="/forums/<?php echo $_REQUEST['cat']; ?>/t/<?php echo $thread["id"]; ?>/<?php echo $lists-1; ?>"><?php echo $lists-1; ?></a></li>
                                  <li <?php if($list == $lists) { echo 'class="disabled"'; } ?>><a href="/forums/<?php echo $_REQUEST['cat']; ?>/t/<?php echo $thread["id"]; ?>/<?php echo $lists; ?>">></a></li>
                                </ul>
                            
                            <?php
                            
                        } else {
                            
                            echo '<ul class="pagination">';
                                
                                $before1 = $list - 2;
                                $before2 = $list - 1;
                                $after1  = $list + 1;
                                $after2  = $list + 2;
                                
                                $c_init = 0;
                                
                                echo '<li><a href="/forums/' . $_REQUEST['cat'] . '/t/' . $thread["id"] . '/1"><</a></li>';
                                
                                    echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/t/' . $thread["id"] . '/' . $before1 . '">' . $before1 . '</a></li>';
                                    echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/t/' . $thread["id"] . '/' . $before2 . '">' . $before2 . '</a></li>';
                                    echo '<li class="active"><a href="#">' . $list . '</a></li>';
                                    
                                    if($after1 <= $lists) {
                                        echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/t/' . $thread["id"] . '/' . $after1 . '">' . $after1 . '</a></li>';
                                    }
                                    
                                    if($after2 <= $lists) {
                                        echo '<li><a href="/forums/' . $_REQUEST['cat']  . '/t/' . $thread["id"] . '/' . $after2 . '">' . $after2 . '</a></li>';
                                    }
                                
                                ?>
                                    <li <?php if($list == $lists) { echo 'class="disabled"'; } ?>><a href="/forums/<?php echo $_REQUEST['cat']; ?>/t/<?php echo $thread["id"]; ?>/<?php echo $lists; ?>">></a></li>
                                <?php
                                
                            echo '</ul>';
                            
                        }
                
                ?>
                    
                <?php
                    
                        /*if($list == 1) {
                            
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
                            
                        }*/
                    
                    ?>
                    
                    </div>
                </div>
                
                <ul class="breadcrumb" style="text-align: center;">
                  <li><a href="/forums">Categories</a></li>
                  <li><a href="/forums/<?php echo $cat["id"]; ?>"><?php echo $cat["name"]; ?></a></li>
                  <li class="active"><?php echo $thread["name"]; ?></li>
                </ul>
                        
                <?php
                        date_default_timezone_set("America/Denver");
                
                    if($log) {
                        
                        ?>
                        
                            <a href="#" class="btn btn-success" style="width: 100%;"
                                data-toggle="modal"
                                data-target="#myModal">Create a Post</a>
                        
                        
                        
                        <?php
                        
                    }
                
                ?>
                        
                        
                        <hr>
                
                <?php
                
                    if($start === 0) {
                        
                        ?>
                        
                            <!-- First Post -->
                            <div class="panel panel-default">
                            
                                <div class="panel-heading">
            
                                    <div class="row">
                                    
                                        <div class="col-md-4">
                                            <img style="border-radius: 6px; 20px; margin-right: 5px; display: block;" src="http://cravatar.eu/helmavatar/<?php echo $thread["author"]; ?>/32.png">
                                            <div style="font-size: 18px; display: block; margin-top: -27px; margin-left: 39px;"><?php echo $thread["author"]; ?></div>
                                        </div>
                                    
                                        <div class="col-md-4">
                                            <div style="text-align: center; font-size: 18px; display: block;"><?php echo $thread["name"]; ?> </div>
                                        </div>
                                    
                                        <div class="col-md-4">
                                            <div style="text-align: right; font-size: 18px; display: block;"><?php echo date('m/d/Y G:i', $thread["created"]); ?></div>
                                        </div>
                                    
                                    </div>
                                </div>
                                
                                <div class="panel-body">  
                                    <div style="margin-bottom: 25px;">
                                        
                                        <?php
                                        
                                            if($log && (isStaff($con) || isOwner(SessionUtil::getUsername(), $thread["owner"]))) {
                                                
                                                ?>
                                                
                                                    <a href="/forums/edit.php?thread=<?php echo $thread["id"]; ?>"><div style="margin-left: 5px; float: right; display: block;" class="glyphicon glyphicon-pencil"></div></a>
                                                
                                                <?php
                                                
                                            }
                                        
                                        ?>
                                        
                                        <a href="/forums/<?php echo $cat["id"]; ?>/t/<?php echo $thread["id"]; ?>/1"><div style="margin-left: 5px; float: right; display: block;" class="glyphicon glyphicon-paperclip"></div></a>
                                                    
                                    </div>
                                </div>
                                
                                    <div style="display: block; margin-top: -35px; margin-left: 40px; margin-right: 40px; margin-bottom: 20px;">
                                    
                                        <?php
                                        
                                            echo $thread["post"];
                                        
                                        ?>
                                    
                                    </div>
                                    
                                </div>
                                <!-- // End of First Post // -->
                        
                        <?php
                        
                    }
                
                ?>
                    
                    <?php
                    
                    
                        $sofar = 0;
                        foreach($posts as $post) {
                            
                            $sofar += 1;
                            
                            if($sofar >= $start+1) {
                                
                                ?>
                                
                                    <div class="panel panel-default" id="<?php echo $post["id"]; ?>">
                                    
                                        <div class="panel-heading">
                                        
                                            <div class="row">
                                            
                                                <div class="col-md-4">
                                                    <img style="border-radius: 6px; 20px; margin-right: 5px; display: block;" src="http://cravatar.eu/helmavatar/<?php echo $post["author"]; ?>/32.png">
                                                    <div style="font-size: 18px; display: block; margin-top: -27px; margin-left: 39px;"><?php echo $post["author"]; ?></div>
                                                </div>
                                            
                                                <div class="col-md-4">
                                                    <div style="text-align: center; font-size: 18px; display: block;"></div>
                                                </div>
                                            
                                                <div class="col-md-4">
                                                    <div style="text-align: right; font-size: 18px; display: block;"><?php echo date('m/d/Y G:i', $post["created"]); ?></div>
                                                </div>
                                            
                                            </div>
                                        
                                        </div>
                    
                                            <div class="panel-body">  
                                                <div style="margin-bottom: 25px;">
                                                
                                                    <?php
                                                    
                                                        if($log && (isStaff($con) || isOwner(SessionUtil::getUsername(), $post["author"]))) {
                                                            
                                                            ?>
                                                            
                                                                <a href="/forums/edit.php?apost=<?php echo $post["id"]; ?>"><div style="margin-left: 5px; float: right; display: block;" class="glyphicon glyphicon-pencil"></div></a>
                                                                <a href="/forums/trash.php?apost=<?php echo $post["id"]; ?>"><div style="margin-left: 5px; float: right; display: block;" class="glyphicon glyphicon-trash"></div></a>
                                                            
                                                            <?php
                                                            
                                                        }
                                                    
                                                    ?>
                                                
                                                    <a href="#<?php echo $post["id"] ?>"><div style="margin-left: 5px; float: right; display: block;" class="glyphicon glyphicon-paperclip"></div></a>
                                                </div>
                                            </div>
                                        
                                            <div style="display: block; margin-top: -35px; margin-left: 40px; margin-right: 40px; margin-bottom: 20px;">
                                                <?php
                                                    echo $post["post"];
                                                ?>
                                            </div>
                                        </div>
                                
                                <?php
                                
                            }
                            
                            if($sofar == $start + 10) {
                                break;
                            }
                            
                        }
                    
                    ?>
                
                </div>
                
                <hr>
                
                <?php
                
                    if(sizeof($psts)+1 > 0) {
                        
                        ?>
                        
                            <p style="text-align: center;"><span style="width: 50%;"><strong>Boom! </strong>A total of <?php echo sizeof($psts)+1 . ' '; if(sizeof($psts)+1 == 1) {
                                echo 'post was';
                            } else {
                                echo 'posts were';
                            }
                            ?> loaded.</span></p>
                        
                        <?php
                        
                    } else {
                        
                        ?>
                        
                            <p style="text-align: center;"><span style="width: 50%;"><strong>Well, this is awkward. </strong>A total of <?php echo sizeof($psts) . ' '; if(sizeof($psts) == 1) {
                                echo 'post was';
                            } else {
                                echo 'posts were';
                            }
                            ?> loaded.</span></p>
                        
                        <?php
                        
                    }
                
                ?>
            
            </div>
    
    </body>

</html>