<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
		'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
		'name' => 'Questionaire',
		'defaultController' => 'user/login',
		// preloading 'log' component
		'preload' => array('log'),
		// autoloading model and component classes
		'import' => array(
				'application.models.*',
				'application.components.*',
				'application.modules.user.models.*',
				'application.modules.user.components.*',
				'application.modules.project.models.*',
				'application.modules.project.components.*',
		),
		'modules' => array(
        'project',
				'user' => array(
						'tableUsers' => 'que_user',
						# encrypting method (php hash function)
						'hash' => 'md5',
						# send activation email
						'sendActivationMail' => false,
						# allow access for non-activated users
						'loginNotActiv' => false,
						# activate user on registration (only sendActivationMail = false)
						'activeAfterRegister' => true,
						# automatically login from registration
						'autoLogin' => true,
						# registration path
						'registrationUrl' => array('/user/registration'),
						# recovery password path
						'recoveryUrl' => array('/user/recovery'),
						# login form path
						'loginUrl' => array('/user/login'),
						# page after login
						'returnUrl' => array('/site/'),
						# page after logout
						'returnLogoutUrl' => array('/user/login'),
						# profile
						'profileUrl' => array('/user/profile'),
				),
				
				'gii' => array(
						'class' => 'system.gii.GiiModule',
						'password' => 'awesome++',
						// If removed, Gii defaults to localhost only. Edit carefully to taste.
						'ipFilters' => array('127.0.0.1', '::1'),
				),
		),
		// application components
		'components' => array(
				'user' => array(
						// enable cookie-based authentication
						'class' => 'RWebUser',
						'allowAutoLogin' => true,
						'loginUrl' => array('/user/login'),
				),
				// uncomment the following to enable URLs in path-format
				'authManager' => array(
						'class' => 'RDbAuthManager',
						'connectionID' => 'db',
				),
				'urlManager' => array(
						'urlFormat' => 'path',
						'showScriptName' => false,
						'rules' => array(
								'<controller:\w+>/<id:\d+>' => '<controller>/view',
								'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
								'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
						),
				),
				// uncomment the following to use a MySQL database
				'db' => array(
						'connectionString' => 'mysql:host=localhost;dbname=questionnaire',
						'emulatePrepare' => true,
						'username' => 'questionnaire',
						'password' => 'fun++',
						'charset' => 'utf8',
						'tablePrefix' => 'que_',
				),
				'errorHandler' => array(
						// use 'site/error' action to display errors
						'errorAction' => 'site/error',
				),
				'log' => array(
						'class' => 'CLogRouter',
						'routes' => array(
								array(
										'class' => 'CFileLogRoute',
										'levels' => 'error, warning',
								),
						// uncomment the following to show log messages on web pages
						/*
						  array(
						  'class'=>'CWebLogRoute',
						  ),
						 */
						),
				),
		),
		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params' => array(
				// this is used in contact page
				'adminEmail' => 'tmtrigga@gmail.com',
		),
);