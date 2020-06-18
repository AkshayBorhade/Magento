<?php

namespace Custom\Inquiry\Api;

interface Inquiry {

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
