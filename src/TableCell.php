<?php

namespace CrazyInventor\HtmlTag;

class TableCell extends HtmlTag {

	protected $tag = 'td';
	protected $content = "";

	public function __construct($content)
	{
		parent::__construct($this->tag);
		$this->content = $content;
	}

	public function renderTag() {
		return $this->renderOpeningTag()
		. $this->content
		. $this->renderClosingTag();
	}

	public function setContent($new_content) {
		$this->content = $new_content;
	}
}