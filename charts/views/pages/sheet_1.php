<?php require_once BASEPATH . '/views/includes/header.php'; ?>
<?php require_once BASEPATH . '/views/includes/navbar.php'; ?>

<div class="">
  <div class="row ">
    <div class="col">
      <div class="card card-sheet-name">
        <div class="card-body">
          <h5><?= $params['tables']['table1']['table_name'] ?></h5>
        </div>
      </div>
    </div>
  </div>

  <div class="filter-buttons ">
    <button type="button" class="btn btn-grey btn-outline-secondary float-left" id="toggle_filter_1" title="Filters" data-column="filters">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
           viewBox="0 0 16 16">
        <path
          d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
      </svg>
    </button>

    <button type="button" class="btn btn-grey btn-outline-secondary" id="reset_filter_1" title="Filters" data-column="filters">
      <span class="btn-text">Clear</span>
    </button>
  </div>

  <div class="table-block tables_1_table_block"  style="max-width: 1700px">
    <table id="table_1" class="display nowrap table table-striped table-hover" style="width: 100%">
      <thead>
      <tr class="header-row">
        <?php foreach ($params['tables']['table1']['header_row'] as $cell): ?>
          <th class="header-cell text-center"><?= $cell ?></th>
        <?php endforeach ?>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($params['tables']['table1']['rows'] as $i => $row): ?>
        <tr class="">
          <?php $j = 0; ?>
          <?php foreach ($row as $colValue): ?>
            <td class="cell <?= $j === 0 ? 'header-cell' : '' ?>"><?= $colValue ?></td>
            <?php $j++; ?>
          <?php endforeach ?>
        </tr>
      <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>


<div class="">
  <div class="row ">
    <div class="col">
      <div class="card card-sheet-name">
        <div class="card-body">
          <h5><?= $params['tables']['table2']['table_name'] ?></h5>
        </div>
      </div>
    </div>
  </div>

  <div class="filter-buttons ">
    <button type="button" class="btn btn-grey btn-outline-secondary float-left" id="toggle_filter_2" title="Filters" data-column="filters">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
           viewBox="0 0 16 16">
        <path
          d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
      </svg>
    </button>

    <button type="button" class="btn btn-grey btn-outline-secondary" id="reset_filter_2" title="Filters" data-column="filters">
      <span class="btn-text">Clear</span>
    </button>
  </div>

  <div class="table-block tables_1_table_block"  style="max-width: 1700px">
    <table id="table_2" class="display nowrap table table-striped table-hover" style="width: 100%">
      <thead>
      <tr>
        <?php foreach ($params['tables']['table2']['header_row'] as $cell): ?>
          <th class="header-cell text-center"><?= $cell ?></th>
        <?php endforeach ?>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($params['tables']['table2']['rows'] as $i => $row): ?>
        <tr class="">
          <?php $j = 0; ?>
          <?php foreach ($row as $colValue): ?>
            <td class="cell <?= $j === 0 ? 'header-cell' : '' ?>">
              <?= $colValue ?>
            </td>
            <?php $j++; ?>
          <?php endforeach ?>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>


<div class="">
  <div class="row ">
    <div class="col">
      <div class="card card-sheet-name">
        <div class="card-body">
          <h5><?= $params['tables']['table3']['table_name'] ?></h5>
        </div>
      </div>
    </div>
  </div>

  <div class="filter-buttons ">
    <button type="button" class="btn btn-grey btn-outline-secondary float-left" id="toggle_filter_3" title="Filters" data-column="filters">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
           viewBox="0 0 16 16">
        <path
          d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
      </svg>
    </button>

    <button type="button" class="btn btn-grey btn-outline-secondary" id="reset_filter_3" title="Filters" data-column="filters">
      <span class="btn-text">Clear</span>
    </button>
  </div>

  <div class="table-block tables_1_table_block"  style="max-width: 1700px">
    <table id="table_3" class="display nowrap table table-striped table-hover" style="width: 100%">
      <thead>
      <tr>
        <?php foreach ($params['tables']['table3']['header_row'] as $cell): ?>
          <th class="header-cell text-center"><?= $cell ?></th>
        <?php endforeach ?>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($params['tables']['table3']['rows'] as $i => $row): ?>
        <tr class="">
          <?php $j = 0; ?>
          <?php foreach ($row as $colValue): ?>
            <td class="cell <?= $j === 0 ? 'header-cell' : '' ?>"><?= $colValue ?></td>
            <?php $j++; ?>
          <?php endforeach ?>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>



<?php require_once BASEPATH . '/views/includes/footer.php'; ?>
