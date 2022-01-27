<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToFutureCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('to_future_comments')->insert([
            [
            'comment_type' => '成長意欲',
            'comment' => 'あなたがなりたい姿になるために足りないものは「成長意欲」です。自分のやりたいこと・伸ばしたいことを明確にし、それに対してどん欲に高みを目指していきましょう。しかし、いきなり高みに行くことは出来ません。その高みに対して、今足りない部分・やらなければいけない部分を明確にしましょう。そうすれば自ずと成長意欲が沸いてきます'
            ],
            [
            'comment_type' => '社会貢献',
            'comment' => 'あなたがなりたい姿になるために足りないものは「社会貢献」をしたいという心です。社会貢献とは、自分も周りの人も幸せになる社会を作ることです。まず、その幸せとは何かを考えましょう。その上で、具体的に何をすればその幸せを実現できるかを考え、実行しましょう。それが社会貢献です。'
            ],
            [
            'comment_type' => '安定',
            'comment' => 'あなたがなりたい姿になるために考えるべきことは「安定」です。まず、あなたにとっての安定とは何かを考えましょう。高い年収を得ること・家族との時間を十分に取れることなど、安定には様々な形があります。あなたの安定の形を見つけて、それが実現できるような将来を思い描きましょう。'
            ],
            [
            'comment_type' => '仲間',
            'comment' => 'あなたがなりたい姿になるために必要なものは「仲間」です。あなたにとって、友たち・仲間とはどのような存在であるかを考えましょう。過去の仲間からでも良いですし、理想の仲間などでも良いです。自分にとって仲間はどんな影響をもたらしてくれるかを考えましょう。そうすれば、あなたが求めている仲間が見えてくるでしょう。'
            ],
            [
            'comment_type' => '将来性',
            'comment' => 'あなたがなりたい姿になるために求めているものは「将来性」です。あなたは、心のどこかで将来成長できる団体・分野に関わりたいと思っています。そんなあなたは、将来自分の周りの環境が成長した後のことを考えてみましょう。そこに、あなたのなりたい姿があるかどうかが一番大切です。'
            ],
            [
            'comment_type' => 'なし',
            'comment' => '現状のあなたと理想のあなたに、大きな考え方の違いはありません。このまま、自分の理想に向かって頑張って下さい。'
            ],
    ]);
    }
}
