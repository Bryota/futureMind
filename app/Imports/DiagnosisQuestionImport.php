<?php

namespace App\Imports;

use App\DataProvider\Eloquent\DiagnosisQuestion;
use App\Enums\DiagnosisType;
use Maatwebsite\Excel\Concerns\ToModel;

class DiagnosisQuestionImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $diagnosisTypeEnum = DiagnosisType::fromKey($row[0]);
        return new DiagnosisQuestion([
            'diagnosis_type' => $diagnosisTypeEnum->value,
            'question' => $row[1]
        ]);
    }
}
