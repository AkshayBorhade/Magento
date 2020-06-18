<?php

namespace Custom\Appointment\Api;

interface Appointment {

    /**
     * @api
     * @return string
     */
    public function getAll();

    /**
     * @api
     * @param string $id
     * @return string
     */
    public function getById($id);
}
