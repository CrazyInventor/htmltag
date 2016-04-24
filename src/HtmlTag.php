<?php

namespace App\HtmlTag;

abstract class HtmlTag implements HtmlTagInterface {

	protected $tag = 'html';
	protected $attributes = [
		'class' => '',
		'id' => ''
	];

	public function __construct($tag)
	{
		$this->tag = $tag;
	}

	public function addClass($class) {
		if(!in_array($class,$this->attributes['class'])) {
			$this->attributes['class'][]=$class;
		}
	}

	public function setId($id) {
		$this->attributes['id']=$id;
	}

	protected function renderOpeningTag() {
		$attributes = [];
		foreach($this->attributes as $attribute => $value) {
			$attribute_string = $attribute
				. '="';
			switch(gettype($value)) {

			}
			$attribute_string .= '"';
			$attributes[] = $attribute_string;
		}

		return '<'
		. $this->tag
		. ' '
		. implode(" ", $attributes)
		. '>';

	}

	protected function renderClosingTag() {
		return '</'
		. $this->tag
		. '>';
	}
}
