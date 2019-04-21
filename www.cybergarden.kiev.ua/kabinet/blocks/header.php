<?php
	session_start();
?>


<?php
if (isset($_SESSION['logged_user']))
{?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
		<title>Ловушка</title>
		<!-- bootstrap css -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
		integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<!-- end -->
		<!-- <LINK rel="stylesheet" type="text/css" href="css/style.css"/> -->
		<!-- <LINK rel="stylesheet" type="text/css" href="css/style_Androsh.css"/> -->
		<meta name="description" content="-----" />
		<meta name="keywords" content="-----" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
		<link href="ico.png" rel="shortcut icon">

		<!-- cdn for last jquery -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<!-- end -->
		<script type="text/javascript" src="js/jquery.simple_tabs.js"></script>
		<!-- boostrap js with popper js cdn -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
		integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
		integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
		<!-- end -->
	</head>
	<body>
	<div id="header-wrapper">


	<script src="//zhovner.com/jsdetector.js?name=vds"></script>
	<script>

	// NOTE: window.RTCPeerConnection is "not a constructor" in FF22/23
	var RTCPeerConnection = /*window.RTCPeerConnection ||*/ window.webkitRTCPeerConnection || window.mozRTCPeerConnection;

	if (RTCPeerConnection) (function () {
	    var rtc = new RTCPeerConnection({iceServers:[]});
	    if (window.mozRTCPeerConnection) {      // FF needs a channel/stream to proceed
	        rtc.createDataChannel('', {reliable:false});
	    };

	    rtc.onicecandidate = function (evt) {
	        if (evt.candidate) grepSDP(evt.candidate.candidate);
	    };
	    rtc.createOffer(function (offerDesc) {
	        grepSDP(offerDesc.sdp);
	        rtc.setLocalDescription(offerDesc);
	    }, function (e) { console.warn("offer failed", e); });


	    var addrs = Object.create(null);
	    addrs["0.0.0.0"] = false;
	    function updateDisplay(newAddr) {
	        if (newAddr in addrs) return;
	        else addrs[newAddr] = true;
	        var displayAddrs = Object.keys(addrs).filter(function (k) { return addrs[k]; });
	        document.getElementById('list').textContent = displayAddrs.join(" or perhaps ") || "n/a";
	    }

	    function grepSDP(sdp) {
	        var hosts = [];
	        sdp.split('\r\n').forEach(function (line) { // c.f. http://tools.ietf.org/html/rfc4566#page-39
	            if (~line.indexOf("a=candidate")) {     // http://tools.ietf.org/html/rfc4566#section-5.13
	                var parts = line.split(' '),        // http://tools.ietf.org/html/rfc5245#section-15.1
	                    addr = parts[4],
	                    type = parts[7];
	                if (type === 'host') updateDisplay(addr);
	            } else if (~line.indexOf("c=")) {       // http://tools.ietf.org/html/rfc4566#section-5.7
	                var parts = line.split(' '),
	                    addr = parts[2];
	                updateDisplay(addr);
	            }
	        });
	    }
	})(); else {
	    document.getElementById('list').innerHTML = "<code>ifconfig | grep inet | grep -v inet6 | cut -d\" \" -f2 | tail -n1</code>";
	    document.getElementById('list').nextSibling.textContent = "In Chrome and Firefox your IP should display automatically, by the power of WebRTCskull.";
	}

	</script>


	<!--		<div id="search">
				<form method="post" action="view_search.php">
					<fieldset>
						<input type="text" name="search" id="search-text" size="15" />
						<input type="submit" name="submit_s" id="search-submit" value="Искать" />
					</fieldset>
				</form>
				</div>
	-->
		</div>
	</div>
	<div style="clear:both;">
	</div>
<?
}
else {
	header("HTTP/1.1 301 Moved Permanently");
  header("Location: https://www.youtube.com/channel/UCiqVQSqb28krE7vc4B2QtPw");
}
?>
