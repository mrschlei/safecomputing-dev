<?php
error_reporting(-1);
ini_set('display_errors', 'On');
if (!extension_loaded('json')) {
	dl('json.so');
}

$nid = intval($_GET['nid']);

//echo "http://safecomputing-dev.dsc.umich.edu/newsletter-json/$nid";
$raw = file_get_contents('https://safecomputing.umich.edu/newsletter-json/'.$nid);
//var_dump($raw);
//here's something strange and interesting that happened to this data feed:
//http://stackoverflow.com/questions/689185/json-decode-returns-null-after-webservice-call
if (json_decode($raw, true) == NULL) {
	$raw = substr($raw, 3);
}
$issuename = "";
$i = 0;
$sectionname = "";
$lastsectionname = "";
$toc = "";
$body = "";
$data = json_decode($raw, true);

foreach ($data['nodes'] as $node) {
	$sectionname = $node['node']['Section'];
	if ($i == 0) {
		$issuename = $node['node']['title'];
		$ul = "";
	}
	else {$ul = "</ul>";}
	
	//check if it's a new thing or the first thing and tc of b
	if ($sectionname !== $lastsectionname) {
		$toc .= $ul."<strong>".$sectionname."</strong><ul style='margin:0 0 0 10px; padding:0 0 0 10px;'>";
		if ($i == 0) {
			$table = "";
		}
		//it's a new thing, but not the first thing, so end the previous table
		else {$table = "</td></tr></table><br/>";}

		if ($sectionname == "Leadership Update") {$color = "186e87";}
		else if ($sectionname == "Project & Service Updates") {$color = "317058";}
		else if ($sectionname == "Project &amp; Service Updates") {$color = "317058";}
		else if ($sectionname == "Reminders & Events") {$color = "18405a";}
		else if ($sectionname == "Reminders &amp; Events") {$color = "18405a";}
		else if ($sectionname == "In the News") {$color = "3a4f60";}
		else if ($sectionname == "Tips to Share") {$color = "7da36e";}
		else {$color = "18405a";}
		
		$body .= $table."<table class='section_header' border='0' cellpadding='0' cellspacing='0' bgcolor='#".$color."'><tr><td><h2 style='margin:0; padding:10px 20px 10px 20px; background:#".$color."; font-size:14pt;font-family:Arial,Helvetica,Geneva,sans-serif; color:#ffffff; text-transform:uppercase; line-height:normal;'>".$sectionname."</h2></td></tr></table><table class='section_content' border='0' cellpadding='0' cellspacing='0'><tr><td style='padding:0 20px 0 20px; font-size:10pt; font-family:Arial,Helvetica,Geneva,sans-serif; color:#333333; line-height:135%;'>";
	}
	
	
	$toc .= "<li><a href='#".$node['node']['title_1']."'>".$node['node']['title_1']."</a></li>";
	$body .= "<a name='".$node['node']['title_1']."'></a><h3 style='margin-top:2em; color:#40658f; line-height:135%;'>".$node['node']['title_1']."</h3>";
	if ($node['node']['field_story_image']!==NULL) {
		$body .= "<img style='display:block;' src='".$node['node']['field_story_image']['src']."' align='right' hspace='10' alt='Don Welch'/>";
	}
	
	$body .= $node['node']['body'];
	
	//var_dump($node);
	//echo "<hr />";
	
	$lastsectionname = $node['node']['Section'];
	$i++;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>Safe Computing Newsletter - <?php echo $issuename; ?></title>
<style type="text/css">
body { background:#f0f0f0; color:#333333; }
@media screen and (max-width:680px) {
	body { margin:0 !important; padding:0 !important; }
	table[class="message_body"] { display:block !important; width:100% !important; }
	td[class="message_banner"] img { width:100% !important; max-width:640px !important; height:auto !important; }
	td[class="message_content"] { padding-top:20px !important; padding-right:0 !important; padding-bottom:20px !important; padding-left:0 !important; }
	td[class="message_footer"] img { width:100% !important; max-width:640px !important; height:auto !important; }
	h2, h3 { font-size:16pt !important; line-height:normal !important; }
	td, p, ul, li { font-size:14pt !important; line-height:135% !important; }
	img[class="banner_image"] { width:100% !important; max-width:640px !important; height:auto !important; }
}
</style>
</head>
<body bgcolor="#f0f0f0" style="background:#f0f0f0; color:#333333;">

<center>

<div style="font-size:8pt; font-family:Arial,Helvetica,Geneva,sans-serif; color:#333333; line-height:135%;">


<table class="message_body" width="640" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
<tr>
<td bgcolor="#f0f0f0"><p><a href="http://safecomputing.umich.edu/newsletter">&laquo; U-M Safe Computing Newsletter</a></p></td>
</tr>

<tr>
<td class="message_banner" align="center" valign="top"><h1 style="margin:0;"><a href="https://www.safecomputing.umich.edu/newsletter/" target="_blank"><img style="display:block;" src="https://safecomputing.umich.edu/sites/default/files/newsletter/safe-computing-newsletter-banner.png" alt="Safe Computing Newsletter"/></a></h1></td>
</tr>
<tr>
<td class="message_content" align="left" valign="top" style="padding:0;">

<div style="font-size:10pt; font-family:Arial,Helvetica,Geneva,sans-serif; color:#333333; line-height:135%;">

<table class="newsletter_header" border="0" cellpadding="0" cellspacing="0">
<tr>
<td style="padding:20px; font-size:10pt; font-family:Arial,Helvetica,Geneva,sans-serif; color:#333333; line-height:135%;">

<h2 style="padding:0; font-size:14pt; color:#00274c; text-transform:uppercase; line-height:normal;"><?php echo $issuename; ?> &bull; In This Issue:</h2>
<?php echo $toc; ?>
</td>
</tr>
</table>

<br/>
<?php echo $body; ?>



<table class="section_content" border="0" cellpadding="0" cellspacing="0">
<tr>
<td style="border-top:1px solid #999999; padding:0 20px 0 20px; font-size:10pt; font-family:Arial,Helvetica,Geneva,sans-serif; color:#333333; line-height:135%;">

<p><em>Please feel free to share this information with others at <nobr>U-M</nobr> who might find it interesting or helpful. This newsletter is sent to the <nobr>U-M</nobr> IT Security Community and interested others at <nobr>U-M.</nobr> To subscribe, join the <a href="https://mcommunity.umich.edu/#group:Safe%20Computing%20Newsletter" target="_blank">Safe Computing Newsletter</a> group in MCommunity. Back issues are available online at <a href="http://safecomputing.umich.edu/content/newsletter/" target="_blank"><nobr>U-M</nobr> Safe Computing Newsletter</a>.</em></p>

</td>
</tr>
</table>

</div>

</td>
</tr>
<tr>
<td class="message_footer" align="center" valign="middle" style="padding:10px; background:#00274c; font-size:12pt; font-family:Arial,Helvetica,sans-serif; font-weight:bold; color:#ffffff; text-transform:uppercase; line-height:normal;">ITS Information Assurance and Identity Management</td>
</tr>
</table>

</div>

</center>

</body>
</html>