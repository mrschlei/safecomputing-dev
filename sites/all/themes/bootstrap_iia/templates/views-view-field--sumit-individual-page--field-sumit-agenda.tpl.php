<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>
<?php

//VIDEO
if (count($row->field_field_sumit_video) > 0) {
echo "<h2>Video and Materials</h2>
<div id='sumit_video'>
<ul>";
foreach ($row->field_field_sumit_video as $itemintheory) {
	
	foreach ($itemintheory["rendered"]["entity"]["field_collection_item"] as $thingy) {
		echo "<li>";
		if (isset($thingy['field_sumit_video_link']["#items"][0]['value'])) {
			echo "<strong><a href='".$thingy['field_sumit_video_link']["#items"][0]['value']."'>".$thingy['field_sumit_video_title']["#items"][0]['value']."</a></strong><br/>";
		}
		echo "".$thingy['field_sumit_video_presenter']["#items"][0]['value']."";	
		if (isset($thingy['field_sumit_video_material_link']["#items"][0]['value'])) {
			echo "<ul class='materialul'>";
			echo "<li><a href='".$thingy['field_sumit_video_material_link']["#items"][0]['value']."' class='matlinkpdf'>Presentation Materials</a></li>";
			echo "</ul>";
		}	
		echo "</li>";
	}

}
echo "</ul></div>";
}
//Reg Link
foreach ($row->field_field_registration_link as $itemintheory) {
	
	echo "<p><a class='red-button' href='".$itemintheory["rendered"]["#element"]['url']."'>Register Now to Attend</a></p>";
	echo "<p>Can't attend in person? <a href='/events/sumit/2016/stream'>Live stream SUMIT_2016</a></p>";
}

//AGENDA
if (count($row->field_field_sumit_agenda) > 0) {
echo "<h2>Agenda</h2>";
echo "<table class='sumitagenda'>";
echo "<thead>";
echo "</thead>";
echo "<tbody>";

foreach ($row->field_field_sumit_agenda as $itemintheory) {
	
	foreach ($itemintheory["rendered"]["entity"]["field_collection_item"] as $thingy) {
		echo "<tr>";
		echo "<td><strong>".$thingy['field_sumit_start_time']["#items"][0]['value']."&ndash;".$thingy['field_sumit_end_time']["#items"][0]['value']."</strong></td>";
		echo "<td>".$thingy['field_sumit_agenda_item']["#items"][0]['value']."</td>";
		echo "</tr>";
	}

}
echo "</tbody>";
echo "</table>";
}





//SPEAKERS
echo "<h2>Speakers</h2>";
foreach ($row->field_field_sumit_speaker as $itemintheory) {

	foreach ($itemintheory["rendered"]["entity"]["field_collection_item"] as $thingy) {
		
		$thisid = str_replace(" ","-",strtolower($thingy['field_sumit_speaker_name']["#items"][0]['value']));
		//$thisid = str_replace(" ","-",$thingy['field_sumit_speaker_name']["#items"][0]['value']);
		echo "<a name='".$thisid."'></a>";
		
		echo "<h3>".$thingy['field_sumit_speaker_name']["#items"][0]['value']."</h3>";		

		if (isset($thingy['field_photo']["#object"]->field_photo["und"][0]["filename"])) {
			echo "<div class='sumitphoto'><img src='/sites/default/files/".$thingy['field_photo']["#object"]->field_photo["und"][0]["filename"]."' alt='".$thingy['field_sumit_speaker_name']["#items"][0]['value']."' width='200' /></div>";	
		}

		if (isset($thingy['field_sumit_speaker_title']["#items"][0]['value'])) {
			echo "<p><em>".$thingy['field_sumit_speaker_title']["#items"][0]['value']."</em></p>";
		}
		
		if (isset($thingy['field_sumit_speaker_pres_title']["#items"][0]['value'])) {
			echo "<h4 class=\"sumitrole\">".$thingy['field_sumit_speaker_pres_title']["#items"][0]['value']."</h4>";
		}
		
		if (isset($thingy['field_sumit_pres_description']["#items"][0]['value'])) {
			echo $thingy['field_sumit_pres_description']["#items"][0]['value'];
		}
		//echo "<h4>Bio</h4>";
		if (isset($thingy['field_sumit_presenter_bio']["#items"][0]['value'])) {
			echo $thingy['field_sumit_presenter_bio']["#items"][0]['value'];
		}
		echo "<hr style='clear:both;'/>";
	}

}


?>
