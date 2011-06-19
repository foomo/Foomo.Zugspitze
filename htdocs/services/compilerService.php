<?php

namespace Foomo;

Frontend::setUpToolbox();

Services\RPC::serveClass(
	new Zugspitze\Services\Compiler,
	new Services\RPC\Serializer\AMF(),
	'com.bestbytes.services'
);