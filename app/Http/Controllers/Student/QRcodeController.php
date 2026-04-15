<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentDetail;

class QRcodeController extends Controller
{
    public function qr($id)
    {
        // $student = StudentDetail::where('user_id', auth()->id())->first();
        $student = StudentDetail::where('user_id', $id)->firstOrFail();

        return view('student.qrcode', compact('student'));
    }
}
