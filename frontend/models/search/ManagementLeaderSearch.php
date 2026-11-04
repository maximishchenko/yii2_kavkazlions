<?php

declare(strict_types=1);

namespace frontend\modules\content\models\search;

use yii\data\ActiveDataProvider;
use frontend\models\ManagementLeader;
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

        $this->load($params, $formName);
        return $dataProvider;
    }
}
