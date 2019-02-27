<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>WebPhimCI</title>

    <link rel="stylesheet" href="<?= base_url() ?>./bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>./css/all.css"/>
</head>
<body>
    <?php
    $this->load->view('modules/header');
    ?>
    <main role="main" class="container">
        <?php
        $this->load->view('modules/home');
        ?>
    </main>
    <?php
    $this->load->view('modules/footer');
    ?>
<!-- Bootstrap JavaScript -->
<script src="<?= base_url() ?>./bootstrap/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>./bootstrap/js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>./bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
