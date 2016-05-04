<?php

/**
 * Invalid Stream Exception
 *
 * @package    Http
 * @author     Flipbox Factory <hello@flipboxfactory.com>
 * @copyright  2010-2016 Flipbox Digital Limited
 * @license    https://github.com/FlipboxFactory/Http/blob/master/LICENSE
 * @version    Release: 1.0.0
 * @link       https://github.com/FlipboxFactory/Http
 * @since      Class available since Release 1.0.0
 */

namespace Flipbox\Http\Exception;

class InvalidStreamException extends \Exception
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Invalid Stream Exception';
    }

}
