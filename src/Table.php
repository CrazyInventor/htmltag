<?php

namespace CrazyInventor\HtmlTag;

class Table extends HtmlTag {
	/**
	 * Table tag
	 * @var string
	 */
	protected $tag = 'table';
	/**
	 * A table can have 3 sections, head, foot, and body
	 *
	 * @var array
	 */
	protected $sections = [
		'thead' => null,
		'tfoot' => null,
		'tbody' => null,
	];

	/**
	 * Table constructor.
	 *
	 * @param array $body_data
	 * @param array $thead_data
	 * @param array $tfoot_data
	 */
	public function __construct($body_data = [], $thead_data = [], $tfoot_data = [])
	{
		$this->sections['thead'] = new TableSection('thead', $thead_data, true);
		$this->sections['tfoot'] = new TableSection('tfoot', $tfoot_data, true);
		$this->sections['tbody'] = new TableSection('tbody', $body_data);
	}

	/**
	 * Get body section
	 *
	 * @return TableSection
	 */
	public function body() {
		return $this->sections['tbody'];
	}

	/**
	 * Set body section
	 *
	 * @param TableSection $body
	 */
	public function setBody(TableSection $body) {
		$this->sections['tbody'] = $body;
	}

	/**
	 * Get foot section
	 *
	 * @return TableSection
	 */
	public function foot() {
		return $this->sections['tfoot'];
	}

	/**
	 * Set foot section
	 *
	 * @param TableSection $foot
	 */
	public function setFoot(TableSection $foot) {
		$this->sections['tfoot'] = $foot;
	}

	/**
	 * Get head section
	 *
	 * @return TableSection
	 */
	public function head() {
		return $this->sections['thead'];
	}

	/**
	 * Set head section
	 *
	 * @param TableSection $head
	 */
	public function setHead(TableSection $head) {
		$this->sections['thead'] = $head;
	}

	/**
	 * Render this table
	 *
	 * @return string
	 */
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