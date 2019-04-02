<?php

class Supplier_model extends CI_Model {
    
    function supplierLogin($data) {
        $this->db->select('suppliers.id, suppliers.email, suppliers.status, ota_registration.id as ota_user_id, ota_registration.email as ota_email');
        $this->db->join('ota_registration', 'ota_registration.ota_id = suppliers.ota_id', 'inner');
        $query = $this->db->get_where('suppliers', $data);
        
        return $query->row();
    }
}
