<?php

namespace App\Imports;

use App\Models\User;
use App\Models\StudentDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMail;
use App\Models\TeacherDetail;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{

    protected $schoolId;
    protected $classId;

    public function __construct($schoolId, $classId)
    {
        $this->schoolId = $schoolId;
        $this->classId = $classId;
    }

    public function model(array $row)
    {
        // Skip empty rows
        if (!isset($row['email']) || empty($row['email'])) {
            return null;
        }

        // Prevent duplicate
        if (User::where('email', $row['email'])->exists()) {
            return null;
        }

        $password = Str::random(8);

        // Create user
        $user = User::create([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make($password),
            'phone' => $row['phone'] ?? null,
            'role' => 'student',
            'exam_type' => 'GENERAL',
            'is_active' => true
        ]);

        // ✅ Get class from Excel
        $classId = $row['class_id'];

        // ✅ Auto assign teacher
        $teacher = TeacherDetail::where('class_id', $classId)
            ->where('school_id', $this->schoolId)
            ->first();

        // Create student details
        StudentDetail::create([
            'user_id' => $user->id,
            'registration_number' => 'STU'.strtoupper(Str::random(8)),
            'school_id' => $this->schoolId,
            'class_id' => $classId,
            'teacher_id' => $teacher ? $teacher->user_id : null,
            'has_paid' => false
        ]);

        // Send email
        Mail::to($user->email)->send(new UserCreatedMail($user, $password));

        // Store credentials
        session()->push('created_students', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password
        ]);

        return $user;
    }
}