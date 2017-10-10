<?php
/**
 * created by Ekilei <ekilei@rusoft.ru>
 */

/* @var $this   yii\web\View */
/* @var $widget \skeeks\cms\cmsWidgets\contentElements\ContentElementsCmsWidget */
/* @var \skeeks\cms\models\Tree $model */

?>

<? if ($model->files) : ?>
    <div class="margin-top-50">
        <h2>Прикрепленные файлы</h2>
        <div class="row">
            <ul class="col-xs-12">
                <? foreach($model->files as $file) : ?>
                    <li>
                        <img src="<?= \skeeks\cms\assets\CmsAsset::getAssetUrl('/img/icons/file.png'); ?>" />
                     <?/*   <img src="<?= \frontend\assets\TmplAsset::getAssetUrl('images/icons/file.png'); ?>" alt="<?= $file->name ?>" width="32"> */?>
                        <a href="<?= \skeeks\cms\helpers\Image::getSrc($file->src); ?>" class=""><?= $file->name ?></a>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
<? endif; ?>
