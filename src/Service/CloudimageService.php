<?php
declare(strict_types=1);

namespace Codeplace\CloudimageBundle\Service;

use Symfony\Component\HttpFoundation\RequestStack;

final class CloudimageService
{
    private bool $enable;
    private string $token;
    private ?string $domain;

    public function __construct(RequestStack $requestStack, bool $enable, string $token, ?string $domain = null)
    {
        $this->enable = $enable;
        $this->token = $token;
        $this->domain = $domain ?? $requestStack->getMasterRequest()->getHttpHost();
    }

    public function getUri(string $localUri, $options = null): string
    {
        if (!$this->enable) {
            return $localUri;
        }

        $uri = sprintf(
            '%s%s/%s',
            $this->getCloudimageBaseUrl(),
            $this->domain,
            ltrim($localUri, '/')
        );

        $queryString = $this->optionsToQueryString($options);

        if (null !== $options) {
            $uri = $uri.'?'.$queryString;
        }

        return $uri;
    }

    public function getCloudimageBaseUrl(): string
    {
        return sprintf('https://%s.cloudimg.io/v7/', $this->token);
    }

    protected function optionsToQueryString($options): ?string
    {
        if (null === $options) {
            return null;
        }

        if (is_string($options)) {
            $options = [
                'p' => $options,
            ];
        }

        return http_build_query($options);
    }
}