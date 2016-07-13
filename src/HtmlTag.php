<?php

namespace CrazyInventor\HtmlTag;

abstract class HtmlTag implements HtmlTagInterface {

	protected $tag = 'html';
	protected $attributes = [
		'id' => null,
		'class' => [],
	];

	public function __construct($tag)
	{
		$this->tag = $tag;
	}

	public function addClass($class) {
		if(!in_array($class,$this->attributes['class'])) {
			$this->attributes['class'][]=(string)$class;
		}
	}

	public function addAttribute($name, $value = '') {
		$this->attributes[$name] = $value;
	}

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

	protected function renderClosingTag() {
		return '</'
		. $this->tag
		. '>';
	}

	public function setId($id) {
		$this->attributes['id']=(string)$id;
	}

	public function __toString()
	{
		return $this->renderTag();
	}
}
