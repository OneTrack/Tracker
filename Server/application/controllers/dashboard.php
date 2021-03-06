<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
        public function __construct() { 
            parent::__construct();
            $this->load->library('session');
            $this->load->helper('url');
            //$this->load->library('facebook');
        }
        
	public function index()
	{
            if(!isset($_SESSION['logged_in']) || empty($_SESSION['logged_in'])) {
                redirect(SITEURL);
            }
            $this->load->view('header');
            $this->load->view('menuHeader');
            $this->load->view('sidePanel');
            $this->load->view('calender');
            $this->load->view('admin/overview');
            $this->load->view('footer');
        }
}
