# it.rocks / bug-reports

A project where you can create branches to help us to reproduce bugs.

When you found something that does not work using the it.rocks Framework, the best it to reproduce
the problem into a neutral project

## Pre-requisites

- Had have some bugs or improvement requests using [itrocks/framework](https://github.com/itrocks/framework) that you are pretty sure it comes from the framework itself
- Apache
- Composer
- Git
- MySQL 5.5+
- PHP 5.6+
- Know how they work, and how to commit into GitHub

## Install it.rocks bug-reports into your environment

- Prepare MySQL : create a database and user named **itrocks_bugreports**
- The user should not have access to anything on your databases (*mysql.users*)
- The user must have access to all rights on the itrocks_bugreports database (*mysql.db*)
- Clone the project :

```bash
git clone git@github.bappli.com:itrocks/bugreports
cd bugreports
composer update
mkdir cache
chmod ugo+rwx cache
chmod ugo+rwx .
touch loc.php
touch pwd.php
touch ~/bugreports.php
sudo mkdir -p /home/itrocks/bugreports/prod/data/logs
sudo chown -R www-data.www-data /home/itrocks/bugreports/prod/data
sudo chmod ugo+rwx /home/itrocks/bugreports/prod/data/logs
```

- Create those files into your project root directory :

**loc.php**

```php
<?php

use ITRocks\Framework\Configuration;
use ITRocks\Framework\Configuration\Environment;
use ITRocks\Framework\Dao\File;
use ITRocks\Framework\Dao\Mysql;

$loc = [
	Configuration::ENVIRONMENT => Environment::DEVELOPMENT,
	File\Link::class => ['class' => File\Link::class, 'path' => '/home/itrocks/bugreports/prod/data'],
	Mysql\Link::class => [
		Mysql\Link::DATABASE => 'itrocks_bugreports',
		Mysql\Link::LOGIN    => 'itrocks_bugreports'
	]
];
```

**pwd.php**

```php
<?php
use ITRocks\Framework\Dao\Mysql\Link;

$pwd = [
	Link::class => 'yourlocalpassword'
];
```

- Create this file into your web server root :

**~/bugreports.php**

```php
<?php
require 'PhpStorm/itrocks/bugreports/itrocks/framework/index.php';
```

This is an example : on my Linux development environment :

- **/etc/hosts** make **it.rocks** point on **127.0.0.1**
- Into Apache **it.rocks** points on my home directory ~/
- I work with PhpStorm and I have installed this project into **~/PhpStorm/itrocks/bugreports**  
- I will be able to access this application using http://it.rocks/bugreports

You may change the content of these files according to your own development environment.

- Prepare your development environment :
    - Create file watchers that creates an "update" file into the root of the project each time you change a .php or a .html file. If you use PhpStorm, you can create the following file and import the **watchers.xml** file watchers file from the environment directory of this project.

**~/bin/updateflag**

```bash
#!/bin/bash
touch update
chmod ugo+rwx update
```

## Access the bug-reports application

http://it.rocks/bugreports

## Reveal your bug

- Create a new branch named describe-your-bug. If you have an issue number associated to it, it is important to name your branch 12345-describe-your-bug to identify the maching issue.
- Create the littliest code you can that reproduce your bug. You can use business objects already existing in the framework, or into the master of bugreports, to reproduce your problem into the most standard environment as possible.
- Push your branch into Github, and create a new issue / refer it to the existing issue.
- Describe precisely into the issue how I can reproduce the proble once we have checkout your branch :
    - what data may be created first
    - in which menu / buttons shall we click
    - describe what is the bad behaviour
    - describe what behaviour it should be
    - describe why, if is not evident

## Wait for your bug to be fixed

If we can reproduce the anomaly, just wait for it.
You can also fork itrocks/framework and push a merge request of your fix proposal to help to solve the problem. 

# MIT License

This program and its documentation are released into MIT License :

« Copyright © Baptiste Pillot - baptiste at pillot dot fr & B-APPLI Studio - baptiste dot pillot at bappli dot com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions :

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

The Software is provided "as is", without warranty of any kind, express or implied, including but not limited to the warranties of merchantability, fitness for a particular purpose and noninfringement. In no event shall the authors or copyright holders be liable for any claim, damages or other liability, whether in an action of contract, tort or otherwise, arising from, out of or in connection with the software or the use or other dealings in the Software. »
