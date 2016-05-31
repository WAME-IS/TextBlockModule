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
	
	/** @var string */
	private $lang;
	
	
	public function __construct(TextBlockRepository $textBlockRepository) 
	{
		parent::__construct();
		
		$this->textBlockRepository = $textBlockRepository;
		$this->lang = $textBlockRepository->lang;
	}
	
	
	public function render()
	{
		$show = true;
		
		if ($this->componentInPosition->component->status == 1) {
			$textBlock = $this->textBlockRepository->get(['component' => $this->componentInPosition->component]);

			if ($textBlock && $textBlock->langs[$this->lang]->text) {
				$this->template->position = $this->componentInPosition;
				$this->template->component = $this->componentInPosition->component;
				$this->template->textBlock = $textBlock;
				$this->template->lang = $this->lang;
				$this->template->title = $this->componentInPosition->component->langs[$this->lang]->title;
				$this->template->text = $textBlock->langs[$this->lang]->text;
			} else {
				$show = false;
			}
		} else {
			$show = false;
		}
		
		$this->template->show = $show;
		
		$this->getTemplateFile();
		$this->template->render();
	}

}