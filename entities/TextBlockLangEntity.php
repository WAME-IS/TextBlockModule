<?php

namespace Wame\TextBlockModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Nette\Utils\Strings;

/**
 * @ORM\Table(name="wame_text_block_lang")
 * @ORM\Entity
 */
class TextBlockLangEntity extends \Wame\Core\Entities\BaseEntity 
{
	use Columns\Identifier;
	use Columns\EditDate;
	use Columns\EditUser;
	use Columns\Lang;

	/**
     * @ORM\ManyToOne(targetEntity="TextBlockEntity", inversedBy="langs")
     * @ORM\JoinColumn(name="text_block_id", referencedColumnName="id", nullable=false)
     */
	protected $textBlock;
	
	/**
	 * @ORM\Column(name="text", type="text", length=65535, nullable=true)
	 */
	protected $text;

	
	public function getText()
	{
		return $this->text;
	}
	
	public function setText($text)
	{
		$this->text = Strings::trim($text);
		
		return $this;
	}
	
}