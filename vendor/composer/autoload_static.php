<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9e5ce023b76638642b01598df826942e
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mobizon\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mobizon\\' => 
        array (
            0 => __DIR__ . '/..' . '/mobizon/mobizon-php/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9e5ce023b76638642b01598df826942e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9e5ce023b76638642b01598df826942e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9e5ce023b76638642b01598df826942e::$classMap;

        }, null, ClassLoader::class);
    }
}
