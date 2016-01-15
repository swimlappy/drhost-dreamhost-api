<?php

namespace Dreamhost\Api;

interface MailFilterInterface
{
    public function getAddress();

    public function getFilterOn();

    public function getFilter();

    public function getAction();

    public function getActionValue();

    public function getContains();

    public function getStop();

    public function getRank();

    public function toKeyValueArray();
}
