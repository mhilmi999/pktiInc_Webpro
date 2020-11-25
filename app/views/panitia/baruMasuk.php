<!-- Begin Page Content -->
<div class="container-fluid">


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel KTI Peserta yang Baru Upload</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Nama File</th>
            <th>Ketua Tim</th>
            <th>Waktu Upload</th>
            <th>Update Status</th>
          </tr>
        </thead>
        <?php
        $i=0;
        foreach ($data as $item)
        {
          $i++;
        ?>
        <tbody>
          <tr>
          <td><?= $i;?></td>
            <td><?= $item['judul'];?></td>
            <td><?= $item['file_location'];?></td>
            <td><?= $item['nama'];?></td>
            <td><?= $item['date_created'];?></td>
            <td><a class="btn btn-info" href="<?= BASEURL;?>/Panitia/cekKti/<?= $item['id_task'];?>" >cek</a></td>
          </tr>
        </tbody>
        <?php /*array_splice($data,0,1);*/} ?>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->