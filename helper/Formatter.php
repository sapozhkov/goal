<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 13.05.2016
 * Time: 12:27
 */

namespace app\helper;


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
    
}