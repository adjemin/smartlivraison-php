<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita3575d355a49873d5c994d7a9ffd1d13
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'SmartLivraison' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInita3575d355a49873d5c994d7a9ffd1d13::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}