<?php

namespace App\Controllers;

use App\Models\SubserviceModel;
use App\Models\SubserviceTranslationModel;

class SubserviceController extends BaseController
{
    protected SubserviceModel $subserviceModel;
    protected SubserviceTranslationModel $translationModel;

    public function __construct()
    {
        $this->subserviceModel =
            new SubserviceModel();

        $this->translationModel =
            new SubserviceTranslationModel();
    }

    // =========================================
    // INDEX
    // =========================================

    public function index($lang = 'id')
    {
        helper('text');

        $lang = strtolower($lang);

        $otherLang =
            $lang == 'id'
            ? 'EN'
            : 'ID';

        $data = $this->translationModel

            ->select('
            sub_services.id as sub_service_id,
            sub_services.service_id,
            sub_services.image,

            sub_service_translations.id as translation_id,
            sub_service_translations.title,
            sub_service_translations.description,

            service_translations.title as service_title,

            (
                SELECT COUNT(*)
                FROM sub_service_translations st2
                JOIN languages l2
                    ON l2.id = st2.language_id
                WHERE st2.sub_service_id = sub_services.id
                AND l2.code = "' . $otherLang . '"
            ) as translation_exists
        ')

            ->join(
                'sub_services',
                'sub_services.id = sub_service_translations.sub_service_id'
            )

            ->join(
                'languages',
                'languages.id = sub_service_translations.language_id'
            )

            ->join(
                'service_translations',
                'service_translations.service_id = sub_services.service_id'
            )

            ->join(
                'languages sl',
                'sl.id = service_translations.language_id'
            )

            ->where(
                'languages.code',
                strtoupper($lang)
            )

            ->where(
                'sl.code',
                strtoupper($lang)
            )

            ->orderBy(
                'sub_services.id',
                'DESC'
            )

            ->findAll();

        return view(
            'subservice/index',
            [
                'data' => $data,
                'lang' => $lang
            ]
        );
    }

    // =========================================
    // CREATE
    // =========================================

    public function create($lang = 'id')
    {
        $lang = strtolower($lang);

        $services =
            model('ServiceTranslationModel')

            ->select('
            services.id as service_id,
            service_translations.title
        ')

            ->join(
                'services',
                'services.id = service_translations.service_id'
            )

            ->join(
                'languages',
                'languages.id = service_translations.language_id'
            )

            ->where(
                'languages.code',
                strtoupper($lang)
            )

            ->findAll();

        return view(
            'subservice/create',
            [
                'services' => $services,
                'lang' => $lang
            ]
        );
    }

    // =========================================
    // STORE
    // =========================================



    public function store()
    {
        $lang = strtolower(
            $this->request->getPost('lang')
        );

        $language = model('LanguageModel')

            ->where(
                'LOWER(code)',
                $lang
            )

            ->first();

        // IMAGE
        $imageName = null;

        $imageFile =
            $this->request->getFile('image');

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

        if (
            $imageFile &&
            $imageFile->isValid() &&
            !$imageFile->hasMoved()
        ) {

            $uploadPath =
                FCPATH .
                'image/subservice/';

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            $imageName =
                $imageFile->getRandomName();

            $imageFile->move(
                $uploadPath,
                $imageName
            );
        }

        // INSERT MASTER
        $this->subserviceModel->insert([

            'service_id' =>
            $this->request->getPost(
                'service_id'
            ),

            'image' => $imageName,

            'created_at' =>
            date('Y-m-d H:i:s')

        ]);

        $subServiceId =
            $this->subserviceModel
            ->getInsertID();

        // INSERT TRANSLATION
        $this->translationModel->insert([

            'sub_service_id' =>
            $subServiceId,

            'language_id' =>
            $language['id'],

            'title' =>
            $this->request->getPost(
                'title'
            ),

            'description' =>
            $this->request->getPost(
                'description'
            ),

            'created_at' =>
            date('Y-m-d H:i:s')

        ]);

        return redirect()->to(
            '/subservice/' . $lang
        )->with(
            'success',
            'Berhasil disimpan'
        );
    }

    // ======================
    // TRANSLATION SUBSERVICE
    // ======================

    public function translation(
        int $id,
        string $lang
    ) {
        $lang = strtolower($lang);

        $subservice =
            $this->subserviceModel
            ->find($id);

        $service =
            model('ServiceTranslationModel')

            ->select(
                'service_translations.title'
            )

            ->join(
                'languages',
                'languages.id = service_translations.language_id'
            )

            ->where(
                'service_translations.service_id',
                $subservice['service_id']
            )

            ->where(
                'languages.code',
                strtoupper($lang)
            )

            ->first();

        return view(
            'subservice/translation',
            [
                'sub_service_id' => $id,
                'subservice' => $subservice,
                'service' => $service,
                'lang' => $lang
            ]
        );
    }
    // ======================
    // STORE TRANSLATION SUBSERVICE
    // ======================

    public function storeTranslation()
    {
        $lang = strtolower(
            $this->request->getPost('lang')
        );

        $language = model('LanguageModel')

            ->where(
                'LOWER(code)',
                $lang
            )

            ->first();

        $exists =
            $this->translationModel

            ->where(
                'sub_service_id',
                $this->request->getPost(
                    'sub_service_id'
                )
            )

            ->where(
                'language_id',
                $language['id']
            )

            ->first();

        if ($exists) {

            return redirect()->back()
                ->with(
                    'error',
                    'Translation sudah ada'
                );
        }

        $this->translationModel->insert([

            'sub_service_id' =>
            $this->request->getPost(
                'sub_service_id'
            ),

            'language_id' =>
            $language['id'],

            'title' =>
            $this->request->getPost(
                'title'
            ),

            'description' =>
            $this->request->getPost(
                'description'
            ),

            'created_at' =>
            date('Y-m-d H:i:s')

        ]);

        return redirect()->to(
            '/subservice/' . $lang
        )->with(
            'success',
            'Translation berhasil ditambahkan'
        );
    }



    // =========================================
    // DELETE
    // =========================================

    public function delete(int $id)
    {
        $subservice =
            $this->subserviceModel
            ->find($id);

        if (!$subservice) {

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }

        // delete image
        if (!empty($subservice['image'])) {

            $imagePath =
                FCPATH .
                'image/subservice/' .
                $subservice['image'];

            if (file_exists($imagePath)) {

                unlink($imagePath);
            }
        }

        // delete translations
        $this->translationModel

            ->where(
                'sub_service_id',
                $id
            )

            ->delete();

        // delete master
        $this->subserviceModel
            ->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Berhasil dihapus'
        ]);
    }

    public function edit(
        int $id,
        string $lang
    ) {
        $lang = strtolower($lang);

        $subservice = $this->translationModel

            ->select('
            sub_services.id as sub_service_id,
            sub_services.service_id,
            sub_services.image,

            sub_service_translations.id as translation_id,
            sub_service_translations.title,
            sub_service_translations.description
        ')

            ->join(
                'sub_services',
                'sub_services.id = sub_service_translations.sub_service_id'
            )

            ->join(
                'languages',
                'languages.id = sub_service_translations.language_id'
            )

            ->where(
                'sub_services.id',
                $id
            )

            ->where(
                'languages.code',
                strtoupper($lang)
            )

            ->first();

        if (!$subservice) {

            return redirect()->back()
                ->with(
                    'error',
                    'Data tidak ditemukan'
                );
        }

        $service =
            model('ServiceTranslationModel')

            ->select(
                'service_translations.title'
            )

            ->join(
                'languages',
                'languages.id = service_translations.language_id'
            )

            ->where(
                'service_translations.service_id',
                $subservice['service_id']
            )

            ->where(
                'languages.code',
                strtoupper($lang)
            )

            ->first();

        return view(
            'subservice/edit',
            [
                'subservice' => $subservice,
                'service' => $service,
                'lang' => $lang
            ]
        );
    }

    public function update(int $id)
    {
        $lang = strtolower(
            $this->request->getPost('lang')
        );

        $subservice =
            $this->subserviceModel
            ->find($id);

        if (!$subservice) {

            return redirect()->back()
                ->with(
                    'error',
                    'Data tidak ditemukan'
                );
        }

        // IMAGE
        $imageName =
            $subservice['image'];

        $imageFile =
            $this->request->getFile('image');

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

        if (
            $imageFile &&
            $imageFile->isValid() &&
            !$imageFile->hasMoved()
        ) {

            $uploadPath =
                FCPATH .
                'image/subservice/';

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            // delete old image
            if (!empty($imageName)) {

                $oldImage =
                    $uploadPath .
                    $imageName;

                if (file_exists($oldImage)) {

                    unlink($oldImage);
                }
            }

            $imageName =
                $imageFile
                ->getRandomName();

            $imageFile->move(
                $uploadPath,
                $imageName
            );

            // update master image
            $this->subserviceModel
                ->update($id, [
                    'image' => $imageName,
                    'updated_at' =>
                    date('Y-m-d H:i:s')
                ]);
        }

        // language
        $language = model('LanguageModel')

            ->where(
                'LOWER(code)',
                $lang
            )

            ->first();

        // update translation
        $translation =
            $this->translationModel

            ->where(
                'sub_service_id',
                $id
            )

            ->where(
                'language_id',
                $language['id']
            )

            ->first();

        if ($translation) {

            $this->translationModel
                ->update(
                    $translation['id'],
                    [
                        'title' =>
                        $this->request->getPost(
                            'title'
                        ),

                        'description' =>
                        $this->request->getPost(
                            'description'
                        ),

                        'updated_at' =>
                        date('Y-m-d H:i:s')
                    ]
                );
        }

        return redirect()->to(
            '/subservice/' . $lang
        )->with(
            'success',
            'Berhasil diupdate'
        );
    }
}
