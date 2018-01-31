<?php
error_reporting(-1);
ini_set('display_errors', 'On');
if (!extension_loaded('json')) {
	dl('json.so');
}

$nid = intval($_GET['nid']);

//echo "https://safecomputing-dev.dsc.umich.edu/newsletter-json/$nid";
$raw = file_get_contents('https://safecomputing.umich.edu/leadership-bulletin-json/'.$nid);

//var_dump($raw);
//here's something strange and interesting that happened to this data feed:
//http://stackoverflow.com/questions/689185/json-decode-returns-null-after-webservice-call
if (json_decode($raw, true) == NULL) {
	$raw = substr($raw, 3);
}

//var_dump($raw); 


$issuename = "";
$i = 0;
$sectionname = "";
$lastsectionname = "";
$body = "";
$data = json_decode($raw, true);
$color="fff";
$himg = "";


foreach ($data['nodes'] as $node) {
	$sectionname = $node['node']['Section'];
	if ($i == 0) {
		$issuename = $node['node']['title'];
	}
		
	//check if it's a new thing or the first thing and tc of b
	if ($sectionname !== $lastsectionname) {
		if ($i == 0) {
			$table = "";
		}
		//it's a new thing, but not the first thing, so end the previous table
		else {
			//$table = "</td></tr></table></td></tr>";
			}

		if ($sectionname == "IIA Insights") {
			$color = "c5e0e9";
			$himg = "<img src='https://safecomputing.umich.edu/sites/default/files/iia-newsletter/icon-pencil.png' style='margin-right:.5em; margin-bottom:.25em; vertical-align:middle;' align='absmiddle' class='icon' alt='Pencil'>";
		}
		else if ($sectionname == "Infographic") {
			$color = "e6e6e6";
			$himg = "<img src='https://safecomputing.umich.edu/sites/default/files/iia-newsletter/icon-magnify.png' style='margin-right:.5em; margin-bottom:.25em; vertical-align:middle;' align='absmiddle' class='icon' alt='Magnifying Glass'>";
		}
		else if ($sectionname == "Threat Environment") {
			$color = "faddb6";
			$himg = "<img src='https://safecomputing.umich.edu/sites/default/files/iia-newsletter/icon-lock.png' style='margin-right:.5em; margin-bottom:.25em; vertical-align:middle;' align='absmiddle' class='icon' alt='Lock'>";
		}
		else if (strpos($sectionname, 'U-M IT Security Alerts') !== false) {
			$color = "fff1ba";
			$himg = "<img src='https://safecomputing.umich.edu/sites/default/files/iia-newsletter/icon-exclamation.png' style='margin-right:.5em; margin-bottom:.25em; vertical-align:middle;' align='absmiddle' class='icon' alt='Exclamation'>";
		}
		else if (strpos($sectionname, 'Major Initiatives') !== false) {
			$color = "d1e4b6";
			$himg = "<img src='https://safecomputing.umich.edu/sites/default/files/iia-newsletter/icon-checklist.png' style='margin-right:.5em; margin-bottom:.25em; vertical-align:middle;' align='absmiddle' class='icon' alt='Checklist'>";
		}
		else if ($sectionname == "Good for U") {
			$color = "e6e6e6";
			$himg = "<img src='https://safecomputing.umich.edu/sites/default/files/iia-newsletter/icon-thumbsup.png' style='margin-right:.5em; margin-bottom:.25em; vertical-align:middle;' align='absmiddle' class='icon' alt='Thumbs Up'>";
		}
		
		
		$body .= "
		<tr><td>
		<table border='0' cellpadding='0' cellspacing='0' width='100%;'><tr><td class='message_content' style='padding:15px; font-size:10pt; font-family:Arial,Helvetica,Geneva,sans-serif; color:#000000; line-height:135%;' align='left' valign='top' bgcolor='#".$color."'><h2 style='margin-top:0; font-size:14pt; color:#000000; line-height:normal;'>".$himg." ".$sectionname."</h2>";
	}
	
	//DOUBLE CEHCK THIS
	if ($node['node']['Title'] != 'none') {
		//var_dump($node['node']['Title']);
		//$body .= "<h3 style='margin-top:0; font-size:12pt; color:#000000; line-height:normal;'>".$node['node']['Title']."</h3>";
	}
	if ($node['node']['Story Image']!==NULL) {
		$body .= "<img style='display:block;' src='".$node['node']['Story Image']['src']."' align='right' hspace='10' alt=''/>";
	}
	
	$body .= $node['node']['body']."</td></tr></table>
	</td></tr>";

	//var_dump($node);
	//echo "<hr />";
	
	$lastsectionname = $node['node']['Section'];
	$i++;
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>ITS Information &amp; Infrastructure Assurance Leadership Bulletin</title>
<style type="text/css">
body { background:#ffffff; color:#333333; }
img[class="header_image"] { width:670px !important; height:auto; }
img[class="um-logo"] { width:365px !important; height:auto !important; }
a { color:#333333; }
.icon { margin-right:.5em; margin-bottom:.25em; vertical-align:middle; }
@media screen and (max-width:800px) { /* 480px */
	body { margin:0; }
	table[class="message_body"] { width:100% !important; }
	td[class="message_content"] { padding:15px !important; }
	h1 { font-size:20pt !important; }
	h2 { font-size:18pt !important; }
	h3 { font-size:16pt !important; }
	h4 { font-size:14pt !important; }
	p, li { font-size:14pt !important; line-height:normal !important; }
	img[class="header_image"] { width:100% !important; max-width:670px !important; height:auto !important; }
	img[class="infographic"] { width:100% !important; max-width:525px !important; height:auto !important; }
	img[class="good-for-u"] { width:100% !important; max-width:764px !important; height:auto !important; }
	p[class="footer-iia"] { float:none !important; }
	p[class="footer-um"] { float:none !important; }
	img[class="um-logo"] { width:100% !important; max-width:365px !important; height:auto !important; }
}
</style>
</head>
<body style="background:#f0f0f0; color:#000000;">

<center>

<table class="message_body" width="670" border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="message_header" align="left" valign="top" bgcolor="#00274c"><img class="header_image" style="display:block; width:670px; height:auto;" src="https://safecomputing.umich.edu/sites/default/files/iia-wordmark-72-white.png" alt="Information &amp; Infrastructure Assurance"/></td>
</tr>
<tr>
<td style="padding:10px 30px 10px 30px; font-size:10pt; font-family:Arial,Helvetica,Geneva,sans-serif; color:#ffffff;" align="center" bgcolor="#40658f"><h1 style="margin:0; font-size:14pt; color:#ffffff; line-height:normal;text-transform:uppercase;">LEADERSHIP BULLETIN - <?php echo $issuename; ?></h1></td>
</tr>
<tr>
<td align="left" valign="top" bgcolor="#ffffff">

<table border="0" cellpadding="0" cellspacing="15">


<?php echo $body; ?>

</table>
</td>
</tr>

<tr>
<td>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="message_content" style="padding:15px; font-size:10pt; font-family:Arial,Helvetica,Geneva,sans-serif; color:#000000; line-height:135%;" align="left" valign="top" bgcolor="#ffffff">

<p><em><a href="https://safecomputing.umich.edu/about/" target="_blank">ITS Information and Infrastructure Assurance</a> sends this bi-monthly bulletin to deans, directors, department heads, and other leaders across all U-M campuses. It provides updates and information on the threats facing the University of Michigan, significant incidents that have affected us, and major initiatives that are underway to safeguard the university and enable it to excel in its research, teaching, and patient care mission. <a href="https://safecomputing.umich.edu/iia-newsletter/" target="_blank">See back issues on Safe Computing</a>.</em></p>

</td>
</tr>
</table>

</td>
</tr>
<tr>
<td style="padding:15px; font-size:10pt; font-family:Arial,Helvetica,Geneva,sans-serif; color:#ffffff;" align="center" bgcolor="00274c">
<p class="footer-iia" style="float:left; margin-top:10px;"><a style="color:#ffffff; text-decoration:none;" href="mailto:iia.inform@umich.edu">iia.inform@umich.edu</a></p>
<p class="footer-um" style="float:right; margin:0;"><img class="um-logo" src="https://safecomputing.umich.edu/sites/default/files/um-logo-m36.png" alt="U-M"/></p>
</td>
</tr>
</table>

</center>

</body>
</html>