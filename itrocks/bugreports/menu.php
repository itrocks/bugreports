<?php
namespace ITRocks\Bugreports;

use ITRocks\Bugreports;
use ITRocks\Framework\Widget\Menu;

return [
	'Administration' => [
		Menu::CLEAR,
		'/ITRocks/Framework/Users' => 'Users',
		'/ITRocks/Framework/User/Groups' => 'User groups',
		'/ITRocks/Framework/Layout/Models' => 'Print models',
		'/ITRocks/Framework/Logger/Entries' => 'Log entries',
		'/ITRocks/Framework/Locale/Translations' => 'Translations',
		'/ITRocks/Framework/RAD/Features' => 'Features',
	]
];
