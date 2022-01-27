<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SelfSingleCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('self_single_company_comments')->insert([
            [
            'comment_type' => '成長意欲',
            'comment' => 'この企業は、あなたの将来の希望に比べて、成長意欲の点で弱いようです。成長意欲をどん欲に求める環境を望んでいるならば、少し物足りなさを感じるかもしれません。'
            ],
            [
            'comment_type' => '社会貢献',
            'comment' => 'この企業は、あなたの将来の希望に比べて、社会貢献の点で弱いようです。直接、社会貢献ができる環境を望んでいるならば、少し物足りなさを感じるかもしれません。'
            ],
            [
            'comment_type' => '安定',
            'comment' => 'この企業は、あなたの将来の希望に比べて、安定の点で弱いようです。仕事の面で安定した生活を送りたい場合は、少しあなたには向いていないかもしれません。'
            ],
            [
            'comment_type' => '仲間',
            'comment' => 'この企業は、あなたの将来の希望に比べて、仲間の点で弱いようです。仲間を一番にしたいと考えているあなたにとっては、少し向いていないかもしれません。'
            ],
            [
            'comment_type' => '将来性',
            'comment' => 'この企業は、あなたの将来の希望に比べて、将来性の点で弱いようです。将来性を求めているあなたにとっては、少し物足りないかもしれません。'
            ],
            [
            'comment_type' => '',
            'comment' => '現状、この企業に対してあなたが足りない点はないようです。これからもこの勢いで頑張りましょう。'
            ],
    ]);
    }
}
