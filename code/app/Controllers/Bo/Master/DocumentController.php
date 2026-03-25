<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\DocumentModel;
use CodeIgniter\Validation\Exceptions\ValidationException;
use Ramsey\Uuid\Uuid;
use RuntimeException;
use Throwable;

class DocumentController extends BaseController
{
    protected $documentModel;
    public function __construct()
    {
        $this->documentModel = new DocumentModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dokumen Penting',
            'active_document' => 'active',
            'dt_document' => $this->documentModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_document');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $db = db_connect();

        $db->transBegin();

        try {
            $data = $this->request->getPost();

            $docupload = ['nama_file'];
            foreach ($docupload as $i) {
                $fileupload = $this->request->getFile($i);
                if (!empty($fileupload)) {
                    $validationRule = [
                        $i => [
                            'rules' => [
                                'mime_in[' . $i . ',application/pdf]',
                                'ext_in[' . $i . ',pdf]',
                                'max_size[' . $i . ',10240]',
                            ],
                        ]
                    ];

                    if (! $this->validate($validationRule)) {
                        throw new ValidationException($this->validator->getError($i));
                    }

                    $fileName = Uuid::uuid4()->toString() . '_' . $fileupload->getName();
                    if ($fileupload->isValid() && ! $fileupload->hasMoved()) {

                        $filePath = WRITEPATH . 'files/dokumen';
                        if (!is_dir($filePath)) {
                            mkdir($filePath, 0777, true);
                        }

                        $fileupload->move($filePath, $fileName);

                        $data[$i] = $fileName;
                    }
                }
            }

            $data['createdby'] = session()->get('fullname');
            $data['createdon'] = date('Y-m-d H:i:s');
            $data['rowstatus'] = 1;

            if (!$this->documentModel->insert($data)) {
                throw new RuntimeException(implode(',', $this->documentModel->errors()));
            }

            $db->transCommit();

            return redirect()->to('master/document')->with('success', 'Data berhasil ditambahkan');
        } catch (Throwable $e) {
            $db->transRollback();
            log_message('error', 'Error, ' . $e->getMessage() . ' | ' . $e->getFile() . ' | ' . $e->getLine());
            return redirect()->back()->withInput()->with('error', 'Error, ' . $e->getMessage());
        }
    }

    public function update($id)
    {
        $db = db_connect();

        $db->transBegin();

        try {
            if (empty($row_document = $this->documentModel->where('id', decrypt_data($id))->first())) {
                throw new ValidationException("Data tidak ditemukan");
            }

            $data = $this->request->getPost();

            $docupload = ['nama_file'];
            foreach ($docupload as $i) {
                $fileupload = $this->request->getFile($i);
                if (!empty($fileupload)) {
                    $validationRule = [
                        $i => [
                            'rules' => [
                                'mime_in[' . $i . ',application/pdf]',
                                'ext_in[' . $i . ',pdf]',
                                'max_size[' . $i . ',10240]',
                            ],
                        ]
                    ];

                    if (! $this->validate($validationRule)) {
                        throw new ValidationException($this->validator->getError($i));
                    }

                    $fileName = Uuid::uuid4()->toString() . '_' . $fileupload->getName();
                    if ($fileupload->isValid() && ! $fileupload->hasMoved()) {

                        $filePath = WRITEPATH . 'files/dokumen';
                        if (!is_dir($filePath)) {
                            mkdir($filePath, 0777, true);
                        }

                        if (is_file($old_file = $filePath . $row_document['nama_file'])) {
                            @unlink($old_file);
                        }

                        $fileupload->move($filePath, $fileName);

                        $data[$i] = $fileName;
                    }
                }
            }

            $data['modifiedon'] = date('Y-m-d H:i:s');

            if (!$this->documentModel->update($row_document['id'], $data)) {
                throw new RuntimeException(implode(',', $this->documentModel->errors()));
            }

            $db->transCommit();

            return redirect()->to('master/document')->with('success', 'Data berhasil diubah');
        } catch (Throwable $e) {
            $db->transRollback();
            log_message('error', 'Error, ' . $e->getMessage() . ' | ' . $e->getFile() . ' | ' . $e->getLine());
            return redirect()->back()->withInput()->with('error', 'Error, ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $db = db_connect();

        $db->transBegin();

        try {
            if (empty($row_document = $this->documentModel->where('id', decrypt_data($id))->first())) {
                throw new ValidationException("Data tidak ditemukan");
            }

            if (!$this->documentModel->delete($row_document['id'])) {
                throw new RuntimeException(implode(',', $this->documentModel->errors()));
            }

            $db->transCommit();

            return redirect()->to('master/document')->with('success', 'Data berhasil dihapus');
        } catch (Throwable $e) {
            $db->transRollback();
            log_message('error', 'Error, ' . $e->getMessage() . ' | ' . $e->getFile() . ' | ' . $e->getLine());
            return redirect()->back()->withInput()->with('error', 'Error, ' . $e->getMessage());
        }
    }
}
