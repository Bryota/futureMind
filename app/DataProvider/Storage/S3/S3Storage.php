<?php
/**
 * S3用のストレージクラス
 *
 * S3ストレージ用のクラス
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */
namespace App\DataProvider\Storage\S3;

use App\DataProvider\Storage\S3\S3Interface\S3Interface;
use Storage;

/**
 * S3ストレージ用のクラス
 *
 * @package App\DataProvider\Storage\S3
 * @version 1.0
 */
class S3Storage implements S3Interface
{
    /**
     * コンストラクタ
     *
     * @return void
     */
    public function construct()
    {
    }

    /**
     * 学生プロフィール画像を保存
     *
     * @param $file 学生プロフィール画像
     * @return void
     */
    public function putFileToUsers($file): void
    {
        Storage::disk('s3')->putFileAs('users', $file, $file->getClientOriginalName());
    }

    /**
     * プロフィール画像を取得
     *
     * @param string $img_name 画像名
     * @return string
     */
    public function getProfilePath(string $img_name): string
    {
        return Storage::disk('s3')->url($img_name);
    }

    /**
     * 企業プロフィール画像を保存
     *
     * @param $file 企業プロフィール画像
     * @return void
     */
    public function putFileToCompany($file): void
    {
        Storage::disk('s3')->putFileAs('companies', $file, $file->getClientOriginalName());
    }
}
