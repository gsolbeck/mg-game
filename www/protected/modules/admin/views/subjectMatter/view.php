<?php

$this->breadcrumbs = array(
  Yii::t('app', 'Admin')=>array('/admin'),
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
if ($admin) {
    $this->menu[] = array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'));
    $this->menu[] = array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id));
    $this->menu[] = array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(),
        'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?'),
        'visible' => !($model->hasAttribute("locked") && $model->locked));
}
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'cssFile' => Yii::app()->request->baseUrl . "/css/yii/detailview/styles.css",
  'attributes' => array(
'id',
'name',
		 array(
          'name' => 'locked',
          'type' => 'raw',
          'value' => MGHelper::itemAlias('locked',$model->locked),
        ),
'created',
'modified',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('collections')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	
	if (count($model->collections) == 0) {
    echo "<li>no item(s) assigned</li>";
  }
  
	foreach($model->collections as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('collection/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>