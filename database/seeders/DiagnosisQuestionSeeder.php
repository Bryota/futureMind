<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiagnosisQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diagnosis_questions')->insert([
            [
                'diagnosis_type' => 0,
                'question' => "質問1（成長）"
            ],
            [
                'diagnosis_type' => 1,
                'question' => "質問2（社会）"
            ],
            [
                'diagnosis_type' => 2,
                'question' => "質問3（安定）"
            ],
            [
                'diagnosis_type' => 3,
                'question' => "質問4（仲間）"
            ],
            [
                'diagnosis_type' => 4,
                'question' => "質問5（将来）"
            ],
            [
                'diagnosis_type' => 0,
                'question' => "質問6（成長）"
            ],
            [
                'diagnosis_type' => 1,
                'question' => "質問7（社会）"
            ],
            [
                'diagnosis_type' => 2,
                'question' => "質問8（安定）"
            ],
            [
                'diagnosis_type' => 3,
                'question' => "質問9（仲間）"
            ],
            [
                'diagnosis_type' => 4,
                'question' => "質問10（将来）"
            ],
            [
                'diagnosis_type' => 0,
                'question' => "質問11（成長）"
            ],
            [
                'diagnosis_type' => 1,
                'question' => "質問12（社会）"
            ],
            [
                'diagnosis_type' => 2,
                'question' => "質問13（安定）"
            ],
            [
                'diagnosis_type' => 3,
                'question' => "質問14（仲間）"
            ],
            [
                'diagnosis_type' => 4,
                'question' => "質問15（将来）"
            ],
        ]);
    }
}
