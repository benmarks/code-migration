<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Migration\Code\Processor\Mage\MageFunction;

use Magento\Migration\Code\Processor\Mage\MageFunctionInterface;

class ThrowException extends AbstractFunction implements \Magento\Migration\Code\Processor\Mage\MageFunctionInterface
{
    /**
     * @var string
     */
    protected $diClass = null;

    /**
     * @var string
     */
    protected $methodName = 'throwException';

    /**
     * @var int
     */
    protected $endIndex = null;

    /**
     * @var string
     */
    protected $diVariableName = null;

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return MageFunctionInterface::MAGE_THROW_EXCEPTION;
    }

    /**
     * @inheritdoc
     */
    public function getClass()
    {
        return $this->diClass;
    }

    /**
     * @inheritdoc
     */
    public function getMethod()
    {
        return $this->methodName;
    }

    /**
     * @inheritdoc
     */
    public function getStartIndex()
    {
        return $this->index;
    }

    /**
     * @inheritdoc
     */
    public function getEndIndex()
    {
        return $this->index + 2;
    }

    /**
     * @inheritdoc
     */
    public function convertToM2()
    {
        $indexOfMethodCall = $this->index + 2;
        $currentIndex = $this->index;

        while ($currentIndex <= $indexOfMethodCall) {
            if (is_array($this->tokens[$currentIndex])) {
                $this->tokens[$currentIndex][1] = '';
            } else {
                $this->tokens[$currentIndex] = '';
            }
            $currentIndex++;
        }
        $this->tokens[$this->index] = 'throw new \Magento\Framework\Exception\LocalizedException';

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDiVariableName()
    {
        return $this->diVariableName;
    }

    /**
     * @inheritdoc
     */
    public function getDiClass()
    {
        return $this->getClass();
    }
}