<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**

 * @File : user.php Controller

 * @Class : Model_Sales

 * @Description: This class file holds the operations of user registration and login

 * 

 */



class User_model extends CI_Model {

    

    public function __construct() {

        parent::__construct(); 

           $this->load->database();

           $this->load->library('session');

    }

    

    /**

    * @Access       : Public

    * @Function     : login

    * @Description  : login for user

    * @Params       : email,password

    */

    public function login($email,$password) {

        $email=strtolower($email);

        $query = $this->db->query("SELECT id, email, name

					 FROM users

					 WHERE email = '".addslashes($email)."'

					 AND password = AES_ENCRYPT('".addslashes($password)."','".ENCRYPTION_KEY."')",false);

        if($query->num_rows()>0) {

            foreach($query->result() as $rows) {

                $newdata = array(

                	'user_id'   => $rows->id,

                    	'name'      => $rows->name,

		        'email'     => $rows->email,

	                'logged_in' => TRUE,

                );

            }

            $this->session->set_userdata($newdata);

            return TRUE;          

	}

	return FALSE;

    }

    

    /**

    * @Access       : Public

    * @Function     : add_user

    * @Description  : signup for user

    * @Params       : post data

    */

    public function add_user() { 

        $this->db->set('name',$this->input->post('name'));

        $this->db->set('email',$this->input->post('email'));

        $pass = $this->db->escape($this->input->post('password'));

        $this->db->set('password', "AES_ENCRYPT({$pass},'".ENCRYPTION_KEY."')", FALSE);

        $this->db->set('created_date', 'NOW()', FALSE);

        $this->db->insert('users');

    }

    

    /**

    * @Access       : Public

    * @Function     : check_email_exist

    * @Description  : /

    * @Params       : $email

    */

    public function check_if_exist() { 

        $email = $this->input->post('email');

        $query = $this->db->query("SELECT id

					 FROM users

					 WHERE email = '".addslashes($email)."'

					 ");

        if($query->num_rows()>0) {

            return True;

        } else {

            return False;

        }

    }

}

?>