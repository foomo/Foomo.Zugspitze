<?php

\Foomo\Services\RPC::create(new \Foomo\Zugspitze\Services\Scaffold())
	->serializeWith(new Foomo\Services\RPC\Serializer\JSON())
	->clientNamespace('Foomo.Zugspitze.Services.Scaffold')
	->requestAuth()
	->requestAuthForDev()
	->run()
;
