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
        }
	
        public function index() {
            $this->load->view('test_view');
            
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
            echo "<script type='text/javascript'>window.close();</script>";
            $user_model = new User_model;
            $login_data = $this->facebook->get_user();
            if(isset($login_data['email']) && !empty($login_data['email'])){
                $user_id = $user_model->check_if_exist($login_data['email']);
                if($user_id){ // Already Exist
                    // Do Nothing
                } else { // New Record Insert
                    $user_id = $user_model->add_user_from_thirdparty($login_data['email'], isset($login_data['name'])?$login_data['name']:$login_data['first_name']);
                }
                $newdata = array(
                    'user_id'   => $user_id,
                    'name'      => isset($login_data['name'])?$login_data['name']:$login_data['first_name'],
                    'email'     => $login_data['email'],
                    'logged_in' => TRUE,

                );
                $this->session->set_userdata($newdata);
            } 
        }
       
	
	/**
	* Dashboard Operations
	**/
	public function welcome() {
		
	}
	
        /**
	 * @Access	: Public
	 * @Function	: login
	 * @Description	: Login option for user
	 * @Params	: NULL
	 */
	public function login() {
            $response_data  =	array();
            try {
                $email          =	$this->input->post('email');
                $password       =	$this->input->post('password');
                $result         =	$this->user_model->login($email,$password);
                if($result){
                    $response_data['response']['result'] = TRUE;
                    $response_data['response']['message'] = "Login Success";
                } else {
                    $response_data['response']['result'] = FALSE;
                    $response_data['response']['message'] = "Invalid Username or Password";
                }
                echo json_encode($response_data);die;
            } catch (Exception $e){
                $response_data['response']['result'] = FALSE;
                $response_data['response']['message'] = $e->getMessage();
                echo json_encode($response_data);die;
            }
	}
	
        /**
	 * @Access	: Public
	 * @Function	: Registration
	 * @Description	: registration for user
	 * @Params	: NULL
	 */
	public function registration() { 
            $response_data  =	array();
            try {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
                $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
                if($this->form_validation->run() == FALSE) {
                    $response_data['response'] = trim(validation_errors());
                } else {
                    if($this->user_model->check_if_exist($this->input->post('email'))){
                        $response_data['response']['result'] = FALSE;
                        $response_data['response']['message'] = 'User Already Exist';
                    }
                    $this->user_model->add_user();
                    $response_data['response']['result'] = TRUE;
                    $response_data['response']['message'] = "Registration Success";
                }
                echo json_encode($response_data);die;
            } catch(Exception $e){
                $response_data['response']['result'] = FALSE;
                $response_data['response']['message'] = $e->getMessage();
                echo json_encode($response_data);die;
            }
	}
	
	public function logout() {
            $newdata = array(
            'id'   =>'',
            'email'  =>'',
            'name'     => ''
            );
            $this->session->unset_userdata($newdata );
            $this->session->sess_destroy();
	}
}
?>