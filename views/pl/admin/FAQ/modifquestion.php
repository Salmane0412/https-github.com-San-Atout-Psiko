<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /pl/401");
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
    <h1>Utwórz pytanie FAQ</h1>
    <form method="POST" action="" class="form-group ticket-formulaire">
        <?= $form->inputSelect("langue", "La langue : ", array("fr" => "Français", "ar" => "Arabe", "en" => "Anglais", "pl" => "Polonais"), $question->getLangue(), true)?>
        <div class="form-group">
            <label for="question" class="form-control-label">Pytanie</label> <br>
            <input id="question" class="form-control" name="question" value="<?=htmlspecialchars($question->getQuestion())?>"
                   placeholder="pytanie o życie, wszechświat i inne rzeczy" type="text" required>
        </div>
        <?= $form->textarea("reponse", "Odpowiedź, którą chcesz przynieść",htmlspecialchars($question->getReponse()));?>
        <?= $form->input("isAnonyme","Odpowiedz anonimowo","checkbox",false,null)?>
        <button type="submit" class="btn-submit center btn-good">Dodaj</button>

    </form>
</div>