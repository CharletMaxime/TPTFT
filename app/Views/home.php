<?php
$this->layout('template', ['title' => 'TP TFT']);
?>
<h1>TFT - Set <?= $this->e($tftSetName) ?></h1>

<div class="card-grid">
    <?php foreach ($getAllUnit as $unit): ?>
    <div class="card">
        <div class="card-header">
            <img src="<?= htmlspecialchars(\Config\Config::get('pathGrpPublicFolder'). '/img/characters/' . $unit->getUrl_img())?>" alt="Image du perso">
            <div class="card-icons">
                <span class="edit-icon" data-id="<?= htmlspecialchars($unit->getId()) ?>"><a href="<?="?action=edit&edit=" . htmlspecialchars($unit->getId()) ?>">✏️</span>
                <span class="delete-icon" data-id="<?= htmlspecialchars($unit->getId()) ?>"><a href="<?= "?action=delete&delete=" . htmlspecialchars($unit->getId()) ?>">🗑️</a></span>
            </div>
        </div>
        <div class="card-content">
            <ul class="traits">
                <li><?=htmlspecialchars($unit->getOrigin())?></li>
            </ul>
            <div class="card-footer">
                <span class="card-name"><?= htmlspecialchars($unit->getName()) ?></span>
                <div class="card-cost">
                    <span class="coin-icon">🪙</span>
                    <span class="cost-number"><?=htmlspecialchars($unit->getCost())?></span>
                </div>
            </div>
        </div>
    </div>';
    }
    <?php endforeach;?>
</div>
