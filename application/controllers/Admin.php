<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function __construct(){


		parent::__construct();

		if ($this->session->userdata('role_id') != 1 ) {
			redirect('auth/blocked');
		}

	}


	public function index(){
		$bln = date("m");
		$bln2 = date("m");
		$data['pengguna_sekarang'] = $this->db->query("SELECT count(id_pelanggan) as jumlah_pelanggan FROM pelanggan where status = 4 OR status = 3 and MONTH(tgl_mulai) = '$bln'")->row_array();

		$data['pengguna_kemarin'] = $this->db->query("SELECT count(id_pelanggan) as jumlah_pelanggan FROM pelanggan where status = 4 OR status = 3 and YEAR(tgl_mulai) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
			AND MONTH(tgl_mulai) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)")->row_array();

		$data['pendapatan_sekarang'] = $this->db->query("SELECT sum(total_bayar) as bayar1 FROM pelanggan where status = 4 OR status = 3 and MONTH(tgl_mulai) = '$bln'")->row_array();

		$data['pendapatan_kemarin'] = $this->db->query("SELECT sum(total_bayar) as bayar2 FROM pelanggan where status = 4 OR status = 3  and YEAR(tgl_mulai) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
			AND MONTH(tgl_mulai) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)")->row_array();

		$data['paket'] = $this->db->query("SELECT *, count(id_pelanggan) as jumlahPaket from pelanggan p join layanan g on g.id_layanan = p.id_layanan where MONTH(p.tgl_mulai) = '$bln2' and p.status = 3 or p.status = 4 group by g.id_layanan")->result();
		$data['kk'] = 'index';

		$data['grafik_pendapatan'] = $this->db->query("SELECT sum(total_bayar) as bayar, MONTH(tgl_mulai) as bulan from pelanggan where status = 3 or status = 4 group by month(tgl_mulai)")->result();

		$data['grafik_pengguna'] = $this->db->query("SELECT count(id_pelanggan) as pengguna, MONTH(tgl_mulai) as bulan from pelanggan where status = 3 or status = 4 group by month(tgl_mulai)")->result();

		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/pemilik/dashboard',$data);
		$this->load->view('admin/template/footer');
	}
	//  function diskon mulai
	public function diskon(){
		$data['kk'] = 'diskon';
		$data['diskon'] = $this->db->query("SELECT * FROM diskon")->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/pemilik/diskon',$data);
		$this->load->view('admin/template/footer');
	}

	public function simpanDiskon(){
		$nama = $this->input->post('nama_diskon');
		$hari = $this->input->post('lama_diskon');
		$diskon = $this->input->post('diskon');
		$keterangan = $this->input->post('keterangan');

		$query = $this->db->query("INSERT into diskon VALUES(null,'$nama',$hari,$diskon,'$keterangan')");

		if($query){
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Diskon Berhasil ditambahkan</div>');
			header('location:'.base_url().'admin/diskon');
		}

	}

	public function editDiskon($id){

		$nama = $this->input->post('nama_diskon');
		$hari = $this->input->post('lama_diskon');
		$diskon = $this->input->post('diskon');
		$keterangan = $this->input->post('keterangan');

		$query = $this->db->query("UPDATE diskon SET nama_diskon = '$nama', hari = '$hari', diskon = '$diskon', keterangan = '$keterangan' WHERE id_diskon = '$id'");

		if ($query) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Diskon Berhasil diubah</div>');
			header('location:'.base_url().'admin/diskon');
		}
	}

	public function hapusDiskon($id){
		$query = $this->db->query("DELETE FROM diskon where id_diskon = $id");

		if($query){
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Diskon Berhasil dihapus</div>');
			header('location:'.base_url().'admin/diskon');
		}
	}

	// function diskon akhir

	// function kelola admin mulai

	public function kelola_admin(){

		$data['kk'] = 'admin';

		$data['admin'] = $this->db->query("SELECT * FROM user where role_id = 2")->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/pemilik/kelola_admin',$data);
		$this->load->view('admin/template/footer');
	}

	public function simpanAdmin(){
		$nama = $this->input->post('nama_admin');
		$gambar = 'default.jpg';
		$role_id = 2;
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		$query1 = $this->db->query("SELECT * FROM user where name = '$nama'");
		if($query1->num_rows() > 0 ){
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">nama pengelola telah terdaftar</div>');
			header('location:'.base_url().'admin/kelola_admin');
		}else{
			$query = $this->db->query("INSERT into user VALUES(null,'$nama','$gambar','$password',$role_id)");

			if($query){
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data pengelola Berhasil ditambahkan</div>');
				header('location:'.base_url().'admin/kelola_admin');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">data pengelola gagal ditambahkan</div>');
				header('location:'.base_url().'admin/kelola_admin');
			}
		}


	}

	public function editAdmin($id){

		$nama = $this->input->post('nama_admin');
		$query1 = $this->db->query("SELECT * FROM user where name = '$nama'");
		if($query1->num_rows() > 0 ){
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">nama pengelola telah terdaftar</div>');
			header('location:'.base_url().'admin/kelola_admin');
		}else{
			$query = $this->db->query("UPDATE user SET name = '$nama' WHERE id_user = '$id'");
			if ($query) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data pengelola Berhasil diubah</div>');
				header('location:'.base_url().'admin/kelola_admin');
			}
		}
	}

	public function hapusAdmin($id){
		$query = $this->db->query("DELETE FROM user where id_user = $id");

		if($query){
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data pengelola Berhasil dihapus</div>');
			header('location:'.base_url().'admin/kelola_admin');
		}
	}


	// function kelola admin akhir

	//function kelola harga mulai

	public function kelolaHarga(){
		$data['kk'] = 'harga';
		$data['harga'] = $this->db->query("SELECT * FROM layanan")->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/pemilik/kelola_harga',$data);
		$this->load->view('admin/template/footer');
	}

	public function simpanHarga(){

		if(!empty($_FILES['gambar']['name'])){
			$config['upload_path'] = './upload/layanan/';
            //restrict uploads to this mime types
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 20480;
			$config['file_name'] = $_FILES['gambar']['name'];


            //Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$this->upload->do_upload('gambar');
			$uploadGambar = $this->upload->data();
			$filename = $uploadGambar['file_name'];

			$file['nama_layanan'] = $this->input->post("nama_layanan");
			$file['deskripsi'] = $this->input->post('deskripsi');
			$file['harga_reservasi'] = $this->input->post('harga');
			$file['fasilitas'] = $this->input->post('fasilitas');
			$file['gambar'] = $filename;
			$query = $this->db->insert('layanan',$file);
			if($query){
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">harga reservasi berhasil ditambahkan</div>');
				header('location:'.base_url().'admin/kelolaHarga');
			}
			else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">harga reservasi gagal ditambahkan</div>');
				header('location:'.base_url().'admin/kelolaHarga');
			}
		}else{

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">harga reservasi gagal ditambahkan</div>');
			header('location:'.base_url().'admin/kelolaHarga');
		}
	}

	public function editHarga($id){

		$query12 = $this->db->query("SELECT gambar from layanan where id_layanan = $id")->row_array();

		$gbr1 = $query12['gambar'];

		if(!empty($_FILES['gambar']['name'])){
			$config['upload_path'] = './upload/layanan/';
            //restrict uploads to this mime types
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 20480;
			$config['file_name'] = $_FILES['gambar']['name'];


            //Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$this->upload->do_upload('gambar');
			$uploadGambar = $this->upload->data();
			$filename = $uploadGambar['file_name'];

			$nama = $this->input->post("nama_layanan");
			$harga = $this->input->post("harga");
			$fasilitas = $this->input->post("fasilitas");
			$deskripsi = $this->input->post("deskripsi");
			$gbr = $filename;
			unlink(FCPATH . 'upload/layanan/' . $gbr1);
			$query = $this->db->query("UPDATE layanan SET nama_layanan = '$nama', harga_reservasi = '$harga', fasilitas = '$fasilitas',deskripsi='$deskripsi',gambar='$gbr' where id_layanan = $id");
			if($query){
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">harga reservasi berhasil diubah</div>');
				header('location:'.base_url().'admin/kelolaHarga');
			}
			else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">isi reservasi gagal diubah</div>');
				header('location:'.base_url().'admin/kelolaHarga');
			}
		}else{

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">gambar reservasi gagal diubah</div>');
			header('location:'.base_url().'admin/kelolaHarga');
		}
	}

	public function hapusHarga($id){
		$query = $this->db->query("DELETE FROM layanan where id_layanan = $id");

		if($query){
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data layanan Berhasil dihapus</div>');
			header('location:'.base_url().'admin/kelolaHarga');
		}
	}


	//function kelola harga akhir

	public function laporan_keuangan(){
		$bln = date('m');
		$data['keuangan_lapor'] = $this->db->query("SELECT * FROM pelanggan  p join layanan g on g.id_layanan = p.id_layanan where  MONTH(p.tgl_mulai) = '$bln' and p.status = 3 or p.status = 4")->result();
		$data['pendapatan_sekarang'] = $this->db->query("SELECT sum(total_bayar) as bayar1 FROM pelanggan where status = 4 OR status = 3 and MONTH(tgl_mulai) = '$bln'")->row_array();
		$data['kk'] = 'keuangan';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/pemilik/laporan_keuangan',$data);
		$this->load->view('admin/template/footer');
	}
}