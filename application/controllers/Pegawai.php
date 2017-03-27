<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pegawai_model');
	}

	public function index()
	{
		$data["pegawai_list"] = $this->pegawai_model->getDataPegawai();
		$this->load->view('pegawai',$data);	
	}

	public function create()
	{
		$this->validation();
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_pegawai_view');

		}else{
			$this->pegawai_model->insertPegawai();
			$this->session->set_flashdata('pesan', 'Tambah Data Berhasil pegawai');
			redirect('pegawai');
		}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($id)
	{
		$this->validation();
		$data['pegawai']=$this->pegawai_model->getPegawai($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_pegawai_view',$data);

		}else{
			$this->pegawai_model->updateById($id);
			$this->session->set_flashdata('pesan', 'Ubah Data Berhasil Pegawai '.$id);
			redirect('pegawai');
		}
	}

	public function delete($id)
	{
		$this->pegawai_model->delete($id);
		$this->index();
	}
	public function validation(){
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nip', 'Nip', 'trim|required|numeric');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */

 ?>