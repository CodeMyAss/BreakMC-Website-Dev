<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();        
    }

    // Server Array
    $servers = array(
        
        "AdvPvP", "EliteKits", "Deathban"
        
        
        );
    
    $voting = array(
        
        "Voting 1"
        
        );
        
    $shops = array(
        
        "AdvPvP", "EliteKits"
        
        );

    // We'll add a logged variable here.
    $log = false;
    
    // Define Constants
    define('ADMIN_COLOR', '#FF7575');
	define('MOD_COLOR', '#C450C3');
	define('HELPER_COLOR', '#38BDBD');
	define('DEFAULT_COLOR', '#AAAAAA');
	
	class SessionUtil {
	    
	    static $init = false;
	    
	    public static function init() {
	        
	        if(self::$init)
	            return;
	            
	        self::$init = true;
	        
	        // other operations
	        
	    }
	    
	    public static function storeAccount($username, $password) {
	        
	        $_SESSION['breakmc_user'] = $username;
	        $_SESSION['breakmc_pass'] = $password;
	        
	    }
	    
	    public static function delAccount() {
	        
	        unset($_SESSION['breakmc_user']);
	        unset($_SESSION['breakmc_pass']);
	        
	    }
	    
	    public static function getUsername() {
	        
	        if(!isset($_SESSION['breakmc_user']))
	        	return null;
	        	
	        return $_SESSION['breakmc_user'];
	        
	    }
	    
	    public static function getPassword() {
	        
	        if(!isset($_SESSION['breakmc_pass']))
	        	return null;
	        
	        return $_SESSION['breakmc_pass'];
	        
	    }
	    
	    public static function getHash($pass) {
	        return md5($pass);
	    }
	    
	    public static function auth($con, $user, $pass) {
	       
	       $doc = trim(MongoUtil::findOne($con, "beam_users", "users", "username_lower", strtolower($user), "password"));
	    
	    	if($doc == $pass) {
	    		return true;
	    	} else {
	    		return false;
	    	}
	    	
	    	return false;
	        
	    }
	    
	}
	
	class MongoUtil {
		
		static $init = false;
		
		public static function init() {
			
			if(self::$init)
				return;
				
			self::$init = true;
			
			// Other bullshit
			
		}
		
		public static function getCollection($con, $name, $table) {
			
			self::init();
			
			return $con->selectCollection($name, $table);
			
		}
		
		public static function find($con, $collectionName, $collectionTable, $where, $where2) {
			
			self::init();
			
			$collection = self::getCollection($con, $collectionName, $collectionTable);
			
			return $collection->find(array($where => $where2));
			
		}
		
		public static function find2($con, $collectionName, $collectionTable) {
			
			self::init();
			
			$collection = self::getCollection($con, $collectionName, $collectionTable);
			
			return $collection->find();
			
		}
		
		public static function find3($con, $collectionName, $collectionTable, $retrieve) {
			
			self::init();
			
			$collection = self::getCollection($con, $collectionName, $collectionTable);
			
			return $collection->find($retrieve);
			
		}
		
		public static function findArray($con, $collectionName, $collectionTable, $array) {
			
			self::init();
			
			$collection = self::getCollection($con, $collectionName, $collectionTable);
			
			return $collection->find($array);
			
		}
		
		public static function findOne($con, $collectionName, $collectionTable, $where, $where2, $retrieve) {
			
			self::init();
			
			$collection = self::getCollection($con, $collectionName, $collectionTable);
			
			$document = $collection->findOne(array($where => $where2));
			
			return $document[$retrieve];
			
		}
		
		public static function findOne2($con, $collectionName, $collectionTable, $where, $where2) {
			
			self::init();
			
			$collection = self::getCollection($con, $collectionName, $collectionTable);
			
			$document = $collection->findOne(array($where => $where2));
			
			return $document;
			
		}
		
		public static function findOneArray($con, $collectionName, $collectionTable, $array, $retrieve) {
			
			self::init();
			
			$collection = self::getCollection($con, $collectionName, $collectionTable);
			
			$document = $collection->findOne($array);
			
			return $document[$retrieve];
			
		}
		
		public static function getDocumentName($con, $collectionName, $collectionTable, $where, $where2) {
			
			self::init();
			
			$collection = self::getCollection($con, $collectionName, $collectionTable);
			
			$document = $collection->findOne(array($where => $where2));
			
			return $document['name'];
			
		}
		
		public static function getDocumentVisibility($con, $collectionName, $collectionTable, $where, $where2) {
			
			self::init();
			
			$collection = self::getCollection($con, $collectionName, $collectionTable);
			
			$document = $collection->findOne(array($where => $where2));
			
			return $document['visibility'];
			
		}
		
	}

?>