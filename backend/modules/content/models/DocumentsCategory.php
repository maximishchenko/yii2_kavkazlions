<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\query\DocumentsCategoryQuery;
use backend\modules\content\models\query\DocumentsQuery;
use common\models\Sort;
use common\models\Status;
use common\modules\content\models\DocumentsCategory as CommonDocumentsCategory;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class DocumentsCategory extends CommonDocumentsCategory
{
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name'], 'required'],
            [['name'], 'unique'],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE->value],
            [['status'], 'default', 'value'=> Status::STATUS_BLOCKED->value],
            [['parent_id'], 'safe'],
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'name' => Yii::t('app', 'Documents Category Name'),
            'parent_id' => Yii::t('app', 'Parent Category'),
        ]);
    }

    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'name' => Yii::t('app', 'Documents Category Name Hint'),
            'parent_id' => Yii::t('app', 'Parent Category Hint'),
        ]);
    }

    public function getDocuments(): ActiveQuery|DocumentsQuery
    {
        return $this->hasMany(Documents::class, ['category_id' => 'id']);
    }

    public function getChilds(): ActiveQuery|DocumentsCategoryQuery
    {
        return $this->hasMany(self::class, ['parent_id' => 'id']);
    }

    public static function find(): DocumentsCategoryQuery
    {
        return new DocumentsCategoryQuery(get_called_class());
    }

    /**
     * Возвращает массив всех категорий каталога в виде дерева
     */
    public static function getAllCategories(int $parent = 0, int $level = 0, int $exclude = 0): array
    {
        $children = self::find()
            ->where(['parent_id' => $parent])
            ->asArray()
            ->all();
        $result = [];
        foreach ($children as $category) {
            // при выборе родителя категории нельзя допустить
            // чтобы она размещалась внутри самой себя
            if ($category['id'] == $exclude) {
                continue;
            }
            if ($level) {
                $category['name'] = str_repeat('— ', $level) . $category['name'];
            }
            $result[] = $category;
            $result = array_merge(
                $result,
                self::getAllCategories($category['id'], $level+1, $exclude)
            );
        }
        return $result;
    }

    /**
     * Возвращает массив всех категорий каталога для возможности
     * выбора родителя при добавлении или редактировании товара
     * или категории
     */
    public static function getTree(int $exclude = 0, bool $root = false): array
    {
        $data = self::getAllCategories(0, 0, $exclude);
        $tree = [];
        // при выборе родителя категории можно выбрать значение «Без родителя»,
        // т.е. создать категорию верхнего уровня, у которой не будет родителя
        if ($root) {
            $tree[0] = Yii::t('app', 'No parent');
        }
        foreach ($data as $item) {
            $tree[$item['id']] = $item['name'];
        }
        return $tree;
    }
    

    /**
     * Возвращает имя родительской категории по ее идентификатору
     *
     * @param integer $id идентификатор категории
     * @return string имя категории
     */
    public static function getParentCategoryName(int $id): string
    {
        if (($category = self::findOne($id)) !== null) {
            return $category->name;
        }
        return Yii::t('app', 'No parent');
    }

    /**
     * Проверка наличия связанных записей в модели Documents
     * Используется перед удалением категории.
     * В случае наличия записей - возвращает ошибку
     *
     * @return bool
     */
    private function validateDocumentsBeforeDelete(): bool
    {
        if (!empty($this->documents)) {
            $this->addError('documents', Yii::t('app', 'Category has relation and cannot be deleted'));
            return false;
        }
        return true;
    }

    /**
     * Проверка наличия дочерних записей.
     * Используется перед удалением категории.
     * В случае наличия записей - возвращает ошибку
     *
     * @return bool
     */
    private function validateChildDocumentsBeforeDelete(): bool
    {

        if ($this->getChilds()->exists()) {
            $this->addError('childs', Yii::t('app', 'Category has childs and cannot be deleted'));
            return false;
        }
        return true;
    }
    
    public function beforeDelete(): bool
    {
        /**
         * Проверка наличия связанных записей
         */
        $this->validateDocumentsBeforeDelete();

        /**
         * Проверка наличия дочерних записей
         */
        $this->validateChildDocumentsBeforeDelete();

        if (parent::beforeDelete()) {
            if ($this->hasErrors()) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
