<?php

declare(strict_types=1);

namespace rarkhopper\modals;

use JsonSerializable;

abstract class ModalElements implements JsonSerializable{
	protected string $title;
	/** @var array<PrimaryElement> */
	protected array $elements = [];

	public function __construct(string $title){
		$this->title = $title;
		$this->appendElement(new FormTitle($title));
	}

	public function getTitle() : string{
		return $this->title;
	}

	public function appendElement(PrimaryElement $element) : void{
		$this->elements[] = $element;
	}

	/**
	 * @return ElementBase[]
	 */
	public function getElements() : array{
		return $this->elements;
	}

	public function getElementByName(string $name) : ?ElementBase{
		foreach($this->elements as $element){
			if(!$element instanceof INamedElement) continue;
			if($element->getName() !== $name) continue;
			return $element;
		}
		return null;
	}

	public function jsonSerialize(){
		$jsonArr = [];

		foreach($this->elements as $element){
			if($element instanceof ISingleElement){
				$jsonArr[$element->getName()] = $element->getParameter();

			}else{
				$jsonArr[$element->getName()] = $element->getElement();
			}
		}
		return $jsonArr;
	}
}
