<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?= base_url('public/themes/style.css'); ?>" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('public/selectize/selectize.css'); ?>" crossorigin="anonymous">
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    <style>
        html,
        body {
            height: 100%;
            overflow: scroll;
        }

        p:first-child:first-letter {
            color: #903;
            float: left;
            font-family: Georgia;
            font-size: 75px;
            line-height: 60px;
            padding-top: 4px;
            padding-right: 8px;
            padding-left: 3px;
        }

        div#signup-container {
            display: none;
        }

        .tableFixHead {
            position: relative;
            overflow-y: auto;
            height: 200px;
        }

        table#data-food thead tr th,
        table#data-food tfoot tr td {
            position: sticky;
            z-index: 1;
        }

        table#data-food thead tr.tr-first th,
        table#data-food thead tr.tr-second th {
            top: 0;
        }

        table#data-food tfoot tr td {
            bottom: 0;
        }
    </style>
    <title><?= $title; ?></title>
</head>

<body>

    <header class="header-area">
        <div class="credit-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <nav class="classy-navbar justify-content-between" id="creditNav">

                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <div class="classy-menu">

                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <div class="classynav">
                                <ul>
                                    <?php
                                    if (session()->get('logged_in') == TRUE) {
                                        $menu  = '<li><a href="' . base_url("/pages/input") . '">Kalkulator Bahan Pangan</a></li>
                                                  <li><a href="' . base_url("/logout") . '">Logout</a></li>';
                                    } else {
                                        $menu  = '<li><a href="' . base_url("/") . '">Beranda</a></li>
                                                  <li><a href="' . base_url("/login") . '">Login</a></li>';
                                    }

                                    echo $menu;
                                    ?>
                                </ul>
                            </div>
                        </div>

                        <div class="contact">
                            <a href="#">KALKULATOR BAHAN PANGAN</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <?= $this->renderSection('content'); ?>



    <div class="footer fixed-bottom p-15" style="background-color:#015871;padding:20px"></div>

    <script src="<?= base_url('public/themes/js/jquery/jquery-2.2.4.min.js'); ?>"></script>
    <script src="<?= base_url('public/themes/js/bootstrap/popper.min.js'); ?>"></script>
    <script src="<?= base_url('public/themes/js/bootstrap/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('public/themes/js/plugins/plugins.js'); ?>"></script>
    <script src="<?= base_url('public/themes/js/active.js'); ?>"></script>
    <script src="<?= base_url('public/selectize/selectize.js'); ?>"></script>
    <script src="<?= base_url('public/alert/sweetalert2.all.min.js'); ?>"></script>

    <?= $this->renderSection('extra-js'); ?>
</body>

</html>