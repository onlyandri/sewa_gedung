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

	public function cariPenyewa(){

		$nik = $this->input->post("nik");
		$nomor = $this->input->post("nomor");

		$output ='';
		$tombol = '';
		$tombol2 = '';

		$query = $this->db->query("SELECT * FROM PENYEWA p join gedung g on g.id_gedung = p.id_gedung WHERE p.nomor_sewa = '$nomor' and p.nik = '$nik'")->row_array();

		if($query){

			$bayarTampil = number_format($query['total_bayar'],0,'.','.');

			if ($query['status'] == 1) {
				$status = 'belum bayar';
				$color = 'red';
				$tombol .= '<a href="'.base_url('pengelola/konfirmasi/').''.$query['nomor_sewa'].'" type="button" class="btn btn-primary m-4" id=""> <i class="fas fa-edit"></i> &nbsp;Konfirmasi Bayar
				</a> ';
				$tombol2 .= '<a href="'.base_url('pengelola/hapusSewa/').''.$query['id_penyewa'].'" type="button" class="btn btn-danger m-4" id=""> <i class="fas fa-edit"></i> &nbsp;Hapus Penyewa
				</a> ';
			}else if($query['status'] == 2){
				$status = 'telah dibatalkan';
				$color = 'blue';
				$tombol .= '<a href="'.base_url('pengelola/konfirmasi/').''.$query['nomor_sewa'].'" type="button" class="btn btn-primary m-4" id=""> <i class="fas fa-edit"></i> &nbsp;Konfirmasi Sewa
				</a> ';
				$tombol2 .= '<a href="'.base_url('pengelola/hapusSewa/').''.$query['id_penyewa'].'" type="button" class="btn btn-danger m-4" id=""> <i class="fas fa-trash"></i> &nbsp;Hapus Penyewa
				</a> ';
			}else if($query['status'] == 4){
				$status = 'dibatalkan sudah bayar';
				$color = 'violet';
				$tombol .= '<a href="'.base_url('pengelola/konfirmasi/').''.$query['nomor_sewa'].'" type="button" class="btn btn-primary m-4" id=""> <i class="fas fa-edit"></i> &nbsp;Konfirmasi Lagi
				</a> ';
				$tombol2 .= '';
			}else{
				$status = 'sudah bayar';
				$color = 'green';
				$tombol .= '<a href="'.base_url('pengelola/cetakBukti/').''.$query['nomor_sewa'].'" type="button" class="btn btn-success m-4" id=""> <i class="fas fa-print"></i> &nbsp;Cetak Bukti
				</a> ';
				$tombol2 .= '<a href="'.base_url('pengelola/batalSewa/').''.$query['id_penyewa'].'" type="button" class="btn btn-danger m-4" id=""> <i class="fas fa-trash"></i> &nbsp;Batalkan Sewa
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
			<div class="h4 text-center">Data Penyewa Gedung</div>
			<div class="h4"></div>
			<div class="row mt-5">
			<div class="col-xs-5" style="right: 0">
			<h5>NOMOR SEWA </h5>
			<h5>NIK </h5>
			<h5>NAMA PENYEWA</h5>
			<h5>NO HP </h5>
			<h5>LAYANAN</h5>
			<h5>TANGGAL MULAI</h5>
			<h5>TANGGAL SELESAI </h5>
			<h5>LAMA SEWA </h5>
			<h5>TOTAL BAYAR </h5>
			<h5>STATUS </h5>
			</div>
			<div class="col-xs-4">
			<h5> &nbsp :  &nbsp '.$query['nomor_sewa'].'</h5>
			<h5> &nbsp :  &nbsp '.$query['nik'].'<h5>
			<h5 style="text-transform: capitalize;"> &nbsp :  &nbsp '.$query['nama_penyewa'].'</h5>
			<h5> &nbsp :  &nbsp '.$query['no_hp'].' </h5>
			<h5> &nbsp :  &nbsp '.$query['nama_gedung'].'</h5>
			<h5> &nbsp :  &nbsp '.$query['tgl_mulai'].'</h5>
			<h5> &nbsp :  &nbsp '.$query['tgl_akhir'].'</h5>
			<h5> &nbsp :  &nbsp '.$query['lama_sewa'].' Hari</h5>
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
		$query = $this->db->query("SELECT * FROM PENYEWA WHERE NOMOR_SEWA = '$nomor'")->row_array();

		if($query){

			$id_penyewa = $query['id_penyewa'];
			$tgl1 = new DateTime($query['tgl_mulai']);
			$tgl2 = new DateTime($query['tgl_akhir']);

			$tglm = new DateTime($query['tgl_mulai']);
			$tgla = new DateTime($query['tgl_akhir']);

			$sekarang = Time();

			$tgl3 =  strtotime($query['tgl_mulai']);

			$diff = $tgl3 - $sekarang;

			$perbedaan = floor($diff/(60*60*24));

			if($perbedaan < 0){

				$q = $this->db->query("UPDATE penyewa set status = 2 where nomor_sewa = '$nomor'");
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">tanggal penyewaan telah kadaluarsa</div>');
				header('location:'.base_url().'pengelola/');
			}else{
				for ($i=$tgl1; $i <= $tgl2; $i->modify('+1 day')) { 
					$tgl = $i->format('Y-m-d');
					$query2 = $this->db->query("SELECT * FROM SEWA WHERE tgl_sewa = '$tgl'");
					if($query2->num_rows() > 0){
						break;
					}
				}

				if($query2->num_rows() > 0){
					$q = $this->db->query("UPDATE penyewa set status = 2 where nomor_sewa = '$nomor'");
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">tanggal telah terkonfirmasi untuk penyewa lain</div>');
					header('location:'.base_url().'pengelola/');
				}else{
					for ($i=$tglm; $i <= $tgla; $i->modify('+1 day')) { 
						$tglh = $i->format('Y-m-d');
						$querySewa = $this->db->query("INSERT INTO SEWA VALUES(null,$id_penyewa,'$tglh')");
						$queryBatal = $this->db->query("UPDATE PENYEWA SET status = 2 where tgl_mulai = '$tglh' or tgl_akhir = '$tglh' and id_penyewa != $id_penyewa");
					}
					$q = $this->db->query("UPDATE penyewa set status = 3 where nomor_sewa = '$nomor'");
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembayaran terkonfirmasi</div>');
					header('location:'.base_url().'pengelola/cetakBukti/'.$nomor);
				}
			}
		}
	}

	public function cetakBukti($nomor){

		$data['bukti'] = $this->db->query("SELECT * from penyewa p join gedung g on p.id_gedung = g.id_gedung where p.nomor_sewa = '$nomor'")->row_array();

		$this->load->view('admin/cetakBukti',$data);
	}
	public function batalSewa($id){

		$query = $this->db->query("UPDATE penyewa set status = 4 where id_penyewa = $id");
		$query2 = $this->db->query("DELETE FROM SEWA WHERE id_penyewa = $id");

		if($query && $query2){
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sewa Telah Dibatalkan</div>');
			header('location:'.base_url().'pengelola/');
		}
	}

	public function hapusSewa($id){

		$query2 = $this->db->query("DELETE FROM penyewa WHERE id_penyewa = $id");

		if($query2){
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sewa Telah dihapus</div>');
			header('location:'.base_url().'pengelola/');
		}
	}

	public function kelola_Penyewa(){
		$data['kk'] = 'kelolaPenyewa';
		$data['penyewa'] = $this->db->query("SELECT * FROM penyewa p join gedung g on p.id_gedung = g.id_gedung")->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/pengelola/kelola_penyewa');
		$this->load->view('admin/template/footer');
	}
}