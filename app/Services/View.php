<?php

namespace App\Services;

use App\Tools\TwigFunctions;
use Psr\Http\Message\ResponseInterface;
use Twig\Environment;

class View
{
    /**
     * @var Environment
     */
    protected $view;

    /**
     * @var ResponseInterface
     */
    protected $response;

    public function __construct(ResponseInterface $response)
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../resources/views');
        $view = new Environment($loader);

        $twigFunctions = new \Twig_SimpleFunction(TwigFunctions::class, function ($method, $params = []) {
            return TwigFunctions::$method($params);
        });

        $view->addFunction($twigFunctions);

        $this->view = $view;
        $this->response = $response;
    }

    /**
     * @param string $view
     * @param array $data
     * @return ResponseInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(string $view, array $data = []): ResponseInterface
    {
        $this->response->getBody()->write($this->view->render("{$view}.twig", $data));

        return $this->response;
    }
}