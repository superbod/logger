<?php

namespace frontend\models;

use common\models\User;
use Throwable;
use Yii;
use yii\base\Model;
use yii\db\StaleObjectException;
use yii\web\UploadedFile;

Class UserForm extends Model
{
    public $first_name;
    public $last_name;
    public $date_of_birth;
    public $pasport_expiry_date;
    /** @var UploadedFile */
    public $imageFiles;

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'date_of_birth', 'pasport_expiry_date'], 'required'],
            [['first_name', 'last_name'], 'string', 'min' => 2, 'max' => 32],
            [['date_of_birth', 'pasport_expiry_date'], 'filter', 'filter' => function ($value) {
                return (new \DateTimeImmutable($value))->format('Y-m-d');
            }],
            [['imageFiles'], 'file', 'skipOnEmpty' => false,
                'extensions' => 'png, jpg, pdf', 'maxFiles' => 4, 'maxSize' => 1024 * 1024 * 5
            ],
        ];
    }

    public function upload(int $userId): array
    {
        $filesPath = [];
        foreach ($this->imageFiles as $file) {
            $path = '/uploads/' . uniqid() . '-' . $userId . '.' . $file->extension;
            if ($file->saveAs(Yii::getAlias('@app') . $path)) {
                $filesPath[] = $path;
            }
        }
        return $filesPath;
    }

    /**
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function save(User $user, array $filesPath): bool
    {
        $oldFiles = $user->uploaded_files;

        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->date_of_birth = $this->date_of_birth;
        $user->pasport_expiry_date = $this->pasport_expiry_date;
        $user->uploaded_files = $filesPath;

        if ($user->update()) {
            if ($oldFiles !== null) {
                $this->removeOldFiles($oldFiles);
            }
            return true;
        } else {
            return false;
        }
    }

    private function removeOldFiles(array $files)
    {
        foreach ($files as $file) {
            unlink(Yii::getAlias('@app') . $file);
        }
    }
}