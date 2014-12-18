<?php

    include("../inc/sql.php");
    include("../inc/util.php");
    
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
    
    if(!$log) {
        
                echo '<script>
                    window.history.back();
                </script>';
                die();
        die();
        
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
                    window.history.back();
                </script>';
                die();
            
            }
            
            $c = $con->selectCollection("beam_forums", "categories");
            $c->remove(array("id" => $cat));
            
            $c = $con->selectCollection("beam_forums", "threads");
            $c2 = $con->selectCollection("beam_forums", "posts");
            
                $threads = MongoUtil::find($con, "beam_forums", "threads", "parent", intval($_REQUEST['cat']));
                $thrs = iterator_to_array($threads);
                
                foreach($thrs as $thread) {
                    
                    $c2->remove(array("parent" => $thread["id"]));
                    
                }
                
            $c->remove(array("parent" => $cat));
            
                echo '<script>
                    window.history.back();
                </script>';
                die();
            
        } else if(isset($_REQUEST['thread'])) {
            
            $cat = intval($_REQUEST['thread']);
            
            if($cat === null) {
                
                echo '<script>
                    window.history.back();
                </script>';
                die();
            
            }
            
            $c = $con->selectCollection("beam_forums", "threads");
            $c2 = $con->selectCollection("beam_forums", "posts");

            $thread2 = MongoUtil::findOne($con, "beam_forums", "threads", "id", $cat, "parent");
            
                $threads = MongoUtil::find($con, "beam_forums", "threads", "parent", intval($_REQUEST['thread']));
                $thrs = iterator_to_array($threads);
                
                foreach($thrs as $thread) {
                    
                    $c2->remove(array("parent" => $thread["id"]));
                    
                }
                
            $c->remove(array("id" => $cat));
            
                echo '<script>
                    window.history.back();
                </script>';
                die();
            die();
            
        } else if (isset($_REQUEST['apost'])) {
        
            $post = intval($_REQUEST['apost']);
            
            if($post === null) {
                
                echo '<script>
                    window.history.back();
                </script>';
                die();
            
            }
            
            $c2 = $con->selectCollection("beam_forums", "posts");
            $c2->remove(array("id" => $post));
                
                echo '<script>
                    window.history.back();
                </script>';
                die();
        
        } else {
            
                echo '<script>
                    window.history.back();
                </script>';
                die();
            
        }
        
?>