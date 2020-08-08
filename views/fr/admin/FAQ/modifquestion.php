<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /fr/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /fr/401");
    exit();
}
$FAQSystem = new \Psiko\FaqSystem();

if (!empty($_POST))
{
    $_POST["isAnonyme"] = isset($_POST["isAnonyme"]) ? -1 : $_SESSION["auth"]->getId();
    $FAQSystem->updateQuestion($_POST["question"],$_POST["reponse"],$_POST["isAnonyme"],$_POST["langue"],$params["questionId"]);
}
$form = new \Psiko\helper\form();
$question = $FAQSystem->getQuestionByID($params["questionId"]);
?>
<div class="center">
    <h1>Créer une question de FAQ</h1>
    <form method="POST" action="" class="form-group ticket-formulaire">
        <?= $form->inputSelect("langue", "La langue : ", array("fr" => "Français", "ar" => "Arabe", "en" => "Anglais", "pl" => "Polonais"), $question->getLangue(), true)?>
        <div class="form-group">
            <label for="question" class="form-control-label">La question</label> <br>
            <input id="question" class="form-control" name="question" value="<?=htmlspecialchars($question->getQuestion())?>"
                   placeholder="question sur la vie, l'univers et le reste" type="text" required>
        </div>
        <?= $form->textarea("reponse", "La réponse que vous souhaiter apporter",htmlspecialchars($question->getReponse()));?>
        <?= $form->input("isAnonyme","Répondre anonymement","checkbox",false,null)?>
        <button type="submit" class="btn-submit center btn-good">Ajouter</button>

    </form>
</div>