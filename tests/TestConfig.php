<?php
return array(
    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'Zf2SlugGenerator',
    ),

    // These are various options for the listeners attached to the ModuleManager
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    ),
);