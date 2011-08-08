<?php


use Foomo\Services\RPC;
use Foomo\Services\RPC\Serializer\JSON;

RPC::create(
		new \Foomo\Zugspitze\Services\Scaffold()
	)
	->serializeWith(new JSON())
	->clientNamespace('Foomo.Zugspitze.Services.Scaffold')
	->requestAuth()
	->requestAuthForDev()
	->run()
;
