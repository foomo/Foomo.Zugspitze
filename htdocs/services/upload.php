<?php

\Foomo\Services\RPC::serveClass(new \Zugspitze\Services\Upload(), new \Foomo\Services\RPC\Serializer\AMF(), 'com.bestbytes.zugspitze.services.upload');