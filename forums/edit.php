<?php

    include("../inc/sql.php");
    include("../inc/util.php");
    
    $finds = array(
        
        "[b]",
        "[u]",
        "[s]",
        
        "[/b]",
        "[/u]",
        "[/s]"
        
        );
        
    $replaces = array(
        
        "<strong>",
        "<u>",
        "<strike>",
        
        "</strong>",
        "</u>",
        "</strike>"
        
        );
    
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
    
    if(!$log) {
        
        echo '<script>
            window.location = "index.php";
        </script>';
        die();
        
    }
    
        if(isset($_REQUEST['thread'])) {
        
            $cat = intval($_REQUEST['thread']);
            
            if($cat === null) {
                
                echo '<script>
                    window.location = "index.php";
                </script>';
                die();
            
            }
            
            
            
            $categories = MongoUtil::find($con, "beam_forums", "threads", "id", $cat);
            $cats = iterator_to_array($categories);
            $thread = null;
            
            foreach($cats as $c) {
                $thread = $c;
                break;
            }
            
            if($thread === null) {
                
                echo '<script>
                    window.location = "index.php";
                </script>';
                die();
            
            }
            
            if(!isStaff($con) && !isOwner(SessionUtil::getUsername(), $thread["author"])) {
                 
                echo '<script>
                    window.location = "index.php";
                </script>';
                die();
                
            }
            
                        if($_SERVER['REQUEST_METHOD'] == "POST") {
                    
                    $name = $_POST['name'];
                    $post = $_POST['post'];
                    
                    $sticky = false;
                    $important = false;
                    
                    if(isStaff($con)) {
                        
                        if(isset($_POST['sticky'])) {
                            
                            if($_POST['sticky']) {
                                $sticky = true;
                            }
                            
                        }
                        
                        if(isset($_POST['important'])) {
                            
                            if($_POST['important']) {
                                $important = true;
                            }
                            
                        }
                        
                    }  
                    
                    $toPush = array();
                    
                    if($name === null || $name == "") {
                        $name = $thread["name"];
                    }
                    
                    if($post === null || $post == "") {
                        $post = $thread["post"];
                    }
                    
                    $toPush = array(
                        
                        "name" => stripslashes(htmlspecialchars($name)),
                        "post" => nl2br(stripslashes(str_replace($finds, $replaces, htmlspecialchars($post)))),
                        "sticky" => $sticky,
                        "important" => $important
                        
                        );
                        
                    $c = $con->selectCollection("beam_forums", "threads");
                    $c->update(array("id" => $cat), array('$set' => $toPush));
                
                    echo '<script>
                        window.location = "/forums/' . $thread['parent'] . '";
                    </script>';
                    die();
                    
                }
                
        } else if (isset($_REQUEST['apost'])) {
            
            $post34 = intval($_REQUEST['apost']);
            
            if($post34 === null) {
                
                echo '<script>
                    window.location = "index.php";
                </script>';
                die();
            
            }
            
            $post = MongoUtil::findOne2($con, "beam_forums", "posts", "id", $post34);
            
            if($post === null) {
                
                echo '<script>
                    window.location = "index.php";
                </script>';
                die();
            
            }
            
            $category344 = MongoUtil::findOne($con, "beam_forums", "threads", "id", $post["parent"], "parent");
            
            if(isStaff($con) || isOwner(SessionUtil::getUsername(), $post["author"])) {
                     
                if($_SERVER['REQUEST_METHOD'] == "POST") {
                    
                    $post2 = $_POST['post'];
                        
                    $toPush = array();
                        
                    if($post2 === null || $post2 == "") {
                        $post2 = $post["name"];
                    }
                        
                    $toPush = array(
                            
                        "post" => nl2br(stripslashes(str_replace($finds, $replaces, htmlspecialchars($post2)))),
                            
                            );
                            
                        $c = $con->selectCollection("beam_forums", "posts");
                        $c->update(array("id" => $post["id"]), array('$set' => $toPush));
                    
                        echo '<script>
                            window.location = "/forums/' . $category344 . '/t/' . $post["parent"] . '/p/' . $post["id"] . '";
                        </script>';
                        die();
                            
                }
                
            } else {
                
                echo '<script>
                    window.location = "index.php";
                </script>';
                die();
                
            }
            
        }
    
    if(!isStaff($con)) {
        
        echo '<script>
            window.location = "index.php";
        </script>';
        die();
        
    }
    
        if(isset($_REQUEST['cat'])) {
        
            $cat = intval($_REQUEST['cat']);
            
            if($cat === null) {
                
                echo '<script>
                    window.location = "index.php";
                </script>';
                die();
            
            }
            
            $categories = MongoUtil::find($con, "beam_forums", "categories", "id", $cat);
            $cats = iterator_to_array($categories);
            $category = null;
            
            foreach($cats as $c) {
                $category = $c;
                break;
            }
            
            if($category === null) {
                
                echo '<script>
                    window.location = "index.php";
                </script>';
                die();
            
            }
            
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                    
                    $name = $_POST['name'];
                    $desc = $_POST['desc'];
                    $view = $_POST['view'];
                    
                    if($view == "Everyone") {
                        $view = true;
                    } else {
                        $view = false;
                    }
                    
                    $toPush = array();
                    
                    if($name === null || $name == "") {
                        $name = $category["name"];
                    }
                    
                    if($desc === null || $desc == "") {
                        $desc = $category["desc"];
                    }
                    
                    if($view === null || $view == "") {
                       $view = $category["staff"];
                    }
                    
                    $toPush = array(
                        
                        "name" => stripslashes(htmlspecialchars($name)),
                        "desc" => stripslashes(htmlspecialchars($desc)),
                        "staff" => $view
                        
                        );
                        
                    $c = $con->selectCollection("beam_forums", "categories");
                    $c->update(array("id" => $cat), array('$set' => $toPush));
                
                echo '<script>
                    window.location = "index.php";
                </script>';
                die();
                    
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
        
            <div class="container" style="margin-top: 70px;">
    
                    <?php
                    
                        if(isset($_REQUEST['cat'])) {
                            ?>
                            
                                <div class="page-header info-1" style="margin-top: 0px; display: none;">
                    
                                   <h1>Edit 
                                      <small><?php echo $category["name"]; ?></small>
                                   </h1>
                        
                                </div>                  
                                
                                <form action="<?php echo stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])); ?>?cat=<?php echo $category["id"]; ?>" method="POST">
                                    
                                    <div class="form-body">
                                    
                                        <label style="display: none; font-weight: bold; margin-left: 2px;" maxlength="50" class="info-2">Change the name: </label>
                                        <input type="text" class="form-control info-2" style="display: none; width: 100%;" name="name" placeholder="<?php echo $category["name"]; ?>" autocomplete="off"><br>
                                    
                                        <label style="display: none; font-weight: bold; margin-left: 2px;" class="info-3">Change the description: </label>
                                        <input type="text" class="form-control info-3" style="display: none; width: 100%;" name="desc" placeholder="<?php echo $category["desc"]; ?>" autocomplete="off"><br>
                                        
                                        <label style="display: none; font-weight: bold; margin-left: 2px;" class="info-4">Choose who sees the category: </label>
                                        <div class="info-4" style="display: none;"><select class="form-control" name="view" style="width: 50%; display: inline-block;">
                                        
                                            <?php
                                            
                                                if($category["staff"] == "true") {
                                                    ?>
                                                    
                                                    <option>Only Admins</option>
                                                    <option>Everyone</option>
                                                    
                                                    <?php
                                                } else {
                                                    ?>
                                                    
                                                    <option>Everyone</option>
                                                    <option>Only Admins</option>
                                                    
                                                    <?php
                                                }
                                            
                                            ?>
                                        
                                        </select><label style="display: inline-block; margin-left: 8px;">can see this.</label></div><br>                   
                                    
                                        <button type="submit" class="form-control info-5 btn btn-primary" style="display: none; width: 100%;">Edit Category</button><br>
                                    
                                    </div>
                                    
                                </form>
                            
                            <?php
                        } else if (isset($_REQUEST['thread'])) {
                            
                            ?>
                            
                                <div class="page-header info-1" style="margin-top: 0px; display: none;">
                    
                                   <h1>Edit 
                                      <small><?php echo $thread["name"]; ?></small>
                                   </h1>
                        
                                </div>                  
                                
                                <form action="<?php echo stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])); ?>?thread=<?php echo $thread["id"]; ?>" method="POST">
                                    
                                    <div class="form-body">
                                    
                                        <label style="display: none; font-weight: bold; margin-left: 2px;" maxlength="50" class="info-2">Change the name: </label>
                                        <input type="text" class="form-control info-2" style="display: none; width: 100%;" name="name" placeholder="<?php echo $thread["name"]; ?>" autocomplete="off"><br>
                                    
                                        <label style="display: none; font-weight: bold; margin-left: 2px;" class="info-3">Change the post contents: </label>
                                        <?php
                                        
                                            $bants = str_replace("<br />", "", str_replace($replaces, $finds, $thread["post"]));
                                            $bants1 = str_replace($replaces, $finds, $thread["post"]);
                                            
                                            $max   = 650;
                                            $size  = 50 * sizeof(explode("<br />", $bants1));
                                            
                                            if($size > $max) {
                                                $size = $max;
                                            }
                                            
                                        ?>
                                        <textarea name="post" class="form-control info-3" style="display: none; width: 100%; height: <?php echo $size ?>px;" maxlength="1000" autocomplete="off" placeholder='<?php echo $bants ?>'><?php echo htmlspecialchars($bants); ?></textarea><br>
                                        
                                        <label style="display: none; font-weight: bold; margin-left: 2px;" class="info-4">Choose who sees the category: </label>
                                            
                                        <?php
                                             
                                            if(isStaff($con)) {
                                                
                                                ?>
                                                
                                                    <div class="info-4" style="display: none;">
                                            
                                                        <input type="checkbox" name="sticky" style="margin-right: 7px;" <?php if($thread['sticky']) { echo 'checked'; } ?>>Sticky<br>
                                                        <input type="checkbox" name="important" style="margin-right: 7px;" <?php if($thread['important']) { echo 'checked'; } ?>>Important
                                                        
                                                    </div><br>
                                                
                                                <?php
                                                
                                            }
                                             
                                        ?>
                                    
                                        <button type="submit" class="form-control info-5 btn btn-primary" style="display: none; width: 100%;">Edit Thread</button><br>
                                    
                                    </div>
                                    
                                </form>
                                
                            <?php
                            
                        } else if (isset($_REQUEST['apost'])) {
                            
                            ?>
                            
                                <div class="page-header info-1" style="margin-top: 0px; display: none;">
                    
                                   <h1>Edit 
                                      <small><?php echo $post["name"]; ?></small>
                                   </h1>
                        
                                </div>
                                
                            <form action="<?php echo stripslashes(htmlspecialchars($_SERVER['PHP_SELF'])); ?>?apost=<?php echo $post["id"]; ?>" method="POST">
                                <div class="form-body">
                                    <label style="display: none; font-weight: bold; margin-left: 2px;" maxlength="50" class="info-2">Change the post contents: </label>
                                    

                                        <?php
                                        
                                            $bants = str_replace("<br />", "", str_replace($replaces, $finds, $post["post"]));
                                            $bants1 = str_replace($replaces, $finds, $post["post"]);
                                            
                                            $max   = 650;
                                            $size  = 50 * sizeof(explode("<br />", $bants1));
                                            
                                            if($size > $max) {
                                                $size = $max;
                                            }
                                            
                                        ?>
                                        <textarea name="post" class="form-control info-3" style="display: none; width: 100%; height: <?php echo $size ?>px;" maxlength="1000" autocomplete="off" placeholder="<?php echo htmlspecialchars($bants); ?>"><?php echo htmlspecialchars($bants); ?></textarea><br>
                                        
                                <div>
                            </form>
                            
                                        <button type="submit" class="form-control info-5 btn btn-primary" style="display: none; width: 100%;">Edit Post</button><br>
                                        
                            <?php
                            
                        }
                    
                    ?>
                
                </div>
        
        </body>
        </html>
        