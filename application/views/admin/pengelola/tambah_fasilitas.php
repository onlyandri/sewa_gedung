 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title">
            Tambah Fasilitas
            <small>tambah fasilitas</small>
          </h3>
          <!-- tools box -->
          <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
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
         <form class="modal-content" method="POST" action="<?php echo base_url('pengelola/simpanFasilitas') ?>" enctype="multipart/form-data">
          <div class="m-3">
            <div class="form-group">
              <label>Nama Fasilitas</label>
              <input type="text" id="nomor" name="nama_fasilitas" class="form-control" placeholder="Nama fasilitas">
            </div>
          </div>

          <div class="m-3">
            <div class="form-group">
             <label>Deskripsi</label>
             <textarea class="textarea" placeholder="Deskripsi" name="deskripsi" 
             style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
           </div>
         </div>

         <div class="m-3">
          <div class="form-group">
            <label>Upload Gambar</label>
            <input type="file"name="gambar" class="form-control" placeholder="" value="">
            <small style="color: red">max file 2MB type png/jpg</small>
          </div>
        </div>

        <div class="mb3">
          <button type="submit" class="btn btn-info">Tambah Fasilitas</button>
        </div>

      </form>

    </div>
  </div>
</div>
<!-- /.col-->
</div>
<!-- ./row -->
</section>