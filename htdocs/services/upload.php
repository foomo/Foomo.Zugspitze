<?php

\Foomo\Services\RPC::serveClass(
	new \Foomo\Zugspitze\Services\Upload(),
	new \Foomo\Services\RPC\Serializer\AMF(),
	'org.foomo.zugspitze.services.upload'
);