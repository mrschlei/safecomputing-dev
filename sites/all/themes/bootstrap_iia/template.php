<?php

/**
 * @file
 * template.php
 */

function bootstrap_iia_bootstrap_search_form_wrapper($variables) {
  $output = '<div class="input-group">';
  $output .= '<div class="hidden"><a name="search"></a><label for="edit-search-block-form--2">Search</label></div>';
  $output .= $variables['element']['#children'];
  $output .= '<span class="input-group-btn">';
  $output .= '<button type="submit" class="btn btn-default">';
  // We can be sure that the font icons exist in CDN.
  //if (theme_get_setting('bootstrap_cdn')) {
    $output .= "<span class='icon glyphicon glyphicon-search' aria-hidden='true'></span>";
 // }
  //else {
    //$output .= t('Search');
  //}
  $output .= '</button>';
  $output .= '</span>';
  $output .= '</div>';
  return $output;
}

//Trying to kill new user registrations
function bootstrap_iia_theme($existing, $type, $theme, $path){
  $hooks['user_register_form']=array(
    'render element'=>'form',
    'template' =>'templates/user-register',
  );
return $hooks;
}

function bootstrap_iia_preprocess_user_register(&$variables) {
  $variables['form'] = drupal_build_form('user_register_form', user_register_form(array()));
}

//fix that weird form where entities don't work because you're coming from outside of ~iiadrupl and possibly bouncing through Shibb first:
function bootstrap_iia_form_alter(&$form, &$form_state, $form_id) {
	error_reporting(E_ALL);
ini_set("display_errors", -1);
  if ($form_id == 'webform_client_form_197') {
	//if we're @197, redirect to it's alias
	if (strpos($_SERVER['REQUEST_URI'], 'node/197') !== false) {
		
		$url = str_replace("/node/197/?url=","/malicious-website-false-positive?url=",$_SERVER['REQUEST_URI']);
		$loc = "https://".$_SERVER['HTTP_HOST'].$url;
		//echo 'Location: '.$loc;
		header("Status: 200");
		header('Location: '.$loc);
		exit;
		
	}
	//var_dump($form["submitted"]["url"]["#default_value"]);
      $form["submitted"]["url"]["#default_value"] = str_replace("/malicious-website-false-positive?url=","",$_SERVER['REQUEST_URI']);
  }
}