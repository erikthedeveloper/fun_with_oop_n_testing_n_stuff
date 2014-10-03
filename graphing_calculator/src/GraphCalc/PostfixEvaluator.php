<?php

namespace GraphCalc;

class PostfixEvaluator
{

    /**
     * operand
     *  push to stack
     *
     * operator
     *  pop 2 elements
     *      First pop -> right. Second pop -> left
     *  perform operation
     *  push the result
     */
    public function evaluate($postfix_string)
    {
        $stack = [];
        $items = explode(" ", $postfix_string);

        foreach ($items as $cur_item) {
            if (preg_match('/[\dx]/', $cur_item)) {
                array_push($stack, $cur_item);
                continue;
            }

            $el_right = array_pop($stack);
            $el_left  = array_pop($stack);
            $evaluated = $this->operateOnItems($cur_item, $el_left, $el_right);
            array_push($stack, $evaluated);
        }

        $value = array_pop($stack);
        return $value;
    }

    private function operateOnItems($cur_item, $el_left, $el_right)
    {
        switch ($cur_item):
            case '+':
                $value = $el_left + $el_right;
                break;
            case '-':
                $value = $el_left - $el_right;
                break;
            case '/':
                $value = $el_left / $el_right;
                break;
            case '*':
                $value = $el_left * $el_right;
                break;
        endswitch;

        return $value;
    }
}
