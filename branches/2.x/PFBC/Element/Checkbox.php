<?php
namespace PFBC\Element;

class Checkbox extends \PFBC\OptionElement {
	protected $attributes = array("type" => "checkbox");
	protected $inline;

	public function jQueryDocumentReady() {
		if(!empty($this->inline))
			echo 'jQuery("#', $this->attributes["id"], ' .pfbc-checkbox:last").css("margin-right", "0");';
	}

	public function render() { 
		if(isset($this->attributes["value"])) {
			if(!is_array($this->attributes["value"]))
				$this->attributes["value"] = array($this->attributes["value"]);
		}
		else
			$this->attributes["value"] = array();

		if(substr($this->attributes["name"], -2) != "[]")
			$this->attributes["name"] .= "[]";

		$count = 0;
		echo '<div id="', $this->attributes["id"], '">';
		foreach($this->options as $value => $text) {
			echo '<div class="pfbc-checkbox"><table cellpadding="0" cellspacing="0"><tr><td valign="top"><input id="', $this->attributes["id"], "-", $count, '"', $this->getAttributes(array("id", "value", "checked")), ' value="', $this->filter($value), '"';
			if(in_array($value, $this->attributes["value"]))
				echo ' checked="checked"';
			echo '/></td><td><label for="', $this->attributes["id"], "-", $count, '">', $text, '</label></td></tr></table></div>';
			++$count;
		}	

		if(!empty($this->inline))
			echo '<div style="clear: both;"></div>';

		echo '</div>';
	}

	public function renderCSS() {
		if(!empty($this->inline))
			echo '#', $this->attributes["id"], ' .pfbc-checkbox { float: left; margin-right: 0.5em; }';
	}
}