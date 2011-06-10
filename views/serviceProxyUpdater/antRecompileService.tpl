<?php
/* @var $serviceDescription ServiceDescription */
?><?php if($serviceDescription->usesRemoteClasses): ?>
<?php if(is_dir(Foomo\Flex\Settings::$PROJECT_DIR) && is_writable(Foomo\Flex\Settings::$PROJECT_DIR)): ?>
		<exec executable="/usr/bin/rsync">
			<arg value="-rv"/>
			<arg value="--delete"/>
			<arg value="--exclude"/>
			<arg value=".svn"/>
			<arg value="../src"/>
			<arg value="<?php echo htmlspecialchars($host .':' . Foomo\Flex\Settings::$PROJECT_DIR); ?>"/>
		</exec>
		<exec executable="/usr/bin/rsync">
			<arg value="-rv"/>
			<arg value="--delete"/>
			<arg value="--exclude"/>
			<arg value=".svn"/>
			<arg value="--exclude"/>
			<arg value="*.swc"/>
			<arg value="../libs"/>
			<arg value="<?php echo htmlspecialchars($host .':' . Foomo\Flex\Settings::$PROJECT_DIR); ?>"/>
		</exec>
		<exec executable="/usr/bin/ssh">
			<arg value="<?php echo $host; ?>"/>
			<arg value="'/bin/chmod -R g+w &quot;<?php echo Foomo\Flex\Settings::$PROJECT_DIR; ?>&quot;'"/>
		</exec>
		
<?php else: ?>
		<echo message="you need to create the folder <?php echo htmlspecialchars(Foomo\Flex\Settings::$PROJECT_DIR) ?> and make it writable - other that that I can not upload the client sources to enable server side compilation"/>
<?php endif; ?>
<?php endif; ?>
		<exec executable="/usr/bin/curl">
			<arg value="-s"/>
			<arg value="-k"/>
			<arg value="<?php echo \Foomo\Services\Utils::getRemoteServiceUrlWithCredentials($host) . htmlspecialchars($serviceDescription->recompileUrl); ?>"/>
		</exec>