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
	<!---actionIndex() передает объекта Pagination(используется во view для отображения пагинатора, состоящего из набора кнопок с номерами страниц
		перебираем в цыкле полученный массив $allnews выводим на экран название новости, дату и описание-->
			<?php foreach ($allnews as $news): ?>
			<!--- Метод Url::toRoute создает URL для указанного маршрута. Также передаем значение id новости-->
					<h2><a href="<?=Url::toRoute(['/site/onenews', 'id'=>$news->id]);?>"> <?= Html::encode("{$news->name}") ?> </a></h2>
					<em><?= $news->data ?></br></em>
					<?= $news->shorttext ?>
			<?php endforeach; ?>
		<?= LinkPager::widget(['pagination' => $pagination]) ?> 
		<!--- Виджет LinkPager отображает набор постраничных кнопок -->
		</p>
</div>
