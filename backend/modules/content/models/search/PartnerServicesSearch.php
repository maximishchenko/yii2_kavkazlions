<?php

declare(strict_types=1);

namespace backend\modules\content\models\search;

use yii\data\ActiveDataProvider;
use backend\modules\content\models\PartnerServices;
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
            'sort'=> ['defaultOrder' => Sort::getBackendDefaultSort()],
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'sort', $this->sort])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
