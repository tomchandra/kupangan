<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="modal fade" id="modal-master" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id='form'>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="foodId" class="col-form-label">Kode:</label>
                        <input type="text" name="foodId" class="form-control" id="foodId">
                    </div>
                    <div class="form-group">
                        <label for="foodName" class="col-form-label">Nama Bahan Makanan:</label>
                        <input type="text" name="foodName" class="form-control" id="foodName">
                    </div>
                    <div class="form-group">
                        <label for="sourceId" class="col-form-label">Sumber:</label><br />
                        <select id='sourceId' name="sourceId" class='selectize' style="min-width: 300px;width:100%;">
                            <option value="">Pilih</option>
                            <?php foreach ($source as $f) : ?>
                                <option value="<?= $f['sourceId']; ?>"><?= $f['sourceName']; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="air">Air (g):</label>
                            <input type="number" name="air" value="0" class="form-control" id="air">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="energi">Energi (Kal):</label>
                            <input type="number" name="energi" value="0" class="form-control" id="energi">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="protein">Protein (g):</label>
                            <input type="number" name="protein" value="0" class="form-control" id="protein">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="lemak">Lemak (g):</label>
                            <input type="number" name="lemak" value="0" class="form-control" id="lemak">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="kh">KH (g):</label>
                            <input type="number" name="kh" value="0" class="form-control" id="kh">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="serat">Serat (Kal):</label>
                            <input type="number" name="serat" value="0" class="form-control" id="serat">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="abu">Abu (g):</label>
                            <input type="number" name="abu" value="0" class="form-control" id="abu">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="kalsium">Ca (mg):</label>
                            <input type="number" name="kalsium" value="0" class="form-control" id="kalsium">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="fosfor">P (mg):</label>
                            <input type="number" name="fosfor" value="0" class="form-control" id="fosfor">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="besi">Fe (mg):</label>
                            <input type="number" name="besi" value="0" class="form-control" id="besi">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="natrium">Na (mg):</label>
                            <input type="number" name="natrium" value="0" class="form-control" id="natrium">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="kalium">K (mg):</label>
                            <input type="number" name="kalium" value="0" class="form-control" id="kalium">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="tembaga">Cu (mg):</label>
                            <input type="number" name="tembaga" value="0" class="form-control" id="tembaga">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="seng">Zn (mg):</label>
                            <input type="number" name="seng" value="0" class="form-control" id="seng">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="retinol">Retinol (&mu;g):</label>
                            <input type="number" name="retinol" value="0" class="form-control" id="retinol">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="bkar">&beta;-Kar (&mu;g):</label>
                            <input type="number" name="bkar" value="0" class="form-control" id="bkar">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="karTotal">Kar-Total (&mu;g):</label>
                            <input type="number" name="karTotal" value="0" class="form-control" id="karTotal">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="thiamin">Thiamin (mg):</label>
                            <input type="number" name="thiamin" value="0" class="form-control" id="thiamin">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="riborflavin">Riborflavin (mg):</label>
                            <input type="number" name="riborflavin" value="0" class="form-control" id="riborflavin">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="niasin">Niasin (mg):</label>
                            <input type="number" name="niasin" value="0" class="form-control" id="niasin">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="vitc">Vit-C (Mg):</label>
                            <input type="number" name="vitc" value="0" class="form-control" id="vitc">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="bdd">BDD (%):</label>
                            <input type="number" name="bdd" value="0" class="form-control" id="bdd">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-action="" id="btn-simpan">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col mt-5">
            <div class="table-responsive">
                <div class="text-right pb-2"><button class="btn btn-primary" id="tambah-item">Tambah</button></div>

                <table id="data-food" class='table table-sm table-bordered table-striped text-center border-dark' style="font-size: 14px;" width="100%">
                    <thead>
                        <tr class="table-primary">
                            <th rowspan="4" class="align-middle">Kode</th>
                            <th rowspan="4" class="align-middle text-left">Nama Bahan Makanan</th>
                            <th rowspan="4" class="align-middle">SUMBER</th>
                        </tr>
                        <tr>
                            <th colspan="22" class="table-warning">KOMPOSISI ZAT GIZI MAKANAN</th>
                            <th rowspan="4" class="table-primary align-middle">Aksi</th>
                        </tr>
                        <tr class="table-primary">
                            <th>AIR</th>
                            <th>ENERGI</th>
                            <th>PROTEIN</th>
                            <th>LEMAK</th>
                            <th>KH</th>
                            <th>SERAT</th>
                            <th>ABU</th>
                            <th>Ca</th>
                            <th>P</th>
                            <th>Fe</th>
                            <th>Na</th>
                            <th>K</th>
                            <th>Cu</th>
                            <th>Zn</th>
                            <th>RETINOL</th>
                            <th>&beta;-KAR</th>
                            <th>KAR-TOTAL</th>
                            <th>THIAMIN</th>
                            <th>RIBOFLAVIN</th>
                            <th>NIASIN</th>
                            <th>VIT-C</th>
                            <th rowspan="2" class="align-middle">BDD (%)</th>
                        </tr>
                        <tr class="table-primary">
                            <th>(g)</th>
                            <th>(Kal)</th>
                            <th>(g)</th>
                            <th>(g)</th>
                            <th>(g)</th>
                            <th>(g)</th>
                            <th>(g)</th>
                            <th>(mg)</th>
                            <th>(mg)</th>
                            <th>(mg)</th>
                            <th>(mg)</th>
                            <th>(mg)</th>
                            <th>(mg)</th>
                            <th>(mg)</th>
                            <th>(&mu;g)</th>
                            <th>(&mu;g)</th>
                            <th>(&mu;g)</th>
                            <th>(mg)</th>
                            <th>(mg)</th>
                            <th>(mg)</th>
                            <th>(mg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($food as $key => $data) { ?>
                            <tr class="table-light">
                                <td><?php echo $data['foodId']; ?></td>
                                <td class="text-left"><?php echo $data['foodName']; ?></td>
                                <td><?= $data['sourceName']; ?></td>
                                <td><?= $data['air']; ?></td>
                                <td><?= $data['energi']; ?></td>
                                <td><?= $data['protein']; ?></td>
                                <td><?= $data['lemak']; ?></td>
                                <td><?= $data['kh']; ?></td>
                                <td><?= $data['serat']; ?></td>
                                <td><?= $data['abu']; ?></td>
                                <td><?= $data['kalsium']; ?></td>
                                <td><?= $data['fosfor']; ?></td>
                                <td><?= $data['besi']; ?></td>
                                <td><?= $data['natrium']; ?></td>
                                <td><?= $data['kalium']; ?></td>
                                <td><?= $data['tembaga']; ?></td>
                                <td><?= $data['seng']; ?></td>
                                <td><?= $data['retinol']; ?></td>
                                <td><?= $data['bkar']; ?></td>
                                <td><?= $data['karTotal']; ?></td>
                                <td><?= $data['thiamin']; ?></td>
                                <td><?= $data['riborflavin']; ?></td>
                                <td><?= $data['niasin']; ?></td>
                                <td><?= $data['vitc']; ?></td>
                                <td><?= $data['bdd']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-edit-master" data-id="<?= $data['id'] ?>" data-edit='<?= json_encode($data); ?>'>Edit</button>
                                    <button type="button" class="btn btn-secondary btn-sm btn-hapus-master" data-id="<?= $data['id'] ?>">Hapus</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="text-right"><?= $pager->links('bootstrap', 'bootstrap_pagination'); ?></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('extra-js'); ?>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token_name"]').attr('content')
            }
        });

        $select = $('.selectize').selectize();
        $('.btn-edit-master').click(function() {
            var id = $(this).data('id');
            var data = $(this).data('edit');

            $.each(data, function(key, value) {
                if (value === null) value = parseFloat(0.00);
                if (key == 'sourceId') $select[0].selectize.setValue(value);
                $('#' + key).val(value);
            });
            $('#foodId').prop('disabled', true);
            $('#btn-simpan').data('action', 'act-update');
            $('.modal-title').html('Edit');
            $('#modal-master').modal('show');
        });

        $('.btn-hapus-master').click(function() {
            Swal.fire({
                title: 'Perhatian!',
                text: `Apakah anda yakin ingin menghapus ?`,
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    var id = $(this).data('id');
                    $.ajax({
                        url: `<?= base_url("/delete"); ?>`,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id: id
                        },
                        success: function(result) {
                            console.log(result.status);
                            if (result.status == true) {
                                $('#modal-master').modal('hide');
                                Swal.fire({
                                    type: 'success',
                                    title: 'Berhasil!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                location.reload();
                            }
                        }
                    });
                }
            });
        });

        $('#btn-simpan').click(function() {
            var act = $(this).data("action");
            console.log(act);
            if (act == "act-update") {
                $.ajax({
                    url: `<?= base_url("/update"); ?>`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $('#form').serialize(),
                    success: function(result) {
                        console.log(result.status);
                        if (result.status == true) {
                            $(this).data('action', '');
                            $('#modal-master').modal('hide');
                            Swal.fire({
                                type: 'success',
                                title: 'Berhasil!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            location.reload();
                        }
                    }
                });
            } else if (act == "act-simpan") {
                $.ajax({
                    url: `<?= base_url("/save"); ?>`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $('#form').serialize(),
                    success: function(result) {
                        console.log(result.status);
                        if (result.status == true) {
                            $(this).data('action', '');
                            $('#modal-master').modal('hide');
                            Swal.fire({
                                type: 'success',
                                title: 'Berhasil!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            location.reload();
                        }
                    }
                });
            }
        });

        $('#tambah-item').click(function() {
            $('#form')[0].reset();
            $('#btn-simpan').data('action', 'act-simpan');
            $('.modal-title').html('Input');
            $('#modal-master').modal('show');
        });
    });
</script>
<?= $this->endSection(); ?>