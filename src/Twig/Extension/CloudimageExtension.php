<?php
declare(strict_types=1);

namespace Codeplace\CloudimageBundle\Twig\Extension;

use Codeplace\CloudimageBundle\Service\CloudimageService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class CloudimageExtension extends AbstractExtension
{
    private CloudimageService $cloudimageService;

    public function __construct(CloudimageService $cloudimageService)
    {
        $this->cloudimageService = $cloudimageService;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'cloudimage',
                [$this, 'resolveUri']
            ),
        ];
    }

    public function resolveUri(string $localUri, $options = null): string
    {
        return $this->cloudimageService->getUri($localUri, $options);
    }
}