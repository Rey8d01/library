<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Class MainActiveRecord
 *
 * @package app\models
 */
abstract class MainActiveRecord extends ActiveRecord
{

    /**
     * Common method for create {@link ActiveDataProvider} with filtered {@link ActiveQuery} from data by $attributes.
     *
     * @param array $attributes
     * @return ActiveDataProvider
     */
    public function search(array $attributes = [])
    {
        // Вариант получения данных из приходящего массива - на случай если они пришли через данные формы
        $shortNameClass = (new \ReflectionClass($this))->getShortName();
        if (array_key_exists($shortNameClass, $attributes)) {
            $attributes = $attributes[$shortNameClass];
        }

        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);


        $safeAttributes = $this->safeAttributes();
        if ($safeAttributes) {
            foreach ($safeAttributes as $key => $field) {
                if (array_key_exists($field, $attributes)) {
                    $val = $attributes[$field];
                    if (!(empty($val) && $val !== '0')) {
                        $this->$field = $val;
                        $query->andFilterWhere([$field => $val]);
                    }
                }
            }
        }

        return $dataProvider;
    }

    /**
     * Return list of id from relation.
     *
     * @param string $relAttribute
     * @return array
     */
    public function getRelIds($relAttribute)
    {
        return array_map(function ($relModel) {
            return $relModel->id;
        }, $this->$relAttribute);
    }

    /**
     * @see findOne
     * @param mixed $condition
     * @throws NotFoundHttpException if in DB no have data by $condition
     * @return static
     */
    public function findOneOrNotFound($condition)
    {
        $model = static::findOne($condition);
        if (!$model) {
            throw new NotFoundHttpException(static::class.' model not found');
        }
        return $model;
    }
}
