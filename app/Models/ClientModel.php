<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'logo'];

    // =====================
    // GET
    // =====================
    public function getAll()
    {
        return $this->findAll();
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    // =====================
    // CREATE
    // =====================
    public function createClient($name, $logo)
    {
        if (!$name) {
            return [
                'status' => 'error',
                'message' => 'Name wajib diisi'
            ];
        }

        $logoName = null;

        if ($logo && $logo->isValid()) {

            if ($logo->getMimeType() !== 'image/png') {
                return [
                    'status' => 'error',
                    'message' => 'Logo harus PNG'
                ];
            }

            $logoName = $logo->getRandomName();

            $logo->move(ROOTPATH . 'public/image/client', $logoName);
        }

        $this->insert([
            'name' => $name,
            'logo' => $logoName
        ]);

        return [
            'status' => 'success',
            'message' => 'Client berhasil ditambahkan'
        ];
    }

    // =====================
    // UPDATE
    // =====================
    public function updateClient($id, $name, $logo)
    {
        $client = $this->find($id);

        if (!$client) {
            return [
                'status' => 'error',
                'message' => 'Client tidak ditemukan'
            ];
        }

        $logoName = $client['logo'];

        if ($logo && $logo->isValid()) {

            if ($logo->getMimeType() !== 'image/png') {
                return [
                    'status' => 'error',
                    'message' => 'Logo harus PNG'
                ];
            }

            // hapus lama
            if ($logoName && file_exists(ROOTPATH . 'public/image/client/' . $logoName)) {
                unlink(ROOTPATH . 'public/image/client/' . $logoName);
            }

            $logoName = $logo->getRandomName();

            $logo->move(ROOTPATH . 'public/image/client', $logoName);
        }

        $this->update($id, [
            'name' => $name,
            'logo' => $logoName
        ]);

        return [
            'status' => 'success',
            'message' => 'Client berhasil diupdate'
        ];
    }

    // =====================
    // DELETE
    // =====================
    public function deleteClient($id)
    {
        $client = $this->find($id);

        if (!$client) {
            return [
                'status' => 'error',
                'message' => 'Client tidak ditemukan'
            ];
        }

        if ($client['logo']) {
            @unlink(ROOTPATH . 'public/uploads/client/' . $client['logo']);
        }

        $this->delete($id);

        return [
            'status' => 'success',
            'message' => 'Client berhasil dihapus'
        ];
    }
}
