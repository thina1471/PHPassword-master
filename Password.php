<?php

declare(strict_types=1);

class Password
{	
	private static $RANGE_SPECIALS = array(
		0 => array("start" => 33, "end" => 47),
		1 => array("start" => 58, "end" => 64),
		2 => array("start" => 91, "end" => 96),
		3 => array("start" => 123, "end" => 126),
	);
	private static $RANGE_DIGITS = array("start" => 48, "end" => 57);
	private static $RANGE_CAPITALS = array("start" => 65, "end" => 90);
	private static $RANGE_LOWERS = array("start" => 97, "end" => 122);

	static function createPassword(int $length, int $MIN_DIGITS, int $MIN_CAPITALS, int $MIN_LOWERS, int $MIN_SPECIALS): string
	{
		return self::generatePassword($length, $MIN_DIGITS, $MIN_CAPITALS, $MIN_LOWERS, $MIN_SPECIALS);
	}

	private static function generatePassword(int $length, int $MIN_DIGITS, int $MIN_CAPITALS, int $MIN_LOWERS, int $MIN_SPECIALS): string
	{
		$specials = self::generateSpecialsPiece($MIN_SPECIALS);
		$digits = self::generatePasswordPiece($MIN_DIGITS, self::$RANGE_DIGITS);
		$lowers = self::generatePasswordPiece($MIN_LOWERS, self::$RANGE_LOWERS);
		$capitals = self::generatePasswordPiece($MIN_CAPITALS, self::$RANGE_CAPITALS);

		$passwordRest = self::randomPieceLength($length, $MIN_DIGITS, $MIN_SPECIALS, $MIN_CAPITALS, $MIN_LOWERS);
		$random = self::generateRandomPiece($passwordRest);
		
		$password = $specials.$digits.$lowers.$capitals.$random;

		return self::shufflePassword($password);
	}

	private static function generatePasswordPiece(int $MIN, array $piece): string {
		$passwordPiece = "";
		for ($position = 0; $position < $MIN; $position++) { 
			$passwordPiece = $passwordPiece.chr(random_int($piece["start"], $piece["end"]));
		}
		return $passwordPiece;
	}

	private static function generateSpecialsPiece(int $MIN_SPECIALS): string {
		$passwordPiece = "";
		for ($position = 0; $position < $MIN_SPECIALS; $position++) {
			$specialsGroup = self::$RANGE_SPECIALS[self::selectSpecialGroup()];
			$passwordPiece.chr(random_int($specialsGroup["start"], $specialsGroup["end"]));
		}
		return $passwordPiece;
	}

	private static function generateRandomPiece(int $REST): string {
		$passwordPiece = "";
		for ($position = 0; $position < $REST; $position++) {
			$character = self::selectCharacter();
			$passwordPiece = $passwordPiece.$character;
		}
		return $passwordPiece;
	}

	private static function randomPieceLength(int $length, int ...$minus): int {
		$toRest = array_sum($minus);
		return $length - $toRest;
	}

	private static function shufflePassword($password) {
		return str_shuffle(str_shuffle($password));
	}

	private static function selectCharacter(): string
	{
		$selectedGroup = self::selectCharacterType();
		$characterCode = random_int($selectedGroup["start"], $selectedGroup["end"]);
		return chr($characterCode);
	}

	private static function selectCharacterType(): array
	{
		switch (random_int(0, 3)) {
			case 0: return self::$RANGE_SPECIALS[self::selectSpecialGroup()];
			case 1: return self::$RANGE_DIGITS;
			case 2: return self::$RANGE_LOWERS;
			case 3: return self::$RANGE_CAPITALS;
		}
	}

	private static function selectSpecialGroup(): int
	{
		return random_int(0, count(self::$RANGE_SPECIALS) - 1);
	}
}