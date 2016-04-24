<?php

namespace App\HtmlTag;

class TableSection extends HtmlTag {

	protected $rows = [];

	public function getRow($id) {
		return $this->rows[$id];
	}

	public function getKeys() {
		return array_keys($this->rows);
	}

	public function __construct($tag, $rows, $header=false)
	{
		parent::__construct($tag);
		foreach($rows as $row) {
			$this->rows[] = new TableRow($row, $header);
		}
	}

	public function renderTag() {
		$rendered_rows = [];
		foreach ($this->rows as $row) {
			$rendered_rows[] = $row->renderTag();
		}
		return $this->renderOpeningTag()
		. implode("\n", $rendered_rows)
		. $this->renderClosingTag();
	}
}