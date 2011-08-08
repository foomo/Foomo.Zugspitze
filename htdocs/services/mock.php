<?php


use Foomo\Services\RPC;
use Foomo\Services\RPC\Serializer\AMF;

RPC::create(
		new \Foomo\Zugspitze\Services\Scaffold()
	)
	->serializeWith(new AMF())
	->requestAuthForDev()
	->clientNamespace('com.test.services.mock')
	->run()
;
