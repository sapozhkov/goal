<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 13.05.2016
 * Time: 12:27
 */

namespace app\helper;


use yii\helpers\Html;
use yii2wikiparser\yii2wikiparser;

class Formatter extends \yii\i18n\Formatter{

    /**
     * @var yii2wikiparser|null
     */
    private $wikiParser = null;

    /**
     * @param $text
     * @return string
     */
    public function asWiki($text) {
        if ( !$this->wikiParser )
            $this->wikiParser = new yii2wikiparser();
        return $this->wikiParser->parse($text);
    }

    public function asRelativeTime($value, $referenceTime = null)
    {
        if ( $value === date('Y-m-d') )
            return \Yii::t('app', 'today');
        else
            return parent::asRelativeTime($value, $referenceTime);
    }

    /**
     * The same as asRelativeTime, but with overdue highlighting
     * @param $value
     * @param null $referenceTime
     * @return string
     */
    public function asRelativeTimeHighlight($value, $referenceTime = null)
    {
        if ( $value === date('Y-m-d') )
            return Html::tag('span', \Yii::t('app', 'today'), ['class'=>'text-warning']);
        else {
            $sOut = parent::asRelativeTime($value, $referenceTime);
            if ( $value < date('Y-m-d') )
                $sOut = Html::tag('span', $sOut, ['class'=>'text-danger']);
            return $sOut;
        }
    }

}