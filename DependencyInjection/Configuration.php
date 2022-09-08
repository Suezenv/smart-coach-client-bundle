<?php

namespace Suez\Bundle\SmartCoachClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    const SUEZ_SMART_COACH_CLIENT = 'suez_smart_coach_client';

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(self::SUEZ_SMART_COACH_CLIENT);
        $rootNode = method_exists(TreeBuilder::class, 'getRootNode') ? $treeBuilder->getRootNode() : $treeBuilder->root(self::SUEZ_SMART_COACH_CLIENT);

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
