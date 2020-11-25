<!-- Begin Page Content -->
<div class="container-fluid">


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Silahkan, ini sertifmu</h6>
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
            <td><a href="<?= BASEURL;?>/sertif/<?= $item['file_complete'];?>" target="_blank"><?= $item['file_complete'];?></a></td>
            <td><?= $item['nama'];?></td>
            <td><?= $item['date_created'];?></td>
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