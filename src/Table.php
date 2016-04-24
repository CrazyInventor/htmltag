<?php

namespace App\HtmlTag;

class Table extends HtmlTag {

	protected $tag = 'table';
	protected $sections = [
		'thead' => [],
		'tfoot' => [],
		'tbody' => [],
	];

	public function __construct($body_data = [], $thead_data = [], $tfoot_data = [])
	{
		$this->sections['thead'] = new TableSection('thead', $thead_data, true);
		$this->sections['tfoot'] = new TableSection('tfoot', $tfoot_data);
		$this->sections['tbody'] = new TableSection('tbody', $body_data);
	}

	public function getBody() {
		return $this->sections['tbody'];
	}

	public function getFoot() {
		return $this->sections['tfoot'];
	}

	public function getHead() {
		return $this->sections['thead'];
	}

	public function renderTag() {
		$sections = [];
		foreach($this->sections as $section) {
			$sections[] = $section->renderTag();
		}
		$sections_html = implode("\n", $sections);

		return $this->renderOpeningTag()
		. $sections_html
		. $this->renderClosingTag();
	}
}