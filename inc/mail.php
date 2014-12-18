<?php

    class TicketUtil {
        
        static $init = false;
        
        public static function init() {
            
            if(self::$init)
                return;
                
            self::$init = true;
            
        }
        
        public static function filter($string, $returnIfNull = "N/A") {
            
            self::init();
            
            if(!isset($string)) {
                return $returnIfNull;
            }
            
            $string = trim(stripslashes(htmlspecialchars($string)));
            return $string;
            
        }
        
        public static function addTicket($con, $id, $name, $email, $toSend, $ip) {
            
            $name = self::filter($name);
            $toSend  = self::filter($toSend);
            
            $send = array(
                
                "id"   => $id,
                "name" => $name,
                "email" => $email,
                "message" => $toSend,
                "created" => time(),
                "completed" => false,
                "ip"      => $ip
                
                );
                
            $c = $con->selectCollection("beam_forums", "tickets");
            $c->insert($send);
            
        }
    }

?>