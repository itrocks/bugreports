<?php
namespace ITRocks\Bugreports;

use ITRocks\Framework;
use ITRocks\Framework\Configuration;
use ITRocks\Framework\Locale;
use ITRocks\Framework\Locale\Number_Format;
use ITRocks\Framework\Plugin\Priority;

global $loc, $pwd;
require __DIR__ . '/../../loc.php';
require __DIR__ . '/../../pwd.php';
require __DIR__ . '/../../itrocks/framework/config.php';

$config['ITRocks/Bugreports'] = [
	Configuration::APP         => Application::class,
	Configuration::ENVIRONMENT => $loc[Configuration::ENVIRONMENT],
	Configuration::EXTENDS_APP => 'ITRocks/Framework',

	//------------------------------------------------------------------------- CORE priority plugins
	Priority::CORE => [
		Framework\Builder::class => include(__DIR__ . '/builder.php')
	],

	//------------------------------------------------------------------------ LOWER priority plugins
	Priority::LOWER => [
		// lower than Maintainer to log all sql errors
		Framework\Dao\Mysql\File_Logger::class => [
			'path' => $loc[Framework\Dao\File\Link::class]['path'] . '/logs',
		]
	],

	//----------------------------------------------------------------------- NORMAL priority plugins
	Priority::NORMAL => [
		Framework\Dao::class => [
			Framework\Dao::LINKS_LIST => [
				'files' => $loc[Framework\Dao\File\Link::class],
			],
		],
		Framework\Dao\Mysql\Maintainer::class,
		Framework\Locale::class => [
			Locale::DATE     => 'm/d/Y',
			Locale::LANGUAGE => 'en',
			Locale::NUMBER   => [
				Number_Format::DECIMAL_MINIMAL_COUNT => 2,
				Number_Format::DECIMAL_MAXIMAL_COUNT => 2,
				Number_Format::DECIMAL_SEPARATOR     => '.',
				Number_Format::THOUSAND_SEPARATOR    => ',',
			]
		],
		Framework\Logger::class,
		Framework\RAD\Feature\Installer::class,
		Framework\RAD\Feature\Maintainer::class,
		Framework\Tools\Editor::class => [
			'name'            => 'ckeditor',
			'default_version' => 'full',
		],
		Framework\Tools\Wiki::class,
		Framework\Widget\Menu::class => include(__DIR__ . '/menu.php'),
		Framework\Widget\Validate\Validator::class
	],

	//----------------------------------------------------------------------- HIGHER priority plugins
	Priority::HIGHER => [
		Framework\Dao\Cache::class,
		Framework\View\Logger::class => [
			'path' => $loc[Framework\Dao\File\Link::class]['path'] . '/logs',
		],
		// higher than Mysql\File_Logger and Mysql\Maintainer
		Framework\Widget\Delete_And_Replace::class
	]

];
