<?php

use Foomo\Services\RPC;
use Foomo\Services\RPC\Serializer\AMF;

RPC::create(
		new Foomo\Zugspitze\Services\Logger()
	)
	->serializeWith(new AMF())
	->clientNamespace('org.foomo.zugspitze.services.logger')
	->requestAuthForDev()
	->run()
;
