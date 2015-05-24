<?
class MigrateController extends UController
{
	public function filters()
	{
		return array(
//				'accessControl',
		);
	}

	public function actionIndex() {
		$runner = $this->getConsoleCommandRunner();
	    $args = array('yiic', 'migrate', '--interactive=0');
	    ob_start();
	    $runner->run($args);
	    HDev::trace(htmlentities(ob_get_clean(), null, Yii::app()->charset));
	    $this->forward('cache/flushTableSchema');
	}

	public function actionDown($amount){
		$runner = $this->getConsoleCommandRunner();
		$args = array('yiic', 'migrate', 'down', $amount, '--interactive=0');
		ob_start();
		$runner->run($args);
		echo htmlentities(ob_get_clean(), null, Yii::app()->charset);
		$this->forward('cache/flushTableSchema');
	}

	public function actionTo($mark) {
		$runner = $this->getConsoleCommandRunner();
	    $args = array('yiic', 'migrate', 'to', $mark, '--interactive=0');
	    ob_start();
	    $runner->run($args);
	    echo htmlentities(ob_get_clean(), null, Yii::app()->charset);
	    $this->forward('cache/flushTableSchema');
	}

	public function actionMark($newMark) {
		$runner = $this->getConsoleCommandRunner();
	    $args = array('yiic', 'migrate', 'mark', $newMark,'--interactive=0');
	    ob_start();
	    $runner->run($args);
	    echo htmlentities(ob_get_clean(), null, Yii::app()->charset);

	}

	public function getConsoleCommandRunner() {
		$commandPath = Yii::app()->getBasePath() . DIRECTORY_SEPARATOR . 'commands';
	    $runner = new CConsoleCommandRunner();
	    $runner->addCommands($commandPath);
	    $commandPath = Yii::getFrameworkPath() . DIRECTORY_SEPARATOR . 'cli' . DIRECTORY_SEPARATOR . 'commands';
	    $runner->addCommands($commandPath);
	    return $runner;
	}
}
