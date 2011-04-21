<?php header("Content-type: text/css"); ?>
/* ---------- MesageBox ---------- */

#content #message {
	display: table;
	width: 48em;
	height: 12em;
	background: #FDFEFF;
	border:1px solid #DCDDDE;
	font-size: 1.2em;
}

#content #innermessage {
	display: table-cell;
	text-align: center;
	vertical-align: middle;
}

#content #message h1 {
	font-size: 2.0em;
}

/* ---------- SettingBox ---------- */

#content #setting {
	display: table;
	width: 48em;
	height: 34em;
	background: #FDFEFF;
	border:1px solid #DCDDDE;
	font-size: 1.2em;
}

#content #setting #innersetting {
	display: table-cell;
	text-align: center;
	vertical-align: middle;
}

#content #setting #innersetting .smaster {
	margin: 0 20%;
	width: 80%;
	clear: both;
}

#content #setting #innersetting .skey,
#content #setting #innersetting .sval {
	float: left;
	height: 2.5em;
	line-height: 2.5em;
	text-align: left;
}

#content #setting #innersetting .skey {
	width: 30%;
	font-weight: bold;
}

#content #setting #innersetting .sval {
	width: 50%;
}
#content #setting #innersetting .sval input,
#content #setting #innersetting .sval select {
	margin: 0.2em 0;
	padding: 0.3em;
	height: 1.5em;
	line-height: 1.5em;
	border: 1px solid #CCC;
}

#content #setting #innersetting .sval input {
	<?php gradient("EDEEEF","FDFEFF"); ?>
	<?php borderRadius(6,6,6,6); ?>
	width: 90%;
}

#content #setting #innersetting .sval input:focus {
	<?php gradient("F7F8F9","FDFEFF"); ?>

<?php
function gradient($from,$to){ echo
   'background: -webkit-gradient(linear,left top,left bottom,from(#'.$from.'),to(#'.$to.'));
	background: -moz-linear-gradient(top,#'.$from.',#'.$to.');
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.$from.'FF, endColorstr=#'.$to.'FF);
	-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.$from.'FF, endColorstr=#'.$to.'FF)";
';}
function borderRadius($tl,$tr,$br,$bl){ echo
   'border-radius: '.$tl.'px '.$tr.'px '.$br.'px '.$bl.'px;
	-webkit-border-radius: '.$tl.'px '.$tr.'px '.$br.'px '.$bl.'px;
	-moz-border-radius: '.$tl.'px '.$tr.'px '.$br.'px '.$bl.'px;
';}
