<?php
namespace Allure\Affiliate\Block\Account\Withdraw;

class View extends \Allure\Affiliate\Block\Account\Withdraw
{
	public function getWithdraw()
	{
		return $this->registry->registry('withdraw_view_data');
	}

	public function getPaymentDetail()
	{
		$withdraw = $this->getWithdraw();

		return $withdraw->getPaymentModel()->getPaymentDetail();
	}
}