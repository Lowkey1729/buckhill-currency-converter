<?php

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Container\Container;
use Illuminate\Http\Response;

if (!function_exists('response')) {
    /**
     * Return a new response from the application.
     *
     * @param string $content
     * @param int $status
     * @param array $headers
     * @return Response|ResponseFactory
     * @throws BindingResolutionException
     */
    function response(
        string $content = '',
        int    $status = 200,
        array  $headers = []
    ): Response|ResponseFactory
    {
        $factory = app(ResponseFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($content, $status, $headers);
    }
}

if (!function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param string|null $abstract
     * @param array $parameters
     * @return Container
     * @throws BindingResolutionException
     */
    function app(string|null $abstract = null, array $parameters = []): Container
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($abstract, $parameters);
    }
}