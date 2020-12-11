<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_model extends CI_Model {

	public function proseslogin($user, $pass){
		$this->db->where('USERNAME', $user);
		$this->db->where('PASSWORD', $pass);
		return $this->db->get('user')->row();
	}

	public function prosesloginPelanggan($user1,$pass1){
		$this->db->where('NAMA_PELANGGAN', $user1);
		$this->db->where('PASS_PEL',$pass1);
		return $this->db->get('pelanggan')->row();
	}

	function cek_login($table, $session_user){
		return $this->db->get_where($table, $session_user);
	}

	public function getUser($table_name){
		$get_user= $this->db->get($table_name);
		return $get_user->result_array();
	}


	public function tambahData_user($table_name, $data){
		$tambah =$this->db->insert($table_name, $data);
		return $tambah;
	}

	public function editDataUser($table_name, $data, $id){
		$this->db->where('ID_USER', $id);
		$edit = $this->db->update($table_name, $data );
		return $edit;
	}

	public function dataEditUser($table_name, $id){
		$this->db->where('ID_USER',$id);
		$get_user= $this->db->get($table_name);
		return $get_user->row();
	}	

	public function hapusDataUser($id){
		$this->db->delete('user', ['ID_USER'=>$id]);
	}
	
	public function tambahData_paket($table_name, $data){
		$tambah =$this->db->insert($table_name, $data);
		return $tambah;
	}

	public function editDataPaket($table_name, $data, $id){
		$this->db->where('ID_PAKET', $id);
		$edit = $this->db->update($table_name, $data );
		return $edit;
	}

	public function dataEditPaket($table_name, $id){
		$this->db->where('ID_PAKET',$id);
		$get_user= $this->db->get($table_name);
		return $get_user->row();
	}	

	public function hapusDataPaket($id){
		$this->db->delete('paket_wifi', ['ID_PAKET'=>$id]);
	}

	public function tambahData_pelanggan($table_name, $data){
		$tambah =$this->db->insert($table_name, $data);
		return $tambah;
	}

	public function editDataPelanggan($table_name, $data, $id){
		$this->db->where('ID_PELANGGAN', $id);
		$edit = $this->db->update($table_name, $data );
		return $edit;
	}

	public function dataEditPelanggan($table_name, $id){
		$this->db->where('ID_PELANGGAN',$id);
		$get_user= $this->db->get($table_name);
		return $get_user->row();
	}	

	public function hapusDataPelanggan($id){
		$this->db->delete('pelanggan', ['ID_PELANGGAN'=>$id]);
	}

	public function idPelanggan(){
		$this->db->order_by('ID_PELANGGAN','ASC');
		return $this->db->from('pelanggan')
		->get()	
		->result();
	}

	public function cariPelanggan(){
		$cari=$this->input->GET('idPelanggan', TRUE);
		$data=$this->db->query("SELECT * from pelanggan where ID_PELANGGAN like '%$cari%'");
		return $data->result();
	}

	public function paketWifi(){
		$id=$this->input->GET('idPelanggan', TRUE);
		$cari=array('pelanggan.ID_PELANGGAN'=>$id);
		$this->db->select('*');
		$this->db->from('paket_wifi');
		$this->db->join('pelanggan','paket_wifi.ID_PAKET=pelanggan.ID_PAKET');
		$this->db->where($cari);
		$query = $this->db->get();
		return $query->result();
	}

 	public function cekIdTransaksi()
    {
        $query = $this->db->query("SELECT MAX(ID_TRANSAKSI) as idtransaksi from transaksi");
        $hasil = $query->row();
        return $hasil->idtransaksi;
    }

    public $ID_TRANSAKSI;
	public $ID_PELANGGAN;
	public $JENIS_TRANSAKSI;
	public $JENIS_PEMBAYARAN;
	public $TANGGAL_PEMBAYARAN;
	public $NOMINAL;
	public $KETERANGAN;

	public function bayarTransaksi(){
		$this->ID_TRANSAKSI=$_POST['idTransaksi'];
		$this->ID_PELANGGAN=$_POST['idPelanggan'];
		$this->JENIS_TRANSAKSI=$_POST['jTransaksi'];
		$this->JENIS_PEMBAYARAN=$_POST['jPembayaran'];
		$this->TANGGAL_PEMBAYARAN=$_POST['tgl'];
		$this->NOMINAL=$_POST['total'];
		$this->KETERANGAN=$_POST['keterangan'];

		$this->db->insert('transaksi', $this);
	}

	//data pada admin
	public function transaksi_acc($limit, $start){
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->join('transaksi','pelanggan.ID_PELANGGAN=transaksi.ID_PELANGGAN');
		$this->db->where('KETERANGAN','ACC');
		$this->db->order_by('ID_TRANSAKSI', 'DESC');
		$this->db->limit($limit, $start);
		$query=$this->db->get();
		return $query;
	}

	public function transaksi_noacc($limit, $start){
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->join('transaksi','pelanggan.ID_PELANGGAN=transaksi.ID_PELANGGAN');
		$this->db->where('KETERANGAN','Belum TER-ACC');
		$this->db->order_by('ID_TRANSAKSI', 'DESC');
		$this->db->limit($limit, $start);
		$query=$this->db->get();
		return $query;
	}

	//function hitung data ACC
	function hitungACC(){
		$this->db->where('KETERANGAN', 'ACC');
		$this->db->from('transaksi');
		return $this->db->count_all_results();
	}

	//function hitung data ACC
	function hitungnoACC(){
		$this->db->like('KETERANGAN', 'Belum Ter-ACC');
		$this->db->from('transaksi');
		return $this->db->count_all_results();
	}

	//data transaksi pada pegawai
	public function peg_dataTransaksi($limit1, $start1){
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->join('transaksi','pelanggan.ID_PELANGGAN=transaksi.ID_PELANGGAN');
		$this->db->order_by('ID_TRANSAKSI', 'DESC');
		$this->db->limit($limit1, $start1);
		$query=$this->db->get();
		return $query;
	}

	public function get_paketWifi(){
	 $query = $this->db->get('paket_wifi')->result();
	 return $query;
	}

	public function dataPelanggan(){
		$this->db->select('*');
		$this->db->from('paket_wifi');
		$this->db->join('pelanggan','paket_wifi.ID_PAKET=pelanggan.ID_PAKET');
		$this->db->order_by('pelanggan.ID_PELANGGAN', 'DESC');
		$query=$this->db->get();
		return $query;
	}

	public function keteranganTransaksi($id){
		$data=array('KETERANGAN'=>'ACC');
		$this->db->where('ID_TRANSAKSI',$id);
		$this->db->update('transaksi', $data);	
	}


	public function getTahun(){
		$query=$this->db->query("SELECT YEAR(TANGGAL_PEMBAYARAN) AS tahun FROM transaksi GROUP BY YEAR(TANGGAL_PEMBAYARAN) ORDER BY YEAR(TANGGAL_PEMBAYARAN) ASC");
		return $query->result();
	}

	public function filterbytanggal($tanggalAwal, $tanggalAkhir){
		$query=$this->db->query("SELECT * FROM pelanggan join transaksi where pelanggan.ID_PELANGGAN=transaksi.ID_PELANGGAN AND TANGGAL_PEMBAYARAN BETWEEN '$tanggalAwal' and '$tanggalAkhir' AND KETERANGAN ='ACC' order by TANGGAL_PEMBAYARAN ASC");
		return $query->result();
	}

	public function filterbybulan($tahun1, $bulanAwal, $bulanAkhir){
		$query=$this->db->query("SELECT * FROM pelanggan  join transaksi where pelanggan.ID_PELANGGAN=transaksi.ID_PELANGGAN AND YEAR(TANGGAL_PEMBAYARAN)= '$tahun1' AND MONTH(TANGGAL_PEMBAYARAN) BETWEEN '$bulanAwal' and '$bulanAkhir' AND KETERANGAN ='ACC' order by TANGGAL_PEMBAYARAN ASC");
		return $query->result();
	}

	public function filterbytahun($tahun2){
		$query=$this->db->query("SELECT * FROM pelanggan join transaksi where pelanggan.ID_PELANGGAN=transaksi.ID_PELANGGAN AND YEAR(TANGGAL_PEMBAYARAN)= '$tahun2' AND KETERANGAN ='ACC' order by TANGGAL_PEMBAYARAN ASC");
		return $query->result();
	}

	public function riwayat_transaksi(){
		$nama= $this->session->userdata('username');
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->join('transaksi','pelanggan.ID_PELANGGAN=transaksi.ID_PELANGGAN');
		$this->db->where('NAMA_PELANGGAN', $nama);
		$this->db->order_by('ID_TRANSAKSI', 'DESC');
		$query=$this->db->get();
		return $query;
	}

}