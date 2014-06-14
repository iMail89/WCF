<?php
namespace wcf\data\ad;
use wcf\data\object\type\ObjectTypeCache;
use wcf\data\DatabaseObjectEditor;
use wcf\data\IEditableCachedObject;
use wcf\system\cache\builder\AdCacheBuilder;
use wcf\system\cache\builder\ConditionCacheBuilder;
use wcf\system\WCF;

/**
 * Provides functions to edit ads.
 * 
 * @author	Matthias Schmidt
 * @copyright	2001-2014 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	com.woltlab.wcf
 * @subpackage	data.ad
 * @category	Community Framework
 */
class AdEditor extends DatabaseObjectEditor implements IEditableCachedObject {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\ad\Ad';
	
	/**
	 * Sets the show order of the ad.
	 * 
	 * @param	integer		$showOrder
	 */
	public function setShowOrder($showOrder = 0) {
		$newShowOrder = 1;
		
		$sql = "SELECT	MAX(showOrder)
			FROM	wcf".WCF_N."_ad";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute();
		$maxShowOrder = $statement->fetchColumn();
		if (!$maxShowOrder) $maxShowOrder = 0;
		
		if (!$showOrder || $showOrder > $maxShowOrder) {
			$newShowOrder = $maxShowOrder + 1;
		}
		else {
			// shift other ads
			$sql = "UPDATE	wcf".WCF_N."_ad
				SET	showOrder = showOrder + 1
				WHERE	showOrder >= ?";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array(
				$showOrder
			));
			
			$newShowOrder = $showOrder;
		}
		
		$this->update(array(
			'showOrder' => $newShowOrder
		));
	}
	
	/**
	 * @see	\wcf\data\IEditableCachedObject::resetCache()
	 */
	public static function resetCache() {
		AdCacheBuilder::getInstance()->reset();
		ConditionCacheBuilder::getInstance()->reset(array(
			'definitionID' => ObjectTypeCache::getInstance()->getDefinitionByName('com.woltlab.wcf.condition.ad')->definitionID
		));
	}
}