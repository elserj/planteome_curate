<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>

<?php //echo'<pre>';print_r($title);exit; ?>

<div id="taxon-page">
    <div class="row">
      <div class="col-md-6 col-sm-6 taxonomy-left-sec">
        <h2>Taxonomy: <?php echo $node->title; ?></h2>
        <!-- <div><a href=""><h3>Edit Annotation<h3></a></div> -->
        <div class="col-md-12 col-sm-12 pdng-none">
          <div class="box">
            <span>RANK</span>
            <h3 id="taxon_rank"><?php if(isset($node->field_taxon_rank['und'][0]['taxonomy_term']->name)){ echo ucfirst($node->field_taxon_rank['und'][0]['taxonomy_term']->name)/*.' '.$node->title)*/;} else{ echo "NA"; } ?><!-- Species (50 chars) Arabidopsis Thaliana (50 chars) --></h3>
          </div>
          <div class="box">
            <span>RELATED SYNONYMS:</span>
            <p><?php if(!empty(return_related_synonyms($node))){ echo return_related_synonyms($node);} else{ echo "NA"; } ?><!-- Arabidopsis thaliana (thale cress)  |. Arabidopsis_thaliana. | <br>Arbisopsis thaliana (&#60;50 x 6 (estimated) synonyms) --></p>
          </div>
          <div class="box">
            <span>EXACT SYNONYMS:</span>
            <p><?php if(!empty(return_exact_synonyms($node))){ echo return_exact_synonyms($node);} else{ echo "NA"; } ?><!-- Mouse-ear cress. |. thale cress. |. hale-cress (&#60;50 x 6 (estimated) synonyms)  --></p>
          </div>
          <div class="box">
            <span>NCBI ID:</span>
            <p><?php if(!empty(return_ncbi_number_link($node))){ echo return_ncbi_number_link($node);} else{ echo "NA"; } ?><!-- 3702 (&#60;50) --></p>
          </div>
          <div class="box">
              <span>ASSOCIATED GENES: </span>
              <?php echo return_gene_counts($node); ?>
          </div>
          <!-- <p>Total - 27820</p>
          <p>Protein Coding - 7020</p>
          <p> Micro RNA - 800</p>
          <p>Transfer RNA - 13000</p>
          <p>Non-Translating Coding Sequence - 7000</p> -->
        </div>
      </div>

      <div class="col-md-6 col-sm-6 taxonomy-right-sec">
        <div class="col-md-12 col-sm-12 pdng-none">
          <h2>Taxonomy Tree</h2>
          <div id="taxonpage_listtree">
          <!-- <div id="frontpage_listtree" class="listree"> -->
              <?php print_taxon_html_tree_string(); ?>
          </div>
          <!-- <p>root - 102824 genes</p>
          <p>cellular organisms - 102824 genes</p>
          <p>Bacteria</p> -->
        </div>
        <div class="col-md-12 col-sm-12 pdng-none">
          <div class="right-content-border" style="color: #727272;">
            <p>TRENDING</p>
            <h3>Most Recent Curated Genes</h3>
          <!--   <ol>
              <li>Search Term</li>
              <li>Search Term</li>
              <li>Search Term</li>
              <li>Search Term</li>
              <li>Search Term</li>
              <p>...More</p>
            </ol> -->
            <?php print views_embed_view('list_of_genes','block', $node->nid); ?>
          </div>
        </div>
      </div>
    </div>
    <?php print render($content['links']); ?>

<?php print render($content['comments']); ?>
</div>

