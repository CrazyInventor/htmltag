<?php

namespace CrazyInventor\HtmlTag;

class TableSection extends HtmlTag {

	/**
	 * Rows of this section
	 * @var array
	 */
	protected $rows = [];
	protected $header = [];

	/**
	 * @param $id
	 * @return TableRow
	 */
	public function row($id) {
		return $this->rows[$id];
	}

	/**
	 * Add a table row
	 *
	 * @param TableRow $row
	 */
	public function addRow(TableRow $row) {
		$this->rows[] = $row;
	}

	/**
	 * Get keys to access the rows
	 *
	 * @return array
	 */
	public function getKeys() {
		return array_keys($this->rows);
	}

	/**
	 * TableSection constructor.
	 *
	 * @param $tag
	 * @param $rows
	 * @param bool $header
	 */
	public function __construct($tag, $rows, $header=false)
	{
		parent::__construct($tag);
		$this->header=$header;
		foreach($rows as $row) {
			$this->rows[] = new TableRow($row, $header);
		}
	}

	/**
	 * Render this section
	 * 
	 * @return string
	 */
	public function renderTag() {
		$rendered_rows = [];
		foreach ($this->rows as $row) {
			$rendered_rows[] = $row->renderTag();
		}
		if(count($rendered_rows)>0) {
			return $this->renderOpeningTag()
			. implode("", $rendered_rows)
			. $this->renderClosingTag();
		} else {
			return '';
		}
	}
}