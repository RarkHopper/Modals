<?php

declare(strict_types=1);

namespace rarkhopper\modals\long;

use rarkhopper\modals\FormLabel;
use rarkhopper\modals\FormType;
use rarkhopper\modals\long\element\Buttons;
use rarkhopper\modals\ModalElements;

class LongFormElements extends ModalElements{
	private Buttons $buttons;
	private string $label;

	public function __construct(string $title, string $label = ''){
		parent::__construct($title);
		$this->buttons = new Buttons();
		$this->label = $label;
		$this->initElement();
	}

	private function initElement() : void{
		$this->appendElement(new FormLabel($this->label));
		$this->appendElement(new FormType(FormType::TYPE_LONG));
	}

	public function getLabel() : string{
		return $this->label;
	}

	public function getButtons() : Buttons{
		return $this->buttons;
	}
}