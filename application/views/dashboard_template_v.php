<?php
    $user = $this->session->userdata('logged_in_user');
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
        <link rel="stylesheet" type="text/css" href="assets/build/style/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
    </head>
    <body class="luft-template-dashboard">
        <div class="luft-content-area">
            <?php if (!empty($error)): ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning! </strong> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php
                if( $this->session->flashdata( 'success_message' ) ){
                    ?> <span class="form-success"> <?php echo $this->session->flashdata( 'success_message' ); ?> </span> <?php 
                }
            ?>
            <?php
                if( $this->session->flashdata( 'error_message' ) ){
                    ?> <span class="form-err"> <?php echo $this->session->flashdata( 'error_message' ); ?> </span> <?php 
                }
            ?>

            <?php if('staff' == $user['role']): ?>

            <section class="luft-menu-area">
                <ul class="sidebar-menu">
                    <li class="sidebar-header">MENU</li>
                    <li>
                        <a href="#">
                        <i class="fas fa-home"></i> Dashboard </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="far fa-calendar-times"></i> <span>events</span> <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href=""> add events </a></li>
                            <li><a href=""> all events </a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                        <i class="fas fa-user-friends"></i> <span>staff</span> <i class="fa fa-angle-right pull-right"></i> </a>
                        <ul class="sidebar-submenu">
                            <li><a href=""> add staff </a></li>
                            <li><a href=""> all staff </a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                        <i class="fas fa-cog"></i> setting </a>
                    </li>

                    <li>
                        <a href="user/logout">
                        <i class="fas fa-sign-out-alt"></i> logout </a>
                    </li>


                </ul>
            </section>

            <?php elseif ('administrator' == $user['role']): ?>
            <section class="luft-menu-area">
                <ul class="sidebar-menu">
                    <li class="sidebar-header">MENU</li>
                    <li>
                        <a href="#">
                        <i class="fas fa-home"></i> Dashboard </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="far fa-calendar-times"></i> <span>events</span> <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href=""> add events </a></li>
                            <li><a href=""> all events </a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                        <i class="fas fa-user-friends"></i> <span>staff</span> <i class="fa fa-angle-right pull-right"></i> </a>
                        <ul class="sidebar-submenu">
                            <li><a href=""> add staff </a></li>
                            <li><a href=""> all staff </a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                        <i class="fas fa-cog"></i> setting </a>
                    </li>

                    <li>
                        <a href="user/logout">
                        <i class="fas fa-sign-out-alt"></i> logout </a>
                    </li>


                </ul>
            </section>
            <?php endif; ?>

            <div id="luft-main-content">
                <div class="luft-user-content-area">
                    <?php
                        $page = ('administrator' == $user['role'] ? 'admin/' : 'staff/') . $page;
                        $this->load->view($page); 
                    ?>
                </div>
            </div>
        </div>

        <!-- script files -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="assets/build/js/slideout-menu.js"></script>
        <script src="assets/build/js/custom.js"></script>       
    </body>
</html>
