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
           $this->load->helper('string');

    }

    

    /**

    * @Access       : Public

    * @Function     : login

    * @Description  : login for user

    * @Params       : email,password

    */

    public function login($email,$password) {
        $email=strtolower($email);
        $query = $this->db->query("SELECT id, email, name, image
                                    FROM users
                                    WHERE email = '".addslashes($email)."'
                                    AND password = AES_ENCRYPT('".addslashes($password)."','".ENCRYPTION_KEY."')",false);
        if($query->num_rows()>0) {
            $result = (array) $query->result()[0];
            $token =   $this->create_and_update_token($result['id']);
            $result['token'] = $token;
            return $result;          
        }
        return FALSE;
    }
    
    public function create_and_update_token($user_id) {
        $token  = random_string('alnum',50);
        $this->db->set('token',$token);
        $this->db->where('id',$user_id);
        $this->db->update('users');
        return $token;
    }

    

    /**

    * @Access       : Public

    * @Function     : add_user

    * @Description  : signup for user

    * @Params       : post data

    */

    public function add_user($email, $name, $password) { 

        $this->db->set('name', $name);

        $this->db->set('email',$email);

        $pass = $this->db->escape($password);

        $this->db->set('password', "AES_ENCRYPT({$pass},'".ENCRYPTION_KEY."')", FALSE);

        $this->db->set('created_date', 'NOW()', FALSE);

        $this->db->insert('users');

    }
    
    /**

    * @Access       : Public

    * @Function     : add_user

    * @Description  : signup for user

    * @Params       : post data

    */

    public function add_user_from_thirdparty($email, $name) { 

        $this->db->set('name',$name);

        $this->db->set('email',$email);

        $this->db->set('password', '');

        $this->db->set('created_date', 'NOW()', FALSE);

        $this->db->insert('users');
        
        return $this->db->insert_id();

    }

    

    /**

    * @Access       : Public

    * @Function     : check_email_exist

    * @Description  : /

    * @Params       : $email

    */

    public function check_if_exist($email) { 

        $query = $this->db->query("SELECT id

					 FROM users

					 WHERE email = '".addslashes($email)."'

					 ");

        if($query->num_rows()>0) {

            foreach ($query->result() as $row) {
               return $row->id;
            }

        } else {

            return False;

        }

    }
    
    public function upload_profile_pic($user_id,$fid){
        $created_date = '';
        $query = $this->db->query("SELECT created_date FROM
                                    users
                                    WHERE id = '".$user_id."'
                                ");
        if($query->num_rows()>0) {
            foreach ($query->result() as $row) {
                $created_date = $row->created_date;
            }
            $timestamp = $user_id.strtotime($created_date);
            $img = file_get_contents('https://graph.facebook.com/'.$fid.'/picture?type=large');
            $file = 'assets/user_images/'.$timestamp.'.jpg';
            file_put_contents($file, $img);
            $this->db->set('image',$file);
            $this->db->where('id',$user_id);
            $this->db->update('users');
        }
    }

}

?>