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
		if(count($thead_data)>0) {
			$this->sections['thead'] = new TableSection('thead', $thead_data, true);
		}
		if(count($tfoot_data)>0) {
			$this->sections['tfoot'] = new TableSection('tfoot', $tfoot_data, true);
		}
		if(count($body_data)>0) {
			$this->sections['tbody'] = new TableSection('tbody', $body_data);
		}
	}

	public function body() {
		return $this->sections['tbody'];
	}

	public function setBody(TableSection $body) {
		$this->sections['tbody'] = $body;
	}

	public function foot() {
		return $this->sections['tfoot'];
	}

	public function setFoot(TableSection $foot) {
		$this->sections['tfoot'] = $foot;
	}

	public function head() {
		return $this->sections['thead'];
	}

	public function setHead(TableSection $head) {
		$this->sections['thead'] = $head;
	}

	public function renderTag() {
		$sections = [];
		foreach($this->sections as $section) {
			if($section!=null) {
				$sections[] = $section->renderTag();
			}
		}
		$sections_html = implode("\n", $sections);

		return $this->renderOpeningTag()
		. $sections_html
		. $this->renderClosingTag();
	}
}