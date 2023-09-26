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

/* invoices/index.twig */
class __TwigTemplate_169e680eca504e65a3655657ceaa7b7a extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<style>
    table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
    }

    table tr th, table tr td {
        border: 1px #eee solid;
        padding: 5px;
    }
</style>
<table>
    <thead>
        <tr>
            <th>Invoice Number</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Due Date</th>
        </tr>
    </thead>
    <tbody>
        ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoices"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
            // line 24
            echo "            <tr>
                <td>";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["invoice"], "invoiceNumber", [], "any", false, false, false, 25), "html", null, true);
            echo "</td>
                <td>";
            // line 26
            echo twig_escape_filter($this->env, $this->extensions['Twig\Extra\Intl\IntlExtension']->formatCurrency(twig_get_attribute($this->env, $this->source, $context["invoice"], "amount", [], "any", false, false, false, 26), "USD"), "html", null, true);
            echo "</td>
                <td>";
            // line 27
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 27), "html", null, true);
            echo "</td>
                <td>
                    ";
            // line 29
            ((twig_test_empty(twig_get_attribute($this->env, $this->source, $context["invoice"], "dueDate", [], "any", false, false, false, 29))) ? (print ("N/A")) : (print (twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["invoice"], "dueDate", [], "any", false, false, false, 29), "m/d/Y"), "html", null, true))));
            echo "
                </td>
            </tr>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 33
            echo "            <tr><td colspan=\"4\">No Invoices Found</td></tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "    </tbody>
</table>";
    }

    public function getTemplateName()
    {
        return "invoices/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 35,  91 => 33,  82 => 29,  77 => 27,  73 => 26,  69 => 25,  66 => 24,  61 => 23,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "invoices/index.twig", "/var/www/Views/invoices/index.twig");
    }
}
