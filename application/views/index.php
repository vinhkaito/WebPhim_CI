<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>WebPhimCI</title>

    <link rel="stylesheet" href="<?= base_url() ?>./bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>./webroot/css/all.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>./webroot/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
    <?php
    $this->load->view('modules/header');
    ?>
    <main role="main" class="container-fluid">
        <?php
        // $this->load->view('modules/home');
        $this->load->view('page/infomation');
        ?>
    </main>
    <?php
    $this->load->view('modules/footer');
    ?>
<!-- Bootstrap JavaScript -->
<script src="<?= base_url() ?>./bootstrap/js/jquery-3.3.1.slim.min.js"></script>
<script src="<?= base_url() ?>./bootstrap/js/popper.min.js"></script>
<script src="<?= base_url() ?>./bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
