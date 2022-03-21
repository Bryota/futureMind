<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DiagnosisQuestionImport;

class ImportCSVController extends Controller
{
    /**
     * 診断質問編集ページ
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.importCSV.import_diagnosis_question');
    }

    /**
     * 診断質問追加
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new DiagnosisQuestionImport, $file);
        return view('admin.importCSV.import_diagnosis_question');
    }
}
