<?php
    $flash_error = $this->session->flashdata('error');
    if(! empty($flash_error)){
        $error[] = $flash_error;
    }

    if(validation_errors()){
        $error[] = validation_errors();
    }

    $flash_success = $this->session->flashdata('success');
    if(! empty($flash_success)){
        $success[] = $flash_success;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
            <?php 
                $r = is_admin() ? 'Admin' : 'Staff';
                echo $r . ' - ' . $meta['title'];
            ?>
        </title>
        <meta name="keyword" content="<?php echo $meta['keyword']; ?>">
        <meta name="description" content="<?php echo $meta['description']; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="<?php echo base_url(); ?>">
        <link rel="stylesheet" type="text/css" href="assets/build/style/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    </head>
    <body class="luft-template-dashboard<?php echo isset($body_class)? ' '.$body_class:''; ?>">
        <div class="luft-content-area">
            <?php 
                print_success_msg($success); 
                print_error_msg($error);
            ?>
            <section class="luft-menu-area animate-menu animate-menu-left">
                <div class="display-on-mobile close-icon-mobile">
                    <img src="assets/image/close.png" alt="close" />
                </div>
                <?php menu($current_menu); ?>
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
                                <a href="#" onclick="return false;"><?php if($profile_picture){?>
                                    <img src=" <?php echo get_profile_picture() ?> ">
                                    <?php }else{ ?>
                                        <p class="profile-name"> <?php echo get_first_letter(); ?> </p>
                                  <?php  }  ?>  </a>
                                <ul class="user-info-sub">
                                    <li class="luft-user-sub-link"><a href="<?php echo get_route('profile'); ?>"><i class="fas fa-cog"></i> My details </a></li>
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
                           $page = 'common/'.$page;
                        }else{
                            $page = ('administrator' == get_session('role') ? 'admin/' : 'staff/') . $page;
                        }
                        $this->load->view($page); 
                    ?>
                </div>
            </div>
        </div>

        <!-- script files -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <script src="assets/build/js/slideout-menu.js"></script>
        <script type="text/javascript">
            var LUFTLEK = {
                'ajax_url': '<?php echo base_url(); ?>',
                'route': {
                    'event_toggle_status': '<?php echo get_route('event_toggle_status'); ?>'
                }
            };
        </script>
        <script src="assets/build/js/custom.js"></script>       
    </body>
</html>
