<?php

\Foomo\Services\RPC::serveClass(new Zugspitze\Services\Logger(), new Foomo\Services\RPC\Serializer\AMF, 'com.bestbytes.zugspitze.services.logger');