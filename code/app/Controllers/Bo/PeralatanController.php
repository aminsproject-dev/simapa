<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use App\Models\PeralatanModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use RuntimeException;

class PeralatanController extends BaseController
{
    protected $peralatanModel;
    protected string $uploadPath = WRITEPATH . 'uploads/peralatan/';

    public function __construct()
    {
        $this->peralatanModel = new PeralatanModel();

        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
    }

    private function handleFileUpload(string $field): ?string
    {
        $file = $this->request->getFile($field);

        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            throw new RuntimeException('File ' . str_replace('_', ' ', $field) . ' harus berupa file JPG, JPEG, PNG, atau PDF');
        }

        if ($file->getSize() > 2048 * 1024) {
            throw new RuntimeException('File ' . str_replace('_', ' ', $field) . ' maksimal 2MB');
        }

        $newName = $file->getRandomName();
        $file->move($this->uploadPath, $newName);

        return $newName;
    }

    private function deleteOldFile(?string $filename): void
    {
        if (!empty($filename) && file_exists($this->uploadPath . $filename)) {
            unlink($this->uploadPath . $filename);
        }
    }

    public function index()
    {
        $keyword = $this->request->getGet('search');
        $data = [
            'title' => 'Katalog Peralatan',
            'open_data' => 'show',
            'show_peralatan' => 'show',
            'active_peralatan' => 'active',
            'list_peralatan' => $keyword ? $this->peralatanModel->searchData($keyword) : $this->peralatanModel->getAll(),
            'keyword' => $keyword,
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/peralatan/v_index');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Peralatan',
            'open_data' => 'show',
            'show_peralatan' => 'show',
            'active_peralatan' => 'active',
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/peralatan/v_add');
        echo view('bo/pages/v_footer');
    }

    public function store()
    {
        $rules = [
            'nama_peralatan' => 'required|max_length[255]',
            'jumlah' => 'required|integer|greater_than[0]',
            'kondisi' => 'required|in_list[Baik,Buruk]',
            'status_kepemilikan' => 'required|in_list[Sendiri,Sewa,Dukungan]',
            'bukti_kepemilikan' => 'permit_empty|uploaded[bukti_kepemilikan]|max_size[bukti_kepemilikan,2048]|ext_in[bukti_kepemilikan,jpg,jpeg,png,pdf]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        $data['bukti_kepemilikan'] = null;

        try {
            $filename = $this->handleFileUpload('bukti_kepemilikan');
            if ($filename !== null) {
                $data['bukti_kepemilikan'] = $filename;
            }
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        if (!$this->peralatanModel->insert($data)) {
            log_message('error', (string)$this->peralatanModel->errors());
            return redirect()->back()->withInput()->with('error', $this->peralatanModel->errors());
        }

        return redirect()->to('peralatan')->with('success', 'Data peralatan berhasil ditambahkan');
    }

    public function view($id)
    {
        $id_peralatan = decrypt_data($id);
        $row_peralatan = $this->peralatanModel->getSelectedData($id_peralatan);

        if (empty($row_peralatan)) {
            return redirect()->to(site_url('peralatan'))->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Peralatan',
            'open_data' => 'show',
            'show_peralatan' => 'show',
            'active_peralatan' => 'active',
            'row_peralatan' => $row_peralatan,
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/peralatan/v_view');
        echo view('bo/pages/v_footer');
    }

    public function edit($id)
    {
        $id_peralatan = decrypt_data($id);
        $row_peralatan = $this->peralatanModel->getSelectedData($id_peralatan);

        if (empty($row_peralatan)) {
            return redirect()->to(site_url('peralatan'))->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Peralatan',
            'open_data' => 'show',
            'show_peralatan' => 'show',
            'active_peralatan' => 'active',
            'row_peralatan' => $row_peralatan,
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/peralatan/v_edit');
        echo view('bo/pages/v_footer');
    }

    public function update($id)
    {
        $id_peralatan = decrypt_data($id);
        $row_peralatan = $this->peralatanModel->where('id_peralatan', $id_peralatan)->first();

        if (empty($row_peralatan)) {
            return redirect()->to(site_url('peralatan'))->with('error', 'Data tidak ditemukan');
        }

        $rules = [
            'nama_peralatan' => 'required|max_length[255]',
            'jumlah' => 'required|integer|greater_than[0]',
            'kondisi' => 'required|in_list[Baik,Buruk]',
            'status_kepemilikan' => 'required|in_list[Sendiri,Sewa,Dukungan]',
            'bukti_kepemilikan' => 'permit_empty|max_size[bukti_kepemilikan,2048]|ext_in[bukti_kepemilikan,jpg,jpeg,png,pdf]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();

        try {
            $filename = $this->handleFileUpload('bukti_kepemilikan');
            if ($filename !== null) {
                $this->deleteOldFile($row_peralatan['bukti_kepemilikan'] ?? null);
                $data['bukti_kepemilikan'] = $filename;
            }
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        if (!$this->peralatanModel->update($id_peralatan, $data)) {
            log_message('error', (string)$this->peralatanModel->errors());
            return redirect()->back()->withInput()->with('error', $this->peralatanModel->errors());
        }

        return redirect()->to(site_url('peralatan/view/' . encrypt_data($id_peralatan)))->with('success', 'Data peralatan berhasil diperbarui');
    }

    public function delete($id)
    {
        $id_peralatan = decrypt_data($id);
        $row_peralatan = $this->peralatanModel->where('id_peralatan', $id_peralatan)->first();

        if (empty($row_peralatan)) {
            return redirect()->to(site_url('peralatan'))->with('error', 'Data tidak ditemukan');
        }

        $this->deleteOldFile($row_peralatan['bukti_kepemilikan'] ?? null);

        if (!$this->peralatanModel->delete($id_peralatan)) {
            log_message('error', (string)$this->peralatanModel->errors());
            return redirect()->back()->withInput()->with('error', $this->peralatanModel->errors());
        }

        return redirect()->to(site_url('peralatan'))->with('success', 'Data peralatan berhasil dihapus');
    }

    public function serveFile($filename)
    {
        $filepath = $this->uploadPath . basename($filename);

        if (!file_exists($filepath)) {
            throw new PageNotFoundException('File tidak ditemukan');
        }

        $mime = mime_content_type($filepath);
        $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];

        if (!in_array($mime, $allowedTypes)) {
            throw new PageNotFoundException('File tidak valid');
        }

        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setHeader('Content-Length', filesize($filepath))
            ->setHeader('Cache-Control', 'public, max-age=86400')
            ->setBody(file_get_contents($filepath));
    }
}
