<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Backup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login' ) {
			redirect('/');
		}
	}
	
	public function index()
	{
		$this->load->dbutil();
		
        $db_name = 'backup-db-'.$this->db->database.'-on-'.date('Y-m-d_h:i:s').'.sql';

		$config = array(
			'format'	=> 'zip',
			'filename'	=> $db_name,
            'add_insert' => TRUE,
            'foreign_key_checks' => FALSE,
		);
		
		$backup = $this->dbutil->backup($config);
		
		$save = './db/'.$db_name;
		
		write_file($save, $backup);
        force_download($db_name, $backup);
	}
}
