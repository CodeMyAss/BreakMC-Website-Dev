<?php

    include("../inc/util.php");
    
    SessionUtil::delAccount();

?>
<!DOCTYPE html>
<html>

    <head>
    
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        
        <title>Hold on.</title>
    
        <script>
        
            $(document).ready(function() {
                
                window.history.back();
                
            });
        
        </script>
    
    </head>
    
    <body>
        You're being redirected...
    </body>

</html>