<?php
/* @var $this   yii\web\View */
/* @var $widget \skeeks\cms\cmsWidgets\treeMenu\TreeMenuCmsWidget */
/* @var $model   \skeeks\cms\models\Tree */

$hasChildrens = $model->children;

// Чтобы не выводить лишнего

if (isset(\Yii::$app->cms->currentTree) && \Yii::$app->cms->currentTree ) {
    $current_id = \Yii::$app->cms->getCurrentTree()->id;
} else {
    $current_id = '';
}


?>
    <? if ($hasChildrens) : ?>
        <ul >
            <? foreach ($model->getChildren()
                            ->andWhere(['active' => $widget->active])
                            ->andWhere(['pid' => $current_id])
                            ->orderBy([$widget->orderBy => $widget->order])
                            ->all() as $childTree) : ?>
                <li>
                    <a href="<?= $childTree->url; ?>" title="<?= $childTree->name; ?>">
                        <?= $childTree->name; ?>
                    </a>
                </li>
            <? endforeach; ?>
        </ul>
    <? endif; ?>