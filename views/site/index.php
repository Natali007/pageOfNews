<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Новости</h1>
	</div>		
	<p class="lead">
			<?php foreach ($allnews as $news): ?>
					<h2><a href="<?=Url::toRoute(['/site/onenews', 'id'=>$news->id]);?>"> <?= Html::encode("{$news->name}") ?> </a></h2>
					<em><?= $news->data ?></br></em>
					<?= $news->shorttext ?>
			<?php endforeach; ?>
		<?= LinkPager::widget(['pagination' => $pagination]) ?>
		</p>
</div>
