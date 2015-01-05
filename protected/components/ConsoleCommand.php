<?php

class ConsoleCommand extends CConsoleCommand
{
    protected $pidFile = null;

    protected function getPidFile()
    {
        if ($this->pidFile === null) {
            $class = get_called_class();
            $this->pidFile = Yii::getPathOfAlias('application.runtime').DIRECTORY_SEPARATOR.$class.'.pid';
        }

        return $this->pidFile;
    }
    
    protected function isAnotherInstanceRunning()
    {
        $pidFile = $this->getPidFile();

        if (!file_exists($pidFile)) {
            return false;
        }

        $pid = file_get_contents($pidFile);
        return ConsoleHelper::isPidAlive($pid);
    }

    protected function saveMyPid()
    {
        $pidFile = $this->getPidFile();
        file_put_contents($pidFile, getmypid());
    }

    protected function checkForAnotherInstance()
    {
        if ($this->isAnotherInstanceRunning()) {
            Yii::app()->end();
            return;
        }

        $this->saveMyPid();
    }

}