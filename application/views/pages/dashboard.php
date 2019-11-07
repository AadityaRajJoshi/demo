<?php  $this->load->view( 'templates/header' ); ?>
<h1>I am Dashboard</h1>
<a href="<?php echo site_url( 'login/session_end' ); ?>">Logout</a>
<?php $this->load->view( 'templates/footer' ); ?>