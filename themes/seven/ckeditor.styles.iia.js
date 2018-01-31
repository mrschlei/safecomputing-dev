/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/*
 * This file is used/requested by the 'Styles' button.
 * The 'Styles' button is not enabled by default in DrupalFull and DrupalFiltered toolbars.
 */

CKEDITOR.dtd.$removeEmpty.span = 0;

CKEDITOR.editorConfig = function(config) {
  // allow span tags to be empty (for font awesome)
CKEDITOR.dtd.$removeEmpty['span'] = false;
CKEDITOR.dtd.$removeEmpty['i'] = false;
}


 if(typeof(CKEDITOR) !== 'undefined') {
	CKEDITOR.stylesSet.add( 'drupal',
	[
		{ name : 'Heading 2', element : 'h2'},
		{ name : 'Heading 3', element : 'h3'},
		{ name : 'Heading 4', element : 'h4'},
		{ name : 'Alert - Info', element : 'div', attributes : {'class' : 'alert alert-info'} },
		{ name : 'Alert - Warning', element : 'div', attributes : {'class' : 'alert alert-warning'} },
		{ name : 'No-wrap Text', element : 'span', attributes : {'class' : 'nobr'} },
		{ name : 'Computer Code', element : 'code', styles : {'font-size' : '90%'} },
		{ name: 'Danger', element: 'div', attributes: {'class': 'alert alert-danger'} },
		{ name: 'Warning', element: 'div', attributes: {'class': 'alert alert-warning'} },
		{ name: 'Note', element: 'div', attributes: {'class': 'alert alert-info'} },
		{ name: 'Keyboard input (kbd)', element: 'kbd', attributes: {'class': ''} },
		
		{ name: 'Button - Default', element: 'button', attributes: {'class': 'btn btn-default'} },
		{ name: 'Button - Primary', element: 'button', attributes: {'class': 'btn btn-primary'} },
		{ name: 'Button - Success', element: 'button', attributes: {'class': 'btn btn-success'} },
		{ name: 'Button - Info', element: 'button', attributes: {'class': 'btn btn-info'} },
		{ name: 'Button - Warning', element: 'button', attributes: {'class': 'btn btn-warning'} },
		{ name: 'Button - Danger', element: 'button', attributes: {'class': 'btn btn-danger'} },
	]);
}