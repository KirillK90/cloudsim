<?
class CacheController extends UController
{
	public function filters()
	{
		return array(
//				'accessControl',
		);
	}

	public function actionFlush($app = '') {
        if (!$this->getUser()->isAdmin()) {
            throw new CHttpException(403);
        }
        $cache = Yii::app()->cache;

        echo "Очистка кэша... ";
        if ($cache->flush()) {
            echo "Успешно";
        } else {
            echo "Ошибка";
        }
        Yii::app()->end();

	}

	public function actionFlushTableSchema() {
		Yii::app()->db->schema->getTables();
		Yii::app()->db->schema->refresh();
		echo "Вероятно, кэш схем таблиц очищен";
	}
	
}

?>