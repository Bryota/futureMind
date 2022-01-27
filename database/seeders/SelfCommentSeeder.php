<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SelfCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('self_diagnosis_comments')->insert([
            [
            'comment_type' => '成長意欲',
            'comment' => 'あなたには成長意欲が人一倍あります。現状の自分に満足せず、常に高いところを目指しているのがあなたの特徴です。'
            ],
            [
            'comment_type' => '社会貢献',
            'comment' => 'あなたには、社会貢献したいという思いが人一倍あります。これからも社会のためになることは何かを考えて行きましょう。'
            ],
            [
            'comment_type' => '安定',
            'comment' => 'あなたには、安定を求めている思いが人一倍あります。自分にとっての安定を考えて目指していきましょう'
            ],
            [
            'comment_type' => '仲間',
            'comment' => 'あなたは、常に素晴らしい仲間に囲まれています。これまでの人生で、仲間の大切さや仲間への思いをかんじてきたのではないでしょうか'
            ],
            [
            'comment_type' => '将来性',
            'comment' => 'あなたには、将来性があります。これまでに、期待される経験を多くしてきたのではないでしょうか？'
            ],
    ]);
    }
}
