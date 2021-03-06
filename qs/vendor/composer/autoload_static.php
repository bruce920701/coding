<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8b38995f8d341764cb1bcc23bee54bd1
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\EventDispatcher\\' => 34,
        ),
        'A' => 
        array (
            'App\\' => 4,
            'Alexlbr\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\EventDispatcher\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/event-dispatcher',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
        'Alexlbr\\' => 
        array (
            0 => __DIR__ . '/..' . '/alexlbr/email/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Smtpapi' => 
            array (
                0 => __DIR__ . '/..' . '/sendgrid/smtpapi/lib',
            ),
            'SendGrid' => 
            array (
                0 => __DIR__ . '/..' . '/sendgrid/sendgrid/lib',
            ),
        ),
        'G' => 
        array (
            'Guzzle\\Tests' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/guzzle/tests',
            ),
            'Guzzle' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/guzzle/src',
            ),
        ),
        'C' => 
        array (
            'Curl' => 
            array (
                0 => __DIR__ . '/..' . '/curl/curl/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8b38995f8d341764cb1bcc23bee54bd1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8b38995f8d341764cb1bcc23bee54bd1::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit8b38995f8d341764cb1bcc23bee54bd1::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
