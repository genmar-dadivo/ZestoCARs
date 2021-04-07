<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9150089e254ed4d93897c410b66ccca0
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9150089e254ed4d93897c410b66ccca0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9150089e254ed4d93897c410b66ccca0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9150089e254ed4d93897c410b66ccca0::$classMap;

        }, null, ClassLoader::class);
    }
}