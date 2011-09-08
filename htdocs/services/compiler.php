<?php

\Foomo\Services\RPC::create(new Foomo\Zugspitze\Services\Compiler)
	->serializeWith(new \Foomo\Services\RPC\Serializer\AMF())
	->clientNamespace('org.foomo.services')
	->run()
;