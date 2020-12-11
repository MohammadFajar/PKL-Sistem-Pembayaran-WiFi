<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
        parent::__construct();

         //load libary pagination
        $this->load->library('pagination');
        $this->load->model('app_model');
    }

	public function index()
	{
		$this->load->view('login');
	}

	public function ceklogin(){
		if(isset($_POST['login'])){
			$user=$this->input->post('username',true);
			$pass=$this->input->post('password',true);
			$cek=$this->app_model->proseslogin($user, $pass);
			$cekPel=$this->app_model->prosesloginPelanggan($user, $pass);
			$hasil =count( (array) $cek);
			$hasilCekPelanggan=count((array)$cekPel);	

			//session data pelanggan 
			$session_user=array(
							'username'=>$user,
							'password'=>$pass
							);

			if ($hasil > 0) {
				$pelogin=$this->db->get_where('user', array('USERNAME'=>$user, 'PASSWORD'=>$pass))->row();
				if ($pelogin->LEVEL=='admin') {
					redirect('auth/Adm_beranda');
				}elseif ($pelogin->LEVEL=='pegawai') {
					redirect('auth/Peg_beranda');
				}
			}elseif ($hasilCekPelanggan>0) {
				$data_session= array('username'=>$user);
				$this->session->set_userdata($session_user);
				redirect('auth/Pel_beranda');
			}else{
				redirect('auth/index');
			}
		}
	}

	public function Adm_beranda(){
		$data['acc'] =$this->app_model->hitungACC();
		$data['noacc'] = $this->app_model->hitungnoACC();
		$this->load->view('Adm_beranda', $data);
	}

	public function Peg_beranda(){
		//konfigurasi pagination
        $config['base_url'] = site_url('auth/Peg_beranda'); //site url
        $config['total_rows'] = $this->db->count_all('transaksi'); //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

         // Membuat Style pagination untuk BootStrap v4
      	$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page']=($this->uri->segment(3))? $this->uri->segment(3):0;


		$data['transaksi']=$this->app_model->peg_dataTransaksi($config["per_page"], $data['page']);
		$data['pagination']=$this->pagination->create_links();
		$this->load->view('Peg_beranda', $data);
	}

	public function Pel_beranda(){
		$data['riwayat']=$this->app_model->riwayat_transaksi()->result();
		$this->load->view('Pel_beranda', $data);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('auth/index');//'inddex sementara'
	}

	public function Data_user(){
		$this->data['hasil']= $this->app_model->getUser('user');
		$this->load->view('Data_user', $this->data);
	}

	public function formTambah_user(){
		$this->load->view('formTambah_user');
	}

	public function insertUser(){
		$Uname = $_POST['username'];
		$pass = $_POST['password'];
		$level = $_POST['level'];
		$data = array('USERNAME'=>$Uname,  'PASSWORD'=>$pass, 'LEVEL'=>$level);
		$tambah = $this->app_model->tambahData_user('user', $data);
		if ($tambah > 0) {
			redirect('auth/Data_user');
		}else{
			echo "GAGAL";
		}
	}

	public function deleteUser($id){
		$this->app_model->hapusDataUser($id);
		redirect('auth/Data_user');
	}

	public function formEdit_user($id){
		$this->data['dataEditUser'] = $this->app_model->dataEditUser('user', $id);
		$this->load->view('formEdit_user', $this->data);
	}

	
	public function updateUser($id){
		$Uname = $_POST['username'];
		$pass = $_POST['password'];
		$level = $_POST['level'];
		$data = array('USERNAME'=>$Uname,  'PASSWORD'=>$pass, 'LEVEL'=>$level);
		$edit = $this->app_model->editDatauser('user', $data, $id);
		if ($edit > 0) {
			redirect('auth/Data_user');
		}else{
			echo "GAGAL";
		}
	}

	public function Data_paket(){
		$this->data['paket']= $this->app_model->getUser('paket_wifi');
		$this->load->view('Data_paket', $this->data);
	}

	public function formTambah_paket(){
		$this->load->view('formTambah_paket');
	}

	public function insertPaket(){
		$namaPaket = $_POST['namaPaket'];
		$kecepatan = $_POST['kecepatanPaket'];
		$harga = $_POST['hargaPaket'];
		$data = array('NAMA_PAKET'=>$namaPaket,  'KECEPATAN'=>$kecepatan, 'HARGA'=>$harga);
		$tambah = $this->app_model->tambahData_paket('paket_wifi', $data);
		if ($tambah > 0) {
			redirect('auth/Data_paket');
		}else{
			echo "GAGAL";
		}
	}

	public function formEdit_paket($id){
		$this->data['dataEditPaket'] = $this->app_model->dataEditPaket('paket_wifi', $id);
		$this->load->view('formEdit_paket', $this->data);
	}

	
	public function updatePaket($id){
		$namaPaket = $_POST['namaPaket'];
		$kecepatan = $_POST['kecepatanPaket'];
		$harga = $_POST['hargaPaket'];
		$data = array('NAMA_PAKET'=>$namaPaket,  'KECEPATAN'=>$kecepatan, 'HARGA'=>$harga);
		$edit = $this->app_model->editDataPaket('paket_wifi', $data, $id);
		if ($edit > 0) {
			redirect('auth/Data_paket');
		}else{
			echo "GAGAL";
		}
	}

	public function deletePaket($id){
		$this->app_model->hapusDataPaket($id);
		redirect('auth/Data_paket');
	}

	public function Data_pelanggan(){
		$data['pelanggan'] = $this->app_model->dataPelanggan()->result(); 
		/*$this->data['pelanggan']= $this->app_model->getUser('pelanggan');
		$this->load->view('Data_pelanggan', $this->data);*/
		$this->load->view('Data_pelanggan', $data);
	}

	public function formTambah_pelanggan(){
		$this->data['paket'] = $this->app_model->get_paketWifi();
		$this->load->view('formTambah_pelanggan', $this->data);
	}

	public function insertPelanggan(){
		$namaPelanggan = $_POST['namaPelanggan'];
		$alamat = $_POST['alamat'];
		$noTelp = $_POST['noTelp'];
		$idPaket= $_POST['idPaket'];
		$passPel = $_POST['passPel'];
		$data = array('ID_PAKET'=>$idPaket,'NAMA_PELANGGAN'=>$namaPelanggan, 'PASS_PEL'=>$passPel, 'ALAMAT'=>$alamat, 'NO_TELEPON'=>$noTelp);
		$tambah = $this->app_model->tambahData_pelanggan('pelanggan', $data);
		if ($tambah > 0) {
			redirect('auth/Data_pelanggan');
		}else{
			echo "GAGAL";
		}
	}

	public function formEdit_pelanggan($id){
		$this->data['dataEditPelanggan'] = $this->app_model->dataEditPelanggan('pelanggan', $id);
		$this->load->view('formEdit_pelanggan', $this->data);
	}

	
	public function updatePelanggan($id){
		$namaPelanggan = $_POST['namaPelanggan'];
		$alamat = $_POST['alamat'];
		$noTelp = $_POST['noTelp'];
		$passPel = $_POST['passPel'];
		$data = array('NAMA_PELANGGAN'=>$namaPelanggan, 'PASS_PEL'=>$passPel, 'ALAMAT'=>$alamat, 'NO_TELEPON'=>$noTelp);
		$edit = $this->app_model->editDataPelanggan('pelanggan', $data, $id);
		if ($edit > 0) {
			redirect('auth/Data_pelanggan');
		}else{
			echo "GAGAL";
		}
	}

	public function deletePelanggan($id){
		$this->app_model->hapusDataPelanggan($id);
		redirect('auth/Data_pelanggan');
	}


	public function formCari_pelanggan(){
		$data['hasil']=$this->app_model->idPelanggan();
		$this->load->view('formCari_pelanggan', $data);
	}

	public function formBayar_transaksi(){
		$dariDB = $this->app_model->cekIdTransaksi();
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 3, 4);
        $kodeTransaksi = $nourut + 1;
        $data2 = array('ID_TRANSAKSI' => $kodeTransaksi);
		$data2['cari']=$this->app_model->cariPelanggan();
		$data2['paket']=$this->app_model->paketWifi();
		$this->load->view('formBayar_transaksi', $data2);
	}

	public function bayar(){
		$this->app_model->bayarTransaksi();
        redirect('auth/Peg_beranda');
	}

	public function statusTransaksi($id){
		$this->app_model->keteranganTransaksi($id);		
		redirect('auth/formTransaksi_noacc');
	}

	public function Hal_cetakLaporan(){
		$data['tahun']=$this->app_model->getTahun();
		$this->load->view('Hal_cetakLaporan', $data);	
	}

	public function cetak_Laporan(){
		$this->load->view('cetak_Laporan');
	}

	public function filter(){
		$tanggalAwal=$this->input->post('tanggalAwal');
		$tanggalAkhir=$this->input->post('tanggalAkhir');
		$tahun1=$this->input->post('tahun1');
		$bulanAwal=$this->input->post('bulanAwal');
		$bulanAkhir=$this->input->post('bulanAkhir');
		$tahun2=$this->input->post('tahun2');
		$nilaifilter=$this->input->post('nilaifilter');


		if ($nilaifilter==1) {
			$data['title']="Laporan Transaksi Per Tanggal";
			$data['subtitle']="Dari Tanggal : ". $tanggalAwal." Hingga ".$tanggalAkhir;
			$data['datafilter']=$this->app_model->filterbytanggal($tanggalAwal, $tanggalAkhir);
			$this->load->view('cetak_Laporan', $data);

		}elseif($nilaifilter==2) {
			$data['title']="Laporan Transaksi Per Bulan";
			$data['subtitle']="Dari Bulan : ". $bulanAwal." Hingga ".$bulanAkhir." Tahun ". $tahun1;
			$data['datafilter']=$this->app_model->filterbybulan($tahun1, $bulanAwal, $bulanAkhir);
			$this->load->view('cetak_Laporan', $data);

		}elseif($nilaifilter==3) {
			$data['title']="Laporan Transaksi Per Tahun";
			$data['subtitle']="Tahun ". $tahun2;
			$data['datafilter']=$this->app_model->filterbytahun($tahun2);
			$this->load->view('cetak_Laporan', $data);

		}
	}


	public function formTransaksi_acc(){
		//konfigurasi pagination
        $config['base_url'] = site_url('auth/formTransaksi_acc'); //site url
        $config['total_rows'] = $this->db->count_all('transaksi'); //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
      	$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page']=($this->uri->segment(3))? $this->uri->segment(3):0;

		$data['dataTransaksi']=$this->app_model->transaksi_acc($config["per_page"], $data['page']);
		$data['pagination']=$this->pagination->create_links();
		$this->load->view('formTransaksi_acc', $data);
	}

	public function formTransaksi_noacc(){
			//konfigurasi pagination
	        $config['base_url'] = site_url('auth/formTransaksi_noacc'); //site url
	        $config['total_rows'] = $this->db->count_all('transaksi'); //total row
	        $config['per_page'] = 10;  //show record per halaman
	        $config["uri_segment"] = 3;  // uri parameter
	        $choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice);

	        // Membuat Style pagination untuk BootStrap v4
	      	$config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';

	        $this->pagination->initialize($config);
	        $data['page']=($this->uri->segment(3))? $this->uri->segment(3):0;

			$data['dataTransaksi']=$this->app_model->transaksi_noacc($config["per_page"], $data['page']);
			$data['pagination']=$this->pagination->create_links();
			$this->load->view('formTransaksi_noacc', $data);
		}


	/*public function search(){
		$keyword = $this->input->post('keyword');
		$data['products']=$this->product_m->get_product_keyword($keyword);
		$this->load->view('search',$data);
	}*/
}