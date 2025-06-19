<?php
$this->layout('template', ['title' => $title]);
?>
<div>
    <h1> <?= $h1 ?></h1>
    <?php if (!empty($message)): ?>
        <div class="errorMessage">
            <?= $message ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="<?= $action ?>" enctype="multipart/form-data">
        <div class="unitInfo">
            <label for="id"></label>
            <input type="text" id="id" name="id" value="<?= isset($unit) ? htmlspecialchars($unit->getId()) : '' ?>"
                   hidden="hidden">

            <label for="name">Nom :</label>
            <input type="text" value="<?= isset($unit) ? htmlspecialchars($unit->getName()) : '' ?>" name="name"
                   id="name" required>

            <label for="cost">Coût :</label>
            <input type="number" min="1" max="5" value="<?= isset($unit) ? htmlspecialchars($unit->getCost()) : '' ?>"
                   name="cost" id="cost" required autocomplete="off">

            <label for="origin1">Origine :</label>
            <select  name="origin1" id="origin1" AUTOCOMPLETE="on" required>
                <?php foreach ($origins as $origin): ?>
                    <option value="<?=$origin->getId() ?>" <?php if($origin->getName() == $unit?->getOrigin()[0]?->getName()) echo "selected"; ?>><?=$origin->getName() ?></option>
                <?php endforeach; ?>
            </select>

            <label for="origin2"></label>
            <select  name="origin2" id="origin2" AUTOCOMPLETE="on">
                <?php foreach ($origins as $origin): ?>
                    <option value="<?=$origin->getId() ?>" <?php if($origin->getName()==$unit?->getOrigin()[1]?->getName()) echo "selected"; ?>><?=$origin->getName() ?></option>
                <?php endforeach; ?>
            </select>

            <label for="origin3"></label>
            <select  name="origin3" id="origin3" AUTOCOMPLETE="on">
                <?php foreach ($origins as $origin): ?>
                    <option value="<?=$origin->getId() ?>"<?php if($origin->getName()==$unit?->getOrigin()[2]?->getName()) echo "selected"; ?>><?=$origin->getName() ?></option>
                <?php endforeach; ?>
            </select>

            <label for="url_img">Portrait :</label>
            <?php if (isset($unit)): ?>
            <img class="portrait" src="<?= htmlspecialchars(\Config\Config::get('pathGrpPublicFolder'). '/img/characters/' . $unit->getUrl_img())?>" alt="Image du perso">
            <?php endif; ?>
            <input type="file" name="url_img" id="url_img"
                   <?= $imageRequired ? 'required' : '' ?>
                   accept=".png, .jpg, .jpeg, .svg">
        </div>
        <button type="submit"><?= $submitButton ?></button>
        <script src="/public/js/script.js">initFormValidation()</script>
    </form>
</div>