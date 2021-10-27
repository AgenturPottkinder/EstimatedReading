<?php
namespace Pottkinder\Estimatedreading\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\HtmlResponse;

class EstimateReading implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        $body = $response->getBody()->__toString();

        $replacementArray = \Pottkinder\Estimatedreading\Service\EstimateReadingService::getReplacementArray();
        $body = str_replace($replacementArray['search'], $replacementArray['replace'], $body);

        return new HtmlResponse($body);
    }
}