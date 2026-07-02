<?php

namespace App\Controllers;

use App\Models\PortfolioBehindSceneModel;

class PortfolioBehindSceneController extends BaseController
{
    protected PortfolioBehindSceneModel $PortfolioBehindSceneModel;

    public function __construct()
    {
        $this->PortfolioBehindSceneModel = new PortfolioBehindSceneModel();
    }

    public function index()
    {
        $behindScenes =
            $this->PortfolioBehindSceneModel

            ->select(
                'id,
             youtube_embed,
             is_active',

            )

            ->orderBy(
                'sort',
                'ASC'
            )

            ->findAll();

        return view(
            'behindthescence',
            [
                'behindScenes' =>
                $behindScenes
            ]
        );
    }

    public function store()
    {
        // $videoName = null;

        // $video =
        //     $this->request
        //     ->getFile('video');

        // if (
        //     $video &&
        //     $video->isValid()
        // ) {

        //     $uploadPath =
        //         FCPATH .
        //         'video/behind-scenes/';

        //     if (
        //         !is_dir(
        //             $uploadPath
        //         )
        //     ) {

        //         mkdir(
        //             $uploadPath,
        //             0777,
        //             true
        //         );
        //     }

        //     $videoName =
        //         $video
        //         ->getRandomName();

        //     $video->move(
        //         $uploadPath,
        //         $videoName
        //     );
        // }
        // var_dump($videoName);die;

        $last =
            $this->PortfolioBehindSceneModel

            ->orderBy(
                'sort',
                'DESC'
            )

            ->first();

        $sort = 1;

        if ($last) {

            $sort =
                $last['sort']
                + 1;
        }

        $this->PortfolioBehindSceneModel
            ->insert([

                'portfolio_id' =>
                1,

                'media_type' =>
                $this->request
                    ->getPost(
                        'media_type'
                    ),

                // 'video' =>
                // $videoName,

                'youtube_embed' =>
                $this->request
                    ->getPost(
                        'youtube_embed'
                    ),

                'sort' =>
                $sort,

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

        return $this->response
            ->setJSON([
                'status' =>
                'success'
            ]);
    }


    public function show(int $id)
    {
        $data =
            $this->PortfolioBehindSceneModel
            ->find($id);

        if (!$data) {

            return $this->response
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Data tidak ditemukan'
                ]);
        }

        return $this->response
            ->setJSON([
                'status' => 'success',
                'data'   => $data
            ]);
    }
    public function update(int $id)
    {
        $row =
            $this->PortfolioBehindSceneModel
            ->find($id);

        if (!$row) {

            return $this->response
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Data tidak ditemukan'
                ]);
        }

        $this->PortfolioBehindSceneModel
            ->update(
                $id,
                [

                    'youtube_embed' =>
                    $this->request->getPost(
                        'youtube_embed'
                    ),

                    'is_active' =>
                    $this->request->getPost(
                        'is_active'
                    ),

                    'updated_at' =>
                    date('Y-m-d H:i:s')
                ]
            );

        return $this->response
            ->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil diupdate'
            ]);
    }

    public function delete(int $id)
    {
        $behindScene =
            $this->PortfolioBehindSceneModel
            ->find($id);

        if (!$behindScene) {

            return $this->response
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Data tidak ditemukan'
                ]);
        }

        $this->PortfolioBehindSceneModel
            ->delete($id);

        return $this->response
            ->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
    }
}
