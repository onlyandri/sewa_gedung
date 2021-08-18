<section class="content">

  <div class="container-fluid">
    <div class="row"> 
      <div class="col-md-12 text-center mt-4">
        <h2>Data Diskon</h2>
        <div class="row">
         <a href="<?php echo base_url('pengelola/tambah_fasilitas/') ?>" type="button" class="btn btn-success m-4" id="tambahPasien">
          <i class="fas fa-plus-circle"></i> &nbsp;Tambah fasilitas
        </a>  
        <div class="col-md-12">
         <?php
      if($this->session->flashdata('success')){
        ?>
        <div class="alert alert-success text-center" style="margin-top:20px;">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php
      }

      if($this->session->flashdata('error')){
        ?>
        <div class="alert alert-danger text-center" style="margin-top:20px;">
          <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php
      }
      ?>
         <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Diskon</th>
                  <th>Min Reservasi</th>
                  <th>Diskon</th>
                  <th>keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach ($fasilitas as $ds) {
                  $no++;
                  ?>
                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?= $ds->nama_fasilitas ?></td>
                    <td><?= $ds->deskripsi ?></td>
                    <td><img src=""></td>
                    <td>
                      <!-- <button type="button" id="edit_diskon" class="btn btn-warning btn-sm edit" title="edit"  data-toggle="modal"
                      data-target="#modalUbah"
                      >
                      <i class="fas fa-edit"></i>
                    </button> -->
                    <a href="<?php echo base_url('pengelola/hapusFasilitas/'.$ds->id_fasilitas)?>" type="button" class="btn btn-danger btn-sm hapus" title="Hapus">
                      <i class="fas fa-trash"></i>
                    </a>
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
</div>

</section>