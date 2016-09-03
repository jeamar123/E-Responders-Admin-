<?php 
    if ($this->session->userdata('logged_in')) {
        header("location: ".base_url('admin/#/dashboard'));     
    }
	header("Cache-Control", "no-cache, no-store, must-revalidate");
 ?>
<!DOCTYPE html>
<html ng-app="app">
<head>
	<title>CDO Responder</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>
	<h2>Main Access Page</h2>
	<br>
	<button class="btn btn-info" data-toggle="modal" data-target="#myModal">Login</button>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" login-auth>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Login</h4>
				</div>
				<div class="modal-body">
					<div class="box box-primary">

					<form>
						<div class="form-group">
							<label>Username</label>
							<input class="form-control" type="text" ng-model="user.username" name="username" placeholder="Enter username">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input class="form-control" type="password" ng-model="user.password" name="password" placeholder="Enter password">
						</div>
					</form>						
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" ng-click="authenticate_login()" class="btn btn-primary pull-left">Login</button>
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/angular.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/angular-route.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/factory.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/directive.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/controllers.js') ?>"></script>
   	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular-sanitize.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.2.1.js"></script>
</body>
</html>