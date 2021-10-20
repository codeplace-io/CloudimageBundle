<?php
declare(strict_types=1);

namespace Codeplace\CloudimageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('codeplace_cloudimage');
        $rootNode = \method_exists(TreeBuilder::class, 'getRootNode') ? $treeBuilder->getRootNode() : $treeBuilder->root('codeplace_cloudimage');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->booleanNode('enable')
                    ->defaultTrue()
                ->end()
                ->scalarNode('token')
                    ->isRequired()
                ->end()
                ->scalarNode('domain')
                    ->defaultNull()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}