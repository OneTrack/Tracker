<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**

 * @File : product.php Controller

 * @Class : Model_Sales

 * @Description: This class file holds the operations of products add, fetch, update etc.

 * 

 */



class Product_model extends CI_Model {

    public function __construct() {

        parent::__construct(); 

           $this->load->database();

    }
    
    /**

    * @Access       : Public

    * @Function     : get_products

    * @Description  : fetch all products registered to user

    * @Params       : $user_id

    */
    public function get_products($token){
        $query = $this->db->query("SELECT p.*, upi.serial_number
                                    FROM product p 
                                    LEFT JOIN user_product_info upi
                                    ON (p.product_id = upi.id)
                                    LEFT JOIN users u
                                    ON(upi.user_id = u.id)
                                    WHERE u.token = '". addslashes($token)."'");
        if($query->num_rows()>0) {
            return $query->result();          
        }
        return FALSE;
    }
    
}
?>