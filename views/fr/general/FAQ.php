<?php
$FAQSystem = new \Psiko\FaqSystem();
$questions = $FAQSystem->getAllQuestionByLangue("fr");
$i =1;
foreach ($questions as $question)
{
    echo '<div class="faq">
        <div class="spoiler">
                <input type="button" class="boutonSpoil" value="'.$i.') '.$question->getQuestion().'" onclick="montrerFAQ(this);">
                <div class="contenuSpoiler">
                    '.htmlspecialchars($question->getReponse()).'
                </div>
        </div>
</div>';
    $i++;
}
?>
<script type="text/javascript">


    function montrerFAQ(bouton) {
        var divContenu = bouton.nextSibling;
        if(divContenu.nodeType === 3) divContenu = divContenu.nextSibling;
        if(divContenu.style.display === 'flex') {
            divContenu.style.display = 'none';
        }
        else {
            divContenu.style.display = 'flex';
            divContenu.style.flexDirection = 'row';
        }
    }

</script>