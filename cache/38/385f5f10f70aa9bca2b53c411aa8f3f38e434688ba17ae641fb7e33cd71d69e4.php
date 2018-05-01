<?php

/* <template data-tab="editor">
    <div>
        <h2>{{'theme' | t}}</h2>
        <select id="fc-theme">
            {% for theme in themes%}
                <option value="{{theme.name}}">{{theme.options.label}}</option>
            {% endfor %}
        </select>
        <h2>{{'classes' | t}}</h2>
        <input type="text" id="fc-classes">
        <h2>{{'content' | t}}</h2>
        <iframe id="fc-preview" srcdoc="" src="http://wp-playground.localhost" frameborder="0"></iframe>
        <div id="fc-field-properties"></div>
    </div>
</template>

<script data-tab="editor">formacopoeia.components.editor = 
{
    themeSelector: null,
    classesInput: null,
    getFieldById: function(id) {
        for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
            if (id === formacopoeia.currentForm[i].id) {
                return formacopoeia.currentForm[i];
            }
        }
    },
    resolvePropTypes: function(prop, type, value) {
        if (!value) {
            value = '';
        }
        var types = {
            checkbox: 'input type="checkbox" data-prop="' + prop + '" checked="' + (value ? 'checked' : '') + '">',
            text: '<input type="text" data-prop="' + prop + '" value="' + value + '">',
            textarea: '<textarea data-prop="' + prop + '">' + value + '</textarea>'
        };
        return prop + ': ' + types[type];
    },
    onInit: function() {
        
    },
    onActive: function() {
        var self = this;
        var srcdoc = '<form id="fc-form"></form><link id="fc-style" rel="stylesheet" href=""><button id="fc-add">+</button>';
        srcdoc += '<div id="choices" style="display: none">';
        for (var i = 0; i < formacopoeia.fields.length; ++i) {
            srcdoc += '<button class="new-field" data-field="' + formacopoeia.fields[i].name + '">' + formacopoeia.fields[i].options.label + '</button>';
        }
        srcdoc += '</div>';

        var iframe = select('#fc-preview');
        var fieldPropertiesBlock = select('#fc-field-properties');
        iframe.srcdoc = srcdoc;
        this.themeSelector = select('#fc-theme');
        this.classesInput = select('#fc-classes');
        domReady(function() {
            var iframeDoc = iframe.contentDocument;
            var form = select('#fc-form', iframeDoc);
            var style = select('#fc-style', iframeDoc);
            var choices = select('div#choices', iframeDoc);

            style.href = getThemeByName(self.themeSelector.value).options.path;

            self.themeSelector.on('change', function() {
                style.href = getThemeByName(this.value).options.path;
            });

            select('button', iframeDoc).addEventListener('click', function() {
                choices.style.display = 'block';
            });

            var togglePropertiesBlock = function(id) {
                var propertiesString = '<div><span id="fc-move-up">↑</span><span id="fc-move-down">↓</span><span id="fc-remove">×</span>';
                var field = getFieldByType(self.getFieldById(id).type);
                console.log(field)
                for (var prop in field.options.props) {
                    propertiesString += self.resolvePropTypes(prop, field.options.props[prop].type, self.getFieldById(id).props[prop]) + '<br>';
                }
                propertiesString += '</div>';
                fieldPropertiesBlock.innerHTML = propertiesString;
                /* PLAN A DRAG AND DROP INSTEAD OF ARROWS * /
                select('#fc-remove', fieldPropertiesBlock).on('click', (function(id) {
                    return function() {
                        for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
                            if (id === formacopoeia.currentForm[i].id) {
                                formacopoeia.currentForm.splice(i, 1);
                                var tmp = select('field-wrapper[data-id="' + id + '"]', iframeDoc);
                                tmp.parentNode.removeChild(tmp);
                                fieldPropertiesBlock.removeChild(fieldPropertiesBlock.firstChild);
                                return;
                            }
                        }
                    }
                })(id));
                selectAll('input', fieldPropertiesBlock).on('input', (function(id) {
                    return function() {
                        self.getFieldById(id).props[this.dataset.prop] = this.value;
                        var formField = self.getFieldById(id);
                        var field = getFieldByType(formField.type);                        
                        select('field-wrapper[data-id="' + id + '"]', iframeDoc).innerHTML = formacopoeiaRenderer(field.options.template, formField.props);
                    }
                })(id));
            };

            // INIT FROM EXISTING VALUES (TO MOVE & REFACTOR)
            for (var index in formacopoeia.currentForm) {
                var field = getFieldByType(formacopoeia.currentForm[index].type);
                form.innerHTML += '<field-wrapper data-id="' + formacopoeia.currentForm[index].id + '">' + formacopoeiaRenderer(field.options.template, formacopoeia.currentForm[index].props) + '</field-wrapper>';
            }

            iframe.contentWindow.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var fieldWrapper = e.target.closest('field-wrapper');
                if (!fieldWrapper) {
                    return;
                }
                togglePropertiesBlock(fieldWrapper.dataset.id);
            });

            var buttonsNewField = selectAll('button.new-field', iframeDoc);
            toArray(buttonsNewField).forEach(function(item) {
                item.addEventListener('click', function() {
                    var id = Math.random().toString(36).substr(2, 8);
                    var field = getFieldByType(this.dataset.field);
                    form.innerHTML += '<field-wrapper data-id="' + id + '">' + field.options.template + '</<field-wrapper>';
                    choices.style.display = 'none';
                    formacopoeia.currentForm.push({
                        id: id,
                        type: this.dataset.field,
                        props: {},
                    });
                    togglePropertiesBlock(id);
                });
            });
        }, iframe.contentWindow);
    },
    onRemoveActive: function() {
        
    },
    onSave: function() {
        var iframe = select('#fc-preview');
        var iframeDoc = iframe.contentDocument;
        var form = select('#fc-form', iframeDoc);
        // REMOVE field-wrapper... or do not save the content
        return {
            classes: this.classesInput.value,
            theme: this.themeSelector.value,
            // content: form.parentNode.innerHTML
        };
    }
}
</script> */
class __TwigTemplate_e5e62142b46a046bbca57c3e7bfd28eb633240af4b82ad27d594821220685fc2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<template data-tab=\"editor\">
    <div>
        <h2>";
        // line 3
        echo twig_escape_filter($this->env, \Formacopoeia\All\Translate_Controller::_t("theme"), "html", null, true);
        echo "</h2>
        <select id=\"fc-theme\">
            ";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["themes"]) ? $context["themes"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
            // line 6
            echo "                <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["theme"], "name", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["theme"], "options", array()), "label", array()), "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "        </select>
        <h2>";
        // line 9
        echo twig_escape_filter($this->env, \Formacopoeia\All\Translate_Controller::_t("classes"), "html", null, true);
        echo "</h2>
        <input type=\"text\" id=\"fc-classes\">
        <h2>";
        // line 11
        echo twig_escape_filter($this->env, \Formacopoeia\All\Translate_Controller::_t("content"), "html", null, true);
        echo "</h2>
        <iframe id=\"fc-preview\" srcdoc=\"\" src=\"http://wp-playground.localhost\" frameborder=\"0\"></iframe>
        <div id=\"fc-field-properties\"></div>
    </div>
</template>

<script data-tab=\"editor\">formacopoeia.components.editor = 
{
    themeSelector: null,
    classesInput: null,
    getFieldById: function(id) {
        for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
            if (id === formacopoeia.currentForm[i].id) {
                return formacopoeia.currentForm[i];
            }
        }
    },
    resolvePropTypes: function(prop, type, value) {
        if (!value) {
            value = '';
        }
        var types = {
            checkbox: 'input type=\"checkbox\" data-prop=\"' + prop + '\" checked=\"' + (value ? 'checked' : '') + '\">',
            text: '<input type=\"text\" data-prop=\"' + prop + '\" value=\"' + value + '\">',
            textarea: '<textarea data-prop=\"' + prop + '\">' + value + '</textarea>'
        };
        return prop + ': ' + types[type];
    },
    onInit: function() {
        
    },
    onActive: function() {
        var self = this;
        var srcdoc = '<form id=\"fc-form\"></form><link id=\"fc-style\" rel=\"stylesheet\" href=\"\"><button id=\"fc-add\">+</button>';
        srcdoc += '<div id=\"choices\" style=\"display: none\">';
        for (var i = 0; i < formacopoeia.fields.length; ++i) {
            srcdoc += '<button class=\"new-field\" data-field=\"' + formacopoeia.fields[i].name + '\">' + formacopoeia.fields[i].options.label + '</button>';
        }
        srcdoc += '</div>';

        var iframe = select('#fc-preview');
        var fieldPropertiesBlock = select('#fc-field-properties');
        iframe.srcdoc = srcdoc;
        this.themeSelector = select('#fc-theme');
        this.classesInput = select('#fc-classes');
        domReady(function() {
            var iframeDoc = iframe.contentDocument;
            var form = select('#fc-form', iframeDoc);
            var style = select('#fc-style', iframeDoc);
            var choices = select('div#choices', iframeDoc);

            style.href = getThemeByName(self.themeSelector.value).options.path;

            self.themeSelector.on('change', function() {
                style.href = getThemeByName(this.value).options.path;
            });

            select('button', iframeDoc).addEventListener('click', function() {
                choices.style.display = 'block';
            });

            var togglePropertiesBlock = function(id) {
                var propertiesString = '<div><span id=\"fc-move-up\">↑</span><span id=\"fc-move-down\">↓</span><span id=\"fc-remove\">×</span>';
                var field = getFieldByType(self.getFieldById(id).type);
                console.log(field)
                for (var prop in field.options.props) {
                    propertiesString += self.resolvePropTypes(prop, field.options.props[prop].type, self.getFieldById(id).props[prop]) + '<br>';
                }
                propertiesString += '</div>';
                fieldPropertiesBlock.innerHTML = propertiesString;
                /* PLAN A DRAG AND DROP INSTEAD OF ARROWS */
                select('#fc-remove', fieldPropertiesBlock).on('click', (function(id) {
                    return function() {
                        for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
                            if (id === formacopoeia.currentForm[i].id) {
                                formacopoeia.currentForm.splice(i, 1);
                                var tmp = select('field-wrapper[data-id=\"' + id + '\"]', iframeDoc);
                                tmp.parentNode.removeChild(tmp);
                                fieldPropertiesBlock.removeChild(fieldPropertiesBlock.firstChild);
                                return;
                            }
                        }
                    }
                })(id));
                selectAll('input', fieldPropertiesBlock).on('input', (function(id) {
                    return function() {
                        self.getFieldById(id).props[this.dataset.prop] = this.value;
                        var formField = self.getFieldById(id);
                        var field = getFieldByType(formField.type);                        
                        select('field-wrapper[data-id=\"' + id + '\"]', iframeDoc).innerHTML = formacopoeiaRenderer(field.options.template, formField.props);
                    }
                })(id));
            };

            // INIT FROM EXISTING VALUES (TO MOVE & REFACTOR)
            for (var index in formacopoeia.currentForm) {
                var field = getFieldByType(formacopoeia.currentForm[index].type);
                form.innerHTML += '<field-wrapper data-id=\"' + formacopoeia.currentForm[index].id + '\">' + formacopoeiaRenderer(field.options.template, formacopoeia.currentForm[index].props) + '</field-wrapper>';
            }

            iframe.contentWindow.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var fieldWrapper = e.target.closest('field-wrapper');
                if (!fieldWrapper) {
                    return;
                }
                togglePropertiesBlock(fieldWrapper.dataset.id);
            });

            var buttonsNewField = selectAll('button.new-field', iframeDoc);
            toArray(buttonsNewField).forEach(function(item) {
                item.addEventListener('click', function() {
                    var id = Math.random().toString(36).substr(2, 8);
                    var field = getFieldByType(this.dataset.field);
                    form.innerHTML += '<field-wrapper data-id=\"' + id + '\">' + field.options.template + '</<field-wrapper>';
                    choices.style.display = 'none';
                    formacopoeia.currentForm.push({
                        id: id,
                        type: this.dataset.field,
                        props: {},
                    });
                    togglePropertiesBlock(id);
                });
            });
        }, iframe.contentWindow);
    },
    onRemoveActive: function() {
        
    },
    onSave: function() {
        var iframe = select('#fc-preview');
        var iframeDoc = iframe.contentDocument;
        var form = select('#fc-form', iframeDoc);
        // REMOVE field-wrapper... or do not save the content
        return {
            classes: this.classesInput.value,
            theme: this.themeSelector.value,
            // content: form.parentNode.innerHTML
        };
    }
}
</script>";
    }

    public function getTemplateName()
    {
        return "<template data-tab=\"editor\">
    <div>
        <h2>{{'theme' | t}}</h2>
        <select id=\"fc-theme\">
            {% for theme in themes%}
                <option value=\"{{theme.name}}\">{{theme.options.label}}</option>
            {% endfor %}
        </select>
        <h2>{{'classes' | t}}</h2>
        <input type=\"text\" id=\"fc-classes\">
        <h2>{{'content' | t}}</h2>
        <iframe id=\"fc-preview\" srcdoc=\"\" src=\"http://wp-playground.localhost\" frameborder=\"0\"></iframe>
        <div id=\"fc-field-properties\"></div>
    </div>
</template>

<script data-tab=\"editor\">formacopoeia.components.editor = 
{
    themeSelector: null,
    classesInput: null,
    getFieldById: function(id) {
        for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
            if (id === formacopoeia.currentForm[i].id) {
                return formacopoeia.currentForm[i];
            }
        }
    },
    resolvePropTypes: function(prop, type, value) {
        if (!value) {
            value = '';
        }
        var types = {
            checkbox: 'input type=\"checkbox\" data-prop=\"' + prop + '\" checked=\"' + (value ? 'checked' : '') + '\">',
            text: '<input type=\"text\" data-prop=\"' + prop + '\" value=\"' + value + '\">',
            textarea: '<textarea data-prop=\"' + prop + '\">' + value + '</textarea>'
        };
        return prop + ': ' + types[type];
    },
    onInit: function() {
        
    },
    onActive: function() {
        var self = this;
        var srcdoc = '<form id=\"fc-form\"></form><link id=\"fc-style\" rel=\"stylesheet\" href=\"\"><button id=\"fc-add\">+</button>';
        srcdoc += '<div id=\"choices\" style=\"display: none\">';
        for (var i = 0; i < formacopoeia.fields.length; ++i) {
            srcdoc += '<button class=\"new-field\" data-field=\"' + formacopoeia.fields[i].name + '\">' + formacopoeia.fields[i].options.label + '</button>';
        }
        srcdoc += '</div>';

        var iframe = select('#fc-preview');
        var fieldPropertiesBlock = select('#fc-field-properties');
        iframe.srcdoc = srcdoc;
        this.themeSelector = select('#fc-theme');
        this.classesInput = select('#fc-classes');
        domReady(function() {
            var iframeDoc = iframe.contentDocument;
            var form = select('#fc-form', iframeDoc);
            var style = select('#fc-style', iframeDoc);
            var choices = select('div#choices', iframeDoc);

            style.href = getThemeByName(self.themeSelector.value).options.path;

            self.themeSelector.on('change', function() {
                style.href = getThemeByName(this.value).options.path;
            });

            select('button', iframeDoc).addEventListener('click', function() {
                choices.style.display = 'block';
            });

            var togglePropertiesBlock = function(id) {
                var propertiesString = '<div><span id=\"fc-move-up\">↑</span><span id=\"fc-move-down\">↓</span><span id=\"fc-remove\">×</span>';
                var field = getFieldByType(self.getFieldById(id).type);
                console.log(field)
                for (var prop in field.options.props) {
                    propertiesString += self.resolvePropTypes(prop, field.options.props[prop].type, self.getFieldById(id).props[prop]) + '<br>';
                }
                propertiesString += '</div>';
                fieldPropertiesBlock.innerHTML = propertiesString;
                /* PLAN A DRAG AND DROP INSTEAD OF ARROWS */
                select('#fc-remove', fieldPropertiesBlock).on('click', (function(id) {
                    return function() {
                        for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
                            if (id === formacopoeia.currentForm[i].id) {
                                formacopoeia.currentForm.splice(i, 1);
                                var tmp = select('field-wrapper[data-id=\"' + id + '\"]', iframeDoc);
                                tmp.parentNode.removeChild(tmp);
                                fieldPropertiesBlock.removeChild(fieldPropertiesBlock.firstChild);
                                return;
                            }
                        }
                    }
                })(id));
                selectAll('input', fieldPropertiesBlock).on('input', (function(id) {
                    return function() {
                        self.getFieldById(id).props[this.dataset.prop] = this.value;
                        var formField = self.getFieldById(id);
                        var field = getFieldByType(formField.type);                        
                        select('field-wrapper[data-id=\"' + id + '\"]', iframeDoc).innerHTML = formacopoeiaRenderer(field.options.template, formField.props);
                    }
                })(id));
            };

            // INIT FROM EXISTING VALUES (TO MOVE & REFACTOR)
            for (var index in formacopoeia.currentForm) {
                var field = getFieldByType(formacopoeia.currentForm[index].type);
                form.innerHTML += '<field-wrapper data-id=\"' + formacopoeia.currentForm[index].id + '\">' + formacopoeiaRenderer(field.options.template, formacopoeia.currentForm[index].props) + '</field-wrapper>';
            }

            iframe.contentWindow.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var fieldWrapper = e.target.closest('field-wrapper');
                if (!fieldWrapper) {
                    return;
                }
                togglePropertiesBlock(fieldWrapper.dataset.id);
            });

            var buttonsNewField = selectAll('button.new-field', iframeDoc);
            toArray(buttonsNewField).forEach(function(item) {
                item.addEventListener('click', function() {
                    var id = Math.random().toString(36).substr(2, 8);
                    var field = getFieldByType(this.dataset.field);
                    form.innerHTML += '<field-wrapper data-id=\"' + id + '\">' + field.options.template + '</<field-wrapper>';
                    choices.style.display = 'none';
                    formacopoeia.currentForm.push({
                        id: id,
                        type: this.dataset.field,
                        props: {},
                    });
                    togglePropertiesBlock(id);
                });
            });
        }, iframe.contentWindow);
    },
    onRemoveActive: function() {
        
    },
    onSave: function() {
        var iframe = select('#fc-preview');
        var iframeDoc = iframe.contentDocument;
        var form = select('#fc-form', iframeDoc);
        // REMOVE field-wrapper... or do not save the content
        return {
            classes: this.classesInput.value,
            theme: this.themeSelector.value,
            // content: form.parentNode.innerHTML
        };
    }
}
</script>";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  203 => 11,  198 => 9,  195 => 8,  184 => 6,  180 => 5,  175 => 3,  171 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<template data-tab=\"editor\">
    <div>
        <h2>{{'theme' | t}}</h2>
        <select id=\"fc-theme\">
            {% for theme in themes%}
                <option value=\"{{theme.name}}\">{{theme.options.label}}</option>
            {% endfor %}
        </select>
        <h2>{{'classes' | t}}</h2>
        <input type=\"text\" id=\"fc-classes\">
        <h2>{{'content' | t}}</h2>
        <iframe id=\"fc-preview\" srcdoc=\"\" src=\"http://wp-playground.localhost\" frameborder=\"0\"></iframe>
        <div id=\"fc-field-properties\"></div>
    </div>
</template>

<script data-tab=\"editor\">formacopoeia.components.editor = 
{
    themeSelector: null,
    classesInput: null,
    getFieldById: function(id) {
        for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
            if (id === formacopoeia.currentForm[i].id) {
                return formacopoeia.currentForm[i];
            }
        }
    },
    resolvePropTypes: function(prop, type, value) {
        if (!value) {
            value = '';
        }
        var types = {
            checkbox: 'input type=\"checkbox\" data-prop=\"' + prop + '\" checked=\"' + (value ? 'checked' : '') + '\">',
            text: '<input type=\"text\" data-prop=\"' + prop + '\" value=\"' + value + '\">',
            textarea: '<textarea data-prop=\"' + prop + '\">' + value + '</textarea>'
        };
        return prop + ': ' + types[type];
    },
    onInit: function() {
        
    },
    onActive: function() {
        var self = this;
        var srcdoc = '<form id=\"fc-form\"></form><link id=\"fc-style\" rel=\"stylesheet\" href=\"\"><button id=\"fc-add\">+</button>';
        srcdoc += '<div id=\"choices\" style=\"display: none\">';
        for (var i = 0; i < formacopoeia.fields.length; ++i) {
            srcdoc += '<button class=\"new-field\" data-field=\"' + formacopoeia.fields[i].name + '\">' + formacopoeia.fields[i].options.label + '</button>';
        }
        srcdoc += '</div>';

        var iframe = select('#fc-preview');
        var fieldPropertiesBlock = select('#fc-field-properties');
        iframe.srcdoc = srcdoc;
        this.themeSelector = select('#fc-theme');
        this.classesInput = select('#fc-classes');
        domReady(function() {
            var iframeDoc = iframe.contentDocument;
            var form = select('#fc-form', iframeDoc);
            var style = select('#fc-style', iframeDoc);
            var choices = select('div#choices', iframeDoc);

            style.href = getThemeByName(self.themeSelector.value).options.path;

            self.themeSelector.on('change', function() {
                style.href = getThemeByName(this.value).options.path;
            });

            select('button', iframeDoc).addEventListener('click', function() {
                choices.style.display = 'block';
            });

            var togglePropertiesBlock = function(id) {
                var propertiesString = '<div><span id=\"fc-move-up\">↑</span><span id=\"fc-move-down\">↓</span><span id=\"fc-remove\">×</span>';
                var field = getFieldByType(self.getFieldById(id).type);
                console.log(field)
                for (var prop in field.options.props) {
                    propertiesString += self.resolvePropTypes(prop, field.options.props[prop].type, self.getFieldById(id).props[prop]) + '<br>';
                }
                propertiesString += '</div>';
                fieldPropertiesBlock.innerHTML = propertiesString;
                /* PLAN A DRAG AND DROP INSTEAD OF ARROWS */
                select('#fc-remove', fieldPropertiesBlock).on('click', (function(id) {
                    return function() {
                        for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
                            if (id === formacopoeia.currentForm[i].id) {
                                formacopoeia.currentForm.splice(i, 1);
                                var tmp = select('field-wrapper[data-id=\"' + id + '\"]', iframeDoc);
                                tmp.parentNode.removeChild(tmp);
                                fieldPropertiesBlock.removeChild(fieldPropertiesBlock.firstChild);
                                return;
                            }
                        }
                    }
                })(id));
                selectAll('input', fieldPropertiesBlock).on('input', (function(id) {
                    return function() {
                        self.getFieldById(id).props[this.dataset.prop] = this.value;
                        var formField = self.getFieldById(id);
                        var field = getFieldByType(formField.type);                        
                        select('field-wrapper[data-id=\"' + id + '\"]', iframeDoc).innerHTML = formacopoeiaRenderer(field.options.template, formField.props);
                    }
                })(id));
            };

            // INIT FROM EXISTING VALUES (TO MOVE & REFACTOR)
            for (var index in formacopoeia.currentForm) {
                var field = getFieldByType(formacopoeia.currentForm[index].type);
                form.innerHTML += '<field-wrapper data-id=\"' + formacopoeia.currentForm[index].id + '\">' + formacopoeiaRenderer(field.options.template, formacopoeia.currentForm[index].props) + '</field-wrapper>';
            }

            iframe.contentWindow.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var fieldWrapper = e.target.closest('field-wrapper');
                if (!fieldWrapper) {
                    return;
                }
                togglePropertiesBlock(fieldWrapper.dataset.id);
            });

            var buttonsNewField = selectAll('button.new-field', iframeDoc);
            toArray(buttonsNewField).forEach(function(item) {
                item.addEventListener('click', function() {
                    var id = Math.random().toString(36).substr(2, 8);
                    var field = getFieldByType(this.dataset.field);
                    form.innerHTML += '<field-wrapper data-id=\"' + id + '\">' + field.options.template + '</<field-wrapper>';
                    choices.style.display = 'none';
                    formacopoeia.currentForm.push({
                        id: id,
                        type: this.dataset.field,
                        props: {},
                    });
                    togglePropertiesBlock(id);
                });
            });
        }, iframe.contentWindow);
    },
    onRemoveActive: function() {
        
    },
    onSave: function() {
        var iframe = select('#fc-preview');
        var iframeDoc = iframe.contentDocument;
        var form = select('#fc-form', iframeDoc);
        // REMOVE field-wrapper... or do not save the content
        return {
            classes: this.classesInput.value,
            theme: this.themeSelector.value,
            // content: form.parentNode.innerHTML
        };
    }
}
</script>", "<template data-tab=\"editor\">
    <div>
        <h2>{{'theme' | t}}</h2>
        <select id=\"fc-theme\">
            {% for theme in themes%}
                <option value=\"{{theme.name}}\">{{theme.options.label}}</option>
            {% endfor %}
        </select>
        <h2>{{'classes' | t}}</h2>
        <input type=\"text\" id=\"fc-classes\">
        <h2>{{'content' | t}}</h2>
        <iframe id=\"fc-preview\" srcdoc=\"\" src=\"http://wp-playground.localhost\" frameborder=\"0\"></iframe>
        <div id=\"fc-field-properties\"></div>
    </div>
</template>

<script data-tab=\"editor\">formacopoeia.components.editor = 
{
    themeSelector: null,
    classesInput: null,
    getFieldById: function(id) {
        for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
            if (id === formacopoeia.currentForm[i].id) {
                return formacopoeia.currentForm[i];
            }
        }
    },
    resolvePropTypes: function(prop, type, value) {
        if (!value) {
            value = '';
        }
        var types = {
            checkbox: 'input type=\"checkbox\" data-prop=\"' + prop + '\" checked=\"' + (value ? 'checked' : '') + '\">',
            text: '<input type=\"text\" data-prop=\"' + prop + '\" value=\"' + value + '\">',
            textarea: '<textarea data-prop=\"' + prop + '\">' + value + '</textarea>'
        };
        return prop + ': ' + types[type];
    },
    onInit: function() {
        
    },
    onActive: function() {
        var self = this;
        var srcdoc = '<form id=\"fc-form\"></form><link id=\"fc-style\" rel=\"stylesheet\" href=\"\"><button id=\"fc-add\">+</button>';
        srcdoc += '<div id=\"choices\" style=\"display: none\">';
        for (var i = 0; i < formacopoeia.fields.length; ++i) {
            srcdoc += '<button class=\"new-field\" data-field=\"' + formacopoeia.fields[i].name + '\">' + formacopoeia.fields[i].options.label + '</button>';
        }
        srcdoc += '</div>';

        var iframe = select('#fc-preview');
        var fieldPropertiesBlock = select('#fc-field-properties');
        iframe.srcdoc = srcdoc;
        this.themeSelector = select('#fc-theme');
        this.classesInput = select('#fc-classes');
        domReady(function() {
            var iframeDoc = iframe.contentDocument;
            var form = select('#fc-form', iframeDoc);
            var style = select('#fc-style', iframeDoc);
            var choices = select('div#choices', iframeDoc);

            style.href = getThemeByName(self.themeSelector.value).options.path;

            self.themeSelector.on('change', function() {
                style.href = getThemeByName(this.value).options.path;
            });

            select('button', iframeDoc).addEventListener('click', function() {
                choices.style.display = 'block';
            });

            var togglePropertiesBlock = function(id) {
                var propertiesString = '<div><span id=\"fc-move-up\">↑</span><span id=\"fc-move-down\">↓</span><span id=\"fc-remove\">×</span>';
                var field = getFieldByType(self.getFieldById(id).type);
                console.log(field)
                for (var prop in field.options.props) {
                    propertiesString += self.resolvePropTypes(prop, field.options.props[prop].type, self.getFieldById(id).props[prop]) + '<br>';
                }
                propertiesString += '</div>';
                fieldPropertiesBlock.innerHTML = propertiesString;
                /* PLAN A DRAG AND DROP INSTEAD OF ARROWS */
                select('#fc-remove', fieldPropertiesBlock).on('click', (function(id) {
                    return function() {
                        for (var i = 0; i < formacopoeia.currentForm.length; ++i) {
                            if (id === formacopoeia.currentForm[i].id) {
                                formacopoeia.currentForm.splice(i, 1);
                                var tmp = select('field-wrapper[data-id=\"' + id + '\"]', iframeDoc);
                                tmp.parentNode.removeChild(tmp);
                                fieldPropertiesBlock.removeChild(fieldPropertiesBlock.firstChild);
                                return;
                            }
                        }
                    }
                })(id));
                selectAll('input', fieldPropertiesBlock).on('input', (function(id) {
                    return function() {
                        self.getFieldById(id).props[this.dataset.prop] = this.value;
                        var formField = self.getFieldById(id);
                        var field = getFieldByType(formField.type);                        
                        select('field-wrapper[data-id=\"' + id + '\"]', iframeDoc).innerHTML = formacopoeiaRenderer(field.options.template, formField.props);
                    }
                })(id));
            };

            // INIT FROM EXISTING VALUES (TO MOVE & REFACTOR)
            for (var index in formacopoeia.currentForm) {
                var field = getFieldByType(formacopoeia.currentForm[index].type);
                form.innerHTML += '<field-wrapper data-id=\"' + formacopoeia.currentForm[index].id + '\">' + formacopoeiaRenderer(field.options.template, formacopoeia.currentForm[index].props) + '</field-wrapper>';
            }

            iframe.contentWindow.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var fieldWrapper = e.target.closest('field-wrapper');
                if (!fieldWrapper) {
                    return;
                }
                togglePropertiesBlock(fieldWrapper.dataset.id);
            });

            var buttonsNewField = selectAll('button.new-field', iframeDoc);
            toArray(buttonsNewField).forEach(function(item) {
                item.addEventListener('click', function() {
                    var id = Math.random().toString(36).substr(2, 8);
                    var field = getFieldByType(this.dataset.field);
                    form.innerHTML += '<field-wrapper data-id=\"' + id + '\">' + field.options.template + '</<field-wrapper>';
                    choices.style.display = 'none';
                    formacopoeia.currentForm.push({
                        id: id,
                        type: this.dataset.field,
                        props: {},
                    });
                    togglePropertiesBlock(id);
                });
            });
        }, iframe.contentWindow);
    },
    onRemoveActive: function() {
        
    },
    onSave: function() {
        var iframe = select('#fc-preview');
        var iframeDoc = iframe.contentDocument;
        var form = select('#fc-form', iframeDoc);
        // REMOVE field-wrapper... or do not save the content
        return {
            classes: this.classesInput.value,
            theme: this.themeSelector.value,
            // content: form.parentNode.innerHTML
        };
    }
}
</script>", "");
    }
}
