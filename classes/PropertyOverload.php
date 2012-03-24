<?php
/**
 * TITLE
 *
 * @access public
 * @author ymc-frne <frank.neff@ymc.ch>
 * @license ymc standard license <license@ymc.ch>
 * @since 2012/03/21
 */

/**
 * Class PropertyOverload
 */
abstract class PropertyOverload
{
    /**
     * @var array
     */
    protected $data = array();

    /**
     * @param $key
     * @param $value
     *
     * @throws RuntimeException
     */
    public function __set( $key, $value )
    {
        if ( is_string( $key ) and is_string( $value ) )
        {
            $this->data[$key] = $value;
        }
        else
        {
            throw new RuntimeException( "Please provide a name and a value!" );
        }
    }

    /**
     * @param $key
     * @return mixed
     * @throws RuntimeException
     */
    public function __get( $key )
    {
        if ( array_key_exists( $key, $this->data ) )
        {
            return $this->data[$key];
        }
        else
        {
            $trace = debug_backtrace();
            $message = 'Undefined property via __get(): ' . $key . ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'];

            throw new RuntimeException($message);
        }
    }

    /**
     * @param $key
     * @return bool
     */
    public function __isset( $key )
    {
        return isset( $this->data[$key] );
    }

    /**
     * @param $key
     */
    public function __unset( $key )
    {
        unset( $this->data[$key] );
    }

    public function getData()
    {
        return $this->data;
    }
}
