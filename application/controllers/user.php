<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
public function __construct()
{
parent::__construct();
$this->load->library('form_validation');
$this->load->model('user_model');
$this->load->library('session');
$this->load->helper('url');
$this->load->helper('my_helper');
}

public function index()
{
	if(($this->session->userdata('user_id')!=""))
	{
		if($this->session->userdata('uloga')=='uposlenik')
		{
			$this->load->view("templates/header_korisnik");
			$this->load->view('home_korisnik');
		}
		if($this->session->userdata('uloga')=='admin')
		{
			$this->load->view("templates/header_admin");
			$this->load->view('home_admin');
		}
		if($this->session->userdata('uloga')=='manager')
		{
			$this->load->view("templates/header_manager");
			$this->load->view('home_manager');		
		}
	}
	else
	{
		$this->load->view("templates/header_login");
		$this->load->view("login_view");
	}
}


public function login()
{
	$rules = array(array('field'=>'l_email','label'=>'Email','rules'=>'required|valid_email'),
	array('field'=>'l_pass','label'=>'Password','rules'=>'required'));
	$this->form_validation->set_rules($rules);
	if($this->form_validation->run() == FALSE)
	{
	$this->index();
	}
	else
	{
	$auth=$this->user_model->login($this->input->post('l_email'),$this->input->post('l_pass'));
	if($auth)
	{
	//redirect(site_url('home'));
	//$this->load->view('home');
		if($this->session->userdata('uloga')=='uposlenik')
	{
		$this->load->view("templates/header_korisnik");
		$this->load->view('home_korisnik');
	}
	if($this->session->userdata('uloga')=='admin')
	{
		$this->load->view("templates/header_admin");
		$this->load->view('home_admin');
	}
	if($this->session->userdata('uloga')=='manager')
	{
		$this->load->view("templates/header_manager");
		$this->load->view('home_manager');
	}
	}
	else
	{
		$this->session->set_flashdata('login_msg','<div class="alert alert-success text-center">Pogresan email ili lozinka</div>');
	$this->index();
	}
}

}public function register()
{
$this->load->view('register_view');
}

public function do_register()
{
$rules = array(
array('field'=>'username','label'=>'User Name','rules'=>'trim|required|min_length[4]|max_length[12]'),
array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[users.email]'),
array('field'=>'password','label'=>'Password','rules'=>'trim|required|min_length[6]'),
array('field'=>'gender','label'=>'Gender','rules'=>'required'),
array('field'=>'br_dana_odmora','label'=>'Broj dana','rules'=>'required'),
array('field'=>'cpassword', 'label'=>'Cpassword', 'trim|required|matches[password]|md5')
);
$this->form_validation->set_rules($rules);
if($this->form_validation->run() == FALSE)
{
	$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Pokusajte ponovo</div>');
	$this->load->view("templates/header_manager");
	$this->load->view('add_employee');
}
else
{
	$this->user_model->register_user();
	$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Uspjesno ste dodali novog korisnika</div>');
	$this->load->view("templates/header_manager");
	$this->load->view('add_employee');	
}

}
public function podnesi_zahtjev()
{
	$this->load->view("templates/header_korisnik");
	$this->load->view('zahtjev_forma');
}
public function podnesi_zahtjev_bolovanje()
{
	$this->load->view("templates/header_korisnik");
	$this->load->view('zahtjev_forma_bolovanje');
}
public function dodaj_korisnika()
{
	$this->load->view("templates/header_manager");
	$this->load->view('add_employee');
}

public function promijeni_ulogu()
{
	$this->load->view("templates/header_admin");
	$this->load->view('change_role');
}

public function obradi_promjenu_uloge()
{
	$rules = array(
		array('field'=>'menadzer', 'label'=>'menadzer', 'rules'=>'trim|required|callback_validiraj_username')
		);
	$this->form_validation->set_rules($rules);
	
	if($this->form_validation->run() == FALSE)
	{
	$this->form_validation->set_message('validiraj_username','Navedeni korisnik ne postoji!');
	$this->session->set_flashdata('role_msg','<div class="alert alert-success text-center">Navedeni korisnik ne postoji!</div>');
	$this->load->view("templates/header_admin");
	$this->load->view('change_role');
	}
else
{
	$this->user_model->promjena_uloge();
	$this->session->set_flashdata('role_msg','<div class="alert alert-success text-center">Uspjesno ste promijenili ulogu</div>');
	$this->load->view("templates/header_admin");
	$this->load->view('change_role');	
}
	
	
}
public function dodaj_sektor()
{
	$this->load->view("templates/header_admin");
	$this->load->view('dodavanje_sektora');
}
public function obradi_dodavanje_sektora()
{
	$rules = array(
		array('field'=>'naziv_sektora','label'=>'naziv_sektora','rules'=>'trim|required|is_unique[sektori.naziv]'),
		array('field'=>'menadzer', 'label'=>'menadzer', 'rules'=>'trim|required|callback_validiraj_username')
		);
	$this->form_validation->set_rules($rules);
	
	if($this->form_validation->run() == FALSE)
	{
	$this->form_validation->set_message('validiraj_username','Navedeni korisnik ne postoji!');
	$this->session->set_flashdata('sektor_msg','<div class="alert alert-success text-center">Navedeni korisnik ne postoji!</div>');
	$this->load->view("templates/header_admin");
	$this->load->view('dodavanje_sektora');
	}
else
{
	$this->user_model->dodavanje_sektora();
	$this->user_model->update_id_sektora();
	$this->session->set_flashdata('sektor_msg','<div class="alert alert-success text-center">Uspjesno ste dodali novi sektor</div>');
	$this->load->view("templates/header_admin");
	$this->load->view('dodavanje_sektora');	
}
	
	//$this->user_model->update_id_sektora();
	//$this->index();
}
public function vidi_sve_korisnike()
{
	$data['h']=$this->user_model->select();
	$this->load->view("templates/header_manager");
	$this->load->view('vidi_sve_korisnike', $data);
}
public function obrisi_korisnika()
{
	$this->user_model->remove_user();
}
public function vidi_korisnike_na_odmoru()
{
	$data['h']=$this->user_model->select_na_odmoru();
	$this->load->view("templates/header_manager");
	$this->load->view('vidi_korisnike_na_odmoru', $data);
}
public function vidi_zahtjeve_na_cekanju()
{
	$data['h']=$this->user_model->select_cekanje(); 
	$this->load->view("templates/header_manager");
	$this->load->view('vidi_korisnike_na_cekanju', $data);
}
public function obradi_zahtjeve_na_cekanju()
{
	
	$this->user_model->update_zahtjevi_na_cekanju();
	$data['h']=$this->user_model->select_cekanje();
	$this->load->view("templates/header_manager");
	$this->load->view('vidi_korisnike_na_cekanju',$data);
}
public function historija_zahtjeva()
{
	$data['h']=$this->user_model->select_historija_zahtjeva();
	$this->load->view("templates/header_korisnik");
	$this->load->view('historija_zahtjeva',$data);
}
public function obradi_zahtjev_bolovanje()
{
	$this->load->helper('my_helper');
	$rules = array(
	array('field'=>'pocetak','label'=>'pocetak','rules'=>'required'),
	array('field'=>'kraj','label'=>'kraj','rules'=>'required|callback_validiraj_poredak'),
	array('field'=>'komentar','label'=>'komentar','rules'=>'max_length[200]')
	);
	$this->form_validation->set_rules($rules);
	if($this->form_validation->run() == FALSE)
	{
		$this->load->view("templates/header_korisnik");
		$this->load->view('zahtjev_forma_bolovanje');
	}
	else
	{
		$this->user_model->unesi_zahtjev_bolovanje();
		
		
		$this->session->set_flashdata('verifi_msg','<div class="alert alert-success text-center">Uspjesno ste poslali izvjestaj</div>');
		$this->load->view("templates/header_korisnik");
		$this->load->view('zahtjev_forma_bolovanje');
	}
}
public function obradi_zahtjev()
{
	$this->load->helper('my_helper');
	$preostalo_dana=$this->user_model->provjeri_br_dana();
	$rules = array(
	array('field'=>'pocetak','label'=>'pocetak','rules'=>'required'),
	array('field'=>'kraj','label'=>'kraj','rules'=>'required|callback_validiraj_poredak|callback_validiraj_datume1|callback_validiraj_datume|callback_validiraj_presjek'),
	array('field'=>'komentar','label'=>'komentar','rules'=>'max_length[200]')
	);
	$this->form_validation->set_rules($rules);
	if($this->form_validation->run() == FALSE)
	{
		$this->load->view("templates/header_korisnik");
		$this->load->view('zahtjev_forma');
	}
	else
	{
		$this->user_model->unesi_zahtjev();
		$start = strtotime($this->input->post('pocetak'));
		$end = strtotime($this->input->post('kraj'));
		
		
		$br_dana=networkdays($start,$end);
		$this->user_model->azuriraj_br_preostalih_dana($preostalo_dana,$br_dana);
		$this->session->set_flashdata('verifi_msg','<div class="alert alert-success text-center">Uspjesno ste poslali zahtjev</div>');
		$this->load->view("templates/header_korisnik");
		$this->load->view('zahtjev_forma');
	}
}
//callback funkcija za validaciju unesenih datuma sa brojem preostalih dana
public function validiraj_datume()
{
	$start = strtotime($this->input->post('pocetak'));
	$end = strtotime($this->input->post('kraj'));
	$br_dana=networkdays($start,$end);//radni dani
	$preostalo_dana=$this->user_model->provjeri_br_dana();
	if($br_dana>$preostalo_dana)
	{
		$this->form_validation->set_message('validiraj_datume','Uzeli ste vise dana odmora nego sto vam je preostalo!');
		$this->session->set_flashdata('verifi_msg','<div class="alert alert-success text-center">Uzeli ste vise dana odmora nego sto vam je preostalo!</div>');
		return FALSE;
	}
	return TRUE;
}
public function validiraj_datume1()
{
	$start = strtotime($this->input->post('pocetak'));
	$today=strtotime('today');
	if($start<$today)
	{
		$this->form_validation->set_message('validiraj_datume','Uzeli ste za pocetak datum prije danasnjeg!');
		$this->session->set_flashdata('verifi_msg','<div class="alert alert-success text-center">Greška! Uzeli ste za pocetak datum prije danasnjeg!</div>');
		return FALSE;
	}
	return TRUE;
}
public function validiraj_poredak()
{
	$start = strtotime($this->input->post('pocetak'));
	$end = strtotime($this->input->post('kraj'));
	if($start>$end)
	{
		$this->form_validation->set_message('validiraj_poredak','Kraj odmora mora biti poslije pocetka!');
		$this->session->set_flashdata('verifi_msg','<div class="alert alert-success text-center">Kraj odmora mora biti poslije pocetka!</div>');
		return FALSE;
	}
	return TRUE;
}
public function validiraj_username()
{
	$username=$this->input->post('menadzer');
	$data=$this->user_model->username_validacija($username);
	if($data==1)
	{
		return TRUE;
	}
	$this->form_validation->set_message('validiraj_username','Navedeni korisnik ne postoji!');
	$this->session->set_flashdata('verifi_msg','<div class="alert alert-success text-center">Navedeni korisnik ne postoji!</div>');
	return FALSE;
}
public function validiraj_presjek()
{
	if($this->user_model->presjek_validacija()==FALSE)
	{
		$this->form_validation->set_message('validiraj_presjek','Datumi se preklapaju sa prethodno uzetim odmorom!');
		$this->session->set_flashdata('verifi_msg','<div class="alert alert-success text-center">Datumi se preklapaju sa prethodno uzetim odmorom!</div>');

	}
	return $this->user_model->presjek_validacija();
}
public function logout()
{
$this->session->sess_destroy();
redirect(site_url());
}
}