<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Customers',
            'customers' => $this->customerModel
                ->orderBy('full_name', 'ASC')
                ->findAll()
        ];

        return view('templates/header', $data)
            . view('customers/index', $data)
            . view('templates/footer');
    }

    public function new()
    {
        $data = [
            'title' => 'Add Customer',
            'mode' => 'create',
            'customer' => null
        ];

        return view('templates/header', $data)
            . view('customers/form', $data)
            . view('templates/footer');
    }

    public function create()
    {
        $rules = [
            'full_name' => [
                'label' => 'Full name',
                'rules' => 'required|min_length[2]|max_length[100]'
            ],
            'email' => [
                'label' => 'Email address',
                'rules' => 'required|valid_email|max_length[100]'
            ],
            'phone' => [
                'label' => 'Phone number',
                'rules' => 'permit_empty|max_length[20]'
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->customerModel->insert([
            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            ),
            'email' => trim(
                (string) $this->request->getPost('email')
            ),
            'phone' => trim(
                (string) $this->request->getPost('phone')
            ),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = $this->customerModel->find($id);

        if (! $customer) {
            throw PageNotFoundException::forPageNotFound(
                'Customer not found.'
            );
        }

        $data = [
            'title' => 'Edit Customer',
            'mode' => 'edit',
            'customer' => $customer
        ];

        return view('templates/header', $data)
            . view('customers/form', $data)
            . view('templates/footer');
    }

    public function update($id)
    {
        if (! $this->customerModel->find($id)) {
            throw PageNotFoundException::forPageNotFound(
                'Customer not found.'
            );
        }

        $rules = [
            'full_name' => [
                'label' => 'Full name',
                'rules' => 'required|min_length[2]|max_length[100]'
            ],
            'email' => [
                'label' => 'Email address',
                'rules' => 'required|valid_email|max_length[100]'
            ],
            'phone' => [
                'label' => 'Phone number',
                'rules' => 'permit_empty|max_length[20]'
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->customerModel->update($id, [
            'full_name' => trim(
                (string) $this->request->getPost('full_name')
            ),
            'email' => trim(
                (string) $this->request->getPost('email')
            ),
            'phone' => trim(
                (string) $this->request->getPost('phone')
            )
        ]);

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer updated successfully.');
    }
}