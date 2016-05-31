<?php

namespace Wame\TextBlockModule\Vendor\Wame\ComponentModule;

use Nette\Application\LinkGenerator;
use Wame\MenuModule\Models\Item;
use Wame\TextBlockModule\Components\ITextBlockControlFactory;

interface ITextBlockComponentFactory
{
	/** @return TextBlockComponent */
	public function create();	
}


class TextBlockComponent implements \Wame\ComponentModule\Models\IComponent
{	
	/** @var LinkGenerator */
	private $linkGenerator;

	/** @var ITextBlockControlFactory */
	private $ITextBlockControlFactory;

	
	public function __construct(
		LinkGenerator $linkGenerator,
		ITextBlockControlFactory $ITextBlockControlFactory
	) {
		$this->linkGenerator = $linkGenerator;
		$this->ITextBlockControlFactory = $ITextBlockControlFactory;
	}
	
	
	public function addItem()
	{
		$item = new Item();
		$item->setName('textBlock');
		$item->setTitle(_('Text block'));
		$item->setLink($this->linkGenerator->link('Admin:TextBlock:create'));
		$item->setIcon('fa fa-list-alt');
		
		return $item->getItem();
	}
	
	
	public function getLink($componentEntity)
	{
		return $this->linkGenerator->link('Admin:TextBlock:edit', ['id' => $componentEntity->id]);
	}
	
	
	public function createComponent($componentInPosition)
	{
		$control = $this->ITextBlockControlFactory->create();
		$control->setComponentInPosition($componentInPosition);
		
		return $control;
	}
	
}