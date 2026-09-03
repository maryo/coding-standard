<?php

/** Created by Slevomat. */

/**
 * This is
 * multiLine.
 */

/**
 * Class WithDocComment
 *
 * @see https://www.slevomat.cz
 */
abstract class WithDocCommentAndDescription
{

	/**
	 * Constant WITH_DOC_COMMENT_AND_DESCRIPTION
	 *
	 * @var bool
	 */
	const WITH_DOC_COMMENT_AND_DESCRIPTION = true;

	/**
	 * @var bool
	 */
	const WITH_DOC_COMMENT = true;

	const WITHOUT_DOC_COMMENT = false;

	/**
	 * Property with doc comment and description
	 *
	 * @var bool
	 */
	private $withDocCommentAndDescription;

	/**
	 * @var bool
	 */
	protected static $withDocComment;

	public $withoutDocComment;

	/**
	 * @var bool
	 */
	public $legacyWithDocComment;

	/**
	 * Function with doc comment and description
	 * And is multi-line
	 *
	 * @see Whatever
	 *
	 * And also nothing here
	 */
	final public function withDocCommentAndDescription($d)
	{

	}

	/**
	 * @see Whatever
	 */
	public static function withDocComment($b, $c)
	{

	}

	abstract public function withoutDocComment();

}

/**
 * @see https://www.zlavomat.sk
 */
interface WithDocComment
{

}

trait WithoutDocComment
{

}

/**
 */
class EmptyDocComment
{

}

/** @var InlineDocComment */
$inlineDocComment = new InlineDocComment();

/** Invalid inline doccomment */

/**
 *
 */
class PropertyDoesNotHaveDocCommentButClassHas
{

	private $propertyWithoutDocCommentInClassWithDocComment;

}

/**
 * Class with attribute.
 */
#[Attribute]
class ClassWithAttribute
{
}

/**
 * Class with attributes.
 */
#[Attribute]
#[Attribute2]
#[Something(Anything::TARGET_CLASS | \Whatever\Anything::IS_REPEATABLE, PHP_VERSION, parameter1: 123, parameter2: [Nothing::SOMETHING, 'string'])]
class ClassWithAttributes
{
}

/**** Invalid doccomment *****/
class WithInvalidDocComment
{

	public function __construct()
	{
		/**** Invalid doccomment *****/
		$var = 'var';
	}

}

/** Doc comment before a line comment. */
// Line comment.
class WithDocCommentBeforeLineComment
{
}

/** Doc comment before a block comment. */
/*
 * Block comment
 * on multiple lines.
 */
class WithDocCommentBeforeBlockComment
{
}

class WithDocCommentsBeforeStatements
{

	/** Doc comment before an ignore annotation. */
	// phpcs:ignore Whatever.Anything
	public function withIgnoreAnnotation(): void
	{
	}

	/** Doc comment before an attribute and a comment. */
	#[Attribute2]
	// Comment after the attribute.
	public function withAttributeAndComment(): void
	{
	}

	public function withReturn(): void
	{
		/** Doc comment before a return. */
		return;
	}

	public function withEcho(): void
	{
		/** Doc comment before an echo. */
		echo 'whatever';
	}

	public function withVariableStatement(): void
	{
		/** Doc comment before a variable statement. */
		$variable;
	}

	/** Dangling doc comment at the end of a class. */

}

enum WithEnumCase: string
{

	/** Doc comment of an enum case. */
	case CASE_WITH_DOC_COMMENT = 'whatever';

}
