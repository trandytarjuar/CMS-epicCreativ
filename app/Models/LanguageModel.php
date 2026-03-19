<?php

namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model
{
    protected $table = 'languages';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'code',
        'name',
        'created_at',
        'updated_at'
    ];

    public function getAll()
    {
        return $this->orderBy('id','DESC')->findAll();
    }

    public function createLanguage($data)
    {
        if(!$data['code'] || !$data['name']){
            return ['status'=>'error','message'=>'Semua field wajib diisi'];
        }

        $this->insert([
            'code'=>$data['code'],
            'name'=>$data['name'],
            'created_at'=>date('Y-m-d H:i:s')
        ]);

        return ['status'=>'success','message'=>'Language berhasil ditambahkan'];
    }

    public function updateLanguage($id, $data)
    {
        $this->update($id,[
            'code'=>$data['code'],
            'name'=>$data['name'],
            'updated_at'=>date('Y-m-d H:i:s')
        ]);

        return ['status'=>'success','message'=>'Language updated'];
    }

    public function deleteLanguage($id)
    {
        $this->delete($id);

        return ['status'=>'success','message'=>'Deleted'];
    }
}