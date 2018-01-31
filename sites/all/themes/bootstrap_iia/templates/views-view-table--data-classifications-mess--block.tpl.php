<?php

/**
 * @file
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $caption: The caption for this table. May be empty.
 * - $header_classes: An array of header classes keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $classes: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * - $field_classes: An array of classes to apply to each field, indexed by
 *   field id, then row number. This matches the index in $rows.
 * @ingroup views_templates
 */
 
$fullontablerow = array(); 

?>

<table style='clear:both;' <?php if ($classes) { print 'class="'. $classes . '" '; } ?><?php print $attributes; ?>>
   <?php if (!empty($title) || !empty($caption)) : ?>
     <caption><?php print $caption . $title; ?></caption>
  <?php endif; ?>
  <?php if (!empty($header)) : ?>
    <thead>
      <tr>
      	<th scope="col">What to do</th>
<th scope="col"><a href="/protect-the-u/safely-use-sensitive-data/sensitive-data-classification#data-classifications" title="<p>The restricted level encompasses information and data that are covered by specific prescriptive information security controls and the most stringent legal or regulatory requirements.</p><p><strong>Risk Level of Disclosure or Unauthorized Access:</strong> Severe harm to individuals and the university; could expose the university and individual staff to criminal and civil liability.</p>" data-toggle="tooltip" data-html="true" >Restricted</a></th>
        <th scope="col"><a href="/protect-the-u/safely-use-sensitive-data/sensitive-data-classification#data-classifications" title="<p>The high level encompasses information and data that are both individually identifiable and highly sensitive or confidential, and usually subject to legal or regulatory compliance.</p><p><strong>Risk Level of Disclosure or Unauthorized Access:</strong> Significant harm to individuals or the university; could expose the university and individual staff to criminal and civil liability.</p>" data-toggle="tooltip" data-html="true" >High</a></th>
        <th scope="col"><a href="/protect-the-u/safely-use-sensitive-data/sensitive-data-classification#data-classifications" title="<p>The moderate level encompasses information and data that are individually identifiable, include confidential or proprietary institutional records, or are subject to contractual agreements or legal or regulatory compliance.</p><p><strong>Risk Level of Disclosure or Unauthorized Access:</strong> Moderate harm to individuals or the university; some risk that the university could be exposed to civil liability.</p>" data-toggle="tooltip" data-html="true" >Moderate</a></th>
        <th scope="col"><a href="/protect-the-u/safely-use-sensitive-data/sensitive-data-classification#data-classifications" title="<p>The low level encompasses public information and university business data that generally anyone, regardless of institutional affiliation, can access without limitation.</p><p><strong>Risk Level of Disclosure or Unauthorized Access:</strong> Disclosure to the general public poses little to no risk to the university's reputation, resources, services or individuals.</p>" data-toggle="tooltip" data-html="true" >Low</a></th>
      </tr>
    </thead>
  <?php endif; ?>
  <tbody>
    <?php foreach ($rows as $row_count => $row): 

          $thisrow = "";
          $counter = "";
		//array(2) { ["field_what_to_do"]=> string(111) "Limit access to the database listener port(s) to those campus subnets that require access using firewall rules." ["field_classification"]=> string(28) "Moderate;-;High;-;Restricted" }
		//var_dump($row);echo "<hr />"; 
		$content = $row["field_classification"];
			if (substr_count($content, ';-;') == 0) {
				$counter = "<td style='background:#f44336;color:#333;font-weight:bold;''>&#10003;</td>
				<td></td>
				<td></td>
				<td></td>";
			}
			elseif (substr_count($content, ';-;') == 1) {
				$counter = "<td style='background:#f44336;color:#333;font-weight:bold;''>&#10003;</td>
				<td style='background:#f57c00;color:#333;font-weight:bold;'>&#10003;</td>
				<td></td>
				<td></td>";
			}			
			elseif (substr_count($content, ';-;') == 2) {
				$counter = "<td style='background:#f44336;color:#333;font-weight:bold;''>&#10003;</td>
				<td style='background:#f57c00;color:#333;font-weight:bold;'>&#10003;</td>
				<td style='background:#ffc107;color:#333;font-weight:bold;'>&#10003;</td>
				<td></td>";
			}
			else {
				$counter = "<td style='background:#f44336;color:#333;font-weight:bold;''>&#10003;</td>
				<td style='background:#f57c00;color:#333;font-weight:bold;'>&#10003;</td>
				<td style='background:#ffc107;color:#333;font-weight:bold;'>&#10003;</td>
				<td style='background:#4caf50;color:#333;font-weight:bold;'>&#10003;</td>";
			}		
		
		
		
		//dump an array of classification count (for sorting) and then the full-on <tr> (because fuck it)
		$fullontablerow[$row_count] = array(substr_count($row["field_classification"], ';-;'),"<tr><td>".$row["field_what_to_do"]."</td>".$counter."</tr>");
		
	?>
    
    
    <?php endforeach; ?>
    
    <?php 
	
usort($fullontablerow, function($a, $b) {
    if ($a[0] == $b[0]) return 0;
    return ($a > $b) ? -1 : 1;
});
	
	for ($j = 0;$j <= count($fullontablerow) ;$j++) {
		if (isset($fullontablerow[$j])) {
		echo $fullontablerow[$j][1];
	}}
	 ?>
    
  </tbody>
</table>
