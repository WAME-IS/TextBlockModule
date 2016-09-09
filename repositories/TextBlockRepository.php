<?php

namespace Wame\TextBlockModule\Repositories;

use Wame\Core\Exception\RepositoryException;
use Wame\LanguageModule\Repositories\TranslatableRepository;
use Wame\TextBlockModule\Entities\TextBlockEntity;
use Wame\TextBlockModule\Entities\TextBlockLangEntity;

class TextBlockRepository extends TranslatableRepository
{		
	public function __construct()
    {
		parent::__construct(TextBlockEntity::class, TextBlockLangEntity::class);
	}

	
	/**
	 * Create text block
	 * 
	 * @param TextBlockEntity $textBlockEntity
	 * @return TextBlockEntity
	 * @throws RepositoryException
	 */
	public function create($textBlockEntity)
	{
		$this->entityManager->persist($textBlockEntity);
		$this->entityManager->persist($textBlockEntity->langs);
		
		return $textBlockEntity;
	}
	
	
	/**
	 * Update text block
	 * 
	 * @param TextBlockEntity $textBlockEntity
	 */
	public function update($textBlockEntity)
	{
		return $textBlockEntity;
	}
	
}