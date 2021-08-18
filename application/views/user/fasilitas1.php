  <!-- Slider Area Start-->
    <div class="services-area">
        <div class="container">
            <!-- Section-tittle -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center mb-80">
                        <h2><?php echo $layanan['nama_layanan'] ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Area End-->

    <!--================Blog Area =================-->
    <section class="blog_area section-paddingr">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="<?php echo base_url('upload/layanan/'.$layanan['gambar']) ?>" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3>HA</h3>
                                    <p>Djunaid</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block">
                                    <h2><?php echo $layanan['nama_layanan'] ?></h2>
                                    <h2>Harga Sewa Rp.<?php echo number_format($layanan['harga_reservasi'],0,'.','.'); ?></h2>
                                     <h2>fasilitas</h2>
                                      <h2><?php echo $layanan['fasilitas'] ?></h2>
                                </a>
                                <p><?= $layanan['deskripsi'] ?></p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->