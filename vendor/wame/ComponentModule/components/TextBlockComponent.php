<?php

namespace Wame\TextBlockModule\Vendor\Wame\ComponentModule;

use Nette\Application\LinkGenerator;
use Wame\ComponentModule\Models\IComponent;
use Wame\MenuModule\Models\Item;
use Wame\TextBlockModule\Components\ITextBlockControlFactory;

interface ITextBlockComponentFactory
{
	/** @return TextBlockComponent */
	public function create();	
}


class TextBlockComponent implements IComponent
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
		$item->setName($this->getName());
		$item->setTitle($this->getTitle());
		$item->setDescription($this->getDescription());
		$item->setLink($this->getLinkCreate());
		$item->setIcon($this->getIcon());
		
		return $item->getItem();
	}
	
	
	public function getName()
	{
		return 'textBlock';
	}
	
	
	public function getTitle()
	{
		return _('Text block');
	}
	
	
	public function getDescription()
	{
		return _('Create text block');
	}
	
	
	public function getIcon()
	{
		return 'fa fa-list-alt';
	}
	
	
	public function getLinkCreate()
	{
		return $this->linkGenerator->link('Admin:TextBlock:create');
	}

	
	public function getLinkDetail($componentEntity)
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