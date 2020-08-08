<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /ar/tasjildokhol/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /ar/401");
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
    <h1>إنشاء سؤال من الاسئلة الشائة</h1>
    <form method="POST" action="" class="form-group ticket-formulaire">
        <?= $form->inputSelect("langue", "La langue : ", array("fr" => "Français", "ar" => "Arabe", "en" => "Anglais", "pl" => "Polonais"), $question->getLangue(), true)?>
        <div class="form-group">
            <label for="question" class="form-control-label">السؤال</label> <br>
            <input id="question" class="form-control" name="question" value="<?=htmlspecialchars($question->getQuestion())?>"
                   placeholder="سؤال عن الحياة والكون و كل شئ" type="text" required>
        </div>
        <?= $form->textarea("الجواب الذي تريد تقديمه", "الجواب",htmlspecialchars($question->getReponse()));?>
        <?= $form->input("isAnonyme","Répondre anonymement","checkbox",false,null)?>
        <button type="submit" class="btn-submit center btn-good">أضف</button>

    </form>
</div>