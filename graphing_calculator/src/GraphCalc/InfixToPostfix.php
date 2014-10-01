<?php

namespace GraphCalc;

class InfixToPostfix
{

    /**
     * @var array
     */
    protected $operators = [
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

        foreach ($items as $item) {

            if ((int) $item || $item == 'x') {
                $postfix_string .= $item . " ";
            } else {
                if (count($stack) ==  0) {
                    $stack[] = $item;
                } else {
                    if ($this->operators[$stack[0]] <= $this->operators[$item]){
                        if ($item == $stack[0]) {
                            continue;
                        } else {
                            $postfix_string .= array_shift($stack) . " ";
                        }
                    }
                    $stack[] = $item;
                }
            }
        }

        $postfix_string = rtrim($postfix_string);

        foreach ($stack as $stack_item) {
            $postfix_string .= " " . $stack_item;
        }

        // "x 2 9 +"
        return $postfix_string;
    }
}
