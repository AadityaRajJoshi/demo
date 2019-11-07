<?php
    $role = $this->session->userdata('role');
    $user = $this->session->userdata('username');
    $error = $this->session->flashdata('error');
    $success = $this->session->flashdata('success');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Admin - <?php echo $meta['title']; ?></title>
        <meta name="keyword" content="<?php echo $meta['keyword']; ?>">
        <meta name="description" content="<?php echo $meta['description']; ?>">
        <meta name="viewport" content="width=device-width">
        <base href="<?php echo base_url(); ?>">
        <link rel="stylesheet" type="text/css" href="assets/build/style.css">
    </head>
    <body>
        <div>
            <header>
                <div class="name"><?php echo $user ?></div>
                <div class="role"><small><?php echo $role ?></small></div>
                This is header
            </header>
            <div class="container">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Warning! </strong> <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <?php if(!empty($success)): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong><span class="fa fa-check-circle"></span></strong> <?php echo $success; ?>
                    </div>
                <?php endif; ?>

                <div>
                    <?php if('staff' == $role): ?>
                        Staff Menu here
                    <?php elseif ('administrator' == $role): ?>
                        Admin Menu here
                    <?php endif; ?>
                </div>
                <div id="main">
                    <?php
                        $page = 'administrator' == $role ? 'admin/' : 'staff/' . $page;
                        $this->load->view($page); 
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
