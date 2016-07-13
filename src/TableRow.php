<?php

namespace CrazyInventor\HtmlTag;

class TableRow extends HtmlTag {

	protected $tag = 'tr';
	protected $cells = [];

	/**
	 * @param $id
	 * @return TableCell
	 */
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
		$class = ($header) ? 'TableHeaderCell' : 'TableCell';
		$classpath =  __NAMESPACE__ . '\\' . $class;
		foreach($row_data as $cell) {
			$this->cells[] = new $classpath($cell);
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