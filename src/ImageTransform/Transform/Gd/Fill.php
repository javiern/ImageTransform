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
 * ImageTransform\Gd\Fill class.
 *
 * Fills the set area with a color or tile image.
 *
 * @package ImageTransform
 * @subpackage transforms
 * @author Javier Neyra
 */
class Fill extends \ImageTransform\Transform
{
  /**
   * x-coordinate.
   * @var integer
  */
  protected $x = 0;

  /**
   * y-coordinate
   * @var integer
  */
  protected $y = 0;

  /**
   * Fill.
  */
  protected $fill = null;

  /**
   * Constructor
   *
   * @param integer
   * @param integer
   * @param string/\ImageTransform\Image hex color or \ImageTransform\Image object
   */
  public function __construct($x=0, $y=0, $fill='#000000')
  {
    $this->setX($x);
    $this->setY($y);
    $this->setFill($fill);
  }

  /**
   * Sets the X coordinate
   *
   * @param integer
   * @return boolean
   */
  public function setX($x)
  {
    if (is_numeric($x))
    {
      $this->x = (int)$x;

      return true;
    }

    return false;
  }

  /**
   * Gets the X coordinate
   *
   * @return integer
   */
  public function getX()
  {
    return $this->x;
  }

  /**
   * Sets the Y coordinate
   *
   * @param integer
   * @return boolean
   */
  public function setY($y)
  {
    if (is_numeric($y))
    {
      $this->y = (int)$y;

      return true;
    }

    return false;
  }

  /**
   * Gets the Y coordinate
   *
   * @return integer
   */
  public function getY()
  {
    return $this->y;
  }

  /**
   * Sets the fill
   *
   * @param string/\ImageTransform\Image hex color or \ImageTransform\Image object
   * @return boolean
   */
  public function setFill($fill)
  {
    if ($fill instanceof \ImageTransform\Image || preg_match('/#[\d\w]{6}/',$fill))
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
   * Apply the transform to the \ImageTransform\Image object.
   *
   * @param \ImageTransform\Image
   * @return \ImageTransform\Image
   */
  protected function transform(\ImageTransform\Image $image)
  {
    $resource = $image->getAdapter()->getHolder();

    if ($this->fill instanceof \ImageTransform\Image)
    {
      imagesettile($resource, $this->fill->getAdapter()->getHolder());
      imagefill($resource, $this->x, $this->y, IMG_COLOR_TILED);
    }

    else
    {
      imagefill($resource, $this->x, $this->y, $image->getAdapter()->getColorByHex($resource, $this->fill));
    }

    return $image;
  }
}
