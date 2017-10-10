<?php
/**
 * created by Ekilei <ekilei@rusoft.ru>
 */

/* @var $this   yii\web\View */
/* @var $widget \skeeks\cms\cmsWidgets\contentElements\ContentElementsCmsWidget */
/* @var \skeeks\cms\models\Tree $model */
?>

<? if ($model->images) : ?>
    <div class="text-gallery nav-top animate-hover-slide margin-top-10">
        <h2>Фотогалерея</h2>
        <div class="row grid gallery-grid gallery-slider" id="cat-gal-slider">
            <? foreach($model->images as $image) : ?>
                <div class="grid-item col-xs-12">
                    <a href="<?= \skeeks\cms\helpers\Image::getSrc($image->src); ?>" class="gallery-grid-img  zoom sx-fancybox">
                        <img src="<?= \Yii::$app->imaging->getImagingUrl($image->src,
                            new \skeeks\cms\components\imaging\filters\Thumbnail([
                                'w'    => 0,
                                'h'    => 175
                            ])
                        ) ?>" alt="<?= $image->name ?>" class="img-responsive">
                    </a>
                </div>
            <? endforeach; ?>
        </div>
    </div>
<? endif; ?>
