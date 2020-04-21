<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* pages\en\404.html.twig */
class __TwigTemplate_9b432090b244afaba6664e06dbc6040912f1f4d7199f1952d02a0ffaffbcbfa4 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "pages/en/base/with-header-and-footer.master.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("pages/en/base/with-header-and-footer.master.html.twig", "pages\\en\\404.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Not Found";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <article class=\"alert alert-warning\">
        <h1>";
        // line 7
        echo twig_escape_filter($this->env, (((isset($context["title"]) || array_key_exists("title", $context))) ? (_twig_default_filter(($context["title"] ?? null), "404")) : ("404")), "html", null, true);
        echo "</h1>
        <h2>";
        // line 8
        echo twig_escape_filter($this->env, (((isset($context["message"]) || array_key_exists("message", $context))) ? (_twig_default_filter(($context["message"] ?? null), "Not found")) : ("Not found")), "html", null, true);
        echo "</h2>
        <h3>";
        // line 9
        echo twig_escape_filter($this->env, (((isset($context["details"]) || array_key_exists("details", $context))) ? (_twig_default_filter(($context["details"] ?? null), "The server cannot find the requested resource.")) : ("The server cannot find the requested resource.")), "html", null, true);
        echo "</h3>
    </article>
";
    }

    public function getTemplateName()
    {
        return "pages\\en\\404.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 9,  65 => 8,  61 => 7,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'pages/en/base/with-header-and-footer.master.html.twig' %}

{% block title %}Not Found{% endblock %}

{% block content %}
    <article class=\"alert alert-warning\">
        <h1>{{ title   | default(\"404\") }}</h1>
        <h2>{{ message | default(\"Not found\") }}</h2>
        <h3>{{ details | default(\"The server cannot find the requested resource.\") }}</h3>
    </article>
{% endblock %}
", "pages\\en\\404.html.twig", "V:\\Github\\orzford\\limoncello\\components\\App\\resources\\views\\pages\\en\\404.html.twig");
    }
}
