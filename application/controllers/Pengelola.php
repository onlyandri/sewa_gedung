<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengelola extends CI_Controller {


	public function __construct(){


		parent::__construct();

		if ($this->session->userdata('role_id') != 2) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">forbidden</div>');
			redirect('auth');
		}

	}


	public function index(){
		$data['kk'] = 'beranda';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/pengelola/dashboard');
		$this->load->view('admin/template/footer');
	}

	public function caripelanggan(){

		$nik = $this->input->post("nik");
		$nomor = $this->input->post("nomor");

		$output ='';
		$tombol = '';
		$tombol2 = '';

		$query = $this->db->query("SELECT * FROM pelanggan p join layanan g on g.id_layanan = p.id_layanan WHERE p.nomor_reservasi = '$nomor' and p.nik = '$nik'")->row_array();

		if($query){

			$bayarTampil = number_format($query['total_bayar'],0,'.','.');

			if ($query['status'] == 1) {
				$status = 'belum bayar';
				$color = 'red';
				$tombol .= '<a href="'.base_url('pengelola/konfirmasi/').''.$query['nomor_reservasi'].'" type="button" class="btn btn-primary m-4" id=""> <i class="fas fa-edit"></i> &nbsp;Konfirmasi Bayar
				</a> ';
				$tombol2 .= '<a href="'.base_url('pengelola/hapusSewa/').''.$query['id_pelanggan'].'" type="button" class="btn btn-danger m-4" id=""> <i class="fas fa-edit"></i> &nbsp;Hapus pelanggan
				</a> ';
			}else if($query['status'] == 2){
				$status = 'telah dibatalkan';
				$color = 'blue';
				$tombol .= '<a href="'.base_url('pengelola/konfirmasi/').''.$query['nomor_reservasi'].'" type="button" class="btn btn-primary m-4" id=""> <i class="fas fa-edit"></i> &nbsp;Konfirmasi reservasi
				</a> ';
				$tombol2 .= '<a href="'.base_url('pengelola/hapusSewa/').''.$query['id_pelanggan'].'" type="button" class="btn btn-danger m-4" id=""> <i class="fas fa-trash"></i> &nbsp;Hapus pelanggan
				</a> ';
			}else if($query['status'] == 4){
				$status = 'dibatalkan sudah bayar';
				$color = 'violet';
				$tombol .= '<a href="'.base_url('pengelola/konfirmasi/').''.$query['nomor_reservasi'].'" type="button" class="btn btn-primary m-4" id=""> <i class="fas fa-edit"></i> &nbsp;Konfirmasi Lagi
				</a> ';
				$tombol2 .= '';
			}else{
				$status = 'sudah bayar';
				$color = 'green';
				$tombol .= '<a href="'.base_url('pengelola/cetakBukti/').''.$query['nomor_reservasi'].'" type="button" class="btn btn-success m-4" id=""> <i class="fas fa-print"></i> &nbsp;Cetak Bukti
				</a> ';
				$tombol2 .= '<a href="'.base_url('pengelola/batalSewa/').''.$query['id_pelanggan'].'" type="button" class="btn btn-danger m-4" id=""> <i class="fas fa-trash"></i> &nbsp;Batalkan reservasi
				</a> ';
			}

			$output .='

			<div class="col-xs-12">
			<div class="col-xs-4">
			<p>&nbsp</p>
			</div>
			<div class="col-xs-6">
			<div class="card">
			<!-- /.card-header -->
			<div class="card-body">
			<div class="h4 text-center">Data pelanggan layanan</div>
			<div class="h4"></div>
			<div class="row mt-5">
			<div class="col-xs-5" style="right: 0">
			<h5>NOMOR reservasi </h5>
			<h5>NIK </h5>
			<h5>NAMA pelanggan</h5>
			<h5>NO HP </h5>
			<h5>LAYANAN</h5>
			<h5>TANGGAL MULAI</h5>
			<h5>TANGGAL SELESAI </h5>
			<h5>LAMA reservasi </h5>
			<h5>TOTAL BAYAR </h5>
			<h5>STATUS </h5>
			</div>
			<div class="col-xs-4">
			<h5> &nbsp :  &nbsp '.$query['nomor_reservasi'].'</h5>
			<h5> &nbsp :  &nbsp '.$query['nik'].'<h5>
			<h5 style="text-transform: capitalize;"> &nbsp :  &nbsp '.$query['nama_pelanggan'].'</h5>
			<h5> &nbsp :  &nbsp '.$query['no_hp'].' </h5>
			<h5> &nbsp :  &nbsp '.$query['nama_layanan'].'</h5>
			<h5> &nbsp :  &nbsp '.$query['tgl_mulai'].'</h5>
			<h5> &nbsp :  &nbsp '.$query['tgl_akhir'].'</h5>
			<h5> &nbsp :  &nbsp '.$query['lama_reservasi'].' Hari</h5>
			<h5> &nbsp :  &nbsp Rp '.$bayarTampil.'</h5>
			<h5 style="color:'.$color.'"> &nbsp :  &nbsp '.$status.'</h5>
			</div>
			</div>
			</div>
			<div class="card-footer text-center">
			'.$tombol.'
			'.$tombol2.'
			</div>
			<!-- /.card-body -->
			</div>
			</div>
			</div>

			';
		}else{
			$output .= '

			<div><p>tidak ada data</p></div>
			';
		}

		echo $output;

	}

	public function konfirmasi($nomor){
		$query = $this->db->query("SELECT * FROM pelanggan WHERE NOMOR_reservasi = '$nomor'")->row_array();

		if($query){

			$id_pelanggan = $query['id_pelanggan'];
			$tgl1 = new DateTime($query['tgl_mulai']);
			$tgl2 = new DateTime($query['tgl_akhir']);

			$tglm = new DateTime($query['tgl_mulai']);
			$tgla = new DateTime($query['tgl_akhir']);

			$sekarang = Time();

			$tgl3 =  strtotime($query['tgl_mulai']);

			$diff = $tgl3 - $sekarang;

			$perbedaan = floor($diff/(60*60*24));

			if($perbedaan < 0){

				$q = $this->db->query("UPDATE pelanggan set status = 2 where nomor_reservasi = '$nomor'");
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">tanggal pelangganan telah kadaluarsa</div>');
				header('location:'.base_url().'pengelola/');
			}else{
				for ($i=$tgl1; $i <= $tgl2; $i->modify('+1 day')) { 
					$tgl = $i->format('Y-m-d');
					$query2 = $this->db->query("SELECT * FROM reservasi WHERE tgl_reservasi = '$tgl'");
					if($query2->num_rows() > 0){
						break;
					}
				}

				if($query2->num_rows() > 0){
					$q = $this->db->query("UPDATE pelanggan set status = 2 where nomor_reservasi = '$nomor'");
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">tanggal telah terkonfirmasi untuk pelanggan lain</div>');
					header('location:'.base_url().'pengelola/');
				}else{
					for ($i=$tglm; $i <= $tgla; $i->modify('+1 day')) { 
						$tglh = $i->format('Y-m-d');
						$querySewa = $this->db->query("INSERT INTO reservasi VALUES(null,$id_pelanggan,'$tglh')");
						$queryBatal = $this->db->query("UPDATE pelanggan SET status = 2 where tgl_mulai = '$tglh' or tgl_akhir = '$tglh' and id_pelanggan != $id_pelanggan");
					}
					$q = $this->db->query("UPDATE pelanggan set status = 3 where nomor_reservasi = '$nomor'");
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembayaran terkonfirmasi</div>');
					header('location:'.base_url().'pengelola/cetakBukti/'.$nomor);
				}
			}
		}
	}

	public function cetakBukti($nomor){

		$data['bukti'] = $this->db->query("SELECT * from pelanggan p join layanan g on p.id_layanan = g.id_layanan where p.nomor_reservasi = '$nomor'")->row_array();

		$this->load->view('admin/cetakBukti',$data);
	}
	public function batalSewa($id){

		$query = $this->db->query("UPDATE pelanggan set status = 4 where id_pelanggan = $id");
		$query2 = $this->db->query("DELETE FROM reservasi WHERE id_pelanggan = $id");

		if($query && $query2){
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">reservasi Telah Dibatalkan</div>');
			header('location:'.base_url().'pengelola/');
		}
	}

	public function hapusSewa($id){

		$query2 = $this->db->query("DELETE FROM pelanggan WHERE id_pelanggan = $id");

		if($query2){
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">reservasi Telah dihapus</div>');
			header('location:'.base_url().'pengelola/');
		}
	}

	public function kelola_pelanggan(){
		$data['kk'] = 'kelolaPelanggan';
		$data['pelanggan'] = $this->db->query("SELECT * FROM pelanggan p join layanan g on p.id_layanan = g.id_layanan")->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/pengelola/kelola_pelanggan');
		$this->load->view('admin/template/footer');
	}

	public function kelola_fasilitas(){
		$data['kk'] = 'kelolafasilitas';

		$data['fasilitas'] = $this->db->query("SELECT * from fasilitas")->result();

		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/pengelola/kelola_fasilitas');
		$this->load->view('admin/template/footer');
	}

	public function tambah_fasilitas(){

		$data['kk'] = 'kelolafasilitas';

		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/pengelola/tambah_fasilitas');
		$this->load->view('admin/template/footer');

	}

	public function simpanFasilitas(){

		if(!empty($_FILES['gambar']['name'])){
			$config['upload_path'] = './upload/';
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

			$file['nama_fasilitas'] = $this->input->post('nama_fasilitas');
			$file['deskripsi'] = $this->input->post('deskripsi');
			$file['gambar'] = $filename;
			$query = $this->db->insert('fasilitas',$file);
			if($query){
				header('location:'.base_url().'pengelola/kelola_fasilitas');
				$this->session->set_flashdata('success','fasilitas berhasil ditambahkan');
			}
			else{
				header('location:'.base_url().'pengelola/tambah_fasilitas');
				$this->session->set_flashdata('error','File uploaded but not inserted to database');
			}
		}else{
 
			header('location:'.base_url().'pengelola/tambah_fasilitas');
			$this->session->set_flashdata('error','gagal mengunggah filet terlalu tidak valid');
		}

	}

	public function  hapusFasilitas($id){
		$query = $this->db->query("DELETE FROM fasilitas where id_fasilitas = $id");

		if($query){
			header('location:'.base_url().'pengelola/kelola_fasilitas');
			$this->session->set_flashdata('success','sukses hapus');
		}else{
			header('location:'.base_url().'pengelola/kelola_fasilitas');
			$this->session->set_flashdata('error','gagal');
		}
	}
}