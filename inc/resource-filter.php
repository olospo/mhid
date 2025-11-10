<?php
/**
 * Resource Filters Include
 * Displays dropdown filters for resource-category and resource-type
 * Works on archive-resource.php and taxonomy-resource-category/type.php
 */

// Detect if we're currently on a taxonomy archive
$current_term = get_queried_object();
$current_cat  = ( isset( $current_term->taxonomy ) && $current_term->taxonomy === 'resource-category' ) ? $current_term->slug : '';
$current_type = ( isset( $current_term->taxonomy ) && $current_term->taxonomy === 'resource-type' ) ? $current_term->slug : '';

// Get selected filters from query string (override if set)
$selected_cat  = ! empty( $_GET['resource-category'] ) ? sanitize_text_field( $_GET['resource-category'] ) : $current_cat;
$selected_type = ! empty( $_GET['resource-type'] ) ? sanitize_text_field( $_GET['resource-type'] ) : $current_type;
?>

<form method="get" class="resource-filters">
  <div class="filter-group cat">
    <label for="resource-category">Filter by <span>Category</span></label>
    <select name="resource-category" id="resource-category">
      <option value="">All Categories</option>
      <?php
      $categories = get_terms( array(
        'taxonomy'   => 'resource-category',
        'hide_empty' => true,
      ) );
      foreach ( $categories as $cat ) :
        $selected = ( $selected_cat === $cat->slug ) ? 'selected' : '';
        echo '<option value="' . esc_attr( $cat->slug ) . '" ' . $selected . '>' . esc_html( $cat->name ) . '</option>';
      endforeach;
      ?>
    </select>
  </div>

  <div class="filter-group type">
    <label for="resource-type">Filter by <span>Resource Type</span></label>
    <select name="resource-type" id="resource-type">
      <option value="">All Types</option>
      <?php
      $types = get_terms( array(
        'taxonomy'   => 'resource-type',
        'hide_empty' => true,
      ) );
      foreach ( $types as $type ) :
        $selected = ( $selected_type === $type->slug ) ? 'selected' : '';
        echo '<option value="' . esc_attr( $type->slug ) . '" ' . $selected . '>' . esc_html( $type->name ) . '</option>';
      endforeach;
      ?>
    </select>
  </div>

  <?php
  // Only show reset link if any filter is active
  if ( $selected_cat || $selected_type ) : ?>
    <a href="<?php echo esc_url( get_post_type_archive_link( 'resource' ) ); ?>" class="reset">Reset</a>
  <?php endif; ?>
</form>

<script>
  // Auto-submit filters on change
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.resource-filters');
    if (!form) return;
    const selects = form.querySelectorAll('select');
    selects.forEach(select => {
      select.addEventListener('change', function() {
        form.submit();
      });
    });
  });
</script>