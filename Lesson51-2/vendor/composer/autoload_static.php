<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit42db4730f926aa109ac3976c062f4767
{
    public static $prefixesPsr0 = array (
        'Y' => 
        array (
            'Yandex\\Geo' => 
            array (
                0 => __DIR__ . '/..' . '/yandex/geo/source',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit42db4730f926aa109ac3976c062f4767::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}