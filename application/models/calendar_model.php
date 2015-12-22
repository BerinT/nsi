<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendar_model extends CI_Model {
public function __construct()
{
parent::__construct();
$this->load->database();
}
public function register_user()
{

}
public function getCalendarEvents($from, $to) {
	//$this->db->select('pocetak as start, kraj as end, id_zahtjeva as id, status as title', false);
    //$this->db->from('zahtjevi');
	$sql="select z.pocetak as start,z.kraj as end,z.id_zahtjeva as id,z.status as status,u.username as title, z.napomena as razlog
		from zahtjevi z, users u
		where z.pk_podnosilac=u.id";
	//$this->db->query($sql);
	$query=$this->db->query($sql);
	
    //$this->db->where('vrijeme_pocetka >=', $from);
	//$this->db->or_where('vrijeme_zavrsetka >=', $from);
	//$query = $this->db->get();
	$result=$query->result();
	//var_dump($this->db->last_query());exit;
	foreach ($result as &$event) {
		if($event->status=='Approved'){
		///var_dump($event);
			$event->start = strtotime($event->start)*1000;
			$event->end = strtotime($event->end)*1000;
			$event->class = "event-important";
			$event->url = base_url()."index.php/calendar/event/".$event->id;
		}
		if($event->status=='pending'){
		///var_dump($event);
			$event->start = strtotime($event->start)*1000;
			$event->end = strtotime($event->end)*1000;
			$event->class = "event-info";
			$event->url = base_url()."index.php/calendar/event/".$event->id;
		}
		
	}
	return $result;
}

public function getCalendarEvents_korisnik($from, $to) {
	$user_id=$this->session->userdata('user_id');
	//$this->db->select('pocetak as start, kraj as end, id_zahtjeva as id, status as title', false);
    //$this->db->from('zahtjevi');
	$sql="select z.pocetak as start,z.kraj as end,z.id_zahtjeva as id,z.status as status,u.username as title, u.id as u_id, z.napomena as razlog
		from zahtjevi z, users u
		where z.pk_podnosilac=u.id";
	//$this->db->query($sql);
	$query=$this->db->query($sql);
	
    //$this->db->where('vrijeme_pocetka >=', $from);
	//$this->db->or_where('vrijeme_zavrsetka >=', $from);
	//$query = $this->db->get();
	$result=$query->result();
	//var_dump($this->db->last_query());exit;
	foreach ($result as &$event) {
		if($event->u_id==$user_id){
			if($event->status=='Approved'){
			///var_dump($event);
				$event->start = strtotime($event->start)*1000;
				$event->end = strtotime($event->end)*1000;
				$event->class = "event-important";
				$event->url = base_url()."index.php/calendar/event/".$event->id;
			}
			if($event->status=='pending'){
			///var_dump($event);
				$event->start = strtotime($event->start)*1000;
				$event->end = strtotime($event->end)*1000;
				$event->class = "event-info";
				$event->url = base_url()."index.php/calendar/event/".$event->id;
			}
		}
		
	}
	return $result;
}

public function getSingleEvent($id) {
	$this->db->select('*');
	$this->db->from('zahtjevi');
	$this->db->where('id_zahtjeva', $id);
	$query = $this->db->get();
	$result=$query->row();
	return $result;
	//$this->db->join('user', 'user.id = ci.fk_user_id', 'left');
}
		
}