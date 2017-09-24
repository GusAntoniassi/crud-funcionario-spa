<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'AdminLTE' => $baseDir . '/vendor/maiconpinto/cakephp-adminlte-theme/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'CakePtbr' => $baseDir . '/vendor/jrbasso/cake_ptbr/',
        'Cake/Localized' => $baseDir . '/vendor/cakephp/localized/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Search' => $baseDir . '/vendor/friendsofcake/search/'
    ]
];