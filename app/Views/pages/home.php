<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-lg-6 col-md-12 col-sm-12 mt-5 p-5">
            <blockquote class="blockquote">
                <p class="mb-0" style="font-size:1em">

                    Salam Sehat, <br />
                    Kalkulator bahan pangan merupakan sebuah aplikasi yang digunakan oleh Ahli Gizi dan Tenaga Kesehatan lainya untuk menghitung nilai gizi bahan pangan <br />
                    yaitu Kalori, Protein, Lemak, Karbohidrat, vitamin, mineral Serta mikro nutrient lainya. <br />
                    Aplikasi ini dikhususkan untuk tenaga Kesehatan, untuk itu sebelum menggunakan aplikasi ini silakan melakukan login terlebih dahulu. <br />
                    <br />

                    Salam,<br />

                </p>
                <footer class="blockquote-footer">HFS Edu & Otsuka Indonesia</footer>
            </blockquote>

        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 p-5">
            <img src="<?= base_url('public/images/product2.png'); ?>" class="img-fluid float-right" style="height:auto">
        </div>
    </div>
    <?= base_url('images/product2.png'); ?>

</div>
<?= $this->endSection(); ?>