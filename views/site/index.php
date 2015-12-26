<?php

use app\module\admin\models\NewsController;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\News */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Новости</h1>

        <p class="lead">
			<?php foreach ($allnews as $news): ?>
					<h2> <a> <?= Html::encode("{$news->name}") ?> </a> </h2>
					<?= $news->data ?></br>
					<?= $news->shorttext ?>
			<?php endforeach; ?>

		<?= LinkPager::widget(['pagination' => $pagination]) ?>
		</p>
    </div>
</div>
