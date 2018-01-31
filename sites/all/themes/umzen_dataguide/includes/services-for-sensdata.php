<?php

if ($node = node_load(arg(1))) {
//var dirtyarg = arg(1);

$title = $node->title;

 echo "<p>This list shows which services can and cannot be used to store and share ".$title.". Click any service for more details.</p>";
 // echo "<p>".$title." data can be stored in these resources as follows.  Click any service for more information about using ".$title." data in that resource.</p>";
  //echo $node->type; //returns sensitive_data
  //var_dump($node);

   $result = db_query( "SELECT * FROM {service_info}" );
   $my_array_permitted = array();
   $my_array_not_permitted = array();
   $my_array_iia_approval = array();
   $my_array_no_status = array();
		foreach ($result as $record) {
			$fieldname = $record->fieldname;
			//echo $record->title.": ".$record->fieldname.": ".$record->nid;
			if (isset($node->$fieldname) ) {
                               if ($statuscheck = node_load($record->nid)) {
                                    if ($statuscheck->status) {
                                            $deeper = $node->$fieldname;
                                            if (isset($deeper["und"])) {
                                                 $status = $deeper["und"][0]["value"];
                                                 if ($status == "Permitted"){
                                                    $my_array_permitted[] = array(
			                    		"title" => $record->title,
                                                        "ID" => $record->nid
			                    	     );
                                                 }//end if permitted
                                                 else if ($status == "Not Permitted"){
                                                    $my_array_not_permitted[] = array(
			                    		"title" => $record->title,
			                    		"ID" => $record->nid
			                    	    );
                                                 }//end else if not permitted
                                                 else if ($status == "With Approval"){
                                                 $my_array_iia_approval[] = array(
			                    		"title" => $record->title,
			                    		"ID" => $record->nid
			                    	 );
                                                 }//end else if IIA Approval
   			                   }// end if (isset($deeper["und"]
                                           else{
                                               $my_array_no_status[] = array(
			                    		"title" => $record->title,
			                    		"ID" => $record->nid
			                    	);
                                           }//end else - (isset($deeper["und"]

                                    }// end if ($statuscheck->status)
		               }//end   if ($statuscheck = node_load($record->nid))
                        } //end if (isset($node->$fieldname) )
                } //end foreach ($result as $record) - remove as needed

function compare($x, $y){
   //echo "inside compare";
   if($x['title'] == $y['title']){
         return 0;
    }
    else if($x['title'] < $y['title']){
          return -1;
    }
    else {
        return 1;
    }
}//end function
   echo "<div style='border:1px solid #ccc;padding:8px;'>";
echo "<p style='font-size:11px;float:right;background-color:#dbdbdb;'><strong>Key: Storage Permission Levels</strong><br /> <img src='/dataguide/sites/all/themes/umzen_dataguide/images/permitted.png' /> Permitted<br /><img src='/dataguide/sites/all/themes/umzen_dataguide/images/iia-approval.png' /> Not Permitted without IIA Approval<br /><img src='/dataguide/sites/all/themes/umzen_dataguide/images/not-permitted.png' /> Not Permitted<br />";
echo "If IIA approval is needed, please contact the <a href='http://its.umich.edu/help'>ITS Service Center</a></p>";
 // echo "<h2>Permitted array:</h2>"; 
//  echo  var_dump($my_array_permitted);
   if(count($my_array_permitted) >= 1){
      //echo "Permitted before sort ".count($my_array_permitted)."<br>";
      usort($my_array_permitted, 'compare');
      //echo "Permitted after sort ".count($my_array_permitted)."<br>";
      $imgPermitted = "permitted.png";
      echo "<ul style='margin-left: 0;padding-left: 0;list-style: none;'>";
      foreach ($my_array_permitted as $id2 => $assoc2){
         echo "<li style=\"background-image:url('/dataguide/sites/all/themes/umzen_dataguide/images/".$imgPermitted."');padding-left: 20px;background-repeat: no-repeat;background-position: 0 .3em;\"><a href='/dataguide/?q=node/".$assoc2["ID"]."'>".$assoc2["title"]."</a></li>";
     }//end external foreach
      echo "</ul>";
}
else{ 
    // echo "no permitted services<br>";
}
 // echo "<h2>IIA Approval array:</h2>";  
  $IIAApproval = "iia-approval.png";

//  echo var_dump($my_array_iia_approval);
   if(count($my_array_iia_approval) >= 1){
      //echo "IIA Approval before sort ".count($my_array_iia_approval)."<br>";
      usort($my_array_iia_approval, 'compare');
      //echo "IIA Approval after sort ".count($my_array_iia_approval)."<br>";
      echo "<ul style='margin-left: 0;padding-left: 0;list-style: none;'>";
      foreach ($my_array_iia_approval as $id6 => $assoc6){
         echo "<li style=\"background-image:url('/dataguide/sites/all/themes/umzen_dataguide/images/".$IIAApproval."');padding-left: 20px;background-repeat: no-repeat;background-position: 0 .3em;\"><a href='/dataguide/?q=node/".$assoc6["ID"]."'>".$assoc6["title"]."</a></li>";
      }//end external foreach
      echo "</ul>";
}
else{
  // echo "no IIA approval services<br>";
}
 // echo "<h2>Not Permitted array:</h2>"; 
   $imgNotPermitted = "not-permitted.png";

  //echo var_dump($my_array_not_permitted);
 //make sure this array is not empty before doing this
  if(count($my_array_not_permitted) >= 1){
     //echo "not permitted before sort ".count($my_array_not_permitted)."<br>";
     usort($my_array_not_permitted, 'compare');
     //echo "not permitted after sort ".count($my_array_not_permitted)."<br>";

     echo "<ul style='margin-left: 0;padding-left: 0;list-style: none;'>";
     foreach ($my_array_not_permitted as $id3 => $assoc3){
       echo "<li style=\"background-image:url('/dataguide/sites/all/themes/umzen_dataguide/images/".$imgNotPermitted."');padding-left: 20px;background-repeat: no-repeat;background-position: 0 .3em;\"><a href='/dataguide/?q=node/".$assoc3["ID"]."'>".$assoc3["title"]."</a></li>";
     }//end external foreach
 echo "</ul>";
}
else{
 //  echo "no not permitted services<br>";
}


 if(count($my_array_no_status) >= 1){
   echo "<ul style='margin-left: 0;padding-left: 0;list-style: none;'>";
   // echo  var_dump($my_array_no_status);
    usort($my_array_no_status, 'compare');
   foreach ($my_array_no_status as $id8 => $assoc8){
       echo "<li><a href='/dataguide/?q=node/".$assoc8["ID"]."'>".$assoc8["title"]."</a></li>";
   }//end external foreach
  echo "</ul>";
}
else{
  //  echo "no no status array <br>";
}

 //  echo "<p style='font-size:11px;'><strong>Key:</strong> <img src='/dataguide/sites/all/themes/umzen_dataguide/images/permitted.png' /> Permitted <img src='/dataguide/sites/all/themes/umzen_dataguide/images/iia-approval.png' /> Not Permitted without IIA Approval <img src='/dataguide/sites/all/themes/umzen_dataguide/images/not-permitted.png' /> Not Permitted <br>";
//echo "If IIA approval is needed, please contact the <a href='http://its.umich.edu/help'>ITS Service Center</a></p>";
   echo "</div>";
   echo "<p><a href='/dataguide/?q=node/".$node->nid."''>More about ".$node->title." data</a></p>";
   echo "<p><a href='/dataguide/?q=ask'>Don't see the service you need? Ask the experts</a>.</p>";
}//end  if ($node = node_load(arg(1)))

?>