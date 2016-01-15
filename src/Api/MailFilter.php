<?php

namespace Dreamhost\Api;

use Dreamhost\Api\MailFilterInterface;
use Dreamhost\Exceptions\InvalidFilterException;

class MailFilter implements MailFilterInterface
{
    // List of valid "filter on"
    public static $validFilterOn = [
        'subject', 'from', 'to', 'cc', 'body', 'reply-to', 'headers'
    ];

    // List of valid actions
    public static $validAction = [
        'move','forward','delete','add_subject' ,'forward_shell', 'and', 'or'
    ];

    // Email address
    protected $address;

    // subject, from, to, cc, body, reply-to, headers.
    protected $filterOn;

    // what to filter for (case sensitive)
    protected $filter;

    // move,forward,delete,add_subject,forward_shell, and, or.
    protected $action;

    // the parameter for the action (note: optional if action is delete, and, or).
    protected $actionValue = null;

    //  yes or no (optional, default is yes).
    protected $contains = true;

    // yes or no (optional, default is yes. note: must be yes if action is delete).
    protected $stop = true;

    // the rank of the filter, indexes from 0, lower means executed first
    // (optional, default is the number of filters for the address).
    protected $rank = 0;

    /**
     * Make new MailFilter Instance
     *
     * @param  array  $params
     * @return Dreamhost\Api\MailFilter
     */
    public static function make($params = [])
    {
        $instance = new static;

        if (count($params) < 1) {
            return $instance;
        }

        foreach ($params as $key => $value) {
            if (isset($instance->{$key})) {
                $instance->{$key} = $value;
            }
        }

        return $instance;
    }

    private function getBoolean($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function address($address)
    {
        $this->address = $address;
        return $this;
    }

    public function filterOn($filterOn)
    {
        if (!in_array($filterOn, self::$validFilterOn)) {
            throw new InvalidFilterException("Invalid value for filter on parameter");
        }

        $this->filterOn = $filterOn;
        return $this;
    }

    public function contains($contains)
    {
        $this->contains = $this->getBoolean($contains);
        return $this;
    }

    public function stop($stop)
    {
        $this->stop = $this->getBoolean($stop);
        return $this;
    }

    public function filter($filter)
    {
        $this->filter = $filter;
        return $this;
    }

    public function action($action)
    {
        if (!in_array($action, self::$validAction)) {
            throw new InvalidFilterException("Invalid value for action parameter");
        }

        $this->action = $action;
        return $this;
    }

    public function actionValue($value)
    {
        $this->actionValue = $value;
        return $this;
    }

    public function rank($rank)
    {
        $this->rank = $rank;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getFilterOn()
    {
        return $this->filterOn;
    }

    public function getFilter()
    {
        return $this->filter;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getActionValue()
    {
        return $this->actionValue;
    }

    public function getContains()
    {
        return $this->contains ? 'yes' : 'no';
    }

    public function getStop()
    {
        return $this->stop ? 'yes' : 'no';
    }

    public function getRank()
    {
        return intval($this->rank);
    }

    public function toKeyValueArray()
    {
        return [
            'address'      => $this->getAddress(),
            'filter_on'    => $this->getFilterOn(),
            'filter'       => $this->getFilter(),
            'action'       => $this->getAction(),
            'action_value' => $this->getActionValue(),
            'contains'     => $this->getContains(),
            'stop'         => $this->getStop(),
            'rank'         => $this->getRank()
        ];
    }
}
