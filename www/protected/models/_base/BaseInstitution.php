<?php

/**
 * This is the model base class for the table "institution".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Institution".
 *
 * Columns in table "institution" available as properties of the model,
 * followed by relations of table "institution" available as properties of the model.
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property string $logo_url
 * @property string $token
 * @property integer $status
 * @property string $created
 * @property integer $user_id
 *
 * @property Collection[] $collections
 * @property User $user
 * @property Licence[] $licences
 * @property Media[] $medias
 */
abstract class BaseInstitution extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'institution';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Institution|Institutions', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, url, token, created', 'required'),
			array('status, user_id', 'numerical', 'integerOnly'=>true),
			array('name, url, logo_url, token', 'length', 'max'=>128),
			array('description', 'safe'),
			array('description, logo_url, status, user_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, url, description, logo_url, token, status, created, user_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'collections' => array(self::HAS_MANY, 'Collection', 'institution_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'licences' => array(self::HAS_MANY, 'Licence', 'institution_id'),
			'medias' => array(self::HAS_MANY, 'Media', 'institution_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'name' => Yii::t('app', 'Name'),
			'url' => Yii::t('app', 'Url'),
			'description' => Yii::t('app', 'Description'),
			'logo_url' => Yii::t('app', 'Logo Url'),
			'token' => Yii::t('app', 'Token'),
			'status' => Yii::t('app', 'Status'),
			'created' => Yii::t('app', 'Created'),
			'user_id' => null,
			'collections' => null,
			'user' => null,
			'licences' => null,
			'medias' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('logo_url', $this->logo_url, true);
		$criteria->compare('token', $this->token, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('created', $this->created, true);
		$criteria->compare('user_id', $this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}