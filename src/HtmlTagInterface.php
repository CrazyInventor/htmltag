<?php

namespace CrazyInventor\HtmlTag;

interface HtmlTagInterface {
	/**
	 * Every tag needs to be renderable
	 * 
	 * @return mixed
	 */
	public function renderTag();
}