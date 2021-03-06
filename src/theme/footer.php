<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 06.03.2015
 */
/* @var $this \yii\web\View */
?>
<!-- FOOTER -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12 footer-col">
                <?= \skeeks\cms\cmsWidgets\text\TextCmsWidget::widget([
                    'namespace' => 'text-footer-left',
                    'text' => <<<HTML
				<!-- Footer Logo -->
				<div class="fo4">О нас</div>

				<!-- Small Description -->
				<p>atemi.ru</p>
				<p>Магазин брендовой одежды</p>

				<!-- Contact Address -->
				<address style="margin-top: 5px;">
					<a href="tel:+74951234567" style="font-size: 21px; text-decoration: none;">(+7 495) 123-45-67</a>
					<p>
						<a href="#sx-callback" class="sx-fancybox" style="text-decoration: none; border-bottom: 1px dashed">Заказать обратный звонок</a>
					</p>

				</address>
				<!-- /Contact Address -->

				 

				<a href="http://vk.com/skeeks_com" target="_blank" class="social-icon social-icon-border social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Vkontakte">

					<i class="icon-vk"></i>
					<i class="icon-vk"></i>
				</a>
				<a href="https://www.facebook.com/skeekscom" target="_blank" class="social-icon social-icon-border social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Vkontakte">

					<i class="icon-facebook"></i>
					<i class="icon-facebook"></i>
				</a>
HTML
                    ,
                ]); ?>
            </div>
            <div class="col-md-3 col-sm-6  col-sm-12  footer-col hidden-xs">
                <? /*= \skeeks\cms\cmsWidgets\contentElements\ContentElementsCmsWidget::widget([
					'namespace'         => 'ContentElementsCmsWidget-footer',
					'viewFile'          => '@template/widgets/ContentElementsCmsWidget/articles-footer',
					'label'             => 'Новости и статьи',
					'enabledCurrentTree'=> \skeeks\cms\components\Cms::BOOL_N,
					'limit'             => 4,
				])*/ ?>

                <?= \skeeks\cms\cmsWidgets\treeMenu\TreeMenuCmsWidget::widget([
                    'namespace' => 'menu-footer-3',
                    'viewFile' => '@template/widgets/TreeMenuCmsWidget/menu-footer.php',
                    'label' => 'Каталог',
                    'level' => '1',
                ]); ?>
            </div>
            <div class="col-md-2 col-sm-6  col-sm-12  footer-col hidden-xs">
                <?= \skeeks\cms\cmsWidgets\treeMenu\TreeMenuCmsWidget::widget([
                    'namespace' => 'menu-footer-2',
                    'viewFile' => '@template/widgets/TreeMenuCmsWidget/menu-footer.php',
                    'label' => 'Меню',
                    'level' => '1',
                ]); ?>
            </div>
            <div class="col-md-4 col-sm-6  col-xs-12  footer-col">
                <h4 class="letter-spacing-1">Обратная связь</h4>

                <div class="sx-feedback-wrapper" id="sx-feedback">
                    <?
                    $this->registerCss(<<<CSS
.sx-feedback-wrapper form
{
	margin-bottom: 0px;
}

#footer .sx-feedback-wrapper form input, #footer .sx-feedback-wrapper form textarea
{
	background: white;
}
#footer .sx-feedback-wrapper form textarea
{
	height: 80px;
}
CSS
                    )
                    ?>
                    <?= \skeeks\modules\cms\form2\cmsWidgets\form2\FormWidget::widget([
                        'namespace' => 'FormWidget-feedback-all',
                        'form_code' => 'feedback',
                        'viewFile' => 'whith-messages',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <ul class="pull-right nomargin list-inline mobile-block">
                <li><a href="//rusoft.ru" title="Русофт">Разработка сайта</a>
                    <img src="<?= \atemi\themes\smarty\assets\AppAsset::getAssetUrl('img/rusoft_logo.png')?>" alt="Разработка сайта — RUsoft.ru"> — RuSoft.ru

                </li>
            </ul>
            <?= \skeeks\cms\cmsWidgets\text\TextCmsWidget::widget([
                'namespace' => 'text-footer-rights',
                'text' => <<<HTML
				&copy; Все права защищены, SkeekS CMS - SHOP 2017
HTML
                ,
            ]); ?>
        </div>
    </div>
</footer>
<!-- /FOOTER -->
<div style="display: none;">
    <?= \Yii::$app->seo->countersContent; ?>
    <div id="sx-callback">
        <h2>Обратный звонок</h2>

        <p>Оставьте ваш номер телефона и мы вам перезвоним.</p>
        <?= \skeeks\modules\cms\form2\cmsWidgets\form2\FormWidget::widget([
            'namespace' => 'FormWidget-all',
            'form_code' => 'callback',
            'viewFile' => 'whith-messages',
        ]) ?>
    </div>
</div>