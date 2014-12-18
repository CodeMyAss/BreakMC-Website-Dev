<?php
    
    $con = new MongoClient("localhost:27017", array("username" => "superuser", "password" => "aiwo1298gh387bvdas(!(*@#(788f7a"));
        
    //$servers = $con->selectCollection("beam_servers", "servers");
    
    /** Retrieves the server data for the server "Hub" **/
    /*$document = $servers->findOne(array('name' => 'Hub'));
    
    echo "Players online on server " . $document['name'] . "[" . $document['visibility'] . "]" . ": \n";
    
    foreach($document['online_players'] as $p) {
        echo $p . ", ";
    }*/
    
?>