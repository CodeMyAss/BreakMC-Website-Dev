<?php
    
    include("../inc/sql.php");
    include("../inc/util.php");
    
    function get_id($con) {
        
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
    
    if(SessionUtil::getUsername() !== null) {
            
        $log = SessionUtil::auth($con, SessionUtil::getUsername(), SessionUtil::getPassword());
        
        if(!$log) {
            
            echo '<script>window.location="../forums/index.php";</script>';
            
        }
        
        $rank = MongoUtil::findOne($con, "beam_users", "users", "username_lower", strtolower(SessionUtil::getUsername()), "group");
    
        if(strtolower(SessionUtil::getUsername()) == "generichat" || strtolower(SessionUtil::getUsername()) == "xertol" || 
            strtolower($rank) == "admin" || strtolower($rank) == "developer" || strtolower($rank) == "owner") {
            
            if(isset($_REQUEST['o']) && isset($_REQUEST['n']) && isset($_REQUEST['p']) && isset($_REQUEST['s']) && isset($_REQUEST['i'])) {
                
                $parent = $_REQUEST['o'];
                $name = $_REQUEST['n'];
                $post = $_REQUEST['p'];
                $stik = $_REQUEST['s'];
                $impo = $_REQUEST['i'];
                $auth = SessionUtil::getUsername();
                
                if(sizeof($name) < 50 && sizeof($post) < 1000 && (strtolower($stik) == "true" || strtolower($stik) == "false") && (strtolower($impo) == "true" || strtolower($impo) == "false")) {
                    
                    
                    $toPush = array(
                        
                        "parent" => intval($parent),
                        "id" => get_id($con),
                        "name" => $name,
                        "post" => $post,
                        "sticky" => strtolower($stik),
                        "important" => strtolower($impo),
                        "author" => $auth
                        
                        );
                    
                    MongoUtil::getCollection($con, "beam_forums", "threads")->insert($toPush);
                    
                }
                
            } else {
            
                echo '<script>window.location = "../forums/index.php";</script>';
                die();
                
            }
            
        } else {
            
            echo '<script>window.location = "../forums/index.php";</script>';
            die();
            
        }
            
    } else {
        echo '<script>window.location = "../forums/index.php";</script>';
    }

?>