<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FutureSingleCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('future_single_company_comments')->insert([
            [
            'comment_type' => '成長意欲',
            'comment' => 'この企業は、自分の成長にどん欲になれる人が向いています。あなたには、そのどん欲さがまだ足りないようです。自分のなりたい姿をどん欲に求めていきましょう。'
            ],
            [
            'comment_type' => '社会貢献',
            'comment' => 'この企業は、社会貢献をしたいと思っている人に向いています。あなたには、社会貢献したいという思いがまだ足りないようです。あなたがどんなことで社会貢献ができるかじっくり考えていきましょう。'
            ],
            [
            'comment_type' => '安定',
            'comment' => 'この企業は、安定を求めている人に向いています。あなたには、安定を求めている姿勢がまだ足りません。あなたにとっての安定とは何か、もう一度じっくり考えてみましょう。'
            ],
            [
            'comment_type' => '仲間',
            'comment' => 'この企業は、仲間との繋がりを大切にしたいと考えている人に向いています。あなたには、その繋がりを大切にしたいという気持ちがまだ少ないようです。'
            ],
            [
            'comment_type' => '将来性',
            'comment' => 'この企業は、将来性を求めている人に向いています。あなたには、将来性を求める気持ちがまだ足りないようです。あなた自身がどんな将来性を求めているのかもう一度考えてみましょう。'
            ],
            [
            'comment_type' => 'なし',
            'comment' => '現状、この企業に対してあなたが足りない点はないようです。これからもこの勢いで頑張りましょう。'
            ],
    ]);
    }
}
