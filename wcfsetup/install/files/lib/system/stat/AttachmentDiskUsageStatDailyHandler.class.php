<?php
namespace wcf\system\stat;

/**
 * Stat handler implementation for attachment disk usage.
 * 
 * @author	Marcel Werk
 * @copyright	2001-2015 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	com.woltlab.wcf
 * @subpackage	system.stat
 * @category	Community Framework
 */
class AttachmentDiskUsageStatDailyHandler extends AbstractDiskUsageStatDailyHandler {
	/**
	 * @see	\wcf\system\stat\IStatDailyHandler::getData()
	 */
	public function getData($date) {
		return array(
			'counter' => $this->getCounter($date, 'wcf'.WCF_N.'_attachment', 'uploadTime'),
			'total' => $this->getTotal($date, 'wcf'.WCF_N.'_attachment', 'uploadTime')
		);
	}
}
