<?php
namespace com\cminds\registration\model;

use com\cminds\registration\App;

class Labels extends Model {
	
	const FILENAME = 'labels.tsv';
	const OPTION_LABEL_PREFIX = 'cmreg_label_';
	const TEXT_DOMAIN = 'cm-registration';
	
	protected static $labels = array();
	protected static $labelsByCategories = array();
	
	public static function init() {
		
		parent::init();
		
		add_action('cmreg_load_label_file', array(__CLASS__, 'loadLabelFile'), 1);
		
		static::loadLabelFile();
		do_action('cmreg_labels_init');
		
		/* You can use the following filters to add new labels for plugin:
		add_filter('cmreg_labels_init_labels', function($labels) {
			$labels['label_name'] = array('default' => 'Value', 'desc' => 'Description', 'category' => 'Other');
			return $labels;
		});
		add_filter('cmreg_labels_init_labels_by_categories', function($labelsByCategories) {
			$labelsByCategories['Other'][] = 'label_name';
			return $labelsByCategories;
		});
		*/
		
		static::$labels = apply_filters('cmreg_labels_init_labels', static::$labels);
		static::$labelsByCategories = apply_filters('cmreg_labels_init_labels_by_categories', static::$labelsByCategories);
		
	}

	public static function getLabel($labelKey) {
		$optionName = static::OPTION_LABEL_PREFIX . $labelKey;
		$default = static::getDefaultLabel($labelKey);
		return get_option($optionName, (empty($default) ? $labelKey : $default));
	}
	
	public static function setLabel($labelKey, $value) {
		$optionName = static::OPTION_LABEL_PREFIX . $labelKey;
		update_option($optionName, $value, $autoload = true);
	}
	
	public static function getLocalized($labelKey) {
		return __(static::getLabel($labelKey), static::TEXT_DOMAIN);
	}
	
	public static function getDefaultLabel($key) {
		if ($label = static::getLabelDefinition($key)) {
			return $label['default'];
		}
	}
	
	public static function getDescription($key) {
		if ($label = static::getLabelDefinition($key)) {
			return $label['desc'];
		}
	}
	
	public static function getLabelDefinition($key) {
		$labels = static::getLabels();
		return (isset($labels[$key]) ? $labels[$key] : NULL);
	}
	
	public static function getLabels() {
		return static::$labels;
	}
	
	public static function getLabelsByCategories() {
		return static::$labelsByCategories;
	}
		
	public static function getDefaultLabelsPath() {
		return App::path('asset') .'/labels/'. static::FILENAME;
	}

	public static function loadLabelFile($path = null) {
		$file = explode("\n", file_get_contents(empty($path) ? static::getDefaultLabelsPath() : $path));
		foreach ($file as $row) {
			$row = explode("\t", trim($row));
			if (count($row) >= 2) {
				$label = array(
					'default' => $row[1],
					'desc' => (isset($row[2]) ? $row[2] : null),
					'category' => (isset($row[3]) ? $row[3] : null),
				);
				static::$labels[$row[0]] = $label;
				static::$labelsByCategories[$label['category']][] = $row[0];
			}
		}
	}
	
	static function processPostRequest() {
		$labels = static::getLabels();
		foreach ($labels as $labelKey => $label) {
			if (isset($_POST['label_'. $labelKey])) {
				static::setLabel($labelKey, stripslashes($_POST['label_'. $labelKey]));
			}
		}
	}
	
	static function __($msg) {
		return \__($msg, static::TEXT_DOMAIN);
	}
	
}