<?php
/* @var $serviceDescription ServiceDescription */
?>			<exec executable="/usr/bin/curl">
				<arg value="-k"/>
				<arg value="<?php echo \Foomo\Services\Utils::getRemoteServiceUrlWithCredentials($host) . htmlspecialchars($serviceDescription->downloadUrl); ?>"/>
				<arg value="-o"/>
				<arg value="../libs/<?php echo $serviceDescription->name ?>.swc"/>
			</exec>
