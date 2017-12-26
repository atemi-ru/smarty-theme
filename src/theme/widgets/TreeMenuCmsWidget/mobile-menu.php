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
           <?= $this->render("_one", [
               "widget" => $widget,
                "model" => $tree,
            ]); ?>
<? endforeach; ?>
   <? endif; ?>


<?
$items[] = [
    'label' => 'Главная',
    'url' => \yii\helpers\Url::home(),
    'icon' => 'glyphicon glyphicon-home'
];


$models = \skeeks\cms\models\CmsTree::find()->where(['level' => 1])
    ->andWhere(['active' => 'Y'])
    ->all();

//$models = $widget->initActiveQuery()->level[1];
//$models = [];
//var_dump($models);

class temp_mobile_array
{
    function getChildren($model)
    {
        $tmpItems = [];
        if ($model->children)
        {
            foreach ($model->children as $child)
            {
                if ($child->active = "Y")
                {
                    $tmp = new temp_mobile_array;
                    $tmpItems[] = $tmp->getChildren($child);
                }
            }
        }

        $data = [
            'label' => $model->name,
            'url' => $model->url,
        ];

        if ($tmpItems)
        {
            $data['items'] = $tmpItems;
        }

        return $items[] = $data;
    }
}

if ($models)
{
    foreach ($models as $model)
    {
        $tmpItems = [];
        if ($model->children)
        {
            foreach ($model->children as $child)
            {
               if ($child->active = "Y")
               {
                /*    $tmpItems[] = [
                        'label' => $child->name,
                        'url' => $child->url,
                    ];
                */
                 $tmp = new temp_mobile_array;
                 $tmpItems[] = $tmp->getChildren($child);
                }
            }
        }

        $data = [
            'label' => $model->name,
            'url' => $model->url,
        ];

        if ($tmpItems)
        {
            $data['items'] = $tmpItems;
        }

        $items[] = $data;
    }
}
?>
    <div style="display: none;">


<?= \wbraganca\mmenu\Menu::widget([
    'id'    => 'mobile-menu',
    'clientOptions'    => [
        'pageScroll'    => true,
        'navbar'    => [
            'title' => 'Меню'
        ],
        'offCanvas' => [
            'position' => "right"
        ],
        'extensions' =>
            [
                'shadow-page',
                'shadow-panels',
                'pagedim-black',
                'theme-dark',
            ],
        //'dragOpen' => true,
        'drag' => [
            'page' =>
                [
                    'open' => true,
                    //'node' => 'body'
                ],
            'panels' =>
                [
                    'close' => true,
                ]
        ],
        'navbars' => [
            'position' => 'bottom',
            'content' =>
                [
                    '<a href="tel:+74995510141"><i class="glyphicon glyphicon-earphone"></i> +7 (499) 551-01-41</a>'
                ]
        ]

    ],

    'items' => $items,
]); ?>
