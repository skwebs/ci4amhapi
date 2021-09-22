<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class User extends ResourceController
{
    private $userModel;


    // use ResponseTrait;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->db = \Config\Database::connect();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $data = $this->userModel->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
        $data = $this->userModel->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('User does not exist.');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $this->userModel->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'User created'
            ]
        ];
        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $this->userModel->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'User updated.'
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
        $data = $this->userModel->where('id', $id)->first();
        if ($data) {
            $this->userModel->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'User deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('User does not exist.');
        }
    }



    public function deleted()
    {
        $data = $this->userModel->onlyDeleted()->findAll();
        // $data = ['name' => 'satish'];
        return $this->respond($data);
    }

    public function restore($id = null)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('id', $id)->update(['deleted_at' => null]);


        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'User restored.'
            ]
        ];
        return $this->respond($response);
    }
}
