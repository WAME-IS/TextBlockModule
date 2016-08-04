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
        $textBlock = $this->textBlockRepository->get(['component' => $this->componentInPosition->component]);

        $this->template->textBlock = $textBlock;
        $this->template->title = $this->componentInPosition->component->title;
        $this->template->text = $textBlock->getText();
	}

}