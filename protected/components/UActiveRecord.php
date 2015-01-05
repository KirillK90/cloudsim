<?php
/**
 * UActiveRecord is the customized base ActiveRecord class.
 * All form classes for this application should extend from this base class.
 */
class UActiveRecord extends CActiveRecord
{
	/**
	 * Возвращает массив $_POST[formName]
	 * @return array() $_POST[formName]
	 */
	public function getFormData($paramName="")
	{
		$post = Yii::app()->request->getPost(get_class($this));
		return $paramName == "" ? $post : $post[$paramName];
	}

	/**
	 * Возвращает массив $_GET[formName]
	 * @return array() $_GET[formName]
	 */
	public function getQueryData($paramName="")
	{
		$get = Yii::app()->request->getQuery(get_class($this));
		return $paramName == "" ? $get : $get[$paramName];
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
	
	public function findByAttributesOrCreate($attributes,$condition='',$params=array())
	{
		$obj = $this->model()->findByAttributes($attributes,$condition,$params);
		if ($obj != null)
			return $obj;
	
		$class_name = get_class($this); 
		$obj = new $class_name;
		foreach ($attributes as $name=>$value)
			$obj->$name = $value;
				
		return $obj;
	}
}