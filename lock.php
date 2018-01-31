<?php
global $user;

//if ($user->uid != 0) {
//$uid = $user->uid;

//check for copyright compliance
//check for CS101
//check for phishing training

//tally how many things they've done

//make the crazy image
echo "<div id='datlock' class='boxer'><div id='slidermaybe' class='boxer'></div><div id='yellowlock' class='boxer'></div></div>";
//}

//else {echo "<p>not logged in!</p>";}
?>
<style>
.boxer {width:200px;
	height:204px;}
#datlock {
	background:url("/sites/default/files/lock-bg.png");
	background-repeat:no-repeat;
	}
#slidermaybe {
	position:absolute;
	background:url("/sites/default/files/lock-fg.png");
	background-repeat:no-repeat;clip: rect(0px,120px,204px,0px);
	}
#yellowlock {
	background:url("/sites/default/files/lock-slide.png");
	background-repeat:no-repeat;}

@keyframes example {
    from {
		clip: rect(0px,60px,204px,0px);
		}
    to {
		clip: rect(0px,120px,204px,0px); }
}
@keyframes example2 {
    from {
		clip: rect(0px,120px,204px,0px);
		}
    to {
		clip: rect(0px,180px,204px,0px); }
}

/* The element to apply the animation to */
#slidermaybe {
    animation-name: example;
    animation-duration: 3s;
}

#slidermaybe:hover {
    animation-name: example2;
    animation-duration: 3s;
}

</style>
<script src="https://safecomputing-dev.dsc.umich.edu/sites/all/modules/jquery_update/replace/jquery/1.10/jquery.min.js?v=1.10.2"></script>
<script>
$(document).ready(function() {
	  
	$("#datlock").click(function(){
		console.log($(this).children().css("clip"));
		$("#slidermaybe").css({
   'animation-name' : 'example2',
   'animation-duration' : '3s'});
	});

})
</script>
