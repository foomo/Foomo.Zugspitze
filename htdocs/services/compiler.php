<?php

use Foomo\Services\RPC;
use Foomo\Services\RPC\Serializer\AMF;

RPC::create(
		new Foomo\Zugspitze\Services\Compiler
	)
	->clientNamespace('org.foomo.services')
	->serializeWith(new AMF())
	->requestAuthForDev()
	->requestAuth()
	->run()
;