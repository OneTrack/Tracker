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
            $this->load->helper('url');
        }
	
        /**
	 * @Access	: Public
	 * @Function	: login
	 * @Description	: Login option for user
	 * @Params	: NULL
	 */
	public function login() {
            $user_m         =   new User_model;
            $response_data  =	array();
            try {
                $email          =	$this->input->post('email');
                $password       =	$this->input->post('password');
                $result         =	$user_m->login($email,$password);
                if(isset($result) && !empty($result)){
                    $response_data['response']['result']        = TRUE;
                    $response_data['response']['message']       = "Login Success";
                    $response_data['response']['access_token']  = $result['token'];
                    $response_data['response']['data']          = $result;
                } else {
                    $response_data['response']['result']        = FALSE;
                    $response_data['response']['message']       = "Invalid Username or Password";
                    $response_data['response']['access_token']  = "";
                    $response_data['response']['data']          = "";
                }
                echo (json_encode($response_data));
            } catch (Exception $e){
                $response_data['response']['result']        = FALSE;
                $response_data['response']['message']       = $e->getMessage();
                $response_data['response']['access_token']  = "";
                $response_data['response']['data']          = "";
                echo (json_encode($response_data));
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
                $email              =	$_POST['email'];
                $name               =   $_POST['name'];
                $password           =	$_POST['password'];
                $confirm_password   =	$_POST['confirm_password'];
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]');
                $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
                if($this->form_validation->run() == FALSE) {
                    $response_data['response']['message'] = trim(validation_errors());
                    $response_data['response']['result'] = FALSE;
                } else {
                    if($this->user_model->check_if_exist($email)){
                        $response_data['response']['result'] = FALSE;
                        $response_data['response']['message'] = 'User Already Exist';
                    }
                    $this->user_model->add_user($email, $name, $password);
                    $response_data['response']['result'] = TRUE;
                    $response_data['response']['message'] = "Registration Success";
                }
                echo json_encode($response_data);
            } catch(Exception $e){
                $response_data['response']['result'] = FALSE;
                $response_data['response']['message'] = $e->getMessage();
                echo json_encode($response_data);
            }
	}
}
?>