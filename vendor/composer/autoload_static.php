<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit52a87489ff0abd0580fc7f35e5bfe177
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit52a87489ff0abd0580fc7f35e5bfe177::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit52a87489ff0abd0580fc7f35e5bfe177::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
