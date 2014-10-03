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
        $this->toPostfix('3 + 4 * 5')->shouldReturn('3 4 5 * +');
    }

    function it_processes_input_with_parentheses()
    {
        $this->toPostfix('2 * ( 3 + ( 4 - 5) )')->shouldReturn('2 x - x 4 x - * +');
    }

    function it_can_also_process_exponents()
    {
        $this->toPostfix('( 7 - 8 / x ^ 2 + 5 * x - 4 ) * ( x - 6 )')
            ->shouldReturn('7 8 x 2 ^ / - 5 x * + 4 - x 6 - *');
    }


}
