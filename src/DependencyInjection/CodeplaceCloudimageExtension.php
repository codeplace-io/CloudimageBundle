<?php
declare(strict_types=1);

namespace Codeplace\CloudimageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

final class CodeplaceCloudimageExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $container
            ->findDefinition('Codeplace\CloudimageBundle\Service\CloudimageService')
            ->setArgument(1, $config['enable'])
            ->setArgument(2, $config['token'])
            ->setArgument(3, $config['domain'])
        ;
    }
}