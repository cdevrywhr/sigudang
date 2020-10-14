<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Cabang
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('cabang/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Cabang
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($cabang) :
                    $no = 1;
                    foreach ($cabang as $c) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $c['nama_cabang']; ?></td>
                            <td><?= $c['no_telp']; ?></td>
                            <td><?= $c['alamat']; ?></td>
                            <th>
                                <a href="<?= base_url('cabang/edit/') . $c['id_cabang'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('cabang/delete/') . $c['id_cabang'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>