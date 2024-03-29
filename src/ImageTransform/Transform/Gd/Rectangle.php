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

namespace ImageTransform\Transform\Gd;

/**
 *
 * sfImageRectangleGD class.
 *
 * Draws a rectangle.
 *
 * Draws a rectangle on a GD image.
 *
 * @package sfImageTransform
 * @subpackage transforms
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @author Javier Neyra
 */
class Rectangle extends \ImageTransform\Transform
{

    /**
     * Start X coordinate.
     *
     * @var integer
     */
    protected $x1 = 0;

    /**
     * Start Y coordinate.
     *
     * @var integer
     */
    protected $y1 = 0;

    /**
     * Finish X coordinate.
     *
     * @var integer
     */
    protected $x2 = 0;

    /**
     * Finish Y coordinate
     *
     * @var integer
     */
    protected $y2 = 0;

    /**
     * Rectangle thickness.
     *
     * @var integer
     */
    protected $thickness = 1;

    /**
     * Hex color.
     *
     * @var string
     */
    protected $color = '';

    /**
     * Fill.
     *
     * @var string/object hex or sfImage object
     */
    protected $fill = null;

    /**
     * Line style.
     *
     * @var integer
     */
    protected $style = null;

    /**
     * Construct an sfImageBlur object.
     *
     * @param integer
     * @param integer
     * @param integer
     * @param integer
     * @param integer
     * @param integer
     * @param string/object hex or sfImage object
     * @param integer
     */
    public function __construct($x1, $y1, $x2, $y2, $thickness = 1, $color = null, $fill = null, $style = null)
    {
        $this->setStartX($x1);
        $this->setStartY($y1);
        $this->setEndX($x2);
        $this->setEndY($y2);
        $this->setThickness($thickness);
        $this->setColor($color);
        $this->setFill($fill);
        $this->setStyle($style);
    }

    /**
     * Sets the start X coordinate
     *
     * @param integer
     * @return boolean
     */
    public function setStartX($x)
    {
        if (is_numeric($x))
        {
            $this->x1 = (int) $x;

            return true;
        }

        return false;
    }

    /**
     * Gets the start X coordinate
     *
     * @return integer
     */
    public function getStartX()
    {
        return $this->x1;
    }

    /**
     * Sets the start Y coordinate
     *
     * @param integer
     * @return boolean
     */
    public function setStartY($y)
    {
        if (is_numeric($y))
        {
            $this->y1 = (int) $y;

            return true;
        }

        return false;
    }

    /**
     * Gets the Y coordinate
     *
     * @return integer
     */
    public function getStartY()
    {
        return $this->y1;
    }

    /**
     * Sets the end X coordinate
     *
     * @param integer
     * @return boolean
     */
    public function setEndX($x)
    {
        if (is_numeric($x))
        {
            $this->x2 = (int) $x;

            return true;
        }

        return false;
    }

    /**
     * Gets the end X coordinate
     *
     * @return integer
     */
    public function getEndX()
    {
        return $this->x2;
    }

    /**
     * Sets the end Y coordinate
     *
     * @param integer
     * @return boolean
     */
    public function setEndY($y)
    {
        if (is_numeric($y))
        {
            $this->y2 = (int) $y;

            return true;
        }

        return false;
    }

    /**
     * Gets the end Y coordinate
     *
     * @return integer
     */
    public function getEndY()
    {
        return $this->y2;
    }

    /**
     * Sets the thickness
     *
     * @param integer
     * @return boolean
     */
    public function setThickness($thickness)
    {
        if (is_numeric($thickness))
        {
            $this->thickness = (int) $thickness;

            return true;
        }

        return false;
    }

    /**
     * Gets the thickness
     *
     * @return integer
     */
    public function getThickness()
    {
        return $this->thickness;
    }

    /**
     * Sets the color
     *
     * @param string
     * @return boolean
     */
    public function setColor($color)
    {
        if (preg_match('/#[\d\w]{6}/', $color))
        {
            $this->color = $color;
            return true;
        }
        return false;
    }

    /**
     * Gets the color
     *
     * @return integer
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Sets the fill
     *
     * @param mixed
     * @return boolean
     */
    public function setFill($fill)
    {
        if (preg_match('/#[\d\w]{6}/', $fill) || (is_object($fill) && class_name($fill) === 'sfImage'))
        {
            $this->fill = $fill;
            return true;
        }
        return false;
    }

    /**
     * Gets the fill
     *
     * @return mixed
     */
    public function getFill()
    {
        return $this->fill;
    }

    /**
     * Sets the style
     *
     * @param integer
     * @return boolean
     */
    public function setStyle($style)
    {
        if (is_numeric($style))
        {
            $this->style = (int) $style;
            $this->color = IMG_COLOR_STYLED;

            return true;
        }

        return false;
    }

    /**
     * Gets the style
     *
     * @return integer
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Apply the transform to the sfImage object.
     *
     * @param sfImage
     * @return sfImage
     */
    protected function transform(\ImageTransform\Image $image)
    {
        $resource = $image->getAdapter()->getHolder();

        if (!is_null($this->style))
        {
            imagesetstyle($resource, $this->style);
        }

        imagesetthickness($resource, $this->thickness);

        if (!is_null($this->fill))
        {
            if (!is_object($this->fill))
            {
                imagefilledrectangle($resource, $this->x1, $this->y1, $this->x2, $this->y2, $image->getAdapter()->getColorByHex($resource, $this->fill));
            }

            if ($this->getColor() !== "" && $this->fill !== $this->getColor())
            {
                imagerectangle($resource, $this->x1, $this->y1, $this->x2, $this->y2, $image->getAdapter()->getColorByHex($resource, $this->getColor()));
            }

            if (is_object($this->fill))
            {
                $image->fill($this->x1 + $this->thickness, $this->y1 + $this->thickness, $this->fill);
            }
        }
        else
        {

            imagerectangle($resource, $this->x1, $this->y1, $this->x2, $this->y2, $image->getAdapter()->getColorByHex($resource, $this->getColor()));
        }

        return $image;
    }

}
