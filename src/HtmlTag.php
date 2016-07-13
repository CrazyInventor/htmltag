<?php

namespace CrazyInventor\HtmlTag;

abstract class HtmlTag implements HtmlTagInterface {

	/**
	 * Tag identifier
	 *
	 * @var string
	 */
	protected $tag = 'html';
	/**
	 * Attributes of this tag
	 *
	 * @var array
	 */
	protected $attributes = [
		'id' => null,
		'class' => [],
	];

	/**
	 * HtmlTag constructor.
	 * @param $tag
	 */
	public function __construct($tag)
	{
		// override default tag identifier
		$this->tag = $tag;
	}

	/**
	 * Add a CSS class
	 *
	 * @param $class
	 */
	public function addClass($class) {
		if(!in_array($class,$this->attributes['class'])) {
			$this->attributes['class'][]=(string)$class;
		}
	}

	/**
	 * Add a HTML attribute and optional value
	 *
	 * @param $name
	 * @param string $value
	 */
	public function addAttribute($name, $value = '') {
		$this->attributes[$name] = $value;
	}

	/**
	 * Render opening tag
	 *
	 * @return string
	 */
	protected function renderOpeningTag() {
		$attributes = [];
		foreach($this->attributes as $attribute => $value) {
			$attribute_string = '';
			switch(gettype($value)) {
				case "NULL":
					break;
				case "string":
					$attribute_string = $attribute
						. '="'
						. $value
						. '"';
					break;
				case "array":
					if(count($value)>0) {
						$attribute_string = $attribute . '="';
						$attribute_string .= implode(" ", $value);
						$attribute_string .= '"';
					}
					break;
				default:
					throw new \InvalidArgumentException('Unknown variable type: ' . gettype($value));
					break;
			}
			if(strlen($attribute_string)>0) {
				$attributes[] = $attribute_string;
			}
		}
		$attributes_string = '';
		if(count($attributes)>0) {
			$attributes_string = ' ' . implode(" ", $attributes);
		}
		return '<'
		. $this->tag
		. $attributes_string
		. '>';
	}

	/**
	 * Render closing tag
	 *
	 * @return string
	 */
	protected function renderClosingTag() {
		return '</'
		. $this->tag
		. '>';
	}

	/**
	 * Set tag ID
	 *
	 * @param $id
	 */
	public function setId($id) {
		$this->attributes['id']=(string)$id;
	}

	/**
	 * Magic function to get string representive of this object
	 *
	 * @return mixed
	 */
	public function __toString()
	{
		return $this->renderTag();
	}
}
