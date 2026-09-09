<?php declare(strict_types = 1);

// Line comment

# Hash line comment

/* Single-line block comment */

/*
 * Multi-line block comment,
 * spanning several lines.
 */

/**
 * Doc comment.
 */
$docCommentOwner = 1;

// Stacked line comment A
// Stacked line comment B

/*
 * Block comment whose closer is glued to an unrelated pragma on the same line.
 */// phpcs:ignore Some.Unrelated.Sniff
