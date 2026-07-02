<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LanguageModel;
use App\Models\PortfolioCategoryModel;
use App\Models\PortfolioCategoryTranslationModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PortfolioCategoryController extends BaseController
{
    protected PortfolioCategoryModel $categoryModel;

    protected PortfolioCategoryTranslationModel $translationModel;

    protected LanguageModel $languageModel;

    public function __construct()
    {
        $this->categoryModel =
            new PortfolioCategoryModel();

        $this->translationModel =
            new PortfolioCategoryTranslationModel();

        $this->languageModel =
            new LanguageModel();
    }

    public function index(
        string $lang = 'id'
    ) {
        $data =
            $this->translationModel

            ->select('
            portfolio_categories.id as category_id,
            portfolio_categories.is_active,

            portfolio_category_translations.id as translation_id,
            portfolio_category_translations.name
        ')

            ->join(
                'portfolio_categories',
                'portfolio_categories.id =
            portfolio_category_translations.portfolio_category_id'
            )

            ->join(
                'languages',
                'languages.id =
            portfolio_category_translations.language_id'
            )

            ->where(
                'languages.code',
                strtoupper($lang)
            )

            ->orderBy(
                'portfolio_category_translations.name',
                'ASC'
            )

            ->findAll();

        foreach ($data as &$row) {

            $translation =
                $this->translationModel

                ->select(
                    'portfolio_category_translations.id'
                )

                ->join(
                    'languages',
                    'languages.id =
                portfolio_category_translations.language_id'
                )

                ->where(
                    'portfolio_category_id',
                    $row['category_id']
                )

                ->where(
                    'languages.code',
                    'EN'
                )

                ->first();

            $row['translation_exists'] =
                !empty($translation);
        }

        return view(
            'portfolio_category/index',
            [
                'data' => $data,
                'lang' => $lang
            ]
        );
    }

    public function create(
        string $lang = 'id'
    ) {
        return view(
            'portfolio_category/create',
            [
                'lang' => $lang
            ]
        );
    }
    public function translation(
        int $categoryId,
        string $lang = 'en'
    ) {
        $category =
            $this->categoryModel
            ->find($categoryId);

        if (!$category) {

            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'portfolio_category/create',
            [
                'lang' => $lang,
                'category' => $category,
                'isTranslation' => true
            ]
        );
    }

    public function store()
    {
        $lang =
            strtolower(
                $this->request->getPost('lang')
            );

        $language =
            $this->languageModel

            ->where(
                'code',
                strtoupper($lang)
            )

            ->first();

        if ($lang == 'id') {

            $categoryId =
                $this->categoryModel
                ->insert([

                    'is_active' =>
                    $this->request
                        ->getPost(
                            'is_active'
                        ),

                    'created_at' =>
                    date(
                        'Y-m-d H:i:s'
                    )
                ]);
        } else {

            $categoryId =
                $this->request
                ->getPost(
                    'portfolio_category_id'
                );
        }

        $this->translationModel
            ->insert([

                'portfolio_category_id' =>
                $categoryId,

                'language_id' =>
                $language['id'],

                'name' =>
                $this->request
                    ->getPost(
                        'name'
                    ),

                'created_at' =>
                date(
                    'Y-m-d H:i:s'
                )
            ]);

        return redirect()
            ->to(
                '/portfolio-category/' .
                    $lang
            );
    }

    public function delete(int $translationId)
    {
        $translation =
            $this->translationModel
            ->find($translationId);

        if (!$translation) {

            return $this->response
                ->setJSON([

                    'status' => 'error',

                    'message' =>
                    'Data tidak ditemukan'
                ]);
        }

        $categoryId =
            $translation['portfolio_category_id'];

        $this->translationModel
            ->delete($translationId);

        $remainingTranslation =
            $this->translationModel

            ->where(
                'portfolio_category_id',
                $categoryId
            )

            ->countAllResults();

        if (
            $remainingTranslation == 0
        ) {

            $this->categoryModel
                ->delete($categoryId);
        }

        return $this->response
            ->setJSON([

                'status' => 'success',

                'message' =>
                'Data berhasil dihapus'
            ]);
    }

    public function edit(
        int $categoryId,
        string $lang = 'id'
    ) {
        $language =
            $this->languageModel

            ->where(
                'code',
                strtoupper($lang)
            )

            ->first();

        $category =
            $this->categoryModel
            ->find($categoryId);

        if (!$category) {

            throw PageNotFoundException::forPageNotFound();
        }

        $translation =
            $this->translationModel

            ->where(
                'portfolio_category_id',
                $categoryId
            )

            ->where(
                'language_id',
                $language['id']
            )

            ->first();

        return view(
            'portfolio_category/edit',
            [
                'lang' => $lang,
                'category' => $category,
                'translation' => $translation
            ]
        );
    }

    public function update(
        int $categoryId,
        string $lang
    ) {
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
                'portfolio_category_id',
                $categoryId
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

        if ($lang == 'id') {

            $this->categoryModel
                ->update(
                    $categoryId,
                    [
                        'is_active' =>
                        $this->request
                            ->getPost(
                                'is_active'
                            ),

                        'updated_at' =>
                        date(
                            'Y-m-d H:i:s'
                        )
                    ]
                );
        }

        $this->translationModel
            ->update(
                $translation['id'],
                [
                    'name' =>
                    $this->request
                        ->getPost(
                            'name'
                        ),

                    'updated_at' =>
                    date(
                        'Y-m-d H:i:s'
                    )
                ]
            );

        return redirect()
            ->to(
                '/portfolio-category/' .
                    $lang
            )
            ->with(
                'success',
                'Data berhasil diupdate'
            );
    }
}
