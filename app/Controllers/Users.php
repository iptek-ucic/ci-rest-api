<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    public function index()
    {
        $users = $this->model->findAll();
        $data = [
            'status' => 'success',
            'data' => $users
        ];

        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $user = $this->model->find($id);
        if($user) {
            $data = [
                'status' => 'success',
                'data' => $user
            ];

            return $this->respond($data, 200);
        } else {
            $data = [
                'status' => 'error',
                'message' => 'User not found.'
            ];

            return $this->respond($data, 200);
        }
    }

    public function create()
    {
        $post = $this->request->getRawInput();
        if($this->model->save($post)) {
            $response = [
                'status' => 'success',
                'message' => 'User was successfully created.',
                'data' => $post
            ];

            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to create new user.',
            ];

            return $this->respond($response);
        }


    }

    public function update($id = NULL)
    {
        $user = $this->model->find($id);
        if($user) {
            $post = $this->request->getRawInput();
            $this->model->update($id, $post);

            $data = [
                'status' => 'success',
                'data' => $post,
                'message' => 'User was successfully updated.'
            ];

            return $this->respond($data, 200);
        } else {
            $data = [
                'status' => 'error',
                'message' => 'User not found.'
            ];

            return $this->respond($data, 200);
        }
    }

    public function delete($id = NULL)
    {
        $user = $this->model->find($id);
        if($user) {
            $this->model->delete($id);

            $data = [
                'status' => 'success',
                'message' => 'User was successfully deleted.'
            ];

            return $this->respond($data, 200);
        } else {
            $data = [
                'status' => 'error',
                'message' => 'User not found.'
            ];

            return $this->respond($data, 200);
        }
    }
}