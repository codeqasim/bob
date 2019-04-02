<?php

class Home_model extends CI_Model {

    function getTheme($domain) {
        $this->db->select('theme, favicon, logo, business_name, slider, color');
        $query = $this->db->get_where('ota_theme', ['domain' => $domain]);
        return $query->row();
    }
    
    function checkRecord($table, $data) {
        $query = $this->db->get_where($table, $data);
        return $query->row();
    }

    function saveRecord($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    function updateRecord($table, $where_fields, $data) {
        
        $this->db->trans_start();
        
        foreach ($where_fields as $key => $field) {
            $this->db->where($key, $field);
        }
        $this->db->update($table, $data);
        $this->db->trans_complete();
        return $this->db->affected_rows();
    }

    function deleteRecord($table, $where_fields) {
        foreach ($where_fields as $key => $field) {
            if($key != 'string'){
                $this->db->where($key, $field);
            }
            else{
                $this->db->where($field);
            }
        }
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
    
    function getRecords($table, $select_fields, $where_fields=null, $order_by=null) {
        
        $this->db->select(implode(',', $select_fields));
        if(is_array($where_fields)){
            foreach ($where_fields as $key => $field) {
                if($key != 'string'){
                    $this->db->where($key, $field);
                }
                else{
                    $this->db->where($field);
                }
            }
        }
        
        if($order_by){
            $this->db->order_by($order_by);
        }
        
        $query = $this->db->get($table);
        return $query->result();
    }
}
