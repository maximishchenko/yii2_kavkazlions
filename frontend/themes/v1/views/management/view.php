<?php

/** @var yii\web\View $this */

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;

/** @var frontend\models\ManagementCompany $model */

$this->title = Yii::t('app', 'Management Company Leaders Title {name}', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Management Title'), 'url' => ['/management']];
$this->params['breadcrumbs'][] = $this->title;

$leadersProvider = new ActiveDataProvider([
    'query' => $model->getManagementLeaders(),
    'pagination' => false,
    'sort' => false,
]);
?>
<h1 class="page-title">
    <?= $this->title ?>
</h1>

<?php if ($model->description): ?>
    <section class="home-parallax management-parallax"<?php if ($backgroundImageUrl = $model->getBackgroundImageUrl()): ?> style="background-image: url('<?= Html::encode($backgroundImageUrl) ?>')"<?php endif; ?>>
        <div class="home-parallax-overlay"></div>
        <div class="home-parallax-content prose">
            <?= Html::decode($model->description) ?>
        </div>
    </section>
<?php endif; ?>

<?= ListView::widget([
    'dataProvider' => $leadersProvider,
    'itemView' => '_leader',
    'viewParams' => ['company' => $model],
    'layout' => '{items}',
    'options' => [
        'tag' => 'div',
        'class' => 'people grid-3 leaders',
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'person',
    ],
    'emptyText' => '',
]) ?>