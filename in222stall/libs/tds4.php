<?php
/**
 * @file tds4.php
 * @brief tdsHash is hashing system + choose salt + choose cycle times
 * @author MartonBash Development
 * @version 4.12c
 * @last update 4 August 2012
 * @copyright tunnckoCore / mameto_100 [at] mail [dot] bg
 */
	/** ver4 with salt, hash rounder, cryptLevel & crypterVersion
	 * tds4 hash method
	 * 
	 * @date 4 August 2012
	 * @signature SALTLIA
	 * @author tunnckoCore
	 * @desc Encode data to tds4 with salt (i.e. hashkey). Like md5, sha1, sha256, crc32, etc.
	 * Reason for this code is more security with own hashing system and salt. Combine of md5 hash, sha1, crc32 and salt.
	 * 
	 * @codename tds4
	 *
	 *
	 * @uses of tds4 hash
	 *
	 *	@param 1 - string $data								- The data to encode
	 *	@param 2 - integer $salt							- Set hashkey 'On' and use your hash key
	 *	@param 3 - integar $cryptLevel						- Hash level security 		- DONT CHANGE !
	 *	@param 4 - integar $crypterVersion					- Hash version				- DONT CHANGE !
	 *	@param 5 - integar $cycleRounds						- How many times round the hashing loop
	 *
		//You can define your own hashkey with: define('TDSHASH_SALT_KEY', 'my_security_hashkey');
		
		// your hashkey - Off		(uses system default hashkey)
		// hash-rounder - Off		(uses system default rounds number)
		tds4($data, 0, 5, 4);
		Return: 10 symbols - because hash-rounder < '10'
		
		// your hashkey - On		(uses hashkey what you want)
		// hash-rounder - Off		(uses system default rounds number)
		tds4($data, 1, 5, 4);
		Return: 10 symbols - because hash-rounder < '10'
		
		// your hashkey - On		(uses hashkey what you want)
		// hash-rounder - On		(uses rounds number what you want (for example 14))
		tds4($data, 1, 5, 4, 14);
		Return: 11 symbols - because hash-rounder >= '10'
		
		// your hashkey - Off		(uses system default hashkey)
		// hash-rounder - On		(uses rounds number what you want (for example 14))
		tds4($data, 0, 5, 4, 14);
		Return: 11 symbols - because hash-rounder >= '10'
	
	 *
	 **/
	 
	 
		 
	/* Psycho Security Cycle */
	function tds4($data, $salt = 1, $cryptLevel = 5, $crypterVersion = 4, $cycleRounds = null) {
	
		// if $salt set to 1, we use TDSHASH_SALT_KEY in hashing process..
		if($salt == 1) {
			if(defined('TDSHASH_SALT_KEY')) {
				$salton = TDSHASH_SALT_KEY;
				/* Security level 1 */
				$sha1s = sha1($data) + sha1($salton);				// sha1 encode $data and $salton
				$md5s = md5($data) + md5($salton);				// md5 encode $data and $salton
				$crc32s = crc32($data) + crc32($salton);			// crc32 encode $data and $salton
				
				/* Security level 2 */
				$secure1 = $sha1s + $md5s + $crc32s;
				$secure2 = $sha1s + $data + $md5s + $salton + $crc32s + $data + $salton;
				
				/* Level 3 - again crazy mind is here */
				$doom = $secure1 + $data + $secure2 + $salton + $secure1 + $data;
				$doomsday = sha1($doom) + md5($secure2) + md5($doom) + $doom + crc32($secure2) + md5($data) + sha1(crc32($salton));
				$demonology = crc32($doomsday) + md5($doomsday) + sha1($doom) + $data + $salton;
				
				/* The Absolute Final */
				$result = $demonology + $doomsday + $doom + $secure2 + $secure1 + md5($demonology) + crc32($demonology) + sha1($doomsday);
				$finalresult = sha1($doom) + md5($doomsday) + $result;
				
				/* Return result */
				if($cycleRounds == null) {
					$cycleRounds = 4;
					if($cryptLevel == 5 && $crypterVersion == 4) {
						$algo = $cycleRounds . $finalresult . $crypterVersion . $cryptLevel;
					} else { return false; }
				} else { 
					if($cryptLevel == 5 && $crypterVersion == 4) {
						$algo = $cycleRounds . $finalresult . $crypterVersion . $cryptLevel;
					} else { return false; }
				}
				
				return crc32($algo) * $cycleRounds;
			}			
			
		// if $salt set to 0, we use DEFAULT STRING in hashing process..
		} elseif($salt == 0) {
			
			$salton = "tds4hasher";					// by defaut
			
			/* Security level 1 */
			$sha1s = sha1($data) + sha1($salton);		// sha1 encode $data and $salton
			$md5s = md5($data) + md5($salton);		// md5 encode $data and $salton
			$crc32s = crc32($data) + crc32($salton);	// crc32 encode $data and $salton
			
			/* Security level 2 */
			$secure1 = $sha1s + $md5s + $crc32s;
			$secure2 = $sha1s + $data + $md5s + $salton + $crc32s + $data + $salton;
			
			/* Level 3 - again crazy mind is here */
			$doom = $secure1 + $data + $secure2 + $salton + $secure1 + $data;
			$doomsday = sha1($doom) + md5($secure2) + md5($doom) + $doom + crc32($secure2) + md5($data) + sha1(crc32($salton));
			$demonology = crc32($doomsday) + md5($doomsday) + sha1($doom) + $data + $salton;
			
			/* The Absolute Final */
			$result = $demonology + $doomsday + $doom + $secure2 + $secure1 + md5($demonology) + crc32($demonology) + sha1($doomsday);
			$finalresult = sha1($doom) + md5($doomsday) + $result;
			
			/* Return result */
			if($cycleRounds == null) {
				$cycleRounds = 4;
				if($cryptLevel == 5 && $crypterVersion == 4) {
					$algo = $cycleRounds . $finalresult . $crypterVersion . $cryptLevel;
				} else { return false; }
			} else { 
				if($cryptLevel == 5 && $crypterVersion == 4) {
					$algo = $cycleRounds . $finalresult . $crypterVersion . $cryptLevel;
				} else { return false; }
			}
			
			return crc32($algo) * $cycleRounds;
		}
		
	}
	
	
	
	