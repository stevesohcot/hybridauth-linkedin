<?php
$hybridauthConfig = [
	'callback' => 'http://localhost/login/callback.php',
	'providers' => [
		'LinkedIn' => [
			'enabled' => true,
			'keys' => [
				'id' => '--client-id-here--',
				'secret' => '--secret-id-here--',
			],
		]
	],
];
?>