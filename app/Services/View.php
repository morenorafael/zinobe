<?php

namespace App\Services;

use Psr\Http\Message\ResponseInterface;

class View
{
    /**
     * @var \Twig_Environment
     */
    protected $view;

    /**
     * @var ResponseInterface
     */
    protected $response;

    public function __construct(ResponseInterface $response)
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../resources/view');
        $view = new \Twig_Environment($loader);

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
        $this->response->getBody()->write($this->view->render($view, $data));

        return $this->response;
    }
}