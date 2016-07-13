<?php

namespace CrazyInventor\HtmlTag;

class TableCell extends HtmlTag {
	/**
	 * Cell tag
	 * @var string
	 */
	protected $tag = 'td';
	/**
	 * Content of this cell
	 *
	 * @var string
	 */
	protected $content = "";

	/**
	 * TableCell constructor.
	 *
	 * @param $content
	 */
	public function __construct($content)
	{
		parent::__construct($this->tag);
		$this->content = $content;
	}

	/**
	 * Render table cell
	 *
	 * @return string
	 */
	public function renderTag() {
		return $this->renderOpeningTag()
		. $this->content
		. $this->renderClosingTag();
	}

	/**
	 * Get content of this table cell
	 * @param $new_content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Set content of this table cell
	 * @param $new_content
	 */
	public function setContent($new_content) {
		$this->content = $new_content;
	}
}