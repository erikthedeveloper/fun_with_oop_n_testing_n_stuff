<?php

namespace GraphCalc;

/**
 * Class InfixToPostfix
 * @package GraphCalc
 * @author  Erik Aybar
 */
class InfixToPostfix
{

    protected $priorities = [
        '+' => 1,
        '-' => 1,
        '*' => 2,
        '/' => 2,
        '^' => 3
    ];

    /**
     * @param $infix_string
     * @return string
     * @author Erik Aybar
     */
    public function toPostfix($infix_string)
    {
        $postfix_string = "";
        $stack          = [];
        $items          = explode(" ", $infix_string);

        foreach ($items as $cur_item):
            // - - operands
            // always straight to string
            if (preg_match('/[\dx]/', $cur_item)) {
                // new_item -> string
                $postfix_string .= "{$cur_item} ";
                continue;
            }

            // - - "(" TODO
            // straight to stack

            // - - operator
            if (empty($stack)) {
                array_push($stack, $cur_item);
                continue;
            }

            // (a bigger can only sit on smaller)
            if ($this->opValue($cur_item) > $this->opValue($stack[count($stack) - 1])) {
                array_push($stack, $cur_item);
                continue;
            }

            while(
                count($stack)
                &&
                $this->opValue($cur_item) <= $this->opValue($stack[count($stack) - 1])
            ) {
                $popped = array_pop($stack);
                $postfix_string .= "{$popped} ";
            }

            array_push($stack, $cur_item);

            // - - ")" TODO
            // pop off everything until ")"
            // Discard ")"

        endforeach;

        // Pop remaining operators
        $reversed_stack = array_reverse($stack);
        foreach($reversed_stack as $operator) {
            $postfix_string .= "{$operator} ";
        }
        $postfix_string = rtrim($postfix_string);

        return $postfix_string;
    }

    /**
     * @param $infix_string
     * @return string
     * @author Erik Aybar
     */
    public function OLDtoPostfix($infix_string)
    {
        $postfix_string = "";
        $stack = [];
        $this->priorities = $priorities = [
            '+' => 1,
            '-' => 1,
            '*' => 2,
            '/' => 2
        ];
        $this->priorities;
        $items = explode(" ", $infix_string);

        foreach ($items as $cur_item) {

            if (preg_match('/[\dx]/', $cur_item)) {
                // new_item -> string
                $postfix_string .= "{$cur_item} ";
                continue;
            }

            if (empty($stack)) {
                array_push($stack, $cur_item);
                continue;
            }

            //When an operator is read
            //– Pop until the top of the stack has an element of lower
            // precedence
            //– Then push it
            if( $this->opValue($stack[count($stack) - 1]) > $this->opValue($cur_item) ) {
                $postfix_string .= array_pop($stack) . " ";
            }
            // WTF?!?!
            // > passes simple test
            // >= passes complex test
        }

        // Append remaining operators onto string
        $postfix_string = rtrim($postfix_string);
        foreach ($stack as $stack_item_operator) {
            $postfix_string .= " " . $stack_item_operator;
        }

        return $postfix_string;
    }

    public function opValue($operator)
    {
        if (array_key_exists($operator, $this->priorities)){
            return $this->priorities[$operator];
        }
        return 0;
    }

}
