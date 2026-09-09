<?php declare(strict_types = 1);

namespace SlevomatCodingStandard\Helpers;

use PHP_CodeSniffer\Files\File;
use const T_COMMENT;
use const T_DOC_COMMENT_OPEN_TAG;
use const T_PHPCS_IGNORE;

class CommentHelperTest extends TestCase
{

	public function testGetCommentEndPointerForLineComments(): void
	{
		$phpcsFile = $this->getTestedCodeSnifferFile();

		$linePointer = $this->findPointerByLineAndType($phpcsFile, 3, T_COMMENT);
		self::assertNotNull($linePointer);
		self::assertTrue(CommentHelper::isLineComment($phpcsFile, $linePointer));
		self::assertPointer($linePointer, CommentHelper::getCommentEndPointer($phpcsFile, $linePointer));

		$hashPointer = $this->findPointerByLineAndType($phpcsFile, 5, T_COMMENT);
		self::assertNotNull($hashPointer);
		self::assertTrue(CommentHelper::isLineComment($phpcsFile, $hashPointer));
		self::assertPointer($hashPointer, CommentHelper::getCommentEndPointer($phpcsFile, $hashPointer));
	}

	public function testGetCommentEndPointerForSingleLineBlockComment(): void
	{
		$phpcsFile = $this->getTestedCodeSnifferFile();
		$pointer = $this->findPointerByLineAndType($phpcsFile, 7, T_COMMENT);

		self::assertNotNull($pointer);
		self::assertFalse(CommentHelper::isLineComment($phpcsFile, $pointer));
		self::assertPointer($pointer, CommentHelper::getCommentEndPointer($phpcsFile, $pointer));
	}

	public function testGetCommentEndPointerForMultiLineBlockComment(): void
	{
		$phpcsFile = $this->getTestedCodeSnifferFile();
		$openerPointer = $this->findPointerByLineAndType($phpcsFile, 9, T_COMMENT);

		self::assertNotNull($openerPointer);

		$endPointer = CommentHelper::getCommentEndPointer($phpcsFile, $openerPointer);

		self::assertNotNull($endPointer);
		self::assertSame(12, $phpcsFile->getTokens()[$endPointer]['line']);

		$continuationPointer = $this->findPointerByLineAndType($phpcsFile, 10, T_COMMENT);

		self::assertNotNull($continuationPointer);
		self::assertNull(CommentHelper::getCommentEndPointer($phpcsFile, $continuationPointer));
	}

	public function testGetCommentEndPointerForDocComment(): void
	{
		$phpcsFile = $this->getTestedCodeSnifferFile();
		$openTagPointer = $this->findPointerByLineAndType($phpcsFile, 14, T_DOC_COMMENT_OPEN_TAG);

		self::assertNotNull($openTagPointer);

		$endPointer = CommentHelper::getCommentEndPointer($phpcsFile, $openTagPointer);

		self::assertSame($phpcsFile->getTokens()[$openTagPointer]['comment_closer'], $endPointer);
		self::assertSame(16, $phpcsFile->getTokens()[$endPointer]['line']);
	}

	public function testGetCommentEndPointerDoesNotChainStackedLineComments(): void
	{
		$phpcsFile = $this->getTestedCodeSnifferFile();
		$firstPointer = $this->findPointerByLineAndType($phpcsFile, 19, T_COMMENT);
		$secondPointer = $this->findPointerByLineAndType($phpcsFile, 20, T_COMMENT);

		self::assertNotNull($firstPointer);
		self::assertNotNull($secondPointer);

		// Adjacent line comments stay separate; getCommentEndPointer() never chains them.
		self::assertPointer($firstPointer, CommentHelper::getCommentEndPointer($phpcsFile, $firstPointer));
		self::assertPointer($secondPointer, CommentHelper::getCommentEndPointer($phpcsFile, $secondPointer));
	}

	public function testGetCommentEndPointerDoesNotSwallowPragmaGluedAfterCloser(): void
	{
		$phpcsFile = $this->getTestedCodeSnifferFile();
		$openerPointer = $this->findPointerByLineAndType($phpcsFile, 22, T_COMMENT);

		self::assertNotNull($openerPointer);

		$endPointer = CommentHelper::getCommentEndPointer($phpcsFile, $openerPointer);

		self::assertNotNull($endPointer);
		self::assertSame(24, $phpcsFile->getTokens()[$endPointer]['line']);
		self::assertSame(T_COMMENT, $phpcsFile->getTokens()[$endPointer]['code']);
		// The glued "// phpcs:ignore" right after "*/" on the same line must not be included.
		self::assertNotSame(T_PHPCS_IGNORE, $phpcsFile->getTokens()[$endPointer]['code']);
	}

	private function getTestedCodeSnifferFile(): File
	{
		return $this->getCodeSnifferFile(__DIR__ . '/data/comment.php');
	}

}
