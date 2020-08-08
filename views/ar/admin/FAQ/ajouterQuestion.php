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
if (!empty($_POST))
{
    $FAQSystem = new \Psiko\FaqSystem();
    $_POST["isAnonyme"] = isset($_POST["isAnonyme"]) ? -1 : $_SESSION["auth"]->getId();
    $FAQSystem->newQuestion($_POST);
}
$form = new \Psiko\helper\form();
?>
<div class="center">
    <h1>إنشاء سؤال من الاسئلة الشائعة</h1>
    <form method="POST" action="" class="form-group ticket-formulaire">
        <?= $form->inputSelect("langue", ":اللغة ", array("fr" => "فرنسي", "ar" => "عرب", "en" => "الإنجليزية", "pl" => "تلميع"), $this->getLangue(), true)?>
        <?= $form->input("question", "La question","text",true,"سؤال عن الحياة والكون و كل شئ")?>
        <?= $form->textarea("reponse", "الجواب المراد تقديمه");?>
        <?= $form->input("isAnonyme","الرد بشكل مجهول","checkbox",false,null)?>
        <button type="submit" class="btn-submit center btn-good">أضف</button>

    </form>
</div>