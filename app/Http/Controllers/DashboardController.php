<?php

namespace App\Http\Controllers;

use App\MyClass\Response;
use Exception;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.index', [
            'title' => 'Dashboard'
        ]);
    }

    public function templateImport($filename)
	{
		try {
			$path = storage_path('import_templates/'.$filename);
			return response()->download($path);
		} catch (Exception $e) {
			return Response::error($e);
		}
	}
}
