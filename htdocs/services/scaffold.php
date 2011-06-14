<?php

\Foomo\Services\RPC::serveClass(new \Foomo\Zugspitze\Services\Scaffold(), new \Foomo\Services\RPC\Serializer\JSON(), 'zugspitze.services.vendor');