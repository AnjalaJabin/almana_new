<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6eccf74065ee8d5f887d2d147011f1d4
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6eccf74065ee8d5f887d2d147011f1d4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6eccf74065ee8d5f887d2d147011f1d4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6eccf74065ee8d5f887d2d147011f1d4::$classMap;

        }, null, ClassLoader::class);
    }
}
