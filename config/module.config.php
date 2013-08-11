<?php

/**
 * Config for the slug generator
 */
return array(
    'service_manager' => array(
        'factories' => array(
            'Zf2SlugGenerator\SlugService' => 'Zf2SlugGenerator\Service\Factory\SlugFactory',
        ),
    ),
);
