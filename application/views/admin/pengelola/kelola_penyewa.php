<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2>DATA PENYEWA</h2>
        <div class="row">
          <div class="col-md-12">
            <div><?= $this->session->flashdata('message'); ?></div>
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NOMOR PELANGGAN</th>
                      <th>NIK</th>
                      <th>NAMA</th>
                      <th>LAYANAN</th>
                      <th>LAMA RESERVASI</th>
                      <th>PEMAKAIAN</th>
                      <th>STATUS</th>
                      <th>TOTAL BAYAR</th>
                      <th>KETERANGAN</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    $status ='';
                    $tombol = '';
                    $tombol2 = '';
                    foreach ($penyewa as $pw) {
                      $no++;

                      if($pw->status == 1){
                        $status = 'BELUM BAYAR';
                        $tombol = '<a href="'.base_url('pengelola/konfirmasi/').''.$pw->nomor_sewa.'" type="button" class="btn btn-primary m-4" id=""> <i class="fas fa-edit"></i>Konfirmasi sewa</a> ';
                        $tombol2 = '<a href="'.base_url('pengelola/hapusSewa/').''.$pw->id_penyewa.'" type="button" class="btn btn-danger m-4" id=""> <i class="fas fa-edit"></i>hapus penyewa</a> ';
                      }else if($pw->status == 2){
                        $status = 'DIBATALKAN';
                        $tombol = '<a href="'.base_url('pengelola/konfirmasi/').''.$pw->nomor_sewa.'" type="button" class="btn btn-primary m-4" id=""> <i class="fas fa-edit"></i>Konfirmasi Sewa
                        </a> ';
                        $tombol2 = '<a href="'.base_url('pengelola/hapusSewa/').''.$pw->id_penyewa.'" type="button" class="btn btn-danger m-4" id=""> <i class="fas fa-trash"></i>Hapus Penyewa
                        </a> ';
                      }else if($pw->status == 4){
                        $status = 'BATAL SUDAH BAYAR';
                        $tombol = '<a href="'.base_url('pengelola/konfirmasi/').''.$pw->nomor_sewa.'" type="button" class="btn btn-primary m-4" id=""> <i class="fas fa-edit"></i>Konfirmasi Lagi
                        </a> ';
                        $tombol2 = '';
                      }else{
                        $status = 'LUNAS';
                        $tombol = '<a href="'.base_url('pengelola/cetakBukti/').''.$pw->nomor_sewa.'" type="button" class="btn btn-success m-4" id=""> <i class="fas fa-print"></i>Cetak Bukti
                        </a> ';
                        $tombol2 = '<a href="'.base_url('pengelola/batalSewa/').''.$pw->id_penyewa.'" type="button" class="btn btn-danger m-4" id=""> <i class="fas fa-trash"></i>Batalkan Sewa
                        </a> ';
                      }

                      ?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?= $pw->nomor_sewa ?></td>
                        <td><?= $pw->nik ?></td>
                        <td><?= $pw->nama_penyewa ?></td>
                        <td><?= $pw->nama_gedung ?></td>
                        <td><?= $pw->lama_sewa ?> hari</td>
                        <td><?= $pw->tgl_mulai ?> s/d <?php echo $pw->tgl_akhir ?></td>
                        <td><?= $status ?></td>
                        <td>Rp <?= number_format($pw->total_bayar,0,'.','.') ?></td>
                        <td><?= $pw->keterangan ?></td>
                        <td>
                          <?php echo $tombol;?>
                        </td>
                         <td>
                          <?php echo $tombol2 ?>
                        </td>
                      </tr>
                    <?php  } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" id="tampil">

    </div>
  </div>
</section>