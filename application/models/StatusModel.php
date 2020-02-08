<?php

class StatusModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAll(){     
        $this->db->from('click');
        $this->db->join('link', 'click.link_id = link.id');
        $this->db->order_by('campaign_id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertClick($data) {
        return $this->db->insert('click', $data);
    }
    
    public function deleteClick($link_id) {
        return $this->db->delete('click', array('link_id' => $link_id));
    }

    public function getDaily($from_date) {
        $this->db->from('click');
        $this->db->where('click_date', $from_date);
        $this->db->join('link', 'click.link_id = link.id');
        $this->db->order_by('campaign_id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getMonthly($from_year, $from_month) {
        if($from_month < 10) {
            $from = $from_year.'-0'.$from_month.'-01';
            $to = $from_year.'-0'.$from_month.'-31';
        } else {
            $from = $from_year.'-'.$from_month.'-01';
            $to = $from_year.'-'.$from_month.'-31';
        }

        $this->db->from('click');
        $this->db->where('click_date >=', $from);
        $this->db->where('click_date <=', $to);
        $this->db->join('link', 'click.link_id = link.id');
        $this->db->order_by('campaign_id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getYearly($from_year) {
        $from = $from_year.'-01-01';
        $to = $from_year.'-12-31';
        $this->db->from('click');
        $this->db->where('click_date >=', $from);
        $this->db->where('click_date <=', $to);
        $this->db->join('link', 'click.link_id = link.id');
        $this->db->order_by('campaign_id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRange($from_date, $to_date) {
        $this->db->from('click');
        $this->db->where('click_date >=', $from_date);
        $this->db->where('click_date <=', $to_date);
        $this->db->join('link', 'click.link_id = link.id');
        $this->db->order_by('campaign_id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
}
