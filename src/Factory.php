<?php

/**
 * HTTP Factory
 *
 * @package    Http
 * @author     Flipbox Factory <hello@flipboxfactory.com>
 * @copyright  2010-2016 Flipbox Digital Limited
 * @license    https://github.com/FlipboxFactory/Http/blob/master/LICENSE
 * @version    Release: 1.0.0
 * @link       https://github.com/FlipboxFactory/Http
 * @since      Class available since Release 1.0.0
 */

namespace Flipbox\Http;

use Flipbox\Http\Exception\InvalidStreamException;
use Flipbox\Http\Stream\IteratorStream;
use Psr\Http\Message\StreamInterface;
use Zend\Diactoros\Stream;

class Factory
{

    /**
     * Create a new stream based on the input type.
     *
     * @param string $resource
     * @param array $options
     * @return StreamInterface
     * @throws InvalidStreamException
     */
    public static function createStream($resource = '', array $options = [])
    {

        switch (gettype($resource)) {

            case 'string':
                $stream = fopen('php://temp', 'r+');
                if ($resource !== '') {
                    fwrite($stream, $resource);
                    fseek($stream, 0);
                }
                return new Stream($stream, $options);

            case 'resource':
                return new Stream($resource, $options);

            case 'object':

                if ($resource instanceof StreamInterface) {

                    return $resource;

                } elseif ($resource instanceof \Traversable) {

                    return new IteratorStream($resource, $options);

                } elseif (method_exists($resource, '__toString')) {

                    return static::createStream((string)$resource, $options);

                }
                break;

            case 'NULL':
                return new Stream('php://temp', 'r+');

        }

        throw new InvalidStreamException(
            'Invalid resource type: ' . gettype($resource)
        );

    }

}