<?php

/**
 * Конфиг консольного приложения.
 */

return CMap::mergeArray(
	(require_once __DIR__.'/common.php'),
	array(
		'components'=>array(
		),

		'commandMap' => array(
	        'migrate' => array(
	            'class' => 'system.cli.commands.MigrateCommand',
	        ),
	    ),
	)
);