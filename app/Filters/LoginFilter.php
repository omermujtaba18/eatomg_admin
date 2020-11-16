<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        $session = session();
        if (!$session->user_name && !$session->user_rest) {
            return redirect()->to('/user/login');
        }

        if ($session->user_role != 'A' && $request->getGet('rest_id') != $session->user_rest) {
            $session->destroy();
            return redirect()->to('/user/login');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}
