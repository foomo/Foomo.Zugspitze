<?php

include(\Foomo\ROOT . DIRECTORY_SEPARATOR . 'htdocs' . DIRECTORY_SEPARATOR . 'tools.inc.php');

Foomo\Services\RPC::serveClass(
	new ZSCompilerService(),
	new Foomo\Services\RPC\Serializer\AMF(),
	'com.bestbytes.services'
);