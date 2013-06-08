<div class="wrap" id="section_group_<?=$group_key; ?>">
  <div id="icon-options-general" class="icon32"><br></div>
  <h2><?=$group_title; ?></h2>

  <?php if(SQ_Input::post()) : ?>
  <div id="setting-error-settings_updated" class="updated settings-error"> 
    <p><strong>Settings saved.</strong></p>
  </div>
  <?php endif; ?>

  <form method="post" action="admin.php?page=<?=$group_page; ?>">
    <?php wp_nonce_field($group_key); ?>
    <table class="form-table">
      <tbody>

        <?=$fields; ?>

      </tbody>
    </table>

    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>

  </form>
</div>