<?php

namespace jakim\traits;

use yii\db\ActiveRecord;
use yii\web\ServerErrorHttpException;

trait SaveModelTrait
{
    protected function saveModel(ActiveRecord $model)
    {
        if (!$model->save()) {
            \Yii::error($model->errors, __METHOD__);
            throw new ServerErrorHttpException('Something went wrong.');
        }
    }
}