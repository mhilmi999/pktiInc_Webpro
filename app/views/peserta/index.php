
<div class="container">
    <div class="row justify-content-left">
        <div class="col-lg-9">
            <form method="post" action="<?= BASEURL;?>/Peserta/createInfoTeam" class="user">
            <div class="form-group">
                <i class="fas fa-users"></i>
                <label for="namaTeam">Nama Tim</label>
                <input type="text" class="form-control" id="namaTeam" name="namaTeam" required placeholder="MurphyTech" >
            </div>
            <div class="form-group">
                <label for="anggota1">Nama Anggota 1</label>
                <input type="text" class="form-control" id="anggota1" name="anggota1" required placeholder="Muhammad Hilmi">
            </div>
            <div class="form-group">
                <label for="anggota2">Nama Anggota 2</label>
                <input type="text" class="form-control" id="anggota2" name="anggota2" required placeholder="Muhammad Rizqi">
            </div>
            <div class="form-group">
                <label for="anggota3">Nama Anggota 3</label>
                <input type="text" class="form-control" id="anggota3" name="anggota3" required placeholder="Dhidan Tommyagistyawan">
            </div>
            <div class="form-group">
                <label for="departemen">Asal Departemen</label>
                <input type="text" class="form-control" id="departemen" name="departemen" required placeholder="Teknologi Informasi">
            </div>
            <br>
                    <hr>
                    <button class="btn btn-info btn-user " name="submit" type="sumbit" value="submit" id="submit">
                        Unggah
                    </button>
            </form>
        </div>
    </div>
</div>