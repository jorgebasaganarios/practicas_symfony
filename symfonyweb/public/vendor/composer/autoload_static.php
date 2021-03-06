<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4855f447ba41e3d9ed051d01c06fac6c
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\assets\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\assets\\' =>
        array (
            0 => __DIR__ . '/..' . '/symfony/asset',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4855f447ba41e3d9ed051d01c06fac6c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4855f447ba41e3d9ed051d01c06fac6c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
