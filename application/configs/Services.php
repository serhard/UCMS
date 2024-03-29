<?php


use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

$container->setDefinition(
    'doctrineApp',
    new Definition(
        'UCMS_App_Doctrine',
        array(
            new Reference('service_container')
        )
    )
);

$container->setDefinition(
    'ucmsAppAuth',
    new Definition(
        'UCMS_App_Authentication',
        array(
            new Reference('service_container')
        )
    )
);