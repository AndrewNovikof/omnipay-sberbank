<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class VerifyEnrollmentResponse
 * @package Omnipay\Sberbank\Message
 */
class VerifyEnrollmentResponse extends AbstractResponse
{
    /**
     * A sign of the involvement of the card in 3DS.
     *
     * Possible values are: Y, N, U.
     *
     * @return mixed|null
     */
    public function getEnrolled()
    {
        return array_key_exists('enrolled', $this->data) ? $this->data['enrolled'] : null;
    }

    /**
     * Name of the issuing bank.
     *
     * @return mixed|null
     */
    public function getEmitterName()
    {
        return array_key_exists('emitterName', $this->data) ? $this->data['emitterName'] : null;
    }

    /**
     * Country code of the issuing bank.
     *
     * @return mixed|null
     */
    public function getEmitterCountryCode()
    {
        return array_key_exists('emitterCountryCode', $this->data) ? $this->data['emitterCountryCode'] : null;
    }
}
