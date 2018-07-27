<?php

namespace Impala\Api;

trait Bill
{
    /**
     * Get a specific bill given its ID.
     *
     * @param string $billId ID of the bill to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getBillById(string $billId)
    {
        return $this->get('bill/' . $billId);
    }

    /**
     * Get all charges for a specific bill.
     *
     * @param string $billId ID of the bill to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getChargesForBill(string $billId)
    {
        return $this->get('bill/' . $billId . '/charge');
    }

    /**
     * Get a specific charge for a specific bill given its IDs.
     *
     * @param string $billId   ID of the bill.
     * @param string $chargeId ID of the charge to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getChargeByIdForBill(string $billId, string $chargeId)
    {
        return $this->get('bill/' . $billId . '/charge/' . $chargeId);
    }

    /**
     * Create a new charge for a specific bill.
     *
     * @param string $billId ID of the bill.
     * @param array  $data   The data to create the new charge.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createChargeForBill(string $billId, array $data)
    {
        return $this->post('bill/' . $billId . '/charge', [], $data);
    }

    /**
     * Refund a specific charge for a specific bill.
     *
     * @param string $billId   ID of the bill.
     * @param string $chargeId ID of the charge to refund.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function refundChargeByIdForBill(string $billId, string $chargeId)
    {
        return $this->post(
            'bill/' . $billId . '/charge/' . $chargeId . '/refund'
        );
    }

    /**
     * Get all payments for a specific bill.
     *
     * @param string $billId ID of the bill to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPaymentsForBill(string $billId)
    {
        return $this->get('bill/' . $billId . '/payment');
    }

    /**
     * Get a specific payment for a specific bill given its IDs.
     *
     * @param string $billId    ID of the bill.
     * @param string $paymentId ID of the payment to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getPaymentByIdForBill(string $billId, string $paymentId)
    {
        return $this->get('bill/' . $billId . '/payment/' . $paymentId);
    }

    /**
     * Create a new charge for a specific bill.
     *
     * @param string $billId ID of the bill.
     * @param array  $data   The data to create the new payment.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createPaymentForBill(string $billId, array $data)
    {
        return $this->post('bill/' . $billId . '/payment', [], $data);
    }

    /**
     * Refund a specific payment for a specific bill.
     *
     * @param string $billId    ID of the bill.
     * @param string $paymentId ID of the payment to refund.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function refundPaymentByIdForBill(string $billId, string $paymentId)
    {
        return $this->post(
            'bill/' . $billId . '/payment/' . $paymentId . '/refund'
        );
    }
}
