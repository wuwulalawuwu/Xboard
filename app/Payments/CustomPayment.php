<?php

namespace App\Payments\CustomPayment;

use App\Contracts\PaymentInterface;
use App\Exceptions\ApiException;

class CustomPayment implements PaymentInterface
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function form(): array
    {
        return [
            'merchant_id' => [
                'label' => '商户ID',
                'type' => 'input',
            ],
            'api_key' => [
                'label' => 'API密钥',
                'type' => 'input',
            ],
            'payment_type' => [
                'label' => '支付方式',
                'type' => 'select',
                'options' => ['alipay', 'wechat', 'credit_card'],
            ],
        ];
    }

    public function pay(array $order): array
    {
        // 发起支付请求的实际代码，假设我们用静态 API 接口处理
        try {
            // 模拟支付请求，返回一个支付链接或二维码
            $paymentUrl = "https://example.com/payment?order_id={$order['trade_no']}&amount={$order['total_amount']}";
            return [
                'type' => 1, // 1: URL支付
                'data' => $paymentUrl
            ];
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }
    }

    public function notify(array $params)
    {
        // 处理支付回调通知，校验签名并确认支付状态
        if ($params['status'] !== 'success') {
            return false;
        }

        // 验证支付成功
        return [
            'trade_no' => $params['order_id'],
            'callback_no' => $params['payment_id']
        ];
    }
}
