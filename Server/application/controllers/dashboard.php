<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

        public function __construct() { 
            parent::__construct();
            $this->load->helper('url');
        }
        public function index() { 
            if(isset($_SESSION['logged_in']) && !empty($_SESSION['logged_in']) && isset($_SESSION['email']) && !empty($_SESSION['logged_in'])) {
                echo '<pre>'; print_r($_SESSION); die;
            } else {
                redirect(SITEURL);
            }
        }
}
