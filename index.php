<?php
date_default_timezone_set('Asia/Kolkata');
include('database.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex, nofollow">
	<title>PHP Chatbot</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="style.css" rel="stylesheet">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

	<style>
		.unread {
	cursor: pointer;
	background-color: #f4f4f4;
}
.messages-box {
	max-height: 28rem;
	overflow: auto;
}
.online-circle {
	border-radius: 5rem;
	width: 5rem;
	height: 5rem;
}
.messages-title {
	float: right;
	margin: 0px 5px;
}
.message-img {
	float: right;
	margin: 0px 5px;
}
.message-header {
	text-align: right;
	width: 100%;
	margin-bottom: 0.5rem;
}
.text-editor {
	min-height: 18rem;
}
.messages-list li.messages-you .messages-title {
	float: left;
}
.messages-list li.messages-you .message-img {
	float: left;
}
.messages-list li.messages-you p {
	float: left;
	text-align: left;
}
.messages-list li.messages-you .message-header {
	text-align: left;
}
.messages-list li p {
	max-width: 60%;
	padding: 5px;
	border: #e6e7e9 1px solid;
}
.messages-list li.messages-me p {
	float: right;
}
.ql-editor p {
	font-size: 1rem;
}  
	</style>
</head>

<body>
	<div class="container">
		<div class="row justify-content-md-center mb-4">
			<div class="col-md-6">
				<!--start code-->
				<div class="card">
					<div class="card-body messages-box">
						<ul class="list-unstyled messages-list">
							<?php
							$res = mysqli_query($con, "select * from message");
							if (mysqli_num_rows($res) > 0) {
								$html = '';
								while ($row = mysqli_fetch_assoc($res)) {
									$message = $row['message'];
									$added_on = $row['added_on'];
									$strtotime = strtotime($added_on);
									$time = date('h:i A', $strtotime);
									$type = $row['type'];
									if ($type == 'user') {
										$class = "messages-me";
										$imgAvatar = "user_avatar.png";
										$name = "Me";
									} else {
										$class = "messages-you";
										$imgAvatar = "bot_avatar.png";
										$name = "Chatbot";
									}
									$html .= '<li class="' . $class . ' clearfix"><span class="message-img"><img src="image/' . $imgAvatar . '" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">' . $name . '</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' . $time . '</span></small> </div><p class="messages-p">' . $message . '</p></div></li>';
								}
								echo $html;
							} else {
							?>
								<li class="messages-me clearfix start_chat" style="padding: 25px;text-align:center; justify-content:center; align-items:center; font-size:26px; font-family:arial">
									Need any help ? <br>	start chat with me
								</li>
							<?php
							}
							?>

						</ul>
					</div>
					<div class="card-header">
						<div class="input-group">
							<input id="input-me" type="text" name="messages" class="form-control input-sm" placeholder="Type your message here..." />
							<span class="input-group-append">
								<input type="button" class="btn btn-primary" value="Send" onclick="send_msg()">
							</span>
						</div>
					</div>
				</div>
				<!--end code-->

				<center>
				<a href="https://devsecit.com/" style="text-align: center; justify-content: center; text-align:center; margin-bottom: -15px; ">Powered by <b>DEV SEC IT PVT. LTD. </b></a>
				</center>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		jQuery('.messages-box').scrollTop(jQuery('.messages-box')[0].scrollHeight);

		function getCurrentTime() {
			var now = new Date();
			var hh = now.getHours();
			var min = now.getMinutes();
			var ampm = (hh >= 12) ? 'PM' : 'AM';
			hh = hh % 12;
			hh = hh ? hh : 12;
			hh = hh < 10 ? '0' + hh : hh;
			min = min < 10 ? '0' + min : min;
			var time = hh + ":" + min + " " + ampm;
			return time;
		}

		function send_msg() {
			jQuery('.start_chat').hide();
			var txt = jQuery('#input-me').val();
			var html = '<li class="messages-me clearfix"><span class="message-img"><img src="image/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p">' + txt + '</p></div></li>';
			jQuery('.messages-list').append(html);
			jQuery('#input-me').val('');
			if (txt) {
				jQuery.ajax({
					url: 'get_bot_message.php',
					type: 'post',
					data: 'txt=' + txt,
					success: function(result) {
						var html = '<li class="messages-you clearfix"><span class="message-img"><img src="image/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p">' + result + '</p></div></li>';
						jQuery('.messages-list').append(html);
						jQuery('.messages-box').scrollTop(jQuery('.messages-box')[0].scrollHeight);
					}
				});
			}
		}
	</script>

	<style>
		.col-md-6,
		.justify-content-md-center {
			margin: 0px;
			padding: 0px;
			overflow: hidden;
		}

		.card {
			height: 425px;
		}

		*,
		.container {
			margin: 0px;
			padding: 0px;
			/* border: 1px solid lightblue; */
		}

		.container {
			position: absolute;
			bottom: 0px;
			top: 0px;
		}
	</style>
</body>

</html>