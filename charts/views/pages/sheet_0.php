<?php require_once BASEPATH . '/views/includes/header.php'; ?>
<?php require_once BASEPATH . '/views/includes/navbar.php'; ?>

<div class="table-name">
    <h5><?= $params['sheet']['sheet_name'] ?></h5>
</div>

<div class="filter-buttons float-left">
    <button type="button" class="btn btn-outline-secondary float-left" id="toggle_filter_0" title="Filters" data-column="filters">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
             viewBox="0 0 16 16">
            <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
        </svg>
    </button>

    <button type="button" class="btn btn-outline-secondary" id="reset_filter_0" title="Filters" data-column="filters">
        <span class="btn-text">Clear</span>
    </button>
</div>


<div class="table-block float-left">

  <table class="display nowrap table table-striped table-hover table_filtered" id="table_0">

    <thead>
    <tr class="header-row">
      <th></th>
      <?php foreach ($params['sheet']['header_row'] as $cell): ?>
        <?php if ($cell === 'Card 1' || $cell === 'Suit 1' ||
          $cell === 'Card 2' || $cell === 'Suit 2' ||
          $cell === 'Card 3' || $cell === 'Suit 3' ||
          $cell === 'Card Value 1' || $cell === 'Card Value 2' || $cell === 'Card Value 3'
        ) {
          continue;
        } ?>
        <th class="header-cell align-top text-center">
          <?= $cell ?>
        </th>
      <?php endforeach; ?>
    </tr>
    </thead>

    <tbody>

    <?php foreach ($params['sheet']['rows'] as $i => $row): ?>
      <tr>
        <td></td>
        <?php foreach ($row as $c => $cell): ?>
          <?php
          if ($c === 1 || $c === 2 || $c === 3 || $c === 4 || $c === 5 || $c === 6 || $c === 8 || $c === 9 || $c === 10) {
            continue;
          }
          ?>
          <td class="cell<?= $c === 0 ? ' header-cell' : '' ?>">
            <?= $cell ?>
          </td>
        <?php endforeach ?>
      </tr>
    <?php endforeach ?>
    </tbody>

  </table>
</div>

<?php require_once BASEPATH . '/views/includes/footer.php'; ?>
