<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\AboutSectionModel;
use App\Models\AboutSectionTranslationModel;
use App\Models\LanguageModel;

class AboutController extends BaseController
{
    protected AboutSectionModel $aboutModel;

    protected AboutSectionTranslationModel $translationModel;

    protected LanguageModel $languageModel;

    public function __construct()
    {
        $this->aboutModel = new AboutSectionModel();
        $this->translationModel = new AboutSectionTranslationModel();
        $this->languageModel = new LanguageModel();
    }

    public function index(string $lang = 'id')
    {
        $lang =
            strtolower($lang);

        $aboutSections =
            $this->translationModel

            ->select('
            about_sections.id as about_id,
            about_sections.slug,
            about_sections.image,
            about_sections.sort,
            about_sections.is_active,

            about_section_translations.id as translation_id,
            about_section_translations.title,
            about_section_translations.content
        ')

            ->join(
                'about_sections',
                'about_sections.id =
             about_section_translations.about_section_id'
            )

            ->join(
                'languages',
                'languages.id =
             about_section_translations.language_id'
            )

            ->where(
                'languages.code',
                strtoupper($lang)
            )

            ->where(
                'about_sections.is_active',
                1
            )

            ->orderBy(
                'about_sections.sort',
                'ASC'
            )

            ->findAll();

        foreach ($aboutSections as &$row) {

            $enTranslation =
                $this->translationModel

                ->select(
                    'about_section_translations.id'
                )

                ->join(
                    'languages',
                    'languages.id =
                 about_section_translations.language_id'
                )

                ->where(
                    'about_section_id',
                    $row['about_id']
                )

                ->where(
                    'languages.code',
                    'EN'
                )

                ->first();

            $row['has_en'] =
                !empty($enTranslation);
        }

        return view(
            'about/index',
            [
                'data' => $aboutSections,
                'lang' => $lang
            ]
        );
    }

    public function create(string $lang = 'id')
    {
        return view(
            'about/create',
            [
                'lang' => strtolower($lang),
                'isTranslation' => false
            ]
        );
    }

    public function translation(
        int $aboutId,
        string $lang = 'en'
    ) {
        $about =
            $this->aboutModel
            ->find($aboutId);

        if (!$about) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $language =
            $this->languageModel

            ->where(
                'code',
                strtoupper($lang)
            )

            ->first();

        $translation =
            $this->translationModel

            ->where(
                'about_section_id',
                $aboutId
            )

            ->where(
                'language_id',
                $language['id']
            )

            ->first();

        if ($translation) {

            return redirect()->to(
                '/about/edit/' .
                    $aboutId .
                    '/' .
                    $lang
            );
        }

        return view(
            'about/create',
            [
                'lang' => $lang,
                'about' => $about,
                'isTranslation' => true
            ]
        );
    }

    public function store()
    {
        $lang = strtolower(
            $this->request->getPost('lang')
        );

        $language =
            $this->languageModel

            ->where(
                'code',
                strtoupper($lang)
            )

            ->first();

        if (!$language) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Language tidak ditemukan'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | TRANSLATION MODE
    |--------------------------------------------------------------------------
    */

        $aboutSectionId =
            $this->request
            ->getPost(
                'about_section_id'
            );

        if ($aboutSectionId) {

            $this->translationModel
                ->insert([

                    'about_section_id' =>
                    $aboutSectionId,

                    'language_id' =>
                    $language['id'],

                    'title' =>
                    $this->request->getPost(
                        'title'
                    ),

                    'content' =>
                    $this->request->getPost(
                        'content'
                    ),

                    'created_at' =>
                    date('Y-m-d H:i:s')
                ]);

            return redirect()
                ->to('/about/' . $lang)
                ->with(
                    'success',
                    'Translation berhasil ditambahkan'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | IMAGE
    |--------------------------------------------------------------------------
    */

        $imageName = null;

        $image =
            $this->request
            ->getFile('image');

        if (
            $image &&
            $image->isValid() &&
            !$image->hasMoved()
        ) {

            $uploadPath =
                FCPATH .
                'image/about/';

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            $imageName =
                $image
                ->getRandomName();

            $image->move(
                $uploadPath,
                $imageName
            );
        }

        /*
    |--------------------------------------------------------------------------
    | AUTO SORT
    |--------------------------------------------------------------------------
    */

        $lastAbout =
            $this->aboutModel

            ->select('sort')

            ->orderBy(
                'sort',
                'DESC'
            )

            ->first();

        $sort = 1;

        if ($lastAbout) {

            $sort =
                (int)$lastAbout['sort'] + 1;
        }

        /*
    |--------------------------------------------------------------------------
    | INSERT MASTER
    |--------------------------------------------------------------------------
    */
        $title = $this->request->getPost('title');
        $slug =
            url_title(
                $title,
                '-',
                true
            );

        $this->aboutModel
            ->insert([

                'slug' =>
                $slug,

                'image' =>
                $imageName,

                'sort' =>
                $sort,

                'is_active' =>
                $this->request->getPost(
                    'is_active'
                ) ?? 1,

                'created_at' =>
                date('Y-m-d H:i:s')
            ]);

        $aboutSectionId =
            $this->aboutModel
            ->getInsertID();

        /*
    |--------------------------------------------------------------------------
    | INSERT TRANSLATION
    |--------------------------------------------------------------------------
    */

        $this->translationModel
            ->insert([

                'about_section_id' =>
                $aboutSectionId,

                'language_id' =>
                $language['id'],

                'title' =>
                $title,

                'content' =>
                $this->request->getPost(
                    'content'
                ),

                'created_at' =>
                date('Y-m-d H:i:s')
            ]);

        return redirect()
            ->to('/about/' . $lang)
            ->with(
                'success',
                'Data berhasil disimpan'
            );
    }

    public function delete(
        int $aboutId,
        string $lang = 'id'
    ) {
        $lang =
            strtolower($lang);

        /*
    |--------------------------------------------------------------------------
    | DELETE MASTER (ID)
    |--------------------------------------------------------------------------
    */

        if ($lang === 'id') {

            $about =
                $this->aboutModel
                ->find($aboutId);

            if (!$about) {

                return $this->response
                    ->setJSON([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan'
                    ]);
            }

            // hapus image
            if (
                !empty($about['image'])
            ) {

                $imagePath =
                    FCPATH .
                    'image/about/' .
                    $about['image'];

                if (
                    file_exists(
                        $imagePath
                    )
                ) {

                    unlink(
                        $imagePath
                    );
                }
            }

            $this->aboutModel
                ->delete($aboutId);

            return $this->response
                ->setJSON([
                    'status' => 'success',
                    'message' => 'Data berhasil dihapus'
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | DELETE TRANSLATION
    |--------------------------------------------------------------------------
    */

        $language =
            $this->languageModel

            ->where(
                'code',
                strtoupper($lang)
            )

            ->first();

        if (!$language) {

            return $this->response
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Language tidak ditemukan'
                ]);
        }

        $translation =
            $this->translationModel

            ->where(
                'about_section_id',
                $aboutId
            )

            ->where(
                'language_id',
                $language['id']
            )

            ->first();

        if (!$translation) {

            return $this->response
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Translation tidak ditemukan'
                ]);
        }

        $this->translationModel
            ->delete(
                $translation['id']
            );

        return $this->response
            ->setJSON([
                'status' => 'success',
                'message' => 'Translation berhasil dihapus'
            ]);
    }

    public function edit(
        int $aboutId,
        string $lang = 'id'
    ) {
        $lang =
            strtolower($lang);

        $about =
            $this->aboutModel
            ->find($aboutId);

        if (!$about) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $language =
            $this->languageModel

            ->where(
                'code',
                strtoupper($lang)
            )

            ->first();

        if (!$language) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Language tidak ditemukan'
                );
        }

        $translation =
            $this->translationModel

            ->where(
                'about_section_id',
                $aboutId
            )

            ->where(
                'language_id',
                $language['id']
            )

            ->first();

        if (!$translation) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Translation tidak ditemukan'
                );
        }

        return view(
            'about/edit',
            [
                'lang' => $lang,
                'about' => $about,
                'translation' => $translation
            ]
        );
    }
    public function update(
        int $aboutId,
        string $lang = 'id'
    ) {
        $lang =
            strtolower($lang);

        $language =
            $this->languageModel

            ->where(
                'code',
                strtoupper($lang)
            )

            ->first();

        if (!$language) {

            return redirect()->back();
        }

        $about =
            $this->aboutModel
            ->find($aboutId);

        if (!$about) {

            return redirect()->back();
        }

        /*
    |--------------------------------------------------------------------------
    | UPDATE MASTER (ID)
    |--------------------------------------------------------------------------
    */

        if ($lang === 'id') {

            $imageName =
                $about['image'];

            $image =
                $this->request
                ->getFile('image');

            if (
                $image &&
                $image->isValid() &&
                !$image->hasMoved()
            ) {

                $uploadPath =
                    FCPATH .
                    'image/about/';

                if (!is_dir($uploadPath)) {

                    mkdir(
                        $uploadPath,
                        0777,
                        true
                    );
                }

                if (
                    !empty($about['image'])
                ) {

                    $oldFile =
                        $uploadPath .
                        $about['image'];

                    if (
                        file_exists(
                            $oldFile
                        )
                    ) {

                        unlink(
                            $oldFile
                        );
                    }
                }

                $imageName =
                    $image
                    ->getRandomName();

                $image->move(
                    $uploadPath,
                    $imageName
                );
            }

            helper('url');

            $slug =
                url_title(
                    $this->request->getPost(
                        'title'
                    ),
                    '-',
                    true
                );

            $this->aboutModel
                ->update(
                    $aboutId,
                    [

                        'slug' =>
                        $slug,

                        'image' =>
                        $imageName,

                        'sort' =>
                        $this->request->getPost(
                            'sort'
                        ),

                        'is_active' =>
                        $this->request->getPost(
                            'is_active'
                        ),

                        'updated_at' =>
                        date('Y-m-d H:i:s')
                    ]
                );
        }

        /*
    |--------------------------------------------------------------------------
    | UPDATE TRANSLATION
    |--------------------------------------------------------------------------
    */

        $translation =
            $this->translationModel

            ->where(
                'about_section_id',
                $aboutId
            )

            ->where(
                'language_id',
                $language['id']
            )

            ->first();

        $this->translationModel
            ->update(
                $translation['id'],
                [

                    'title' =>
                    $this->request->getPost(
                        'title'
                    ),

                    'content' =>
                    $this->request->getPost(
                        'content'
                    ),

                    'updated_at' =>
                    date('Y-m-d H:i:s')
                ]
            );

        return redirect()
            ->to(
                '/about/' . $lang
            )
            ->with(
                'success',
                'Data berhasil diperbarui'
            );
    }
}
