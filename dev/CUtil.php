<?
    include_once("helper.php");
    class Util{
    
        public static $MAIL_SENDER = "info@thisisud.com";
        private static $instance; // singleton instance
        public static $fileNameRemapper; // singleton instance
        public static $file; // singleton instance


        // private function __construct(){
        //     $file = file_get_contents(__DIR__ ."/rev-manifest.json");
        //     $fileNameRemapper = json_decode($file, true);
        //     //$file = file_put_contents(__DIR__ ."/php-rev-manifest.json", $file);
        // }

        public static function getInstance(){
            if ( is_null( self::$instance ) )
            {
            self::$instance = new self();
            }
            return self::$instance;
        }
        
        public static function escapeObject( $obj ){
            
            $sql_conn = mysqli_connection();
            
            if(is_object($obj)){
                $vars = get_object_vars($obj);
                foreach ($vars as &$v) {
                if($v != NULL){
                    $v = $sql_conn->escape_string($v);
                }
                }
            } else if(is_string($obj)){
                if($v != NULL){
                    $obj = $sql_conn->escape_string($v);
                }
            }
            mysqli_close($sql_conn);
            return $obj;
        }
        
        public static function genRandText($length){
            $length += 0;
            return bin2hex(openssl_random_pseudo_bytes($length/2));
        }
        
        /*
            Password-Based Key Derivation Function
            Copyright (c) 2016, Taylor Hornby
            https://github.com/defuse/password-hashing/blob/master/
        */
        public static function hash_pbkdf2($password, $salt){
            $algorithm = "sha256";
            $count = 1000;
            $key_length = 64;
            $raw_output = false;
            
            if(!in_array($algorithm, hash_algos(), true))
                trigger_error('PBKDF2 ERROR: Invalid hash algorithm.', E_USER_ERROR);
            if($count <= 0 || $key_length <= 0)
                trigger_error('PBKDF2 ERROR: Invalid parameters.', E_USER_ERROR);

            if (function_exists("hash_pbkdf2")) {
                // The output length is in NIBBLES (4-bits) if $raw_output is false!
                if (!$raw_output) {
                    $key_length = $key_length * 2;
                }
                return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
            }

            $hash_length = strlen(hash($algorithm, "", true));
            $block_count = ceil($key_length / $hash_length);

            $output = "";
            for($i = 1; $i <= $block_count; $i++) {
                // $i encoded as 4 bytes, big endian.
                $last = $salt . pack("N", $i);
                // first iteration
                $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
                // perform the other $count - 1 iterations
                for ($j = 1; $j < $count; $j++) {
                    $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
                }
                $output .= $xorsum;
            }

            if($raw_output)
                return substr($output, 0, $key_length);
            else
                return bin2hex(substr($output, 0, $key_length));
        }
        
        public static function send_mail($dest_email ,$subject, $message){

            $header = 'From: isUD" <'.Util::$MAIL_SENDER."> \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            
            // $message .= $header;
            
            $retval = mail ($dest_email,$subject,$message,$header);
            
            return $retval;
        }
        
        public static function scopedIncludeOnce($file, $params = array()){
            extract($params);
            
            if(isset($includerFile)){
                $includerFile = substr($includerFile, strrpos($includerFile,"/")+1,strlen($includerFile));
            }
            include_once($file);
        }

        public static function getEncodedFileName($filename){
            if(is_null(Util::$file)){
                Util::$file = file_get_contents(__DIR__ ."/rev-manifest.json");
                Util::$fileNameRemapper = json_decode(Util::$file, true);
                file_put_contents(__DIR__ ."/php-rev-manifest.json",Util::$fileNameRemapper);
            }

            if(!is_null(Util::$fileNameRemapper)){
                return Util::$fileNameRemapper[$filename];
            }
        }
        
    }
?>