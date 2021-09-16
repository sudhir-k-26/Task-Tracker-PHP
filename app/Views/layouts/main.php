<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<a href="index.php"><title>Task Tracking Manager</title></a>
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/custom.css">
<script src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
</head>
<body>
 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="brand" href="<?php echo base_url(); ?>">Tasks Tracker</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
             <!--RIGHT TOP CONTENT-->
             <?php if(\Config\Services::session()->get('is_login')) : ?>
               Welcome,  <?php echo \Config\Services::session()->get('username'); ?>
             <?php else : ?>
                <a href="<?php echo base_url(); ?>/users/register">Register</a>
                <?php endif; ?>
            </p>
            <ul class="nav">
              <li><a href="<?php echo base_url(); ?>">Home</a></li>
              <?php if(\Config\Services::session()->get('is_login')) : ?>
                    <li><a href="<?php echo base_url(); ?>/lists">My Lists</a></li>  
               <?php endif; ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
          <div style="margin:0 0 10px 10px;">
			    <?php echo view("users/login") ?>
          </div>
          </div><!--/.well -->
        </div><!--/span-->

        <div class="span9">
   		<!--MAIN CONTENT-->
      
      <?php echo view($main_content); ?>	
        </div><!--/span-->
		</div><!--/row-->
      <hr>

      <footer>
        <p class="text-center">&copy; Copyright 2021</p>
      </footer>
    </div><!--/.fluid-container-->
</body>
</html>