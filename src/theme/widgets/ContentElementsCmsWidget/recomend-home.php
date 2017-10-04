<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright (c) 2010 SkeekS
 * @date 04.10.2017
 */
?>
<? if ($widget->label) : ?>
    <h2 class="size-30 margin-bottom-20"><?= $widget->label; ?></h2>
<? endif; ?>
<? echo \yii\widgets\ListView::widget([
    'dataProvider' => $widget->dataProvider,
    'itemView' => 'recomend-item',
    'emptyText' => '',
    'options' =>
        [
            'class' => 'shop-item-list row list-inline nomargin recomend-slider',
            'tag' => 'div',
        ],
    'itemOptions' => [
        'tag' => false
    ],
    'layout' => "\n{items}"
]) ?>

