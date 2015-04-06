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
        }
	
	/**
	* Dashboard Operations
	**/
	public function facebook() {
           $login_url = $this->facebook->login_url();
           echo $login_url;
           die;
	}
	
	/**
	 * Dashboard Operations
	 **/
	public function gmail() {
		$login_gmail = $this->gmail->login_gmail();
		echo $login_gmail;
        die;
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
            $email	=	$this->input->post('email');
            $password	=	$this->input->post('password');
            $result	=	$this->user_model->login($email,$password);
            if($result) return (TRUE);
            else        return (FALSE);
	}
	
        /**
	 * @Access	: Public
	 * @Function	: Registration
	 * @Description	: registration for user
	 * @Params	: NULL
	 */
	public function registration() { 
            try {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
                $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
                
                if($this->form_validation->run() == FALSE) {
                    echo json_encode(trim(validation_errors())); die;
                } else {
                    if($this->user_model->check_if_exist()){
                        echo json_encode('User Already Exist');die;
                    }
                    $this->user_model->add_user();
                    return TRUE;
                }
            } catch(Exception $e){
                echo $e->getMessage();die;
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