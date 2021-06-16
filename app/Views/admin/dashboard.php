<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row justify-content-md-center">

        <div class="col-6">
            <?= "Welcome back, " . session()->get('user_name'); ?>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>