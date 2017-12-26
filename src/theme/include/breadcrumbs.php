<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 24.03.2015
 */
if (!@$title) {
    if ($model) {
        $title = $model->name ? $model->name : $model->username;
    }
}
?>
<!--
    PAGE HEADER

    CLASSES:
        .page-header-xs	= 20px margins
        .page-header-md	= 50px margins
        .page-header-lg	= 80px margins
        .page-header-xlg= 130px margins
        .dark			= dark page header

        .shadow-before-1 	= shadow 1 header top
        .shadow-after-1 	= shadow 1 header bottom
        .shadow-before-2 	= shadow 2 header top
        .shadow-after-2 	= shadow 2 header bottom
        .shadow-before-3 	= shadow 3 header top
        .shadow-after-3 	= shadow 3 header bottom
-->
<section class="page-header page-header-xs" style="background: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h1><?= $title; ?></h1>

                <?php
                /**
                 * выводим доп меню для мобильных экранов
                 */
                if (Yii::$app->request->url == '/catalog') :?>

                    <div class="mobile-menu visible-xs">
                    <?= \skeeks\cms\cmsWidgets\treeMenu\TreeMenuCmsWidget::widget([
                        'namespace' => 'mobile_menu',
                        'viewFile' => '@template/widgets/TreeMenuCmsWidget/mobile-menu.php',
                        'label' => 'Мобильное меню',
                        'level' => '2',
                        'enabledRunCache' => \skeeks\cms\components\Cms::BOOL_N,
                    ]); ?>
                    </div>
            <? endif;  ?>

            </div>

            <div class="col-lg-6 col-md-6 breadCr hidden-sm hidden-xs">
                <?= \skeeks\cms\cmsWidgets\breadcrumbs\BreadcrumbsCmsWidget::widget([
                    'viewFile' => '@template/widgets/BreadcrumbsCmsWidget/default',
                ]); ?>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE HEADER -->

