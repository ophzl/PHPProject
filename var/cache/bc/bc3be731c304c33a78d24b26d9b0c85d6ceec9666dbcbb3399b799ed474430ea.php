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

/* index.html.twig */
class __TwigTemplate_3cdfc1a19307d1ac08547958dcbd18b32c2bc42d1d9e60324f7f338a763488f3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'css' => [$this, 'block_css'],
            'body' => [$this, 'block_body'],
            'javascript' => [$this, 'block_javascript'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\">
    <link rel=\"stylesheet\"
          href=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/pepper-grinder/jquery-ui.css\">
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.8.1/css/all.css\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css\">
    ";
        // line 11
        $this->displayBlock('css', $context, $blocks);
        // line 12
        echo "
<body>

<nav class=\"navbar sticky-top nav-pills navbar-expand-lg navbar-light bg-light\">

    <a class=\"navbar-brand\" href=\"/Article/ListAll\">
        <img src=\"/doc/cesi.svg\" height=\"30\" class=\"d-inline-block align-top mr-2\" alt=\"\">
        Projet PHP
    </a>
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo02\"
            aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
        <!--<div class=\"row\">-->

        <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/Article/ListAll\">Liste des articles</a>
            </li>
            ";
        // line 32
        if (((twig_in_filter("redacteur", twig_get_attribute($this->env, $this->source, ($context["userConnected"] ?? null), "Role", [], "any", false, false, false, 32)) && (isset($context["userConnected"]) || array_key_exists("userConnected", $context))) && 0 !== twig_compare(($context["userConnected"] ?? null), null))) {
            // line 33
            echo "                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"/Article/Add\">Ajout d'un article</a>
                </li>
            ";
        }
        // line 37
        echo "            <li class=\"nav-item\">
                <a href=\"/Contact\" class=\"nav-link\">Contactez-nous</a>
            </li>


            ";
        // line 42
        if (twig_in_filter("admin", twig_get_attribute($this->env, $this->source, ($context["userConnected"] ?? null), "Role", [], "any", false, false, false, 42))) {
            // line 43
            echo "                <li class=\"nav-item dropdown\">
                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
                       data-toggle=\"dropdown\"
                       aria-haspopup=\"true\" aria-expanded=\"false\">
                        Panneau d'administration
                    </a>
                    <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                        <a class=\"dropdown-item\" href=\"#\">Approuver un article</a>
                        <a class=\"dropdown-item\" href=\"/Admin/ListUser\">Gestion des membres</a>

                    </div>
                </li>
            ";
        }
        // line 56
        echo "
            <li class=\"nav-item dropdown\">
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\"
                   aria-haspopup=\"true\" aria-expanded=\"false\">
                    Compte
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                    ";
        // line 63
        if (((isset($context["userConnected"]) || array_key_exists("userConnected", $context)) && 0 !== twig_compare(($context["userConnected"] ?? null), null))) {
            // line 64
            echo "                        <h6 class=\"dropdown-header\">Bonjour ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["userConnected"] ?? null), "Name", [], "any", false, false, false, 64), "html", null, true);
            echo "</h6>

                        <a class=\"dropdown-item\" href=\"/Logout\">Se déconnecter</a>

                    ";
        } else {
            // line 69
            echo "                        <a class=\"dropdown-item\" href=\"/Login\">Se connecter</a>
                        <a class=\"dropdown-item\" href=\"/Register\">S'inscrire</a>
                    ";
        }
        // line 72
        echo "                </div>
            </li>

        </ul>


        <form class=\"form-inline\" method=\"post\" action=\"/Article/Search/\">
            <input class=\"form-control mr-sm-2\" type=\"search\" placeholder=\"Rechercher un article\" name=\"search\">
            <input type=\"submit\" class=\"btn btn-success my-2 my-sm-0\" value=\"Rechercher\">
        </form>
    </div>

</nav>

";
        // line 86
        $this->displayBlock('body', $context, $blocks);
        // line 87
        echo "

<script src=\"https://code.jquery.com/jquery-3.4.0.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"></script>
<script src=\"https://code.jquery.com/ui/1.12.1/jquery-ui.js\"></script>
<script src=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js\"></script>
";
        // line 95
        $this->displayBlock('javascript', $context, $blocks);
        // line 96
        echo "</body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "CESI BLOG";
    }

    // line 11
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 86
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 95
    public function block_javascript($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  192 => 95,  186 => 86,  180 => 11,  173 => 5,  167 => 96,  165 => 95,  155 => 87,  153 => 86,  137 => 72,  132 => 69,  123 => 64,  121 => 63,  112 => 56,  97 => 43,  95 => 42,  88 => 37,  82 => 33,  80 => 32,  58 => 12,  56 => 11,  47 => 5,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <title>{% block title %}CESI BLOG{% endblock %}</title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\">
    <link rel=\"stylesheet\"
          href=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/pepper-grinder/jquery-ui.css\">
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.8.1/css/all.css\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css\">
    {% block css %}{% endblock %}

<body>

<nav class=\"navbar sticky-top nav-pills navbar-expand-lg navbar-light bg-light\">

    <a class=\"navbar-brand\" href=\"/Article/ListAll\">
        <img src=\"/doc/cesi.svg\" height=\"30\" class=\"d-inline-block align-top mr-2\" alt=\"\">
        Projet PHP
    </a>
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo02\"
            aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
        <!--<div class=\"row\">-->

        <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/Article/ListAll\">Liste des articles</a>
            </li>
            {% if \"redacteur\" in userConnected.Role and userConnected is defined and userConnected != null %}
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"/Article/Add\">Ajout d'un article</a>
                </li>
            {% endif %}
            <li class=\"nav-item\">
                <a href=\"/Contact\" class=\"nav-link\">Contactez-nous</a>
            </li>


            {% if \"admin\" in userConnected.Role %}
                <li class=\"nav-item dropdown\">
                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
                       data-toggle=\"dropdown\"
                       aria-haspopup=\"true\" aria-expanded=\"false\">
                        Panneau d'administration
                    </a>
                    <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                        <a class=\"dropdown-item\" href=\"#\">Approuver un article</a>
                        <a class=\"dropdown-item\" href=\"/Admin/ListUser\">Gestion des membres</a>

                    </div>
                </li>
            {% endif %}

            <li class=\"nav-item dropdown\">
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\"
                   aria-haspopup=\"true\" aria-expanded=\"false\">
                    Compte
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                    {% if userConnected is defined and userConnected != null %}
                        <h6 class=\"dropdown-header\">Bonjour {{ userConnected.Name }}</h6>

                        <a class=\"dropdown-item\" href=\"/Logout\">Se déconnecter</a>

                    {% else %}
                        <a class=\"dropdown-item\" href=\"/Login\">Se connecter</a>
                        <a class=\"dropdown-item\" href=\"/Register\">S'inscrire</a>
                    {% endif %}
                </div>
            </li>

        </ul>


        <form class=\"form-inline\" method=\"post\" action=\"/Article/Search/\">
            <input class=\"form-control mr-sm-2\" type=\"search\" placeholder=\"Rechercher un article\" name=\"search\">
            <input type=\"submit\" class=\"btn btn-success my-2 my-sm-0\" value=\"Rechercher\">
        </form>
    </div>

</nav>

{% block body %}{% endblock %}


<script src=\"https://code.jquery.com/jquery-3.4.0.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"></script>
<script src=\"https://code.jquery.com/ui/1.12.1/jquery-ui.js\"></script>
<script src=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js\"></script>
{% block javascript %}{% endblock %}
</body>
</html>
", "index.html.twig", "C:\\Users\\tetra\\Documents\\DEV\\PHP\\projetCESI\\templates\\index.html.twig");
    }
}
