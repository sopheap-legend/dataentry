<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
            'application.models.*',
            'application.components.*',
            'bootstrap.helpers.TbHtml',
            'bootstrap.helpers.TbArray',
            'bootstrap.behaviors.TbWidget',
            'bootstrap.components.TbApi',
            'application.extensions.PasswordHash', // PHPass
	),
        'theme'=>'abound', 
        'aliases' => array(
            // yiistrap configuration
            'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change if necessary
            // yiiwheels configuration
            'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'), // change if necessary
        ),
	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','192.168.56.*','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
                'bootstrap' => array(
                    'class' => 'bootstrap.components.TbApi',
                ),
                // yiiwheels configuration
                'yiiwheels' => array(
                    'class' => 'yiiwheels.YiiWheels',   
                ),
                /*'typeahead' => array(
                    'class' => 'ext.typeahead.TbTypeAhead',   
                ),*/
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=192.168.56.101;dbname=dataentry',
			'emulatePrepare' => true,
			'username' => 'sys',
			'password' => 'sys123',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),            
                'session' => array (
                    'class' => 'system.web.CDbHttpSession',
                    'connectionID' => 'db',
                    'sessionTableName' => 'session',
                ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);