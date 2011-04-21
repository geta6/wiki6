<?php header("Content-type: text/css"); ?>
/* ---------- Design Base ---------- */

body {
	font-size: 10px;
	line-height: 1.5;
	color: #202428;
	font-family: helvetica, arial, sans-serif;
	background: url('img/noise.png') #EEEFF0;
}

/* ---------- Template ---------- */

a.nav {
	display: block;
	float: left;
	margin: 1em 0 1em 1em;
	padding: 0 1em;
	height: 2em;
	line-height: 2em;
	text-decoration: none;
	color: #FDFEFF;
	<?php borderRadius("10","10","10","10"); ?>
}

a.nav:hover {
	background: #5A5C5E;
	cursor: pointer;
}

.ac, .ok, .ng {
	margin: 0 1em;
	padding: 0.5em 2em;
	border: 1px solid #DCDDDE;
	<?php borderRadius("20","20","20","20"); ?>
	color: #202428;
	font-weight: bold;
}

.ok {
	<?php gradient("FFDB58","FFBC19"); ?>
}

.ok:hover {
	cursor: pointer;
	<?php gradient("F4D04D","F4B10e"); ?>
}

.ng {
	<?php gradient("F2F2F2","E5E5E5"); ?>
}

.ng:hover {
	cursor: pointer;
	<?php gradient("E7E7E7","DADADA"); ?>
}

a.nav:active,
.ok:active,
.ng:active {
	position: relative;
	left: 1px;
	top: 1px;
}

input[name='password'],
#content #nav input {
	margin: 1em;
	padding: 0.5em;
	font-family: monospace;
	border: 1px solid #DCDDDE;
}
#content #nav input {
	width:16em;
}


/* ---------- Navigation ---------- */

#header {
	<?php gradient("555555","343434"); ?>
	<?php boxShadow(0,0,4,2,"202428")?>
}

#header header {
	padding: 1em 5em;
}

#header header hgroup {
	line-height: 1.2;
	color: #EEEFF0;
}

#header header hgroup h1 {
	font-weight: bold;
	font-size: 2.2em;
}

#header header hgroup h1 a:hover {
	color: #FDFEFF;
}

#header header hgroup h2 {
	padding: 0.4em 0.1em;
	font-size: 1em;
}

/* ---------- Content ---------- */

#content {}

/* ---------- Content.Article ---------- */

#content #article {}

#content #article article {
	padding: 2em 2em 2em 5em;
}

#content #article article #section,
#content #article article #action {
	background: #FDFEFF;
	border:1px solid #DCDDDE;
}

#content #article article #action {
	border-top: none;
	color: #868788;
	text-align:right;
}

#content #article article #action a {
	margin-left: 0.5em;
	padding: 0.1em;
	color: #202428;
	background: #EEEFF0;
	text-decoration: underline;
}

#content #article article #action a:hover {
	text-decoration: none;
	cursor: pointer;
}

#content footer{
	color: #868788;
	text-align:center;
}

/* ---------- Content.Sidebar ---------- */

#content #nav .ok,
#content #nav .ng {
	margin: 0;
	padding: 0.5em 0.5em;
}

#content .createon {
	position: fixed;
}

#content #nav a.nav {
	cursor: pointer;
}

#content #nav ul {
	margin: 0;
	padding: 1em 0;
}

#content #nav ul li {
	margin-left: 1em;
	list-style: none;
}

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
function boxShadow($x,$y,$b,$s,$c){ echo
   '-webkit-box-shadow: '.$x.'px '.$y.'px '.$b.'px '.$s.'px #'.$c.';
	-moz-box-shadow: '.$x.'px '.$y.'px '.$b.'px '.$s.'px #'.$c.';
	box-shadow: '.$x.'px '.$y.'px '.$b.'px '.$s.'px #'.$c.';
';}
