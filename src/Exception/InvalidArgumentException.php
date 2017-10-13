<?php declare(strict_types=1);
/**
 * standard-algebraic-notation (https://github.com/chesszebra/standard-algebraic-notation)
 *
 * @link https://github.com/chesszebra/standard-algebraic-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/standard-algebraic-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\StandardAlgebraicNotation\Exception;

use InvalidArgumentException as BaseInvalidArgumentException;

/**
 * This exception is thrown once an invalid value is converted to a SAN.
 */
final class InvalidArgumentException extends BaseInvalidArgumentException
{
}
