<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
	<link href="<?= base_url() ?>assets/css/fontawesome-all.min.css" rel="stylesheet">
	<script type="text/javascript" src="<?= base_url() ?>assets/js/sweetalert2.all.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/tether.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/popper.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/js/socket.io.js"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/js/site/functions.js" defer="defer"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/js/site/realtime.functions.js"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/js/timeago.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/js/site/notifications.js"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/js/site/realtime.notifications.js"></script>
	<input type="text" id="base_url" value="<?= base_url() ?>" hidden>
	<input type="text" id="user_id" value="<?= $userid ?>" hidden>
	<script type="text/javascript"> var base_url = $('#base_url').val(); var userid = $('#user_id').val();</script>   
</head>
<body>
<div id="sound"></div>


	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span> 
	      </button>
	      <a class="navbar-brand" href="#"><b style="">Mukhanglibro</b></a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	      	<li><a href="<?= $this->session->userdata['user']['username'] ?>"><b><?= $this->session->userdata['user']['fname'] ?></b></a></li>
	        <li><a href="<?= base_url()?>home"><i class="fas fa-home fa-lg"></i></a></li>
	        <li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		        <i class="fab fa-facebook-messenger fa-lg" ><span class="badge" id="msgnotif"><?= $notifs['notifcount']; ?></span></i></a>
		        <ul class="dropdown-menu" id="msgnotifbody">
		        	<?php if($notifs['notifcount'] == 0): ?>
		        		<li><a href="#">No new messages</a></li>
		        	<?php else: ?>
		        		<?php $x = 0; foreach($notifs['messages'] as $msg): ?>

		        			<li><a href="#"><?php
		        				echo "<label>" .$notifs['senderinfo'][$x]['fname'] ."</label><br>"; 
		        				if (strlen($msg['message_body']) < 30) {
		        				 	echo substr($msg['message_body'],0 ,30);
		        				 }else{
		        				 	echo substr($msg['message_body'],0 ,30).' . . .';
		        				 } $x++; ?></a></li>

		        		<?php endforeach;?>
		        	<?php endif; ?>
		        	<li class="divider"></li>
		          <li><a href="<?= base_url() ?>messages">See all messages</a></li>
		        </ul>
		    </li>
		    <li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		        <i class="far fa-bell fa-lg"></i></a>
		        <ul class="dropdown-menu">
		          <li><a href="#">No new notifications</a></li>
		          <li class="divider"></li>
		          <li><a href="#">See all notifications</a></li>
		        </ul>
		    </li>
	        <li><a href="#"></a></li> 
	        <li><a href="#"></a></li> 
	        <li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		        <i class="fas fa-caret-down fa-lg"></i></a>
		        <ul class="dropdown-menu">
		          <li><a href="<?= base_url() ?>settings"><i class="fas fa-cogs"></i> Settings</a></li>
		          <li><a href="<?= base_url() ?>account"><i class="fas fa-user"></i> Account</a></li>
		          <li><a href="<?= base_url() ?>logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
		        </ul>
		    </li>

	      </ul>
	    </div>
	  </div>
	</nav>

	<div class="container">

	<div class="extranav">
	<div class="row">
		<div class="col-xs-12  less-margin1">
			<div class="panel panel-default no-rad">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4" style="text-align: center;">
							aw
						</div>
						<div class="col-xs-4" style="text-align: center;">
							<a href="<?= base_url()?>home"><i class="fas fa-home fa-lg"></i></a>
						</div>
						<div class="col-xs-4" style="text-align: center;">
							<a id="viewcontacts"><i class="fas fa-users fa-lg" style="cursor: pointer;"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>