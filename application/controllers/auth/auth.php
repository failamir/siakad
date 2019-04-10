<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	private $_guru 	=	"guru";
	private $_admin	=	"admin";
	private $_siswa	=	"siswa";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$data['judul']	=	'Login Siswa';
		$this->load->view('auth/header', $data);
		$this->load->view('auth/login');
		$this->load->view('auth/footer');
	}
	public function siswa()
	{
		$data['judul']	=	'Login Siswa';
		$this->load->view('auth/header', $data);
		$this->load->view('auth/login_siswa');
		$this->load->view('auth/footer');
	}

	public function login_admin()
	{
		$username	=	$this->input->post('username');
		$password	=	$this->input->post('password');
		$where 		=	"username";
		$cek		= $this->login_model->cek_login($this->_admin, $where, $username, $password);
		if ($cek) {
			foreach ($cek as $row) {
				$this->session->set_userdata('username', $row->username);
				redirect(base_url("admin"));
			}
		} else {
			$this->index();
		}
	}

	public function login_siswa()
	{
		$nisn	=	$this->input->post('nisn');
		$password	=	$this->input->post('password');
		$where 		=	"nisn";

		$cek		= $this->login_model->cek_login($this->_siswa, $where, $nisn, $password);
		if ($cek) {
			// DATANYA ADA
			foreach ($cek as $row) {
				$this->session->set_userdata('nisn', $row->nisn);
				$this->session->set_userdata('nama_siswa', $row->nama_siswa);
				$this->session->set_userdata('jenis_kelamin', $row->jenis_kelamin);
				$this->session->set_userdata('username', $row->username);
				redirect(base_url("siswa"));
			}
		} else {
			$this->siswa();
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
