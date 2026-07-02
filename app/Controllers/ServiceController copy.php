<?php


namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\ServiceTranslationModel;

class ServiceController extends BaseController
{
     protected ServiceTranslationModel
        $translationModel;
    protected ServiceModel $serviceModel;
    // protected $serviceModel;
    // protected $translationModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->translationModel = new ServiceTranslationModel();
    }

    public function index($lang = 'ID')
    {
        $lang = strtoupper($lang);

        $data = $this->translationModel
            ->select('
                services.id as service_id,
                services.image,
                service_translations.*
            ')
            ->join('services', 'services.id = service_translations.service_id')
            ->join('languages', 'languages.id = service_translations.language_id')
            ->where('languages.code', $lang)
            ->orderBy('services.id', 'DESC')
            ->findAll();

        return view('service/index', [
            'data' => $data,
            'lang' => $lang
        ]);
    }

    public function create($lang = 'id')
    {
        return view('service/create', [
            'lang' => strtolower($lang)
        ]);
    }

    public function store()
    {
        $lang = strtolower($this->request->getPost('lang'));

        $language = model('LanguageModel')
            ->where('code', strtoupper($lang))
            ->first();

        if (!$language) {
            return redirect()->back()->with('error', 'Language tidak ditemukan');
        }

        // 🔥 create service master
        // $serviceId = $this->serviceModel->insert([
        //     'created_at' => date('Y-m-d H:i:s')
        // ]);

        // 🔥 upload image
        $imageFile = $this->request->getFile('image');

        $imageName = null;

        if ($imageFile && $imageFile->isValid()) {

            $imageName = $imageFile->getRandomName();

            // $imageFile->move('uploads/service/', $imageName);
            $imageFile->move(ROOTPATH . 'public/image/service/', $imageName);
        }
        $serviceId = $this->serviceModel->insert([
            'image' => $imageName,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        // 🔥 insert translation
        $this->translationModel->insert([
            'service_id' => $serviceId,
            'language_id' => $language['id'],
            'title' => $this->request->getPost('title_' . $lang),
            'description' => $this->request->getPost('desc_' . $lang),
            'created_at' => date('Y-m-d H:i:s')
            // 'image' => $imageName
        ]);


        return redirect()->to('/service/' . $lang)
            ->with('success', 'Berhasil disimpan');
    }

    public function delete(int $id)
    {
        $service = $this->serviceModel->find($id);

        if (!$service) {

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }

        // 🔥 hapus image
        if (
            !empty($service['image']) &&
            file_exists(FCPATH . 'uploads/service/' . $service['image'])
        ) {

            unlink(FCPATH . 'uploads/service/' . $service['image']);
        }

        // 🔥 hapus translation
        $this->translationModel
            ->where('service_id', $id)
            ->delete();

        // 🔥 hapus service
        $this->serviceModel->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Berhasil dihapus'
        ]);
    }

    public function detail(int $id, string $lang = 'ID')
    {
        $lang = strtoupper($lang);

        $service = $this->translationModel
            ->select('
            services.id as service_id,
            services.image,
            service_translations.title,
            service_translations.description
        ')
            ->join('services', 'services.id = service_translations.service_id')
            ->join('languages', 'languages.id = service_translations.language_id')
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
}
