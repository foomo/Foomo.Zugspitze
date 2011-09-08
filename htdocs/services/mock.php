<?php


\Foomo\Services\RPC::create(new \Foomo\Zugspitze\Services\Scaffold())
	->serializeWith(new \Foomo\Services\RPC\Serializer\AMF())
	->clientNamespace('com.test.services.mock')
	->run()
;
