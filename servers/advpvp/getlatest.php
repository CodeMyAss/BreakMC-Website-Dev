<html>
    <head>
    
        <script>
        
            $(document).ready(function(){
            
                $("[rel='tooltip']").tooltip();
                
            });
        
        </script>
    
    </head>
</html>
<?php

    include("../../inc/sql.php");
    include("../../inc/util.php");
    
                   // AdvancedPvP
                    $data = MongoUtil::findOne($con, "beam_servers", "servers", "name", "AdvancedPvP", "online_players");
    
    if(isset($_REQUEST['amount'])) {
        
        echo sizeof($data);
        
        die();
    }
                    
                    foreach($data as $p) {
                        
                        echo '<img rel="tooltip" data-original-title="' . $p . '" src="http://cravatar.eu/head/' . $p . '/45.png">';
                        
                    }
                    
?>