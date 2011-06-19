<?php

\Foomo\Services\RPC::serveClass(new \Foomo\Zugspitze\Services\Mock(), new \Foomo\Services\RPC\Serializer\AMF(), 'com.test.services.mock');