<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3ea00e8b1227f8a6cdb5089219bde224
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3ea00e8b1227f8a6cdb5089219bde224::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3ea00e8b1227f8a6cdb5089219bde224::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
