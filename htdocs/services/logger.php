<?php

\Foomo\Services\RPC::create(new Foomo\Zugspitze\Services\Logger())
	->serializeWith(new \Foomo\Services\RPC\Serializer\AMF())
	->clientNamespace('org.foomo.zugspitze.services.logger')
	->run()
;
