<?php

namespace App\Controllers;

use App\Models\ClientModel;

class ClientController extends BaseController
{
    protected $clientModel;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
    }

    public function index()
    {
        $data['clients'] = $this->clientModel->getAll();
        return view('client', $data);
    }

    public function store()
    {
        $result = $this->clientModel->createClient(
            $this->request->getPost('name'),
            $this->request->getFile('logo')
        );

        return $this->response->setJSON($result);
    }

    public function show($id)
    {
        return $this->response->setJSON(
            $this->clientModel->getById($id)
        );
    }

    public function update($id)
    {
        $result = $this->clientModel->updateClient(
            $id,
            $this->request->getPost('name'),
            $this->request->getFile('logo')
        );

        return $this->response->setJSON($result);
    }

    public function delete($id)
    {
        $result = $this->clientModel->deleteClient($id);

        return $this->response->setJSON($result);
    }
}
