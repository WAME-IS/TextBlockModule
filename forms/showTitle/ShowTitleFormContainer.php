<?php

namespace Wame\TextBlockModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;

interface IShowTitleFormContainerFactory
{
	/** @return ShowTitleFormContainer */
	function create();
}


class ShowTitleFormContainer extends BaseFormContainer
{
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    protected function configure() 
	{		
		$form = $this->getForm();

        $form->addRadioList('showTitle', _('Show title'), $this->yesOrNo)
				->setDefaultValue(BaseFormContainer::SWITCH_NO);
    }
	
	
	public function setDefaultValues($object)
	{
		$form = $this->getForm();

		if ($object->componentEntity->getParameter('showTitle')) {
			$form['showTitle']->setDefaultValue($object->componentEntity->getParameter('showTitle'));
		}
	}
	
}