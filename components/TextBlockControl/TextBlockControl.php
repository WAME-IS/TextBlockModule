<?php 

namespace Wame\TextBlockModule\Components;

use Nette\DI\Container;
use Wame\Core\Components\BaseControl;
use Wame\TextBlockModule\Repositories\TextBlockRepository;


interface ITextBlockControlFactory
{
	/** @return TextBlockControl */
	public function create();	
}


class TextBlockControl extends BaseControl
{	
	/** @var TextBlockControl */
	private $textBlockRepository;
    
	
	public function __construct(
        Container $container, 
        TextBlockRepository $textBlockRepository
    ) {
		parent::__construct($container);
		
		$this->textBlockRepository = $textBlockRepository;
	}
	
	
	public function render()
	{
        if (isset($this->componentInPosition->component)) {
            $componentEntity = $this->componentInPosition->component;
        } else {
            $componentEntity = $this->getParent()->getComponentList()[$this->name];
        }
        
        $textBlock = $this->textBlockRepository->get(['component' => $componentEntity]);

        $this->template->textBlock = $textBlock;
        $this->template->title = $componentEntity->title;
        $this->template->text = $textBlock ? $textBlock->getText() : null;
	}

}