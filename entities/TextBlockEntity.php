<?php

namespace Wame\TextBlockModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Wame\LanguageModule\Entities\TranslatableEntity;

/**
 * @ORM\Table(name="wame_text_block")
 * @ORM\Entity
 */
class TextBlockEntity extends TranslatableEntity
{
	use Columns\Identifier;
	use \Wame\ComponentModule\Entities\Columns\Component;

	/**
     * @ORM\OneToMany(targetEntity="TextBlockLangEntity", mappedBy="textBlock")
     */
    protected $langs;
	
}