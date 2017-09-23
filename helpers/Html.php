<?php
/**
 * @link http://www.linchpinstudios.com/
 * @copyright Copyright (c) 2014 Linchpin Studios LLC
 * @license http://opensource.org/licenses/MIT
 */

namespace linchpinstudios\filemanager\helpers;

use Yii;
use yii\web\ErrorHandler;
use yii\helpers\ArrayHelper;
use linchpinstudios\filemanager\models\Files;
use linchpinstudios\filemanager\models\FileTag;


/**
 * @author Josh Hagel <joshhagel@linchpinstudios.com>
 * @since 0.1
 */

 class Html extends \yii\helpers\Html
 {

    /**
     * run function.
     *
     * @access public
     * @return string
     */
    public static function FileOutput($id = 0, $options = [], $urlOnly = false, $thumbnail = false)
    {

        $awsConfig  = \Yii::$app->getModule('filemanager')->aws;

        $url        = \Yii::$app->getModule('filemanager')->url;

        $path       = \Yii::$app->getModule('filemanager')->path;

        $terms      = [];

        $file = Files::findOne($id);

        if(!$file){
            return null;
        }

        if( !empty($file->fileTerms) ) {
            foreach ($file->fileTerms as $v) {
                $terms[$v->type] = $v->value;
            }
        }

        $options = ArrayHelper::merge( $options, $terms );

        if($thumbnail){
            if($urlOnly){
                $return = $url.$file->thumbnail_url;
            }else{
                $return = Html::img($url.$file->thumbnail_url,$options);
            }
        }else{
            if($urlOnly){
                $return = $url.$file->url;
            }else{
                $return = Html::img($url.$file->url,$options);
            }
        }

        return $return;
    }



    public static function TagFirstFileOutput( $id = 0, $options = [], $urlOnly = false )
    {

        $awsConfig  = \Yii::$app->getModule('filemanager')->aws;

        $url        = \Yii::$app->getModule('filemanager')->url;

        $path       = \Yii::$app->getModule('filemanager')->path;

        $fileTag = FileTag::findOne($id);

        if ( !$fileTag ) {
            return null;
        }

        if ( !isset($fileTag->firstfile[0]) ) {
            return null;
        }

        if ( $urlOnly ) {
            $return = $url.$fileTag->firstfile[0]->url;
        } else {
            $return = Html::img( $url.$fileTag->firstfile[0]->url, $options );
        }

        return $return;

    }






    /**
     * FileTerms function.
     *
     * @access public
     * @static
     * @param int $id (default: 0)
     * @return array
     */
    public static function FileTerms($id = 0)
    {

        $file  = Files::findOne($id);

        $terms = [];

        if( !empty($file->fileTerms) ) {
            foreach ($file->fileTerms as $v) {
                $terms[$v->type] = $v->value;
            }
        }

        return $terms;

    }

 }
