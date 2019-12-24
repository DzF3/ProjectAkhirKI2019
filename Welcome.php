<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->view('welcome_message');
	}

	public function gost()
	{
		$this->load->library('encryption', 'gost');
		$code = '';

		if (isset($_POST['enc'])) {
			$file = $_FILES['berkas']['tmp_name'];
			$h = file_get_contents($file);
			$code = $this->encryption->encrypt($h);
		} else if (isset($_POST['dec'])) {
			$data = $this->encryption->decrypt($_POST['code']);
			$f = date('dmyhis');
			$s = file_put_contents('file/'.$f.'.jpg', $data);
			header('Content-type: image/jpg');
			echo file_get_contents('file/'.$f.'.jpg');
			die;
		}

		$this->load->view('welcome_message', ['code' => $code]);
		// echo $data;
		// echo '<br>';
		// echo $d = $this->encryption->encrypt($data);
		// echo '<br>';
		// echo $this->encryption->decrypt($d);
	}
}
