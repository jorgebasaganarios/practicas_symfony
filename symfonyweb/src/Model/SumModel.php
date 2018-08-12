<?php
/**
 * xenFramework (http://xenframework.com/)
 *
 * This file is part of the xenframework package.
 *
 * (c) Ismael Trascastro <itrascastro@xenframework.com>
 *
 * @link        http://github.com/xenframework for the canonical source repository
 * @copyright   Copyright (c) xenFramework. (http://xenframework.com)
 * @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Model;

class SumModel
{
    public $num1;
    public $num2;
    public function __construct($num1, $num2)
    {
        $this->setNum1($num1);
        $this->setNum2($num2);
    }
    /**
     * @return mixed
     */
    public function getNum1()
    {
        return $this->num1;
    }
    /**
     * @param mixed $op1
     * @return $this
     */
    public function setNum1($num1)
    {
        $this->num1 = (int) $num1;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getNum2()
    {
        return $this->num2;
    }
    /**
     * @param mixed $op2
     * @return $this
     */
    public function setNum2($num2)
    {
        $this->num2 = (int) $num2;
        return $this;
    }

    public function sum()
    {
        $this->setResult($this->getNum1() + $this->getNum2());
    }
    public function substract()
    {
        $this->setResult($this->getNum1() - $this->getNum2());
    }
    public function multiply()
    {
        $this->setResult($this->getNum1() * $this->getNum2());
    }
    public function divide()
    {
        $this->setResult($this->getNum1() / $this->getNum2());
    }
    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }
    /**
     * @param mixed $result
     * @return $this
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }
}