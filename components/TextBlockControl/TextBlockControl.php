<?php 

namespace Wame\TextBlockModule\Components;

use Wame\TextBlockModule\Repositories\TextBlockRepository;

interface ITextBlockControlFactory
{
	/** @return TextBlockControl */
	public function create();	
}


class TextBlockControl extends \Wame\Core\Components\BaseControl
{	
	/** @var TextBlockControl */
	private $textBlockRepository;
	
	public function __construct(\Nette\DI\Container $container, TextBlockRepository $textBlockRepository) 
	{
		parent::__construct($container);
		
		$this->textBlockRepository = $textBlockRepository;
	}
	
	
	public function render()
	{
		$show = true;

        if(!$this->componentInPosition) {
            throw new \Nette\InvalidArgumentException("TextBlockControl can only be used in position!");
        }
        
        $textBlock = $this->textBlockRepository->get(['component' => $this->componentInPosition->component]);

        if ($textBlock && $textBlock->text) {
            $this->template->position = $this->componentInPosition;
            $this->template->component = $this->componentInPosition->component;
            $this->template->textBlock = $textBlock;
            $this->template->title = $this->getTitle();
            $this->template->text = $textBlock->getText();
        } else {
            $show = false;
        }

		$this->template->show = $show;
	}

}