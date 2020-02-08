<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StatusController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string');
		$this->load->helper('url');
		$this->load->model('statusmodel');
		$this->load->model('linkmodel');
	}

	public function index()
	{
		$all = $this->statusmodel->getAll();
		$status = array();
		foreach($all as $each) {
			if(array_key_exists($each['campaign_id'], $status)){
				if($each['is_real'] == 0) {
					$status[$each['campaign_id']]['real_traffic']++;
				} else {
					$status[$each['campaign_id']]['filter_traffic']++;
				}
			} else {
				if($each['is_real'] == 0) {
					$new_array = array(
						'campaign_id'=> $each['campaign_id'],
						'real_traffic' => 1,
						'filter_traffic' => 0 
					);
				} else {
					$new_array = array(
						'campaign_id'=> $each['campaign_id'],
						'real_traffic' => 0,
						'filter_traffic' => 1 
					);
				}
				
				$status[$each['campaign_id']] = $new_array;
			}
		}
		$data['status'] = $status;
		$this->load->view('status', $data);
	}

	public function insert()
	{
		$id = $this->input->post('id');
		$is_real = $this->input->post('is_real');
		$data = array(
			'link_id' => $id,
			'click_date' => date('Y-m-d'),
			'is_real' => $is_real,
		);
		$this->statusmodel->insertClick($data);
		$result['success'] = true;
		echo json_encode($result);
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$this->linkmodel->deleteLink($id);
		$this->statusmodel->deleteClick($id);
		$result['success'] = true;
		echo json_encode($result);
	}

	public function getByOption()
	{
		$option = $this->input->post('option');
		$from_year = $this->input->post('from_year');
		$from_month = $this->input->post('from_month') + 1;
		$from_day = $this->input->post('from_day');
		$to_year = $this->input->post('to_year');
		$to_month = $this->input->post('to_month') + 1;
		$to_day = $this->input->post('to_day');

		if($from_month < 10) {
			if($from_day < 10) {
				$from_date = $from_year.'-0'.$from_month.'-0'.$from_day;
			} else {
				$from_date = $from_year.'-0'.$from_month.$from_day;
			}
		} else {
			if($from_day < 10) {
				$from_date = $from_year.$from_month.'-0'.$from_day;
			} else {
				$from_date = $from_year.$from_month.$from_day;
			}
			
		}

		if($to_month < 10) {
			if($to_day < 10) {
				$to_date = $to_year.'-0'.$to_month.'-0'.$to_day;
			} else {
				$to_date = $to_year.'-0'.$to_month.$to_day;
			}
		} else {
			if($to_day < 10) {
				$to_date = $to_year.$to_month.'-0'.$to_day;
			} else {
				$to_date = $to_year.$to_month.$to_day;
			}
			
		}

		if($option === 'Daily') {
			$all = $this->statusmodel->getDaily($from_date);
		} else if($option === 'Monthly') {
			$all = $this->statusmodel->getMonthly($from_year, $from_month);
		} else if($option === 'Yearly') {
			$all = $this->statusmodel->getYearly($from_year);
		} else {
			$all = $this->statusmodel->getRange($from_date, $to_date);
		}

		$status = array();
		foreach($all as $each) {
			if(array_key_exists($each['campaign_id'], $status)){
				if($each['is_real'] == 0) {
					$status[$each['campaign_id']]['real_traffic']++;
				} else {
					$status[$each['campaign_id']]['filter_traffic']++;
				}
			} else {
				if($each['is_real'] == 0) {
					$new_array = array(
						'campaign_id'=> $each['campaign_id'],
						'real_traffic' => 1,
						'filter_traffic' => 0 
					);
				} else {
					$new_array = array(
						'campaign_id'=> $each['campaign_id'],
						'real_traffic' => 0,
						'filter_traffic' => 1 
					);
				}
				
				$status[$each['campaign_id']] = $new_array;
			}
		}
		

		// $clicks = $this->statusmodel->getAll();
		// $filter_date = date('Y-m-d', strtotime($from_year.$from_month.$from_day));
		// foreach($clicks as $click) {
		// 	if($db_date < $filter_date) {
		// 		array_push($data, $db_date);
		// 		array_push($data, $filter_date);
		// 	}
			
			// array_push($data, $db_date.getMonth());
			// array_push($data, $db_date.getFullYear(), $db_date.getMonth(), $db_date.getDate());
		// }

		// $to_date = $this->input->post('to_date');
		// // $data = array();
		// $data = array();
		// if($option === 'Daily') {
		// 	$clicks = $this->statusmodel->getDaily($from_date);
		// 	foreach($clicks as $click) {
		// 		$db_date = date('Y-m-d', $click['click_date']);

		// 		if($db_date != $click_date) {
		// 			array_push($data, $click);
		// 		}
		// 	}
		// }
		$result['success'] = true;
		$result['data'] = $status;
		echo json_encode($result);
	}
}