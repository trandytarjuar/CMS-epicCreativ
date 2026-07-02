<?php

namespace App\Controllers;

use App\Models\BannerModel;

class BannerController extends BaseController
{
    protected BannerModel $bannerModel;

    public function __construct()
    {
        $this->bannerModel =
            new BannerModel();
    }

    public function index()
    {
        $bannerModel = new BannerModel();

        $data = $bannerModel
            ->orderBy(
                'id',
                'ASC'
            )
            ->findAll();

        // var_dump($data); die;

        return view(
            'banner',
            [
                'data' => $data
            ]
        );
    }

    // public function store()
    // {

    //     $image =
    //         $this->request
    //         ->getFile('image');
    //     // dd(
    //     //     $image->isValid(),
    //     //     $image->getName(),
    //     //     $image->getError(),
    //     //     $image->getErrorString()
    //     // );die;


    //     $imageName = null;

    //     if (
    //         $image &&
    //         $image->isValid()
    //     ) {

    //         $path =
    //             FCPATH .
    //             'public/image/banner/';

    //         if (!is_dir($path)) {

    //             mkdir(
    //                 $path,
    //                 0777,
    //                 true
    //             );
    //         }

    //         $imageName =
    //             $image
    //             ->getRandomName();

    //         $image->move(
    //             $path,
    //             $imageName
    //         );
    //     }

    //     $this->bannerModel
    //         ->insert([

    //             'image' =>
    //             $imageName,

    //             'title' =>
    //             $this->request->getPost(
    //                 'title'
    //             ),

    //             'subtitle' =>
    //             $this->request->getPost(
    //                 'subtitle'
    //             ),

    //             'position' =>
    //             $this->request->getPost(
    //                 'position'
    //             ),

    //             'is_active' =>
    //             $this->request->getPost(
    //                 'is_active'
    //             ),

    //             'sort_order' =>
    //             $this->request->getPost(
    //                 'sort_order'
    //             ),

    //             'created_at' =>
    //             date('Y-m-d H:i:s')
    //         ]);

    //     // var_dump($tes); die;

    //     return $this->response
    //         ->setJSON([
    //             'status' => 'success'
    //         ]);
    // }
    public function store()
    {
        $image =
            $this->request
            ->getFile('image');

        if (
            $image &&
            $image->getError() ===
            UPLOAD_ERR_INI_SIZE
        ) {

            return $this->response
                ->setJSON([

                    'status' => 'error',

                    'message' =>
                    'Ukuran file melebihi batas upload server.'
                ]);
        }

        $validation =
            \Config\Services::validation();

        $validation->setRules([

            'image' => [

                'label' => 'Image',

                'rules' =>
                'uploaded[image]'
                    . '|is_image[image]'
                    . '|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]'
                    . '|max_size[image,2048]'
            ]
        ]);

        if (
            !$validation
                ->withRequest(
                    $this->request
                )
                ->run()
        ) {

            return $this->response
                ->setJSON([

                    'status' => 'error',

                    'message' =>
                    $validation
                        ->getError('image')
                ]);
        }

        $imageName = null;

        if (
            $image &&
            $image->isValid() &&
            !$image->hasMoved()
        ) {

            $path =
                FCPATH .
                'image/banner/';

            if (!is_dir($path)) {

                mkdir(
                    $path,
                    0777,
                    true
                );
            }

            $imageName =
                $image->getRandomName();

            $image->move(
                $path,
                $imageName
            );
        }

        $this->bannerModel
            ->insert([

                'image' => $imageName,

                'title' =>
                $this->request->getPost(
                    'title'
                ),

                'subtitle' =>
                $this->request->getPost(
                    'subtitle'
                ),

                'position' =>
                $this->request->getPost(
                    'position'
                ),

                'is_active' =>
                $this->request->getPost(
                    'is_active'
                ),

                'sort_order' =>
                $this->request->getPost(
                    'sort_order'
                ),

                'created_at' =>
                date('Y-m-d H:i:s')
            ]);

        return $this->response
            ->setJSON([
                'status' => 'success'
            ]);
    }

    public function show(int $id)
    {
        return $this->response
            ->setJSON(
                $this->bannerModel
                    ->find($id)
            );
    }

    public function update(int $id)
    {
        $banner =
            $this->bannerModel
            ->find($id);

        $imageName =
            $banner['image'];

        $image =
            $this->request
            ->getFile('image');

        if (
            $image &&
            $image->isValid()
        ) {

            $path =
                FCPATH .
                'image/banner/';

            if (
                !empty($banner['image'])
            ) {

                $old =
                    $path .
                    $banner['image'];

                if (
                    file_exists(
                        $old
                    )
                ) {

                    unlink(
                        $old
                    );
                }
            }

            $imageName =
                $image
                ->getRandomName();

            $image->move(
                $path,
                $imageName
            );
        }

        $this->bannerModel
            ->update(
                $id,
                [

                    'image' =>
                    $imageName,

                    'title' =>
                    $this->request->getPost(
                        'title'
                    ),

                    'subtitle' =>
                    $this->request->getPost(
                        'subtitle'
                    ),

                    'position' =>
                    $this->request->getPost(
                        'position'
                    ),

                    'is_active' =>
                    $this->request->getPost(
                        'is_active'
                    ),

                    'sort_order' =>
                    $this->request->getPost(
                        'sort_order'
                    ),

                    'updated_at' =>
                    date(
                        'Y-m-d H:i:s'
                    )
                ]
            );

        return $this->response
            ->setJSON([
                'status' => 'success'
            ]);
    }

    public function delete(int $id)
    {
        $banner =
            $this->bannerModel
            ->find($id);

        if (!$banner) {

            return $this->response
                ->setJSON([
                    'status' => 'error'
                ]);
        }

        if (
            !empty($banner['image'])
        ) {

            $file =
                FCPATH .
                'image/banner/' .
                $banner['image'];

            if (
                file_exists(
                    $file
                )
            ) {

                unlink(
                    $file
                );
            }
        }

        $this->bannerModel
            ->delete($id);

        return $this->response
            ->setJSON([
                'status' => 'success'
            ]);
    }
}
