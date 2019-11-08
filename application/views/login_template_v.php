<?php
    $error = $this->session->flashdata('error');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $meta['title']; ?></title>
        <meta name="keyword" content="<?php echo $meta['keyword']; ?>">
        <meta name="description" content="<?php echo $meta['description']; ?>">
        <meta name="viewport" content="width=device-width">
        <base href="<?php echo base_url(); ?>">
        <link rel="stylesheet" type="text/css" href="assets/build/style/login.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,700,900&display=swap" rel="stylesheet">
    </head>
    <body class="luft-template-login luft-bg-primary">
        <div>
            <div class="container">
                <?php if (validation_errors() || !empty($error)): ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Warning!</strong> <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>               
            </div>
        </div>
        <?php $this->load->view('login/' . $page); ?>
    </body>
</html>
