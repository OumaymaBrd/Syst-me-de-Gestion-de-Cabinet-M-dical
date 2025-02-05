<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\AdminModel;

class AdminController extends Controller
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function dashboard()
    {
        // Add logic for admin dashboard
        $this->render('admin/dashboard');
    }

    public function users()
    {
        $users = $this->adminModel->getAllUsers();
        $this->render('admin/users', ['users' => $users]);
    }

    public function deleteUser($id)
    {
        if ($this->adminModel->deleteUser($id)) {
            $this->redirect('/admin/users');
        } else {
            // Handle error
        }
    }
}