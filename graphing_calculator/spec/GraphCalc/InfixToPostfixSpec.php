<?php

namespace spec\GraphCalc;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InfixToPostfixSpec extends ObjectBehavior
{

    function it_converts_simple_addition_to_postfix()
    {
        $this->toPostfix('x + 2 + 9')->shouldReturn('x 2 9 +');
    }

    function it_converts_addition_and_multiplication_to_postfix()
    {
        $this->toPostfix('x + 2 + 9 * 3')->shouldReturn('x 2 + 9 3 *');
    }


}
