<?php

declare(strict_types=1);

namespace frontend\models\search;

use yii\data\ActiveDataProvider;
use frontend\models\PartnerServices;
use common\models\Sort;

final class PartnerServicesSearch extends PartnerServices
{
    public function rules(): array
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'slug', 'sort', 'comment', 'description'], 'safe'],
        ];
    }

    public function search(array $params, string | null $formName = null): ActiveDataProvider
    {
        $query = PartnerServices::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => Sort::getFrontendDefaultSort()],
            'pagination' => [
                'pageSize' => false,
            ]
        ]);

        $this->load($params, $formName);
        return $dataProvider;
    }
}
