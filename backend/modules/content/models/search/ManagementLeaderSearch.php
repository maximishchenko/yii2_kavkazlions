<?php

declare(strict_types=1);

namespace backend\modules\content\models\search;

use backend\modules\content\models\ManagementCompany;
use yii\data\ActiveDataProvider;
use backend\modules\content\models\ManagementLeader;
use common\models\Sort;

final class ManagementLeaderSearch extends ManagementLeader
{
    /**
     * Связь с организацией
     *
     * @var mixed $managementCompany
     */
    public $managementCompany;

    public function rules(): array
    {
        return [
            [['id', 'management_company_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'image', 'slug', 'sort', 'comment', 'managementCompany'], 'safe'],
        ];
    }

    public function search(array $params, string | null $formName = null): ActiveDataProvider
    {
        $query = ManagementLeader::find();
        $query->joinWith(['managementCompany']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => Sort::getBackendDefaultSort()],
        ]);
        $dataProvider->sort->attributes['managementCompany'] = [
            'asc' => [ManagementCompany::tableName() . '.name' => SORT_ASC],
            'desc' => [ManagementCompany::tableName() . '.name' => SORT_DESC],
        ];

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'management_company_id' => $this->management_company_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', static::tableName() . '.slug', $this->slug])
            ->andFilterWhere(['like', 'sort', $this->sort])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', ManagementCompany::tableName() . '.name', $this->managementCompany]);

        return $dataProvider;
    }
}
