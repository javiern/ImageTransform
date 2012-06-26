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
 * Gamma
 *
 * Apply a gamma correction to a GD image.
 *
 * @package ImageTransform
 * @subpackage transforms
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @author Javier Neyra
 */
class Gamma extends \ImageTransform\Transform
{

    /**
     * The input gamma.
     * @var float
     */
    protected $input_gamma = 1.0;

    /**
     * The number of pixels used for the blur.
     * @var float
     */
    protected $output_gamma = 1.6;

    /**
     * Construct an Gamma object.
     *
     * @param float
     * @param float
     */
    public function __construct($input_gamma = 1.0, $output_gamma = 1.6)
    {
        $this->setInputGamma($input_gamma);
        $this->setOutputGamma($output_gamma);
    }

    /**
     * Sets the input gamma
     *
     * @param float
     * @return boolean
     */
    public function setInputGamma($gamma)
    {
        if (is_float($gamma))
        {
            $this->input_gamma = (float) $gamma;

            return true;
        }

        return false;
    }

    /**
     * Gets the input gamma
     *
     * @return integer
     */
    public function getInputGamma()
    {
        return $this->input_gamma;
    }

    /**
     * Sets the ouput gamma
     *
     * @param float
     */
    public function setOutputGamma($gamma)
    {
        if (is_numeric($gamma))
        {
            $this->ouput_gamma = (float) $gamma;

            return true;
        }
    }

    /**
     * Gets the ouput gamma
     *
     * @return integer
     */
    public function getOuputGamma()
    {
        return $this->ouput_gamma;
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
        imagegammacorrect($resource, $this->input_gamma, $this->output_gamma);

        return $image;
    }

}
