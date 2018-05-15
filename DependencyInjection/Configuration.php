<?php

namespace Suez\Bundle\SmartCoachClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('suez_smart_coach_client');

        $rootNode
            ->children()
                ->arrayNode('jwt')
                    ->isRequired()
                    ->children()
                        ->scalarNode('url')->isRequired()->end()
                        ->scalarNode('api_key')->isRequired()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
