<?php

// @todo: basic auth should come with the serve class
// @see: https://github.com/foomo/Foomo.Services/issues/1
#Foomo\Frontend::setUpToolbox();

Foomo\Services\RPC::serveClass(new Foomo\Zugspitze\Services\Compiler, new Foomo\Services\RPC\Serializer\AMF(), 'org.foomo.services');