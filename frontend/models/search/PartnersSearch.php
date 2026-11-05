<?php

declare(strict_types=1);

namespace frontend\models\search;

use yii\data\ActiveDataProvider;
use frontend\models\Partners;
use common\models\Sort;

final class PartnersSearch extends Partners
{
    public function rules(): array
    {
        return [
            [['id', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'slug', 'comment'], 'safe'],
        ];
    }

    public function search(array $params, string | null $formName = null): ActiveDataProvider
    {
        $query = Partners::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => Sort::getBackendDefaultSort()],
            'pagination' => [
                'pageSize' => false
            ]
        ]);

        $this->load($params, $formName);
        return $dataProvider;
    }
}
