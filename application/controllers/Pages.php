<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array('act_page' => 'dashboard'	);
		$this->load->view('template', $data);
	}
	public function tokenization()
	{
		$data = array('act_page' => 'task1'	);
		$this->load->view('template', $data);
	}
	public function stemming()
	{
		$data = array('act_page' => 'task2'	);
		$this->load->view('template', $data);
	}
	public function stopwords()
	{
		$data = array('act_page' => 'task3'	);
		$this->load->view('template', $data);
	}
	public function summarization()
	{
		$data = array('act_page' => 'task4'	);
		$this->load->view('template', $data);
	}
	public function all()
	{
		$data = array('act_page' => 'task5'	);
		$this->load->view('template', $data);
	}
}
