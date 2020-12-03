<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;

class ValidateToken implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        $token = $request->getGet('api_token');
        if ($token !== '' && $token != '123') {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid API Key.'
            ]);
            die();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}