<?php declare(strict_types=1);
/**
 * standard-algebraic-notation (https://github.com/chesszebra/standard-algebraic-notation)
 *
 * @link https://github.com/chesszebra/standard-algebraic-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/standard-algebraic-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\StandardAlgebraicNotation;

use ChessZebra\StandardAlgebraicNotation\Exception\InvalidArgumentException;
use ChessZebra\StandardAlgebraicNotation\Exception\RuntimeException;
use PHPUnit\Framework\TestCase;

final class NotationTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The value "" could not be parsed.
     */
    public function testEmptyValue()
    {
        // Arrange
        $value = '';

        // Act
        new Notation($value);

        // Assert
        // ...
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The value "walter" could not be parsed.
     */
    public function testInvalidValue()
    {
        // Arrange
        $value = 'walter';

        // Act
        new Notation($value);

        // Assert
        // ...
    }

    public function testGetValue()
    {
        // Arrange
        $value = 'e4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals('e4', $notation->getValue());
    }

    public function testCastlingKingSide()
    {
        // Arrange
        $value = 'O-O';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertTrue($notation->isCastlingTowardsKingSide());
        static::assertTrue($notation->isCastlingMove());
        static::assertEquals(Notation::CASTLING_KING_SIDE, $notation->getCastling());
    }

    public function testCastlingKingSideCheck()
    {
        // Arrange
        $value = 'O-O+';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertTrue($notation->isCastlingTowardsKingSide());
        static::assertTrue($notation->isCheck());
        static::assertTrue($notation->isCastlingMove());
        static::assertEquals(Notation::CASTLING_KING_SIDE, $notation->getCastling());
    }

    public function testCastlingKingSideCheckmate()
    {
        // Arrange
        $value = 'O-O#';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertTrue($notation->isCastlingTowardsKingSide());
        static::assertTrue($notation->isCheckmate());
        static::assertTrue($notation->isCastlingMove());
        static::assertEquals(Notation::CASTLING_KING_SIDE, $notation->getCastling());
    }

    public function testCastlingQueenSide()
    {
        // Arrange
        $value = 'O-O-O';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertTrue($notation->isCastlingTowardsQueenSide());
        static::assertTrue($notation->isCastlingMove());
        static::assertEquals(Notation::CASTLING_QUEEN_SIDE, $notation->getCastling());
    }

    public function testCastlingQueenSideCheck()
    {
        // Arrange
        $value = 'O-O-O+';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertTrue($notation->isCastlingTowardsQueenSide());
        static::assertTrue($notation->isCheck());
        static::assertTrue($notation->isCastlingMove());
        static::assertEquals(Notation::CASTLING_QUEEN_SIDE, $notation->getCastling());
    }

    public function testCastlingQueenSideCheckmate()
    {
        // Arrange
        $value = 'O-O-O#';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertTrue($notation->isCastlingTowardsQueenSide());
        static::assertTrue($notation->isCheckmate());
        static::assertTrue($notation->isCastlingMove());
        static::assertEquals(Notation::CASTLING_QUEEN_SIDE, $notation->getCastling());
    }

    public function testPawnMovement()
    {
        // Arrange
        $value = 'e4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_PAWN, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
    }

    public function testPawnMovementCheck()
    {
        // Arrange
        $value = 'e4+';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_PAWN, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
        static::assertTrue($notation->isCheck());
    }

    public function testPawnMovementCheckmate()
    {
        // Arrange
        $value = 'e4#';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_PAWN, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
        static::assertTrue($notation->isCheckmate());
    }

    public function testKingMovement()
    {
        // Arrange
        $value = 'Ke4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_KING, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
    }

    public function testQueenMovement()
    {
        // Arrange
        $value = 'Qe4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_QUEEN, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
    }

    public function testRookMovement()
    {
        // Arrange
        $value = 'Re4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_ROOK, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
    }

    public function testBishopMovement()
    {
        // Arrange
        $value = 'Be4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_BISHOP, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
    }

    public function testKnightMovement()
    {
        // Arrange
        $value = 'Ne4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_KNIGHT, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
    }

    /**
     * @todo Write a test for each piece
     */
    public function testPieceMovementFromColumn()
    {
        // Arrange
        $value = 'Nfe4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_KNIGHT, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
        static::assertEquals('f', $notation->getMovedPieceDisambiguationColumn());
    }

    /**
     * @todo Write a test for each piece
     */
    public function testPieceMovementFromPosition()
    {
        // Arrange
        $value = 'N1e4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_KNIGHT, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
        static::assertEquals(1, $notation->getMovedPieceDisambiguationRow());
    }

    public function testPawnCapture()
    {
        // Arrange
        $value = 'exd4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals('d', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
        static::assertEquals('e', $notation->getMovedPieceDisambiguationColumn());
        static::assertTrue($notation->isCapture());
    }

    /**
     * @todo Write a test for each piece
     */
    public function testPieceCapture()
    {
        // Arrange
        $value = 'Kxd4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_KING, $notation->getMovedPiece());
        static::assertEquals('d', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
        static::assertTrue($notation->isCapture());
    }

    /**
     * @todo Write a test for each piece
     */
    public function testPieceCaptureFromColumn()
    {
        // Arrange
        $value = 'Kexd4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_KING, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getMovedPieceDisambiguationColumn());
        static::assertEquals('d', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
        static::assertTrue($notation->isCapture());
    }

    /**
     * @todo Write a test for each piece
     */
    public function testPieceCaptureFromRow()
    {
        // Arrange
        $value = 'K3xd4';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_KING, $notation->getMovedPiece());
        static::assertEquals(3, $notation->getMovedPieceDisambiguationRow());
        static::assertEquals('d', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetRow());
    }

    /**
     * @todo Write a test for each piece
     */
    public function testPawnPromotion()
    {
        // Arrange
        $value = 'e8=Q';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(Notation::PIECE_PAWN, $notation->getMovedPiece());
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(8, $notation->getTargetRow());
        static::assertEquals(Notation::PIECE_QUEEN, $notation->getPromotedPiece());
    }

    /**
     * @todo Write a test for each piece
     */
    public function testGetTargetColumnIndex()
    {
        // Arrange
        $value = 'e8';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals('e', $notation->getTargetColumn());
        static::assertEquals(4, $notation->getTargetColumnIndex());
    }

    public function testTargetColumnIndexIsNullOnCastling()
    {
        // Arrange
        $value = 'O-O';

        // Act
        $notation = new Notation($value);

        // Assert
        static::assertEquals(null, $notation->getTargetColumnIndex());
    }

    public function testWithTargetColumnIndex()
    {
        // Arrange
        $notation = new Notation('e4');

        // Act
        $result = $notation->withTargetColumnIndex(0);

        // Assert
        static::assertEquals(0, $result->getTargetColumnIndex());
    }

    /**
     * @expectedException RuntimeException
     */
    public function testWithTargetColumnIndexThrowsExceptionWhenNoRow()
    {
        // Arrange
        $notation = new Notation('O-O');

        // Act
        $notation->withTargetColumnIndex(0);

        // Assert
        // ...
    }

    public function testWithTargetRow()
    {
        // Arrange
        $notation = new Notation('e4');

        // Act
        $result = $notation->withTargetRow(3);

        // Assert
        static::assertEquals(3, $result->getTargetRow());
    }

    public function testGetTargetNotation()
    {
        // Arrange
        $notation = new Notation('e4');

        // Act
        $result = $notation->getTargetNotation();

        // Assert
        static::assertEquals('e4', $result);
    }

    public function testToString()
    {
        // Arrange
        $notation = new Notation('e4');

        // Act
        $result = $notation->toString();

        // Assert
        static::assertEquals('e4', $result);
    }

    public function testNativeToString()
    {
        // Arrange
        $notation = new Notation('e4');

        // Act
        $result = (string)$notation;

        // Assert
        static::assertEquals('e4', $result);
    }
}
