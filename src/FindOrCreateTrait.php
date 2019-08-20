<?php

namespace jakim\traits;

use yii\db\ActiveRecord;

trait FindOrCreateTrait
{
    public function findOrCreate(array $conditions, string $class): ActiveRecord
    {
        /** @var ActiveRecord $class */
        $model = $class::findOne($conditions);
        if ($model === null) {
            $model = new $class($conditions);
        }

        return $model;
    }
}