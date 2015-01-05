<?php
/**
 * UFormModel is the customized base action class.
 * All form classes for this application should extend from this base class.
 */
class UFormModel extends CFormModel
{
	/**
	 * Возвращает массив $_POST[formName]
	 *
	 * @param string $paramName
	 *
	 * @return array() $_POST[formName]
	 */


	public function getFormData($paramName="")
	{
		$post = Yii::app()->request->getPost(get_class($this));
		return $paramName == "" ? $post : $post[$paramName];
	}
	
	/**
	 * Выводит ошибки валидации в формате JSON
	 * @return string the JSON representation of the validation error messages.
	 */
	public function showJSONErrors()
	{
		foreach($this->getErrors() as $attribute=>$errors)
			$result[CHtml::activeId($this,$attribute)]=$errors;
			
		echo function_exists('json_encode') ? json_encode($result) : CJSON::encode($result);
	}
	
}