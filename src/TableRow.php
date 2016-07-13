<?php

namespace CrazyInventor\HtmlTag;

class TableRow extends HtmlTag {
	/**
	 * Table row tag
	 *
	 * @var string
	 */
	protected $tag = 'tr';
	/**
	 * Table cells
	 *
	 * @var array
	 */
	protected $cells = [];

	/**
	 * @param $id
	 * @return TableCell
	 */
	public function cell($id) {
		return $this->cells[$id];
	}

	/**
	 * Add a new table cell
	 *
	 * @param $cell
	 */
	public function addCell($cell) {
		$this->cells[] = $cell;
	}

	/**
	 * Get the keys to access the cells
	 *
	 * @return array
	 */
	public function getKeys() {
		return array_keys($this->cells);
	}

	/**
	 * TableRow constructor.
	 *
	 * @param $row_data
	 * @param bool $header
	 */
	public function __construct($row_data, $header=false) {
		$class = ($header) ? 'TableHeaderCell' : 'TableCell';
		$classpath =  __NAMESPACE__ . '\\' . $class;
		foreach($row_data as $cell) {
			$this->cells[] = new $classpath($cell);
		}
	}

	/**
	 * Render table row
	 * 
	 * @return string
	 */
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