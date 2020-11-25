<!-- Begin Page Content -->
<div class="container-fluid">

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Anda telah menggunggah, silahkan menunggu sertifikat dari panitia:)</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Judul</th>
            <th>Nama File</th>
            <th>Tanggal Upload</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        {
        ?>
          <tr>
            <td><?= $file['judul'];?></td>
            <td><?= $lokasi['file_location']; ?></td>
            <td><?= $kapan['date_created'];?></td>
            <?php if ($status['status'] == 1)
            {
            ?>
            <td>Sudah Upload</td>
            <?php } ?>
            <?php if($status['status'] == 2)
            {
              ?>
              <td>Sedang Diperiksa</td>
            <?php } ?>
            <?php if($status['status'] == 3)
            {
              ?>
              <td>Selesai Diperiksa</td>
            <?php } ?>
          </tr>

        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->