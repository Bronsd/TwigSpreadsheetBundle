<?php

namespace MewesK\TwigExcelBundle\Twig\Node;

use Twig_Compiler;
use Twig_Node;
use Twig_Node_Expression;

/**
 * Class XlsRowNode
 *
 * @package MewesK\TwigExcelBundle\Twig\Node
 */
class XlsRowNode extends Twig_Node
{
    /**
     * @param Twig_Node_Expression $index
     * @param Twig_Node $body
     * @param int $line
     * @param string $tag
     */
    public function __construct(Twig_Node_Expression $index, Twig_Node $body, $line = 0, $tag = 'xlsrow')
    {
        parent::__construct(['index' => $index, 'body' => $body], [], $line, $tag);
    }

    /**
     * @param Twig_Compiler $compiler
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this)
            ->write('$rowIndex = ')
            ->subcompile($this->getNode('index'))
            ->raw(';' . PHP_EOL)
            ->write('$phpExcel->startRow($rowIndex);' . PHP_EOL)
            ->write('unset($rowIndex);' . PHP_EOL)
            ->subcompile($this->getNode('body'))
            ->addDebugInfo($this)
            ->write('$phpExcel->endRow();' . PHP_EOL);
    }
}
