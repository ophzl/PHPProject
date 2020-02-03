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

/* Article/list.html.twig */
class __TwigTemplate_c44d686a089708fe11bee4fcd3db7bfba602885046e4f56f4e50551b205ba0c3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "index.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("index.html.twig", "Article/list.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " Liste des articles - ";
        $this->displayParentBlock("title", $context, $blocks);
    }

    // line 4
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 5
        echo twig_var_dump($this->env, $context, ...[0 => ($context["userConnected"] ?? null)]);
        echo "
    <div class=\"jumbotron\">
        <h1 class=\"display-4\">Liste des articles</h1>
    </div>
    <div class=\"container\">
        <table class=\"table table-striped\">
            <thead>
            <tr>
                <th scope=\"col\">#</th>
                <th scope=\"col\">Titre</th>
                <th scope=\"col\">Auteur</th>
                <th scope=\"col\">Date</th>
                <th scope=\"col\">Actions</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["articleList"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 22
            echo "                <tr>
                    <th scope=\"row\"><a href=\"/Article/Show/";
            // line 23
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 23), "html", null, true);
            echo "\">#";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 23), "html", null, true);
            echo "</a></th>
                    <td>";
            // line 24
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "Titre", [], "any", false, false, false, 24), "html", null, true);
            echo "</td>
                    <td>";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "Auteur", [], "any", false, false, false, 25), "html", null, true);
            echo "</td>
                    <td>";
            // line 26
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "DateAjout", [], "any", false, false, false, 26), "d/m/Y"), "html", null, true);
            echo "</td>
                    <td>
                        <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                            <a class=\"btn btn-success\" href=\"/Article/Show/";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 29), "html", null, true);
            echo "\"><i class=\"far fa-eye\"></i></a>
                            ";
            // line 30
            if (twig_in_filter("admin", twig_get_attribute($this->env, $this->source, ($context["userConnected"] ?? null), "Roles", [], "any", false, false, false, 30))) {
                // line 31
                echo "                                <a class=\"btn btn-warning\" href=\"/Article/Update/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 31), "html", null, true);
                echo "\"><i
                                            class=\"fas fa-edit\"></i></a>
                                <a class=\"btn btn-danger\" href=\"/Article/Delete/";
                // line 33
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 33), "html", null, true);
                echo "\"><i
                                            class=\"far fa-trash-alt\"></i></a>
                            ";
            }
            // line 36
            echo "                        </div>
                        <a class=\"btn btn-secondary\" href=\"/Article/WriteOne/";
            // line 37
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 37), "html", null, true);
            echo "\"><i
                                    class=\"fas fa-file-download\"></i></a>

                    </td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "
            </tbody>
        </table>
    </div>


";
    }

    public function getTemplateName()
    {
        return "Article/list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 43,  126 => 37,  123 => 36,  117 => 33,  111 => 31,  109 => 30,  105 => 29,  99 => 26,  95 => 25,  91 => 24,  85 => 23,  82 => 22,  78 => 21,  59 => 5,  55 => 4,  47 => 2,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"index.html.twig\" %}
{% block title %} Liste des articles - {{ parent() }}{% endblock %}

{% block body %}
{{ dump(userConnected) }}
    <div class=\"jumbotron\">
        <h1 class=\"display-4\">Liste des articles</h1>
    </div>
    <div class=\"container\">
        <table class=\"table table-striped\">
            <thead>
            <tr>
                <th scope=\"col\">#</th>
                <th scope=\"col\">Titre</th>
                <th scope=\"col\">Auteur</th>
                <th scope=\"col\">Date</th>
                <th scope=\"col\">Actions</th>
            </tr>
            </thead>
            <tbody>
            {% for article in articleList %}
                <tr>
                    <th scope=\"row\"><a href=\"/Article/Show/{{ article.id }}\">#{{ article.id }}</a></th>
                    <td>{{ article.Titre }}</td>
                    <td>{{ article.Auteur }}</td>
                    <td>{{ article.DateAjout | date(\"d/m/Y\") }}</td>
                    <td>
                        <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                            <a class=\"btn btn-success\" href=\"/Article/Show/{{ article.id }}\"><i class=\"far fa-eye\"></i></a>
                            {% if \"admin\" in userConnected.Roles %}
                                <a class=\"btn btn-warning\" href=\"/Article/Update/{{ article.id }}\"><i
                                            class=\"fas fa-edit\"></i></a>
                                <a class=\"btn btn-danger\" href=\"/Article/Delete/{{ article.id }}\"><i
                                            class=\"far fa-trash-alt\"></i></a>
                            {% endif %}
                        </div>
                        <a class=\"btn btn-secondary\" href=\"/Article/WriteOne/{{ article.id }}\"><i
                                    class=\"fas fa-file-download\"></i></a>

                    </td>
                </tr>
            {% endfor %}

            </tbody>
        </table>
    </div>


{% endblock %}", "Article/list.html.twig", "C:\\Users\\tetra\\Documents\\DEV\\PHP\\projetCESI\\templates\\Article\\list.html.twig");
    }
}
