<style>
  .page-item {
    margin-right: 10px;
  }
  .page-item.active .page-link {
    background-color: #0655FF !important;
  }
  div .small.text-muted {
    display: none;
  }
</style>

<nav aria-label="Page navigation example">
  <ul class="pagination common-pagination">
    {{ $paginator->withQueryString()->links() }}
  </ul>
</nav>