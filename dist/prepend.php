<?php

require_once dirname(__FILE__) . '/config.php';

$site = Zend_Registry::get('site');

$application = $site->getInstance( dirname(__FILE__) . '/..' );
Zend_Registry::set('application', $application);

$configuration = $application->getConfiguration();

$namespaces = explode(";", $site->getConfig('bouncer_id'));

$namespace = $namespaces[0];
