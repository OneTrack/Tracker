<?php
/***
 * @File : user.php Controller
 * @Class : Model_Sales
 * @Description: This class file holds the operations of user registration and login
 * 
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
	public function __construct() { 
            parent::__construct();
            $this->load->model('user_model');
            $this->load->library('facebook');
            $this->load->library('gmail');
            $this->load->helper('url');
            $this->load->library('curl');
            if(isset($_SESSION['logged_in']) && !empty($_SESSION['logged_in']) && isset($_SESSION['email']) && !empty($_SESSION['logged_in'])) {
                redirect(SITEURL.'/dashboard');
            }
        }
	
        public function index() { 
            $this->load->view('header');
            //$this->load->view('navigation_header');
            //$this->load->view('dashboard');
            $this->load->view('footer');
            //$this->load->view('test_view');
        }
        
	/**
	* Dashboard Operations
	**/
	public function facebook_login() {
           $login_url = $this->facebook->login_url();
           $login_url = $login_url.'&display=popup';
           redirect($login_url);
	}
	
	/**
	 * Dashboard Operations
	 **/
	public function gmail() {
		$login_gmail = $this->gmail->login_gmail();
		echo $login_gmail;
        }
        
        /**
	* Dashboard Operations
	**/
	public function facebook_login_callback() {
            $user_model = new User_model;
            $login_data = $this->facebook->get_user();
            if(isset($login_data['email']) && !empty($login_data['email'])){
                $user_id = $user_model->check_if_exist($login_data['email']);
                if($user_id){ // Already Exist
                    // Do Nothing
                } else { // New Record Insert
                    $user_id = $user_model->add_user_from_thirdparty($login_data['email'], isset($login_data['name'])?$login_data['name']:$login_data['first_name']);
                }
                $token  =   $user_model->create_and_update_token($user_id);
                //Upload picture
                $user_model->upload_profile_pic($user_id,$login_data['id']);
                $newdata = array(
                    'user_id'   => $user_id,
                    'name'      => isset($login_data['name'])?$login_data['name']:$login_data['first_name'],
                    'email'     => $login_data['email'],
                    'token'     => $token,
                    'logged_in' => 1,

                );
                $this->session->set_userdata($newdata);
                echo "<script type='text/javascript'>window.close();window.opener.location.reload();</script>";
            } 
        }
       
        /**
	 * @Access	: Public
	 * @Function	: login
	 * @Description	: Login option for user
	 * @Params	: NULL
	 */
	public function login() {
            $result =    $this->curl->simple_post('/api/user/login', array('email'  =>  $this->input->post('email'), 'password' => $this->input->post('password')));
            if(isset($result)){
                $result_array   = json_decode($result, TRUE);
                if($result_array['response']['result'] == 1){
                    // Login Successful
                    $result_array['response']['data']['logged_in'] = 1;
                    $this->session->set_userdata($result_array['response']['data']); 
                    redirect(SITEURL.'/dashboard');
                } else {
                    // Failure in login
                    echo "<script>alert('Need to handle this');</script>";
                }
            }
	}
	
        /**
	 * @Access	: Public
	 * @Function	: Registration
	 * @Description	: registration for user
	 * @Params	: NULL
	 */
	public function registration() { 
            $result =    $this->curl->simple_post('/api/user/registration', array('email'  =>  $this->input->post('email'), 'name' => $this->input->post('name'), 'password' => $this->input->post('password'), 'confirm_password' => $this->input->post('confirm_password')));
            if(isset($result)){
                $result_array   = json_decode($result, TRUE);
                if(isset($result_array['response']['result']) && $result_array['response']['result'] == 1){
                    // successfully registered
                    $this->login();
                } else {
                    // Failure in registration
                    echo "<script>alert('Need to handle this');</script>";
                }
            }
	}
	
	public function logout() {
            $newdata = array(
            'id'        =>  '',
            'email'     =>  '',
            'name'      =>  '',
            'token'     =>  '',
            'logged_in' =>  ''
            );
            $this->session->unset_userdata($newdata );
            $this->session->sess_destroy();
            redirect(SITEURL.'/user');
	}
        
}
?>