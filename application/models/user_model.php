<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
public function __construct()
{
parent::__construct();
$this->load->database();
$this->load->helper('my_helper');
}
public function register_user()
{
$data=array(
'username'=>$this->input->post('username'),
'email'=>$this->input->post('email'),
'password'=>md5($this->input->post('password')),
'gender'=>$this->input->post('gender'),
'br_dana_odmora'=>$this->input->post('br_dana_odmora'),
'preostalo_dana'=>$this->input->post('br_dana_odmora'),
'id_sektora'=>$this->session->userdata('id_sektora')

);
$this->db->insert('users',$data);
return true;
}
function login($email,$password)
{
$this->db->where("email",$email);
$this->db->where("password",md5($password));
$query=$this->db->get("users");
if($query->num_rows()>0)
{
$row=$query->row();
$userdata = array(
'user_id'  => $row->id,
'username'  => $row->username,
'email'    => $row->email,
'uloga'	=>$row->uloga,
'id_sektora'=>$row->id_sektora
);
$this->session->set_userdata($userdata);
return true;
}
return false;
}
public function unesi_zahtjev()
{
	$start = strtotime($this->input->post('pocetak'));
	$end = strtotime($this->input->post('kraj'));
	$radnih_dana=networkdays($start,$end);
	$s1=$this->input->post('pocetak');
	$s2=$this->input->post('kraj');
	$s1=date("d.m.Y",strtotime($s1));
	$s2=date("d.m.Y",strtotime($s2));
	
	
	$data=array(
		'pk_podnosilac'=>$this->session->userdata('user_id'),
		'pocetak'=>$s1,
		'kraj'=>$s2,
		'dana'=>$radnih_dana,
		'napomena'=>$this->input->post('komentar')
	);
	$this->db->insert('zahtjevi',$data);
	
	
	return true;
}
public function unesi_zahtjev_bolovanje()
{
	$start = strtotime($this->input->post('pocetak'));
	$end = strtotime($this->input->post('kraj'));
	$radnih_dana=networkdays($start,$end);
	$s1=$this->input->post('pocetak');
	$s2=$this->input->post('kraj');
	$s1=date("d.m.Y",strtotime($s1));
	$s2=date("d.m.Y",strtotime($s2));
	
	
	$data=array(
		'pk_podnosilac'=>$this->session->userdata('user_id'),
		'pocetak'=>$s1,
		'kraj'=>$s2,
		'dana'=>$radnih_dana,
		'napomena'=>$this->input->post('komentar'),
		'status'=>'',
		'tip'=>'Bolovanje'
	);
	$this->db->insert('zahtjevi',$data);
	
	
	return true;
}
public function provjeri_br_dana()
{
	$user_id=$this->session->userdata('user_id');
	$this->db->where("id",$user_id);
	$query=$this->db->get("users");
	$row=$query->row();
	$br_dana= $row->preostalo_dana;
	return $br_dana;
}
public function azuriraj_br_preostalih_dana($trenutno_prostalo,$radnih_dana)
{
	$data1=array(
			'preostalo_dana'=>$trenutno_prostalo-$radnih_dana
	);
	$user_id=$this->session->userdata('user_id');
	$this->db->where('id',$user_id);
	$this->db->update('users',$data1);
	return true;
}
public function promjena_uloge()
{
	$uloga=$this->input->post('uloga');
	$username=$this->input->post('menadzer');
	$data=array(
			'uloga'=>$uloga
	);
	$this->db->where('username',$username);
	$this->db->update('users',$data);
}
public function dodavanje_sektora()
{
	$naziv=$this->input->post('naziv_sektora');
	$manager=$this->input->post('menadzer');
	
	/*$sql1="insert into sektori(naziv)
			values($naziv1)";
	$query = $this->db->query($sql1);*/
	
	$data=array(
			'naziv'=>$naziv
	);
	//$this->db->where('naziv',$naziv);
	$this->db->insert('sektori',$data);
	
	
	
}
public function update_id_sektora()
{
	$naziv=$this->input->post('naziv_sektora');
	$username=$this->input->post('menadzer');

	$this->db->select('id');
	$this->db->where('naziv',$naziv);
	$query = $this->db->get('sektori');
	foreach ($query->result_array() as $row)
	{
	   $id= $row['id'];
	}
	
	$data=array(
		'uloga'=>'manager',
		'id_sektora'=>$id
	);
	$this->db->where('username',$username);
	$this->db->update('users',$data);
}
public function remove_user()
{
	$id=$this->input->post('id');
	/*$sql="delete from users u
		where u.id=$id";
	$query = $this->db->query($sql);*/
	$this->db->delete('users', array('id' => $id)); 
}

 public function select()  
 {  
          
		 $this->db->where('id_sektora',$this->session->userdata('id_sektora'));
         $query = $this->db->get('users');  
         return $query;  
}
public function select_na_odmoru()
{
	$id=$this->session->userdata('id_sektora');
	$sql="select u.username,z.pocetak,z.kraj
		from users u, zahtjevi z
		where z.pk_podnosilac=u.id and u.na_odmoru=TRUE and u.id_sektora=$id";
	$query = $this->db->query($sql);

    return $query;
}
public function select_cekanje()
{
	/*$this->db->select('*');
	$this->db->from('zahtjevi z');
	$this->db->join('users u','z.pk_podnosilac=u.id');
	$this->db->where('u.id_sektora',$this->session->userdata('id_sektora'));*/
	$id=$this->session->userdata('id_sektora');

	$sql1="select z.*, u.username
			from zahtjevi z, users u
			where u.id=z.pk_podnosilac and u.id_sektora=$id";
	//$query = $this->db->get();  
	$query = $this->db->query($sql1);

    return $query;
}
public function update_zahtjevi_na_cekanju()
{
	
	$status=$this->input->post('akcija');
	$id_zahtjeva=$this->input->post('id_zahtjeva');
	$sql="select *
		from zahtjevi
		where id_zahtjeva=$id_zahtjeva";
	$query=$this->db->query($sql);
	$res=$query->result();
	$row=$res[0];
	$pk_podnosilac=$row->pk_podnosilac;
	$pk_odobrio=$this->session->userdata('user_id');
	if($status=='Odobri')
	{
		$sql1="update zahtjevi
				set status='Approved',pk_odobrio=$pk_odobrio
				where id_zahtjeva=$id_zahtjeva";
		$sql2="update users
			set na_odmoru=TRUE
			where id=$pk_podnosilac";
		$query = $this->db->query($sql1);
		$query = $this->db->query($sql2);
	}
	else
	{
		$sql1="update zahtjevi
				set status='Declined'
				where id_zahtjeva=$id_zahtjeva";
		$query = $this->db->query($sql1);		
	}
	
}
public function select_historija_zahtjeva()
{
	$id=$this->session->userdata('user_id');
	$sql="select * from zahtjevi
			where pk_podnosilac=$id";
	$query = $this->db->query($sql);
	return $query;	
}
public function username_validacija($username)
{
	$this->db->select('id');
	$this->db->where('username',$username);
	$query = $this->db->get('users');
	return $query->num_rows();
	/*if($query->num_rows()=1)
	{
		return TRUE;
	}
	return FALSE;*/
}
public function presjek_validacija()
{
	$id=$this->session->userdata('user_id');
	//$p2 = strtotime($this->input->post('pocetak'));
	//$k2 = strtotime($this->input->post('kraj'));
	$p2=$this->input->post('pocetak');
	$k2=$this->input->post('kraj');
	//$p2=date("d.m.Y",strtotime($p2));
	//$k2=date("d.m.Y",strtotime($k2));
	$sql="select pocetak,kraj
		from zahtjevi
		where pk_podnosilac=$id";
	$query = $this->db->query($sql);
	foreach ($query->result() as $row)
	{
		$p1=$row->pocetak;
		$k1=$row->kraj;
		if($p1 <= $k2 && $k1 >= $p2)
		{
			return false;
		}
	}
	return true;
		
}	
}