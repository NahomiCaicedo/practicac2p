<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace yii\bootstrap5;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * NavBar renders a navbar HTML component.
 *
 * Any content enclosed between the [[begin()]] and [[end()]] calls of NavBar
 * is treated as the content of the navbar. You may use widgets such as [[Nav]]
 * or [[\yii\widgets\Menu]] to build up such content. For example,
 *
 * ```php
 * use yii\bootstrap5\NavBar;
 * use yii\bootstrap5\Nav;
 *
 * NavBar::begin(['brandLabel' => 'NavBar Test']);
 * echo Nav::widget([
 *     'items' => [
 *         ['label' => 'Home', 'url' => ['/site/index']],
 *         ['label' => 'About', 'url' => ['/site/about']],
 *     ],
 *     'options' => ['class' => 'navbar-nav'],
 * ]);
 * NavBar::end();
 * ```
 *
 * @property-write array $containerOptions
 *
 * @see https://getbootstrap.com/docs/5.1/components/navbar/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class NavBar extends Widget
{
    /**
     * @var array the HTML attributes for the widget container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "nav", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];
    /**
     * @var array|bool the HTML attributes for the collapse container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $collapseOptions = [];
    /**
     * @var array|bool the HTML attributes for the offcanvas container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $offcanvasOptions = false;
    /**
     * @var string|bool the text of the brand or false if it's not used. Note that this is not HTML-encoded.
     * @see https://getbootstrap.com/docs/5.1/components/navbar/
     */
    public $brandLabel = false;
    /**
     * @var string|bool src of the brand image or false if it's not used. Note that this param will override `$this->brandLabel` param.
     * @see https://getbootstrap.com/docs/5.1/components/navbar/
     * @since 2.0.8
     */
    public $brandImage = false;

    /**
     * @var array the HTML attributes of the brand image.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $brandImageOptions = [];
    /**
     * @var array|string|bool the URL for the brand's hyperlink tag. This parameter will be processed by [[\yii\helpers\Url::to()]]
     * and will be used for the "href" attribute of the brand link. Default value is false that means
     * [[\yii\web\Application::homeUrl]] will be used.
     * You may set it to `null` if you want to have no link at all.
     */
    public $brandUrl = false;
    /**
     * @var array the HTML attributes of the brand link.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $brandOptions = [];
    /**
     * @var string text to show for screen readers for the button to toggle the navbar.
     */
    public $screenReaderToggleText;
    /**
     * @var string the toggle button content. Defaults to bootstrap 5 default `<span class="navbar-toggler-icon"></span>`
     */
    public $togglerContent = '<span class="navbar-toggler-icon"></span>';
    /**
     * @var array the HTML attributes of the navbar toggler button.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $togglerOptions = [];
    /**
     * @var bool whether the navbar content should be included in an inner div container which by default
     * adds left and right padding. Set this to false for a 100% width navbar.
     */
    public $renderInnerContainer = true;
    /**
     * @var array the HTML attributes of the inner container.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $innerContainerOptions = [];
    public $clientOptions = [];


    public function init(): void
    {
        parent::init();
        if (!isset($this->options['class']) || empty($this->options['class'])) {
            Html::addCssClass($this->options, [
                'widget' => 'navbar',
                'toggle' => 'navbar-expand-lg',
                'navbar-light',
                'bg-light',
            ]);
        } else {
            Html::addCssClass($this->options, [
                'widget' => 'navbar',
            ]);
        }
        $navOptions = $this->options;
        $navTag = ArrayHelper::remove($navOptions, 'tag', 'nav');
        $brand = '';
        if (!isset($this->innerContainerOptions['class'])) {
            Html::addCssClass($this->innerContainerOptions, [
                'panel' => 'container',
            ]);
        }
        if ($this->collapseOptions !== false && !isset($this->collapseOptions['id'])) {
            $this->collapseOptions['id'] = "{$this->options['id']}-collapse";
        } elseif ($this->offcanvasOptions !== false && !isset($this->offcanvasOptions['id'])) {
            $this->offcanvasOptions['id'] = "{$this->options['id']}-offcanvas";
        }
        if ($this->brandImage !== false) {
            $this->brandLabel = Html::img($this->brandImage, $this->brandImageOptions);
        }
        if ($this->brandLabel !== false) {
            Html::addCssClass($this->brandOptions, [
                'widget' => 'navbar-brand',
            ]);
            if ($this->brandUrl === null) {
                $brand = Html::tag('span', $this->brandLabel, $this->brandOptions);
            } else {
                $brand = Html::a(
                    $this->brandLabel,
                    $this->brandUrl === false ? Yii::$app->homeUrl : $this->brandUrl,
                    $this->brandOptions,
                );
            }
        }

        ob_start();

        echo Html::beginTag($navTag, $navOptions) . "\n";
        if ($this->renderInnerContainer) {
            echo Html::beginTag('div', $this->innerContainerOptions) . "\n";
        }
        echo $brand . "\n";
        echo $this->renderToggleButton() . "\n";
        if ($this->collapseOptions !== false) {
            Html::addCssClass($this->collapseOptions, [
                'collapse' => 'collapse',
                'widget' => 'navbar-collapse',
            ]);
            $collapseOptions = $this->collapseOptions;
            $collapseTag = ArrayHelper::remove($collapseOptions, 'tag', 'div');
            echo Html::beginTag($collapseTag, $collapseOptions) . "\n";
        } elseif ($this->offcanvasOptions !== false) {
            Offcanvas::begin($this->offcanvasOptions);
        }
    }

    /**
     * Renders the widget.
     */
    public function run(): string
    {
        if ($this->collapseOptions !== false) {
            $tag = ArrayHelper::remove($this->collapseOptions, 'tag', 'div');
            echo Html::endTag($tag) . "\n";
        } elseif ($this->offcanvasOptions !== false) {
            Offcanvas::end();
        }
        $content = ob_get_clean();
        if ($this->renderInnerContainer) {
            $content .= Html::endTag('div') . "\n";
        }
        $tag = ArrayHelper::remove($this->options, 'tag', 'nav');
        $content .= Html::endTag($tag);
        BootstrapPluginAsset::register($this->getView());

        return $content;
    }

    /**
     * Container options setter for backwards compatibility
     * @deprecated
     */
    public function setContainerOptions(array $collapseOptions): void
    {
        $this->collapseOptions = $collapseOptions;
    }

    /**
     * Renders collapsible toggle button.
     * @return string the rendering toggle button.
     */
    protected function renderToggleButton(): string
    {
        if ($this->collapseOptions === false && $this->offcanvasOptions === false) {
            return '';
        }

        $options = $this->togglerOptions;
        Html::addCssClass($options, [
            'widget' => 'navbar-toggler',
        ]);
        if ($this->offcanvasOptions !== false) {
            $bsData = [
                'bs-toggle' => 'offcanvas',
                'bs-target' => '#' . $this->offcanvasOptions['id'],
            ];
            $aria = $this->offcanvasOptions['id'];
        } elseif ($this->collapseOptions !== false) {
            $bsData = [
                'bs-toggle' => 'collapse',
                'bs-target' => '#' . $this->collapseOptions['id'],
            ];
            $aria = $this->collapseOptions['id'];
        }

        return Html::button(
            $this->togglerContent,
            ArrayHelper::merge($options, [
                'type' => 'button',
                'data' => $bsData,
                'aria' => [
                    'controls' => $aria,
                    'expanded' => 'false',
                    'label' => $this->screenReaderToggleText ?: Yii::t('yii/bootstrap5', 'Toggle navigation'),
                ],
            ]),
        );
    }
}
