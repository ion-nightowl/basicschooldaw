<script type="text/javascript" src="<?= base_url()?>assets/js/site/realtime.messages.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/js/site/messages.js" defer="defer"></script>


<div class="row">
	<div class="col-md-3 less-margin1">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="list-group" id="contact-list">
					<?php 
						$count = 0;
						foreach($contacts as $contact){

							if ($count == 0) {
								echo '<a href="#" class="active list-group-item chat-user" id="user-'.$contact['id'].'">'.$contact['fname'].' <span id="usernotif'.$contact['id'].'"></span></a>';
							}else{
								echo '<a href="#" class="list-group-item chat-user" id="user-'.$contact['id'].'">'.$contact['fname'].' <span id="usernotif'.$contact['id'].'"></span></a>';
							}

							$count++;
						}

					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		


            <div class="panel panel-default">
              <div class="panel-body chatbox">
                <div class="chatview" id="chatview">

<!--
                      <div class="chat-wrap">
                        <img src="../images/users/0301323.jpg" class="chat-avatar" height="30px" width="30px" data-toggle="tooltip" title="ion.nightowl">
                        <span class="chat-name">ion.nightowl</span><br>
                        <div class="chat-bubble">
                          <div class="chat-text">
                            <p>Hello World sdfghjkalsdaasdasd </p>
                          </div>
                        </div>
                      </div>

                      <div class="chat-wrap" align="right">
                        <div class="chat-self">
                          asdas
                        </div>
                      </div>
                    
                      <div class="chat-wrap" align="right">
                        <div class="chat-self">
                          asdas
                        </div>
                      </div>

                      <div class="chat-wrap">
                        <img src="../images/users/0301323.jpg" class="chat-avatar" height="30px" width="30px" data-toggle="tooltip" title="ion.nightowl">
                        <span class="chat-name">ion.nightowl</span><br>
                        <div class="chat-bubble">
                          <div class="chat-text">
                            <p>Hello World sdfghjkalsdaasdasd </p>
                          </div>
                        </div>
                      </div>    -->
                </div>

                <form id="chatform">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Write message here" id="messagehere" autocomplete="off" autofocus="on">
                    <div class="input-group-btn">
                      <button class="btn btn-default" type="submit">
                        <i class="glyphicon glyphicon-send"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
              	
          
           
	</div>
</div>