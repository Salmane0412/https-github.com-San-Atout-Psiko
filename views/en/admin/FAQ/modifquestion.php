<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /en/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /en/401");
    exit();
}
$FAQSystem = new \Psiko\FaqSystem();
if (!empty($_POST))
{
    $_POST["isAnonyme"] = isset($_POST["isAnonyme"]) ? -1 : $_SESSION["auth"]->getId();
}
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
        <?= $form->inputSelect("langue", "Language : ", array("fr" => "French", "ar" => "Arabic", "en" => "English", "pl" => "Polish"), $question->getLangue(), true)?>
        <div class="form-group">
            <label for="question" class="form-control-label">La question</label> <br>
            <input id="question" class="form-control" name="question" value="<?=htmlspecialchars($question->getQuestion())?>"
                   placeholder="Put a question about anything" type="text" required>
        </div>
        <?= $form->textarea("reponse", "put the answer to the question",htmlspecialchars($question->getReponse()));?>
        <?= $form->input("isAnonyme","Rply anonymously ","checkbox",false,null)?>
        <button type="submit" class="btn-submit center btn-good">Ajouter</button>

    </form>
</div>