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
     * @param $operator
     * @return int
     * @author Erik Aybar
     */
    public function opValue($operator)
    {
        if (array_key_exists($operator, $this->priorities)){
            return $this->priorities[$operator];
        }
        return 0;
    }

}
