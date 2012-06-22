<?php

/**
 * This file is part of the Image Transform Library.
 * (c) 2012 Javier Neyra 
 * 
 * Based on sfImageTransform from Stuart Lowes <stuart.lowes@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ImageTransform;

/**
 *
 * \ImageTransform\Adapter class.
 *
 * Adapter abstract class.
 *
 * @package ImageTransform
 * @subpackage Adapters
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @author Javier Neyra
 */
abstract class Adapter
{

    /**
     * Image filename.
     * 
     * @access protected
     * @var string
     */
    protected $filename = 'Untitled.png';

    /**
     * Default ouput mime type.
     * 
     * @access protected
     * @var string
     */
    protected $mime_type = 'image/png';

    /**
     * Quality.
     * 
     * @access protected
     * @var string
     */
    protected $quality = null;

    abstract public function create($x = 1, $y = 1);

    abstract public function load($filename, $mime);

    abstract public function loadString($string);

    abstract public function save();

    abstract public function saveAs($filename, $mime = '');

    abstract public function copy();

    abstract public function getWidth();

    abstract public function getHeight();

    abstract public function hasHolder();

    abstract public function getHolder();

    abstract public function setHolder($holder);

    abstract public function getMIMEType();

    abstract public function setMIMEType($mime);

    abstract public function __toString();

    abstract public function getAdapterName();

    /**
     * Sets the image filename
     * 
     * @param string
     * @return boolean
     */
    public function setFilename($filename)
    {
        if ('' !== $filename)
        {
            $this->filename = $filename;

            return true;
        }

        return false;
    }

    /**
     * Returns the image full filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Sets the image filename
     * 
     * @param integer Quality of the image
     * @return boolean
     */
    public function setQuality($quality)
    {
        if (is_numeric($quality) && $quality >= 0 && $quality <= 100)
        {
            $this->quality = $quality;

            return true;
        }

        return false;
    }

    /**
     * Returns the current setting for the image quality
     *
     * @return integer
     */
    public function getQuality()
    {
        return $this->quality;
    }
}