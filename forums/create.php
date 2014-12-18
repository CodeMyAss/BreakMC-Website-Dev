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
    
    function get_id($con) {
        
        // Grab all categories
        $banter = MongoUtil::find2($con, "beam_forums", "categories");
        $cats = iterator_to_array($banter);
                    
        $first = 0;
        foreach($cats as $cat) {
            if($cat["id"] > $first) {
                $first = $cat["id"];
            }
        }
        
        return ($first+1);
        
    }
    
    function get_thread_id($con) {
        
        // Grab all categories
        $banter = MongoUtil::find2($con, "beam_forums", "threads");
        $cats = iterator_to_array($banter);
                    
        $first = 0;
        foreach($cats as $cat) {
            if($cat["id"] > $first) {
                $first = $cat["id"];
            }
        }
        
        return ($first+1);
        
    }
    
    function get_post_id($con) {
        
        // Grab all categories
        $banter = MongoUtil::find2($con, "beam_forums", "posts");
        $cats = iterator_to_array($banter);
                    
        $first = 0;
        foreach($cats as $cat) {
            if($cat["id"] > $first) {
                $first = $cat["id"];
            }
        }
        
        return ($first+1);
        
    }
    
    if(!$log) {
        
        echo '<script>
            window.location = "index.php";
        </script>';
        die();
        
    }
    
    if(isset($_REQUEST['post3'])) {
        
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $parent = intval($_REQUEST['post3']);
            $thread    = MongoUtil::findOne2($con, "beam_forums", "threads", "id", $parent);
            
            if($thread === null) {
            
                echo '<script>
                    window.location = "/forums";
                </script>';
                die();
            
            }
            
            $cat = MongoUtil::findOne($con, "beam_forums", "threads", "id", $thread["id"], "parent");
            
            if($cat === null) {
            
                echo '<script>
                    window.location = "/forums";
                </script>';
                die();
            
            }
            
            $post = $_POST['post'];
            $update = time();
            
            $send = array(
                
                "parent"      => $parent,
                "id"          => get_post_id($con),
                "post"        => nl2br(stripslashes(str_replace($finds, $replaces, htmlspecialchars($post)))),
                "author"      => SessionUtil::getUsername(),
                "created"     => $update
                
                );
                
            $c = $con->selectCollection("beam_forums", "posts");
            $c->insert($send);
            
            $c = $con->selectCollection("beam_forums", "threads");
            $c->update(array("id" => $parent), array('$set' => array('last_update' => $update)));
            
            echo '3<script>
                window.location = "/forums/' . $cat . '/t/' . $parent . '";
            </script>';
            die();
            
        }
        
    }
    
    if(isset($_REQUEST['thread'])) {
        
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $parent = intval($_REQUEST['thread']);
            
            $name = stripslashes(htmlspecialchars($_POST['name']));
            $post = $_POST['post'];
            $stik = $_POST['sticky'];
            $impo = $_POST['important'];
            
            if(!$stik || $stik === null) {
                $stik = false;
            } else {
                $stik = true;
            }
            
            if(!$impo || $impo === null) {
                $impo = false;
            } else {
                $impo = true;
            }
            
            
            $send = array(
                
                "parent" => $parent,
                "id" => get_thread_id($con),
                "name" => $name,
                "post" => nl2br(stripslashes(str_replace($finds, $replaces, htmlspecialchars($post)))),
                "sticky" => $stik,
                "important" => $impo,
                "author" => SessionUtil::getUsername(),
                "last_update" => time(),
                "created" => time()
                
                );
                
            $c = $con->selectCollection("beam_forums", "threads");
            $c->insert($send);
            
            echo '<script>
                window.location = "/forums/' . $parent . '";
            </script>';
            die();
            
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
    
    if(isset($_REQUEST['category'])) {
        
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $name = stripslashes(htmlspecialchars($_POST['name']));
            $desc = $_POST['desc'];
            $view = $_POST['view'];
            
            if($view == "Everyone") {
                $view = true;
            } else {
                $view = false;
            }

            $send = array(
                
                "id" => get_id($con),
                "name" => $name,
                "desc" => $desc,
                "staff" => $view
                
                );
                
            $c = $con->selectCollection("beam_forums", "categories");
            $c->insert($send);
            
            echo '<script>
                window.location = "index.php";
            </script>';
            die();
            
        } else {
            
            echo '<script>
                window.location = "index.php";
            </script>';
            die();
            
        }
        
    } 

?>