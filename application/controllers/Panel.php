<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {
	public function index()
	{
        $this->load->view('includes/header');
        $this->load->view('panel');
        $this->load->view('includes/footer');
	}
}
