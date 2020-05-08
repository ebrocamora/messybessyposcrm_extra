<?php


namespace Modules\System\Traits;


trait HasActionAttribute
{

    /**
     * Set object dynamic attribute
     *
     * @param $attribute
     * @param $value
     * @return $this
     */
    public function set($attribute, $value)
    {
        $this->$attribute = $value;

        return $this;
    }

    /**
     * Return object attribute
     *
     * @param $attribute
     * @return mixed
     */
    public function get($attribute)
    {
        return $this->$attribute;
    }

    /**
     * Set object data
     *
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}