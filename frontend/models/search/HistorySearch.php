<?php

declare(strict_types=1);

namespace frontend\models\search;

use yii\data\ActiveDataProvider;
use frontend\models\History;
use common\models\Sort;

final class HistorySearch extends History
{
    public function rules(): array
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'title', 'image', 'slug', 'sort', 'comment', 'description'], 'safe'],
        ];
    }

    public function search(array $params, string | null $formName = null): ActiveDataProvider
    {
        $query = History::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => Sort::getFrontendDefaultSort()],
        ]);

        $this->load($params, $formName);
        return $dataProvider;
    }
}
