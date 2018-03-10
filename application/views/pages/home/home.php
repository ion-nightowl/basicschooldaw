
<script type="text/javascript" src="<?= base_url()?>assets/js/site/realtime.post.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/js/site/posts.js" defer="defer"></script>

<div class="online-div">
		<b>Mga kaibigan</b>
		<hr>
		<!-- <div class="chip">
		  <img src="<?= base_url('assets/images/user.jpg') ?>" alt="Person" width="96" height="96">
		  John Doeasdasdadasd
		</div> -->
		

		<?php foreach($contacts as $contact): ?>

					<div class="chip" id="<?= $contact['id'] ?>">
					  <img src="<?= base_url('assets/images/user.jpg') ?>" alt="Person" width="96" height="96">
					  	<span><?= $contact['fname'].'  '.$contact['lname']?></span>
					  	<?php if($contact['status'] == 'online'): ?>
					  		<i id="status<?= $contact['id'] ?>" class="fas fa-circle pull-right" style="margin-top: 15px;color:#32ff7e"></i>
					  	<?php else: ?>
					  		<i id="status<?= $contact['id'] ?>" class="fas fa-circle pull-right" style="margin-top: 15px;color:#b2bec3"></i>
					  	<?php endif; ?>
					</div>

		<?php endforeach; ?>

</div>

<div class="row">
	<div class="col-md-3 less-margin1 something">
		<div class="panel panel-default">
			<div class="panel-body">
				<span style="font-size: 22px;font-weight: 700;display: block;">Join a group</span> <br>
				<label>Group Code</label>
				<input type="text" name="" class="form-control no-bshadow" placeholder="e.g 1a2b3c">
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-body">
				<span style="font-size: 22px;font-weight: 700;display: block;">Your groups</span> <br>
				<div class="grouplist">
					<ul>
					<?php foreach($groups as $group): ?>
						<li><?= $group['group_name']; ?></li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="panel-footer">
				<a href="<?= base_url('groups') ?>" style="text-decoration: none;">See all groups</a>
			</div>
		</div>

	</div>
	<div class="col-md-7">
		<div class="post-view">
			<form id="newpost">
			<div class="post-div">
				<div class="post-body">
					<textarea class="form-control" rows="5" placeholder="Anong nasa isip mo?" id="postbody" name="postbody"></textarea>
					<div class="attachments"></div>
				</div>
				<div class="post-btn">
					<b data-toggle="tooltip" title="Attach File">
						<i class="fileUpload fas fa-paperclip fa-2x">
							<input class="upload" type="file" id="file" name="files[]" onchange="preview_images();" multiple="multiple" accept="image/*">
						</i>
					</b> &nbsp; 
					<b data-toggle="tooltip" title="Create Poll"><i class="fas fa-sliders-h fa-2x"></i></b>
					<input type="submit" id="postbtn" class="btn btn-info" value="I Post" style="float:right;"> <br>
				</div>
			</div>
			</form>

			<?php

				if ($posts != 0) :
					foreach($posts as $post):
			?>

				<div id="posts">
			
				<div class="post-div" id="post-<?= $post['postid'] ?>">
					<div class="row">
						<?php
							if($post['control'] == 1):
						?>
							<div class="dropdown delete-post">
						        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						        <b><i class="fas fa-caret-down fa-lg"></i></b>
						        <ul class="dropdown-menu dropdown-menu-right">
						          <li class="editpost" id="edit<?= $post['postid'] ?>"><a><i class="fa fa-edit" aria-hidden="true"></i> Baguhin </a></li>
						          <li class="deletepost" id="delete<?= $post['postid'] ?>"><a><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Burahin</a></li>
						        </ul>
						    </div>
						<?php
							else:

						?>
							<div class="dropdown delete-post">
						        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						        <b><i class="fas fa-caret-down fa-lg"></i></b>
						        <ul class="dropdown-menu dropdown-menu-right">
						          <li class="report" id="report<?= $post['postid'] ?>"><a href="#">Isumbong</li>
						          
						        </ul>
						    </div>

						<?php
							endif;
						?>
					
						<div class="col-md-2 col-xs-3 inline">
							<a href="#">
							<img src="<?php echo base_url(); ?>assets/images/user.jpg" class="post-img">
							</a>
						</div>
						<div class="col-md-9 col-xs-6 inline">
							<div class="post-name">
								<p><?= $post['name']; ?></p>
							</div>
							<div class="post-date">
								<span class="date-post" datetime="<?= $post['date']; ?>"><?= $post['date']; ?></span>
							</div>
						</div>
					</div>
					<div class="post-body">
						<div class="editbody" id="editpost-<?= $post['postid']; ?>"><?= $post['body']; ?></div>
						<div id="editholder-<?= $post['postid']; ?>" ></div>
					</div>
					<div class="post-btn">
						<b><i class="far fa-heart fa-lg"></i> Pusuan</b> &nbsp; &nbsp; <b><i class="far fa-comment fa-lg"></i> Kumento</b>
					</div>
					<div class="post-comment">
						<input type="text" name="" class="form-control" placeholder="Write your comment here">
					</div>
				</div>

				 

				
			</div> 


			<?php
					endforeach;
				else:
			?>
				<div style="text-align: center"  id="posts">
					<i class="fab fa-earlybirds" style="font-size: 300px;"></i>
					<br>
					<h2 style="font-family: Font Awesome\ 5 Brands;">Ooooops. no posts yet</h2>
				</div>
			<?php

				endif;

			?>

				
		</div> <!-- POST VIEW -->	
	</div><!-- md-7 -->
	<div class="col-m-2">
		
	</div>
</div>



<div class="fchat-box">
	<div class="fchat-head msg-toggle">
		<i id="chat-box-stat" class="fas fa-circle" style="color:#32ff7e"></i>
		<span id="fchat-name"></span>
		<div class="pull-right">
			<i class="fa fa-times msg-close" aria-hidden="true"></i>
		</div>
	</div>
	<div class="fchat-body">
		<div class="fchat-view" id="chatview">

			
     	
     	</div>

	</div>
	<div class="fchat-text">
		<form id="fchat">
			<input type="text" name="" class="form-control no-rad msgg-box" placeholder="Isulat ang iyong mensahe" id="messagehere" autocomplete="off">
		</form>
	</div>
	<div class="fchat-btn">
		<form>
		<b data-toggle="tooltip" title="Attach File">
			<i class="fileUpload fas fa-paperclip fa-lg">
				<input class="upload" type="file" id="file" name="files[]" onchange="preview_images();" multiple="multiple" accept="image/*" onchange="this.form.submit();">
			</i>
		</b>
		</form>
	</div>
</div>