<?php

namespace GraphCalc;

/**
 * Class InfixToPostfix
 * @package GraphCalc
 * @author  Erik Aybar
 */
class InfixToPostfix
{

    /**
     * @var array
     */
    protected $operators_to_values = [
        '+' => 1,
        '-' => 1,
        '*' => 2,
        '/' => 3
    ];

    /**
     * @param $infix_string
     * @return string
     * @author Erik Aybar
     */
    public function toPostfix($infix_string)
    {
        $postfix_string = "";
        $stack = [];
        $items = explode(" ", $infix_string);

        // Numbers and x go directly onto string
            // new_item -> string
        // Operations go onto stack
            // if stack empty:
                // new_op -> stack
            // elif stack_last_op < new_op:
                // new_op -> stack
            // elif stack_last_op >= new_op:
                // stack_last_op -> string
                // new_op -> stack
                // ?? If there is another operation in the stack move that one to the string as well.

        // Append remaining operators onto string
        $postfix_string = rtrim($postfix_string);
        foreach ($stack as $stack_item_operator) {
            $postfix_string .= " " . $stack_item_operator;
        }

        return $postfix_string;
    }
}
