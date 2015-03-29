<?php


/**
 * Class ServiceCommand
 * Различные команды, в том числе для инициализации новых фичей
 */
class ServiceCommand extends UConsoleCommand
{
    public function actionIndex()
    {
        echo $this->getHelp();
    }

    public function actionLoadUsers($init=false)
    {
        if ($init) {
            $cnt = Users::model()->deleteAll();
            $this->profile("$cnt users deleted");
        }

        $filePath = DATA_PATH.'users.csv';
        $lines = file($filePath);
        $n = 0;
        foreach ($lines as $line) {
            $line = trim($line);
            if (!$line) continue;
            $this->delimeter();
            $parts = explode(';', $line);
            $this->log($parts[0]);

            $exists = Users::model()->countByAttributes(array('email' => $parts[0]));
            if ($exists) {
                $this->log('Exists');
                continue;
            }
            $user = new Users();
            $user->email = $parts[0];
            $user->name = $parts[1];
            $user->password = $parts[2];
            $user->role = $parts[3];
            if ($user->save()) {
                $n++;
            } else {
                $this->log($user->attributes);
                $this->log($user->getErrors());
            }
        }
        $this->log("$n users added");
        $this->endProfile();
    }
}
