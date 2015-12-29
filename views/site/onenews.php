<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-onenews">
	<p class="lead">
			<h2><?= Html::encode("{$query->name}") ?></h2></br>
			<em><?= $query->data ?></br></em>
			<?= $query->longertext ?>
		</p>
</div>
