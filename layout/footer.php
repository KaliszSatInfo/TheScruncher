<footer class="mt-auto py-3">
  <div class="container text-center">
    <?php if ($total_pages > 1): ?>
      <nav class="d-inline-flex flex-wrap justify-content-center">
        <?php
        function page_button($label, $target, $enabled = true, $is_current = false) {
          $class = $is_current ? 'btn-dark' : 'btn-outline-secondary';
          $disabled = !$enabled ? ' disabled' : '';
          if ($enabled) {
            echo "<a class='btn $class mx-1' href='?page=$target'>$label</a>";
          } else {
            echo "<span class='btn $class mx-1$disabled'>$label</span>";
          }
        }

        page_button('«', 1, $current_page > 1);
        page_button('‹', $current_page - 1, $current_page > 1);

        $start = max(1, $current_page - 3);
        $end = min($total_pages, $current_page + 3);
        for ($i = $start; $i <= $end; $i++) {
          page_button($i, $i, true, $i == $current_page);
        }

        page_button('›', $current_page + 1, $current_page < $total_pages);
        page_button('»', $total_pages, $current_page < $total_pages);
        ?>
      </nav>
    <?php endif; ?>
  </div>
</footer>
</body>
</html>