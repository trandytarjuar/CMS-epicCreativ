<?php

// ============================================
// ServiceController.php
// ============================================

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\ServiceTranslationModel;

class ServiceController extends BaseController
{
    protected ServiceModel $serviceModel;

    protected ServiceTranslationModel $translationModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->translationModel = new ServiceTranslationModel();
    }

    // ============================================
    // LIST
    // ============================================

    public function index($lang = 'ID')
    {
        $lang = strtoupper($lang);

        $data = $this->translationModel
            ->select('
                service_translations.id as translation_id,
                services.id as service_id,
                services.image,
                service_translations.title,
                service_translations.description
            ')
            ->join(
                'services',
                'services.id = service_translations.service_id'
            )
            ->join(
                'languages',
                'languages.id = service_translations.language_id'
            )
            ->where('languages.code', $lang)
            ->orderBy('services.id', 'DESC')
            ->findAll();

        foreach ($data as &$row) {

            $en = $this->translationModel
                ->select('service_translations.id')
                ->join(
                    'languages',
                    'languages.id = service_translations.language_id'
                )
                ->where(
                    'service_translations.service_id',
                    $row['service_id']
                )
                ->where(
                    'languages.code',
                    'EN'
                )
                ->first();

            $row['has_en'] = !empty($en);
        }

        return view('service/index', [
            'data' => $data,
            'lang' => strtolower($lang)
        ]);
    }

    // ============================================
    // CREATE VIEW
    // ============================================

    public function create($lang = 'id')
    {
        return view('service/create', [
            'lang' => strtolower($lang)
        ]);
    }

    // ============================================
    // STORE SERVICE BARU
    // ============================================

    public function store()
    {
        $lang = strtolower(
            $this->request->getPost('lang')
        );

        $language = model('LanguageModel')
            ->where('code', strtoupper($lang))
            ->first();

        if (!$language) {

            return redirect()->back()
                ->with('error', 'Language tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'image' => [

                'label' => 'Image',

                'rules' =>
                'permit_empty'
                    . '|is_image[image]'
                    . '|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]'
                    . '|max_size[image,2048]'
            ]
        ]);
        if (
            !$validation->withRequest(
                $this->request
            )->run()
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    $validation->getError('image')
                );
        }


        // =====================================
        // UPLOAD IMAGE
        // =====================================

        $imageFile = $this->request->getFile('image');

        if (
            $imageFile->getError() ===
            UPLOAD_ERR_INI_SIZE
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Ukuran file maksimal 2 MB'
                );
        }


        $imageName = null;

        if (
            $imageFile &&
            $imageFile->isValid() &&
            !$imageFile->hasMoved()
        ) {

            $uploadPath =
                ROOTPATH . 'public/image/service/';

            if (!is_dir($uploadPath)) {

                mkdir($uploadPath, 0777, true);
            }

            $imageName =
                $imageFile->getRandomName();

            $imageFile->move(
                $uploadPath,
                $imageName
            );
        }

        // =====================================
        // INSERT SERVICE
        // =====================================

        $serviceId = $this->serviceModel->insert([
            'image' => $imageName,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // =====================================
        // INSERT TRANSLATION
        // =====================================

        $this->translationModel->insert([
            'service_id' => $serviceId,
            'language_id' => $language['id'],
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/service/' . $lang)
            ->with('success', 'Berhasil disimpan');
    }

    // ============================================
    // FORM ADD TRANSLATION
    // ============================================

    public function translation(
        int $serviceId,
        string $lang
    ) {
        $service = $this->serviceModel->find($serviceId);

        if (!$service) {

            return redirect()->back()
                ->with('error', 'Service tidak ditemukan');
        }

        return view('service/translation', [
            'service' => $service,
            'service_id' => $serviceId,
            'lang' => strtolower($lang)
        ]);
    }

    // ============================================
    // SAVE TRANSLATION
    // ============================================

    public function addTranslation(int $serviceId)
    {
        $lang = strtolower(
            $this->request->getPost('lang')
        );

        $language = model('LanguageModel')
            ->where('code', strtoupper($lang))
            ->first();

        if (!$language) {

            return redirect()->back()
                ->with('error', 'Language tidak ditemukan');
        }

        // cek translation sudah ada
        $exists = $this->translationModel
            ->where('service_id', $serviceId)
            ->where('language_id', $language['id'])
            ->first();

        if ($exists) {

            return redirect()->back()
                ->with('error', 'Translation sudah ada');
        }

        $this->translationModel->insert([
            'service_id' => $serviceId,
            'language_id' => $language['id'],
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/service/' . $lang)
            ->with('success', 'Translation berhasil ditambahkan');
    }

    // ============================================
    // DETAIL
    // ============================================

    public function detail(int $id, $lang = 'ID')
    {
        $lang = strtoupper($lang);

        $service = $this->translationModel
            ->select('
                services.id as service_id,
                services.image,
                service_translations.title,
                service_translations.description
            ')
            ->join(
                'services',
                'services.id = service_translations.service_id'
            )
            ->join(
                'languages',
                'languages.id = service_translations.language_id'
            )
            ->where('services.id', $id)
            ->where('languages.code', $lang)
            ->first();

        if (!$service) {

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $service
        ]);
    }

    // ============================================
    // EDIT VIEW
    // ============================================

    public function edit(int $serviceId, string $lang)
    {
        $language = model('LanguageModel')
            ->where('code', strtoupper($lang))
            ->first();

        $service = $this->translationModel
            ->select('
                service_translations.*,
                services.image
            ')
            ->join(
                'services',
                'services.id = service_translations.service_id'
            )
            ->where('service_id', $serviceId)
            ->where('language_id', $language['id'])
            ->first();

        if (!$service) {

            return redirect()->back()
                ->with('error', 'Data tidak ditemukan');
        }

        return view('service/edit', [
            'service' => $service,
            'service_id' => $serviceId,
            'lang' => strtolower($lang)
        ]);
    }

    // ============================================
    // UPDATE
    // ============================================

    // public function update($serviceId, $lang)
    // {
    //     $language = model('LanguageModel')
    //         ->where('code', strtoupper($lang))
    //         ->first();

    //     $translation = $this->translationModel
    //         ->where('service_id', $serviceId)
    //         ->where('language_id', $language['id'])
    //         ->first();

    //     if (!$translation) {

    //         return redirect()->back()
    //             ->with('error', 'Translation tidak ditemukan');
    //     }

    //     // =====================================
    //     // UPDATE IMAGE
    //     // =====================================

    //     $imageFile = $this->request->getFile('image');

    //     if (
    //         $imageFile &&
    //         $imageFile->isValid() &&
    //         !$imageFile->hasMoved()
    //     ) {

    //         $service =
    //             $this->serviceModel->find($serviceId);

    //         // hapus image lama
    //         if (
    //             !empty($service['image']) &&
    //             file_exists(
    //                 ROOTPATH .
    //                 'public/image/service/' .
    //                 $service['image']
    //             )
    //         ) {

    //             unlink(
    //                 ROOTPATH .
    //                 'public/image/service/' .
    //                 $service['image']
    //             );
    //         }

    //         $uploadPath =
    //             ROOTPATH . 'public/image/service/';

    //         if (!is_dir($uploadPath)) {

    //             mkdir($uploadPath, 0777, true);
    //         }

    //         $imageName =
    //             $imageFile->getRandomName();

    //         $imageFile->move(
    //             $uploadPath,
    //             $imageName
    //         );

    //         // update image parent
    //         $this->serviceModel->update(
    //             $serviceId,
    //             [
    //                 'image' => $imageName
    //             ]
    //         );
    //     }

    //     // =====================================
    //     // UPDATE TRANSLATION
    //     // =====================================

    //     $this->translationModel->update(
    //         $translation['id'],
    //         [
    //             'title' => $this->request->getPost('title'),
    //             'description' => $this->request->getPost('description'),
    //             'updated_at' => date('Y-m-d H:i:s')
    //         ]
    //     );

    //     return redirect()->to('/service/' . $lang)
    //         ->with('success', 'Berhasil diupdate');
    // }
    public function update(int $serviceId, string $lang)
    {
        $language = model('LanguageModel')
            ->where('code', strtoupper($lang))
            ->first();

        $translation = $this->translationModel
            ->where('service_id', $serviceId)
            ->where('language_id', $language['id'])
            ->first();

        if (!$translation) {

            return redirect()->back()
                ->with('error', 'Translation tidak ditemukan');
        }

        // =====================================
        // UPDATE IMAGE
        // =====================================

        $imageFile = $this->request->getFile('image');
        if (
            $imageFile->getError() ===
            UPLOAD_ERR_INI_SIZE
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Ukuran file maksimal 2 MB'
                );
        }
        // var_dump($imageFile);die;

        if (
            $imageFile &&
            $imageFile->isValid() &&
            !$imageFile->hasMoved()
        ) {

            $service = $this->serviceModel->find($serviceId);

            // hapus image lama
            if (
                !empty($service['image']) &&
                file_exists(
                    ROOTPATH .
                        'public/image/service/' .
                        $service['image']
                )
            ) {

                unlink(
                    ROOTPATH .
                        'public/image/service/' .
                        $service['image']
                );
            }

            $uploadPath =
                ROOTPATH . 'public/image/service/';

            if (!is_dir($uploadPath)) {

                mkdir($uploadPath, 0777, true);
            }

            $imageName =
                $imageFile->getRandomName();

            $imageFile->move(
                $uploadPath,
                $imageName
            );

            // update image parent
            $this->serviceModel->update(
                $serviceId,
                [
                    'image' => $imageName
                ]
            );
        }

        // =====================================
        // UPDATE TRANSLATION
        // =====================================

        $this->translationModel->update(
            $translation['id'],
            [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        return redirect()->to('/service/' . strtolower($lang))
            ->with('success', 'Berhasil diupdate');
    }

    // ============================================
    // DELETE TRANSLATION
    // ============================================

    public function deleteTranslation(int $id)
    {
        $translation =
            $this->translationModel->find($id);

        if (!$translation) {

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Translation tidak ditemukan'
            ]);
        }

        $this->translationModel->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Translation berhasil dihapus'
        ]);
    }

    // ============================================
    // DELETE SERVICE
    // ============================================

    public function delete(int $id)
    {
        $service = $this->serviceModel->find($id);

        if (!$service) {

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }

        // hapus image
        if (
            !empty($service['image']) &&
            file_exists(
                ROOTPATH .
                    'public/image/service/' .
                    $service['image']
            )
        ) {

            unlink(
                ROOTPATH .
                    'public/image/service/' .
                    $service['image']
            );
        }

        // hapus semua translation
        $this->translationModel
            ->where('service_id', $id)
            ->delete();

        // hapus service
        $this->serviceModel->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Service berhasil dihapus'
        ]);
    }
}
