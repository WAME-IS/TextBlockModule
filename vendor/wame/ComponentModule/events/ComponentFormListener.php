<?php

namespace Wame\TextBlockModule\Vendor\Wame\ComponentModule\Events;

use Nette\Object;
use Nette\Security\User;
use Nette\Utils\DateTime;
use Wame\ComponentModule\Repositories\ComponentRepository;
use Wame\TextBlockModule\Entities\TextBlockEntity;
use Wame\TextBlockModule\Entities\TextBlockLangEntity;
use Wame\TextBlockModule\Repositories\TextBlockRepository;
use Wame\UserModule\Repositories\UserRepository;

class ComponentFormListener extends Object 
{
	/** @var User */
	private $user;
	
	/** @var ComponentRepository */
	private $componentRepository;
	
	/** @var TextBlockRepository */
	private $textBlockRepository;
	
	/** @var UserRepository */
	private $userRepository;
	
	/** @var string */
	private $lang;
	

	public function __construct(
		User $user,
		ComponentRepository $componentRepository,
		TextBlockRepository $textBlockRepository,
		UserRepository $userRepository
	) {
		$this->user = $user;
		$this->componentRepository = $componentRepository;
		$this->textBlockRepository = $textBlockRepository;
		$this->userRepository = $userRepository;
		
		$this->lang = $componentRepository->lang;
		
		$componentRepository->onCreate[] = [$this, 'onCreate'];
		$componentRepository->onUpdate[] = [$this, 'onUpdate'];
		$componentRepository->onDelete[] = [$this, 'onDelete'];
	}

	
	public function onCreate($form, $values, $componentEntity) 
	{
		if ($componentEntity->type == 'TextBlockComponent') {
			$textBlockEntity = new TextBlockEntity();
			$textBlockEntity->component = $componentEntity;
			
			$textBlockLangEntity = new TextBlockLangEntity();
			$textBlockLangEntity->textBlock = $textBlockEntity;
			$textBlockLangEntity->setLang($this->lang);
			$textBlockLangEntity->setText($values['text']);
			$textBlockLangEntity->setEditDate($componentEntity->createDate);
			$textBlockLangEntity->setEditUser($componentEntity->createUser);
			
			$textBlockEntity->addLang($this->lang, $textBlockLangEntity);
			
			$this->textBlockRepository->create($textBlockEntity);
			
			$componentEntity->setParameters($this->getParams($values, $componentEntity->getParameters()));
		}
	}
	
	
	public function onUpdate($form, $values, $componentEntity)
	{
		if ($componentEntity->type == 'TextBlockComponent') {
			$userEntity = $this->userRepository->get(['id' => $this->user->id]);
			
			$textBlockEntity = $this->textBlockRepository->get(['component' => $componentEntity]);
			
			$textBlockLangEntity = $textBlockEntity->langs[$this->lang];
			$textBlockLangEntity->setText($values['text']);
			$textBlockLangEntity->setEditDate(new DateTime('now'));
			$textBlockLangEntity->setEditUser($userEntity);
			
			$this->textBlockRepository->update($textBlockEntity);

			$componentEntity->setParameters($this->getParams($values, $componentEntity->getParameters()));
		}
	}
	
	
	public function onDelete()
	{
		
	}
	
	
	/**
	 * Get parameters
	 * 
	 * @param array $values
	 * @param array $parameters
	 * @return array
	 */
	private function getParams($values, $parameters = [])
	{
		$array = [
			'showTitle' => $values['showTitle']
		];
		
		return array_replace($parameters, $array);
	}

}
