<h1>
  <?= $params['filename'] ?>
</h1>

<div class="tab-navigation">
  <ul>
    <?php foreach ($params['sheets'] as $sheet): ?>
      <li>
        <a class="<?= $sheet['active'] ? 'active' : '' ?>"
           href="?file_id=<?= $sheet['file_id'] ?>&sheet=<?= $sheet['id'] ?>">
          <?= $sheet['nav_title'] ?>
        </a>
      </li>
    <?php endforeach ?>
  </ul>
</div>