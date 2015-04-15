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
                    $response_data['response']['access_token']  = $result;
                } else {
                    $response_data['response']['result']        = FALSE;
                    $response_data['response']['message']       = "Invalid Username or Password";
                    $response_data['response']['access_token']  = "";
                }
                echo json_encode($response_data);die;
            } catch (Exception $e){
                $response_data['response']['result']        = FALSE;
                $response_data['response']['message']       = $e->getMessage();
                $response_data['response']['access_token']  = "";
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
}
?>