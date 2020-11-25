<body class="bg-gradient-info">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col">
               <div class="p-5">
                <form method="post" action="<?= BASEURL;?>/Panitia/kirimSertif" enctype="multipart/form-data">        
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="KTI Selesai diperiksa" disabled>
                    </div>
                    <div class="form-group">
                        <label for="judul">Nama Peserta : </label>
                        <input type="text" class="form-control" id="namaPeserta" name="namaPeserta" placeholder="<?= $nama;?>" value="<?= $nama;?>" disabled>
                        <input type="hidden" id="id_peserta" name="id_peserta" value="<?= $id_peserta;?>" />
                    </div>
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" id="userfile" name="userfile" required="required">
                    <label class="custom-file-label" for="customFile">Unggah Sertifikat Peserta</label>
                    </div>
                        <br>
                        <br>
                        <hr>
                        <button class="btn btn-info btn-user btn-block" name="submit" type="sumbit" value="submit" id="submit">
                        Unggah
                    </button>
                </form>

                <hr>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>


