<?php

namespace CrazyInventor\HtmlTag;

use App\HtmlTag\TableCell;

class TableRow extends HtmlTag {

	protected $tag = 'tr';
	protected $cells = [];

	public function cell($id) {
		return $this->cells[$id];
	}

	public function addCell($cell) {
		$this->cells[] = $cell;
	}

	public function getKeys() {
		return array_keys($this->cells);
	}

	public function __construct($row_data, $header=false) {
		$class = ($header) ? 'CrazyInventor\HtmlTag\TableHeaderCell' : 'CrazyInventor\HtmlTag\TableCell';
		foreach($row_data as $cell) {
			$this->cells[] = new $class($cell);
		}
	}

	public function renderTag() {
		$rendered_rows = [];
		foreach ($this->cells as $cell) {
			$rendered_cells[] = $cell->renderTag();
		}
		return $this->renderOpeningTag()
		. implode("", $rendered_cells)
		. $this->renderClosingTag();
	}
}