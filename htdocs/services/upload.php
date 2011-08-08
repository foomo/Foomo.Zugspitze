<?php

use Foomo\Services\RPC;
use Foomo\Services\RPC\Serializer\AMF;

RPC::create(
		new \Foomo\Zugspitze\Services\Upload()
	)
	->serializeWith(new AMF())
	->clientNamespace('org.foomo.zugspitze.services.upload')
	->requestAuthForDev()
	->run()
;