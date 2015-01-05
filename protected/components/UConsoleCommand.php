<?php
/**
 * Add log method to base CConsoleCommand
 */
abstract class UConsoleCommand extends CConsoleCommand
{
    public $startTime;
    public $time;

    protected function beforeAction($action, $params)
    {
        $this->startTime = $this->time = microtime(true);
        return parent::beforeAction($action, $params);
    }


    protected function log($message, $level = CLogger::LEVEL_INFO)
    {
        print_r($message);
        echo "\n";
        Yii::getLogger()->log($message, $level, 'command.'.$this->getName());
    }

    protected function profile($message, $level = CLogger::LEVEL_INFO)
    {
        $time = round(microtime(true) - $this->time, 2);
        print_r($message);
        echo " ($time s)\n";
        Yii::getLogger()->log($message, $level, 'command.'.$this->getName());
        $this->time = microtime(true);
    }

    protected function endProfile($level = CLogger::LEVEL_INFO)
    {
        $message = 'Done';
        $time = round(microtime(true) - $this->startTime, 2);
        print_r($message);
        echo " ($time s)\n";
        Yii::getLogger()->log($message, $level, 'command.'.$this->getName());
    }


    public function delimeter()
    {
        $this->log("\n\n====================================================================================================\n");
    }

    public function emptyLine()
    {
        $this->log("\n");
    }
}