<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 06.03.2015
 */
use atemi\themes\smarty\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
if ($bg = \Yii::$app->request->get('bg')) {
    $this->registerCss(<<<CSS
body
{
    background: url('{$bg}') fixed center center;
}
#sx-center-wrapper
{
    box-shadow: 0px 0px 4px 1px silver;
}

CSS
    );

}
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="icon" href="/favicon.ico?v=<?= @filemtime(\Yii::getAlias('@app/web/favicon.ico')); ?>"
              type="image/x-icon"/>
        <?php $this->head() ?>
    </head>
    <body class="smoothscroll enable-animation">
    <?php $this->beginBody() ?>
    <!-- wrapper -->
    <div id="wrapper">
        <div id="sx-center-wrapper">
            <?= $this->render('@app/views/header'); ?>

            <?= $content; ?>
        </div>
        <?= $this->render('@app/views/footer'); ?>
    </div>
    <!-- /wrapper -->
    <!-- SCROLL TO TOP -->
    <a href="#" id="toTop"></a>
    <!-- PRELOADER -->
    <!--<div id="preloader">

        <div class="inner">

            <span class="loader"></span>

        </div>

    </div>--><!-- /PRELOADER -->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>