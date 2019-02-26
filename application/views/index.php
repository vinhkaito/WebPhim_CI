<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport">
    <title>aa</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
</head>
<body>

<?php
$this->load->view('modules/header');
?>
<main class="container">
    <?php
    $this->load->view('modules/home');
    ?>
</main>
<?php
$this->load->view('modules/footer');
?>


<!-- Bootstrap JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
