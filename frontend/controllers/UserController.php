<?php

namespace frontend\controllers;

use frontend\models\UserForm;
use frontend\repository\UserRepository;
use Yii;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class UserController extends Controller
{
    private UserRepository $userRepository;

    /**
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function __construct($id, $module, $config = [])
    {
        $this->userRepository = Yii::$container->get(UserRepository::class);
        parent::__construct($id, $module, $config);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionInfo(): string
    {
        $user = $this->userRepository->getById(Yii::$app->user->getId());

        return $this->render('info', [
            'user' => $user,
        ]);
    }

    public function actionEdit()
    {
        $userForm = new UserForm();
        $userId = Yii::$app->user->getId();
        $user = $this->userRepository->getById($userId);
        if ($userForm->load(Yii::$app->request->post()) && $userForm->validate()) {
            $userForm->imageFiles = UploadedFile::getInstances($userForm, 'imageFiles');
            $filesPath = $userForm->upload($userId);
            $userForm->save($user, $filesPath);
        } else {
            $userForm->setAttributes($user->getAttributes());
        }

        return $this->render('edit', [
            'model' => $userForm,
        ]);
    }


}