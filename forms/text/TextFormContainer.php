<?php

namespace Wame\TextBlockModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\TextBlockModule\Repositories\TextBlockRepository;

interface ITextFormContainerFactory
{
	/** @return TextFormContainer */
	function create();
}


class TextFormContainer extends BaseFormContainer
{	
	/** @var TextBlockRepository */
	private $textBlockRepository;
	
	
	public function __construct(TextBlockRepository $textBlockRepository) 
	{
		parent::__construct();
		
		$this->textBlockRepository = $textBlockRepository;
	}
	
	
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    protected function configure() 
	{		
		$form = $this->getForm();

        $form->addTextArea('text', _('Text'));
    }
	
	
	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$textBlock = $this->textBlockRepository->get(['component' => $object->componentEntity]);

		if ($textBlock) {
			$form['text']->setDefaultValue($textBlock->langs[$object->lang]->text);
		}
	}
	
}