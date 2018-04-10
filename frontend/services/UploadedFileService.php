<?php

namespace frontend\services;

use Yii;
use yii\web\UploadedFile;

class UploadedFileService
{
    /**
     * @param int $userId
     * @return string
     */
    public function getUploadsPathByUserId(int $userId): string
    {
        return Yii::getAlias('@uploads/users/' . strval($userId));
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param int $userId
     * @return false|string
     */
    public function saveUserPicture(UploadedFile $uploadedFile, int $userId)
    {
        if (!$uploadedFile) {
            Yii::warning('Empty UploadedFile');
            return false;
        }

        $filePath = $this->getUploadsPathByUserId($userId);
        $fileName = strval(time()) . '.' . $uploadedFile->extension;

        if (!file_exists($filePath) && !@mkdir($filePath, 0777, true)) {
            Yii::warning('Can\'t create path ' . $filePath);
            return false;
        }

        if (!$uploadedFile->saveAs($filePath . '/' . $fileName)) {
            Yii::warning('Can\'t save uploaded file');
            return false;
        }

        return $fileName;
    }

    /**
     * @param string $fileName
     * @param int $userId
     * @return bool
     */
    public function removeUserPicture(string $fileName, int $userId): bool
    {
        if (empty($fileName)) {
            return true;
        }

        $filePath = $this->getUploadsPathByUserId($userId);
        if (@unlink($filePath . '/' . $fileName)) {
            return true;
        }

        Yii::warning('Can\'t unlink user picture file');
        return false;
    }
}