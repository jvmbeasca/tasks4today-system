<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Users',
            'users' => $this->userModel
                ->orderBy('full_name', 'ASC')
                ->findAll()
        ];

        return view('templates/header', $data)
            . view('users/index', $data)
            . view('templates/footer');
    }

    public function new()
    {
        $data = [
            'title' => 'Add User',
            'mode' => 'create',
            'user' => null
        ];

        return view('templates/header', $data)
            . view('users/form', $data)
            . view('templates/footer');
    }

    public function create()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|min_length[2]|max_length[100]',
            'avatar' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]|max_size[avatar,2048]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $avatarName = $this->uploadAvatar();

        $this->userModel->insert([
            'username' => trim($this->request->getPost('username')),
            'full_name' => trim($this->request->getPost('full_name')),
            'avatar' => $avatarName,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(site_url('users'))
            ->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound(
                'User not found.'
            );
        }

        $data = [
            'title' => 'Edit User',
            'mode' => 'edit',
            'user' => $user
        ];

        return view('templates/header', $data)
            . view('users/form', $data)
            . view('templates/footer');
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound(
                'User not found.'
            );
        }

        $rules = [
            'username' => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|min_length[2]|max_length[100]',
            'avatar' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]|max_size[avatar,2048]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $avatarName = $user['avatar'];

        if ($this->request->getFile('avatar')->isValid()) {
            $avatarName = $this->uploadAvatar();

            if ($user['avatar']) {
                $oldAvatar = FCPATH . 'uploads/avatars/' . $user['avatar'];

                if (is_file($oldAvatar)) {
                    unlink($oldAvatar);
                }
            }
        }

        $this->userModel->update($id, [
            'username' => trim($this->request->getPost('username')),
            'full_name' => trim($this->request->getPost('full_name')),
            'avatar' => $avatarName
        ]);

        return redirect()->to(site_url('users'))
            ->with('success', 'User updated successfully.');
    }

    private function uploadAvatar()
    {
        $file = $this->request->getFile('avatar');

        if (! $file || ! $file->isValid()) {
            return null;
        }

        $newName = $file->getRandomName();

        $file->move(
            FCPATH . 'uploads/avatars',
            $newName
        );

        return $newName;
    }
}