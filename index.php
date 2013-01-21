<!DOCTYPE html>
<html>
<title>URL shortener</title>
<meta name="robots" content="noindex, nofollow">

<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>

</html>
<body>
<form method="post" action="shorten.php" id="shortener">
<label for="longurl">URL to shorten</label>
<input type="text" name="longurl" id="longurl">
<label for="longurl">Short URL</label> <input type="text" name="shorturl" id="shorturl" maxlength="5">
<input type="submit" value="Shorten">
</form>
</form>
<div id="fullurl"></div>
<div id="urllist" style="margin-top: 50px;">
	<b>URL List:</b>
	<br>
	<?php
	include 'listurls.php';
	?>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
	$('#shortener').submit(function () {
		$.ajax({data: {longurl: $('#longurl').val(), shorturl: $('#shorturl').val()}, url: 'shorten.php', complete: function (XMLHttpRequest, textStatus) {
/* 			$('#longurl').val(XMLHttpRequest.responseText); */
			$('#fullurl').html("<a href='"+XMLHttpRequest.responseText+"'>"+XMLHttpRequest.responseText+"</a>");
		}});
		return false;
	});
});
</script>
</body>
</html>