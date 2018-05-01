<?php

/* <div class="wrap">
    <h1 class="wp-heading-inline">{{(action ~ 'Title') | t}}</h1>

    <hr class="wp-header-end">

    <div name="post" method="post">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <div id="post-body-content" style="position: relative;">

                    <div id="titlediv">
                        <div id="titlewrap">
                            {% if form is null %}
                                <label class="" id="title-prompt-text" for="title">Enter title here</label>
                            {% endif %}
                            <input name="post_title" size="30" value="{{form.title}}" id="fc-title" spellcheck="true" autocomplete="off" type="text">
                        </div>
                    </div>
                    <!-- /titlediv -->
                    <div id="postdivrich" class="postarea wp-editor-expand">

                        <div id="wp-content-wrap" class="wp-core-ui wp-editor-wrap tmce-active has-dfw" style="padding-top: 54px;">
                            <link rel="stylesheet" id="editor-buttons-css" href="http://wp-playground.localhost/wp-includes/css/editor.min.css?ver=4.9.5"
                                type="text/css" media="all">
                            <div id="wp-content-editor-tools" class="wp-editor-tools hide-if-no-js" style="position: absolute; top: 0px; width: 955px;">
                                <div class="wp-editor-tabs">
                                    {% for tab in tabs %}
                                        <button class="wp-switch-editor fc-tab" data-tab="{{tab.name}}">{{tab.name | t}}</button>
                                    {% endfor %}
                                </div>
                            </div>
                            <div id="fc-container" class="wp-editor-container">
                                {# Tab content goes here #}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /post-body-content -->

                <div id="postbox-container-1" class="postbox-container">
                    <div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
                        <div id="submitdiv" class="postbox ">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">Toggle panel: Publish</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                            <h2 class="hndle ui-sortable-handle">
                                <span>{{'publish' | t}}</span>
                            </h2>
                            <div class="inside">
                                <div class="submitbox" id="submitpost">

                                    <div id="minor-publishing">

                                        <div id="misc-publishing-actions">

                                            <div class="misc-pub-section misc-pub-post-status">
                                                Status:
                                                <span id="post-status-display">Draft</span>
                                                <a href="#post_status" class="edit-post-status hide-if-no-js" role="button">
                                                    <span aria-hidden="true">Edit</span>
                                                    <span class="screen-reader-text">Edit status</span>
                                                </a>

                                                <div id="post-status-select" class="hide-if-js">
                                                    <input name="hidden_post_status" id="hidden_post_status" value="draft" type="hidden">
                                                    <label for="post_status" class="screen-reader-text">Set status</label>
                                                    <select name="post_status" id="post_status">
                                                        <option value="pending">Pending Review</option>
                                                        <option selected="selected" value="draft">Draft</option>
                                                    </select>
                                                    <a href="#post_status" class="save-post-status hide-if-no-js button">OK</a>
                                                    <a href="#post_status" class="cancel-post-status hide-if-no-js button-cancel">Cancel</a>
                                                </div>

                                            </div>
                                            <div class="misc-pub-section curtime misc-pub-curtime">
                                                <span id="timestamp">
                                                    Publish
                                                    <b>immediately</b>
                                                </span>
                                                <a href="#edit_timestamp" class="edit-timestamp hide-if-no-js" role="button">
                                                    <span aria-hidden="true">Edit</span>
                                                    <span class="screen-reader-text">Edit date and time</span>
                                                </a>
                                                <fieldset id="timestampdiv" class="hide-if-js">
                                                    <legend class="screen-reader-text">Date and time</legend>
                                                    <div class="timestamp-wrap">
                                                        <label>
                                                            <span class="screen-reader-text">Month</span>
                                                            <select id="mm" name="mm">
                                                                <option value="01" data-text="Jan">01-Jan</option>
                                                                <option value="02" data-text="Feb">02-Feb</option>
                                                                <option value="03" data-text="Mar">03-Mar</option>
                                                                <option value="04" data-text="Apr" selected="selected">04-Apr</option>
                                                                <option value="05" data-text="May">05-May</option>
                                                                <option value="06" data-text="Jun">06-Jun</option>
                                                                <option value="07" data-text="Jul">07-Jul</option>
                                                                <option value="08" data-text="Aug">08-Aug</option>
                                                                <option value="09" data-text="Sep">09-Sep</option>
                                                                <option value="10" data-text="Oct">10-Oct</option>
                                                                <option value="11" data-text="Nov">11-Nov</option>
                                                                <option value="12" data-text="Dec">12-Dec</option>
                                                            </select>
                                                        </label>
                                                        <label>
                                                            <span class="screen-reader-text">Day</span>
                                                            <input id="jj" name="jj" value="24" size="2" maxlength="2"
                                                                autocomplete="off" type="text">
                                                        </label>,
                                                        <label>
                                                            <span class="screen-reader-text">Year</span>
                                                            <input id="aa" name="aa" value="2018" size="4" maxlength="4"
                                                                autocomplete="off" type="text">
                                                        </label> @
                                                        <label>
                                                            <span class="screen-reader-text">Hour</span>
                                                            <input id="hh" name="hh" value="19" size="2" maxlength="2"
                                                                autocomplete="off" type="text">
                                                        </label>:
                                                        <label>
                                                            <span class="screen-reader-text">Minute</span>
                                                            <input id="mn" name="mn" value="13" size="2" maxlength="2"
                                                                autocomplete="off" type="text">
                                                        </label>
                                                    </div>
                                                    <input id="ss" name="ss" value="01" type="hidden">

                                                    <input id="hidden_mm" name="hidden_mm" value="04" type="hidden">
                                                    <input id="cur_mm" name="cur_mm" value="04" type="hidden">
                                                    <input id="hidden_jj" name="hidden_jj" value="24" type="hidden">
                                                    <input id="cur_jj" name="cur_jj" value="24" type="hidden">
                                                    <input id="hidden_aa" name="hidden_aa" value="2018" type="hidden">
                                                    <input id="cur_aa" name="cur_aa" value="2018" type="hidden">
                                                    <input id="hidden_hh" name="hidden_hh" value="19" type="hidden">
                                                    <input id="cur_hh" name="cur_hh" value="19" type="hidden">
                                                    <input id="hidden_mn" name="hidden_mn" value="13" type="hidden">
                                                    <input id="cur_mn" name="cur_mn" value="13" type="hidden">

                                                    <p>
                                                        <a href="#edit_timestamp" class="save-timestamp hide-if-no-js button">OK</a>
                                                        <a href="#edit_timestamp" class="cancel-timestamp hide-if-no-js button-cancel">Cancel</a>
                                                    </p>
                                                </fieldset>
                                            </div>

                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                            <span class="spinner"></span>
                                            <input id="fc-save" class="button button-primary button-large" value="Save" type="submit">
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="postbox-container-2" class="postbox-container">
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                        <div id="postexcerpt" class="postbox  hide-if-js" style="">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">Toggle panel: Excerpt</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                            <h2 class="hndle ui-sortable-handle">
                                <span>Excerpt</span>
                            </h2>
                            <div class="inside">
                                <label class="screen-reader-text" for="excerpt">Excerpt</label>
                                <textarea rows="1" cols="40" name="excerpt" id="excerpt"></textarea>
                                <p>Excerpts are optional hand-crafted summaries of your content that can be used in your theme.
                                    <a href="https://codex.wordpress.org/Excerpt">Learn more about manual excerpts</a>.</p>
                            </div>
                        </div>
                        <div id="trackbacksdiv" class="postbox  hide-if-js" style="">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">Toggle panel: Send Trackbacks</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                            <h2 class="hndle ui-sortable-handle">
                                <span>Send Trackbacks</span>
                            </h2>
                            <div class="inside">
                                <p>
                                    <label for="trackback_url">Send trackbacks to:</label>
                                    <input name="trackback_url" id="trackback_url" class="code" value="" aria-describedby="trackback-url-desc" type="text">
                                </p>
                                <p id="trackback-url-desc" class="howto">Separate multiple URLs with spaces</p>
                                <p>Trackbacks are a way to notify legacy blog systems that you’ve linked to them. If you link
                                    other WordPress sites, they’ll be notified automatically using
                                    <a href="https://codex.wordpress.org/Introduction_to_Blogging#Managing_Comments">pingbacks</a>, no other action necessary.</p>
                            </div>
                        </div>
                        <div id="postcustom" class="postbox  hide-if-js" style="">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">Toggle panel: Custom Fields</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                            <h2 class="hndle ui-sortable-handle">
                                <span>Custom Fields</span>
                            </h2>
                            <div class="inside">
                                <div id="postcustomstuff">
                                    <div id="ajax-response"></div>

                                    <table id="list-table" style="display: none;">
                                        <thead>
                                            <tr>
                                                <th class="left">Name</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody id="the-list" data-wp-lists="list:meta">
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        <strong>Add New Custom Field:</strong>
                                    </p>
                                    <table id="newmeta">
                                        <thead>
                                            <tr>
                                                <th class="left">
                                                    <label for="metakeyinput">Name</label>
                                                </th>
                                                <th>
                                                    <label for="metavalue">Value</label>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td id="newmetaleft" class="left">
                                                    <input id="metakeyinput" name="metakeyinput" value="" type="text">
                                                </td>
                                                <td>
                                                    <textarea id="metavalue" name="metavalue" rows="2" cols="25"></textarea>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2">
                                                    <div class="submit">
                                                        <input name="addmeta" id="newmeta-submit" class="button" value="Add Custom Field" data-wp-lists="add:the-list:newmeta" type="submit">
                                                    </div>
                                                    <input id="_ajax_nonce-add-meta" name="_ajax_nonce-add-meta" value="4982dc3454" type="hidden">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p>Custom fields can be used to add extra metadata to a post that you can
                                    <a href="https://codex.wordpress.org/Using_Custom_Fields">use in your theme</a>.</p>
                            </div>
                        </div>
                        <div id="commentstatusdiv" class="postbox  hide-if-js" style="">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">Toggle panel: Discussion</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                            <h2 class="hndle ui-sortable-handle">
                                <span>Discussion</span>
                            </h2>
                            <div class="inside">
                                <input name="advanced_view" value="1" type="hidden">
                                <p class="meta-options">
                                    <label for="comment_status" class="selectit">
                                        <input name="comment_status" id="comment_status" value="open" checked="checked" type="checkbox"> Allow comments</label>
                                    <br>
                                    <label for="ping_status" class="selectit">
                                        <input name="ping_status" id="ping_status" value="open" checked="checked" type="checkbox"> Allow
                                        <a href="https://codex.wordpress.org/Introduction_to_Blogging#Managing_Comments">trackbacks and pingbacks</a> on this page</label>
                                </p>
                            </div>
                        </div>
                        <div id="slugdiv" class="postbox  hide-if-js" style="">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">Toggle panel: Slug</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                            <h2 class="hndle ui-sortable-handle">
                                <span>Slug</span>
                            </h2>
                            <div class="inside">
                                <label class="screen-reader-text" for="post_name">Slug</label>
                                <input name="post_name" size="13" id="post_name" value="" type="text">
                            </div>
                        </div>
                        <div id="authordiv" class="postbox  hide-if-js" style="">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">Toggle panel: Author</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                            <h2 class="hndle ui-sortable-handle">
                                <span>Author</span>
                            </h2>
                            <div class="inside">
                                <label class="screen-reader-text" for="post_author_override">Author</label>
                                <select name="post_author_override" id="post_author_override" class="">
                                    <option value="1" selected="selected">Test (Test)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="advanced-sortables" class="meta-box-sortables ui-sortable"></div>
                </div>
            </div>
            <!-- /post-body -->
            <br class="clear">
        </div>
        <!-- /poststuff -->
    </div>
</div> */
class __TwigTemplate_4548e400c25cb2cc0f5b0c3f28b45afd0af83a1ac331efcfaec5d05ce48f0c24 extends Twig_Template
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
        echo "<div class=\"wrap\">
    <h1 class=\"wp-heading-inline\">";
        // line 2
        echo twig_escape_filter($this->env, \Formacopoeia\All\Translate_Controller::_t(((isset($context["action"]) ? $context["action"] : null) . "Title")), "html", null, true);
        echo "</h1>

    <hr class=\"wp-header-end\">

    <div name=\"post\" method=\"post\">
        <div id=\"poststuff\">
            <div id=\"post-body\" class=\"metabox-holder columns-2\">
                <div id=\"post-body-content\" style=\"position: relative;\">

                    <div id=\"titlediv\">
                        <div id=\"titlewrap\">
                            ";
        // line 13
        if ((null === (isset($context["form"]) ? $context["form"] : null))) {
            // line 14
            echo "                                <label class=\"\" id=\"title-prompt-text\" for=\"title\">Enter title here</label>
                            ";
        }
        // line 16
        echo "                            <input name=\"post_title\" size=\"30\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "title", array()), "html", null, true);
        echo "\" id=\"fc-title\" spellcheck=\"true\" autocomplete=\"off\" type=\"text\">
                        </div>
                    </div>
                    <!-- /titlediv -->
                    <div id=\"postdivrich\" class=\"postarea wp-editor-expand\">

                        <div id=\"wp-content-wrap\" class=\"wp-core-ui wp-editor-wrap tmce-active has-dfw\" style=\"padding-top: 54px;\">
                            <link rel=\"stylesheet\" id=\"editor-buttons-css\" href=\"http://wp-playground.localhost/wp-includes/css/editor.min.css?ver=4.9.5\"
                                type=\"text/css\" media=\"all\">
                            <div id=\"wp-content-editor-tools\" class=\"wp-editor-tools hide-if-no-js\" style=\"position: absolute; top: 0px; width: 955px;\">
                                <div class=\"wp-editor-tabs\">
                                    ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tabs"]) ? $context["tabs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["tab"]) {
            // line 28
            echo "                                        <button class=\"wp-switch-editor fc-tab\" data-tab=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["tab"], "name", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, \Formacopoeia\All\Translate_Controller::_t($this->getAttribute($context["tab"], "name", array())), "html", null, true);
            echo "</button>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tab'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "                                </div>
                            </div>
                            <div id=\"fc-container\" class=\"wp-editor-container\">
                                ";
        // line 34
        echo "                            </div>
                        </div>
                    </div>
                </div>
                <!-- /post-body-content -->

                <div id=\"postbox-container-1\" class=\"postbox-container\">
                    <div id=\"side-sortables\" class=\"meta-box-sortables ui-sortable\" style=\"\">
                        <div id=\"submitdiv\" class=\"postbox \">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Publish</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>";
        // line 48
        echo twig_escape_filter($this->env, \Formacopoeia\All\Translate_Controller::_t("publish"), "html", null, true);
        echo "</span>
                            </h2>
                            <div class=\"inside\">
                                <div class=\"submitbox\" id=\"submitpost\">

                                    <div id=\"minor-publishing\">

                                        <div id=\"misc-publishing-actions\">

                                            <div class=\"misc-pub-section misc-pub-post-status\">
                                                Status:
                                                <span id=\"post-status-display\">Draft</span>
                                                <a href=\"#post_status\" class=\"edit-post-status hide-if-no-js\" role=\"button\">
                                                    <span aria-hidden=\"true\">Edit</span>
                                                    <span class=\"screen-reader-text\">Edit status</span>
                                                </a>

                                                <div id=\"post-status-select\" class=\"hide-if-js\">
                                                    <input name=\"hidden_post_status\" id=\"hidden_post_status\" value=\"draft\" type=\"hidden\">
                                                    <label for=\"post_status\" class=\"screen-reader-text\">Set status</label>
                                                    <select name=\"post_status\" id=\"post_status\">
                                                        <option value=\"pending\">Pending Review</option>
                                                        <option selected=\"selected\" value=\"draft\">Draft</option>
                                                    </select>
                                                    <a href=\"#post_status\" class=\"save-post-status hide-if-no-js button\">OK</a>
                                                    <a href=\"#post_status\" class=\"cancel-post-status hide-if-no-js button-cancel\">Cancel</a>
                                                </div>

                                            </div>
                                            <div class=\"misc-pub-section curtime misc-pub-curtime\">
                                                <span id=\"timestamp\">
                                                    Publish
                                                    <b>immediately</b>
                                                </span>
                                                <a href=\"#edit_timestamp\" class=\"edit-timestamp hide-if-no-js\" role=\"button\">
                                                    <span aria-hidden=\"true\">Edit</span>
                                                    <span class=\"screen-reader-text\">Edit date and time</span>
                                                </a>
                                                <fieldset id=\"timestampdiv\" class=\"hide-if-js\">
                                                    <legend class=\"screen-reader-text\">Date and time</legend>
                                                    <div class=\"timestamp-wrap\">
                                                        <label>
                                                            <span class=\"screen-reader-text\">Month</span>
                                                            <select id=\"mm\" name=\"mm\">
                                                                <option value=\"01\" data-text=\"Jan\">01-Jan</option>
                                                                <option value=\"02\" data-text=\"Feb\">02-Feb</option>
                                                                <option value=\"03\" data-text=\"Mar\">03-Mar</option>
                                                                <option value=\"04\" data-text=\"Apr\" selected=\"selected\">04-Apr</option>
                                                                <option value=\"05\" data-text=\"May\">05-May</option>
                                                                <option value=\"06\" data-text=\"Jun\">06-Jun</option>
                                                                <option value=\"07\" data-text=\"Jul\">07-Jul</option>
                                                                <option value=\"08\" data-text=\"Aug\">08-Aug</option>
                                                                <option value=\"09\" data-text=\"Sep\">09-Sep</option>
                                                                <option value=\"10\" data-text=\"Oct\">10-Oct</option>
                                                                <option value=\"11\" data-text=\"Nov\">11-Nov</option>
                                                                <option value=\"12\" data-text=\"Dec\">12-Dec</option>
                                                            </select>
                                                        </label>
                                                        <label>
                                                            <span class=\"screen-reader-text\">Day</span>
                                                            <input id=\"jj\" name=\"jj\" value=\"24\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>,
                                                        <label>
                                                            <span class=\"screen-reader-text\">Year</span>
                                                            <input id=\"aa\" name=\"aa\" value=\"2018\" size=\"4\" maxlength=\"4\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label> @
                                                        <label>
                                                            <span class=\"screen-reader-text\">Hour</span>
                                                            <input id=\"hh\" name=\"hh\" value=\"19\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>:
                                                        <label>
                                                            <span class=\"screen-reader-text\">Minute</span>
                                                            <input id=\"mn\" name=\"mn\" value=\"13\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>
                                                    </div>
                                                    <input id=\"ss\" name=\"ss\" value=\"01\" type=\"hidden\">

                                                    <input id=\"hidden_mm\" name=\"hidden_mm\" value=\"04\" type=\"hidden\">
                                                    <input id=\"cur_mm\" name=\"cur_mm\" value=\"04\" type=\"hidden\">
                                                    <input id=\"hidden_jj\" name=\"hidden_jj\" value=\"24\" type=\"hidden\">
                                                    <input id=\"cur_jj\" name=\"cur_jj\" value=\"24\" type=\"hidden\">
                                                    <input id=\"hidden_aa\" name=\"hidden_aa\" value=\"2018\" type=\"hidden\">
                                                    <input id=\"cur_aa\" name=\"cur_aa\" value=\"2018\" type=\"hidden\">
                                                    <input id=\"hidden_hh\" name=\"hidden_hh\" value=\"19\" type=\"hidden\">
                                                    <input id=\"cur_hh\" name=\"cur_hh\" value=\"19\" type=\"hidden\">
                                                    <input id=\"hidden_mn\" name=\"hidden_mn\" value=\"13\" type=\"hidden\">
                                                    <input id=\"cur_mn\" name=\"cur_mn\" value=\"13\" type=\"hidden\">

                                                    <p>
                                                        <a href=\"#edit_timestamp\" class=\"save-timestamp hide-if-no-js button\">OK</a>
                                                        <a href=\"#edit_timestamp\" class=\"cancel-timestamp hide-if-no-js button-cancel\">Cancel</a>
                                                    </p>
                                                </fieldset>
                                            </div>

                                        </div>
                                        <div class=\"clear\"></div>
                                    </div>

                                    <div id=\"major-publishing-actions\">
                                        <div id=\"publishing-action\">
                                            <span class=\"spinner\"></span>
                                            <input id=\"fc-save\" class=\"button button-primary button-large\" value=\"Save\" type=\"submit\">
                                        </div>
                                        <div class=\"clear\"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id=\"postbox-container-2\" class=\"postbox-container\">
                    <div id=\"normal-sortables\" class=\"meta-box-sortables ui-sortable\">
                        <div id=\"postexcerpt\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Excerpt</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Excerpt</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"excerpt\">Excerpt</label>
                                <textarea rows=\"1\" cols=\"40\" name=\"excerpt\" id=\"excerpt\"></textarea>
                                <p>Excerpts are optional hand-crafted summaries of your content that can be used in your theme.
                                    <a href=\"https://codex.wordpress.org/Excerpt\">Learn more about manual excerpts</a>.</p>
                            </div>
                        </div>
                        <div id=\"trackbacksdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Send Trackbacks</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Send Trackbacks</span>
                            </h2>
                            <div class=\"inside\">
                                <p>
                                    <label for=\"trackback_url\">Send trackbacks to:</label>
                                    <input name=\"trackback_url\" id=\"trackback_url\" class=\"code\" value=\"\" aria-describedby=\"trackback-url-desc\" type=\"text\">
                                </p>
                                <p id=\"trackback-url-desc\" class=\"howto\">Separate multiple URLs with spaces</p>
                                <p>Trackbacks are a way to notify legacy blog systems that you’ve linked to them. If you link
                                    other WordPress sites, they’ll be notified automatically using
                                    <a href=\"https://codex.wordpress.org/Introduction_to_Blogging#Managing_Comments\">pingbacks</a>, no other action necessary.</p>
                            </div>
                        </div>
                        <div id=\"postcustom\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Custom Fields</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Custom Fields</span>
                            </h2>
                            <div class=\"inside\">
                                <div id=\"postcustomstuff\">
                                    <div id=\"ajax-response\"></div>

                                    <table id=\"list-table\" style=\"display: none;\">
                                        <thead>
                                            <tr>
                                                <th class=\"left\">Name</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody id=\"the-list\" data-wp-lists=\"list:meta\">
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        <strong>Add New Custom Field:</strong>
                                    </p>
                                    <table id=\"newmeta\">
                                        <thead>
                                            <tr>
                                                <th class=\"left\">
                                                    <label for=\"metakeyinput\">Name</label>
                                                </th>
                                                <th>
                                                    <label for=\"metavalue\">Value</label>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td id=\"newmetaleft\" class=\"left\">
                                                    <input id=\"metakeyinput\" name=\"metakeyinput\" value=\"\" type=\"text\">
                                                </td>
                                                <td>
                                                    <textarea id=\"metavalue\" name=\"metavalue\" rows=\"2\" cols=\"25\"></textarea>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan=\"2\">
                                                    <div class=\"submit\">
                                                        <input name=\"addmeta\" id=\"newmeta-submit\" class=\"button\" value=\"Add Custom Field\" data-wp-lists=\"add:the-list:newmeta\" type=\"submit\">
                                                    </div>
                                                    <input id=\"_ajax_nonce-add-meta\" name=\"_ajax_nonce-add-meta\" value=\"4982dc3454\" type=\"hidden\">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p>Custom fields can be used to add extra metadata to a post that you can
                                    <a href=\"https://codex.wordpress.org/Using_Custom_Fields\">use in your theme</a>.</p>
                            </div>
                        </div>
                        <div id=\"commentstatusdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Discussion</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Discussion</span>
                            </h2>
                            <div class=\"inside\">
                                <input name=\"advanced_view\" value=\"1\" type=\"hidden\">
                                <p class=\"meta-options\">
                                    <label for=\"comment_status\" class=\"selectit\">
                                        <input name=\"comment_status\" id=\"comment_status\" value=\"open\" checked=\"checked\" type=\"checkbox\"> Allow comments</label>
                                    <br>
                                    <label for=\"ping_status\" class=\"selectit\">
                                        <input name=\"ping_status\" id=\"ping_status\" value=\"open\" checked=\"checked\" type=\"checkbox\"> Allow
                                        <a href=\"https://codex.wordpress.org/Introduction_to_Blogging#Managing_Comments\">trackbacks and pingbacks</a> on this page</label>
                                </p>
                            </div>
                        </div>
                        <div id=\"slugdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Slug</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Slug</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"post_name\">Slug</label>
                                <input name=\"post_name\" size=\"13\" id=\"post_name\" value=\"\" type=\"text\">
                            </div>
                        </div>
                        <div id=\"authordiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Author</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Author</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"post_author_override\">Author</label>
                                <select name=\"post_author_override\" id=\"post_author_override\" class=\"\">
                                    <option value=\"1\" selected=\"selected\">Test (Test)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id=\"advanced-sortables\" class=\"meta-box-sortables ui-sortable\"></div>
                </div>
            </div>
            <!-- /post-body -->
            <br class=\"clear\">
        </div>
        <!-- /poststuff -->
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "<div class=\"wrap\">
    <h1 class=\"wp-heading-inline\">{{(action ~ 'Title') | t}}</h1>

    <hr class=\"wp-header-end\">

    <div name=\"post\" method=\"post\">
        <div id=\"poststuff\">
            <div id=\"post-body\" class=\"metabox-holder columns-2\">
                <div id=\"post-body-content\" style=\"position: relative;\">

                    <div id=\"titlediv\">
                        <div id=\"titlewrap\">
                            {% if form is null %}
                                <label class=\"\" id=\"title-prompt-text\" for=\"title\">Enter title here</label>
                            {% endif %}
                            <input name=\"post_title\" size=\"30\" value=\"{{form.title}}\" id=\"fc-title\" spellcheck=\"true\" autocomplete=\"off\" type=\"text\">
                        </div>
                    </div>
                    <!-- /titlediv -->
                    <div id=\"postdivrich\" class=\"postarea wp-editor-expand\">

                        <div id=\"wp-content-wrap\" class=\"wp-core-ui wp-editor-wrap tmce-active has-dfw\" style=\"padding-top: 54px;\">
                            <link rel=\"stylesheet\" id=\"editor-buttons-css\" href=\"http://wp-playground.localhost/wp-includes/css/editor.min.css?ver=4.9.5\"
                                type=\"text/css\" media=\"all\">
                            <div id=\"wp-content-editor-tools\" class=\"wp-editor-tools hide-if-no-js\" style=\"position: absolute; top: 0px; width: 955px;\">
                                <div class=\"wp-editor-tabs\">
                                    {% for tab in tabs %}
                                        <button class=\"wp-switch-editor fc-tab\" data-tab=\"{{tab.name}}\">{{tab.name | t}}</button>
                                    {% endfor %}
                                </div>
                            </div>
                            <div id=\"fc-container\" class=\"wp-editor-container\">
                                {# Tab content goes here #}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /post-body-content -->

                <div id=\"postbox-container-1\" class=\"postbox-container\">
                    <div id=\"side-sortables\" class=\"meta-box-sortables ui-sortable\" style=\"\">
                        <div id=\"submitdiv\" class=\"postbox \">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Publish</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>{{'publish' | t}}</span>
                            </h2>
                            <div class=\"inside\">
                                <div class=\"submitbox\" id=\"submitpost\">

                                    <div id=\"minor-publishing\">

                                        <div id=\"misc-publishing-actions\">

                                            <div class=\"misc-pub-section misc-pub-post-status\">
                                                Status:
                                                <span id=\"post-status-display\">Draft</span>
                                                <a href=\"#post_status\" class=\"edit-post-status hide-if-no-js\" role=\"button\">
                                                    <span aria-hidden=\"true\">Edit</span>
                                                    <span class=\"screen-reader-text\">Edit status</span>
                                                </a>

                                                <div id=\"post-status-select\" class=\"hide-if-js\">
                                                    <input name=\"hidden_post_status\" id=\"hidden_post_status\" value=\"draft\" type=\"hidden\">
                                                    <label for=\"post_status\" class=\"screen-reader-text\">Set status</label>
                                                    <select name=\"post_status\" id=\"post_status\">
                                                        <option value=\"pending\">Pending Review</option>
                                                        <option selected=\"selected\" value=\"draft\">Draft</option>
                                                    </select>
                                                    <a href=\"#post_status\" class=\"save-post-status hide-if-no-js button\">OK</a>
                                                    <a href=\"#post_status\" class=\"cancel-post-status hide-if-no-js button-cancel\">Cancel</a>
                                                </div>

                                            </div>
                                            <div class=\"misc-pub-section curtime misc-pub-curtime\">
                                                <span id=\"timestamp\">
                                                    Publish
                                                    <b>immediately</b>
                                                </span>
                                                <a href=\"#edit_timestamp\" class=\"edit-timestamp hide-if-no-js\" role=\"button\">
                                                    <span aria-hidden=\"true\">Edit</span>
                                                    <span class=\"screen-reader-text\">Edit date and time</span>
                                                </a>
                                                <fieldset id=\"timestampdiv\" class=\"hide-if-js\">
                                                    <legend class=\"screen-reader-text\">Date and time</legend>
                                                    <div class=\"timestamp-wrap\">
                                                        <label>
                                                            <span class=\"screen-reader-text\">Month</span>
                                                            <select id=\"mm\" name=\"mm\">
                                                                <option value=\"01\" data-text=\"Jan\">01-Jan</option>
                                                                <option value=\"02\" data-text=\"Feb\">02-Feb</option>
                                                                <option value=\"03\" data-text=\"Mar\">03-Mar</option>
                                                                <option value=\"04\" data-text=\"Apr\" selected=\"selected\">04-Apr</option>
                                                                <option value=\"05\" data-text=\"May\">05-May</option>
                                                                <option value=\"06\" data-text=\"Jun\">06-Jun</option>
                                                                <option value=\"07\" data-text=\"Jul\">07-Jul</option>
                                                                <option value=\"08\" data-text=\"Aug\">08-Aug</option>
                                                                <option value=\"09\" data-text=\"Sep\">09-Sep</option>
                                                                <option value=\"10\" data-text=\"Oct\">10-Oct</option>
                                                                <option value=\"11\" data-text=\"Nov\">11-Nov</option>
                                                                <option value=\"12\" data-text=\"Dec\">12-Dec</option>
                                                            </select>
                                                        </label>
                                                        <label>
                                                            <span class=\"screen-reader-text\">Day</span>
                                                            <input id=\"jj\" name=\"jj\" value=\"24\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>,
                                                        <label>
                                                            <span class=\"screen-reader-text\">Year</span>
                                                            <input id=\"aa\" name=\"aa\" value=\"2018\" size=\"4\" maxlength=\"4\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label> @
                                                        <label>
                                                            <span class=\"screen-reader-text\">Hour</span>
                                                            <input id=\"hh\" name=\"hh\" value=\"19\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>:
                                                        <label>
                                                            <span class=\"screen-reader-text\">Minute</span>
                                                            <input id=\"mn\" name=\"mn\" value=\"13\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>
                                                    </div>
                                                    <input id=\"ss\" name=\"ss\" value=\"01\" type=\"hidden\">

                                                    <input id=\"hidden_mm\" name=\"hidden_mm\" value=\"04\" type=\"hidden\">
                                                    <input id=\"cur_mm\" name=\"cur_mm\" value=\"04\" type=\"hidden\">
                                                    <input id=\"hidden_jj\" name=\"hidden_jj\" value=\"24\" type=\"hidden\">
                                                    <input id=\"cur_jj\" name=\"cur_jj\" value=\"24\" type=\"hidden\">
                                                    <input id=\"hidden_aa\" name=\"hidden_aa\" value=\"2018\" type=\"hidden\">
                                                    <input id=\"cur_aa\" name=\"cur_aa\" value=\"2018\" type=\"hidden\">
                                                    <input id=\"hidden_hh\" name=\"hidden_hh\" value=\"19\" type=\"hidden\">
                                                    <input id=\"cur_hh\" name=\"cur_hh\" value=\"19\" type=\"hidden\">
                                                    <input id=\"hidden_mn\" name=\"hidden_mn\" value=\"13\" type=\"hidden\">
                                                    <input id=\"cur_mn\" name=\"cur_mn\" value=\"13\" type=\"hidden\">

                                                    <p>
                                                        <a href=\"#edit_timestamp\" class=\"save-timestamp hide-if-no-js button\">OK</a>
                                                        <a href=\"#edit_timestamp\" class=\"cancel-timestamp hide-if-no-js button-cancel\">Cancel</a>
                                                    </p>
                                                </fieldset>
                                            </div>

                                        </div>
                                        <div class=\"clear\"></div>
                                    </div>

                                    <div id=\"major-publishing-actions\">
                                        <div id=\"publishing-action\">
                                            <span class=\"spinner\"></span>
                                            <input id=\"fc-save\" class=\"button button-primary button-large\" value=\"Save\" type=\"submit\">
                                        </div>
                                        <div class=\"clear\"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id=\"postbox-container-2\" class=\"postbox-container\">
                    <div id=\"normal-sortables\" class=\"meta-box-sortables ui-sortable\">
                        <div id=\"postexcerpt\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Excerpt</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Excerpt</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"excerpt\">Excerpt</label>
                                <textarea rows=\"1\" cols=\"40\" name=\"excerpt\" id=\"excerpt\"></textarea>
                                <p>Excerpts are optional hand-crafted summaries of your content that can be used in your theme.
                                    <a href=\"https://codex.wordpress.org/Excerpt\">Learn more about manual excerpts</a>.</p>
                            </div>
                        </div>
                        <div id=\"trackbacksdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Send Trackbacks</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Send Trackbacks</span>
                            </h2>
                            <div class=\"inside\">
                                <p>
                                    <label for=\"trackback_url\">Send trackbacks to:</label>
                                    <input name=\"trackback_url\" id=\"trackback_url\" class=\"code\" value=\"\" aria-describedby=\"trackback-url-desc\" type=\"text\">
                                </p>
                                <p id=\"trackback-url-desc\" class=\"howto\">Separate multiple URLs with spaces</p>
                                <p>Trackbacks are a way to notify legacy blog systems that you’ve linked to them. If you link
                                    other WordPress sites, they’ll be notified automatically using
                                    <a href=\"https://codex.wordpress.org/Introduction_to_Blogging#Managing_Comments\">pingbacks</a>, no other action necessary.</p>
                            </div>
                        </div>
                        <div id=\"postcustom\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Custom Fields</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Custom Fields</span>
                            </h2>
                            <div class=\"inside\">
                                <div id=\"postcustomstuff\">
                                    <div id=\"ajax-response\"></div>

                                    <table id=\"list-table\" style=\"display: none;\">
                                        <thead>
                                            <tr>
                                                <th class=\"left\">Name</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody id=\"the-list\" data-wp-lists=\"list:meta\">
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        <strong>Add New Custom Field:</strong>
                                    </p>
                                    <table id=\"newmeta\">
                                        <thead>
                                            <tr>
                                                <th class=\"left\">
                                                    <label for=\"metakeyinput\">Name</label>
                                                </th>
                                                <th>
                                                    <label for=\"metavalue\">Value</label>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td id=\"newmetaleft\" class=\"left\">
                                                    <input id=\"metakeyinput\" name=\"metakeyinput\" value=\"\" type=\"text\">
                                                </td>
                                                <td>
                                                    <textarea id=\"metavalue\" name=\"metavalue\" rows=\"2\" cols=\"25\"></textarea>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan=\"2\">
                                                    <div class=\"submit\">
                                                        <input name=\"addmeta\" id=\"newmeta-submit\" class=\"button\" value=\"Add Custom Field\" data-wp-lists=\"add:the-list:newmeta\" type=\"submit\">
                                                    </div>
                                                    <input id=\"_ajax_nonce-add-meta\" name=\"_ajax_nonce-add-meta\" value=\"4982dc3454\" type=\"hidden\">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p>Custom fields can be used to add extra metadata to a post that you can
                                    <a href=\"https://codex.wordpress.org/Using_Custom_Fields\">use in your theme</a>.</p>
                            </div>
                        </div>
                        <div id=\"commentstatusdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Discussion</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Discussion</span>
                            </h2>
                            <div class=\"inside\">
                                <input name=\"advanced_view\" value=\"1\" type=\"hidden\">
                                <p class=\"meta-options\">
                                    <label for=\"comment_status\" class=\"selectit\">
                                        <input name=\"comment_status\" id=\"comment_status\" value=\"open\" checked=\"checked\" type=\"checkbox\"> Allow comments</label>
                                    <br>
                                    <label for=\"ping_status\" class=\"selectit\">
                                        <input name=\"ping_status\" id=\"ping_status\" value=\"open\" checked=\"checked\" type=\"checkbox\"> Allow
                                        <a href=\"https://codex.wordpress.org/Introduction_to_Blogging#Managing_Comments\">trackbacks and pingbacks</a> on this page</label>
                                </p>
                            </div>
                        </div>
                        <div id=\"slugdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Slug</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Slug</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"post_name\">Slug</label>
                                <input name=\"post_name\" size=\"13\" id=\"post_name\" value=\"\" type=\"text\">
                            </div>
                        </div>
                        <div id=\"authordiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Author</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Author</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"post_author_override\">Author</label>
                                <select name=\"post_author_override\" id=\"post_author_override\" class=\"\">
                                    <option value=\"1\" selected=\"selected\">Test (Test)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id=\"advanced-sortables\" class=\"meta-box-sortables ui-sortable\"></div>
                </div>
            </div>
            <!-- /post-body -->
            <br class=\"clear\">
        </div>
        <!-- /poststuff -->
    </div>
</div>";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  414 => 48,  398 => 34,  393 => 30,  382 => 28,  378 => 27,  363 => 16,  359 => 14,  357 => 13,  343 => 2,  340 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"wrap\">
    <h1 class=\"wp-heading-inline\">{{(action ~ 'Title') | t}}</h1>

    <hr class=\"wp-header-end\">

    <div name=\"post\" method=\"post\">
        <div id=\"poststuff\">
            <div id=\"post-body\" class=\"metabox-holder columns-2\">
                <div id=\"post-body-content\" style=\"position: relative;\">

                    <div id=\"titlediv\">
                        <div id=\"titlewrap\">
                            {% if form is null %}
                                <label class=\"\" id=\"title-prompt-text\" for=\"title\">Enter title here</label>
                            {% endif %}
                            <input name=\"post_title\" size=\"30\" value=\"{{form.title}}\" id=\"fc-title\" spellcheck=\"true\" autocomplete=\"off\" type=\"text\">
                        </div>
                    </div>
                    <!-- /titlediv -->
                    <div id=\"postdivrich\" class=\"postarea wp-editor-expand\">

                        <div id=\"wp-content-wrap\" class=\"wp-core-ui wp-editor-wrap tmce-active has-dfw\" style=\"padding-top: 54px;\">
                            <link rel=\"stylesheet\" id=\"editor-buttons-css\" href=\"http://wp-playground.localhost/wp-includes/css/editor.min.css?ver=4.9.5\"
                                type=\"text/css\" media=\"all\">
                            <div id=\"wp-content-editor-tools\" class=\"wp-editor-tools hide-if-no-js\" style=\"position: absolute; top: 0px; width: 955px;\">
                                <div class=\"wp-editor-tabs\">
                                    {% for tab in tabs %}
                                        <button class=\"wp-switch-editor fc-tab\" data-tab=\"{{tab.name}}\">{{tab.name | t}}</button>
                                    {% endfor %}
                                </div>
                            </div>
                            <div id=\"fc-container\" class=\"wp-editor-container\">
                                {# Tab content goes here #}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /post-body-content -->

                <div id=\"postbox-container-1\" class=\"postbox-container\">
                    <div id=\"side-sortables\" class=\"meta-box-sortables ui-sortable\" style=\"\">
                        <div id=\"submitdiv\" class=\"postbox \">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Publish</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>{{'publish' | t}}</span>
                            </h2>
                            <div class=\"inside\">
                                <div class=\"submitbox\" id=\"submitpost\">

                                    <div id=\"minor-publishing\">

                                        <div id=\"misc-publishing-actions\">

                                            <div class=\"misc-pub-section misc-pub-post-status\">
                                                Status:
                                                <span id=\"post-status-display\">Draft</span>
                                                <a href=\"#post_status\" class=\"edit-post-status hide-if-no-js\" role=\"button\">
                                                    <span aria-hidden=\"true\">Edit</span>
                                                    <span class=\"screen-reader-text\">Edit status</span>
                                                </a>

                                                <div id=\"post-status-select\" class=\"hide-if-js\">
                                                    <input name=\"hidden_post_status\" id=\"hidden_post_status\" value=\"draft\" type=\"hidden\">
                                                    <label for=\"post_status\" class=\"screen-reader-text\">Set status</label>
                                                    <select name=\"post_status\" id=\"post_status\">
                                                        <option value=\"pending\">Pending Review</option>
                                                        <option selected=\"selected\" value=\"draft\">Draft</option>
                                                    </select>
                                                    <a href=\"#post_status\" class=\"save-post-status hide-if-no-js button\">OK</a>
                                                    <a href=\"#post_status\" class=\"cancel-post-status hide-if-no-js button-cancel\">Cancel</a>
                                                </div>

                                            </div>
                                            <div class=\"misc-pub-section curtime misc-pub-curtime\">
                                                <span id=\"timestamp\">
                                                    Publish
                                                    <b>immediately</b>
                                                </span>
                                                <a href=\"#edit_timestamp\" class=\"edit-timestamp hide-if-no-js\" role=\"button\">
                                                    <span aria-hidden=\"true\">Edit</span>
                                                    <span class=\"screen-reader-text\">Edit date and time</span>
                                                </a>
                                                <fieldset id=\"timestampdiv\" class=\"hide-if-js\">
                                                    <legend class=\"screen-reader-text\">Date and time</legend>
                                                    <div class=\"timestamp-wrap\">
                                                        <label>
                                                            <span class=\"screen-reader-text\">Month</span>
                                                            <select id=\"mm\" name=\"mm\">
                                                                <option value=\"01\" data-text=\"Jan\">01-Jan</option>
                                                                <option value=\"02\" data-text=\"Feb\">02-Feb</option>
                                                                <option value=\"03\" data-text=\"Mar\">03-Mar</option>
                                                                <option value=\"04\" data-text=\"Apr\" selected=\"selected\">04-Apr</option>
                                                                <option value=\"05\" data-text=\"May\">05-May</option>
                                                                <option value=\"06\" data-text=\"Jun\">06-Jun</option>
                                                                <option value=\"07\" data-text=\"Jul\">07-Jul</option>
                                                                <option value=\"08\" data-text=\"Aug\">08-Aug</option>
                                                                <option value=\"09\" data-text=\"Sep\">09-Sep</option>
                                                                <option value=\"10\" data-text=\"Oct\">10-Oct</option>
                                                                <option value=\"11\" data-text=\"Nov\">11-Nov</option>
                                                                <option value=\"12\" data-text=\"Dec\">12-Dec</option>
                                                            </select>
                                                        </label>
                                                        <label>
                                                            <span class=\"screen-reader-text\">Day</span>
                                                            <input id=\"jj\" name=\"jj\" value=\"24\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>,
                                                        <label>
                                                            <span class=\"screen-reader-text\">Year</span>
                                                            <input id=\"aa\" name=\"aa\" value=\"2018\" size=\"4\" maxlength=\"4\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label> @
                                                        <label>
                                                            <span class=\"screen-reader-text\">Hour</span>
                                                            <input id=\"hh\" name=\"hh\" value=\"19\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>:
                                                        <label>
                                                            <span class=\"screen-reader-text\">Minute</span>
                                                            <input id=\"mn\" name=\"mn\" value=\"13\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>
                                                    </div>
                                                    <input id=\"ss\" name=\"ss\" value=\"01\" type=\"hidden\">

                                                    <input id=\"hidden_mm\" name=\"hidden_mm\" value=\"04\" type=\"hidden\">
                                                    <input id=\"cur_mm\" name=\"cur_mm\" value=\"04\" type=\"hidden\">
                                                    <input id=\"hidden_jj\" name=\"hidden_jj\" value=\"24\" type=\"hidden\">
                                                    <input id=\"cur_jj\" name=\"cur_jj\" value=\"24\" type=\"hidden\">
                                                    <input id=\"hidden_aa\" name=\"hidden_aa\" value=\"2018\" type=\"hidden\">
                                                    <input id=\"cur_aa\" name=\"cur_aa\" value=\"2018\" type=\"hidden\">
                                                    <input id=\"hidden_hh\" name=\"hidden_hh\" value=\"19\" type=\"hidden\">
                                                    <input id=\"cur_hh\" name=\"cur_hh\" value=\"19\" type=\"hidden\">
                                                    <input id=\"hidden_mn\" name=\"hidden_mn\" value=\"13\" type=\"hidden\">
                                                    <input id=\"cur_mn\" name=\"cur_mn\" value=\"13\" type=\"hidden\">

                                                    <p>
                                                        <a href=\"#edit_timestamp\" class=\"save-timestamp hide-if-no-js button\">OK</a>
                                                        <a href=\"#edit_timestamp\" class=\"cancel-timestamp hide-if-no-js button-cancel\">Cancel</a>
                                                    </p>
                                                </fieldset>
                                            </div>

                                        </div>
                                        <div class=\"clear\"></div>
                                    </div>

                                    <div id=\"major-publishing-actions\">
                                        <div id=\"publishing-action\">
                                            <span class=\"spinner\"></span>
                                            <input id=\"fc-save\" class=\"button button-primary button-large\" value=\"Save\" type=\"submit\">
                                        </div>
                                        <div class=\"clear\"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id=\"postbox-container-2\" class=\"postbox-container\">
                    <div id=\"normal-sortables\" class=\"meta-box-sortables ui-sortable\">
                        <div id=\"postexcerpt\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Excerpt</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Excerpt</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"excerpt\">Excerpt</label>
                                <textarea rows=\"1\" cols=\"40\" name=\"excerpt\" id=\"excerpt\"></textarea>
                                <p>Excerpts are optional hand-crafted summaries of your content that can be used in your theme.
                                    <a href=\"https://codex.wordpress.org/Excerpt\">Learn more about manual excerpts</a>.</p>
                            </div>
                        </div>
                        <div id=\"trackbacksdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Send Trackbacks</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Send Trackbacks</span>
                            </h2>
                            <div class=\"inside\">
                                <p>
                                    <label for=\"trackback_url\">Send trackbacks to:</label>
                                    <input name=\"trackback_url\" id=\"trackback_url\" class=\"code\" value=\"\" aria-describedby=\"trackback-url-desc\" type=\"text\">
                                </p>
                                <p id=\"trackback-url-desc\" class=\"howto\">Separate multiple URLs with spaces</p>
                                <p>Trackbacks are a way to notify legacy blog systems that you’ve linked to them. If you link
                                    other WordPress sites, they’ll be notified automatically using
                                    <a href=\"https://codex.wordpress.org/Introduction_to_Blogging#Managing_Comments\">pingbacks</a>, no other action necessary.</p>
                            </div>
                        </div>
                        <div id=\"postcustom\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Custom Fields</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Custom Fields</span>
                            </h2>
                            <div class=\"inside\">
                                <div id=\"postcustomstuff\">
                                    <div id=\"ajax-response\"></div>

                                    <table id=\"list-table\" style=\"display: none;\">
                                        <thead>
                                            <tr>
                                                <th class=\"left\">Name</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody id=\"the-list\" data-wp-lists=\"list:meta\">
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        <strong>Add New Custom Field:</strong>
                                    </p>
                                    <table id=\"newmeta\">
                                        <thead>
                                            <tr>
                                                <th class=\"left\">
                                                    <label for=\"metakeyinput\">Name</label>
                                                </th>
                                                <th>
                                                    <label for=\"metavalue\">Value</label>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td id=\"newmetaleft\" class=\"left\">
                                                    <input id=\"metakeyinput\" name=\"metakeyinput\" value=\"\" type=\"text\">
                                                </td>
                                                <td>
                                                    <textarea id=\"metavalue\" name=\"metavalue\" rows=\"2\" cols=\"25\"></textarea>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan=\"2\">
                                                    <div class=\"submit\">
                                                        <input name=\"addmeta\" id=\"newmeta-submit\" class=\"button\" value=\"Add Custom Field\" data-wp-lists=\"add:the-list:newmeta\" type=\"submit\">
                                                    </div>
                                                    <input id=\"_ajax_nonce-add-meta\" name=\"_ajax_nonce-add-meta\" value=\"4982dc3454\" type=\"hidden\">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p>Custom fields can be used to add extra metadata to a post that you can
                                    <a href=\"https://codex.wordpress.org/Using_Custom_Fields\">use in your theme</a>.</p>
                            </div>
                        </div>
                        <div id=\"commentstatusdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Discussion</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Discussion</span>
                            </h2>
                            <div class=\"inside\">
                                <input name=\"advanced_view\" value=\"1\" type=\"hidden\">
                                <p class=\"meta-options\">
                                    <label for=\"comment_status\" class=\"selectit\">
                                        <input name=\"comment_status\" id=\"comment_status\" value=\"open\" checked=\"checked\" type=\"checkbox\"> Allow comments</label>
                                    <br>
                                    <label for=\"ping_status\" class=\"selectit\">
                                        <input name=\"ping_status\" id=\"ping_status\" value=\"open\" checked=\"checked\" type=\"checkbox\"> Allow
                                        <a href=\"https://codex.wordpress.org/Introduction_to_Blogging#Managing_Comments\">trackbacks and pingbacks</a> on this page</label>
                                </p>
                            </div>
                        </div>
                        <div id=\"slugdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Slug</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Slug</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"post_name\">Slug</label>
                                <input name=\"post_name\" size=\"13\" id=\"post_name\" value=\"\" type=\"text\">
                            </div>
                        </div>
                        <div id=\"authordiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Author</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Author</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"post_author_override\">Author</label>
                                <select name=\"post_author_override\" id=\"post_author_override\" class=\"\">
                                    <option value=\"1\" selected=\"selected\">Test (Test)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id=\"advanced-sortables\" class=\"meta-box-sortables ui-sortable\"></div>
                </div>
            </div>
            <!-- /post-body -->
            <br class=\"clear\">
        </div>
        <!-- /poststuff -->
    </div>
</div>", "<div class=\"wrap\">
    <h1 class=\"wp-heading-inline\">{{(action ~ 'Title') | t}}</h1>

    <hr class=\"wp-header-end\">

    <div name=\"post\" method=\"post\">
        <div id=\"poststuff\">
            <div id=\"post-body\" class=\"metabox-holder columns-2\">
                <div id=\"post-body-content\" style=\"position: relative;\">

                    <div id=\"titlediv\">
                        <div id=\"titlewrap\">
                            {% if form is null %}
                                <label class=\"\" id=\"title-prompt-text\" for=\"title\">Enter title here</label>
                            {% endif %}
                            <input name=\"post_title\" size=\"30\" value=\"{{form.title}}\" id=\"fc-title\" spellcheck=\"true\" autocomplete=\"off\" type=\"text\">
                        </div>
                    </div>
                    <!-- /titlediv -->
                    <div id=\"postdivrich\" class=\"postarea wp-editor-expand\">

                        <div id=\"wp-content-wrap\" class=\"wp-core-ui wp-editor-wrap tmce-active has-dfw\" style=\"padding-top: 54px;\">
                            <link rel=\"stylesheet\" id=\"editor-buttons-css\" href=\"http://wp-playground.localhost/wp-includes/css/editor.min.css?ver=4.9.5\"
                                type=\"text/css\" media=\"all\">
                            <div id=\"wp-content-editor-tools\" class=\"wp-editor-tools hide-if-no-js\" style=\"position: absolute; top: 0px; width: 955px;\">
                                <div class=\"wp-editor-tabs\">
                                    {% for tab in tabs %}
                                        <button class=\"wp-switch-editor fc-tab\" data-tab=\"{{tab.name}}\">{{tab.name | t}}</button>
                                    {% endfor %}
                                </div>
                            </div>
                            <div id=\"fc-container\" class=\"wp-editor-container\">
                                {# Tab content goes here #}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /post-body-content -->

                <div id=\"postbox-container-1\" class=\"postbox-container\">
                    <div id=\"side-sortables\" class=\"meta-box-sortables ui-sortable\" style=\"\">
                        <div id=\"submitdiv\" class=\"postbox \">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Publish</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>{{'publish' | t}}</span>
                            </h2>
                            <div class=\"inside\">
                                <div class=\"submitbox\" id=\"submitpost\">

                                    <div id=\"minor-publishing\">

                                        <div id=\"misc-publishing-actions\">

                                            <div class=\"misc-pub-section misc-pub-post-status\">
                                                Status:
                                                <span id=\"post-status-display\">Draft</span>
                                                <a href=\"#post_status\" class=\"edit-post-status hide-if-no-js\" role=\"button\">
                                                    <span aria-hidden=\"true\">Edit</span>
                                                    <span class=\"screen-reader-text\">Edit status</span>
                                                </a>

                                                <div id=\"post-status-select\" class=\"hide-if-js\">
                                                    <input name=\"hidden_post_status\" id=\"hidden_post_status\" value=\"draft\" type=\"hidden\">
                                                    <label for=\"post_status\" class=\"screen-reader-text\">Set status</label>
                                                    <select name=\"post_status\" id=\"post_status\">
                                                        <option value=\"pending\">Pending Review</option>
                                                        <option selected=\"selected\" value=\"draft\">Draft</option>
                                                    </select>
                                                    <a href=\"#post_status\" class=\"save-post-status hide-if-no-js button\">OK</a>
                                                    <a href=\"#post_status\" class=\"cancel-post-status hide-if-no-js button-cancel\">Cancel</a>
                                                </div>

                                            </div>
                                            <div class=\"misc-pub-section curtime misc-pub-curtime\">
                                                <span id=\"timestamp\">
                                                    Publish
                                                    <b>immediately</b>
                                                </span>
                                                <a href=\"#edit_timestamp\" class=\"edit-timestamp hide-if-no-js\" role=\"button\">
                                                    <span aria-hidden=\"true\">Edit</span>
                                                    <span class=\"screen-reader-text\">Edit date and time</span>
                                                </a>
                                                <fieldset id=\"timestampdiv\" class=\"hide-if-js\">
                                                    <legend class=\"screen-reader-text\">Date and time</legend>
                                                    <div class=\"timestamp-wrap\">
                                                        <label>
                                                            <span class=\"screen-reader-text\">Month</span>
                                                            <select id=\"mm\" name=\"mm\">
                                                                <option value=\"01\" data-text=\"Jan\">01-Jan</option>
                                                                <option value=\"02\" data-text=\"Feb\">02-Feb</option>
                                                                <option value=\"03\" data-text=\"Mar\">03-Mar</option>
                                                                <option value=\"04\" data-text=\"Apr\" selected=\"selected\">04-Apr</option>
                                                                <option value=\"05\" data-text=\"May\">05-May</option>
                                                                <option value=\"06\" data-text=\"Jun\">06-Jun</option>
                                                                <option value=\"07\" data-text=\"Jul\">07-Jul</option>
                                                                <option value=\"08\" data-text=\"Aug\">08-Aug</option>
                                                                <option value=\"09\" data-text=\"Sep\">09-Sep</option>
                                                                <option value=\"10\" data-text=\"Oct\">10-Oct</option>
                                                                <option value=\"11\" data-text=\"Nov\">11-Nov</option>
                                                                <option value=\"12\" data-text=\"Dec\">12-Dec</option>
                                                            </select>
                                                        </label>
                                                        <label>
                                                            <span class=\"screen-reader-text\">Day</span>
                                                            <input id=\"jj\" name=\"jj\" value=\"24\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>,
                                                        <label>
                                                            <span class=\"screen-reader-text\">Year</span>
                                                            <input id=\"aa\" name=\"aa\" value=\"2018\" size=\"4\" maxlength=\"4\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label> @
                                                        <label>
                                                            <span class=\"screen-reader-text\">Hour</span>
                                                            <input id=\"hh\" name=\"hh\" value=\"19\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>:
                                                        <label>
                                                            <span class=\"screen-reader-text\">Minute</span>
                                                            <input id=\"mn\" name=\"mn\" value=\"13\" size=\"2\" maxlength=\"2\"
                                                                autocomplete=\"off\" type=\"text\">
                                                        </label>
                                                    </div>
                                                    <input id=\"ss\" name=\"ss\" value=\"01\" type=\"hidden\">

                                                    <input id=\"hidden_mm\" name=\"hidden_mm\" value=\"04\" type=\"hidden\">
                                                    <input id=\"cur_mm\" name=\"cur_mm\" value=\"04\" type=\"hidden\">
                                                    <input id=\"hidden_jj\" name=\"hidden_jj\" value=\"24\" type=\"hidden\">
                                                    <input id=\"cur_jj\" name=\"cur_jj\" value=\"24\" type=\"hidden\">
                                                    <input id=\"hidden_aa\" name=\"hidden_aa\" value=\"2018\" type=\"hidden\">
                                                    <input id=\"cur_aa\" name=\"cur_aa\" value=\"2018\" type=\"hidden\">
                                                    <input id=\"hidden_hh\" name=\"hidden_hh\" value=\"19\" type=\"hidden\">
                                                    <input id=\"cur_hh\" name=\"cur_hh\" value=\"19\" type=\"hidden\">
                                                    <input id=\"hidden_mn\" name=\"hidden_mn\" value=\"13\" type=\"hidden\">
                                                    <input id=\"cur_mn\" name=\"cur_mn\" value=\"13\" type=\"hidden\">

                                                    <p>
                                                        <a href=\"#edit_timestamp\" class=\"save-timestamp hide-if-no-js button\">OK</a>
                                                        <a href=\"#edit_timestamp\" class=\"cancel-timestamp hide-if-no-js button-cancel\">Cancel</a>
                                                    </p>
                                                </fieldset>
                                            </div>

                                        </div>
                                        <div class=\"clear\"></div>
                                    </div>

                                    <div id=\"major-publishing-actions\">
                                        <div id=\"publishing-action\">
                                            <span class=\"spinner\"></span>
                                            <input id=\"fc-save\" class=\"button button-primary button-large\" value=\"Save\" type=\"submit\">
                                        </div>
                                        <div class=\"clear\"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id=\"postbox-container-2\" class=\"postbox-container\">
                    <div id=\"normal-sortables\" class=\"meta-box-sortables ui-sortable\">
                        <div id=\"postexcerpt\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Excerpt</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Excerpt</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"excerpt\">Excerpt</label>
                                <textarea rows=\"1\" cols=\"40\" name=\"excerpt\" id=\"excerpt\"></textarea>
                                <p>Excerpts are optional hand-crafted summaries of your content that can be used in your theme.
                                    <a href=\"https://codex.wordpress.org/Excerpt\">Learn more about manual excerpts</a>.</p>
                            </div>
                        </div>
                        <div id=\"trackbacksdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Send Trackbacks</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Send Trackbacks</span>
                            </h2>
                            <div class=\"inside\">
                                <p>
                                    <label for=\"trackback_url\">Send trackbacks to:</label>
                                    <input name=\"trackback_url\" id=\"trackback_url\" class=\"code\" value=\"\" aria-describedby=\"trackback-url-desc\" type=\"text\">
                                </p>
                                <p id=\"trackback-url-desc\" class=\"howto\">Separate multiple URLs with spaces</p>
                                <p>Trackbacks are a way to notify legacy blog systems that you’ve linked to them. If you link
                                    other WordPress sites, they’ll be notified automatically using
                                    <a href=\"https://codex.wordpress.org/Introduction_to_Blogging#Managing_Comments\">pingbacks</a>, no other action necessary.</p>
                            </div>
                        </div>
                        <div id=\"postcustom\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Custom Fields</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Custom Fields</span>
                            </h2>
                            <div class=\"inside\">
                                <div id=\"postcustomstuff\">
                                    <div id=\"ajax-response\"></div>

                                    <table id=\"list-table\" style=\"display: none;\">
                                        <thead>
                                            <tr>
                                                <th class=\"left\">Name</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody id=\"the-list\" data-wp-lists=\"list:meta\">
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        <strong>Add New Custom Field:</strong>
                                    </p>
                                    <table id=\"newmeta\">
                                        <thead>
                                            <tr>
                                                <th class=\"left\">
                                                    <label for=\"metakeyinput\">Name</label>
                                                </th>
                                                <th>
                                                    <label for=\"metavalue\">Value</label>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td id=\"newmetaleft\" class=\"left\">
                                                    <input id=\"metakeyinput\" name=\"metakeyinput\" value=\"\" type=\"text\">
                                                </td>
                                                <td>
                                                    <textarea id=\"metavalue\" name=\"metavalue\" rows=\"2\" cols=\"25\"></textarea>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan=\"2\">
                                                    <div class=\"submit\">
                                                        <input name=\"addmeta\" id=\"newmeta-submit\" class=\"button\" value=\"Add Custom Field\" data-wp-lists=\"add:the-list:newmeta\" type=\"submit\">
                                                    </div>
                                                    <input id=\"_ajax_nonce-add-meta\" name=\"_ajax_nonce-add-meta\" value=\"4982dc3454\" type=\"hidden\">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p>Custom fields can be used to add extra metadata to a post that you can
                                    <a href=\"https://codex.wordpress.org/Using_Custom_Fields\">use in your theme</a>.</p>
                            </div>
                        </div>
                        <div id=\"commentstatusdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Discussion</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Discussion</span>
                            </h2>
                            <div class=\"inside\">
                                <input name=\"advanced_view\" value=\"1\" type=\"hidden\">
                                <p class=\"meta-options\">
                                    <label for=\"comment_status\" class=\"selectit\">
                                        <input name=\"comment_status\" id=\"comment_status\" value=\"open\" checked=\"checked\" type=\"checkbox\"> Allow comments</label>
                                    <br>
                                    <label for=\"ping_status\" class=\"selectit\">
                                        <input name=\"ping_status\" id=\"ping_status\" value=\"open\" checked=\"checked\" type=\"checkbox\"> Allow
                                        <a href=\"https://codex.wordpress.org/Introduction_to_Blogging#Managing_Comments\">trackbacks and pingbacks</a> on this page</label>
                                </p>
                            </div>
                        </div>
                        <div id=\"slugdiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Slug</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Slug</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"post_name\">Slug</label>
                                <input name=\"post_name\" size=\"13\" id=\"post_name\" value=\"\" type=\"text\">
                            </div>
                        </div>
                        <div id=\"authordiv\" class=\"postbox  hide-if-js\" style=\"\">
                            <button type=\"button\" class=\"handlediv\" aria-expanded=\"true\">
                                <span class=\"screen-reader-text\">Toggle panel: Author</span>
                                <span class=\"toggle-indicator\" aria-hidden=\"true\"></span>
                            </button>
                            <h2 class=\"hndle ui-sortable-handle\">
                                <span>Author</span>
                            </h2>
                            <div class=\"inside\">
                                <label class=\"screen-reader-text\" for=\"post_author_override\">Author</label>
                                <select name=\"post_author_override\" id=\"post_author_override\" class=\"\">
                                    <option value=\"1\" selected=\"selected\">Test (Test)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id=\"advanced-sortables\" class=\"meta-box-sortables ui-sortable\"></div>
                </div>
            </div>
            <!-- /post-body -->
            <br class=\"clear\">
        </div>
        <!-- /poststuff -->
    </div>
</div>", "");
    }
}
