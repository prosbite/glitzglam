<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class InventoryController extends Controller
{
    public function index()
    {
        return Inertia::render('admin/inventory/Index');
    }
}
