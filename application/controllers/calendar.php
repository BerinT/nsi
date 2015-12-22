<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
public function __construct()
{
parent::__construct();
$this->load->library('form_validation');
$this->load->model('calendar_model');
$this->load->library('session');
$this->load->helper('url');
}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function getEvents() {
	$from=$this->security->xss_clean(trim($this->input->get('from')));
    $to=$this->security->xss_clean(trim($this->input->get('to')));
	$events = $this->calendar_model->getCalendarEvents($from, $to);
	//var_dump($events); exit;
	$response=array("success"=>"1", "result"=>$events);
      echo json_encode($response);
	/*$this->load->view('header');
	$this->load->view('kalendar');
	$this->load->view('footer');*/
	}
	
	public function getEvents_korisnik() {
	$from=$this->security->xss_clean(trim($this->input->get('from')));
    $to=$this->security->xss_clean(trim($this->input->get('to')));
	$events = $this->calendar_model->getCalendarEvents_korisnik($from, $to);
	//var_dump($events); exit;
	$response=array("success"=>"1", "result"=>$events);
      echo json_encode($response);
	/*$this->load->view('header');
	$this->load->view('kalendar');
	$this->load->view('footer');*/
	}
	
public function event($id) {
	$event = $this->calendar_model->getSingleEvent($id);
	//var_dump($event); exit;
	$this->load->view('templates/header_manager');
	$this->load->view('kalendar_jedan_dogadjaj', $event);
	
}
}
