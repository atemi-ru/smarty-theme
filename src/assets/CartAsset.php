<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 21.09.2015
 */
namespace atemi\themes\smarty\assets;
/**
 * Class AppAsset
 *
 * @package frontend\assets
 */
class CartAsset extends AppAsset
{
    public $sourcePath = '@atemi/themes/smarty/assets/src';

    public $css = [];
    public $js = [
        'js/classes/Shop.js',
    ];
    public $depends = [
        '\atemi\themes\smarty\assets\AppAsset',
        '\skeeks\cms\shop\assets\ShopAsset',
    ];
}