<?php
    $role = get_session('role');
    $error = $this->session->flashdata('error');
    $success = $this->session->flashdata('success');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
            <?php 
                $r = 'administrator' == get_session( 'role' ) ? 'Admin' : 'Staff';
                echo $r . ' - ' . $meta['title'];
            ?>
        </title>
        <meta name="keyword" content="<?php echo $meta['keyword']; ?>">
        <meta name="description" content="<?php echo $meta['description']; ?>">
        <meta name="viewport" content="width=device-width">
        <base href="<?php echo base_url(); ?>">
        <link rel="stylesheet" type="text/css" href="assets/build/style/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
    </head>
    <body class="luft-template-dashboard">
        <div class="luft-content-area">
            <?php if (!empty($success)): ?>
                <span class="form-success"><?php echo $success; ?></span>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <span class="form-err"><?php echo $error; ?></span>
            <?php endif; ?>

            <?php if (validation_errors()): ?>
                <span class="form-err"><?php echo validation_errors(); ?></span>
            <?php endif; ?> 

            <section class="luft-menu-area animate-menu animate-menu-left">
                <ul class="sidebar-menu">
                    <li class="sidebar-header"><?php echo get_msg( 'menu' ) ?></li>
                    <?php foreach ( $menu as $key => $value) {
                        if( isset( $value[ 'menu' ] ) ){ ?>
                            <li <?php echo get_active_class( $key ) ?> >
                                <a href="#">
                                    <i class="<?php echo $value[ 'icon' ]; ?>"></i>
                                    <span><?php echo $value[ 'title' ] ?></span>
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                <ul class="sidebar-submenu">
                                    <?php foreach ( $value[ 'menu' ] as $k => $v ){ ?>
                                        <li>
                                            <a href="<?php echo $k ?>"> <?php echo $v?> </a></li>
                                    <?php } ?>  
                                </ul>
                            </li>
                        <?php }else{ ?>
                            <li <?php echo get_active_class( $key ) ?> >
                                <a href="<?php echo $key ?>">
                                <i class="<?php echo $value[ 'icon' ]; ?>"></i> <?php echo $value[ 'title' ] ?> </a>
                            </li>
                        <?php }
                    } ?>
                </ul>
            </section>
            <div id="luft-main-content">

                <div class="luft-header-area">
                    <div class="luft-menu-toggler btn btn-primary" id="showLeft">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="luft-user-icon">
                        <ul>
                            <?php if( is_admin() ){?>
                            <li class="luft-notification"><a href="#"><i class="far fa-bell"></i> <span>2</span></a>
                                <ul class="luft-notification-sub">
                                    <li><a href="#"> Integer ante arcu accumsan a </a></li>
                                    <li><a href="#"> Integer ante arcu accumsan a </a></li>
                                </ul>                        
                            </li>
                            <?php }  ?>
                            
                            <li class="luft-user-image">
                                <a href="#" onclick="return false;"><img src="assets/image/user.png" alt="user" /></a>
                                <ul class="user-info-sub">
                                    <li class="luft-user-sub-link"><a href="user/edit/<?php echo get_session('id'); ?>"><i class="fas fa-cog"></i> My details </a></li>
                                    <li class="luft-user-sub-link logout-link "><a href="user/logout"><i class="fas fa-sign-out-alt"></i> Logout </a></li>
                                </ul>
                        
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="breadcrumb">
                    <?php 
                        if( isset( $breadcrumb ) && !empty( $breadcrumb ) ){
                            breadcrumb_tail( $breadcrumb );
                        }
                    ?>
                </div>

                <div class="luft-user-content-area">
                    <?php
                        
                    if(isset($common)){
                       $page =  'common/'.$page;
                        $this->load->view($page);
                    }else{
                         $page = ('administrator' == $role ? 'admin/' : 'staff/') . $page;
                        $this->load->view($page); 
                    }  
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
