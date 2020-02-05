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
    <link rel=\"stylesheet\" href=\"./css/projet.css\">
    ";
        // line 12
        $this->displayBlock('css', $context, $blocks);
        // line 13
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
            <li class=\"nav-item dropdown\">
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
                   data-toggle=\"dropdown\"
                   aria-haspopup=\"true\" aria-expanded=\"false\">
                    Articles
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                    <a class=\"dropdown-item\" href=\"/Article/ListAll\">Liste des articles</a>
                    ";
        // line 38
        if (((twig_in_filter("redacteur", twig_get_attribute($this->env, $this->source, ($context["userConnected"] ?? null), "Role", [], "any", false, false, false, 38)) && (isset($context["userConnected"]) || array_key_exists("userConnected", $context))) && 0 !== twig_compare(($context["userConnected"] ?? null), null))) {
            // line 39
            echo "                        <a class=\"dropdown-item\" href=\"/Article/Add\">Ajout d'un article</a>
                    ";
        }
        // line 41
        echo "
                </div>
            </li>



            ";
        // line 47
        if (twig_in_filter("admin", twig_get_attribute($this->env, $this->source, ($context["userConnected"] ?? null), "Role", [], "any", false, false, false, 47))) {
            // line 48
            echo "                <li class=\"nav-item dropdown\">
                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
                       data-toggle=\"dropdown\"
                       aria-haspopup=\"true\" aria-expanded=\"false\">
                        Panneau d'administration
                    </a>
                    <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                        <h6 class=\"dropdown-header\">Membres</h6>
                        <a class=\"dropdown-item\" href=\"/Admin/ListUser\">Gestion des membres</a>
                        <div class=\"dropdown-divider\"></div>
                        <h6 class=\"dropdown-header\">Articles</h6>
                        <a class=\"dropdown-item\" href=\"/Article/Add\">Ajout d'un article</a>
                        <a class=\"dropdown-item\" href=\"/Admin/ListArticlesWaiting/\">Approuver un article</a>
                        <div class=\"dropdown-divider\"></div>
                        <h6 class=\"dropdown-header\">Catégories</h6>
                        <a class=\"dropdown-item\" href=\"/Category/ListAll\">Gestion des catégories</a>
                        <a class=\"dropdown-item\" href=\"/Category/Add\">Ajouter une catégorie</a>
                        <div class=\"dropdown-divider\"></div>
                        <h6 class=\"dropdown-header\">Préférences</h6>
                        <a class=\"dropdown-item\" href=\"/Admin/ChangeTheme\">Gestion du thème</a>

                    </div>
                </li>
            ";
        }
        // line 72
        echo "
            <li class=\"nav-item dropdown\">
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\"
                   aria-haspopup=\"true\" aria-expanded=\"false\">
                    Compte
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                    ";
        // line 79
        if (((isset($context["userConnected"]) || array_key_exists("userConnected", $context)) && 0 !== twig_compare(($context["userConnected"] ?? null), null))) {
            // line 80
            echo "                        <h6 class=\"dropdown-header\">Bonjour ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["userConnected"] ?? null), "Name", [], "any", false, false, false, 80), "html", null, true);
            echo "</h6>

                        <a class=\"dropdown-item\" href=\"/Profile\">Mon profil</a>
                        <div class=\"dropdown-divider\"></div>
                        <h6 class=\"dropdown-header\">Préférences</h6>
                        <a class=\"dropdown-item\" href=\"/Contact\" class=\"nav-link\">Contactez-nous</a>
                        <a class=\"dropdown-item\" href=\"/Logout\">Se déconnecter</a>

                    ";
        } else {
            // line 89
            echo "                        <a class=\"dropdown-item\" href=\"/Login\">Se connecter</a>
                        <a class=\"dropdown-item\" href=\"/Register\">S'inscrire</a>
                    ";
        }
        // line 92
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
        // line 106
        $this->displayBlock('body', $context, $blocks);
        // line 107
        echo "

<script src=\"https://code.jquery.com/jquery-3.4.0.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"></script>
<script src=\"https://code.jquery.com/ui/1.12.1/jquery-ui.js\"></script>
<script src=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js\"></script>
";
        // line 115
        $this->displayBlock('javascript', $context, $blocks);
        // line 116
        echo "</body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Projet PHP";
    }

    // line 12
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 106
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 115
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
        return array (  212 => 115,  206 => 106,  200 => 12,  193 => 5,  187 => 116,  185 => 115,  175 => 107,  173 => 106,  157 => 92,  152 => 89,  139 => 80,  137 => 79,  128 => 72,  102 => 48,  100 => 47,  92 => 41,  88 => 39,  86 => 38,  59 => 13,  57 => 12,  47 => 5,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <title>{% block title %}Projet PHP{% endblock %}</title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\">
    <link rel=\"stylesheet\"
          href=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/pepper-grinder/jquery-ui.css\">
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.8.1/css/all.css\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css\">
    <link rel=\"stylesheet\" href=\"./css/projet.css\">
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
            <li class=\"nav-item dropdown\">
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
                   data-toggle=\"dropdown\"
                   aria-haspopup=\"true\" aria-expanded=\"false\">
                    Articles
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                    <a class=\"dropdown-item\" href=\"/Article/ListAll\">Liste des articles</a>
                    {% if \"redacteur\" in userConnected.Role and userConnected is defined and userConnected != null %}
                        <a class=\"dropdown-item\" href=\"/Article/Add\">Ajout d'un article</a>
                    {% endif %}

                </div>
            </li>



            {% if \"admin\" in userConnected.Role %}
                <li class=\"nav-item dropdown\">
                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\"
                       data-toggle=\"dropdown\"
                       aria-haspopup=\"true\" aria-expanded=\"false\">
                        Panneau d'administration
                    </a>
                    <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                        <h6 class=\"dropdown-header\">Membres</h6>
                        <a class=\"dropdown-item\" href=\"/Admin/ListUser\">Gestion des membres</a>
                        <div class=\"dropdown-divider\"></div>
                        <h6 class=\"dropdown-header\">Articles</h6>
                        <a class=\"dropdown-item\" href=\"/Article/Add\">Ajout d'un article</a>
                        <a class=\"dropdown-item\" href=\"/Admin/ListArticlesWaiting/\">Approuver un article</a>
                        <div class=\"dropdown-divider\"></div>
                        <h6 class=\"dropdown-header\">Catégories</h6>
                        <a class=\"dropdown-item\" href=\"/Category/ListAll\">Gestion des catégories</a>
                        <a class=\"dropdown-item\" href=\"/Category/Add\">Ajouter une catégorie</a>
                        <div class=\"dropdown-divider\"></div>
                        <h6 class=\"dropdown-header\">Préférences</h6>
                        <a class=\"dropdown-item\" href=\"/Admin/ChangeTheme\">Gestion du thème</a>

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

                        <a class=\"dropdown-item\" href=\"/Profile\">Mon profil</a>
                        <div class=\"dropdown-divider\"></div>
                        <h6 class=\"dropdown-header\">Préférences</h6>
                        <a class=\"dropdown-item\" href=\"/Contact\" class=\"nav-link\">Contactez-nous</a>
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
