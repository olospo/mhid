<?php
/**
 * Opportunities Filters Include
 * Displays dropdown filters for opportunity-topic and opportunity-age
 * Intended for archive-opportunity.php (and tax pages if you reuse it)
 */

// Detect if we're currently on a taxonomy archive
$current_term = get_queried_object();
$current_topic = ( isset($current_term->taxonomy) && $current_term->taxonomy === 'opportunity-topic' ) ? $current_term->slug : '';
$current_age   = ( isset($current_term->taxonomy) && $current_term->taxonomy === 'opportunity-age' ) ? $current_term->slug : '';

// Get selected filters from query string (override if set)
$selected_topic = ! empty($_GET['opportunity-topic']) ? sanitize_text_field($_GET['opportunity-topic']) : $current_topic;
$selected_age   = ! empty($_GET['opportunity-age'])   ? sanitize_text_field($_GET['opportunity-age'])   : $current_age;
?>

<form method="get" class="opportunity-filters">
  <div class="filter-group topic">
    <label for="opportunity-topic">Filter by <span>Topic</span></label>
    <select name="opportunity-topic" id="opportunity-topic">
      <option value="">All Topics</option>
      <?php
      $topics = get_terms([
        'taxonomy'   => 'opportunity-topic',
        'hide_empty' => true,
      ]);

      if ( ! is_wp_error($topics) ) {
        foreach ($topics as $topic) {
          $selected = ($selected_topic === $topic->slug) ? 'selected' : '';
          echo '<option value="' . esc_attr($topic->slug) . '" ' . $selected . '>' . esc_html($topic->name) . '</option>';
        }
      }
      ?>
    </select>
  </div>

  <div class="filter-group age">
    <label for="opportunity-age"><span>Age Group</span></label>
    <select name="opportunity-age" id="opportunity-age">
      <option value="">All Age Groups</option>
      <?php
      $ages = get_terms([
        'taxonomy'   => 'opportunity-age',
        'hide_empty' => true,
      ]);

      if ( ! is_wp_error($ages) ) {
        foreach ($ages as $age) {
          $selected = ($selected_age === $age->slug) ? 'selected' : '';
          echo '<option value="' . esc_attr($age->slug) . '" ' . $selected . '>' . esc_html($age->name) . '</option>';
        }
      }
      ?>
    </select>
  </div>

  <?php if ($selected_topic || $selected_age) : ?>
    <a href="<?php echo esc_url(get_post_type_archive_link('opportunity')); ?>" class="reset">Reset</a>
  <?php endif; ?>
</form>

<script>
  // Auto-submit filters on change
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.opportunity-filters');
    if (!form) return;
    form.querySelectorAll('select').forEach(select => {
      select.addEventListener('change', () => form.submit());
    });
  });
</script>
