<?php

include "lib/class.phpmailer.php";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = "smtp.live.com";
$mail->SMTPAuth = true;
$mail->Port = 587;
$mail->Username= "dennislysenko@hotmail.com";
$mail->Password= "Dennis852!";
$mail->SMTPSecure = 'tls';
$mail->From = "dennislysenko@hotmail.com";
$mail->FromName= "LowDistrict";
$mail->isHTML(true);
$mail->Subject = "Question Submission";
$mail->Body = generateBody();
$mail->addAddress("thelowdistrict@hotmail.com");
//if (true) {
if ($mail->send()) {
	echo "Thank you for your feedback!";
}
else {
	echo "Hmmm? Something went wrong";
}

function generateBody() {
	ob_start();
?>
<body>
	<style media="screen">
	@import url('https://fonts.googleapis.com/css?family=Open+Sans');
	* {
		margin: 0px;
		padding: 0px;
		box-sizing: border-box;
		color: #333;
		text-decoration: none;
		font-family: 'Open Sans';
	}
	.clear-fix {
		clear: both;
	}
	.container {
		width: 700px;
		margin: 50px auto;
		background-color: #EEE;
		border-radius: 5px;
		overflow: hidden;
	}
	h1 {
		padding: 15px;
		font-size: 22px;
		font-weight: normal;
		color: #FFF;
		background-color: #333;
		text-align: center;
	}
	.items {
		padding: 15px 25px;
	}
	ul {
		float: left;
	}
	li {
		margin: 10px 0px;
		list-style-type: none;
		font-size: 16px;
		word-wrap: break-word;
	}
	span {
		font-weight: bold;
		margin-right: 15px;
	}
	</style>
	<div class="container">
		<h1><?php echo $_POST['_']; unset($_POST['_'])?></h1>
		<div class="items">
			<ul style="width: 80px;">
			<?php
			foreach ($_POST as $key=>$val) { ?>
				<li><span><?php echo $key; ?></span></li>
			<?php } ?>
			</ul>
			<ul style="width: 570px;">
			<?php
			foreach ($_POST as $key=>$val) { ?>
				<li><?php echo $val; ?></li>
			<?php } ?>
			</ul>
			<div class="clear-fix"></div>
		</div>
	</div>
</body>
<?php
	return ob_get_clean();
}
?>
