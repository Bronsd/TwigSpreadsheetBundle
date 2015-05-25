<?php

namespace MewesK\TwigExcelBundle\Twig;

use MewesK\TwigExcelBundle\Twig\NodeVisitor\SyntaxCheckNodeVisitor;
use MewesK\TwigExcelBundle\Twig\TokenParser\XlsCellTokenParser;
use MewesK\TwigExcelBundle\Twig\TokenParser\XlsCenterTokenParser;
use MewesK\TwigExcelBundle\Twig\TokenParser\XlsDocumentTokenParser;
use MewesK\TwigExcelBundle\Twig\TokenParser\XlsDrawingTokenParser;
use MewesK\TwigExcelBundle\Twig\TokenParser\XlsFooterTokenParser;
use MewesK\TwigExcelBundle\Twig\TokenParser\XlsHeaderTokenParser;
use MewesK\TwigExcelBundle\Twig\TokenParser\XlsLeftTokenParser;
use MewesK\TwigExcelBundle\Twig\TokenParser\XlsRightTokenParser;
use MewesK\TwigExcelBundle\Twig\TokenParser\XlsRowTokenParser;
use MewesK\TwigExcelBundle\Twig\TokenParser\XlsSheetTokenParser;
use Twig_Error_Runtime;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class TwigExcelExtension
 *
 * @package MewesK\TwigExcelBundle\Twig
 */
class TwigExcelExtension extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [new Twig_SimpleFunction('xlsmergestyles', [$this, 'mergeStyles'])];
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return [new XlsCellTokenParser(),
            new XlsDocumentTokenParser(),
            new XlsDrawingTokenParser(),
            new XlsFooterTokenParser(),
            new XlsHeaderTokenParser(),
            new XlsLeftTokenParser(),
            new XlsCenterTokenParser(),
            new XlsRightTokenParser(),
            new XlsRowTokenParser(),
            new XlsSheetTokenParser()];
    }

    /**
     * {@inheritdoc}
     */
    public function getNodeVisitors()
    {
        return [new SyntaxCheckNodeVisitor()];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'excel_extension';
    }

    /**
     * @param array $style1
     * @param array $style2
     *
     * @return array
     * @throws Twig_Error_Runtime
     */
    public function mergeStyles(array $style1, array $style2)
    {
        if (!is_array($style1) || !is_array($style2)) {
            throw new Twig_Error_Runtime('The xlsmergestyles function only works with arrays.');
        }

        return array_merge_recursive($style1, $style2);
    }
} 
