<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_export extends CI_Model{
    
    function get_all_data_count(){

        $this->db->order_by('user_id',"DESC");
        $this->db->limit(500);
        $query= $this->db->get('user_details');
        return $query->num_rows();
    }

    function get_data($limit,$start,$order,$dir)
    {
        if($limit != '' && $start != '')
       {
            $this->db->limit($limit,$start);
       }
       
       if($order != '' && $dir != '')
       {
            $this->db->order_by($order,$dir);
       }

        //$this->db->order_by('user_id', 'DESC');
        $query =  $this->db->get('user_details');
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
    }

    function get_data_search($limit,$start,$search,$order,$dir){

            $this->db->select('*');
            $this->db->like("user_id",$search);
            $this->db->or_like("username",$search);
            $this->db->or_like("first_name",$search);
            $this->db->or_like("last_name",$search);
            $this->db->or_like("gender",$search);
            $this->db->or_like("password",$search);
            $this->db->limit($limit,$start);
            $this->db->order_by($order,$dir);
            $query= $this->db->get('user_details');
            return $query->result();

    }

    function get_data_search_count($limit,$start,$search,$order,$dir){
        
            $this->db->select('*');
            $this->db->like("user_id",$search);
            $this->db->or_like("username",$search);
            $this->db->or_like("first_name",$search);
            $this->db->or_like("last_name",$search);
            $this->db->or_like("gender",$search);
            $this->db->limit(500);
            $this->db->order_by($order,$dir);
            $query= $this->db->get('user_details');
            return $query->num_rows();

    }

    function fetch_data(){

        $this->db->order_by('user_id',"DESC");
        $this->db->limit(100);
        $query= $this->db->get('user_details');
        return $query->result_array();
    }
}


?>
    
