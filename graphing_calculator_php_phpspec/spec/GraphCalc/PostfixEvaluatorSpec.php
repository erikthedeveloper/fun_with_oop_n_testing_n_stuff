<?php

namespace spec\GraphCalc;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostfixEvaluatorSpec extends ObjectBehavior
{
    function it_performs_basic_math()
    {
        $this->evaluate('3 4 5 * +')->shouldReturn(23);
    }

    function it_performs_basic_math_again()
    {
        $this->evaluate('8 4 2 / -')->shouldReturn(6);
    }

    function it_evaluates_expressions_containing_the_variable_x()
    {

    }

    function it_evaluates_insane_nested_expression_with_exponents_and_parentheses_from_class()
    {
        //$this->evaluate('7 8 x 2 ^ / - 5 x * + 4 - x 6 - *')->shouldReturn('ANSWER NOT KNOWN');
    }
}
