<?php
/***
 * @File : product.php Controller
 * @Class : product
 * @Description: This class file holds the operations of product fetch, add, update etc.
 * 
 */


if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Controller {
	public function __construct() { 
            parent::__construct();
            $this->load->model('product_model');
            $this->load->model('authentication_model');
        }
	
        public function index() {
            
        }
        
        /**
	 * Fetch all user products and return
	**/
	public function get_all_products($token) {
            $response_data              =   array();
            $product_model              =   new Product_model;
            $authentication_model       =   new Authentication_model;
            try {
                if($authentication_model->verify_access_token($token)){
                    $product_details    =   $product_model->get_products($token);
                    if(isset($product_details) && !empty($product_details)){
                        $response_data['response']['result']    = TRUE;
                        $response_data['response']['message']   = "";
                        $response_data['response']['data']      = $product_details;
                    } else {
                        $response_data['response']['result']    = FALSE;
                        $response_data['response']['message']   = "No Products Found";
                        $response_data['response']['data']      = '';
                    }
                } else {
                    $response_data['response']['result']    = FALSE;
                    $response_data['response']['message']   = "Invalid Access Token";
                    $response_data['response']['data']      = '';
                }
                echo json_encode($response_data);die;
            } catch(Exception $e){
                $response_data['response']['result']    = FALSE;
                $response_data['response']['message']   = $e->getMessage();
                $response_data['response']['data']      = '';
                echo json_encode($response_data);die;
            }
        }
        
        public function add_update_product($user_id) {
            
        }
        
}
?>