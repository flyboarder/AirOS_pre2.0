<?php

namespace AirOS\I18nRoutingBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideRoutingCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $container->setParameter('routing.loader.xml.class', 'AirOS\\I18nRoutingBundle\\Routing\\Loader\\XmlFileLoader');
        $container->setParameter('routing.loader.yml.class', 'AirOS\\I18nRoutingBundle\\Routing\\Loader\\YamlFileLoader');

        $routerReal = $container->findDefinition('router');
        $arguments  = $routerReal->getArguments();

        $container->setAlias('router', 'i18n_routing.router');


        $i18nRoutingRouter = $container->findDefinition('i18n_routing.router');
        $i18nRoutingRouter->replaceArgument(2, $arguments[1]);
    }
}
