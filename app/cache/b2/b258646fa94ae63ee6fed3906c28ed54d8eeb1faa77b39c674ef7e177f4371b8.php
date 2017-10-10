<?php

/* layout.html */
class __TwigTemplate_01d016be016c1cabfb64f445bd8750fccd8b77ec3b2576115e87aada9e2ad03d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    ";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 8
        echo "</head>
<body>
<div id=\"content\">";
        // line 10
        $this->displayBlock('content', $context, $blocks);
        echo "</div>
<div id=\"footer\">
    ";
        // line 12
        $this->displayBlock('footer', $context, $blocks);
        // line 15
        echo "</div>
</body>
</html>";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        // line 5
        echo "    <link rel=\"stylesheet\" href=\"style.css\" />
    <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    ";
    }

    public function block_title($context, array $blocks = array())
    {
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
    }

    // line 12
    public function block_footer($context, array $blocks = array())
    {
        // line 13
        echo "
    ";
    }

    public function getTemplateName()
    {
        return "layout.html";
    }

    public function getDebugInfo()
    {
        return array (  71 => 13,  68 => 12,  63 => 10,  53 => 6,  50 => 5,  47 => 4,  41 => 15,  39 => 12,  34 => 10,  30 => 8,  28 => 4,  23 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout.html", "C:\\Bitnami\\wampstack-7.0.23-0\\apache2\\htdocs\\wms_users_2017\\app\\views\\layout.html");
    }
}
