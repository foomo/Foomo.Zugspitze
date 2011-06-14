<?php

\Foomo\Services\RPC::serveClass(new Zugspitze\Services\Logger(), new Foomo\Services\RPC\Serializer\AMF, 'org.foomo.zugspitze.services.logger');