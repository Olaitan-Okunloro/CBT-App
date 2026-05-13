<?php
// app/Imports/TopicsImport.php

namespace App\Imports;

use App\Models\Topic;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class TopicsImport implements ToModel, WithHeadingRow
{
    protected $successCount = 0;
    protected $failedCount = 0;
    protected $errors = [];

    public function model(array $row)
    {
        // Debug: Log what we're receiving
        Log::info('Excel row data:', $row);
        
        // Check if all required fields exist
        if (empty($row['class_level_id']) || empty($row['subject_id']) || empty($row['topic'])) {
            $this->failedCount++;
            $this->errors[] = "Missing required data in row: " . json_encode($row);
            return null;
        }
        
        // Check if topic already exists
        $exists = Topic::where('class_level_id', $row['class_level_id'])
            ->where('subject_id', $row['subject_id'])
            ->where('topic', $row['topic'])
            ->exists();
        
        if ($exists) {
            $this->failedCount++;
            $this->errors[] = "Topic '{$row['topic']}' already exists for this class and subject";
            return null;
        }
        
        $this->successCount++;
        
        return new Topic([
            'class_level_id' => (int) $row['class_level_id'],
            'subject_id' => (int) $row['subject_id'],
            'topic' => (string) $row['topic'],
        ]);
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    public function getFailedCount()
    {
        return $this->failedCount;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}