<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	private $_tblpengumuman	= "pengumuman";
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['judul'] = 'SMAN 4 MACIPO';

		//$this->db->order_by('tanggal', 'DESC');
		//$data['user']	=	$this->db->get($this->_tblpengumuman)->result();

		$this->load->view('template_home/header', $data);
		$this->load->view('template_home/navbar');
		$this->load->view('template_home/index');
		$this->load->view('template_home/footer');
	}
}