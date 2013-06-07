  <h3>Author Commitments</h3>

  <table class="form-table">
    <tbody>
      <tr>
        <th>
          <label for="section_assignment">
            Section Assignment
          </label>
        </th>
        <td>
          <?php if(!is_array($sections_list)) : ?>
          <strong>You need to add at least one Section before using this plugin.</strong>
          <?php else : ?>
          <select name="section_assignment" id="section_assignment">
            <option value="">-- SELECT ONE --</option>
            <?php foreach($sections_list as $section) : ?>
            <option value="<?=$section; ?>"<?= ($section == $section_assignment) ? ' selected="selected"' : '' ?>><?=$section; ?></option>
            <?php endforeach; ?>
          </select>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>
          <label for="weekly_commitment">
            Weekly Commitment
          </label>
        </th>
        <td>
          <input type="number" name="weekly_commitment" value="<?=$weekly_commitment; ?>" id="weekly_commitment" />
        </td>
      </tr>
    </tbody>
  </table>
