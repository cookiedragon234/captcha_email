<?php

require('config.php');

?>
<html>
<head>
	<link rel="dns-prefetch" href="https://stackpath.bootstrapcdn.com">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

<div class="contact">
<h3>Contact</h3>
<p>
If you would like to contact me please click <a href data-toggle="modal" data-target="#exampleModal">here</a>
</p>
</div>
	
<script>
function gettheemail(a) {

    console.log('captcha response: ' + grecaptcha.getResponse()); // --> captcha response: 
	
	$.ajax({
		type: "POST",
		url: "getemail.php",
		data: "g-recaptcha-response=" + grecaptcha.getResponse(),
		success: function(d){
			var a;
			a = jQuery.parseJSON(d).email
			console.log("Success. Email:" + a);
			$('#emailbox').text(a);
			$('#captchag').hide();
			$('#prompt').text("My email:");
			$("#linker").attr("href", "mailto:" + a);
		},
		failure: function(d){
			alert("internet access error");
		}
	});
}
</script>
	
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<!--<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>-->
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<span id="prompt">Please click the recaptcha below and the email will be shown:</span>
			<div id="captchag" class="g-recaptcha" data-sitekey="<?php echo $confsitekey;?>" data-callback="gettheemail"></div>
			<br><a id="linker"><span id="emailbox"></span></a>
		</div>
		<!--<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
		</div>-->
		</div>
	</div>
</div>



</body>
</html>
