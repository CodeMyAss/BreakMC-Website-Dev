<?php
    
    include("../inc/sql.php");
    include("../inc/util.php");
    
    function get_id($con) {
        
        // Grab all categories
        $banter = MongoUtil::find2($con, "beam_forums", "categories");
        $cats = iterator_to_array($banter);
                    
        $first = 0;
        foreach($cats as $cat) {
            if($cat["id"] > $first) {
                $first = $cat["id"];
                echo $first;
            }
        }
        
        return ($first+1);
        
    }
    
    function get_list($con) {
        
        // Grab all categories
        $banter = MongoUtil::find2($con, "beam_forums", "categories");
        $cats = iterator_to_array($banter);
                    
        $first = 0;
        $previous = 0;
        foreach($cats as $cat) {
            
            if(($previous + 1) != $cat["list"] && $previous > 0) {
                $first = $cat["list"]-2;
                break;
            }
            
            if($cat["list"] > $first) {
                $first = $cat["list"];
            }
            
            $previous = $cat["list"];
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
            
            if(isset($_REQUEST['n']) && isset($_REQUEST['d']) && isset($_REQUEST['s'])) {
                
                $name = $_REQUEST['n'];
                $desc = $_REQUEST['d'];
                $staf = $_REQUEST['s'];
                
                if(sizeof($name) < 50 && sizeof($desc) < 100 && (strtolower($staf) == "true" || strtolower($staf) == "false")) {
                    
                    
                    $toPush = array(
                        
                        "id" => get_id($con),
                        "name" => $name,
                        "desc" => $desc,
                        "list" => get_list($con),
                        "staff" => strtolower($staf)
                        
                        );
                    
                    MongoUtil::getCollection($con, "beam_forums", "categories")->insert($toPush);
                    
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