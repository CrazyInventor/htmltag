<?php

namespace CrazyInventor\HtmlTag;

class Table extends HtmlTag {

	protected $tag = 'table';
	protected $sections = [
		'thead' => null,
		'tfoot' => null,
		'tbody' => null,
	];

	public function __construct($body_data = [], $thead_data = [], $tfoot_data = [])
	{
		$this->sections['thead'] = new TableSection('thead', $thead_data, true);
		$this->sections['tfoot'] = new TableSection('tfoot', $tfoot_data, true);
		$this->sections['tbody'] = new TableSection('tbody', $body_data);
	}

	/**
	 * @return TableSection
	 */
	public function body() {
		return $this->sections['tbody'];
	}

	public function setBody(TableSection $body) {
		$this->sections['tbody'] = $body;
	}

	/**
	 * @return TableSection
	 */
	public function foot() {
		return $this->sections['tfoot'];
	}

	public function setFoot(TableSection $foot) {
		$this->sections['tfoot'] = $foot;
	}

	/**
	 * @return TableSection
	 */
	public function head() {
		return $this->sections['thead'];
	}

	public function setHead(TableSection $head) {
		$this->sections['thead'] = $head;
	}

	public function renderTag() {
		$sections = [];
		foreach($this->sections as $section) {
			$sections[] = $section->renderTag();
		}
		$sections_html = implode($sections);

		return $this->renderOpeningTag()
		. $sections_html
		. $this->renderClosingTag();
	}
}