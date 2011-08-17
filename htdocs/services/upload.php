<?php

\Foomo\Services\RPC::create(new \Foomo\Zugspitze\Services\Upload())
	->serializeWith(new \Foomo\Services\RPC\Serializer\AMF())
	->clientNamespace('org.foomo.zugspitze.services.upload')
	#->requestAuthForDev()
	->run()
;