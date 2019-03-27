<?php

namespace Omnipay\Sberbank\Util;

use Fiscal\OFD\OrderDeliverableInterface;
use Fiscal\OFD\OrderInterface;
use Fiscal\OFD\OrderItemDetailsInterface;
use Fiscal\OFD\OrderItemDiscountInterface;
use Fiscal\OFD\OrderItemInterface;
use Fiscal\OFD\OrderItemTaxableInterface;

class FiscalOFDAdapter
{
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
     * Return orderBundle
     *
     * @return array
     */
    public function getOrderBundle(): array
    {
        $orderBundle = [
            'orderCreationDate' => $this->formatOrderCreationDate(),
            'cartItems'         => [],
            'customerDetails'   => $this->customerToArray() ?: null,
        ];

        $orderBundle['cartItems']['items'] = array_map([$this, 'cartItemToArray'], $this->order->getItems());

        if ($this->order instanceof OrderDeliverableInterface) {
            $deliveryInfo = [
                'deliveryType' => $this->order->getDeliveryType(),
                'country'      => $this->order->getCountry(),
                'city'         => $this->order->getCity(),
                'postAddress'  => $this->order->getPostAddress(),
            ];

            if ($deliveryInfo = array_filter($deliveryInfo)) {
                $orderBundle['customerDetails']['deliveryInfo'] = $deliveryInfo;
            }

            if ($this->order->getDeliveryOrderItem() !== null) {
                $orderBundle['cartItems']['items'][] = $this->cartItemToArray($this->order->getDeliveryOrderItem());
            }
        }

        return $orderBundle;
    }

    /**
     * Return refundItems
     *
     * @return array
     */
    public function getRefundItems(): array
    {
        $refundItems = ['items' => array_map([$this, 'cartItemToArray'], $this->order->getItems())];
        if ($this->order instanceof OrderDeliverableInterface && $this->order->getDeliveryOrderItem() !== null) {
            $refundItems['items'][] = $this->cartItemToArray($this->order->getDeliveryOrderItem());
        }

        return $refundItems;
    }

    /**
     * Return refundItems
     *
     * @return array
     */
    public function getDepositItems(): array
    {
        $depositItems = ['items' => array_map([$this, 'cartItemToArray'], $this->order->getItems())];
        if ($this->order instanceof OrderDeliverableInterface && $this->order->getDeliveryOrderItem() !== null) {
            $depositItems['items'][] = $this->cartItemToArray($this->order->getDeliveryOrderItem());
        }

        return $depositItems;
    }

    /**
     * Transform Cart item to array.
     *
     * @param OrderItemInterface $cartItem
     *
     * @return array
     */
    protected function cartItemToArray(OrderItemInterface $cartItem): array
    {
        $cartItemAsArray = [
            'positionId'   => $cartItem->getPositionId(),
            'name'         => $cartItem->getName(),
            'quantity'     => [
                'value'   => $cartItem->getQuantity(),
                'measure' => $cartItem->getMeasure(),
            ],
            'itemAmount'   => $cartItem->getAmount() * 100,
            'itemCode'     => $cartItem->getCode(),
            'itemPrice'    => $cartItem->getPrice() * 100,
            'itemCurrency' => $cartItem->getCurrency(),
        ];

        if ($cartItem instanceof OrderItemDetailsInterface) {
            $cartItemAsArray['itemDetails'] = $cartItem->getDetailParams();
        }

        if ($cartItem instanceof OrderItemDiscountInterface) {
            $cartItemAsArray['discount']['discountValue'] = $cartItem->getDiscountValue();
            $cartItemAsArray['discount']['discountType'] = $cartItem->getDiscountType();
        }

        if ($cartItem instanceof OrderItemTaxableInterface) {
            $cartItemAsArray['tax'] = array_filter(
                [
                    'taxSum'  => $cartItem->getTaxSum(),
                    'taxType' => $cartItem->getTaxType(),
                ]
            );
        }

        return array_filter($cartItemAsArray);
    }

    /**
     * Transform Customer to array.
     *
     * @return array
     */
    private function customerToArray(): array
    {
        $customerData = [];

        if ($this->order->getCustomer() !== null) {
            $customerData = [
                'email'   => $this->order->getCustomer()->getEmail(),
                'phone'   => $this->order->getCustomer()->getPhone(),
                'contact' => $this->order->getCustomer()->getContact(),
            ];
        }

        return array_filter($customerData);
    }

    /**
     * Format order creation date
     *
     * @return int|string
     */
    private function formatOrderCreationDate(): string
    {
        return $this->order->getCreationDate() !== null ? $this->order->getCreationDate()->format('U') : (string) time();
    }
}