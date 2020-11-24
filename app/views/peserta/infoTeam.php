<div class="container">
<h4>Data Peserta : </h4>
<br>    
<div class="row justify-content-left">
    
        <div class="col-lg-9">
            <?php
            {

            ?>
            <div class="form-group">
                <i class="fas fa-users"></i>
                <label for="namaTeam">Nama Tim</label>
                <br>
                <h6><strong><?= $namaTim['namaTeam'];?></strong></h6>
            </div>
            <hr>
            <div class="form-group">
            <i class="far fa-id-badge"></i>
                <label for="anggota1">Nama Anggota 1</label>
                <br>
                <h6><strong><?= $anggota1['anggota1'];?></strong></h6>
            </div>
            <hr>
            <div class="form-group">
            <i class="far fa-id-badge"></i>    
                <label for="anggota2">Nama Anggota 2</label>
                <br>
                <h6><strong><?= $anggota2['anggota2'];?></strong></h6>
            </div>
            <hr>
            <div class="form-group">
            <i class="far fa-id-badge"></i>
                <label for="anggota3">Nama Anggota 3</label>
                <br>
                <h6><strong><?= $anggota3['anggota3'];?></strong></h6>
            </div>
            <hr>
            <div class="form-group">
            <i class="fas fa-school"></i>
                <label for="departemen">Asal Departemen</label>
                <br>
                <h6><strong><?= $departemen['departemen'];?></strong></h6>
            </div>
           <hr>
            <?php } ?>
        </div>
    </div>
</div>