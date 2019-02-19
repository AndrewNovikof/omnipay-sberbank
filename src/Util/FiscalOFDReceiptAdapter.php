<?php

namespace Omnipay\Sberbank\Util;

use Fiscal\OFD\OrderDeliverableInterface;
use Fiscal\OFD\OrderInterface;
use Fiscal\OFD\OrderItemInterface;
use Fiscal\OFD\OrderItemTaxableInterface;

class FiscalOFDReceiptAdapter
{
    /**
     * Order item position id
     *
     * @var int|null
     */
    private $position;

    /**
     * @var OrderInterface
     */
    private $order;

    /**
     * @param OrderInterface $order
     */
    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function getOrderBundle(): array
    {
        $array = [
            'orderCreationDate' => $this->order->getCreationDate() !== null ? $this->order->getCreationDate()->format('U') : time(),
            'cartItems'         => [],
            'customerDetails'   => $this->customerToArray() ?: null,
        ];

        $this->position = 1;
        $array['cartItems']['items'] = array_map([$this, 'cartItemToArray'], $this->order->getItems());

        if ($this->order instanceof OrderDeliverableInterface) {
            $deliveryInfo = [];

            foreach (['deliveryType', 'country', 'city', 'postAddress'] as $field) {
                $method = 'get' . ucfirst($field);
                $deliveryInfo[$field] = $this->order->{$method}();
            }

            if ($deliveryInfo = array_filter($deliveryInfo)) {
                $array['customerDetails']['deliveryInfo'] = $deliveryInfo;
            }

            if($this->order->getDeliveryOrderItem() !== null) {
                $array['cartItems']['items'][] = $this->cartItemToArray($this->order->getDeliveryOrderItem());
            }
        }

        return $array;
    }

    /**
     * Transform cart item to array.
     *
     * @param OrderItemInterface $cartItem
     *
     * @return array
     */
    protected function cartItemToArray(OrderItemInterface $cartItem): array
    {
        $array = [
            'positionId'   => $this->position,
            'name'         => $cartItem->getName(),
            'quantity'     => [
                'value'   => $cartItem->getQuantity(),
                'measure' => $cartItem->getMeasure(),
            ],
            'itemAmount'   => $cartItem->getAmount() * 100,
            'itemCode'     => $cartItem->getCode(),
            'itemPrice'    => $cartItem->getPrice() * 100,
            'itemDetails'  => $cartItem->getDetailParams(),
            'itemCurrency' => $cartItem->getCurrency(),
        ];

        if ($discountValue = $cartItem->getDiscountValue()) {
            $array['discount']['discountValue'] = $discountValue;
            $array['discount']['discountType'] = $cartItem->getDiscountType();
        }

        if ($cartItem instanceof OrderItemTaxableInterface) {
            $array['tax'] = array_filter(
                [
                    'taxSum'  => $cartItem->getTaxSum(),
                    'taxType' => $cartItem->getTaxType(),
                ]
            );
        }

        $this->position++;

        return array_filter($array);
    }

    /**
     * Transform customer to array.
     *
     * @return array
     */
    protected function customerToArray(): array
    {
        $customer = $this->order->getCustomer();
        $array = [];

        if ($customer !== null) {
            foreach (['email', 'phone', 'contact'] as $field) {
                $method = 'get' . ucfirst($field);
                $array[$field] = $customer->{$method}();
            }
        }

        return array_filter($array);
    }
}