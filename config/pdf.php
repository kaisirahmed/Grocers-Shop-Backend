<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => "Grocers",
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Grocers Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('resources/fonts/temp/'),
	'font_path' 			=> base_path('resources/fonts/'), 
	'brand_logo'			=> base_path('resource/images/logo.png'),
	'brand_logo_text'		=> base_path('resource/images/logo-text.png'),
	'font_data' 			=> [ 'bangla' => [
    'R'  					=> 'Nikosh.ttf',    // regular font
    'B'  					=> 'Nikosh.ttf',       // optional: bold font
    'I'  					=> 'Nikosh.ttf',     // optional: italic font
    'BI' 					=> 'Nikosh.ttf', // optional: bold-italic font
    'useOTL' 				=> 0xFF,   
    'useKashida' 			=> 75, 
	]]
];
