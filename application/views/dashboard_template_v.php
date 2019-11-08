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
        <link rel="stylesheet" type="text/css" href="assets/build/style.css">
    </head>
    <body>
        <div>
            <div class="container">
                <?php if (!empty($error)): ?>
                    <span class="form-err"><?php echo $error; ?></span>
                <?php endif; ?>
                <?php
                    if( $this->session->flashdata( 'success_message' ) ){
                        ?> <span class="form-success"> <?php echo $this->session->flashdata( 'success_message' ); ?> </span> <?php 
                    }

                ?>
                <?php if (validation_errors() ): ?>
                    <span class="form-err"><?php echo validation_errors(); ?></span>
                <?php endif; ?>
                <div>
                    <?php if('staff' == $user['role']): ?>
                        <div>
                            <h3>Menu</h3>
                            <ul>
                                <li>Dashboard</li>
                                <li>My Events</li>
                                <li>My details</li>                                
                                <li>
                                    <a href="login/logout">Log Out</a>
                                </li>
                            </ul>
                        </div>
                    <?php elseif ('administrator' == $user['role']): ?>
                        <div>
                            <h3>Menu</h3>
                            <ul>
                                <li>Dashboard</li>
                                <li>Events
                                    <ul>
                                        <li>Add Event</li>
                                        <li>All Events</li>
                                    </ul>
                                </li>
                                <li>Staff
                                    <ul>
                                        <li><a href="staff/add">Add Staff</a></li>
                                        <li><a href="staff">All Staff</a></li>
                                    </ul>
                                </li>
                                <li>Setting</li>
                                
                                <li>
                                    <a href="login/logout">Log Out</a>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <div id="main">
                    <?php
                        $page = ('administrator' == $user['role'] ? 'admin/' : 'staff/') . $page;
                        $this->load->view($page); 
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
