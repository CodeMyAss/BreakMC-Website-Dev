<?php

    include("inc/sql.php");
    include("inc/util.php");
    
        // AdvancedPvP
        $data = MongoUtil::findOne($con, "beam_servers", "servers", "name", "Hub", "online_players");
        $data2 = MongoUtil::findOne($con, "beam_servers", "servers", "name", "AdvancedPvP", "online_players");
        
        $total = sizeof($data) + sizeof($data2);
        echo $total;
    
        die();                    
?>