<?php
/***
 * @File : user.php Controller
 * @Class : Model_Sales
 * @Description: This class file holds the operations of user registration and login
 * 
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	public function __construct() { 
            parent::__construct();
        }
        
        
	public function overview(){
		$this->load->view('admin/overview');
		
	}
	public function addProduct(){
		$this->load->view('admin/addProduct');
	
	}
	public function showproduct(){
		$this->load->view('admin/showproduct');
	}
}
?>