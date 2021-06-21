<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div id="login-container" class="container-fluid">
    <div class="row justify-content-md-center mt-5">
        <div class="col-lg-3 col-md-12 col-sm-12">
            <h2 class="text-center">LOGIN</h2>
            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
            <?php endif; ?>
            <form action="<?= base_url('/login/auth') ?>" method="post">
                <div class="mb-3">
                    <label for="InputForEmail" class="form-label">Email</label>
                    <input type="text" name="username" class="form-control" id="InputForEmail" value="<?= set_value('username') ?>">
                </div>
                <div class="mb-3">
                    <label for="InputForPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="InputForPassword">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <button type="submit" id="signup" class="btn btn-success">Sign Up</button>
            </form>
        </div>

    </div>
</div>

<div id="signup-container" class="container-fluid">
    <div class="row justify-content-md-center mt-5">
        <div class="col-lg-3 col-md-12 col-sm-12">
            <h2 class="text-center">SIGN UP</h2>
            <form id="form-signup">
                <div class="mb-3">
                    <label for="InputForFirstName" class="form-label">Nama Depan</label>
                    <input type="text" name="first_name" class="form-control" id="InputForFirstName">
                </div>
                <div class="mb-3">
                    <label for="InputForLastName" class="form-label">Nama Belakang</label>
                    <input type="text" name="last_name" class="form-control" id="InputForLastName">
                </div>
                <div class="mb-3">
                    <label for="InputForProfesi" class="form-label">Profesi</label>
                    <select id="InputForProfesi" class="w-100">
                        <option value="">Pilih Profesi</option>
                        <option value="ahligizi">Ahli Gizi</option>
                        <option value="dokter">Dokter</option>
                        <option value="bidan">Bidan</option>
                        <option value="radiographer">Radiographer</option>
                        <option value="ahlikesmas">Ahli Kesmas</option>
                        <option value="tenagalainnya">Tenaga Lainya</option>
                    </select>
                </div>
                <div id="other-job" class="mb-3 d-none">
                    <label for="InputForOtherJob" class="form-label">Sebutkan,</label>
                    <input type="text" name="job" class="form-control" id="InputForOtherJob">
                </div>
                <div class="mb-3">
                    <label for="InputForEmail2" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="InputForEmail2">
                </div>
                <div class="mb-3">
                    <label for="InputForPassword2" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="InputForPassword2">
                </div>
                <div class="mb-3">
                    <label for="InputForPassword3" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirm" class="form-control" id="InputForPassword3">
                </div>
                <button id="signup-agreement" class="btn btn-primary">Sign Up</button>
                <button id="login" class="btn btn-success">Login</button>
            </form>
        </div>

    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-md-center mt-5">
        <div class="col-lg-4 col-md-12 col-sm-12 p-5">
            <img src="<?= base_url('public/images/product2.png'); ?>" class="img-fluid float-right" style="height:auto">
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-js'); ?>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token_name"]').attr('content')
        }
    });

    $("#InputForProfesi").selectize({
        onChange: function(v, e) {
            var selected_text = this.getItem(v)[0].innerHTML;
            if (v == "tenagalainnya") {
                $("#InputForOtherJob").val("");
                $("#other-job").removeClass('d-none');
                $('#InputForOtherJob').focus();
            } else {
                $("#other-job").addClass('d-none');
                $("#InputForOtherJob").val(selected_text);
            }
        }
    });

    $("#signup").click(function(e) {
        e.preventDefault();
        $("#login-container").slideUp();
        $("#signup-container").slideDown();
    });

    $("#login").click(function(e) {
        e.preventDefault();
        $("#login-container").slideDown();
        $("#signup-container").slideUp();
    });

    $("#signup-agreement").click(function(e) {
        e.preventDefault();

        var dmca = `
        <div style="overflow-y: scroll; width:100%; height: 300px; max-height:300px; padding:10px; text-align:justify; font-size:0.8em; border :2px solid #bbb;" readonly>
        
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dictum eros orci, vel mattis nulla euismod non. Ut eleifend congue tortor, et cursus felis dapibus sit amet. Etiam pulvinar auctor sem, pharetra feugiat ligula pretium vel. Morbi iaculis consequat fringilla. Nunc ullamcorper sagittis tellus sit amet pellentesque. In placerat, dolor a volutpat gravida, urna nisi mollis odio, nec scelerisque mauris quam vel arcu. Donec consequat luctus metus ac gravida. Maecenas maximus euismod metus nec luctus. Vestibulum tempus, est consequat tincidunt auctor, lectus enim eleifend lacus, lacinia aliquam nunc quam quis purus. Vivamus vehicula nec est et laoreet. Donec quis ex ac odio pellentesque vehicula eu ac magna. In eu felis sit amet mauris pellentesque aliquet. Integer at justo at ligula volutpat tempor.

        Ut condimentum nunc dapibus odio blandit, efficitur luctus odio congue. Praesent vel ornare mi, vel ultrices massa. Vivamus bibendum sodales eros sed venenatis. Curabitur diam metus, lobortis at accumsan nec, maximus ut felis. Nam vitae hendrerit tellus. Duis gravida nisl fringilla, mattis sem aliquam, mollis diam. Sed maximus nisl sed eleifend vulputate. Phasellus vitae purus sit amet massa bibendum aliquam fringilla id mi. Nullam nisi tellus, elementum a euismod nec, feugiat in nulla. Integer id erat leo. Aenean consectetur sit amet metus id commodo. Aliquam erat volutpat. In hac habitasse platea dictumst. Etiam euismod faucibus sem, id elementum massa.

        Nam sed dolor eget lacus hendrerit lacinia. In vulputate elit sed velit tempor, ut aliquam orci gravida. Duis vestibulum ante quis nisl pretium, convallis cursus nibh dictum. Suspendisse a luctus metus, nec iaculis augue. Sed ipsum purus, laoreet ut neque vel, egestas euismod augue. Sed porttitor et nisl non placerat. Morbi vestibulum dolor at ipsum aliquam mollis. Ut sed turpis ultricies, ornare odio nec, tempus elit. Nam sed tortor non quam sodales feugiat. Sed non mi nisi. Duis tincidunt porta elit, nec consectetur ligula mollis sed. Cras scelerisque, arcu lobortis pulvinar volutpat, leo diam iaculis ligula, quis auctor nisi est sed erat.

        Nulla eleifend volutpat magna, ac condimentum nisl dictum lacinia. Phasellus a mi vitae mi molestie placerat. Ut dictum iaculis lorem, nec tincidunt magna scelerisque eget. Mauris ex nibh, malesuada eu ipsum mollis, eleifend mattis enim. Mauris enim lacus, mattis non imperdiet sed, venenatis vel mi. Morbi sed turpis in mauris rhoncus feugiat. Nam sodales, magna id porttitor mollis, mi nisi elementum orci, sit amet fringilla leo ex ut est. Donec faucibus dignissim nisl, in tincidunt nibh vulputate a. Integer suscipit justo fringilla volutpat tempor. Cras et eros eu massa interdum mollis. Suspendisse a ex nisl.

        Praesent a fringilla ex, sit amet malesuada orci. Nunc at dui non nisi egestas rutrum. Aliquam sed mauris at purus laoreet faucibus. Morbi ac neque malesuada sapien egestas auctor. Fusce eget lacus at leo fringilla finibus. Duis massa augue, varius sed purus sagittis, aliquam auctor purus. Etiam nec pellentesque libero, ut placerat ex.
        
        </div>`;
        var myData = $('#form-signup').serializeArray();
        console.log(myData);
        Swal.fire({
            title: 'Acceptence letter',
            html: nl2br(dmca),
            width: '60%',
            showCancelButton: true,
            confirmButtonText: 'Setuju',
            cancelButtonText: 'Tidak Setuju'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: `<?= base_url("/login/sign_up") ?>`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: myData,
                    success: function(result) {
                        console.log(result);
                        if (result.status == true) {
                            Swal.fire({
                                type: 'success',
                                title: 'Pendaftaran berhasil, silahkan login!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Perhatian!',
                                html: result.message,
                                showConfirmButton: true
                            });
                        }
                    }
                });
            }
        });
    });

    function nl2br(str, is_xhtml) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }
</script>
<?= $this->endSection(); ?>