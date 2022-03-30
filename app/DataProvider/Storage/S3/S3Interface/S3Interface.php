<?php

/**
 * S3用のストレージインターフェース
 *
 * S3ストレージ用のインターフェース
 *
 * @author s_ryota sryotapersian@gmail.com
 * @version 1.0
 * @copyright 2021 Ryota Segawa
 */

namespace App\DataProvider\Storage\S3\S3Interface;

use Illuminate\Http\UploadedFile;

/**
 * S3ストレージ用のインターフェース
 *
 * @package App\DataProvider\Storage\S3\S3Interface
 * @version 1.0
 */
interface S3Interface
{
    /**
     * 学生プロフィール画像を保存
     *
     * @param UploadedFile $file プロフィール画像
     * @return void
     */
    public function putFileToUsers(UploadedFile $file): void;

    /**
     * プロフィール画像を取得
     *
     * @param string $img_name 画像名
     * @return string
     */
    public function getProfilePath(string $img_name): string;

    /**
     * 音声メッセージを取得
     *
     * @param string $voice 音声メッセージ
     * @return string
     */
    public function getVoicePath(string $voice): string;

    /**
     * 企業プロフィール画像を保存
     *
     * @param UploadedFile $file プロフィール画像
     * @return void
     */
    public function putFileToCompany(UploadedFile $file): void;

    /**
     * 企業音声メッセージを保存
     * 
     * @param object $voice 音声メッセージ
     * @return string 音声ファイル名
     */
    public function putVoiceToCompany(object $voice): string;
}
