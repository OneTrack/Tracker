<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**

 * @File : authentication.php Controller

 * @Class : Authentication_model

 * @Description: This class file holds the operations for token authentication

 * 

 */



class Authentication_model extends CI_Model {

    

    public function __construct() {

        parent::__construct(); 

           $this->load->database();
    }

    public function verify_access_token($token) {
        $query = $this->db->query("SELECT id
                                    FROM users
                                    WHERE token = '".addslashes($token)."'");
        if($query->num_rows()>0) {
            return TRUE;
        }
        return FALSE;
    }

}

?>