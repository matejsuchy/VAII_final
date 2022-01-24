<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index() {
        $data = Record::orderBy('created_at', 'desc')->get();
        return view('records/index', ['records' => $data]);
    }

    public function show($record) {
        $record = Record::findOrFail($record);
        return view('records/show', ['record' => $record]);
    }

    public function destroy($id) {
        
        Record::destroy($id);
        
        return redirect('/records');
    }
}
