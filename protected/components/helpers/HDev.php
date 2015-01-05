<?php 
/**
 * Класс создан для обеспечения вспомогательными методами для отладки
 */

class HDev {
	
	public static function trace($obj)
	{
		echo "<pre>";
		print_r($obj);
		echo "</pre>";
	}

	public static function silent($obj,$append=false){
		if($append){
			file_put_contents('pol_dump.txt',print_r($obj,1)."\n",FILE_APPEND);
		}else{
			file_put_contents('pol_dump.txt',print_r($obj,1)."\n");
		}
	}

    public static function log($obj,$level=CLogger::LEVEL_INFO){
        Yii::getLogger()->log(print_r($obj, true), $level, 'debug.dump');
    }

    public static function logSaveError(CModel $model)
    {
        if (defined('DEBUG_BACKTRACE_IGNORE_ARGS')) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        } else {
            $backtrace = debug_backtrace();
        }

        $class = get_class($model);
        self::log(array(
            "$class save error",
            'attrs' => $model->getAttributes(),
            'errors' => $model->getErrors(),
            'request' => Yii::app()->request->getRequestUri(),
            'file' => $backtrace[0]['file'],
            'line' => $backtrace[0]['line'],
        ), CLogger::LEVEL_ERROR);
    }
}
?>