<?php
/**
 * AppAsset
 *
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010-2014 SkeekS (Sx)
 * @date 20.10.2014
 * @since 1.0.0
 */
namespace atemi\themes\smarty\assets;

use skeeks\template\smarty\SmartyAsset;

/**
 * Class ZoomSmartyAsset
 *
 * @package atemi\themes\smarty\assets
 */
class ZoomSmartyAsset extends SmartyAsset
{
    public $css = [];

    public $js = [
        'plugins/image.zoom/jquery.zoom.min.js',
    ];

    public $depends = [
        'atemi\themes\smarty\assets\AppAsset',
    ];
}