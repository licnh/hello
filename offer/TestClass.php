<?php

class ListNode {
    /**
     * @var mixed
     */
    public $val;

    /**
     * @var ListNode
     */
    public $next = NULL;

    public function __construct($x) {
        $this->val = $x;
    }
}

class TreeNode {
    /**
     * @var mixed
     */
    public $val;

    /**
     * @var TreeNode
     */
    public $left = NULL;

    /**
     * @var TreeNode
     */
    public $right = NULL;

    public function __construct($val) {
        $this->val = $val;
    }
}