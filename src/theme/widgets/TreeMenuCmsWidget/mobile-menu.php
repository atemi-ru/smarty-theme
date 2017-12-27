<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 25.05.2015
 */
/* @var $this   yii\web\View */
/* @var $widget \skeeks\cms\cmsWidgets\treeMenu\TreeMenuCmsWidget */
/* @var $trees  \skeeks\cms\models\Tree[] */
?>


<ul id="topMain" class="nav nav-pills nav-main">

<? if ($trees = $widget->activeQuery->all()) : ?>
<? foreach ($trees as $tree) : ?>
           <?= $this->render("_one_mob_menu", [
               "widget" => $widget,
                "model" => $tree,
            ]); ?>
<? endforeach; ?>
   <? endif; ?>
