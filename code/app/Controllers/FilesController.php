<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfSistemModel;
use App\Models\DocumentModel;

class FilesController extends BaseController
{
    protected $confSistemModel;
    protected $documentModel;
    public function __construct()
    {
        $this->confSistemModel = new ConfSistemModel();
        $this->documentModel = new DocumentModel();
        helper("filesystem");
    }

    public function logo()
    {
        $row_setting = $this->confSistemModel->where('id', 5)->first();

        $path = WRITEPATH . 'files/setting/';
        $fullpath = $path . $row_setting['content'];
        $file = new \CodeIgniter\Files\File($fullpath, true);
        $binary = readfile($fullpath);
        return $this->response
            ->setHeader('Content-Type', $file->getMimeType())
            ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
            ->setStatusCode(200)
            ->setBody($binary);
    }

    public function document($id)
    {
        $row_document = $this->documentModel->where('id', decrypt_data($id))->first();

        $path = WRITEPATH . 'files/dokumen/';
        $fullpath = $path . $row_document['nama_file'];
        $file = new \CodeIgniter\Files\File($fullpath, true);
        $binary = readfile($fullpath);
        return $this->response
            ->setHeader('Content-Type', $file->getMimeType())
            ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
            ->setStatusCode(200)
            ->setBody($binary);
    }
}
