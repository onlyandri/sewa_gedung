<section class="content">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-success m-4" data-toggle="modal" data-target="#modalTambah">
					<i class="fas fa-plus-circle"></i> &nbsp;Tambah Layanan
				</button> 
				<div><?= $this->session->flashdata('message'); ?></div>
			</div>
			<?php foreach ($harga as $h) {
					# code...
				?>
				<div class="col-md-6 text-center">
					<div class="card">
						<!-- /.card-header -->
						<div class="card-body">
							<img src="<?php echo base_url('Upload/layanan/'.$h->gambar) ?>" style="height: 200px;width: 150px">
							<div class="h4">Layanan  <?php echo $h->nama_layanan ?></div>
							<div class="h4">Rp <?php echo number_format($h->harga_reservasi,0,'.','.') ?>/hari</div>
							<div class="row mt-4">
								<h3>Fasilitas :</h3>
								
							</div>
							<div class="row">
								<p><?php echo $h->fasilitas ?></p>
							</div>
						</div>
						<div class="card-footer">
							<button type="button" class="btn btn-primary m-4" data-toggle="modal" data-target="#modalUbah" id="editHarga"
							data-id="<?php echo $h->id_layanan ?>" data-fasilitas="<?php echo $h->fasilitas ?>" data-nama="<?php echo $h->nama_layanan?>" data-harga = "<?php echo $h->harga_reservasi ?>"data-deskripsi = "<?php echo $h->deskripsi ?>">
							<i class="fas fa-edit"></i> &nbsp;Lihat Detail
						</button> 
						<a href="<?php echo base_url('admin/hapusHarga/'.$h->id_layanan) ?>" type="button" class="btn btn-danger m-4">
							<i class="fas fa-trash"></i> &nbsp;Hapus Layanan
						</a> 
					</div>
					<!-- /.card-body -->
				</div>
			</div>
		<?php } ?>
	</div>
</div>
</section>

<div class="modal fade" id="modalUbah">
	<div class="modal-dialog">
		<form class="modal-content" method="POST" action="" enctype="multipart/form-data">
			<div class="modal-header">
				<h4 class="modal-title">Edit layanan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Nama layanan</label>
					<input type="text" name="nama_layanan" id="nama_layanan" class="form-control" placeholder="Nama layanan" required>
				</div>
				<div class="form-group">
					<label>Harga Sewa</label>
					<input type="number" name="harga" id="harga" class="form-control" placeholder="Harga Sewa" value="" required>
				</div>
				<div class="form-group">
					<label>Fasilitas</label>
					<textarea type="number" name="fasilitas" id="fasilitas" class="form-control" placeholder="masukan Fasilitas" value="" required></textarea>
				</div>
				<div class="m-3">
					<div class="form-group">
						<label>Upload Gambar</label>
						<input type="file"name="gambar" class="form-control" placeholder="" value="" required>
						<small style="color: red">max file 2MB type png/jpg</small>
					</div>
				</div>
				<div class="m-3">
					<div class="form-group">
						<label>Deskripsi</label>
						<textarea id="deskripsi" class="form-control" placeholder="Deskripsi" name="deskripsi" 
						style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer text-right">
				<button type="submit" class="btn btn-info">Edit</button>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="modalTambah">
	<div class="modal-dialog">
		<form class="modal-content" method="POST" action="<?php echo base_url('admin/simpanHarga') ?>" enctype="multipart/form-data">
			<div class="modal-header">
				<h4 class="modal-title">Edit layanan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Nama layanan</label>
					<input type="text" name="nama_layanan" class="form-control" placeholder="Nama layanan" required>
				</div>
				<div class="form-group">
					<label>Harga Sewa</label>
					<input type="number" name="harga" class="form-control" placeholder="Harga Sewa" value="" required>
				</div>
				<div class="form-group">
					<label>Harga Sewa</label>
					<textarea type="number" name="fasilitas" class="form-control" placeholder="masukan Fasilitas" value="" required></textarea>
				</div>
				<div class="m-3">
					<div class="form-group">
						<label>Upload Gambar</label>
						<input type="file"name="gambar" class="form-control" placeholder="" value="" required>
						<small style="color: red">max file 2MB type png/jpg</small>
					</div>
				</div>
				<div class="m-3">
					<div class="form-group">
						<label>Deskripsi</label>
						<textarea class="textarea" placeholder="Deskripsi" name="deskripsi" required 
						style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer text-right">
				<button type="submit" class="btn btn-info">Tambahkan</button>
			</div>
		</form>
	</div>
</div>