<?
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 06.03.2015
 */
/* @var $this \yii\web\View */
/*
*/
?>
<div class="container header-contacts">
    <div class="row">
        <div class="col-md-4  hidden-xs hidden-sm">
            <div class="sx-top-logo-block">
                <a href="<?= \yii\helpers\Url::home(); ?>">
                    <?= \skeeks\cms\cmsWidgets\text\TextCmsWidget::widget([
                        'namespace'         => 'logo-block',
                        'text'              => <<<HTML

                    <img src="<?= \frontend\assets\AppAsset::getAssetUrl('img/logos/logo.png'); ?>" alt=""/>
HTML
                        ,
                    ]); ?>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="sx-top-phone" style="font-size: 16px; padding-top: 20px; text-align: center;">
                <i class="fa fa-phone"></i>
                <?= \skeeks\cms\cmsWidgets\text\TextCmsWidget::widget([
                    'namespace' => 'header-phones',
                    'text' => <<<HTML

				<a href="tel:+74950057926" style="font-size: 21px; text-decoration: none;">(+7 495) 005-79-26</a>

HTML
                    ,
                ]); ?>
                <br/>
                <a href="#sx-callback" class="sx-fancybox" style="text-decoration: none; border-bottom: 1px dashed">Заказать
                    обратный звонок</a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 hidden-xs " style="text-align: right;">
            <div style="padding-top: 35px">
                <? if (\Yii::$app->user->isGuest) : ?>
                    <a href="<?= \skeeks\cms\helpers\UrlHelper::construct('cms/auth/login')->setCurrentRef(); ?>">
                        <i class="glyphicon glyphicon-log-in"></i> Вход
                    </a>
                <? else : ?>
                    <a href="<?= \Yii::$app->user->identity->getPageUrl('edit'); ?>">
                        <i class="fa fa-user"></i> Личный кабинет (<?= \Yii::$app->user->identity->displayName; ?>)
                    </a>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>
<!--

    AVAILABLE HEADER CLASSES


    Default nav height: 96px

    .header-md 		= 70px nav height

    .header-sm 		= 60px nav height



    .noborder 		= remove bottom border (only with transparent use)

    .transparent	= transparent header

    .translucent	= translucent header

    .sticky			= sticky header

    .static			= static header

    .dark			= dark header

    .bottom			= header on bottom



    shadow-before-1 = shadow 1 header top

    shadow-after-1 	= shadow 1 header bottom

    shadow-before-2 = shadow 2 header top

    shadow-after-2 	= shadow 2 header bottom

    shadow-before-3 = shadow 3 header top

    shadow-after-3 	= shadow 3 header bottom



    .clearfix		= required for mobile menu, do not remove!



    Example Usage:  class="clearfix sticky header-sm transparent noborder"

-->
<div id="header" class="sticky clearfix">
    <!-- TOP NAV -->
    <header id="topNav">
        <div class="container">
			<div class="sx-menu-bg">

				<div class="row">

					<div class="col-md-12 col-xs-12 clearfix">
						<div class="sx-top-logo-block pull-left visible-xs visible-sm">
							<a href="<?= \yii\helpers\Url::home(); ?>">
								<?= \skeeks\cms\cmsWidgets\text\TextCmsWidget::widget([
									'namespace'         => 'logo-block',
									'text'              => <<<HTML
									
									<img src="<?= \frontend\assets\AppAsset::getAssetUrl('img/logos/logo.png'); ?>" alt=""/>
HTML
									,
									]); ?>

							</a>
						</div>
						<div class="  ">
							<!-- Mobile Menu Button -->
							<button class="btn btn-mobile" data-toggle="" data-target="">
                                <a href="#sx-menu">
                                    <i class="fa fa-bars"></i></a>
							</button>
							<!-- BUTTONS -->
							<ul class="pull-right nav nav-pills nav-second-main">
								<!-- SEARCH -->
								<li class="user-menu visible-xs">

										<? if (\Yii::$app->user->isGuest) : ?>
										<a href="<?= \skeeks\cms\helpers\UrlHelper::construct('cms/auth/login')->setCurrentRef(); ?>">
											<i class="glyphicon glyphicon-log-in"></i> Вход
										</a>
										<? else : ?>
										<a href="<?= \Yii::$app->user->identity->getPageUrl('edit'); ?>">
											<i class="fa fa-user"></i>ЛК
										</a>
										<? endif; ?>

								</li>
								<li class="search">
									<a href="javascript:">
										<i class="fa fa-search"></i>
									</a>

                                <div class="search-box">
                                    <form action="/search" method="get">
                                        <div class="input-group">


                                            <?

                    echo \yii\jui\AutoComplete::widget([
    'name'  => \Yii::$app->cmsSearch->searchQueryParamName,
    'value' => \Yii::$app->cmsSearch->searchQuery,
    //'model'=>$searchModel,
    //'attribute' => 'name',
    'options' => [
        'class' => 'form-control',
        'type' => 'text',
        'placeholder' => 'Поиск'
    ],
    'clientOptions' => [
        'source' => \yii\helpers\Url::to(['/search/autocomplete']),
        'dataType'=>'json',
        'autoFill'=>true,
        'minLength'=>'0',
        'select' =>new \yii\web\JsExpression("function(event, ui) {
            window.location = ui.item.url;
        }"),
        'success'=>new \yii\web\JsExpression("function (data) {
            response($.map(data, function (item) {
                console.log(item.name);
                return item.name;
            }))
}"),
        ],
]);
                                            ?>

                                <span class="input-group-btn">

                                    <button class="btn btn-primary" type="submit">Найти</button>

                                </span>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <!-- /SEARCH -->
                            <?= \skeeks\cms\shop\widgets\cart\ShopCartWidget::widget([
                                'namespace' => 'ShopCartWidget-small-top',
                                'viewFile' => '@app/views/widgets/ShopCartWidget/small-top'
                            ]) ?>
                        </ul>
                        <!-- /BUTTONS -->

                        <div class="navbar-collapse pull-left nav-main-collapse collapse submenu-light">
                            <nav class="nav-main">
                                <?= \skeeks\cms\cmsWidgets\treeMenu\TreeMenuCmsWidget::widget([
                                    'namespace' => 'menu-top',
                                    'viewFile' => '@template/widgets/TreeMenuCmsWidget/menu-top.php',
                                    'label' => 'Верхнее меню',
                                    'level' => '3',
                                    'enabledRunCache' => \skeeks\cms\components\Cms::BOOL_N,
                                ]); ?>

                            </nav>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>

    </header>
    <!-- /Top Nav -->
</div>
