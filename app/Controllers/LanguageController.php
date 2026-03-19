<?php

namespace App\Controllers;

use App\Models\LanguageModel;

class LanguageController extends BaseController
{
    protected $LanguageModel;

    public function __construct()
    {
        $this->LanguageModel = new LanguageModel();
    }

    public function index()
    {
        $data['languages'] = $this->LanguageModel->getAll();
        return view('language', $data);
    }

    public function store()
    {
        return $this->response->setJSON(
            $this->LanguageModel->createLanguage(
                $this->request->getPost()
            )
        );
    }

    public function update($id)
    {
        return $this->response->setJSON(
            $this->LanguageModel->updateLanguage(
                $id,
                $this->request->getPost()
            )
        );
    }

    public function delete($id)
    {
        return $this->response->setJSON(
            $this->LanguageModel->deleteLanguage($id)
        );
    }
}
