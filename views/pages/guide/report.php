<?php
/**
 * This file defines the representation of information in guide tab.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

ob_start(); ?>
<main>
  <?php if (count($_SESSION["path"])>1) { ?>
    <article>
      <p><a class='action' href="<?= PATH_LANGUAGE ?>/guide/back"><?= _('form_back') ?></a></p>
    </article><br>
  <?php } ?>
  <article>
    <h1><?= _('text_clinical_evaluation_report') ?></h1>
    <p>
      <b><?= _('text_section') ?> A</b> <?= _('text_section_a') ?>
    </p>
    <ul style="text-align:left;">
      <li><?= _('report_item_name_model_type') ?></li>
      <li><?= _('report_item_risk_class') ?>: <span class='red'><?= $_SESSION['data']['class'] ?></span></li>
      <li><?= _('report_item_applicable_codes') ?></li>
      <li><?= _('report_item_udi_id') ?></li>
      <li><?= _('report_item_cnd_code') ?></li>
      <?= '' ?>
      <?= '' ?>
      <li><?= _('report_item_certificate_number') ?></li>
      <li><?= _('report_item_manufacturer_clinical_evaluation_report_reference') ?></li>
      <li><?= _('report_item_manufacturer_name_and_srn') ?></li>
      <li><?= _('report_item_authorized_representative_name_and_srn') ?></li>
      <li><?= _('report_item_conformity_assessment_type') ?>: <span class='green'><?= 'do' ?></span></li>
    </ul>
    <p>
      <b><?= _('text_section') ?> B</b> <?= _('text_section_b') ?>
    </p>
    <br>
    <ul style="text-align:left;">
      <li>1.	Description du dispositif</li>
      <ul>
        <li><?= _('report_item_') ?></li>
        <li><?= _('report_item_') ?></li>
        <li><?= _('report_item_') ?></li>
      </ul>
      <li>2.	Classification</li>
      <ul>
        <li><?= _('report_item_') ?></li>
        <li><?= _('report_item_') ?></li>
        <li><?= _('report_item_') ?></li>
      </ul>
    </ul>
  </article>
</main>
<?php $content = ob_get_clean();

require 'views/template.php';
