<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 24.05.2015
 */
/* @var $this \yii\web\View */
/* @var $model \skeeks\cms\models\CmsContentElement */

use \yii\helpers\Html;
\atemi\themes\smarty\assets\OwnCarouselAsset::register($this);
\atemi\themes\smarty\assets\ZoomAsset::register($this);
\atemi\themes\smarty\assets\LightBoxAsset::register($this);
\Yii::$app->cmsToolbar->editUrl = \skeeks\cms\backend\helpers\BackendUrlHelper::createByParams(['/shop/admin-cms-content-element/update', 'pk' => $model->id])
    ->enableEmptyLayout()->url;
$this->registerJs(<<<JS

$(window).ready(function()

{



    _.delay(function()

    {

        $('.sx-thumbnail .thumbnail:first').click();

    }, 400);

});





$(".sx-fancy").on('click', function()

{

    var href = $(this).attr('href');

    $(".sx-fancybox-gallary[href='" + href + "']").click();

    return false;

});



new sx.classes.OwnCarousel({

	'jsquerySelector' : '.owl-carousel'

});

new sx.classes.Zoom({

	'jsquerySelector' : '.zoom'

});

/*new sx.classes.LightBox({

	'jsquerySelector' : '.lightbox'

});*/





JS
);
$shopCmsContentElement = new \skeeks\cms\shop\models\ShopCmsContentElement($model->toArray());
$shopProduct = \skeeks\cms\shop\models\ShopProduct::getInstanceByContentElement($model);
$product = \common\models\Moto::instance($model);
$shopProduct->createNewView();
?>

<?= $this->render('@template/include/breadcrumbs', [
    'model' => $model
]) ?>
<!-- Product page -->
<section class="padding-xxs">
    <div class="container">
        <div class="row">
            <!-- LEFT -->
            <div class="col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">
                <div class="row">
                    <!-- IMAGE -->
                    <div class="col-lg-6 col-sm-6 sx-product-images">
                        <div class="thumbnail relative margin-bottom-3">
                            <!--

                                IMAGE ZOOM



                                data-mode="mouseover|grab|click|toggle"

                            -->
                            <figure id="zoom-primary" class="zoom" data-mode="mouseover"
                                    style="position: relative; overflow: hidden;">
                                <!--

                                    zoom buttton



                                    positions available:

                                        .bottom-right

                                        .bottom-left

                                        .top-right

                                        .top-left

                                -->
                                <a class="lightbox sx-fancy bottom-right " title="<?= $model->image->name; ?>"
                                   href="<?= \Yii::$app->imaging->thumbnailUrlOnRequest($model->image->src,
                                       new \common\thumbnails\MediumWatermark(), $model->code
                                   ) ?>" data-plugin-options='{"type":"image"}'>
                                    <i class="glyphicon glyphicon-search"></i>
                                </a>
                                <!--

                                    image



                                    Extra: add .image-bw class to force black and white!

                                -->
                                <a class="sx-fancybox-gallary" style="display: none;" data-fancybox-group="gallery"
                                   href="<?= $model->image->src; ?>" title="<?= $model->image->name; ?>"></a>
                                <img src="/img/loader/loader-2.GIF" class="img-responsive sx-lazy"
                                     data-original="<?= $model->image->src ?>" title="<?= $model->name; ?>"
                                     alt="<?= $model->name; ?>" width="1200">
                            </figure>
                        </div>
                        <? $gallery = [$model->image]; ?>

                        <? if ($model->images) {
                            $gallery = array_merge($gallery, $model->images);

                        }
                        ?>



                        <? if ($gallery) : ?>
                            <!-- Thumbnails (required height:100px) -->
                            <div data-for="zoom-primary"
                                 class="zoom-more owl-carousel owl-padding-3 featured sx-thumbnail"
                                 data-plugin-options='{"singleItem": false, "autoPlay": false, "navigation": true, "pagination": false, "items": 4, "progressBar":"false"}'
                                 style="opacity: 1; display: block;">
                                <? foreach ($gallery as $image) : ?>
                                    <a class="sx-fancybox-gallary" style="display: none;" data-fancybox-group="gallery"
                                       href="<?= $image->src; ?>" title="<?= $image->name; ?>"></a>
                                    <a class="thumbnail" href="<?= $image->src; ?>" title="<?= $image->name; ?>">
                                        <img src="/img/loader/loader-2.GIF"
                                             data-original="<?= \Yii::$app->imaging->thumbnailUrlOnRequest($image->src,
                                                 new \skeeks\cms\components\imaging\filters\Thumbnail([
                                                     'h' => 100,
                                                     'w' => 0,
                                                 ])
                                             ) ?>" class="sx-lazy" height="100" alt="<?= $image->name; ?>"
                                             title="<?= $image->name; ?>" style="min-height: 100px">
                                    </a>
                                <? endforeach; ?>
                            </div>
                            <!-- /Thumbnails -->
                        <? endif; ?>
                    </div>
                    <!-- /IMAGE -->
                    <!-- ITEM DESC -->
                    <div class="col-lg-6 col-sm-6">
                        <? \skeeks\cms\modules\admin\widgets\Pjax::begin(); ?>



                        <?
                        $offer = null;
                        $offerId = \Yii::$app->request->get('sx-offer');
                        if (!$offerId) {
                            if ($shopCmsContentElement->tradeOffers) {
                                $offer = array_shift($shopCmsContentElement->tradeOffers);
                                $offerId = $offer->id;

                            }

                        }
                        if ($offerId) {
                            /**
                             * @var $offer \skeeks\cms\shop\models\ShopCmsContentElement
                             */
                            $offer = \skeeks\cms\shop\models\ShopCmsContentElement::findOne($offerId);

                        }
                        ?>



                        <?
                        $this->registerJs(<<<JS

	(function(sx, $, _)

	{



		sx.classes.Order = sx.classes.Component.extend({



			_init: function()

			{



			},



			_onDomReady: function()

			{



				var self = this;

				this.jForm = $("form.offers-form");

				$("select", this.jForm).on('change', function()

				{

					self.jForm.submit();

				});

/*				$(".sx-add-to-cart").on('click', function()

				{

					var offer = $("input:checked", self.jForm).val();

					sx.Shop.addProduct(offer, $('#prod-quantity').val());



					$('#btnAddToCart').hide();

					$('#btnInTheBasket').show();

				});*/

			}

		});







		new sx.classes.Order();

	})(sx, sx.$, sx._);

JS
                        )
                        ?>
                        <!-- price -->
                        <div class="shop-item-price">
                            <? if ($offer) : ?>
                                <? if ($offer->shopProduct->minProductPrice->id == $offer->shopProduct->baseProductPrice->id) : ?>

                                    <?= \Yii::$app->money->convertAndFormat($offer->shopProduct->minProductPrice->money); ?>
                                <? else : ?>
                                    <span
                                        class="line-through nopadding-left"><?= \Yii::$app->money->convertAndFormat($offer->shopProduct->baseProductPrice->money); ?></span>
                                    <div
                                        class="sx-discount-price"><?= \Yii::$app->money->convertAndFormat($offer->shopProduct->minProductPrice->money); ?></div>
                                <? endif; ?>
                            <? else : ?>
                                <? if ($shopProduct->minProductPrice->id == $shopProduct->baseProductPrice->id) : ?>

                                    <?= \Yii::$app->money->convertAndFormat($shopProduct->minProductPrice->money); ?>
                                <? else : ?>
                                    <span
                                        class="line-through nopadding-left"><?= \Yii::$app->money->convertAndFormat($shopProduct->baseProductPrice->money); ?></span>
                                    <div
                                        class="sx-discount-price"><?= \Yii::$app->money->convertAndFormat($shopProduct->minProductPrice->money); ?></div>
                                <? endif; ?>
                            <? endif; ?>
                        </div>
                        <!-- /price -->
                        <hr class="hidden-xs">
                        <div class="clearfix margin-bottom-30">
                            <? if ($model->description_short) : ?>
                                <p><?= $model->description_short; ?></p>
                                <hr class="hidden-xs">
                            <? endif; ?>



                            <?
                            $brand = null;
                            $brandId = $model->relatedPropertiesModel->getAttribute('brand');
                            if ($brandId) {
                                $brand = \skeeks\cms\models\CmsContentElement::findOne($brandId);

                            }
                            ?>

                            <? if ($brand && $brand->image) : ?>
                                <span class="pull-right text-danger"><img src="<?= $brand->image->src ?>"
                                                                          style="max-height: 80px; max-width: 180px;"></span>
                            <? endif; ?>
                            <? $widget = \skeeks\cms\rpViewWidget\RpViewWidget::beginWidget('product-properties', [
                                'model' => $model,
                                'visible_properties' => ['stockSaleId', 'country','barcode'],
                                'visible_only_has_values' => true,
                                //'viewFile' => '@app/views/your-file',
                            ]); ?>
                                <?/* $widget->viewFile = '@app/views/modules/cms/content-element/_product-properties';*/?>
                            <? \skeeks\cms\rpViewWidget\RpViewWidget::end(); ?>
                            <?
                            if($tmp = $model->relatedPropertiesModel->getAttribute('weight'))
                            {
                                echo Html::tag('p',Html::tag('strong','Вес:')." $tmp кг");
                            }

                            if($tmp = $model->relatedPropertiesModel->getAttribute('amount'))
                            {
                                echo Html::tag('p',Html::tag('strong','Объём:')." $tmp м3");
                            }

                            if($file = $model->relatedPropertiesModel->getAttribute('file'))
                            {
                                echo Html::a('Скачать',$file);
                            }
                            ?>
                        </div>
                        <hr class="hidden-xs">
                        <? if ($shopCmsContentElement->shopProduct->product_type == \skeeks\cms\shop\models\ShopProduct::TYPE_OFFERS) : ?>
                            <form class="offers-form form" data-pjax>
                                <label>Размер и цвет: </label>
                                <?
                                $selectData = [];
                                foreach ($shopCmsContentElement->tradeOffers as $offerChild) {
                                    if ($offerChild->shopProduct->quantity > 0) {
                                        $color = trim($offerChild->relatedPropertiesModel->getSmartAttribute('color'));
                                        $selectData[$offerChild->id] = $offerChild->relatedPropertiesModel->getSmartAttribute('size') . ($color ? " - " . $color : "");

                                    }

                                }
                                ?>







                                <? if ($selectData) : ?>

                                    <?= \yii\helpers\Html::listBox('sx-offer', $offer->shopProduct->id, $selectData, [
                                        'size' => 1,
                                        'id' => 'sx-offer'
                                    ]); ?>
                                    <a class="btn btn-default btn-primary product-add-cart noradius" href="#"
                                       onclick="sx.Shop.addProduct($('#sx-offer').val(), 1); return false;"><i
                                            class="fa fa-cart-plus"></i> В корзину</a>
                                    <br class="hidden-xs">
                                    <p><a href="/size" target="_blank" data-pjax="0">Как выбрать размер?</a></p>
                                    <br class="hidden-xs">
                                <? else: ?>
                                    <p style="color:red;">Товара нет в наличии</p>
                                <? endif; ?>
                            </form>
                        <? else : ?>
                            <a class="btn btn-default btn-primary btn-lg product-add-cart noradius" href="#"
                               onclick="sx.Shop.addProduct(<?= $model->id; ?>, 1); return false;"><i
                                    class="fa fa-cart-plus"></i> В корзину</a><br class="hidden-xs"><br class="hidden-xs">
                        <? endif; ?>
                        <!--<hr>



                        <div class="">



                            <? /*=

                                \kartik\rating\StarRating::widget(\yii\helpers\ArrayHelper::merge([

                                        'name' => 'rating_1',

                                        'value' => (float) $model->relatedPropertiesModel->getAttribute('reviews2_rating'),

                                        'pluginOptions' => [

                                            'disabled'  => true,

                                            'showClear' => false,

                                            'size'      => 'sm',

                                            'clearCaption' => (int) $model->relatedPropertiesModel->getAttribute('reviews2_count') . ' отзывов',

                                            'starCaptions' =>

                                            [

                                                1 => 'Отзывов: ' . (int) $model->relatedPropertiesModel->getAttribute('reviews2_count'),

                                                2 => 'Отзывов: ' . (int) $model->relatedPropertiesModel->getAttribute('reviews2_count'),

                                                3 => 'Отзывов: ' . (int) $model->relatedPropertiesModel->getAttribute('reviews2_count'),

                                                4 => 'Отзывов: ' . (int) $model->relatedPropertiesModel->getAttribute('reviews2_count'),

                                                5 => 'Отзывов: ' . (int) $model->relatedPropertiesModel->getAttribute('reviews2_count'),

                                            ]

                                        ]

                                    ], (array) $options));

                            */ ?>

                        </div>-->
                        <hr class="hidden-xs">
                        <!-- Share -->
                        <div class="pull-right">
                            <?
                            if ($model->image) {
                                $this->registerMetaTag([
                                    'property' => 'og:image',
                                    'content' => $model->image->src
                                ]);

                            }
                            if ($model->description_full) {
                                $this->registerMetaTag([
                                    'property' => 'og:description',
                                    'content' => $model->description_full
                                ]);

                            }
                            $this->registerMetaTag([
                                'property' => 'og:title',
                                'content' => $model->name
                            ]);
                            ?>



                            <?= \skeeks\cms\yandex\share\widget\YaShareWidget::widget([
                                'namespace' => 'YaShareWidget-main'
                            ]); ?>
                        </div>
                        <!-- /Share -->
                        <? \skeeks\cms\modules\admin\widgets\Pjax::end(); ?>
                    </div>
                    <!-- /ITEM DESC -->
                </div>
                <hr class="hidden-xs">
                <?= \skeeks\cms\reviews2\widgets\reviews2\Reviews2Widget::widget([
                    'viewFile'                  => '@app/views/widgets/Reviews2Widget/package',
                    'namespace'                 => 'Reviews2Widget-product',
                    'cmsContentElement'         => $model,
                ]); ?>
                <hr class="hidden-xs">
                <?= \skeeks\cms\cmsWidgets\contentElements\ContentElementsCmsWidget::widget([
                    'contentElementClass' => \skeeks\cms\shop\models\ShopCmsContentElement::className(),
                    'namespace' => 'ContentElementsCmsWidget-sameProducts',
                    'viewFile' => '@app/views/widgets/ContentElementsCmsWidget/sameProducts',
                    'label' => 'Похожие товары',
                    'enabledCurrentTree' => "N",
                    'tree_ids' => \yii\helpers\ArrayHelper::map($model->cmsTree->parent->children, 'id', 'id'),
                    'limit' => 10,
                    'activeQueryCallback' => function (\yii\db\ActiveQuery $query) use ($model) {
                        $query->andWhere(['!=', \skeeks\cms\models\CmsContentElement::tableName() . ".id", $model->id]);
                        $query->leftJoin('cms_content_element_property', '`cms_content_element_property`.`element_id` = `cms_content_element`.`id`');
                        $query->with('shopProduct');
                        $query->with('shopProduct.baseProductPrice');
                        $query->with('shopProduct.minProductPrice');

                        //$query->with('shopProduct.baseProductPrice');
                    }
                ]); ?>
                <hr class="hidden-xs">
                <?= \skeeks\cms\cmsWidgets\contentElements\ContentElementsCmsWidget::widget([
                    'contentElementClass' => \skeeks\cms\shop\models\ShopCmsContentElement::className(),
                    'namespace' => 'ContentElementsCmsWidget-VisitedProducts',
                    'viewFile' => '@app/views/widgets/ContentElementsCmsWidget/sameProducts',
                    'label' => 'Просмотренные товары',
                    'limit' => 6,
                    'enabledCurrentTree' => false,
                    'dataProviderCallback' => function (\yii\data\ActiveDataProvider $activeDataProvider) use ($model) {
                        /**
                         * @var $query \yii\db\ActiveQuery
                         */
                        $query = $activeDataProvider->query;
                        $query->andWhere(['!=', \skeeks\cms\models\CmsContentElement::tableName() . ".id", $model->id]);
                        $query->joinWith('shopProduct');
                        $query->joinWith('shopProduct.shopViewedProducts as vp');
                        $query->with('shopProduct');
                        $query->with('shopProduct.baseProductPrice');
                        $query->with('shopProduct.minProductPrice');
                        $query->andWhere(['vp.shop_fuser_id' => \Yii::$app->shop->shopFuser->id]);
                        $query->orderBy(['vp.created_at' => SORT_DESC]);
                    }
                ]); ?>
            </div>
            <!-- LEFT -->
            <div class="col-lg-3 col-md-3 col-sm-3 col-lg-pull-9 col-md-pull-9 col-sm-pull-9 hidden-xs"
                 style="border: 1px solid rgba(192, 192, 192, 0.35);">
                <!-- CATEGORIES -->
                <div class="side-nav margin-bottom-20 margin-top-10">
                    <?= \common\widgets\LeftMenu::widget([
                        'tree' => $model->cmsTree
                    ]); ?>
                </div>
                <!--<div class="side-nav margin-bottom-20">



                    <? /*= \skeeks\cms\cmsWidgets\contentElements\ContentElementsCmsWidget::widget([

                        'contentElementClass' => \skeeks\cms\shop\models\ShopCmsContentElement::className(),

                        'namespace'         => 'ContentElementsCmsWidget-catalog-main-left-1',

                        'viewFile' 	        => '@app/views/widgets/ContentElementsCmsWidget/visitedProducts',

                        'label'             => 'Спецпредложения',

                        'pageSize'          => 5,

                        'enabledCurrentTree'=> \skeeks\cms\components\Cms::BOOL_N,

                        'dataProviderCallback' 	=> function(\yii\data\ActiveDataProvider $activeDataProvider) use ($model) {

                            $query = $activeDataProvider->query;



                            $query->with('shopProduct');

                            $query->with('shopProduct.baseProductPrice');

                            $query->with('shopProduct.minProductPrice');

                        }

                    ])*/ ?>



                    <p></p>

                </div>-->
                <!--<div class="side-nav margin-bottom-20">



                    <h2 class="owl-featured">Мы в социальных сетях</h2>



                    <? /*= \skeeks\cms\vk\community\VkCommunityWidget::widget([

                        'namespace' => 'VkCommunityWidget-moto',

                        'apiId'     => 72101610

                    ]); */ ?>



                    <p></p>



                </div>-->
            </div>
        </div>
    </div>
</section>







