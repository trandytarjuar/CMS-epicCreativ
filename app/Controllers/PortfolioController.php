<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PortfolioModel;
use App\Models\PortfolioTranslationModel;
use App\Models\LanguageModel;
use App\Models\PortfolioCategoryTranslationModel;

class PortfolioController extends BaseController
{
    protected PortfolioModel $portfolioModel;

    protected PortfolioTranslationModel
        $translationModel;

    protected LanguageModel $languageModel;

    protected PortfolioCategoryTranslationModel $portfolioCategoryTranslationModel;

    public function __construct()
    {
        $this->portfolioModel =
            new PortfolioModel();

        $this->translationModel =
            new PortfolioTranslationModel();

        $this->languageModel =
            new LanguageModel();

        $this->portfolioCategoryTranslationModel =
            new PortfolioCategoryTranslationModel();
    }

    // public function index(string $lang = 'id')
    // {
    //     $lang = strtolower($lang);

    //     $data =
    //         $this->translationModel

    //         ->select('
    //         portfolios.id as portfolio_id,
    //         portfolios.thumbnail,
    //         portfolios.media_type,
    //         portfolios.video,
    //         portfolios.youtube_url,
    //         portfolios.client_name,
    //         portfolios.location,

    //         portfolio_translations.title,
    //         portfolio_translations.description
    //     ')

    //         ->join(
    //             'portfolios',
    //             'portfolios.id = portfolio_translations.portfolio_id'
    //         )

    //         ->join(
    //             'languages',
    //             'languages.id = portfolio_translations.language_id'
    //         )

    //         ->where(
    //             'languages.code',
    //             strtoupper($lang)
    //         )

    //         ->orderBy(
    //             'portfolios.sort',
    //             'ASC'
    //         )

    //         ->findAll();
    //     // var_dump($data); die;

    //     return view(
    //         'portfolio/index',
    //         [
    //             'data' => $data,
    //             'lang' => $lang
    //         ]
    //     );
    // }

    // public function index(string $lang = 'id')
    // {
    //     $lang = strtolower($lang);

    //     $data =
    //         $this->translationModel

    //         ->select('
    //         portfolios.id as portfolio_id,
    //         portfolios.thumbnail,
    //         portfolios.media_type,
    //         portfolios.video,
    //         portfolios.youtube_url,
    //         portfolios.client_name,
    //         portfolios.location,

    //         portfolio_translations.title,
    //         portfolio_translations.description
    //     ')

    //         ->join(
    //             'portfolios',
    //             'portfolios.id =
    //          portfolio_translations.portfolio_id'
    //         )

    //         ->join(
    //             'languages',
    //             'languages.id =
    //          portfolio_translations.language_id'
    //         )

    //         ->where(
    //             'languages.code',
    //             strtoupper($lang)
    //         )

    //         ->findAll();

    //     foreach ($data as &$row) {

    //         $enTranslation =
    //             $this->translationModel

    //             ->select(
    //                 'portfolio_translations.id'
    //             )

    //             ->join(
    //                 'languages',
    //                 'languages.id =
    //             portfolio_translations.language_id'
    //             )

    //             ->where(
    //                 'portfolio_id',
    //                 $row['portfolio_id']
    //             )

    //             ->where(
    //                 'languages.code',
    //                 'EN'
    //             )

    //             ->first();

    //         $row['has_en'] =
    //             !empty($enTranslation);
    //     }

    //     return view(
    //         'portfolio/index',
    //         [
    //             'data' => $data,
    //             'lang' => $lang
    //         ]
    //     );
    // }

    public function index(string $lang = 'id')
    {
        $lang = strtolower($lang);

        $data =
            $this->translationModel

            ->select('
            portfolios.id as portfolio_id,

            portfolios.portfolio_category_id,

            portfolios.thumbnail,
            portfolios.media_type,
            portfolios.video,
            portfolios.youtube_url,
            portfolios.client_name,
            portfolios.location,

            portfolio_translations.title,
            portfolio_translations.description,

            portfolio_category_translations.name
                as category_name
        ')

            ->join(
                'portfolios',
                'portfolios.id =
            portfolio_translations.portfolio_id'
            )

            ->join(
                'languages',
                'languages.id =
            portfolio_translations.language_id'
            )

            ->join(
                'portfolio_category_translations',
                '
            portfolio_category_translations.portfolio_category_id =
            portfolios.portfolio_category_id
            ',
                'left'
            )

            ->join(
                'languages category_lang',
                '
            category_lang.id =
            portfolio_category_translations.language_id
            ',
                'left'
            )

            ->where(
                'languages.code',
                strtoupper($lang)
            )

            ->where(
                'category_lang.code',
                strtoupper($lang)
            )

            ->findAll();

        foreach ($data as &$row) {

            $enTranslation =
                $this->translationModel

                ->select(
                    'portfolio_translations.id'
                )

                ->join(
                    'languages',
                    'languages.id =
                portfolio_translations.language_id'
                )

                ->where(
                    'portfolio_id',
                    $row['portfolio_id']
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
            'portfolio/index',
            [
                'data' => $data,
                'lang' => $lang
            ]
        );
    }


    // public function create(string $lang)
    // {
    //     $lang = strtolower($lang);

    //     if ($lang == 'id') {

    //         return view(
    //             'portfolio/create',
    //             [
    //                 'lang' => $lang,
    //                 'isTranslation' => false
    //             ]
    //         );
    //     }

    //     $language = model('LanguageModel')
    //         ->where('code', strtoupper($lang))
    //         ->first();

    //     $portfolio = $this->portfolioModel

    //         ->select('portfolios.*')

    //         ->join(
    //             'portfolio_translations',
    //             'portfolio_translations.portfolio_id = portfolios.id',
    //             'left'
    //         )

    //         ->whereNotIn(
    //             'portfolios.id',
    //             function ($builder) use ($language) {

    //                 return $builder
    //                     ->select('portfolio_id')
    //                     ->from('portfolio_translations')
    //                     ->where(
    //                         'language_id',
    //                         $language['id']
    //                     );
    //             }
    //         )

    //         ->first();

    //     return view(
    //         'portfolio/create',
    //         [
    //             'lang' => $lang,
    //             'portfolio' => $portfolio,
    //             'isTranslation' => true
    //         ]
    //     );
    // }

    public function create(string $lang = 'id')
    {
        $lang = strtolower($lang);

        $language =
            $this->languageModel

            ->where(
                'code',
                strtoupper($lang)
            )

            ->first();

        $categories =
            $this->portfolioCategoryTranslationModel

            ->select('
            portfolio_categories.id,
            portfolio_category_translations.name
        ')

            ->join(
                'portfolio_categories',
                '
            portfolio_categories.id =
            portfolio_category_translations.portfolio_category_id
            '
            )

            ->where(
                'portfolio_category_translations.language_id',
                $language['id']
            )

            ->where(
                'portfolio_categories.is_active',
                1
            )

            ->orderBy(
                'portfolio_category_translations.name',
                'ASC'
            )

            ->findAll();

        return view(
            'portfolio/create',
            [
                'lang' => $lang,
                'categories' => $categories,
                'isTranslation' => $lang !== 'id'
            ]
        );
    }

    // public function store()
    // {
    //     // var_dump("masuk"); die;
    //     $lang = strtolower(
    //         $this->request->getPost(
    //             'lang'
    //         )
    //     );

    //     $language =
    //         model('LanguageModel')

    //         ->where(
    //             'code',
    //             strtoupper($lang)
    //         )

    //         ->first();

    //     if (!$language) {

    //         return redirect()->back()
    //             ->with(
    //                 'error',
    //                 'Language tidak ditemukan'
    //             );
    //     }

    //     // THUMBNAIL
    //     $thumbnailName = null;

    //     $thumbnail =
    //         $this->request
    //         ->getFile('thumbnail');

    //     if (
    //         $thumbnail &&
    //         $thumbnail->isValid()
    //     ) {

    //         $uploadPath =
    //             FCPATH .
    //             'portfolio/thumbnail/';

    //         if (!is_dir($uploadPath)) {

    //             mkdir(
    //                 $uploadPath,
    //                 0777,
    //                 true
    //             );
    //         }

    //         $thumbnailName =
    //             $thumbnail
    //             ->getRandomName();

    //         $thumbnail->move(
    //             $uploadPath,
    //             $thumbnailName
    //         );
    //     }

    //     // VIDEO
    //     $videoName = null;

    //     $video =
    //         $this->request
    //         ->getFile('video_file');

    //     if (
    //         $video &&
    //         $video->isValid()
    //     ) {

    //         $uploadPath =
    //             FCPATH .
    //             'portfolio/video/';

    //         if (!is_dir($uploadPath)) {

    //             mkdir(
    //                 $uploadPath,
    //                 0777,
    //                 true
    //             );
    //         }

    //         $videoName =
    //             $video
    //             ->getRandomName();

    //         $video->move(
    //             $uploadPath,
    //             $videoName
    //         );
    //     }
    //     $lastPortfolio =
    //         $this->portfolioModel

    //         ->select('sort')

    //         ->orderBy('sort', 'DESC')

    //         ->first();

    //     $sort = 1;

    //     if ($lastPortfolio) {

    //         $sort =
    //             (int)$lastPortfolio['sort'] + 1;
    //     }

    //     // var_dump(

    //     //         $thumbnailName,


    //     //         $this->request->getVar(
    //     //             'media_type'
    //     //         ) ?? 'upload',


    //     //         $videoName,


    //     //         $this->request->getPost(
    //     //             'youtube_url'
    //     //         ),

    //     //          $sort,
    //     // ); die;

    //     // var_dump(
    //     //     $this->request->getPost(),
    //     //     $this->request->getPost('media_type'),
    //     //     $this->request->getVar('media_type')
    //     // ); die;

    //     // MASTER
    //     $this->portfolioModel->insert([

    //         'thumbnail' =>
    //         $thumbnailName,

    //         'media_type' =>
    //         $this->request->getPost(
    //             'media_type'
    //         ),

    //         'video' =>
    //         $videoName,

    //         'youtube_url' =>
    //         $this->request->getPost(
    //             'youtube_url'
    //         ),

    //         'client_name' =>
    //         $this->request->getPost(
    //             'client_name'
    //         ),

    //         'location' =>
    //         $this->request->getPost(
    //             'location'
    //         ),

    //         'sort' =>
    //         $sort,

    //         'created_at' =>
    //         date('Y-m-d H:i:s')
    //     ]);

    //     $portfolioId =
    //         $this->portfolioModel
    //         ->getInsertID();

    //     $this->translationModel->insert([

    //         'portfolio_id' =>
    //         $portfolioId,

    //         'language_id' =>
    //         $language['id'],

    //         'title' =>
    //         $this->request->getPost(
    //             'title'
    //         ),

    //         'description' =>
    //         $this->request->getPost(
    //             'description'
    //         ),

    //         'created_at' =>
    //         date('Y-m-d H:i:s')
    //     ]);

    //     return redirect()->to(
    //         '/portfolio/' . $lang
    //     )->with(
    //         'success',
    //         'Berhasil disimpan'
    //     );
    // }
    public function store()
    {
        $lang = strtolower(
            $this->request->getPost('lang')
        );

        $language = model('LanguageModel')
            ->where(
                'code',
                strtoupper($lang)
            )
            ->first();

        if (!$language) {

            return redirect()->back()
                ->with(
                    'error',
                    'Language tidak ditemukan'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | TRANSLATION MODE
    |--------------------------------------------------------------------------
    | Jika portfolio_id ada berarti hanya tambah bahasa
    |
    */

        $portfolioId =
            $this->request->getPost(
                'portfolio_id'
            );

        if ($portfolioId) {

            $translationExists =
                $this->translationModel

                ->where(
                    'portfolio_id',
                    $portfolioId
                )

                ->where(
                    'language_id',
                    $language['id']
                )

                ->first();

            if ($translationExists) {

                return redirect()->back()
                    ->with(
                        'error',
                        'Translation sudah ada'
                    );
            }

            $this->translationModel
                ->insert([

                    'portfolio_id' =>
                    $portfolioId,

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
                '/portfolio/' . $lang
            )->with(
                'success',
                'Translation berhasil ditambahkan'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | MASTER PORTFOLIO MODE
    |--------------------------------------------------------------------------
    */

        $thumbnailName = null;

        $thumbnail =
            $this->request
            ->getFile('thumbnail');

        if (
            $thumbnail &&
            $thumbnail->isValid() &&
            !$thumbnail->hasMoved()
        ) {

            $uploadPath =
                FCPATH .
                'portfolio/thumbnail/';

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            $thumbnailName =
                $thumbnail
                ->getRandomName();

            $thumbnail->move(
                $uploadPath,
                $thumbnailName
            );
        }

        /*
    |--------------------------------------------------------------------------
    | VIDEO
    |--------------------------------------------------------------------------
    */

        $videoName = null;

        $video =
            $this->request
            ->getFile('video_file');

        if (
            $video &&
            $video->isValid() &&
            !$video->hasMoved()
        ) {

            $uploadPath =
                FCPATH .
                'portfolio/video/';

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            $videoName =
                $video
                ->getRandomName();

            $video->move(
                $uploadPath,
                $videoName
            );
        }

        /*
    |--------------------------------------------------------------------------
    | SORT AUTO INCREMENT
    |--------------------------------------------------------------------------
    */

        $lastPortfolio =
            $this->portfolioModel

            ->orderBy(
                'sort',
                'DESC'
            )

            ->first();

        $sort = 1;

        if ($lastPortfolio) {

            $sort =
                (int)$lastPortfolio['sort'] + 1;
        }

        /*
    |--------------------------------------------------------------------------
    | INSERT MASTER
    |--------------------------------------------------------------------------
    */
        $category_id = $this->request->getPost(
            'portfolio_category_id'
        );
        // var_dump( $category_id); die;

        $this->portfolioModel
            ->insert([

                'thumbnail' =>
                $thumbnailName,

                'portfolio_category_id' =>
                $category_id,

                'media_type' =>
                $this->request->getPost(
                    'media_type'
                ) ?: 'youtube',

                'video' =>
                $videoName,

                'youtube_url' =>
                $this->request->getPost(
                    'youtube_url'
                ),

                'client_name' =>
                $this->request->getPost(
                    'client_name'
                ),

                'location' =>
                $this->request->getPost(
                    'location'
                ),

                'sort' =>
                $sort,

                'created_at' =>
                date('Y-m-d H:i:s')
            ]);

        $portfolioId =
            $this->portfolioModel
            ->getInsertID();

        /*
    |--------------------------------------------------------------------------
    | INSERT TRANSLATION
    |--------------------------------------------------------------------------
    */

        $this->translationModel
            ->insert([

                'portfolio_id' =>
                $portfolioId,

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
            '/portfolio/' . $lang
        )->with(
            'success',
            'Portfolio berhasil disimpan'
        );
    }

    public function delete(
        int $portfolioId,
        string $lang
    ) {
        $lang = strtolower($lang);

        $language =
            model('LanguageModel')

            ->where(
                'code',
                strtoupper($lang)
            )

            ->first();

        if (!$language) {

            return $this->response
                ->setJSON([
                    'status' => 'error',
                    'message' =>
                    'Language tidak ditemukan'
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | DELETE TRANSLATION ONLY
    |--------------------------------------------------------------------------
    */

        if ($lang != 'id') {

            $translation =
                $this->translationModel

                ->where(
                    'portfolio_id',
                    $portfolioId
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
                        'message' =>
                        'Translation tidak ditemukan'
                    ]);
            }

            $this->translationModel
                ->delete(
                    $translation['id']
                );

            return $this->response
                ->setJSON([
                    'status' => 'success',
                    'message' =>
                    'Translation berhasil dihapus'
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | DELETE MASTER (ID)
    |--------------------------------------------------------------------------
    */

        $portfolio =
            $this->portfolioModel
            ->find($portfolioId);

        if (!$portfolio) {

            return $this->response
                ->setJSON([
                    'status' => 'error',
                    'message' =>
                    'Portfolio tidak ditemukan'
                ]);
        }

        // thumbnail

        if (
            !empty($portfolio['thumbnail'])
        ) {

            $thumbnail =
                FCPATH .
                'portfolio/thumbnail/' .
                $portfolio['thumbnail'];

            if (file_exists($thumbnail)) {

                unlink($thumbnail);
            }
        }

        // video

        if (
            !empty($portfolio['video'])
        ) {

            $video =
                FCPATH .
                'portfolio/video/' .
                $portfolio['video'];

            if (file_exists($video)) {

                unlink($video);
            }
        }

        $this->portfolioModel
            ->delete($portfolioId);

        return $this->response
            ->setJSON([
                'status' => 'success',
                'message' =>
                'Portfolio berhasil dihapus'
            ]);
    }
    public function translation(
        int $portfolioId,
        string $lang = 'en'
    ) {
        $portfolio =
            $this->portfolioModel
            ->find($portfolioId);

        if (!$portfolio) {

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

            return redirect()->back();
        }

        $translation =
            $this->translationModel

            ->where(
                'portfolio_id',
                $portfolioId
            )

            ->where(
                'language_id',
                $language['id']
            )

            ->first();

        if ($translation) {

            return redirect()
                ->to(
                    '/portfolio/edit/' .
                        $portfolioId .
                        '/' .
                        $lang
                );
        }
        $categories =
            $this->portfolioCategoryTranslationModel

            ->select('
            portfolio_categories.id,
            portfolio_category_translations.name
        ')

            ->join(
                'portfolio_categories',
                '
            portfolio_categories.id =
            portfolio_category_translations.portfolio_category_id
            '
            )

            ->where(
                'portfolio_category_translations.language_id',
                $language['id']
            )

            ->where(
                'portfolio_categories.id',
                $portfolio['portfolio_category_id']
            )



            ->findAll();

        return view(
            'portfolio/create',
            [
                'portfolio'      => $portfolio,
                'lang'           => $lang,
                'categories'     => $categories,
                'isTranslation'  => true
            ]
        );
    }

    // public function addTranslation(
    //     int $portfolioId
    // ) {
    //     $lang = strtolower(
    //         $this->request->getPost(
    //             'lang'
    //         )
    //     );

    //     $language =
    //         $this->languageModel

    //         ->where(
    //             'code',
    //             strtoupper($lang)
    //         )

    //         ->first();

    //     if (!$language) {

    //         return redirect()->back()
    //             ->with(
    //                 'error',
    //                 'Language tidak ditemukan'
    //             );
    //     }

    //     $exists =
    //         $this->translationModel

    //         ->where(
    //             'portfolio_id',
    //             $portfolioId
    //         )

    //         ->where(
    //             'language_id',
    //             $language['id']
    //         )

    //         ->first();

    //     if ($exists) {

    //         return redirect()->back()
    //             ->with(
    //                 'error',
    //                 'Translation sudah ada'
    //             );
    //     }

    //     $this->translationModel
    //         ->insert([

    //             'portfolio_id' =>
    //             $portfolioId,

    //             'language_id' =>
    //             $language['id'],

    //             'title' =>
    //             $this->request->getPost(
    //                 'title'
    //             ),

    //             'description' =>
    //             $this->request->getPost(
    //                 'description'
    //             ),

    //             'created_at' =>
    //             date('Y-m-d H:i:s')
    //         ]);

    //     return redirect()
    //         ->to('/portfolio/en')
    //         ->with(
    //             'success',
    //             'Translation berhasil disimpan'
    //         );
    // }

    // public function edit(
    //     int $portfolioId,
    //     string $lang
    // ) {
    //     $lang = strtolower($lang);

    //     $language =
    //         $this->languageModel

    //         ->where(
    //             'code',
    //             strtoupper($lang)
    //         )

    //         ->first();

    //     if (!$language) {

    //         return redirect()
    //             ->back()
    //             ->with(
    //                 'error',
    //                 'Language tidak ditemukan'
    //             );
    //     }

    //     $portfolio =
    //         $this->portfolioModel
    //         ->find($portfolioId);

    //     if (!$portfolio) {

    //         return redirect()
    //             ->back()
    //             ->with(
    //                 'error',
    //                 'Portfolio tidak ditemukan'
    //             );
    //     }

    //     $translation =
    //         $this->translationModel

    //         ->where(
    //             'portfolio_id',
    //             $portfolioId
    //         )

    //         ->where(
    //             'language_id',
    //             $language['id']
    //         )

    //         ->first();

    //     if (!$translation) {

    //         return redirect()
    //             ->back()
    //             ->with(
    //                 'error',
    //                 'Translation tidak ditemukan'
    //             );
    //     }

    //     return view(
    //         'portfolio/edit',
    //         [

    //             'portfolio' =>
    //             $portfolio,

    //             'translation' =>
    //             $translation,

    //             'lang' =>
    //             $lang,

    //             'isMaster' =>
    //             $lang === 'id'
    //         ]
    //     );
    // }

    public function edit(
        int $portfolioId,
        string $lang = 'id'
    ) {
        $language =
            $this->languageModel

            ->where(
                'code',
                strtoupper($lang)
            )

            ->first();

        $portfolio =
            $this->portfolioModel
            ->find($portfolioId);

        $translation =
            $this->translationModel

            ->where(
                'portfolio_id',
                $portfolioId
            )

            ->where(
                'language_id',
                $language['id']
            )

            ->first();

        $categories =
            $this->portfolioCategoryTranslationModel

            ->select('
            portfolio_categories.id,
            portfolio_category_translations.name
        ')

            ->join(
                'portfolio_categories',
                '
            portfolio_categories.id =
            portfolio_category_translations.portfolio_category_id
            '
            )

            ->where(
                'language_id',
                $language['id']
            )

            ->findAll();

        return view(
            'portfolio/edit',
            [
                'lang' => $lang,
                'portfolio' => $portfolio,
                'translation' => $translation,
                'categories' => $categories
            ]
        );
    }

    public function update(
        int $portfolioId,
        string $lang
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

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Language tidak ditemukan'
                );
        }

        $portfolio =
            $this->portfolioModel
            ->find($portfolioId);

        if (!$portfolio) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Portfolio tidak ditemukan'
                );
        }

        $translation =
            $this->translationModel

            ->where(
                'portfolio_id',
                $portfolioId
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

        /*
    |--------------------------------------------------------------------------
    | MASTER DATA (ID ONLY)
    |--------------------------------------------------------------------------
    */

        if ($lang == 'id') {

            $thumbnailName =
                $portfolio['thumbnail'];

            $thumbnail =
                $this->request
                ->getFile(
                    'thumbnail'
                );

            if (
                $thumbnail &&
                $thumbnail->isValid() &&
                !$thumbnail->hasMoved()
            ) {

                $uploadPath =
                    FCPATH .
                    'portfolio/thumbnail/';

                if (!is_dir($uploadPath)) {

                    mkdir(
                        $uploadPath,
                        0777,
                        true
                    );
                }

                if (
                    !empty($thumbnailName)
                ) {

                    $oldImage =
                        $uploadPath .
                        $thumbnailName;

                    if (
                        file_exists(
                            $oldImage
                        )
                    ) {

                        unlink(
                            $oldImage
                        );
                    }
                }

                $thumbnailName =
                    $thumbnail
                    ->getRandomName();

                $thumbnail->move(
                    $uploadPath,
                    $thumbnailName
                );
            }

            $videoName =
                $portfolio['video'];

            $video =
                $this->request
                ->getFile(
                    'video_file'
                );

            if (
                $video &&
                $video->isValid() &&
                !$video->hasMoved()
            ) {

                $uploadPath =
                    FCPATH .
                    'portfolio/video/';

                if (!is_dir($uploadPath)) {

                    mkdir(
                        $uploadPath,
                        0777,
                        true
                    );
                }

                if (
                    !empty($videoName)
                ) {

                    $oldVideo =
                        $uploadPath .
                        $videoName;

                    if (
                        file_exists(
                            $oldVideo
                        )
                    ) {

                        unlink(
                            $oldVideo
                        );
                    }
                }

                $videoName =
                    $video
                    ->getRandomName();

                $video->move(
                    $uploadPath,
                    $videoName
                );
            }

            $this->portfolioModel
                ->update(
                    $portfolioId,
                    [

                        'thumbnail' =>
                        $thumbnailName,

                        'portfolio_category_id' => $this->request->getPost(
                            'portfolio_category_id'
                        ),

                        'media_type' =>
                        $this->request
                            ->getPost(
                                'media_type'
                            ),

                        'video' =>
                        $videoName,

                        // 'youtube_url' =>
                        // $this->request
                        //     ->getPost(
                        //         'youtube_url'
                        //     ),
                        'youtube_url' =>
                        $this->request->getPost('youtube_url')
                            ?: $portfolio['youtube_url'],

                        // 'client_name' =>
                        // $this->request
                        //     ->getPost(
                        //         'client_name'
                        //     ),
                        'client_name' =>
                        $this->request->getPost('client_name')
                            ?: $portfolio['client_name'],

                        'location' =>
                        $this->request->getPost('location')
                            ?: $portfolio['location'],

                        'updated_at' =>
                        date(
                            'Y-m-d H:i:s'
                        )
                    ]
                );
        }

        /*
    |--------------------------------------------------------------------------
    | TRANSLATION
    |--------------------------------------------------------------------------
    */

        $this->translationModel
            ->update(
                $translation['id'],
                [

                    'title' =>
                    $this->request
                        ->getPost(
                            'title'
                        ),

                    'description' =>
                    $this->request
                        ->getPost(
                            'description'
                        ),

                    'updated_at' =>
                    date(
                        'Y-m-d H:i:s'
                    )
                ]
            );

        return redirect()
            ->to(
                '/portfolio/' .
                    $lang
            )
            ->with(
                'success',
                'Portfolio berhasil diupdate'
            );
    }
}
